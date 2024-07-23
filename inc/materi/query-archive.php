<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sinauonlen_admateri_custom_query( $query ) {

    if ( is_archive() && is_post_type_archive( 'admateri' )  && $query->is_main_query() || is_tax() && $query->is_main_query() ) {
        
        if(current_user_can('guru')) {
            $query->set( 'author', get_current_user_id());
        }
        
        if(current_user_can('siswa')) {
            $query->set( 'meta_query', array(
                array(
                    'key'       => 'kelas',
                    'value'     => get_user_meta(get_current_user_id(), 'kelas', true),
                    'compare'   => 'like'
                )
            ));
        }

    }

}
add_filter( 'pre_get_posts', 'sinauonlen_admateri_custom_query' );