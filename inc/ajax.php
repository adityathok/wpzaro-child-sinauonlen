<?php
add_action('wp_ajax_deleteadmateri', 'deleteadmateri_ajax');
function deleteadmateri_ajax() {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    
    if(current_user_can('administrator') || current_user_can('guru')):
        $materi = new AdMateri();
        $materi->delete($id);
    endif;

    wp_die();
}

add_action('wp_ajax_deleteadfrontpostfile', 'deleteadfrontpostfile_ajax');
function deleteadfrontpostfile_ajax() {
    $idpost     = isset($_POST['idpost']) ? $_POST['idpost'] : '';
    $idfile     = isset($_POST['idfile']) ? $_POST['idfile'] : '';
    $metaname   = isset($_POST['metaname']) ? $_POST['metaname'] : '';
    
    if(current_user_can('administrator') || current_user_can('guru')):
        wp_delete_attachment( $idfile );
        delete_post_meta($idpost, $metaname, $idfile);
    endif;

    wp_die();
}

add_action('wp_ajax_absenpost', 'absenpost_ajax');
function absenpost_ajax() {
    $idpost     = isset($_POST['idpost']) ? $_POST['idpost'] : '';
    $posttype   = isset($_POST['posttype']) ? $_POST['posttype'] : '';
    $date       = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
    
    if($idpost):        
        $AdAbsenPost = new AdAbsenPost();
        $AdAbsenPost->add(get_current_user_id(),$idpost,$posttype,$date);
    endif;

    wp_die();
}

add_action('wp_ajax_listnilaisiswa', 'listnilaisiswa_ajax');
function listnilaisiswa_ajax() {
    $iduser = isset($_POST['iduser']) ? $_POST['iduser'] : '';
    $urlpage = get_home_url().'/admin-settings/';

    // The Query
    $args = array(
        'post_type'         => 'adnilaisiswa',
        'posts_per_page'    =>-1,
        'meta_query'        => array(
            array(
                'key'     => 'siswa',
                'value'   => $iduser,
                'compare' => '=',
            ),
        ),
    );
    $the_query = new WP_Query( $args );

    echo '<div class="list-nilai-'.$iduser.'">';
        // The Loop
        if ( $the_query->have_posts() ) {
            echo '<div class="list-group list-group-numbered">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                ?>
                <div class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <a href="<?php echo get_the_permalink();?>">
                            <?php echo get_the_title();?>
                        </a>
                    </div>
                    <a class="badge bg-info rounded-pill" href="<?php echo $urlpage;?>?pg=nilai&id=<?php echo $iduser;?>&idpost=<?php echo get_the_ID();?>&act=edit">edit</a>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning">belum ada nilai</div>';
        }
    echo '</div>';

    wp_die();
}

add_action('wp_ajax_datacardhome', 'datacardhome_ajax');
function datacardhome_ajax() {
    $AdAbsenPost    = new AdAbsenPost();
    $date           = date( 'Y-m-d', current_time( 'timestamp', 0 ) );
    $result         = [];

    if(current_user_can('siswa')) {
        $countabsen     = $AdAbsenPost->count_byuser(get_current_user_id(),$date);
    } elseif(current_user_can('guru')) {
        $countabsen     = $AdAbsenPost->count_byauthor(get_current_user_id(),$date);
    } else {
        $countabsen     = $AdAbsenPost->count_bydate($date);
    }

    $result[] = [
        'id'    => 'card-absen',
        'data'  => $countabsen,
    ];

    // The Query
    $args = array(
        'post_type'         => 'admateri',
        'posts_per_page'    => -1,
        'date_query' => array(
            array(
                'year'  => date( 'Y', current_time( 'timestamp', 0 ) ),
                'month' => date( 'm', current_time( 'timestamp', 0 ) ),
                'day'   => date( 'd', current_time( 'timestamp', 0 ) ),
            ),
        ),
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
    $result[] = [
        'id'    => 'card-materi',
        'data'  => $the_query->found_posts,
    ];

    echo json_encode($result);

    wp_die();
}