<?php
/**
 * The template for displaying all single posts
 *
 * @package wpzaro
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container      = get_theme_mod( 'wpzaro_container_type' );
$AdAbsenPost    = new AdAbsenPost();
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

            <div class="col-12">

                <main class="site-main" id="main">

                    <?php while ( have_posts() ) { the_post(); ?>

                        <div class="single-card-custom">
                            <div class="bg-image-content">
                                <img src="<?php echo get_thumbnail_url_resize(get_the_ID(),500,300);?>" class="img-fluid w-100" alt="<?php echo get_the_title();?>" loading="lazy">
                            </div>
                            <div class="post-author text-center">                                
                                <img src="<?php echo adget_url_ava($post->post_author); ?>" class="img-fluid rounded-circle" width="70" alt="">
                            </div>

                            <header class="entry-header text-center">
                                <?php the_title( '<h1 class="entry-title h4 mt-4 mb-3">', '</h1>' ); ?>                            
                            </header><!-- .entry-header -->

                            
                            <?php if(current_user_can('siswa')): ?>
                                <?php if ($AdAbsenPost->check(get_current_user_id(),$post->ID)): ?>
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Anda sudah absen
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-danger alert-absen-<?php echo get_the_ID(); ?> bg-white text-center shadow-sm my-4">
                                        <div class="btn btn-danger w-100 btn-absen-post btn-absen-post-<?php echo get_the_ID(); ?>" data-posttype="admateri" data-post="<?php echo get_the_ID(); ?>">Absen</div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="alert alert-secondary bg-white shadow-sm my-4">
                                    <div class="btn-group w-100" role="group">
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#dataAbsenModal">Cek Absensi</button>
                                        <a href="<?php echo get_home_url();?>/materi/?pg=edit&id=<?php echo get_the_ID(); ?>" class="btn btn-secondary">Edit Materi</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php 
                             $getfile   = get_post_meta( get_the_ID(), 'file_add', true );
                             $fileurl   = $getfile?wp_get_attachment_url($getfile):$getfile;
                             if($fileurl):
                             ?>
                                <div class="card shadow-sm my-4">
                                    <div class="card-header text-center">File Lampiran</div>
                                    <div class="card-body text-center">
                                        <a href="<?php echo $fileurl; ?>" class="btn btn-secondary" download>Download</a>
                                    </div>
                                </div>
                             <?php endif; ?>

                            <div class="entry-content">
                                <?php
                                the_content();
                                wpzaro_link_pages();
                                ?>
                            </div><!-- .entry-content -->
                        </div>
                        
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    }
                    ?>

                </main><!-- #main -->

            </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->


<?php if(!current_user_can('siswa')): ?>
    <!-- Modal -->
    <div class="modal fade" id="dataAbsenModal" tabindex="-1" aria-labelledby="dataAbsenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="dataAbsenModalLabel">Data Absen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">tgl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php            
                        $AdAbsenPost    = new AdAbsenPost();
                        $dataabsen      = $AdAbsenPost->fetch("post_id = ".get_the_ID()."");
                        ?>
                        <?php if($dataabsen): ?>
                            <?php foreach( $dataabsen as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td>
                                        <div> <?php echo get_userdata($value->user_id)->display_name; ?> </div>
                                        <small><?php echo get_user_meta($value->user_id,'kelas',true); ?></small>
                                    </td>
                                    <td><?php echo $value->date; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
<?php endif; ?>

<?php
get_footer();
