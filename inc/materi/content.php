<article <?php post_class('article-card-admateri mb-4'); ?>>

    <?php 
    if(!is_user_logged_in())
    return false;

    $urlpage        = get_home_url().'/materi/';
    $AdAbsenPost    = new AdAbsenPost();
    ?>

    <div class="card border-0 shadow-sm card-admateri">
        <div class="card-header pe-1 bg-white">
            <small class="d-flex justify-content-between align-items-center text-muted">
                <a href="<?php echo bp_members_get_user_url( $post->post_author );?>" class="text-muted">
                    <img src="<?php echo adget_url_ava($post->post_author); ?>" class="img-fluid rounded-circle me-1" width="20" alt="">
                    <?php echo get_the_author();?>
                </a>
                <?php if(current_user_can('administrator') || $post->post_author==get_current_user_id()): ?>
                    <button class="btn btn-sm btn-link py-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas<?php echo $post->ID;?>" aria-controls="offcanvas<?php echo $post->ID;?>">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                <?php endif; ?>
            </small>
        </div>
        <a href="<?php echo get_the_permalink();?>" class="d-block position-relative">
            <?php if ($AdAbsenPost->check(get_current_user_id(),$post->ID)): ?>
                <span class="badge bg-success position-absolute bottom-0 end-0">Sudah presensi</span>
            <?php endif; ?>
            <img src="<?php echo get_thumbnail_url_resize(get_the_ID(),300,150);?>" class="card-img-top rounded-0" alt="<?php echo get_the_title();?>" loading="lazy">
        </a>
        <div class="card-body">
            <a class="card-title text-dark" href="<?php echo get_the_permalink();?>">
                <strong><?php echo get_the_title();?></strong>
                <?php
                $termsmapel = get_the_terms( get_the_ID(), 'mapel' );
                if ( $termsmapel && ! is_wp_error( $termsmapel ) ) : 
                    echo ' | '.$termsmapel[0]->name;
                endif;
                ?>
            </a>
        </div>
        <div class="card-footer border-0 text-muted d-flex justify-content-between">
            <small>
                <?php echo post_date_ago(get_the_ID());?>
            </small>
            
            <small>
                <?php
                $mkelas = get_post_meta(get_the_ID(),'kelas',true);
                if($mkelas){
                    echo implode(",",$mkelas);
                }
                // $termsmapel = get_the_terms( get_the_ID(), 'mapel' );
                // if ( $termsmapel && ! is_wp_error( $termsmapel ) ) : 
                //         foreach ( $termsmapel as $term ) {
                //             echo '| <a href="?setmapel='.$term->term_id.'">'.$term->name.'</a> ';
                //         }
                // endif;
                ?>
            </small>
                
        </div>
    </div>

    <?php if(current_user_can('administrator') || $post->post_author==get_current_user_id()): ?>
        <!-- Off canvas -->
        <div class="offcanvas offcanvas-bottom bg-transparent h-auto border-0" tabindex="-1" id="offcanvas<?php echo $post->ID;?>" aria-labelledby="offcanvas<?php echo $post->ID;?>Label">
            <div class="offcanvas-body p-0">
                <div class="container px-1 py-4">                
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action border-0 border-bottom" href="<?php echo get_the_permalink();?>">Lihat</a>
                        <a class="list-group-item list-group-item-action border-0 border-bottom" href="<?php echo $urlpage;?>?pg=edit&id=<?php echo $post->ID;?>">Edit</a>
                        <span class="list-group-item list-group-item-action border-0 border-bottom btn-delete-post" data-bs-dismiss="offcanvas" data-id="<?php echo $post->ID;?>">Hapus</span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</article>