<?php
function ad_login_form() {
  $args = array(
  'echo'            => true,
  'redirect'        => get_home_url(),
  'remember'        => true,
  'value_remember'  => true,
  );
  return wp_login_form( $args );
}

add_shortcode('form_login','shortode_formlogin');
function shortode_formlogin(){
  ob_start();

  $themeoption = get_option('wpzaro_theme_options');

  echo '<div class="card mt-4 mb-2 my-4">';
  echo '<img src="'.$themeoption['_theme_logo'].'" class="card-img-top" alt="...">';
    echo '<div class="card-body py-5">';
      if(is_user_logged_in()):
        echo '<p>You are logged in</p>';
      else:
        echo ad_login_form();
      endif;
    echo '</div>';
  echo '</div>';
  return ob_get_clean();
}