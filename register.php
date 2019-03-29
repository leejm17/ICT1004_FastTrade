<!DOCTYPE html>
<!--
    Name: Skylith - Viral & Creative Multipurpose HTML Template
    Version: 1.0.3
    Author: nK, unvab
    Website: https://nkdev.info/, http://unvab.com/
    Purchase: https://themeforest.net/item/skylith-viral-creative-multipurpose-html-template/21214857?ref=_nK
    Support: https://nk.ticksy.com/
    License: You must have a valid license purchased only from ThemeForest (the above link) in order to legally use the theme for your project.
    Copyright 2018.
-->
<?php
    session_start();
    $name = $username = $email = $verification_status = 0;
    $nameErr = $usernameErr = $emailErr = $passwordErr = $passwordCfmErr = '';
    if(isset($_SESSION['ErrArray']) && !empty($_SESSION['ErrArray'])){
        $ErrArray = $_SESSION['ErrArray'];
        if(isset($_SESSION['ErrArray'][0]) && !empty($_SESSION['ErrArray'][0])){
            $nameErr = $ErrArray[0];
        }
        if(isset($_SESSION['ErrArray'][1]) && !empty($_SESSION['ErrArray'][1])){
            $usernameErr = $ErrArray[1];
        }
        if(isset($_SESSION['ErrArray'][2]) && !empty($_SESSION['ErrArray'][2])){
            $emailErr = $ErrArray[2];
        }
        if(isset($_SESSION['ErrArray'][3]) && !empty($_SESSION['ErrArray'][3])){
            $passwordErr = $ErrArray[3];
        }
        if(isset($_SESSION['ErrArray'][4]) && !empty($_SESSION['ErrArray'][4])){
            $passwordCfmErr = $ErrArray[4];
        }
    }

    if(isset($_SESSION['name']) && !empty($_SESSION['name'])){
        $name = $_SESSION['name'];
    }

    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
        $username = $_SESSION['username'];
    }

    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        $email = $_SESSION['email'];
    }

    if(isset($_SESSION['need_verification']) && !empty($_SESSION['need_verification'])){
        $verification_status = $_SESSION['need_verification'];
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FastTrade | Register</title>

    <meta name="description" content="sell, buy, online">
    <meta name="keywords" content="login">
    <meta name="author" content="Jonathan Lee">

    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i%7cWork+Sans:400,500,700%7cPT+Serif:400i,500i,700i" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <script defer src="assets/vendor/fontawesome-free/js/all.js"></script>
    <script defer src="assets/vendor/fontawesome-free/js/v4-shims.js"></script>

    <!-- Stroke 7 -->
    <link rel="stylesheet" href="assets/vendor/pixeden-stroke-7-icon/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <!-- Flickity -->
    <link rel="stylesheet" href="assets/vendor/flickity/dist/flickity.min.css">

    <!-- Photoswipe -->
    <link rel="stylesheet" href="assets/vendor/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" href="assets/vendor/photoswipe/dist/default-skin/default-skin.css">

    <!-- JustifiedGallery -->
    <link rel="stylesheet" href="assets/vendor/justifiedGallery/dist/css/justifiedGallery.min.css">

    <!-- Skylith -->
    <link rel="stylesheet" href="assets/css/skylith.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/custom-minimal-shop.css">
    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>


</head>







<!--
    Additional Classes:
        .nk-bg-gradient
-->
<body>




<!--START: Nav Header
    Additional Classes:
        .nk-header-left
        .nk-header-opaque
-->
<?php include 'php/navbar.inc.php'; ?>
<!-- END: Navbar Header -->


<!--START: Navbar Mobile
    Additional Classes:
        .nk-navbar-dark
        .nk-navbar-align-center
        .nk-navbar-align-right
        .nk-navbar-items-effect-1
        .nk-navbar-drop-effect-1
        .nk-navbar-drop-effect-2
-->
<?php include 'php/navbar_mobile.inc.php'; ?>
<!-- END: Navbar Mobile -->




    <!--
        START: Main Content

        Additional Classes:
            .nk-main-dark
    -->
    <div class="nk-main">





    <div class="bg-white">
        <div class="container">
            <!-- START: Shop Header -->
            <div class="nk-shop-header">
                <a href="index.php" class="nk-shop-header-back"><span class="nk-icon-arrow-left"></span> Back to Main Shop</a>
            </div>
            <!-- END: Shop Header -->

            <!-- Was supposed to have sth here-->
            <div class="nk-gap-1"></div>
                <h3 class="h5 text-center">Register</h3>
            <div class="nk-gap-1 mnt-7"></div>

            <form action="assets/php/registerValidation.php" class="nk-form nk-form-style-1" method="POST">
                <div class="row vertical-gap">
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" name="name" placeholder="Your Name" value=<?php if(!empty($nameErr) && !empty($name)){echo '"', $name, '"';}else{echo "";} ?>>
                        <?php if(!empty($nameErr)){echo '<p class="text-danger">', $nameErr , '</p>';} ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control required" name="username" placeholder="Your Username" value=<?php if(!empty($usernameErr) && !empty($username)){echo '"', $username, '"';}else{echo "";} ?>>
                        <?php if(!empty($usernameErr)){echo '<p class="text-danger">', $usernameErr , '</p>';} ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control required" name="email" placeholder="Your Email" value=<?php if(!empty($emailErr) && !empty($email)){echo '"', $email, '"';}else{echo "";} ?>>
                        <?php if(!empty($emailErr)){echo '<p class="text-danger">', $emailErr , '</p>';} ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control required" name="password" placeholder="Your Password">
                        <?php if(!empty($passwordErr)){echo '<p class="text-danger">', $passwordErr , '</p>';} ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control required" name="passwordCfm" placeholder="Re-Enter Your Password">
                        <?php if(!empty($passwordCfmErr)){echo '<p class="text-danger">', $passwordCfmErr , '</p>';} ?>
                    </div>
                </div>
                <div class="nk-gap-1"></div>
                <div class="text-center">
                    <button type="submit" class="nk-btn nk-btn-color-dark-1">Register</button>
                </div>
                <div class="nk-gap-1"></div>
            </form>
            <div class ="row vertical-gap">
                <div class="col-sm-12">
                <?php
                    if($verification_status == 1){
                        echo '<div class="alert alert-success">Your account has been successfully created.<br/>Check your email for the verification link!</div>';
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="nk-gap-3"></div>
    </div>


    </div>
    <!-- END: Main Content -->


<!--START: Footer
    Additional Classes:
        .nk-footer-transparent
-->
<?php include 'php/footer.inc.php'; ?>
<!-- END: Footer -->





<!-- START: Scripts -->

<!-- Object Fit Polyfill -->
<script src="assets/vendor/object-fit-images/dist/ofi.min.js"></script>

<!-- ImagesLoaded -->
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>

<!-- GSAP -->
<script src="assets/vendor/gsap/src/minified/TweenMax.min.js"></script>
<script src="assets/vendor/gsap/src/minified/plugins/ScrollToPlugin.min.js"></script>

<!-- Popper -->
<script src="assets/vendor/popper.js/dist/umd/popper.min.js"></script>

<!-- Bootstrap -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Sticky Kit -->
<script src="assets/vendor/sticky-kit/dist/sticky-kit.min.js"></script>

<!-- Jarallax -->
<script src="assets/vendor/jarallax/dist/jarallax.min.js"></script>
<script src="assets/vendor/jarallax/dist/jarallax-video.min.js"></script>

<!-- Flickity -->
<script src="assets/vendor/flickity/dist/flickity.pkgd.min.js"></script>

<!-- Isotope -->
<script src="assets/vendor/isotope-layout/dist/isotope.pkgd.min.js"></script>

<!-- Photoswipe -->
<script src="assets/vendor/photoswipe/dist/photoswipe.min.js"></script>
<script src="assets/vendor/photoswipe/dist/photoswipe-ui-default.min.js"></script>

<!-- JustifiedGallery -->
<script src="assets/vendor/justifiedGallery/dist/js/jquery.justifiedGallery.min.js"></script>

<!-- Jquery Validation -->
<script src="assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>

<!-- Hammer.js -->
<script src="assets/vendor/hammerjs/hammer.min.js"></script>

<!-- NanoSroller -->
<script src="assets/vendor/nanoscroller/bin/javascripts/jquery.nanoscroller.js"></script>

<!-- Keymaster -->
<script src="assets/vendor/keymaster/keymaster.js"></script>


<!-- Skylith -->
<script src="assets/js/skylith.min.js"></script>
<script src="assets/js/skylith-init.js"></script>
<!-- END: Scripts -->


</body>
</html>
<?php
    if(isset($_SESSION['ErrArray'])){
        session_unset($_SESSION["ErrArray"]);
    }
    if(isset($_SESSION['name'])){
        session_unset($_SESSION["name"]);
    }
    if(isset($_SESSION['username'])){
        session_unset($_SESSION["username"]);
    }
    if(isset($_SESSION['email'])){
        session_unset($_SESSION["email"]);
    }
    if(isset($_SESSION['verification_status'])){
        session_unset($_SESSION["verification_status"]);
    }
?>