<?php
// The Query
$args = array(
    'post_type' => 'admateri',
);
$the_query = new WP_Query( $args );
?>
<div class="daftar-materi">
    <?php if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) { 
            $the_query->the_post();
        
            // require_once('inc/materi/content.php');
            get_template_part( 'inc/materi/content');
        }
    } else { ?>
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
