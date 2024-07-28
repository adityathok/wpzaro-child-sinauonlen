<?php
/**
 * The template for displaying all single posts
 *
 * @package wpzaro
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if(!is_user_logged_in()) {
    header('Location: '.get_site_url());
    die();
}

get_header();
$container      = get_theme_mod( 'wpzaro_container_type' );
$AdMateri       = new AdMateri();
$AdAbsenPost    = new AdAbsenPost();
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

            <div class="col-12">

                <main class="site-main" id="main">

                    <?php while ( have_posts() ) { the_post(); ?>

                        <div class="single-card-custom">
                            <div class="bg-image-content">
                                <img src="<?php echo get_thumbnail_url_resize(get_the_ID(),500,300);?>" class="img-fluid w-100" alt="<?php echo get_the_title();?>" loading="lazy">
                            </div>
                            <div class="post-author text-center">                                
                                <img src="<?php echo adget_url_ava($post->post_author); ?>" class="img-fluid rounded-circle" width="70" alt="">
                            </div>

                            <header class="entry-header text-center">
                                <?php the_title( '<h1 class="entry-title h4 mt-4 mb-3">', '</h1>' ); ?>                            
                            </header><!-- .entry-header -->
                            
                            <?php if(current_user_can('siswa')): ?>
                                <?php $check = $AdAbsenPost->check(get_current_user_id(),$post->ID); ?>
                                <?php if ($check): ?>
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Anda sudah presensi <br>
                                        <span class="badge bg-success"><?php echo $check[0]->date; ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-danger alert-absen-<?php echo get_the_ID(); ?> bg-white text-center shadow-sm my-4">
                                        <div class="btn btn-danger w-100 btn-absen-post btn-absen-post-<?php echo get_the_ID(); ?>" data-posttype="admateri" data-post="<?php echo get_the_ID(); ?>">Presensi</div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="alert alert-secondary bg-white shadow-sm my-4">
                                    <div class="btn-group w-100" role="group">
                                        <!-- <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#dataAbsenModal">Cek Presensi</button> -->
                                         <?php if(isset($_GET['showpresensi'])): ?>
                                            <a href="<?php echo get_the_permalink();?>" class="btn btn-dark">Lihat Materi</a>
                                        <?php else: ?>
                                            <a href="<?php echo get_the_permalink();?>/?showpresensi=true" class="btn btn-dark">Cek Presensi</a>
                                         <?php endif; ?>
                                        <a href="<?php echo get_home_url();?>/materi/?pg=edit&id=<?php echo get_the_ID(); ?>" class="btn btn-secondary">Edit Materi</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(!current_user_can('siswa') && isset($_GET['showpresensi'])): ?>

                                <?php
                                require_once('inc/materi/presensi.php');    
                                ?>

                            <?php else: ?>

                                <?php 
                                $getfile   = get_post_meta( get_the_ID(), 'file_add', true );
                                $fileurl   = $getfile?wp_get_attachment_url($getfile):$getfile;
                                if($fileurl):
                                ?>

                                    <div class="card shadow-sm my-4">
                                        <div class="card-header text-center">File Lampiran</div>
                                        <div class="card-body text-center">
                                            <a href="<?php echo $fileurl; ?>" class="btn btn-secondary" download>Download</a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="entry-content">
                                    <?php
                                    the_content();
                                    wpzaro_link_pages();
                                    ?>
                                </div><!-- .entry-content -->
                                
                                <div class="my-3">
                                    <?php 
                                    $kls = get_post_meta(get_the_ID(),'kelas',true);
                                    echo $kls?'<span class="badge bg-secondary me-1 mb-1">'.implode('</span><span class="badge bg-secondary me-1 mb-1">',$kls).'</span>':'';
                                    ?>
                                    <div class="mb-3">
                                        <span class="badge bg-dark"><?php echo get_the_date('d M Y H:i:s'); ?></span>
                                    </div>
                                </div>

                            </div>
                            
                            <?php 
                            $uservisit = $AdMateri->uservisit(get_current_user_id(),get_the_ID());
                            ?>
                            
                            <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) {
                                comments_template();
                            }
                            $user_info = get_userdata($post->post_author);
                            ?>

                            <a class="d-none btn btn-success w-100" href="<?php echo bp_members_get_user_url(get_current_user_id());?>messages/compose/?r=<?php echo $user_info->user_login; ?>">
                                Komentari <i class="fa fa-commenting-o"></i>
                            </a>

                        <?php endif; ?>

                    <?php } ?>
                    

                </main><!-- #main -->

            </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->


<?php
get_footer();
