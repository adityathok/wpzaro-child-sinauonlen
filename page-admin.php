<?php
/**
 * Template Name: Admin settings Template
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
$current_id = get_current_user_id();
$urlpage    = get_the_permalink();
      
$arraymenu      = [
    'kelas' => [
        'title' => 'Kelas',
        'url'   => $urlpage.'?pg=kelas',
        'icon'  => 'fa fa-vcard',
    ],
    'register' => [
        'title' => 'Daftar',
        'url'   => get_home_url().'/register',
        'icon'  => 'fa fa-pencil-square',
    ],
];

?>

    <div class="container py-3">
        <?php if(is_user_logged_in()):
            
            switch ($pg) {
                case "kelas":
                    require_once('inc/admin/kelas.php');
                    break;
                default:
                ?>
                    <div class="card shadow-sm border-0">
                        <div class="list-group-adminsetting">
                            <?php echo listmenugroup($arraymenu); ?>
                        </div>
                    </div>
                <?php
             }

        endif; ?>
    </div>

<?php
get_footer();
