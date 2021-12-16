jQuery(function($) {
    if($('#loginform').length!==0) {
        $('#loginform #user_login').addClass('form-control rounded-pill mt-2 text-center');
        $('#loginform #user_pass').addClass('form-control rounded-pill mt-2 text-center');
        $('#loginform #wp-submit').addClass('btn btn-primary rounded-pill py-3 px-5 mt-4 text-center');
        $('#loginform .login-remember').addClass('d-none');
        $('#loginform #rememberme').attr('checked', 'checked');
    }
});