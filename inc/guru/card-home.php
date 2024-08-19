<div class="card-home mb-4">
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <div id="card-absen" class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                    <div class="align-self-center">
                        <i class="fa fa-check-circle-o text-success fa-3x"></i>
                    </div>
                    <div class="text-end">
                        <h4 class="card-title">0</h4>
                        <p class="mb-0">Presensi siswa hari ini</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div id="card-materi" class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between px-md-1">
                    <div class="align-self-center">
                        <i class="fa fa-pencil-square-o text-info fa-3x"></i>
                    </div>
                    <div class="text-end">
                        <h4 class="card-title">0</h4>
                        <p class="mb-0">Materi hari ini</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function($) {
        $('.card-home .card-title').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>'); 
        jQuery.ajax({
            type    : "POST",
            url     : themepath.ajaxUrl,
            data    : {action:'datacardhome'},
            success :function(data) { 
                // console.log(data);
                var data = JSON.parse(data); 
                for (var i = 0; i < data.length; i++){
                    $('#'+data[i].id+' .card-title').html(data[i].data); 
                }
            },
        });
    });
</script>