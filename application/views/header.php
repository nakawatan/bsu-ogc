<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('LINK', base_url());
define('ASSETS', LINK . 'assets/');

define('TITLE', 'Office of Guidance and Counseling');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= TITLE ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?= ASSETS ?>images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/print.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/jquery.datetimepicker.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/fontawesome.min.css">

    <!-- <script src="https://kit.fontawesome.com/c795f7aacf.js" crossorigin="anonymous"></script> -->
    <!-- <meta name="google-signin-client_id" content="775340702878-4saa4ttuvpgmlvlhnsdh3himpqb50j8h.apps.googleusercontent.com"> -->
    <meta name="google-signin-client_id" content="719609387588-js0c2geb2ejsnkca52n6n1dcsupgb7kd.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <link href='<?= ASSETS ?>js/fullcalendar/main.css' rel='stylesheet' />
    <script src='<?= ASSETS ?>js/fullcalendar/main.js'></script>

    <style>
        
    #noti_Container {
        position:relative;
    }
       
    /* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
    
    #noti_Button {
        width:22px;
        height:22px;
        line-height:22px;
        border-radius:50%;
        -moz-border-radius:50%; 
        -webkit-border-radius:50%;
        /* background:#FFF; */
        margin:-3px 10px 0 10px;
        cursor:pointer;
    }
    
        
    /* THE POPULAR RED NOTIFICATIONS COUNTER. */
    #noti_Counter {
        display:block;
        position:absolute;
        background:#E1141E;
        color:#FFF;
        font-size:12px;
        font-weight:normal;
        padding:1px 3px;
        margin:-8px 0 0 25px;
        border-radius:2px;
        -moz-border-radius:2px; 
        -webkit-border-radius:2px;
        z-index:1;
    }
        
    /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
    #notifications {
        display:none;
        width:430px;
        position:absolute;
        top:30px;
        right: -10%;  
        background:#FFF;
        border:solid 1px rgba(100, 100, 100, .20);
        -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
        z-index: 999;
    }

    .notification-text {
        color : black;
        cursor:pointer;
    }
    /* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
    #notifications:before {         
        content: '';
        display:block;
        width:0;
        height:0;
        color:transparent;
        border:10px solid #CCC;
        border-color:transparent transparent #FFF;
        margin-top:-20px;
        margin-left:373px;
    }
        
    .seeAll {
        background:#F6F7F8;
        padding:8px;
        font-size:12px;
        font-weight:bold;
        border-top:solid 1px rgba(100, 100, 100, .30);
        text-align:center;
    }
    .seeAll a {
        color:#3b5998;
    }
    .seeAll a:hover {
        background:#F6F7F8;
        color:#3b5998;
        text-decoration:underline;
    }
</style>

</head>

<body>
    <div class="preloader">
        <img src="<?= ASSETS ?>images/batstateu-redspartan.png" alt="" width="120" height="170">
    </div>
    <header id="site-head">
        <div id="site-logo" class="container">
            <a href="<?= LINK ?>" class="d-flex d-center">
                <img src="<?= ASSETS ?>images/Official_Seal_of_Batangas_State_University.png" alt="">
                <div>
                    <h1>Batangas State University</h1>
                    <span>Office of Guidance and Counseling</span>
                </div>
            </a>
            <?php if($user_session): ?>
            <div class="d-right d-flex d-center">
                <?php if($controller == 'admin'): ?>
                <div class="btn-settings">
                    <a href="<?= LINK ?>admin/settings"><i class="fas fa-cog"></i> Settings</a>
                </div>
                <a id="noti_Container">
                    <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                    
                    <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                    <div id="noti_Button"><i class="fas fa-bell"></i></div>    

                    <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                    <div id="notifications">
                        <h3>Notifications</h3>
                        <div style="height:300px;"></div>
                        <div class="seeAll"><a href="#">See All</a></div>
                    </div>
                </a>
                <?php endif; ?>
                <div class="btn-logout">
                    <a href="<?= LINK ?>logout"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </header><!-- #site-head -->

    <main id="site-main">