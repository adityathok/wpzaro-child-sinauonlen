<?php
add_action('wp_footer','add_offcanvas_menuheader');
function add_offcanvas_menuheader(){
    if(is_user_logged_in()):
        $current_id     = get_current_user_id();
        $linkprofile    = bp_core_get_user_domain( $current_id );
        $arraymenu      = [
            'profile' => [
                'title' => 'Profile',
                'url'   => $linkprofile,
                'icon'  => 'fa fa-user',
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
            'forums' => [
                'title' => 'Forum',
                'url'   => $linkprofile.'forum/',
                'icon'  => 'fa fa-users',
            ],
            'setting' => [
                'title' => 'Settings',
                'url'   => $linkprofile.'settings/',
                'icon'  => 'fa fa-gear',
            ],
            'admin' => [
                'title' => 'Admin',
                'url'   => home_url().'/admin-settings/',
                'icon'  => 'fa fa-gears',
                'submenu' => [                    
                    'opt-kelas' => [
                        'title' => 'Kelas',
                        'url'   => home_url().'/admin-settings/?pg=kelas',
                        'icon'  => 'fa fa-group',
                    ],
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
    <div class="offcanvas-body p-0">
        <ul class="list-group list-group-offcanvas-header">
            <?php
            foreach ($arraymenu as $key => $value) {
                $submenu = isset($value['submenu'])?$value['submenu']:'';
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <a href="<?php echo $value['url']; ?>" class="d-block">
                        <i class="<?php echo $value['icon']; ?>" aria-hidden="true"></i>
                        <?php echo $value['title']; ?>
                    </a>
                    <?php if($submenu): ?>
                        <span class="btn btn-sm btn-light pull-right">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    <?php endif; ?>
                </li>

                <?php if($submenu): ?>
                    <?php foreach ($submenu as $key => $value) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start" data-parent="<?php echo $key; ?>">
                            <a href="<?php echo $value['url']; ?>" class="d-block">
                                <i class="<?php echo $value['icon']; ?>" aria-hidden="true"></i>
                                <?php echo $value['title']; ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php endif; ?>
                <?php
            }
            ?>
        </ul>
    </div>
    </div>
    <?php
}