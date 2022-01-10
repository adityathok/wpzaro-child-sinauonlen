<?php
/**
 * Belajar OOP, mohon maaf.
 * Basic Member Class for AdNilaiSiswa
 */

class AdNilaiSiswa {

    public $metakey;
    public $siswa;

    public function __construct($siswa=null){
        $this->name     = $siswa;
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
            'publicly_queryable'    => true,
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


function adnilaisiswa_published_notification( $post_id, $post ) {
    $author_id  = $post->post_author;
    $siswaid    = get_post_meta($post_id,'siswa',true);
    if ( bp_is_active( 'notifications' ) ) {
        bp_notifications_add_notification(
            array(
                'user_id'          => $siswaid,
                'item_id'          => $post_id,
                'component_name'   => 'custom',
                'component_action' => 'custom_action',
                'date_notified'    => bp_core_current_time(),
                'is_new'           => 1,
            )
        );
    }
}
add_action( 'publish_adnilaisiswa', 'adnilaisiswa_published_notification', 10, 2 );