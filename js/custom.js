jQuery(function($) {
    if($('#loginform').length!==0) {
        $('#loginform #user_login').addClass('form-control rounded-pill mt-2');
        $('#loginform #user_pass').addClass('form-control rounded-pill mt-2');
        $('#loginform #wp-submit').addClass('btn btn-primary rounded-pill py-2 px-3 mt-4');
        $('#loginform .login-remember').addClass('d-none');
        $('#loginform #rememberme').attr('checked', 'checked');
        $('#loginform .login-submit').append('<a class="btn btn-outline-primary rounded-pill py-2 px-3 mt-4 text-center" href="'+themepath.homeUrl+'/register/">Register</a>');
    }
    var lastScrollTop = 0;
    var offset = $( ".header-navmenu" ).offset();
    $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            $('body').addClass('page-scroll-down');
            $('body').removeClass('page-scroll-up');
        } else {
            $('body').removeClass('page-scroll-down');
            $('body').addClass('page-scroll-up');
        }
        lastScrollTop = st;

        if ( $(window).scrollTop() > offset.top){
            $('.header-navmenu').addClass('scrolled');
        } else {
            $('.header-navmenu').removeClass('scrolled');
        } 
    });

    $(document).on('click', '.back-nav-btn', function(e) {
        history.back();
    });
    $(document).on('change','.checkUsername', function(){
        var el = $(this).val();
        if (/\s/.test(el)) {
            $('#usernameHelp').html( $('<span class="alert alert-danger d-block py-1">Tulis tanpa spasi</span>') );
            document.getElementById("submit-register").disabled = true;
        } else {
            $('#usernameHelp').html( $('<span>Username</span>') );
            document.getElementById("submit-register").disabled = false;
        }
    });
    
    function readURL(input,target) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.'+ target).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $(document).on('change', '.imgchange', function(e) {
        var target = $(this).attr('class-target');
        readURL(this,target);
    });
});