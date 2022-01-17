<?php 
if(isset($_POST['mapel']) && isset($_POST['sesiform']) && $_POST['sesiform'] == $_SESSION['sesiform']) {
    foreach ($_POST['mapel'] as $key => $value) {
        if(!empty($_POST['id'][$key])) {
            if(isset($_POST['remove'][$key]) && !empty($_POST['remove'][$key])) {
                wp_delete_term( $_POST['id'][$key], 'mapel' );
            } else {
                wp_update_term($_POST['id'][$key], 'mapel', ['name' => $value]);
            }
        } else {
            $term = wp_insert_term($value,'mapel');
        }
    }
    $_SESSION['sesiform'] = uniqid();
    echo '<div class="alert alert-success" role="alert"> Data berhasil disimpan ! </div>';
}

$getdatamapel = get_terms( array(
    'taxonomy' => 'mapel',
    'hide_empty' => false
) );
$datamapel = $getdatamapel?$getdatamapel:[
    (object) [
        'term_id' => '0',
        'name' => '',
        'slug' => '',
        'term_group' => '',
        'term_taxonomy_id' => '',
        'taxonomy' => '',
        'description' => '',
        'parent' => '',
        'count' => '',
        'filter' => 'raw'
    ]
];

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
                <?php $nm = 0; ?>
                <?php foreach( $datamapel as $term): ?>
                    <?php 
                        $term_id    = $term->term_id;
                        $term_name  = $term->name;
                    ?>
                    <div class="input-group mb-2 listmapel-<?php echo $nm; ?>" id="datamapel-<?php echo $term_id; ?>" data-id="<?php echo $term_id; ?>">
                        <input type="text" class="form-control input-mapel" placeholder="Nama mapel" name="mapel[<?php echo $term_id; ?>]" value="<?php echo $term_name; ?>">
                        <span class="input-group-text text-danger btn-delete"> <i class="fa fa-times"></i> </span>
                        <input class="input-id-mapel" type="hidden" name="id[<?php echo $term_id; ?>]" value="<?php echo $term_id; ?>">
                    </div>
                    <?php $nm++; ?>
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
            var dataid = $(this).parent().data('id');
            $('#'+id).hide(500);
            $('#'+id).append('<input class="remove-id-mapel" type="hidden" name="remove['+dataid+']" value="'+dataid+'">');
        });
        $('.btn-add').click(function(){
            var clone = $('.listmapel-0').clone();
            var number = Math.floor(Math.random()*100000);
            clone.attr('id', 'datamapel-'+number);
            clone.attr('data-id', 'datamapel-'+number);
            clone.find('.input-mapel').val('').attr('name', 'mapel['+number+']');
            clone.find('.input-id-mapel').val('').attr('name', 'id['+number+']');
            clone.find('.remove-id-mapel').remove();
            clone.removeClass('listmapel-0').addClass('listmapel-'+number);
            clone.appendTo('.list-mapel-opt');
            $('#datamapel-'+number).show(500);
        });
    });
</script>