<?php
add_action('wp_ajax_deleteadmateri', 'deleteadmateri_ajax');
function deleteadmateri_ajax() {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    
    if(current_user_can('administrator') || current_user_can('guru')):
        $materi = new AdMateri();
        $materi->delete($id);
    endif;

    wp_die();
}

add_action('wp_ajax_deleteadfrontpostfile', 'deleteadfrontpostfile_ajax');
function deleteadfrontpostfile_ajax() {
    $idpost     = isset($_POST['idpost']) ? $_POST['idpost'] : '';
    $idfile     = isset($_POST['idfile']) ? $_POST['idfile'] : '';
    $metaname   = isset($_POST['metaname']) ? $_POST['metaname'] : '';
    
    if(current_user_can('administrator') || current_user_can('guru')):
        wp_delete_attachment( $idfile );
        delete_post_meta($idpost, $metaname, $idfile);
    endif;

    wp_die();
}

add_action('wp_ajax_absenpost', 'absenpost_ajax');
function absenpost_ajax() {
    $idpost     = isset($_POST['idpost']) ? $_POST['idpost'] : '';
    $posttype   = isset($_POST['posttype']) ? $_POST['posttype'] : '';
    $date       = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
    
    if($idpost):        
        $AdAbsenPost = new AdAbsenPost();
        $AdAbsenPost->add(get_current_user_id(),$idpost,$posttype,$date);
    endif;

    wp_die();
}