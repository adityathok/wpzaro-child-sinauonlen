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
    var offset = $( ".header-navmenu" ).height();
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

        if ( $(window).scrollTop() > offset){
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
    
    $(document).on('click', '.btn-adfrontpost-file-delete', function(e) {
        var idpost      = $(this).data('idpost');
        var idfile      = $(this).data('idfile');
        var metaname    = $(this).data('metaname');
        Swal.fire({
            title: 'Anda yakin ?',
            text: "anda akan menghapus file ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                jQuery.ajax({
                    type    : "POST",
                    url     : themepath.ajaxUrl,
                    data    : {action:'deleteadfrontpostfile', idpost:idpost, idfile:idfile, metaname:metaname },
                    success :function(data) { 
                        // console.log(data);  
                        $('.fields-type-file .adfrontpost-file-'+idfile).remove();   
                        $('.fields-type-file .form-control-file-'+idfile).val('');                         
                        Swal.fire({
                            title: 'Deleted !',
                            text: "File telah berhasil dihapus.",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                        });
                    },
                });
            }
        });
    });

    $(document).on('click', '.btn-delete-post', function(e) {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Anda yakin ?',
            text: "anda akan menghapus materi ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                jQuery.ajax({
                    type    : "POST",
                    url     : themepath.ajaxUrl,
                    data    : {action:'deleteadmateri', id:id },
                    success :function(data) { 
                        // console.log(data);  
                        $('article.post-'+id).remove();                             
                        Swal.fire({
                            title: 'Deleted!',
                            text: "Materi telah berhasil dihapus.",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                        });
                    },
                });
            }
        });
    });
    
    $(document).on('click', '.btn-absen-post', function(e) {
        var idpost = $(this).data('post');
        var posttype = $(this).data('posttype');
        if(idpost) {
            $('.btn-absen-post-'+idpost).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> tunggu...');
            jQuery.ajax({
                type    : "POST",
                url     : themepath.ajaxUrl,
                data    : {action:'absenpost', idpost:idpost, posttype:posttype },
                success :function(data) { 
                    // console.log(data);  
                    $('.btn-absen-post-'+idpost).addClass('btn-success').removeClass('btn-danger').html('Berhasil');
                    $('.alert-absen-'+idpost).addClass('alert-success').removeClass('alert-danger');
                },
            });
        }
    });

    // $('.pghome-slider').slick({
    //     infinite: true,
    //     dots: true,
    //     arrows: false,
    //     slidesToShow: 2,
    //     slidesToScroll: 1
    // });

});