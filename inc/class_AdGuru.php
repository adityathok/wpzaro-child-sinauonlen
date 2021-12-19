<?php
/**
 * Belajar OOP, mohon maaf.
 * Basic Member Class for Wordpress Memership
 */

class AdGuru {

    public $form;

    public $metakey = [
        'user_login'    => [
            'type'      => 'text',
            'title'     => 'Username',
            'desc'      => 'id unik pengguna, tanpa spasi dan tanda baca',
            'required'  => true,
        ],
        'first_name'    => [
            'type'      => 'text',
            'title'     => 'Nama',
            'desc'      => 'Nama Lengkap',
            'required'  => false,
        ],
        'user_email'    => [
            'type'      => 'email',
            'title'     => 'Email',
            'desc'      => '',
            'required'  => true,
        ],
        'jenis_kelamin' => [
            'type'      => 'option',
            'title'     => 'Jenis Kelamin',
            'desc'      => '',
            'required'  => false,
            'option'    => [
                'Laki-laki' => 'Laki-laki',
                'Perempuan' => 'Perempuan',
            ],
        ],
        'tempat_lahir'  => [
            'type'      => 'text',
            'title'     => 'Tempat Lahir',
            'desc'      => '',
            'required'  => false,
        ],
        'tanggal_lahir'  => [
            'type'      => 'date',
            'title'     => 'Tanggal Lahir',
            'desc'      => '',
            'default'   => '2000-01-01',
            'required'  => false,
        ],
        'nohp'     => [
            'type'      => 'text',
            'title'     => 'Nomor Handphone',
            'desc'      => '',
            'required'  => false,
        ],
        'alamat'        => [
            'type'      => 'textarea',
            'title'     => 'Alamat',
            'desc'      => '',
            'required'  => false,
        ],
        'bio'            => [
            'type'      => 'textarea',
            'title'     => 'Bio',
            'required'  => false,
        ],
    ];


    public function form($args=null,$action=null) {

        $args           = $args?$args:[];
        $args['role']   = 'guru';
        $action         = $action?$action:'add';

        $form           = new AdMember();
        $result         = $form->formMember($args,$action,$this->metakey);

        print_r($result);

        if($result['success']==true) {
            echo $result['message'];
        } else {
            echo $result['message'];
        }

    }

}