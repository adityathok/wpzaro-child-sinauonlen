<?php 
if ( ! function_exists( 'wpzaro_footer_bottom_menu' ) ) {
    add_action('wpzaro_footer','wpzaro_footer_bottom_menu',20);
    function wpzaro_footer_bottom_menu() {

        //if login show navigation menu
        if(is_user_logged_in() || !is_user_logged_in() && is_home()){

            ?>
            
            <div class="bottom-navmenu">
                <div class="bottom-navmenu-inner container px-1">
                    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-2 py-0 rounded">
                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'navmenu',
                                'container_class' => 'd-block w-100',
                                'container_id'    => 'navMenuBottom',
                                'menu_class'      => 'navbar-nav justify-content-between align-items-center',
                                'fallback_cb'     => '',
                                'menu_id'         => 'main-menu',
                                'depth'           => 2,
                                'walker'          => new wpzaro_WP_Bootstrap_Navwalker(),
                            )
                        );
                        ?>
                    </nav>
                </div>
            </div>
        
            <?php

        }
    }
}