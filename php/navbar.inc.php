<?php
echo
'
<header class="nk-header nk-header-left nk-header-opaque">
        <!--
            START: Navbar

            Additional Classes:
                .nk-navbar-dark
        -->
        <nav class="nk-navbar nk-navbar-cont nk-navbar-dark d-none d-lg-flex">

            <a href="index.php" class="nk-nav-logo">
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
                    <li><a class="nk-social-facebook" href="https://www.facebook.com/"><span><span class="nk-social-front fa fa-facebook"></span><span class="nk-social-back fa fa-facebook"></span></span></a></li>
                    <li><a class="nk-social-instagram" href="https://instagram.com/"><span><span class="nk-social-front fa fa-instagram"></span><span class="nk-social-back fa fa-instagram"></span></span></a></li>
                    <li><a class="nk-social-twitter" href="https://twitter.com/"><span><span class="nk-social-front fa fa-twitter"></span><span class="nk-social-back fa fa-twitter"></span></span></a></li>
                    <li><a class="nk-social-pinterest" href="https://pinterest.com/"><span><span class="nk-social-front fa fa-pinterest"></span><span class="nk-social-back fa fa-pinterest"></span></span></a></li>
                    <li><a class="nk-social-google" href="https://plus.google.com/"><span><span class="nk-social-front fa fa-google"></span><span class="nk-social-back fa fa-google"></span></span></a></li>
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
                                <li class="'; if (stripos((basename($_SERVER['REQUEST_URI'])), "profile.php") !== false) {echo "active";} echo '">
                                    <a href="userProfile.php">
                                        My Profile

                                    </a>
                                </li>
                                <li class="'; if (stripos((basename($_SERVER['REQUEST_URI'])), "index.php") !== false) {echo "active";} echo '">
                                    <a href="index.php">
                                        Shop

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

                    <a href="index.php" class="nk-nav-logo">
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
';
?>