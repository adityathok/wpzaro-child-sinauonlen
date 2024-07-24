<?php
$data_kelas = get_option( '_data_kelas', ['Kelas'] );

if(current_user_can('siswa')) {
    $data_kelas = [get_user_meta(get_current_user_id(), 'kelas', true)];
}

$termapel = get_terms( array(
	'taxonomy' => 'mapel',
	'hide_empty' => false
) );

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
                
            <?php if($termapel): ?>
                <div class="accordion accordion-flush" id="accordionFlush<?php echo $key;?>">
                    <?php foreach( $termapel as $mapel): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key.$mapel->term_id;?>" aria-expanded="false" aria-controls="collapse<?php echo $key.$mapel->term_id;?>">
                                    <?php echo $mapel->name;?>
                                </button>
                            </h2>                        
                            <div id="collapse<?php echo $key.$mapel->term_id;?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlush<?php echo $key;?>">
                                <div class="accordion-body">

                                <?php
                                    $args = array(
                                        'post_type'         => 'admateri',
                                        'posts_per_page'    => 10,
                                        'meta_query'        => array(
                                            array(
                                                'key'       => 'kelas',
                                                'value'     => $kelas,
                                                'compare'   => 'like'
                                            ),
                                        ),
                                        'tax_query'        => array(
                                            array(
                                                'taxonomy' => 'mapel',
                                                'field'    => 'term_id',
                                                'terms'    => $mapel->term_id,
                                            ),
                                        ),
                                    );
                                    if(current_user_can('guru')) {
                                        $args['author'] = get_current_user_id();
                                    }
                                    $the_query = new WP_Query( $args );
                                    if ( $the_query->have_posts() ) {
                                        echo '<div class="list-group list-group-flush">';
                                            while ( $the_query->have_posts() ) { 
                                                $the_query->the_post();
                                                echo '<a href="'.get_the_permalink().'" class="list-group-item list-group-item-action px-0 d-flex justify-content-between align-items-center">';
                                                    echo get_the_title();
                                                    echo '<span class="opacity-50"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/> </svg></span>';
                                                echo '</a>';
                                            }
                                            echo '<a href="'.get_site_url().'/admateri?setkelas='.$kelas.'&setmapel='.$mapel->term_id.'" class="list-group-item list-group-item-action px-0 mt-4 text-bg-primary text-center">';
                                                echo 'Materi lainnya';
                                            echo '</a>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="alert alert-warning mb-0">';
                                            echo 'Tidak ada materi disini';
                                        echo '</div>';
                                    }
                                    /* Restore original Post Data */
                                    wp_reset_postdata();
                                    ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
                <?php
                // $args = array(
                //     'post_type'         => 'admateri',
                //     'posts_per_page'    => 10
                // );
                // $args['meta_query'] = array(
                //     array(
                //         'key'       => 'kelas',
                //         'value'     => $kelas,
                //         'compare'   => 'like'
                //     )
                // );
                // if(current_user_can('guru')) {
                //     $args['author'] = get_current_user_id();
                // }
                // $the_query = new WP_Query( $args );
                // if ( $the_query->have_posts() ) {
                //     echo '<div class="list-group list-group-flush">';
                //         while ( $the_query->have_posts() ) { 
                //             $the_query->the_post();
                //             echo '<a href="'.get_the_permalink().'" class="list-group-item list-group-item-action px-0 d-flex justify-content-between align-items-center">';
                //                 echo get_the_title();
                //                 echo '<span class="opacity-50"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/> </svg></span>';
                //             echo '</a>';
                //         }
                //         echo '<a href="'.get_site_url().'/admateri?setkelas='.$kelas.'" class="list-group-item list-group-item-action px-0 mt-4 text-bg-primary text-center">';
                //             echo 'Materi '.$kelas.' lainnya';
                //         echo '</a>';
                //     echo '</div>';
                // }
                // /* Restore original Post Data */
                // wp_reset_postdata();
                ?>
            
            </div>
        </div>
    </div>
  <?php endforeach; ?>

</div>