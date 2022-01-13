<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: wpzaro
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load other required files
 *
 */
require_once('inc/ajax.php');
require_once('inc/bp-notifications.php');
require_once('inc/css-wp-form.php');
require_once('inc/class_AdFrontpost.php');
require_once('inc/class_AdMember.php');
require_once('inc/class_AdGuru.php');
require_once('inc/class_AdSiswa.php');
require_once('inc/class_AdMateri.php');
require_once('inc/class_AdAbsenPost.php');
require_once('inc/class_AdNilaiSiswa.php');
require_once('inc/login-form.php');
require_once('inc/header-builder.php');
require_once('inc/footer-builder.php');
require_once('inc/offcanvas-menu-header.php');
require_once('inc/cmb2.php');

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
if( ! function_exists( 'wpzaro_child_enqueue_parent_style') ) {
	function wpzaro_child_enqueue_parent_style() {

		// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
		$parenthandle = 'parent-style'; 
        $theme = wp_get_theme();
		
		// Load the stylesheet
        wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
            array(),  // if the parent theme code has a dependency, copy it to here
            $theme->parent()->get('Version')
        );
        
        $css_version = $theme->parent()->get('Version') . '.' . filemtime( get_stylesheet_directory() . '/css/custom.css' );
        // wp_enqueue_style( 'slick-style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', $css_version);
        // wp_enqueue_style( 'slick-style-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css', $css_version);
        wp_enqueue_style( 'sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css', $css_version);
        wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/css/custom.css', 
            array(),  // if the parent theme code has a dependency, copy it to here
            $css_version
        );
        
        wp_enqueue_style( 'child-style', get_stylesheet_uri(),
            array( $parenthandle ),
            $theme->get('Version')
        );
        
        $js_version = $theme->parent()->get('Version') . '.' . filemtime( get_stylesheet_directory() . '/js/custom.js' );
        // wp_enqueue_script( 'slick-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array(), $js_version, true );
        wp_enqueue_script( 'sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js', array(), $js_version, true );
        wp_enqueue_script( 'wpzaro-custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array(), $js_version, true );

	}
	
}

add_action( 'after_setup_theme', 'wpzarochild_theme_setup', 20 );

function wpzarochild_theme_setup() {
	
	// Load wpzaro_child_enqueue_parent_style after theme setup
	add_action( 'wp_enqueue_scripts', 'wpzaro_child_enqueue_parent_style', 20 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'navmenu' => __( 'Nav Menu', 'wpzaro' ),
		)
	);

}

//remove action in parent theme
add_action( 'init', 'mytheme_remove_parent_function');
function mytheme_remove_parent_function() {
    remove_action('wpzaro_header','wpzaro_header_layout_content',20);
    remove_action('wpzaro_header_before','wpzaro_header_layout_open',20);
    remove_action('wpzaro_footer','wpzaro_footer_layout_content',20);
    remove_action('wpzaro_header_after','wpzaro_header_layout_close',20);
}

//hide bar
add_action('after_setup_theme', 'wpzaro_remove_admin_bar');
function wpzaro_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin() || wp_is_mobile()) {
        show_admin_bar(false);
    }
}

// add role
add_role('guru', __('Guru'),
    array(
        'read'              => true, // Allows a user to read
        'create_posts'      => false, // Allows user to create new posts
        'edit_posts'        => false, // Allows user to edit their own posts
        'edit_others_posts' => false, // Allows user to edit others posts too
        'publish_posts'     => false, // Allows the user to publish posts
        'manage_categories' => true, // Allows user to manage post categories
        'upload_files' 		=> true, // Allows user to upload files
    )
);
add_role('siswa', __('Siswa'),
    array(
        'read'              => false, // Allows a user to read
        'create_posts'      => false, // Allows user to create new posts
        'edit_posts'        => false, // Allows user to edit their own posts
        'edit_others_posts' => false, // Allows user to edit others posts too
        'publish_posts'     => false, // Allows the user to publish posts
        'manage_categories' => false, // Allows user to manage post categories
        'upload_files' 		=> true,
    )
);

function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}
add_action('init', 'register_my_session');

function adget_url_ava($userid,$size='thumb'){
    $url = bp_core_fetch_avatar ( 
        array(
            'item_id' => $userid, 
            'type'    => $size,
            'html'   => FALSE
        ) 
    );
    return $url;
}

function get_date_ago($datetime){

    $datenow            = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
    
    $time_ago           = strtotime($datetime);  
    $current_time       = strtotime($datenow);
    $time_difference    = $current_time - $time_ago;  
    $seconds            = $time_difference;  
    $minutes            = round($seconds / 60 );        // value 60 is seconds  
    $hours              = round($seconds / 3600);       //value 3600 is 60 minutes * 60 sec  
    $days               = round($seconds / 86400);      //86400 = 24 * 60 * 60;  
    $weeks              = round($seconds / 604800);     // 7*24*60*60;  
    $months             = round($seconds / 2629440);    //((365+365+365+365+366)/5/12)*24*60*60  
    $years              = round($seconds / 31553280);   //(365+365+365+365+366)/5 * 24 * 60 * 60 

    if($seconds <= 60) {  
        return "Just Now";  
    } else if($minutes <=60) {  
        if($minutes==1){  
            return "one minute ago";  
        } else {  
            return "$minutes minutes ago";  
        }  
    } else if($hours <=24) {  
        if($hours==1) {  
            return "an hour ago";  
        } else {  
            return "$hours hours ago";  
        }  
    } else if($days <= 7) {  
        if($days==1) {  
            return "yesterday";  
        } else {  
            return "$days days ago";  
        }  
    } else if($weeks <= 4.3) {  //4.3 == 52/12
        if($weeks==1){  
            return "a week ago";  
        } else {  
            return "$weeks weeks ago";  
        }  
    } else if($months <=12){  
        if($months==1){  
            return "a month ago";  
        }else{  
            return "$months months ago";  
        }  
    }else {  
        if($years==1){  
            return "one year ago";  
        }else {  
            return "$years years ago";  
        }  
    }  
}

