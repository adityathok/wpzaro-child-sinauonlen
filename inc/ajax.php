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