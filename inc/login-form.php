<?php
function ad_login_form() {
 
    $args = array(
      'echo'            => true,
      'redirect'        => get_permalink( get_the_ID() ),
      'remember'        => true,
      'value_remember'  => true,
    );
   
    return wp_login_form( $args );
   
  }