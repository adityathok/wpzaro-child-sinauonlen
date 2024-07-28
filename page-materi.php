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
                        // require_once('inc/materi/daftar-materi.php');
                        require_once('inc/materi/daftar-tema.php');

                        echo '<a href="'.get_site_url().'/admateri" class="btn btn-primary w-100 mt-4">';
                        echo 'Lihat semua materi';
                        echo '</a>';

                        break;
                }
            endif;
            if(current_user_can('siswa')):                
                require_once('inc/materi/daftar-materi.php');
            endif;
        echo '</div>';
        ?>
        <?php if(!current_user_can('siswa')): ?>
            <div class="float-button-bottom">
                <div class="container text-end">
                    <a href="<?php echo $urlpage;?>?pg=add" class="btn btn-success rounded-circle shadow">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php
    else:
        echo '<div class="container py-3 text-center">';
            echo '<div class="card p-3 text-start">';
            echo ad_login_form(); 
            echo '</div>';
        echo '</div>';
    endif;

get_footer();