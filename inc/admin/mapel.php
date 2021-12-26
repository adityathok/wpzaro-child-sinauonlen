<?php 
$keymeta = '_data_mapel';

if(isset($_POST['mapel']) && isset($_POST['sesiform']) && $_POST['sesiform'] == $_SESSION['sesiform']) {
    $datamapel = [];
    foreach ($_POST['mapel'] as $key => $value) {
        $datamapel[] = $value;
    }
    update_option( $keymeta, $datamapel ); 
    $_SESSION['sesiform'] = uniqid();
    echo '<div class="alert alert-success" role="alert"> Data berhasil disimpan ! </div>';
}

$datamapel  = get_option( $keymeta, ['mapel'] );

if(!isset($_SESSION['sesiform']) || empty($_SESSION['sesiform'])) {
    $_SESSION['sesiform'] = uniqid();
}
$sesiform   = $_SESSION['sesiform'];
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-secondary text-white">
        <div class="fw-bold">mapel</div>
    </div>
    <div class="card-body">
        <form action="" method="post" class="form-mapel-opt">
            <div class="list-mapel-opt">
                <?php foreach( $datamapel as $key => $value): ?>
                    <div class="input-group mb-2" id="datamapel-<?php echo $key; ?>">
                        <input type="text" class="form-control" placeholder="Nama mapel" name="mapel[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                        <span class="input-group-text text-danger btn-delete"> <i class="fa fa-times"></i> </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="sesiform" value="<?php echo $sesiform; ?>">
            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-secondary btn-sm btn-add">Tambah mapel <i class="fa fa-plus"></i></button>
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
            var clone = $('#datamapel-0').clone();
            var number = Math.floor(Math.random()*1000);
            clone.attr('id', 'datamapel-'+number);
            clone.find('input').val('').attr('name', 'mapel['+number+']');
            clone.appendTo('.list-mapel-opt');
        });
    });
</script>