<?php
/**
 * Belajar OOP, mohon maaf.
 * Basic Member Class for Wordpress Memership
 */

class AdMateri {

    public $metakey;
    public $datakelas;

    public function __construct(){
        $this->datakelas = get_option( '_data_kelas', ['Kelas'] );
        $this->metakey  = [
            'post_title'    => [
                'type'      => 'text',
                'title'     => 'Judul',
                'desc'      => 'Judul materi',
                'required'  => true,
            ],
            '_thumbnail_id'=> [
                'type'      => 'featured',
                'title'     => 'Gambar',
                'desc'      => 'Gambar Utama',
                'required'  => false,
            ],
            'post_content'  => [
                'type'      => 'editor',
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
            'mapel' => [
                'type'      => 'taxonomy',
                'title'     => 'Mata Pelajaran',
                'desc'      => '',
                'required'  => false,
            ],
            // 'adtema' => [
            //     'type'      => 'taxonomy',
            //     'title'     => 'Tema',
            //     'desc'      => '',
            //     'required'  => false,
            // ],
            'kelas'=> [
                'type'      => 'checkbox',
                'title'     => 'Kelas',
                'desc'      => 'Pilih Kelas',
                'required'  => true,
                'option'    => $this->datakelas,
            ],
        ];
    }

    public function register_post_type() {

        $args = array(
            'label'                 => __( 'Materi', 'wpzaro' ),
            'description'           => __( 'Materi', 'wpzaro' ),
            'labels'                => [
                'name'                  => _x( 'Materi', 'Post Type General Name', 'wpzaro' ),
                'singular_name'         => _x( 'Materi', 'Post Type Singular Name', 'wpzaro' ),
            ],
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments','author' ),
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

    public function form($args=null,$action=null) {
        $args               = $args?$args:[];
        $args['post_type']  = 'admateri';
        $action             = $action?$action:'add';

        $form   = new AdFrontpost();
        $result = $form->formPost($args,$action,$this->metakey);
    }

    public function delete($id=null) {
        $form       = new AdFrontpost();
        return $form->hapusPost($id);
    }
    
    public function uservisit($user_id=null,$post_id=null) {
        if(!$user_id || !$post_id) return false;

        $getdata = get_user_meta($user_id,'_visit_materi',true);
        $getdata = $getdata?$getdata:[];

        $newdata    = [];
        $newdata[0] = [
            'id'    => $post_id,
            'date'  => date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ),
        ];
        if($getdata):
            foreach(array_slice($getdata, 0, 20) as $key => $value) {
                if(isset($value['id'])&&$value['id']!=$post_id&&get_post_status($post_id)) {
                    $newdata[] = $value;
                }
            }
        endif;

        update_user_meta( $user_id, '_visit_materi', $newdata );

        return get_user_meta($user_id,'_visit_materi',true);

    }

}

$materi = new AdMateri();
$materi->register_post_type();