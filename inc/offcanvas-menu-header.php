<?php
add_action('wp_footer','add_offcanvas_menuheader');
function add_offcanvas_menuheader(){
    if(is_user_logged_in()):
        $current_id     = get_current_user_id();
        $linkprofile    = bp_core_get_user_domain( $current_id );
        $arraymenu      = [
            'profile' => [
                'title' => 'Profile',
                'url'   => $linkprofile.'profile/',
                'icon'  => 'fa fa-user',
                'submenu' => [ 
                    'editprofile' => [
                        'title' => 'Edit',
                        'url'   => $linkprofile.'profile/edit/',
                        'icon'  => 'fa fa-pencil-square-o',
                    ],
                    'setting' => [
                        'title' => 'Settings',
                        'url'   => $linkprofile.'settings/',
                        'icon'  => 'fa fa-gear',
                    ],
                ]
            ],
            'materi' => [
                'title' => 'Materi',
                'url'   => home_url().'/materi/',
                'icon'  => 'fa fa-pencil-square-o',
            ],
            'nilai' => [
                'title' => 'Nilai',
                'url'   => home_url().'/nilaisiswa/',
                'icon'  => 'fa fa-pencil-square-o',
                'role'  => 'siswa',
            ],
            'notif' => [
                'title' => 'Notifikasi',
                'url'   => $linkprofile.'notifications/',
                'icon'  => 'fa fa-bell',
            ],
            'message' => [
                'title' => 'Pesan',
                'url'   => $linkprofile.'messages/',
                'icon'  => 'fa fa-comment',
            ],
            'admin' => [
                'title' => 'Admin',
                'url'   => home_url().'/admin-settings/',
                'icon'  => 'fa fa-gears',
                'role'  => 'administrator',
                'submenu' => [                   
                    'opt-guru' => [
                        'title' => 'Guru',
                        'url'   => home_url().'/admin-settings/?pg=guru',
                        'icon'  => 'fa fa-user-circle',
                    ],                  
                    'opt-siswa' => [
                        'title' => 'Siswa',
                        'url'   => home_url().'/admin-settings/?pg=siswa',
                        'icon'  => 'fa fa-user-circle-o',
                    ],                       
                    'opt-kelas' => [
                        'title' => 'Kelas',
                        'url'   => home_url().'/admin-settings/?pg=kelas',
                        'icon'  => 'fa fa-vcard',
                    ],                        
                    'opt-mapel' => [
                        'title' => 'Mata Pelajaran',
                        'url'   => home_url().'/admin-settings/?pg=mapel',
                        'icon'  => 'fa fa-tasks',
                    ],                  
                    // 'opt-jurusan' => [
                    //     'title' => 'Jurusan',
                    //     'url'   => home_url().'/admin-settings/?pg=jurusan',
                    //     'icon'  => 'fa fa-language',
                    // ],
                ]
            ],
            'logout' => [
                'title' => 'Logout',
                'url'   => wp_logout_url(home_url()),
                'icon'  => 'fa fa-sign-out',
            ],
        ];

    else:        
        $arraymenu      = [
            'login' => [
                'title' => 'Login',
                'url'   => get_home_url().'/login',
                'icon'  => 'fa fa-sign-in',
            ],
            'register' => [
                'title' => 'Daftar',
                'url'   => get_home_url().'/register',
                'icon'  => 'fa fa-pencil-square',
            ],
        ];
    endif;
    ?>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenuHeader" aria-labelledby="offcanvasMenuHeaderlabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasMenuHeaderlabel">
            <?php bp_displayed_user_username(); ?>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 list-group-offcanvas-header">
        <?php echo listmenugroup($arraymenu); ?>
    </div>
    </div>
    <?php
}