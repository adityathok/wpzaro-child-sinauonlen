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
                                <?php if ($AdAbsenPost->check($post->post_author,$post->ID)): ?>
                                    <div class="alert alert-success">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Anda sudah absen
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning bg-white text-center">
                                        <div class="btn btn-warning w-100 btn-absen-post btn-absen-post-<?php echo get_the_ID(); ?>" data-post="<?php echo get_the_ID(); ?>">Absen</div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="entry-content">
                                <?php
                                the_content();
                                wpzaro_link_pages();
                                ?>
                            </div><!-- .entry-content -->
                        </div>
                        
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    }
                    ?>

                </main><!-- #main -->

            </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
