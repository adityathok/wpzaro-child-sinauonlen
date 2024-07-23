<?php
$data_kelas = get_option( '_data_kelas', ['Kelas'] );
?>
<div class="accordion" id="accordionKelas">

  <?php foreach( $data_kelas as $key => $kelas): ?>
    <div class="accordion-item">
        <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseK<?php echo $key;?>" aria-expanded="false" aria-controls="collapseK<?php echo $key;?>">
            <?php echo $kelas;?>
        </button>
        </h2>
        <div id="collapseK<?php echo $key;?>" class="accordion-collapse collapse" data-bs-parent="#accordionKelas">
        <div class="accordion-body">
           
            <?php                                    
            $get_tema = get_categories( array('taxonomy' => 'adtema','hide_empty'=> false,));
            ?>
            <?php if($get_tema): ?>
                <div class="list-group list-group-flush">
                    <?php foreach( $get_tema as $tema): ?>
                        <a href="<?php echo get_term_link( $tema ); ?>?setkelas=<?php echo $kelas;?>" class="list-group-item list-group-item-action px-0 d-flex justify-content-between align-items-center">
                            <?php echo $tema->name; ?>
                            <span class="opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/> </svg>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
        </div>
    </div>
  <?php endforeach; ?>

</div>