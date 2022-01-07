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
$current_id     = get_current_user_id();
$currentdata    = get_userdata( $current_id );
$visit_materi   = get_user_meta($current_id,'_visit_materi',true);
?>

    <div class="container">
        <?php if(is_user_logged_in()): ?>

            <div class="profile-homepage">
                <div class="bg-head-svg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#e7008a" fill-opacity="1" d="M0,128L60,154.7C120,181,240,235,360,261.3C480,288,600,288,720,261.3C840,235,960,181,1080,181.3C1200,181,1320,235,1380,261.3L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
                </div>
                <div class="content-profile-homepage">
                    <div class="pp-ava text-center my-4">
                        <span class="rounded-circle mx-auto d-inline-block overflow-hidden shadow bg-white p-2">
                            <img src="<?php echo adget_url_ava($current_id,'full'); ?>" class="img-fluid rounded-circle" width="150" alt="">
                        </span>
                    </div>
                    <div class="text-center mb-5">
                        <h4 class="fw-bold"><?php echo $currentdata->display_name; ?></h4>                    
                    </div> 

                    <div class="list-materi-last my-4">
                        <div class="fw-bold text-muted mb-2">Kunjungan terakhir</div>
                        <?php 
                        if($visit_materi):
                            // The Query
                            $args = array(
                                'post_type'         => 'admateri',
                                'post__in'          => $visit_materi,
                                'posts_per_page'    => 12
                            );                         
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) {
                                while ( $the_query->have_posts() ) { 
                                    $the_query->the_post();
                                    ?>
                                    <div class="card shadow-sm mb-3">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <img src="<?php echo get_thumbnail_url_resize(get_the_ID(),150,150);?>" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body">
                                                    <a href="<?php echo get_the_permalink();?>" class="card-title text-dark"><?php echo get_the_title();?></a>
                                                    <p class="card-text"><small class="text-muted">by : <?php echo get_the_author();?></small></p>
                                                    <p class="card-text"><small class="text-muted"><?php echo post_date_ago(get_the_ID());?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        endif;
                        ?>
                    </div>

                </div>
            </div>

        <?php else: ?>

            <hr class="my-5">

            <div class="card mt-4 mb-2 my-5">
                <div class="card-body py-5">
                    <?php echo ad_login_form(); ?>
                </div>
            </div>

        <?php endif; ?>
    </div>

<?php
get_footer();
