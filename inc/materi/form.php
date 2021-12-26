<div class="card shadow-sm mt-4 mb-5">
    <div class="card-header bg-secondary text-white d-flex align-items-center justify-content-between">
        <div class="fw-bold"> <?php echo $pg=='edit'?'Edit':'Tambah'; ?>  Materi</div>   
        <a href="<?php echo $urlpage;?>" class="btn btn-sm btn-light">
            Daftar Materi <i class="fa fa-caret-right" aria-hidden="true"></i>
        </a>
    </div>
    <div class="card-body">
        <?php
        $form = new AdMateri;
        if($pg=='edit') {
            $args = array(
                'post_type' => 'admateri',
                'ID'        => $idmateri
            );
            echo $form->form($args,'edit');
        } else {
            echo $form->form();
        }
        ?>
    </div>
</div>

