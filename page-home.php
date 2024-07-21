<?php
/**
 * Template Name: Home Page Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package wpzaro
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$themeoption    = get_option('wpzaro_theme_options');
$current_id     = get_current_user_id();
$currentdata    = get_userdata( $current_id );
$visit_materi   = get_user_meta($current_id,'_visit_materi',true);
$AdAbsenPost    = new AdAbsenPost();
?>

    <div class="container">

        <div class="profile-homepage">

                <?php if(is_user_logged_in()): ?>

                        <div class="bg-head-svg">

                            <svg xmlns="http://www.w3.org/2000/svg" height="150px" >
                                <defs>
                                <linearGradient id="lgrad" x1="50%" y1="100%" x2="50%" y2="0%" >
                                    <stop offset="0%" style="stop-color:rgb(102,139,230);stop-opacity:1.00" />
                                    <stop offset="100%" style="stop-color:rgb(110,0,183);stop-opacity:1.00" />
                                </linearGradient>
                                </defs>
                                <rect x="0" y="0" width="100%" height="100%" fill="url(#lgrad)"/>
                            </svg>

                        </div>

                        <div class="content-profile-homepage">

                            <div class="row align-items-center mt-5 mb-3">
                                <div class="col-4">                                    
                                    <span class="rounded-circle mx-auto d-inline-block overflow-hidden shadow bg-white p-2">
                                        <img src="<?php echo adget_url_ava($current_id,'full'); ?>" class="img-fluid rounded-circle" width="150" alt="">
                                    </span>
                                </div>
                                <div class="col-8 pt-3">
                                    <h4 class="fw-bold"><?php echo $currentdata->display_name; ?></h4>   
                                </div>
                            </div>


                            <?php
                            if(current_user_can('administrator') || current_user_can('guru')):
                                require_once('inc/guru/card-home.php');
                            else:
                                require_once('inc/siswa/card-home.php');
                            endif;
                            ?>
                            
                            <?php
                            if($themeoption['_theme_bannerhome']) {
                                echo '<div class="pghome-slider mb-5 mt-2 overflow-hidden">';
                                foreach ($themeoption['_theme_bannerhome'] as $key => $value) {
                                    echo '<div class="item-pghome-slider p-1">';
                                        echo '<img src="'.$value.'" loading="lazy" class="w-100 rounded shadow-sm"/>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                            ?>

                            <div class="list-materi-last my-4">                        
                                <?php 
                                if($visit_materi):
                                    echo '<div class="fw-bold text-muted mb-2">Kunjungan terakhir</div>';
                                    echo '<div class="mb-2">';
                                    foreach ( array_slice($visit_materi, 0, 10) as $valmateri ) { 
                                        $idmateri       = $valmateri['id'];
                                        $author_id      = get_post_field('post_author', $idmateri);
                                        if($author_id) {
                                            $display_name   = get_the_author_meta( 'display_name' , $author_id ); 
                                            ?>
                                            <div class="card shadow-sm mb-3">
                                                <div class="row g-0">
                                                    <div class="col-4 col-md-3">
                                                        <a href="<?php echo get_the_permalink($idmateri);?>">
                                                            <img src="<?php echo get_thumbnail_url_resize($idmateri,150,150);?>" class="img-fluid rounded-start" alt="...">
                                                        </a>
                                                    </div>
                                                    <div class="col-8 col-md-9">
                                                        <div class="card-body">
                                                            <a href="<?php echo get_the_permalink($idmateri);?>" class="card-title text-dark mb-2"><?php echo get_the_title($idmateri);?></a>
                                                            <div class="card-text"><small class="text-muted"><i class="fa fa-user-o"></i> <?php echo $display_name;?></small></div>
                                                            <div class="card-text"><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo get_date_ago($valmateri['date']);?></small></div>
                                                    
                                                            <?php if ($AdAbsenPost->check($current_id,$idmateri)): ?>
                                                                <div class="card-text">
                                                                    <small class="text-success">
                                                                        <i class="fa fa-check"></i> Sudah absen
                                                                    </small>
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    echo '</div>';
                                endif;
                                ?>
                            </div>
                <?php else: ?>

                    <div class="card mt-4 mb-2 my-5">
                        <img src="<?php echo $themeoption['_theme_logo']; ?>" class="card-img-top mx-auto my-2" alt="..." style="max-width: 12rem;">
                        <div class="card-body py-5">
                            <?php echo ad_login_form(); ?>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>

<?php
get_footer();
