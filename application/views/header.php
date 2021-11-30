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

    <script src="https://kit.fontawesome.com/c795f7aacf.js" crossorigin="anonymous"></script>
    <!-- <meta name="google-signin-client_id" content="775340702878-4saa4ttuvpgmlvlhnsdh3himpqb50j8h.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script> -->

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
                <?php endif; ?>
                <div class="btn-logout">
                    <a href="<?= LINK ?>logout"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </header><!-- #site-head -->

    <main id="site-main">