<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sinauonlen_admateri_custom_query( $query ) {

    if ( is_archive() && is_post_type_archive( 'admateri' )  && $query->is_main_query() || is_tax() && $query->is_main_query() ) {
        
        if(current_user_can('guru')) {
            $include_kelas  = get_user_meta(get_current_user_id(), 'kelas', true);
            $datakelas      = get_option( '_data_kelas', ['Kelas'] );
            $exclude_kelas  = array_diff( $datakelas, $include_kelas );

            // print_r($include_kelas);
            // print_r($exclude_kelas);

            // $query->set( 'author', get_current_user_id());
            $query->set( 'meta_query', array(
                // array(
                //     'key'       => 'kelas',
                //     'value'     => $kls,
                //     'compare'   => 'Like'
                // )
                'relation' => 'AND',
                // array(
                //     'key' => 'kelas',
                //     'value' => $include_kelas,
                //     'compare' => 'IN'
                // ),
                array(
                    'key' => 'kelas',
                    'value' => $exclude_kelas,
                    'compare' => 'NOT IN'
                )
            ));
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

        if(isset($_GET['setkelas']) && $_GET['setkelas']){
            $query->set( 'meta_query', array(
                array(
                    'key'       => 'kelas',
                    'value'     => $_GET['setkelas'],
                    'compare'   => 'like'
                )
            ));
        }

        if(isset($_GET['setmapel']) && $_GET['setmapel']){
            $query->set( 'tax_query', array(
                array(
                    'taxonomy' => 'mapel',
                    'field'    => 'term_id',
                    'terms'    => $_GET['setmapel'],
                )
            ));
        }

    }

}
add_filter( 'pre_get_posts', 'sinauonlen_admateri_custom_query' );