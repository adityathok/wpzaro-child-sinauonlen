<?php
add_action('wp_ajax_deleteadmateri', 'deleteadmateri_ajax');
function deleteadmateri_ajax() {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    
    $materi = new AdMateri();
    $materi->delete($id);

    wp_die();
}