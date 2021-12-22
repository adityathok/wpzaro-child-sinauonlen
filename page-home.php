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
?>

    <div class="container">
        <?php if(is_user_logged_in()): ?>
        <?php else: ?>
            <div class="card mt-4 mb-2 my-4">
                <div class="card-body py-5">
                    <?php echo ad_login_form(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php
get_footer();
