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
                        <?php 
                        if($visit_materi):
                            echo '<div class="fw-bold text-muted mb-2">Kunjungan terakhir</div>';
                            echo '<div class="mb-2">';
                            foreach ( $visit_materi as $idmateri ) { 
                                $author_id      = get_post_field ('post_author', $idmateri);
                                $display_name   = get_the_author_meta( 'display_name' , $author_id ); 
                                ?>
                                <div class="card shadow-sm mb-3">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="<?php echo get_thumbnail_url_resize($idmateri,150,150);?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <a href="<?php echo get_the_permalink($idmateri);?>" class="card-title text-dark mb-2"><?php echo get_the_title($idmateri);?></a>
                                                <div class="card-text"><small class="text-muted"><i class="fa fa-user-o"></i> <?php echo $display_name;?></small></div>
                                                <div class="card-text"><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo post_date_ago($idmateri);?></small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            echo '</div>';
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
