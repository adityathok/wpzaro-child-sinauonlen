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
$idmateri   = isset($_GET['id']) ? $_GET['id'] : '';
$current_id = get_current_user_id();
$urlpage    = get_the_permalink();

    if(is_user_logged_in()):
        echo '<div class="container py-3">';
            if(current_user_can('administrator') || current_user_can('guru')):
                switch ($pg) {
                    case "add":
                        require_once('inc/materi/form.php');
                        break;
                    case "edit":
                        require_once('inc/materi/form.php');
                        break;
                    default:
                        require_once('inc/materi/daftar-materi.php');
                        break;
                }
            endif;
            if(current_user_can('siswa')):                
                require_once('inc/materi/daftar-materi.php');
            endif;
        echo '</div>';
    else:
        echo '<div class="container py-3 text-center">';
            echo '<div class="card p-3 text-start">';
            echo ad_login_form(); 
            echo '</div>';
        echo '</div>';
    endif;

get_footer();