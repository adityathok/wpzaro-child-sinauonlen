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
$act        = isset($_GET['act']) ? $_GET['act'] : '';
$current_id = get_current_user_id();
$urlpage    = get_the_permalink();
      
$arraymenu      = [
    'guru' => [
        'title' => 'Guru',
        'url'   => $urlpage.'?pg=guru',
        'icon'  => 'fa fa-user-circle',
    ],
    'siswa' => [
        'title' => 'Siswa',
        'url'   => $urlpage.'?pg=siswa',
        'icon'  => 'fa fa-user-circle-o',
    ],
    'kelas' => [
        'title' => 'Kelas',
        'url'   => $urlpage.'?pg=kelas',
        'icon'  => 'fa fa-vcard',
    ],
    'jurusan' => [
        'title' => 'Jurusan',
        'url'   => $urlpage.'?pg=jurusan',
        'icon'  => 'fa fa-language',
    ],
];

?>

    <div class="container py-3">
        <?php if(is_user_logged_in() && current_user_can('administrator')):
            
            switch ($pg) {
                case "guru":
                    require_once('inc/admin/guru.php');
                    break;
                case "kelas":
                    require_once('inc/admin/kelas.php');
                    break;
                case "jurusan":
                    require_once('inc/admin/jurusan.php');
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
