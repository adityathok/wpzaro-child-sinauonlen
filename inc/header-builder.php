<?php 
if ( ! function_exists( 'wpzaro_header_nav_menu' ) ) {
    add_action('wpzaro_header','wpzaro_header_nav_menu',20);
    function wpzaro_header_nav_menu() {
        $urlpage    = get_the_permalink();
        $pg         = isset($_GET['pg']) ? $_GET['pg'] : '';
        $backurl    = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $conturl    = home_url();

        if ($backurl&&strpos($backurl, home_url().'/admin-settings')!==false&&$pg){
            $conturl = home_url().'/admin-settings';
        } elseif ($backurl&&strpos($backurl, home_url())!==false) {
            $conturl = $backurl;
        } 
        ?>            
        <div class="header-navmenu sticky-top">
            <div class="header-navmenu-inner">
                <div class="bg-white shadow-sm rounded-bottom container">
                    <div class="row justify-content-between align-items-center py-1">
                            <div class="col-2">
                                <?php if(!is_front_page()): ?>
                                    <a href="<?php echo $conturl; ?>" class="back-nav-btn d-none btn btn-link text-secondary">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </a>
                                    <span class="back-nav-btn btn btn-link text-secondary">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <div class="col-8 text-center">
                            <div class="title-header text-muted">
                                <?php
                                if (bp_is_user()) {
                                    echo 'Pengaturan profile';
                                } else if (get_post_type() === 'post' || get_post_type() === 'page') {
                                    echo get_the_title();
                                } else if (get_post_type() === 'admateri') {
                                    echo 'Materi | '.get_the_title();
                                } else if(is_bbpress()) {
                                    echo 'Forums';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <span class="text-secondary btn btn-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenuHeader" aria-controls="offcanvasMenuHeader">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <?php
    }
}