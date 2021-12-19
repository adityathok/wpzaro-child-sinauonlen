<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-start">
        <div class="fw-bold">Guru</div>
        <a href="<?php echo $urlpage;?>?pg=guru&act=add" class="text-white">
            <i class="fa fa-plus-circle"></i>
        </a>
    </div>
    <div class="card-body">
        <?php if($act=='add') {
            $guru = new AdGuru();
            $guru->form();
        } else {           
    
            $getusers = get_users( array( 
                'role__in' => array( 'guru'),
            ) );
            // Array of WP_User objects.
            if($getusers) {
                ?>
                <div class="list-users">
                    <?php foreach( $getusers as $user): ?>
                        <?php print_r($user); ?>
                    <?php endforeach; ?>
                </div>
                <?php
            }
            
        } ?>
    </div>
</div>