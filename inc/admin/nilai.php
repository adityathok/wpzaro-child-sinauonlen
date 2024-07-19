<?php 
$iduser         = isset($_GET['id']) ? $_GET['id'] : '';
$idpost         = isset($_GET['idpost']) ? $_GET['idpost'] : '';
$userdata       = get_userdata($iduser);
$username       = $userdata?$userdata->display_name:'';
$AdNilaiSiswa   = new AdNilaiSiswa([$iduser => $username]);
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-start">
        <div class="fw-bold">Nilai <?php echo $username;?></div>
        <div>
            <a href="<?php echo $urlpage;?>?pg=nilai&id=<?php echo $iduser;?>&act=add" class="btn btn-sm btn-light">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php 
        if($iduser) {
            if($act=='add') {

                echo '<div class="fw-bold text-primary mb-3">Tambah nilai siswa</div>';
                echo $AdNilaiSiswa->form();

                if(isset($_POST['action']) && $_POST['action'] == 'add') {
                    if ( bp_is_active( 'notifications' ) ) {
                        bp_notifications_add_notification(
                            array(
                                'user_id'          => $iduser,
                                'item_id'          => $idpost,
                                'component_name'   => 'custom',
                                'component_action' => 'custom_action',
                                'date_notified'    => bp_core_current_time(),
                                'is_new'           => 1,
                            )
                        );
                    }
                }

            } elseif ($act=='edit') {

                echo '<div class="text-end mb-2"><a class="btn btn-warning btn-sm" href="'.$urlpage.'?pg=nilai&id='.$iduser.'"> <i class="fa fa-caret-left"></i> Daftar Nilai</a></div>';

                echo '<div class="fw-bold text-primary mb-3">Edit nilai siswa</div>';
                $args = [
                    'ID' => $idpost
                ];
                echo $AdNilaiSiswa->form($args,'edit');

            } else {  
                // The Query
                $args = array(
                    'post_type'         => 'adnilaisiswa',
                    'posts_per_page'    =>-1,
                    'meta_query'        => array(
                        array(
                            'key'     => 'siswa',
                            'value'   => $iduser,
                            'compare' => '=',
                        ),
                    ),
                );
                $the_query = new WP_Query( $args );
                
                // The Loop
                if ( $the_query->have_posts() ) {
                    echo '<div class="list-group list-group-numbered">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        ?>
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <a href="<?php echo get_the_permalink();?>">
                                    <?php echo get_the_title();?>
                                </a>
                            </div>
                            <a class="badge bg-info rounded-pill" href="<?php echo $urlpage;?>?pg=nilai&id=<?php echo $iduser;?>&idpost=<?php echo get_the_ID();?>&act=edit">edit</a>
                        </div>
                        <?php
                    }
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning">belum ada nilai</div>';
                }
                /* Restore original Post Data */
                wp_reset_postdata();
            }
        } else {
            echo '<a class="btn btn-warning w-100 my-5" href="'.$urlpage.'?pg=siswa"> <i class="fa fa-users"></i> Pilih Siswa</a>';
        }
        ?>
    </div>
</div>
