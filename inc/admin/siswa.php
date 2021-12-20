<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-start">
        <div class="fw-bold">Siswa</div>
        <a href="<?php echo $urlpage;?>?pg=siswa&act=add" class="text-white">
            <i class="fa fa-plus-circle"></i>
        </a>
    </div>
    <div class="card-body">
        <?php if($act=='add') {
            echo '<div class="fw-bold text-primary mb-3">Tambah siswa</div>';
            $siswa = new AdSiswa();
            echo $siswa->form();
        } else {           
    
            $getusers = get_users( array( 
                'role__in' => array( 'siswa'),
            ) );
            // Array of WP_User objects.
            if($getusers) {
                ?>
                <div class="list-users">
                    <?php foreach( $getusers as $user): ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <a href="<?php echo bp_core_get_user_domain($user->ID);?>" class="d-flex">
                                <div class="user-avatar me-2">
                                    <img src="<?php echo adget_url_ava($user->ID); ?>" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="user-info">
                                    <div class="user-name">
                                        <?php echo $user->display_name; ?>
                                    </div>
                                    <div class="user-email text-muted">
                                        <small><?php echo $user->user_email; ?></small>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo bp_core_get_user_domain($current_id);?>messages/compose/?r=<?php echo $user->user_login; ?>">
                                <i class="fa fa-commenting-o"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php
            }
            
        } ?>
    </div>
</div>