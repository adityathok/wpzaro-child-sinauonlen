<?php
/**
 * Template Name: Nilai Siswa
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package wpzaro
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$pg         = isset($_GET['pg']) ? $_GET['pg'] : '';
$act        = isset($_GET['act']) ? $_GET['act'] : '';
$iduser     = get_current_user_id();
$urlpage    = get_the_permalink();

if(is_user_logged_in()):
    echo '<div class="container py-3">';
        if(current_user_can('siswa')): 

            // The Query
            $args = array(
                'post_type'         => 'adnilaisiswa',
                'posts_per_page'    =>-1,
                'meta_query'        => array(
                    array(
                        'key'     => 'siswa',
                        'value'   => $iduser,
                        'compare' => '=',
                    ),
                ),
            );
            $the_query = new WP_Query( $args );
            
            echo '<div class="list-nilai-'.$iduser.'">';
                // The Loop
                if ( $the_query->have_posts() ) {
                    echo '<div class="list-nilaisiswa">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        ?>
                        <div <?php post_class('mb-3'); ?>>
                            <div class="card shadow-sm p-3">
                                <a href="<?php echo get_the_permalink();?>">
                                    <?php echo get_the_title();?>
                                </a>
                                <small class="d-block text-muted mt-1">
                                    <?php echo post_date_ago(get_the_ID());?>
                                </small>
                            </div>
                        </div>
                        <?php
                    }
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning">belum ada nilai</div>';
                }
            echo '</div>';

        endif;
        if(current_user_can('administrator') || current_user_can('guru')):
            require_once('inc/admin/siswa.php');
        endif;
    echo '</div>';
endif;

get_footer();