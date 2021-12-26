<?php
// The Query
$args = array(
    'post_type' => 'admateri',
);
$the_query = new WP_Query( $args );
?>
<div class="daftar-materi">
    <?php if ( $the_query->have_posts() ) { ?>
        <?php while ( $the_query->have_posts() ) { $the_query->the_post();?>
            <article class="mb-4">
                <div class="card shadow-sm card-admateri">
                    <div class="card-header pe-1 bg-white">
                        <small class="d-flex justify-content-between align-items-center text-muted">
                            <span>
                                <img src="<?php echo adget_url_ava($post->post_author); ?>" class="img-fluid rounded-circle me-1" width="20" alt="">
                                <?php echo get_the_author();?>
                            </span>
                            <?php if(current_user_can('administrator') || $post->post_author==$current_id): ?>
                                <div class="dropdown d-inline-block ms-1">
                                    <button class="btn btn-sm btn-link py-0" type="button" id="dropdownMenu<?php echo $post->ID;?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu<?php echo $post->ID;?>">
                                        <li><a class="dropdown-item" href="<?php echo get_the_permalink();?>"><i class="fa fa-eye text-info"></i> Lihat</a></li>
                                        <li><a class="dropdown-item" href="<?php echo $urlpage;?>?pg=edit&id=<?php echo $post->ID;?>"><i class="fa fa-pencil text-warning"></i> Edit</a></li>
                                        <li><span class="dropdown-item" data-id="<?php echo $post->ID;?>"><i class="fa fa-trash text-danger"></i> Hapus</span></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </small>
                    </div>
                    <a href="<?php echo get_the_permalink();?>">
                        <img src="<?php echo get_thumbnail_url_resize(get_the_ID(),300,150);?>" class="card-img-top rounded-0" alt="<?php echo get_the_title();?>" loading="lazy">
                    </a>
                    <div class="card-body">
                        <a class="card-title fw-bold text-dark" href="<?php echo get_the_permalink();?>">
                            <?php echo get_the_title();?>
                        </a>
                    </div>
                    <div class="card-footer border-0 text-muted">
                        <small>
                            <?php echo post_date_ago(get_the_ID());?>
                        </small>
                    </div>
                </div>
            </article>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Tidak ada materi
        </div>
    <?php } ?>
</div>

<?php
/* Restore original Post Data */
wp_reset_postdata();
?>

<div class="float-button-bottom">
    <div class="container text-end">
        <a href="<?php echo $urlpage;?>?pg=add" class="btn btn-success rounded-circle shadow">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>