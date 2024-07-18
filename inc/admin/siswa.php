<?php $adsiswa = new AdSiswa(); ?>

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
                    'key'       => 'kelas',
                    'value'     => $setkelas,
                    'compare'   => '=='
                ];
            }  
            if($setjurusan) {
                $arguser['meta_query'][] = [
                    'key'       => 'jurusan',
                    'value'     => $setjurusan,
                    'compare'   => '=='
                ];
            }
            
            $number = 30; //max display per page
            $paged  = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
            $offset = ($paged - 1) * $number; //page offset
            $users  = get_users($arguser); //get all the lists of users

            $arguser['offset'] = $offset;
            $arguser['number'] = $number;

            $getusers = get_users( $arguser );

            // Array of WP_User objects.
            if($getusers) {
                ?>
                <div class="list-users">
                    <?php foreach( $getusers as $user): ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span data-bs-toggle="modal" data-bs-target="#UserModal-<?php echo $user->ID; ?>" data-id="<?php echo $user->ID; ?>" class="openmodaluser d-flex">
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
                            </span>
                            <a href="<?php echo bp_members_get_user_url($current_id);?>messages/compose/?r=<?php echo $user->user_login; ?>">
                                <i class="fa fa-commenting-o"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php 
                //pagination
                $total_users = count($users);//count total users
                $total_query = count($getusers);//count the maximum displayed users                
                $total_pages = ($total_users / $number); // get the total pages by dividing the total users to the maximum numbers of user to be displayed
                //Check if the total pages has a decimal we will add + 1 page
                $total_pages = is_float($total_pages) ? intval($total_users / $number) + 1 : intval($total_users / $number);
                if ($total_users > $total_query) {                    
                    $current_page = max(1, get_query_var('paged'));
                    $big = 999999999; // need an unlikely integer
                    wpzaro_pagination(array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => 'page/%#%/',
                        'current'   => $current_page,
                        'total'     => $total_pages
                    ) );
                } 
                ?>

                <!-- loop modal user -->
                <?php foreach( $getusers as $user): ?>                    
                    <!-- Modal <?php echo $user->ID; ?> -->
                    <div class="modal fade" id="UserModal-<?php echo $user->ID; ?>" tabindex="-1" aria-labelledby="userModalLabelUserModal-<?php echo $user->ID; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabelUserModal-<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="user-avatar mx-auto text-center mb-3">
                                        <img src="<?php echo adget_url_ava($user->ID,'full'); ?>" class="img-fluid rounded-circle" alt="">
                                    </div>

                                    <ul class="nav nav-tabs tabs-collapse" data-id="<?php echo $user->ID; ?>">
                                        <li class="nav-item flex-fill">
                                            <span class="nav-link active" data-target="profile-<?php echo $user->ID; ?>">Profil</span>
                                        </li>
                                        <li class="nav-item flex-fill">
                                            <span class="nav-link" data-target="nilai-<?php echo $user->ID; ?>">Nilai</span>
                                        </li>
                                    </ul>
                                    <div class="data-tabs-collapse" data-id="<?php echo $user->ID; ?>">
                                        <div id="profile-<?php echo $user->ID; ?>" class="collapse show py-3">                                        
                                            <?php echo $adsiswa->view($user->ID); ?>
                                        </div>
                                        <div id="nilai-<?php echo $user->ID; ?>" class="collapse py-3">                                        
                                            Nilai
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <a href="<?php echo $urlpage;?>?pg=nilai&id=<?php echo $user->ID;?>" class="btn btn-danger"> <i class="fa fa-plus"></i> Nilai</a>
                                    <a href="<?php echo bp_members_get_user_url($user->ID);?>" class="btn btn-secondary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

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

<script>
    jQuery(document).ready(function($) {
        $('.tabs-collapse .nav-link').on('click', function() {
            var id = $(this).parents().parents().data('id');
            $('.tabs-collapse[data-id="'+id+'"]').find('.nav-link').removeClass('active');
            $(this).addClass('active');
            $('.data-tabs-collapse[data-id="'+id+'"]').find('.collapse').removeClass('show');
            $('.data-tabs-collapse[data-id="'+id+'"]').find('#'+$(this).data('target')).addClass('show');
        });
        $('.openmodaluser').on('click', function() {
            var id = $(this).data('id');
            if($('#nilai-'+id+' .list-nilai-'+id).length === 0) {
                $('#nilai-'+id).html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                jQuery.ajax({
                    type    : "POST",
                    url     : themepath.ajaxUrl,
                    data    : {action:'listnilaisiswa', iduser:id },
                    success :function(data) {  
                        $('#nilai-'+id).html(data);
                    },
                });
            }
        });
    });
</script>