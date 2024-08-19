<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sinauonlen_admateri_custom_query( $query ) {

    if ( is_archive() && is_post_type_archive( 'admateri' )  && $query->is_main_query() || is_tax() && $query->is_main_query() ) {
        
        if(isset($_GET['setmapel']) && $_GET['setmapel']){
            $query->set( 'tax_query', array(
                array(
                    'taxonomy' => 'mapel',
                    'field'    => 'term_id',
                    'terms'    => $_GET['setmapel'],
                )
            ));
        }

        //metaquery
        $metaquery = array();

        if(current_user_can('guru') || current_user_can('siswa')) {
            $kelas  = get_user_meta(get_current_user_id(), 'kelas', true);

            foreach ($kelas as $kls) {
                $kls  = '"'.$kls.'"';
                $metaquery[] = array(
                    'key'       => 'kelas',
                    'value'     => $kls,
                    'compare'   => 'Like',
                );
            }

        }
        
        if(isset($_GET['setkelas']) && $_GET['setkelas']){
            $kls  = '"'.$_GET['setkelas'].'"';
            $metaquery[] = array(
                'key'       => 'kelas',
                'value'     => $kls,
                'compare'   => 'Like',
            );
        }
        
        //if count metaquery more than 1, then set metaquery
        if(count($metaquery)>1){
            $metaquery['relation'] = 'OR';
        }

        if($metaquery) {
            $query->set( 'meta_query', $metaquery);
        }

    }

}
add_filter( 'pre_get_posts', 'sinauonlen_admateri_custom_query' );