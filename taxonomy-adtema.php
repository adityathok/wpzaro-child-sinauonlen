<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpzaro
 */

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
					get_template_part( 'templates-loop/content', 'none' );
				}
				?>

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