function post_date_ago($idpost) {
    $datetime   = get_the_date('Y-m-d H:i:s',$idpost);
    return get_date_ago($datetime);
}

function user_has_role($user_id, $role_name) {
    $user_meta  = get_userdata($user_id);
    $user_roles = $user_meta->roles;
    return in_array($role_name, $user_roles);
}

//generate list group menu
function listmenugroup($arraymenu) {
    ?>
    <ul class="list-group list-group-menu">
        <?php
        foreach ($arraymenu as $key => $value) {
            $submenu    = isset($value['submenu'])?$value['submenu']:'';
            $role       = isset($value['role'])?$value['role']:'';

            if(!empty($role) && !current_user_can($role)) {
                continue;
            }
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <a href="<?php echo $value['url']; ?>" class="d-block">
                    <i class="<?php echo $value['icon']; ?>" aria-hidden="true"></i>
                    <?php echo $value['title']; ?>
                </a>
                <?php if($submenu): ?>
                    <span class="btn btn-sm btn-light pull-right" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key; ?>">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                <?php endif; ?>
            </li>

            <?php if($submenu): ?>
                <ul class="collapse p-0" id="collapse<?php echo $key; ?>">
                <?php foreach ($submenu as $skey => $svalue) { ?>
                    <li class="list-group-item d-flex bg-light ps-4" data-parent="<?php echo $key; ?>">
                        <a href="<?php echo $svalue['url']; ?>" class="d-block">
                            <i class="<?php echo $svalue['icon']; ?>" aria-hidden="true"></i>
                            <?php echo $svalue['title']; ?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            <?php endif; ?>
            <?php
        }
        ?>
    </ul>
    <?php
}

function get_thumbnail_url_resize($idpost, $width, $height) { 
    $default    = get_option( 'wpzaro_theme_options' )['_theme_default_thumb'];
	$urlimg     = get_the_post_thumbnail_url($idpost,'full');
    $urlimg     = $urlimg?$urlimg:$default;
    $urlresize  = $urlimg?aq_resize( $urlimg, $width, $height, true, true, true ):'';

    return $urlresize;
}

//[resize-thumbnail width="300" height="150" linked="true" class="w-100"]
add_shortcode('resize-thumbnail', 'resize_thumbnail');
function resize_thumbnail($atts) {
    ob_start();
	global $post;
    $atribut = shortcode_atts( array(
        'output'	=> 'image', /// image or url
        'width'    	=> '300', ///width image
        'height'    => '150', ///height image
        'crop'      => 'false',
        'upscale'   => 'true',
        'linked'   	=> 'true', ///return link to post	
        'class'   	=> 'w-100', ///return class name to img	
    ), $atts );

    $output			= $atribut['output'];
    $width          = $atribut['width'];
    $height         = $atribut['height'];
    $crop           = $atribut['crop'];
    $upscale        = $atribut['upscale'];
    $linked        	= $atribut['linked'];
    $class        	= $atribut['class']?'class="'.$atribut['class'].'"':'';
	$urlimg			= get_the_post_thumbnail_url($post->ID,'full');

	if($urlimg):
		$urlresize      = aq_resize( $urlimg, $width, $height, $crop, true, $upscale );
		if($output=='image'):
			if($linked=='true'):
				echo '<a href="'.get_the_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
			endif;
			echo '<img src="'.$urlresize.'" width="'.$width.'" height="'.$height.'" loading="lazy" '.$class.'>';
			if($linked=='true'):
				echo '</a>';
			endif;
		else:
			echo $urlresize;
		endif;
	endif;

	return ob_get_clean();
}

//[excerpt count="150"]
add_shortcode('excerpt', 'vd_getexcerpt');
function vd_getexcerpt($atts){
    ob_start();
	global $post;
    $atribut = shortcode_atts( array(
        'count'	=> '150', /// count character
    ), $atts );

    $count		= $atribut['count'];
    $excerpt	= get_the_content();
    $excerpt 	= strip_tags($excerpt);
    $excerpt 	= substr($excerpt, 0, $count);
    $excerpt 	= substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt 	= ''.$excerpt.'...';

    echo $excerpt;

	return ob_get_clean();
}

//add page style css
add_action( 'wp_head', 'add_page_style_css' );
function add_page_style_css(){
    global $post;
    if(is_page()):
        $bgimage = get_post_meta($post->ID, 'bgimage', true);
        ?>
        <style>
            <?php if($bgimage): ?>
            .page #page {
                background-image: url(<?php echo $bgimage; ?>);
                background-repeat: no-repeat;
                background-position: center top;
                background-size: cover;
            }
            <?php endif; ?>
        </style>
        <?php
    endif;
}