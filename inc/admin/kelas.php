<?php 
$keymeta = '_data_kelas';

if(isset($_POST['kelas']) && isset($_POST['sesiform']) && $_POST['sesiform'] == $_SESSION['sesiform']) {
    $datakelas = [];
    foreach ($_POST['kelas'] as $key => $value) {
        $datakelas[] = $value;
    }
    update_option( $keymeta, $datakelas ); 
    $_SESSION['sesiform'] = uniqid();
    echo '<div class="alert alert-success" role="alert"> Data berhasil disimpan ! </div>';
}

$datakelas  = get_option( $keymeta, ['Kelas'] );

if(!isset($_SESSION['sesiform']) || empty($_SESSION['sesiform'])) {
    $_SESSION['sesiform'] = uniqid();
}
$sesiform   = $_SESSION['sesiform'];
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white">
        <div class="fw-bold">Kelas</div>
    </div>
    <div class="card-body">
        <form action="" method="post" class="form-kelas-opt">
            <div class="list-kelas-opt">
                <?php foreach( $datakelas as $key => $value): ?>
                    <div class="input-group mb-2" id="datakelas-<?php echo $key; ?>">
                        <input type="text" class="form-control" placeholder="Nama Kelas" name="kelas[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                        <span class="input-group-text text-danger btn-delete"> <i class="fa fa-times"></i> </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="sesiform" value="<?php echo $sesiform; ?>">
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-add">Tambah Kelas <i class="fa fa-plus"></i></button>
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
            var clone = $('#datakelas-0').clone();
            var number = Math.floor(Math.random()*1000);
            clone.attr('id', 'datakelas-'+number);
            clone.find('input').val('').attr('name', 'kelas['+number+']');
            clone.appendTo('.list-kelas-opt');
        });
    });
</script>