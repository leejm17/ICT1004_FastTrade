<?php
    session_start();
?>
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FastTrade | Verify Email</title>

    <meta name="description" content="sell, buy, online">
    <meta name="keywords" content="login">
    <meta name="author" content="Jonathan Lee">

    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/ft_css.css" type="text/css"/>

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
        <div class="container-fluid">
        <div class="nk-gap-6"></div>
        <div class="nk-gap-6"></div>
        <div class="nk-gap-3"></div>
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-3">
                    <?php
                        //check if can get variables from url
                        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                            $email = $_GET['email'];
                            $hash = $_GET['hash'];

                            require_once '..\..\protected\config_fasttrade.php';
                            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                            //mysqli_connnect_errno returns last error code
                            if (mysqli_connect_errno()){
                                die(mysqli_connect_error()); //exits connection
                            }

                            $activated_val = 0;
                            $to_set_activated_val = 1;
                            $db_email = "";

                            $search_sql = "SELECT email FROM user WHERE email=? AND activated = ? AND email_hash = ?";
                            if($search_statement = mysqli_prepare($connection, $search_sql)){
                                mysqli_stmt_bind_param($search_statement, "sis", $email, $activated_val, $hash);
                                mysqli_stmt_execute($search_statement);
                                mysqli_stmt_bind_result($search_statement, $db_email);
                                mysqli_stmt_fetch($search_statement);

                                /* close statement */
                                mysqli_stmt_close($search_statement);

                                if($db_email != $email){
                                    echo '<div class ="jumbotron" id="no_verification_jumbotron" style="text-align:center;"><h3>Email is not verified!</h3></div>';
                                } else{
                                    $activated_status_sql = "UPDATE user SET activated = ? WHERE email = ? AND activated = ? AND email_hash = ?"; //need to set Safe Updates to off
                                    if($mod_activate_statement = mysqli_prepare($connection, $activated_status_sql)){
                                        mysqli_stmt_bind_param($mod_activate_statement, "isis", $to_set_activated_val, $email, $activated_val, $hash);
                                        mysqli_stmt_execute($mod_activate_statement);
                                        $_SESSION["activated"] = 0;
                                        mysqli_stmt_close($mod_activate_statement);
                                    }
                                    echo '<div class ="jumbotron" id="verification_jumbotron" style="text-align:center;"><h3>Email is successfully verified!</h3></div>';
                                }
                            }
                        }else{
                            echo '<div class ="jumbotron" id="no_verification_jumbotron" style="text-align:center;"><h3>Link is illegally accessed!</h3></div>';
                        }

                    ?>
                </div>
            </div>
        <div class="nk-gap-3"></div>
        <div class="nk-gap-6"></div>
        <div class="nk-gap-6"></div>
        </div>
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