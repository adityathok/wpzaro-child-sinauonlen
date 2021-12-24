<?php
/**
 * Belajar OOP, mohon maaf.
 * Basic Member Class for Wordpress Memership
 */

class AdMateri {

    public function __construct(){

    }

    public function register_post_type() {

            $args = array(
                'label'                 => __( 'Materi', 'wpzaro' ),
                'description'           => __( 'Materi', 'wpzaro' ),
                'labels'                => [
                    'name'                  => _x( 'Materi', 'Post Type General Name', 'wpzaro' ),
                    'singular_name'         => _x( 'Materi', 'Post Type Singular Name', 'wpzaro' ),
                ],
                'supports'              => array( 'title', 'editor', 'thumbnail', 'comments' ),
                'taxonomies'            => array( 'category', 'post_tag' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
            );
            register_post_type( 'admateri', $args );

    }
}

$materi = new AdMateri();
$materi->register_post_type();