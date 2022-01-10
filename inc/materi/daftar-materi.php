<?php
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
// The Query
$args = array(
    'post_type'         => 'admateri',
    'paged'             => $paged,
    'posts_per_page'    => 12
);

if(current_user_can('guru')) {
    $args['author'] = get_current_user_id();
}

if(current_user_can('siswa')) {
    $args['meta_query'] = array(
        array(
            'key'       => 'kelas',
            'value'     => get_user_meta(get_current_user_id(), 'kelas', true),
            'compare'   => 'like'
        )
    );
}

$the_query = new WP_Query( $args );
?>
<div class="daftar-materi">
    <?php if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) { 
            $the_query->the_post();
        
            // require_once('inc/materi/content.php');
            get_template_part( 'inc/materi/content');
            
        }

        $big = 999999999; // need an unlikely integer
        wpzaro_pagination(array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $the_query->max_num_pages
        ) );

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

<?php if(!current_user_can('siswa')): ?>
    <div class="float-button-bottom">
        <div class="container text-end">
            <a href="<?php echo $urlpage;?>?pg=add" class="btn btn-success rounded-circle shadow">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php endif; ?>
