<?php
/**
 * Template Name: Materi Template
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
$current_id = get_current_user_id();
$urlpage    = get_the_permalink();

    if(is_user_logged_in()):
        echo '<div class="container py-3">';
            if(current_user_can('administrator') || current_user_can('guru')):
                switch ($pg) {
                    case "add":
                        require_once('inc/materi/form.php');
                        break;
                    default:
                        require_once('inc/materi/daftar-materi.php');
                        break;
                }
            endif;
        echo '</div>';
    endif;

get_footer();