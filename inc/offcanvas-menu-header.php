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
        <div class="list-group list-group-offcanvas-header">
            <?php
            foreach ($arraymenu as $key => $value) {
                $submenu = isset($value['submenu'])?$value['submenu']:'';
                ?>
                <a href="<?php echo $value['url']; ?>" class="list-group-item rounded-0">
                    <i class="<?php echo $value['icon']; ?>" aria-hidden="true"></i>
                    <?php echo $value['title']; ?>
                </a>

                <?php if($submenu): ?>
                    <?php foreach ($submenu as $key => $value) { ?>
                        <a href="<?php echo $value['url']; ?>" class="list-group-item rounded-0" data-parent="<?php echo $key; ?>">
                            <i class="<?php echo $value['icon']; ?>" aria-hidden="true"></i>
                            <?php echo $value['title']; ?>
                        </a>
                    <?php } ?>
                <?php endif; ?>
                <?php
            }
            ?>
        </div>
    </div>
    </div>
    <?php
}