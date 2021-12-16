<?php
function my_login_css_add() { ?>
    <style type="text/css">
        div#login:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            height: 25%;
            background-color: #d4145a;
            z-index: -1;
            opacity: 0.5;
        }
        #login h1 a, 
        .login h1 a,
        #backtoblog {
            display: none;
        }
        p#nav {
            padding: 0;
            margin: 1rem 0;
            text-align: center;
        }
        p#nav a {
            display: block;
            background-color: #ddd;
            padding: 0.75rem 1.5rem;
            margin: 0.1rem;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_css_add' );