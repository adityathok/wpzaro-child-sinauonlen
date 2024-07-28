<?php            
$AdAbsenPost    = new AdAbsenPost();
$dataabsen      = $AdAbsenPost->fetch("post_id = ".get_the_ID()."");

if (isset($_GET['delete_nonce']) && isset($_GET['idhapus']) && wp_verify_nonce($_GET['delete_nonce'], 'deletepresensi')) {
    $AdAbsenPost->delete($_GET['idhapus']);
    echo '<div class="alert alert-success">Presensi dihapus</div>';
}

?>
<?php if($dataabsen): ?>
    <div class="table-responsive bg-white">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach( $dataabsen as $key => $value): ?>

                <?php if(isset($_GET['idhapus']) && $value->id==$_GET['idhapus'] ) { continue; } ?>

                <tr class="tr-<?php echo $value->id;?>">
                    <td><?php echo $key+1;?></td>
                    <td>
                        <div> <?php echo get_userdata($value->user_id)->display_name; ?> </div>  
                        <span class="badge bg-danger"><?php echo $value->date; ?></span>                                      
                    </td>
                    <td>
                        <?php echo get_user_meta($value->user_id,'kelas',true); ?>
                    </td>
                    <td class="text-end">
                        <a href="<?php echo wp_nonce_url( get_the_permalink().'/?showpresensi=true&idhapus='.$value->id, 'deletepresensi','delete_nonce' ) ;?>" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>