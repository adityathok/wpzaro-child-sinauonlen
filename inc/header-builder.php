<?php 
if ( ! function_exists( 'wpzaro_header_nav_menu' ) ) {
    add_action('wpzaro_header','wpzaro_header_nav_menu',20);
    function wpzaro_header_nav_menu() {
        $backurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $conturl = $backurl&&strpos($backurl, home_url())!==false?$backurl:home_url();
        ?>            
        <div class="header-navmenu sticky-top">
            <div class="header-navmenu-inner container">
                <div class="bg-white shadow-sm rounded">
                    <div class="row justify-content-between py-1">
                        <?php if(!is_front_page()): ?>
                            <div class="col-1">
                                <a href="<?php echo $conturl; ?>" class="back-nav-btn btn btn-link text-secondary">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="col">

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