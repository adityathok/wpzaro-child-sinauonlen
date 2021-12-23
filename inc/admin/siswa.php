<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-start">
        <div class="fw-bold">Siswa</div>
        <div>
            <span class="btn btn-sm btn-light mr-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fa fa-filter"></i>
            </span>
            <a href="<?php echo $urlpage;?>?pg=siswa&act=add" class="btn btn-sm btn-light">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if($act=='add') {

            echo '<div class="fw-bold text-primary mb-3">Tambah siswa</div>';
            $siswa = new AdSiswa();
            echo $siswa->form();

        } else {           
    
            $datajurusan    = get_option( '_data_jurusan', ['Jurusan'] );
            $datakelas      = get_option( '_data_kelas', ['Kelas'] );
            $setkelas       = isset($_GET['setkelas'])?$_GET['setkelas']:'';
            $setjurusan     = isset($_GET['setjurusan'])?$_GET['setjurusan']:'';

            $arguser = [
                'role__in' => array( 'siswa'),
            ];

            if($setkelas) {
                $arguser['meta_query'][] = [
                    'key' => 'kelas',
                    'value' => $setkelas,
                    'compare' => '=='
                ];
            }  
            if($setjurusan) {
                $arguser['meta_query'][] = [
                    'key' => 'jurusan',
                    'value' => $setjurusan,
                    'compare' => '=='
                ];
            }

            $getusers = get_users( $arguser );

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
                                    <div class="user-kelas text-muted">
                                        <small><?php echo $user->kelas; ?></small>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo bp_core_get_user_domain($current_id);?>messages/compose/?r=<?php echo $user->user_login; ?>">
                                <i class="fa fa-commenting-o"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php } ?>

            <!-- Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="" method="GET" class="modal-content">
                        <input type="hidden" name="pg" value="<?php echo $pg;?>">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-select" name="setkelas" aria-label="Default select example">
                                    <option value="">Semua Kelas</option>
                                    <?php foreach( $datakelas as $value): ?>
                                        <option value="<?php echo $value;?>" <?php echo selected($setkelas,$value);?>><?php echo $value;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            
       <?php } ?>
    </div>
</div>