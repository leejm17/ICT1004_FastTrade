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

    <title>Fast Trade | Shop</title>

    <meta name="description" content="Shop Menu">
    <meta name="keywords" content="menu, products, items, overview, content">
    <meta name="author" content="Lee Jun Ming">

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
                <a href="#" class="nk-shop-layout-toggle active" data-cols="4"><span class="nk-icon-layout-3"></span></a>
                <a href="#" class="nk-shop-filter-toggle">
                    <span>Filter</span>
                    <span>Hide Filter</span>
                </a>
                <a href="#" class="nk-btn-color-white" data-toggle="dropdown">
                    Login
                </a>
                <ul class="dropdown-menu">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
                <!--<a href="login.php" data-cols="3">Login</a>-->
            </div>
            <!-- END: Shop Header -->

            <!--
                START: Shop Filter

                Additional Classes:
                    .active
            -->
            <div class="nk-shop-filter">
                <div class="row vertical-gap">
                    <div class="col-lg col-md-4">
                        <h3 class="nk-shop-filter-item-title">Sort By</h3>
                        <ul class="nk-shop-filter-item">
                            <li data-filter="Default AllCat AllPrice" ><a class="active" href="#">Default</a></li>
                            <!--<li><a href="#">Popularity</a></li>-->
                            <li data-filter="Default Newest AllCat AllPrice"><a href="#">Newest</a></li>
                            <li data-filter="Default LowHigh AllCat AllPrice"><a href="#">Price: Low to High</a></li>
                            <li data-filter="Default HighLow AllCat AllPrice"><a href="#">Price: High to Low</a></li>
                        </ul>
                    </div>
<!--                    <div class="col-lg col-md-4">
                        <h3 class="nk-shop-filter-item-title">Gender</h3>
                        <ul class="nk-shop-filter-item">
                            <li><a class="active" href="#">Show All</a></li>
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Women</a></li>
                        </ul>
                    </div>-->
                    <div class="col-lg col-md-4">
                        <h3 class="nk-shop-filter-item-title">Category</h3>
                        <ul class="nk-shop-filter-item">
                            <li><a class="active" href="#">Show All</a></li>
                            <li><a href="#">Computers and IT</a></li>
                            <li><a href="#">Furniture</a></li>
                            <li><a href="#">Home Appliance</a></li>
                            <li><a href="#">Home Repair</a></li>
                            <li><a href="#">Kids</a></li>
                            <li><a href="#">Services</a></li>
                        </ul>
                    </div>
<!--                    <div class="col-lg col-md-4">
                        <h3 class="nk-shop-filter-item-title">Color</h3>
                        <ul class="nk-shop-filter-item">
                            <li><a class="active" href="#">Show All</a></li>
                            <li><a href="#">Black</a></li>
                            <li><a href="#">Brown</a></li>
                            <li><a href="#">Gray</a></li>
                            <li><a href="#">White</a></li>
                            <li><a href="#">Red</a></li>
                            <li><a href="#">Green</a></li>
                            <li><a href="#">Orange</a></li>
                            <li><a href="#">Blue</a></li>
                        </ul>
                    </div>-->
                    <div class="col-lg col-md-4">
                        <h3 class="nk-shop-filter-item-title">Price</h3>
                        <ul class="nk-shop-filter-item">
                            <li><a class="active" href="#">Show All</a></li>
                            <li><a href="#">Below $50.00</a></li>
                            <li><a href="#">$50.00 - $99.00</a></li>
                            <li><a href="#">$100.00 - $149.00</a></li>
                            <li><a href="#">Above $150.00</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: Shop Filter -->

            <!--
                START: Shop Products

                Additional Classes:
                    .nk-shop-products-1-col
                    .nk-shop-products-2-col
                    .nk-shop-products-3-col
                    .nk-shop-products-4-col
            -->
            <div class="nk-shop-products nk-shop-products-4-col">


                <?php
                    $page = basename($_SERVER['REQUEST_URI']);
                    $page_id = substr($page, -1);

                    /* (1) Connect to Database */
                    require_once('..\..\protected\config_fasttrade.php');
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                    /* (2) Handle Connection Error */
                    //      mysqli_connect_errno returns the last error code
                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_errno());    // die() is equivalent to exit()
                    }

                    /* (3) Query DB */
                    $sql = "SELECT * FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id GROUP BY item.item_id;";

                    /* (4) Fetch Results */
                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="nk-shop-product">';
                            echo '<div class="nk-shop-product-thumb">';
                            echo '<a href="product.php?id=' . $row['item_id'] .'">';
                            echo '<img height=284 src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="' . $row['title'] . '" />';
                            echo '</a>';
                            echo '</div>';
                            echo '<h2 class="nk-shop-product-title">';
                            echo '<a href="product.php?id=' . $row['item_id'] . '">' . $row['title'] . '</a>';
                            echo '</h2>';
                            echo '<div class="nk-shop-product-btn">';
                            echo '<div class="nk-shop-product-price">';
                            echo 'SGD ' . $row['price'];
                            echo '</div>';
                            echo '<a href="product.php?id=' . $row['item_id'] . '" class="nk-shop-product-add-to-cart">Contact Seller</a>';
                            echo '</div>';
                            echo '</div>';

                            //echo '<img style="width:40%; float:left; margin-right:10px;" src="data:image/jpeg;base64, ' . base64_encode($row['picture']) . '"/>';
                        }
                    }

                    /* (5) Release Connection */
                    mysqli_free_result($result);
                    mysqli_close($connection);
                ?>

            </div>
            <!-- END: Shop Products -->

            <div class="nk-shop-load-more">
                <a href="#" class="nk-shop-load-more-btn">Load More Products</a>
            </div>
        </div>
    </div>


    </div>
    <!-- END: Main Content -->


        <!--
    START: Footer

    Additional Classes:
        .nk-footer-transparent
-->
<?php include("php/footer.inc.php") ?>
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
