<?php
/**
 * Belajar OOP, mohon maaf.
 * Basic Member Class for AdNilaiSiswa
 */

class AdNilaiSiswa {

    public $metakey;
    public $siswa;

    public function __construct($siswa=null){
        $this->siswa    = $siswa;
        $this->metakey  = [
            'siswa'=> [
                'type'      => 'option',
                'title'     => 'Siswa',
                'desc'      => '',
                'required'  => true,
                'option'    => $siswa
            ],
            'post_title'    => [
                'type'      => 'text',
                'title'     => 'Judul',
                'desc'      => 'Judul Nilai',
                'required'  => true,
            ],
            'post_content'  => [
                'type'      => 'textarea',
                'title'     => 'Deskripsi',
                'desc'      => '',
                'required'  => false,
            ],
            'file_add'=> [
                'type'      => 'file',
                'title'     => 'Lampiran',
                'desc'      => 'File lampiran',
                'required'  => false,
            ],
        ];
    }

    public function register_post_type() {

        $args = array(
            'label'                 => __( 'Nilai Siswa', 'wpzaro' ),
            'description'           => __( 'Nilai Siswa', 'wpzaro' ),
            'labels'                => [
                'name'                  => _x( 'Nilai Siswa', 'Post Type General Name', 'wpzaro' ),
                'singular_name'         => _x( 'Nilai Siswa', 'Post Type Singular Name', 'wpzaro' ),
            ],
            'supports'              => array( 'title', 'editor'),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => false,
            'capability_type'       => 'page',
        );
        register_post_type( 'adnilaisiswa', $args );

    }

    public function form($args=null,$action=null) {
        $args               = $args?$args:[];
        $args['post_type']  = 'adnilaisiswa';
        $action             = $action?$action:'add';

        $form   = new AdFrontpost();
        $result = $form->formPost($args,$action,$this->metakey);
    }
    
    public function delete($id=null) {
        $form       = new AdFrontpost();
        return $form->hapusPost($id);
    }
}

$AdNilaiSiswa = new AdNilaiSiswa();
$AdNilaiSiswa->register_post_type();