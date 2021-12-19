<?php 
$keymeta = '_data_jurusan';

if(isset($_POST['jurusan']) && isset($_POST['sesiform']) && $_POST['sesiform'] == $_SESSION['sesiform']) {
    $datajurusan = [];
    foreach ($_POST['jurusan'] as $key => $value) {
        $datajurusan[] = $value;
    }
    update_option( $keymeta, $datajurusan ); 
    $_SESSION['sesiform'] = uniqid();
    echo '<div class="alert alert-success" role="alert"> Data berhasil disimpan ! </div>';
}

$datajurusan  = get_option( $keymeta, ['jurusan'] );

if(!isset($_SESSION['sesiform']) || empty($_SESSION['sesiform'])) {
    $_SESSION['sesiform'] = uniqid();
}
$sesiform   = $_SESSION['sesiform'];
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white">
        <div class="fw-bold">Jurusan</div>
    </div>
    <div class="card-body">
        <form action="" method="post" class="form-jurusan-opt">
            <div class="list-jurusan-opt">
                <?php foreach( $datajurusan as $key => $value): ?>
                    <div class="input-group mb-2" id="datajurusan-<?php echo $key; ?>">
                        <input type="text" class="form-control" placeholder="Nama jurusan" name="jurusan[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                        <span class="input-group-text text-danger btn-delete"> <i class="fa fa-times"></i> </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="sesiform" value="<?php echo $sesiform; ?>">
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-add">Tambah jurusan <i class="fa fa-plus"></i></button>
                <button type="submit" class="btn btn-success btn-save">Simpan <i class="fa fa-save"></i> </button>
            </div>
        </form>
    </div>
</div>

<script>
    jQuery(document).ready(function($){
        $(document).on('click','.btn-delete',function() {
            var id = $(this).parent().attr('id');
            $('#'+id).remove();
        });
        $('.btn-add').click(function(){
            var clone = $('#datajurusan-0').clone();
            var number = Math.floor(Math.random()*1000);
            clone.attr('id', 'datajurusan-'+number);
            clone.find('input').val('').attr('name', 'jurusan['+number+']');
            clone.appendTo('.list-jurusan-opt');
        });
    });
</script>