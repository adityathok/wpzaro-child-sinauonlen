<?php
/**
 * The template for displaying all single posts
 *
 * @package wpzaro
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container      = get_theme_mod( 'wpzaro_container_type' );
$AdNilaiSiswa   = new AdNilaiSiswa();

?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

            <div class="col-12">

                <main class="site-main" id="main">

                    <?php while ( have_posts() ) { the_post(); ?>

                        <header class="entry-header text-center">
                                <?php the_title( '<h1 class="entry-title h5 mt-4 mb-3">', '</h1>' ); ?>                            
                        </header><!-- .entry-header -->

                        
                        <?php 
                        bp_notifications_mark_notifications_by_item_id( get_current_user_id(), get_the_ID(), 'custom', 'new_post', false, false );
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

                    <?php } ?>
                        
                </main><!-- #main -->

            </div>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();