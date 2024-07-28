<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpzaro
 */

if(!is_user_logged_in()) {
    header('Location: '.get_site_url());
    die();
}

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = wpzaro_theme_setting( 'wpzaro_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar -->
			<?php //wpzaro_sidebar_left(); ?>

			<main class="site-main" id="main">

				<?php
				if ( have_posts() ) {
					?>
					
					<div class="daftar-materi">

					<?php
					// Start the loop.
					while ( have_posts() ) {
						the_post();
						
                            get_template_part( 'inc/materi/content');

						}
					?>

					</div>

					<?php
				} else { 
                    ?>
                    <div class="text-center pt-5">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                            </svg>
                        </div>
                        <h4>Tidak ada materi disini</h4>
                    </div>
					<?php
				}
				?>

				<?php if(!current_user_can('siswa')): ?>
					<div class="float-button-bottom">
						<div class="container text-end">
							<a href="<?php echo get_site_url();?>/materi?pg=add" class="btn btn-success rounded-circle shadow">
								<i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
				<?php endif; ?>

			</main><!-- #main -->

			<?php
			// Display the pagination component.
			wpzaro_pagination();
			// Do the right sidebar.
			//wpzaro_sidebar_right();
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();