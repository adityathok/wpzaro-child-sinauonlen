<?php
function ad_login_form() {
  ob_start();
  $args = array(
    'echo'            => true,
    'redirect'        => get_home_url(),
    'remember'        => true,
    'value_remember'  => true,
  );
  echo wp_login_form( $args );
  echo '<script src="https://www.google.com/recaptcha/api.js?hl=en&amp;ver=5.3.1" id="google-recaptcha-v2-js"></script>';
  // echo '<a class="btn btn-outline-primary" href="'.get_site_url().'/register">Daftar</a>';
  $form = ob_get_clean();

  $form = str_replace('input', 'input form-control', $form);
  $form = str_replace('login-submit', 'login-submit text-end', $form);
  $form = str_replace('button button-primary', 'button button-primary btn btn-primary px-4', $form);
  $form = str_replace('<p class="login-submit text-end">', '<p class="login-submit text-end"><a class="btn btn-outline-primary" href="'.get_site_url().'/register">Daftar</a>', $form);

  return $form;
}

add_shortcode('form_login','shortode_formlogin');
function shortode_formlogin(){
  ob_start();

  $themeoption = get_option('wpzaro_theme_options');

  echo '<div class="card mt-4 mb-2 my-4">';
  echo '<img src="'.$themeoption['_theme_logo'].'" class="card-img-top mx-auto my-2" alt="..." style="max-width: 12rem;">';
    echo '<div class="card-body py-5">';
      if(is_user_logged_in()):
        echo '<p>You are logged in</p>';
      else:
        echo ad_login_form();
        // wp_login_form();
      endif;
    echo '</div>';
  echo '</div>';
  return ob_get_clean();
}