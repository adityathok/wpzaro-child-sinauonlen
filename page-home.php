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
            <div class="bg-head-svg">
            
            <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 410" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(146.595, 34.51, 150.695, 1)" offset="0%"></stop><stop stop-color="rgba(250.873, 0, 115.257, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,82L40,88.8C80,96,160,109,240,102.5C320,96,400,68,480,61.5C560,55,640,68,720,95.7C800,123,880,164,960,177.7C1040,191,1120,178,1200,164C1280,150,1360,137,1440,143.5C1520,150,1600,178,1680,164C1760,150,1840,96,1920,116.2C2000,137,2080,232,2160,252.8C2240,273,2320,219,2400,205C2480,191,2560,219,2640,246C2720,273,2800,301,2880,307.5C2960,314,3040,301,3120,293.8C3200,287,3280,287,3360,239.2C3440,191,3520,96,3600,102.5C3680,109,3760,219,3840,280.2C3920,342,4000,355,4080,314.3C4160,273,4240,178,4320,123C4400,68,4480,55,4560,68.3C4640,82,4720,123,4800,129.8C4880,137,4960,109,5040,82C5120,55,5200,27,5280,20.5C5360,14,5440,27,5520,54.7C5600,82,5680,123,5720,143.5L5760,164L5760,410L5720,410C5680,410,5600,410,5520,410C5440,410,5360,410,5280,410C5200,410,5120,410,5040,410C4960,410,4880,410,4800,410C4720,410,4640,410,4560,410C4480,410,4400,410,4320,410C4240,410,4160,410,4080,410C4000,410,3920,410,3840,410C3760,410,3680,410,3600,410C3520,410,3440,410,3360,410C3280,410,3200,410,3120,410C3040,410,2960,410,2880,410C2800,410,2720,410,2640,410C2560,410,2480,410,2400,410C2320,410,2240,410,2160,410C2080,410,2000,410,1920,410C1840,410,1760,410,1680,410C1600,410,1520,410,1440,410C1360,410,1280,410,1200,410C1120,410,1040,410,960,410C880,410,800,410,720,410C640,410,560,410,480,410C400,410,320,410,240,410C160,410,80,410,40,410L0,410Z"></path></svg>

            </div>

                <?php if(is_user_logged_in()): ?>
                        <div class="content-profile-homepage">
                            <div class="pp-ava text-center my-4">
                                <span class="rounded-circle mx-auto d-inline-block overflow-hidden shadow bg-white p-2">
                                    <img src="<?php echo adget_url_ava($current_id,'full'); ?>" class="img-fluid rounded-circle" width="150" alt="">
                                </span>
                            </div>
                            <div class="text-center mb-5">
                                <h4 class="fw-bold"><?php echo $currentdata->display_name; ?></h4>                    
                            </div> 

                            <?php
                            if(current_user_can('administrator') || current_user_can('guru')):
                                require_once('inc/guru/card-home.php');
                            else:
                                require_once('inc/siswa/card-home.php');
                            endif;
                            ?>

                            <div class="list-materi-last my-4">                        
                                <?php 
                                if($visit_materi):
                                    echo '<div class="fw-bold text-muted mb-2">Kunjungan terakhir</div>';
                                    echo '<div class="mb-2">';
                                    foreach ( array_slice($visit_materi, 0, 10) as $valmateri ) { 
                                        $idmateri       = $valmateri['id'];
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
                                    echo '</div>';
                                endif;
                                ?>
                            </div>
                <?php else: ?>

                    <div class="card mt-4 mb-2 my-5">
                        <img src="<?php echo $themeoption['_theme_logo']; ?>" class="card-img-top" alt="...">
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
