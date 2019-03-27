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

    if (!isset($_SESSION['userid']) && !isset($_SESSION['activated'])){
        header('Location: 403.php');        
    } else{
        $userid = $_SESSION['userid'];
        $activate = $_SESSION['activated'];
        
        $profilepic_success = -1;
        if(isset($_SESSION['profilepic_msg']) && !empty($_SESSION['profilepic_msg'])){
            $profilepic_success = $_SESSION['profilepic_msg'];
        }

        $nameErr = $genderErr = $updateGenSuccess ='';
        if(isset($_SESSION['UpdateGenErr']) && !empty($_SESSION['UpdateGenErr'])){
            $UpdateGenErr = $_SESSION['UpdateGenErr'];
            if(isset($_SESSION['UpdateGenErr'][0]) && !empty($_SESSION['UpdateGenErr'][0])){
                $nameErr = $UpdateGenErr [0];
            }
            if(isset($_SESSION['UpdateGenErr'][1]) && !empty($_SESSION['UpdateGenErr'][1])){
                $genderErr = $UpdateGenErr[1];
            }
            if(isset($_SESSION['UpdateGenErr'][2]) && !empty($_SESSION['UpdateGenErr'][2])){
                $updateGenSuccess = $UpdateGenErr[2];
            }
        }

        $pwdErr = $updatePwdSuccess = '';
        if(isset($_SESSION['UpdatePwdErr']) && !empty($_SESSION['UpdatePwdErr'])){
            $UpdatePwdErr = $_SESSION['UpdatePwdErr'];
            if(isset($_SESSION['UpdatePwdErr'][0]) && !empty($_SESSION['UpdatePwdErr'][0])){
                $pwdErr = $UpdatePwdErr[0];
            }
            if(isset($_SESSION['UpdatePwdErr'][1]) && !empty($_SESSION['UpdatePwdErr'][1])){
                $updatePwdSuccess = $UpdatePwdErr[1];
            }
        }

        //init of db
        // TODO: make sure we keep note of the location of this file when porting over to hosting platform
        require_once '..\..\protected\config_fasttrade.php';
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

        //mysqli_connnect_errno returns last error code
        if (mysqli_connect_errno()){
            die(mysqli_connect_error()); //exits connection
        }

        //check with db and see if have identifier.
        $name = $email = $gender = $contact_info = $pic = ''; 
        $profile_ret_sql = "SELECT name, email, gender, contact_info, pic FROM user WHERE user_id = ? or activated = ? LIMIT 1";
        if($statement = mysqli_prepare($connection, $profile_ret_sql)){
            mysqli_stmt_bind_param($statement, "si", $userid, $activated);
            mysqli_stmt_execute($statement);
            mysqli_stmt_bind_result($statement, $name, $email, $gender, $contact_info, $pic);
            mysqli_stmt_fetch($statement);
        
            /* close statement */
            mysqli_stmt_close($statement);
        } 
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FastTrade | Update Profile</title>

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


<!--
    START: Nav Header

    Additional Classes:
        .nk-header-left
        .nk-header-opaque
-->
<header class="nk-header nk-header-left nk-header-opaque">

    
        <!--
            START: Navbar

            Additional Classes:
                .nk-navbar-dark
        -->
        <nav class="nk-navbar nk-navbar-cont nk-navbar-dark d-none d-lg-flex">
            
            <a href="shop.html" class="nk-nav-logo">
                <img src="assets/images/logo-2.svg" alt="" width="19" class="nk-nav-logo-img-dark">
                <img src="assets/images/logo-2-light.svg" alt="" width="19" class="nk-nav-logo-img-light">
            </a>
            
            <a href="#" class="nk-navbar-left-toggle">
                <span class="nk-icon-burger">
                    <span class="nk-t-1"></span>
                    <span class="nk-t-2"></span>
                    <span class="nk-t-3"></span>
                </span>
            </a>
            <div class="nk-social">
                <ul>
                    <li><a class="nk-social-dribbble" href="https://dribbble.com/"><span><span class="nk-social-front fa fa-dribbble"></span><span class="nk-social-back fa fa-dribbble"></span></span></a></li>
                    <li><a class="nk-social-instagram" href="https://www.instagram.com/"><span><span class="nk-social-front fa fa-instagram"></span><span class="nk-social-back fa fa-instagram"></span></span></a></li>
                    <li><a class="nk-social-behance" href="https://behance.com/"><span><span class="nk-social-front fa fa-behance"></span><span class="nk-social-back fa fa-behance"></span></span></a></li>
                </ul>
            </div>
        </nav>
        <!-- END: Navbar -->

        <!--
            START: Navbar Left

            Additional Classes:
                .nk-navbar-lg
                .nk-navbar-overlay-content
                .nk-navbar-dark
                .nk-navbar-items-effect-1
                .nk-navbar-drop-effect-1
                .nk-navbar-drop-effect-2
        -->
        <div class="nk-navbar nk-navbar-left nk-navbar-lg nk-navbar-overlay-content nk-navbar-dark nk-navbar-drop-effect-2 d-none d-lg-block">
            <div class="nano">
                <div class="nano-content">
                    <div class="nk-nav-table">
                        <div class="nk-nav-row nk-nav-row-full nk-nav-row-center">
                            <ul class="nk-nav" data-nav-mobile="#nk-nav-mobile">
                                
        <li>
            <a href="shop.html">
                Shop
                
            </a>
        </li>
        <li class="active">
            <a href="shop-single-product.html">
                Product
                
            </a>
        </li>
        <li>
            <a href="shop-cart.html">
                Cart
                
            </a>
        </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Navbar Left -->
        <!--
            START: Navbar

            Will be shown on small screens

            Additional Classes:
                .nk-navbar-lg
                .nk-navbar-sticky
                .nk-navbar-autohide
                .nk-navbar-transparent
                .nk-navbar-transparent-always
                .nk-navbar-white-text-on-top
                .nk-navbar-dark
        -->
        <nav class="nk-navbar nk-navbar-top nk-navbar-dark d-lg-none">
            <div class="container">
                <div class="nk-nav-table">
                    
                    <a href="shop.html" class="nk-nav-logo">
                        <img src="assets/images/logo-2.svg" alt="" width="19" class="nk-nav-logo-img-dark">
                        <img src="assets/images/logo-2-light.svg" alt="" width="19" class="nk-nav-logo-img-light">
                    </a>
                    
                    <ul class="nk-nav nk-nav-right nk-nav-icons">
                        
                            <li class="single-icon">
                                <a href="#" class="nk-navbar-full-toggle">
                                    <span class="nk-icon-burger">
                                        <span class="nk-t-1"></span>
                                        <span class="nk-t-2"></span>
                                        <span class="nk-t-3"></span>
                                    </span>
                                </a>
                            </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END: Navbar -->
    

</header>
<!-- END: Nav Header -->

    
    
    
        <!--
    START: Navbar Mobile

    Additional Classes:
        .nk-navbar-dark
        .nk-navbar-align-center
        .nk-navbar-align-right
        .nk-navbar-items-effect-1
        .nk-navbar-drop-effect-1
        .nk-navbar-drop-effect-2
-->
<nav class="nk-navbar nk-navbar-full nk-navbar-align-center nk-navbar-dark nk-navbar-drop-effect-1" id="nk-nav-mobile">
    
        <div class="nk-navbar-bg">
            <div class="bg-image">
                <img src="assets/images/bg-menu-full.jpg" alt="" class="jarallax-img">
            </div>
        </div>
    
    <div class="nk-nav-table">
        <div class="nk-nav-row">
            <div class="container">
                <div class="nk-nav-header">
                    
                    <div class="nk-nav-logo">
                        <a href="shop.html" class="nk-nav-logo">
                            
                                <img src="assets/images/logo-2.svg" alt="" width="19" class="nk-nav-logo-img-dark">
                                <img src="assets/images/logo-2-light.svg" alt="" width="19" class="nk-nav-logo-img-light">
                            
                        </a>
                    </div>
                    
                    <div class="nk-nav-close nk-navbar-full-toggle">
                        <span class="nk-icon-close"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-nav-row-full nk-nav-row">
            <div class="nano">
                <div class="nano-content">
                    <div class="nk-nav-table">
                        <div class="nk-nav-row nk-nav-row-full nk-nav-row-center nk-navbar-mobile-content">
                            <ul class="nk-nav">
                                <!-- Here will be inserted menu from [data-mobile-menu="#nk-nav-mobile"] -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-nav-row">
            <div class="container">
                <div class="nk-social">
                    <ul>
                        <li><a class="nk-social-twitter" href="https://twitter.com/"><span><span class="nk-social-front fa fa-twitter"></span><span class="nk-social-back fa fa-twitter"></span></span></a></li>
                        <li><a class="nk-social-facebook" href="https://www.facebook.com/"><span><span class="nk-social-front fa fa-facebook"></span><span class="nk-social-back fa fa-facebook"></span></span></a></li>
                        <li><a class="nk-social-dribbble" href="https://dribbble.com/"><span><span class="nk-social-front fa fa-dribbble"></span><span class="nk-social-back fa fa-dribbble"></span></span></a></li>
                        <li><a class="nk-social-instagram" href="https://www.instagram.com/"><span><span class="nk-social-front fa fa-instagram"></span><span class="nk-social-back fa fa-instagram"></span></span></a></li>
                        <li><a class="nk-social-behance" href="https://behance.com/"><span><span class="nk-social-front fa fa-behance"></span><span class="nk-social-back fa fa-behance"></span></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
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
                <a href="shop.html" class="nk-shop-header-back"><span class="nk-icon-arrow-left"></span> Back to Main Shop</a>
            </div>
            <!-- END: Shop Header -->

            <!-- Was supposed to have sth here-->
            <div class="nk-gap-1"></div>
                <h3 class="h5 text-center">Update Profile (Picture)</h3>
            <div class="nk-gap-1 mnt-7"></div>

                <div class="row vertical-gap">
                <div class="nk-shop-products nk-shop-products-4-col">
                    <div class="nk-shop-product">
                        <div class="nk-shop-product-thumb">
                            <img <?php echo 'src="data:image/jpeg;base64,'.base64_encode($pic).'"';?> alt="user photo">
                            <!-- change photo-->
                        </div>
                        <form action="assets/php/updateProfilePic.php" method="POST" enctype="multipart/form-data">
                            <label>Change Picture:</label><input type="file" name="image" />
                            <input type="submit" name="insert" value="Submit New Pic"/>
                        </form>
                        <?php
                            if ($profilepic_success == 1){
                                echo '<div class="alert alert-success">Image Successfully added!</div>';                                
                            } else if ($profilepic_success == 0){
                                echo '<div class="alert alert-danger">Image could not be added!</div>';                                
                            }
                        ?>
                    </div>
                </div>
            </div>

                <div class="nk-gap-3"></div>
                <div class="nk-divider nk-divider-color-gray-6"></div>
                <div class="nk-gap-3"></div>

                <div class="nk-gap-1"></div>
                <h3 class="h5 text-center">Update Profile (General)</h3>
                <div class="nk-gap-1 mnt-7"></div>
            
            <form action="assets/php/updateGeneralProfile.php" class="nk-form nk-form-style-1" method="POST">
                <div style="padding-top: 5px;" class="col-sm-8">
                    Name:
                    <input type="text" class="form-control required" name="name" placeholder="Your Username/Email" <?php echo 'value="'.$name.'"'?>>
                </div>
                <div class="col-sm-8">
                    Gender:
                    <input type="text" class="form-control required" name="gender" placeholder="Your Gender" <?php if($gender == NULL){echo 'value="NULL"';}else{echo 'value="'.$gender.'"';}?>>
                </div>
                <div class="col-sm-8">
                    Contact Info:
                    <input type="text" class="form-control required" name="contact_info" placeholder="Your Contact Info" <?php if($contact_info == NULL){echo 'value="NULL"';}else{echo 'value="'.$contact_info.'"';}?>>
                </div>
            <div class="nk-gap-1"></div>
            <div class="text-center">
                <button type="submit" class="nk-btn nk-btn-color-dark-1">Update</button>
            </div>
            <div class="nk-gap-1"></div>
            <?php
                if ($nameErr != ''){
                    echo '<div class="alert alert-danger">'.$nameErr.'</div>';                                
                } else if ($genderErr != ''){
                    echo '<div class="alert alert-danger">'.$genderErr.'</div>';                                
                } else if ($updateGenSuccess != ''){
                    echo '<div class="alert alert-success">'.$updateGenSuccess.'</div>';                                
                }
            ?>

            </form>

            <div class="nk-gap-3"></div>
            <div class="nk-divider nk-divider-color-gray-6"></div>
            <div class="nk-gap-3"></div>

            <div class="nk-gap-1"></div>
            <h3 class="h5 text-center">Update Profile (Password)</h3>
            <div class="nk-gap-1 mnt-7"></div>
            
            <form action="assets/php/updatePassword.php" class="nk-form nk-form-style-1" method="POST">
                <div style="padding-top: 5px;" class="col-sm-8">
                    Old Password:
                    <input type="password" class="form-control required" name="old_password" placeholder="Your Old Password">
                </div>
                <div class="col-sm-8">
                    New Password:
                    <input type="password" class="form-control required" name="new_password" placeholder="Your New Password">
                </div>
                <div class="col-sm-8">
                    Confirm New Password:
                    <input type="password" class="form-control required" name="new_password_cfm" placeholder="Confirm New Password">
                </div>
            </div>
            <div class="nk-gap-1"></div>
            <div class="text-center">
                <button type="submit" class="nk-btn nk-btn-color-dark-1">Update Password</button>
            </div>
            <div class="nk-gap-1"></div>
            <?php
                if ($pwdErr != ''){
                    echo '<div class="alert alert-danger">'.$pwdErr.'</div>';                                
                } else if ($updatePwdSuccess != ''){
                    echo '<div class="alert alert-success">'.$updatePwdSuccess.'</div>';                                
                }
            ?>
            </form>

        </div>

    </div>


    </div>
    <!-- END: Main Content -->

    
        <!--
    START: Footer

    Additional Classes:
        .nk-footer-transparent
-->
<footer class="nk-footer" style="background-color: #f2f2f2;">
    

    <div class="nk-footer-widgets text-gray">
        <div class="container">
            <div class="row vertical-gap">
                <div class="col-lg-3">
                    <div class="nk-widget">
                        <h4 class="nk-widget-title text-dark">Los Angeles</h4>
                        <p class="mb-7">
                            145 Oliveshka Street, <br>
                            Los Angeles, LA 90003
                        </p>
                        <p class="mb-7">
                            +44 987 065 901
                        </p>
                        <p>
                            info@Example.com
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="nk-widget">
                        <h4 class="nk-widget-title text-dark">San Francisco</h4>
                        <p class="mb-7">
                            210 Pier Street, <br>
                            San Francisco, CA 94111
                        </p>
                        <p class="mb-7">
                            +44 987 065 902
                        </p>
                        <p>
                            info@Example.com
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="nk-widget">
                        <h4 class="nk-widget-title text-dark">New York</h4>
                        <p class="mb-7">
                            711 Snow Street, <br>
                            New York, NY 10014
                        </p>
                        <p class="mb-7">
                            +44 987 065 903
                        </p>
                        <p>
                            info@Example.com
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="nk-widget">
                        <h4 class="nk-widget-title text-dark">Follow Us</h4>
                        <div class="nk-social-2 text-gray">
                            <ul>
                                <li><a class="nk-social-facebook" href="https://www.facebook.com/"><span><span class="nk-social-front">Facebook</span><span class="nk-social-back">Facebook</span></span></a></li>
                                <li><a class="nk-social-dribbble" href="https://dribbble.com/"><span><span class="nk-social-front">Dribbble</span><span class="nk-social-back">Dribbble</span></span></a></li>
                                <li><a class="nk-social-twitter" href="https://twitter.com/"><span><span class="nk-social-front">Twitter</span><span class="nk-social-back">Twitter</span></span></a></li>
                                <li><a class="nk-social-behance" href="https://behance.com/"><span><span class="nk-social-front">Behance</span><span class="nk-social-back">Behance</span></span></a></li>
                                <li><a class="nk-social-instagram" href="https://www.instagram.com/"><span><span class="nk-social-front">Instagram</span><span class="nk-social-back">Instagram</span></span></a></li>
                                <li><a class="nk-social-pinterest" href="https://pinterest.com/"><span><span class="nk-social-front">Pinterest</span><span class="nk-social-back">Pinterest</span></span></a></li>
                                <li><a class="nk-social-linkedin" href="#"><span><span class="nk-social-front">LinkedIn</span><span class="nk-social-back">LinkedIn</span></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-footer-cont nk-footer-cont-sm">
        
            <a class="nk-footer-scroll-top-btn nk-anchor  text-dark" href="#top">
                <span class="pe-7s-angle-up"></span>
            </a>
        
        <div class="container text-center">
            <div class="nk-footer-text text-gray">
                <p>2018 &copy; Design by Unvab. Code by nK</p>
            </div>
        </div>
    </div>
</footer>
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
    unset($_SESSION['profilepic_msg']);
    unset($_SESSION['UpdateGenErr']);
    unset($_SESSION['UpdatePwdErr']);    
    }//closing brace for earlier statement (session)
?>