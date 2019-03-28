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

    <title>Fast Trade | Product</title>

    <meta name="description" content="Product Details">
    <meta name="keywords" content="individual, product, item, selected">
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


<!-- POST to Process Review action -->
<?php include 'processReview.php'; ?>




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
                <a href="index.php" class="nk-shop-header-back"><span class="nk-icon-arrow-left"></span> Back to Shop</a>
                <span class="nk-shop-header-share">
                    Share This
                    <span class="nk-shop-header-share-items nk-post-share-2">
                        <a href="#" title="Share page on Facebook" data-share="facebook"><span class="fa fa-facebook-official"></span></a>
                        <a href="#" title="Share page on Google+" data-share="google-plus"><span class="fa fa-google"></span></a>
                        <a href="#" title="Share page on Twitter" data-share="twitter"><span class="fa fa-twitter"></span></a>
                        <a href="#" title="Share page on Pinterest" data-share="pinterest"><span class="fa fa-pinterest"></span></a>
                        <!--
                        <a href="#" title="Share page on LinkedIn" data-share="linkedin"><span class="fa fa-linkedin"></span></a>
                        <a href="#" title="Share page on Vkontakte" data-share="vk"><span class="fa fa-vk"></span></a>
                        -->
                    </span>
                </span>
            </div>
            <!-- END: Shop Header -->

            <!-- START: Product Details -->

            <div class="row vertical-gap align-items-center">
                <div class="col-md-6">

                    <!-- START: Product Photos Carousel -->
                    <div class="nk-product-carousel">
                        <div class="nk-product-carousel-thumbs">
                            <div>
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
                                $sql = "SELECT * FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id WHERE item_photo.item_id=" . $page_id . ";";
                                $result = mysqli_query($connection, $sql);

                                /* (4) Fetch Results */
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<div class="active"><img height=100 src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="' . $row['title'] . '" /></div>';
                                    }
                                    /* (5) Release Connection */
                                    mysqli_free_result($result);
                                    //$result->close();
                                    mysqli_close($connection);
                                }
                            ?>
                            </div>
                        </div>
                        <div class="nk-carousel-3" data-size="1" data-autoplay="0" data-loop="false" data-dots="true" data-arrows="false" data-cell-align="center" data-parallax="true">
                            <div class="nk-carousel-inner nk-popup-gallery">
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
                                $sql = "SELECT * FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id WHERE item_photo.item_id=" . $page_id . ";";
                                $result = mysqli_query($connection, $sql);

                                /* (4) Fetch Results */
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<div>';
                                        echo '<div>';
                                        echo '<a href="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" class="nk-gallery-item" data-size="700x800"><img src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="" class="nk-carousel-parallax-img"></a>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    /* (5) Release Connection */
                                    mysqli_free_result($result);
                                    //$result->close();
                                    mysqli_close($connection);
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    <!-- END: Product Photos Carousel -->
                </div>
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
                    $sql = "SELECT *, COUNT(DISTINCT item_review.datetime) AS count_review, SUM(item_review.rating)/COUNT(item_review.item_id) AS avg_rating FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id INNER JOIN item_review ON item.item_id = item_review.item_id WHERE item_photo.item_id=" . $page_id . ";";
                    $result = mysqli_query($connection, $sql);

                    /* (4) Fetch Results */
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="col-md-5 ml-auto">';
                            echo '<!-- START: Title + Rating -->';
                            echo '<h1 class="nk-product-title h3">' . $row['title'] . '</h1>';
                            echo '<a class="nk-product-rating" href="#tab-reviews">';
                            echo '<span style="width: ' . $row['avg_rating']*20;
                            echo '%;"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>';
                            echo '<span><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>';
                            echo '</a> <small>(';
                            if ($row['count_review'] == 1) {
                                echo '1 Review';
                            } else {
                                echo $row['count_review'] . ' Reviews';
                            }
                            echo ')</small>';
                            echo '<!-- END: Title + Rating -->';
                            echo '<div class="nk-product-description">';
                            echo '<p>' . $row['description'] . '</p>';

                            echo '<div class="nk-product-price">SGD ' . $row['price'] . '</div>';
                            echo '</div>';
                        }
                        /* (5) Release Connection */
                        mysqli_free_result($result);
                        //$result->close();
                        mysqli_close($connection);
                    }
                ?>

                <!-- START: Add to Cart -->

                <!--<form action="#">-->
                    <div class="input-group">
                        <button class="nk-btn nk-btn-color-dark">Negotiate</button>
                    </div>
                <!--</form>-->

                <!-- END: Add to Cart -->
            </div>
        </div>
            <!-- END: Product Details -->

    </div>

        <div class="nk-gap-3"></div>
        <div class="nk-divider nk-divider-color-gray-6"></div>
        <div class="nk-gap-3"></div>

        <div class="container">
            <!-- START: Tabs -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="nk-tabs">
                        <ul class="nav nav-tabs text-center" role="tablist">
<!--                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-description" role="tab" data-toggle="tab">Description</a>
                            </li>-->
                            <li class="nav-item">
                                <a class="nav-link" href="#tab-info" role="tab" data-toggle="tab">Additional Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-reviews" role="tab" data-toggle="tab">Reviews
                                    <small>
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
                                            $sql = "SELECT COUNT(item_id) AS count_review FROM item_review WHERE item_id=" . $page_id . ";";
                                            $result = mysqli_query($connection, $sql);

                                            /* (4) Fetch Results */
                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '(' . $row['count_review'] . ')';
                                                }
                                                /* (5) Release Connection */
                                                mysqli_free_result($result);
                                                //$result->close();
                                                mysqli_close($connection);
                                            }
                                        ?>
                                    </small>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

<!--                             START: Tab Description
                            <div role="tabpanel" class="tab-pane fade show active" id="tab-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque rhoncus orci a purus lacinia consectetur. Vestibulum rutrum ex in odio placerat dictum. Morbi sit amet tortor mollis, tincidunt magna a, iaculis nisl. Cras varius odio a arcu rutrum, nec posuere lacus imperdiet. Proin iaculis, nibh eleifend elementum pulvinar, erat nisl consequat quam, ac ornare est sem nec libero. Fusce ac sagittis quam. Phasellus mattis, nunc a venenatis laoreet, est ipsum consectetur turpis, in ullam corper urna tortor eu purus. </p>
                            </div>
                             END: Tab Description -->

                            <!-- START: Tab Parameters -->
                            <div role="tabpanel" class="tab-pane fade" id="tab-info">
                                <div class="row">
                                    <div class="col-md-10 offset-md-3">
                                        <table class="table nk-shop-table-info">

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
                                            $sql = "SELECT * FROM item WHERE item_id=" . $page_id . ";";
                                            $result = mysqli_query($connection, $sql);

                                            /* (4) Fetch Results */
                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<tr>';
                                                    echo '<td><span class="text-black">Condition:</span></td>';
                                                    echo '<td>' . $row['condition'] . '/10</td>';
                                                    echo '</tr>';
                                                    echo '<tr>';
                                                    echo '<td><span class="text-black">Age:</span></td>';
                                                    echo '<td>' . $row['age'] . '</td>';
                                                    echo '</tr>';
                                                    echo '<tr>';
                                                    echo '<td><span class="text-black">Ad Duration:</span></td>';
                                                    echo '<td>' . $row['ad_duration'] . '</td>';
                                                    echo '</tr>';
                                                }
                                                /* (5) Release Connection */
                                                mysqli_free_result($result);
                                                //$result->close();
                                                mysqli_close($connection);
                                            }
                                        ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Tab Parameters -->

                            <!-- START: Tab Reviews -->
                            <div role="tabpanel" class="tab-pane fade show active" id="tab-reviews">
                                <div class="nk-gap mnt-10"></div>
                                <div class="nk-reviews">

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
                                        $sql = "SELECT * FROM item INNER JOIN item_review ON item.item_id = item_review.item_id WHERE item_review.item_id=" . $page_id . ";";
                                        $result = mysqli_query($connection, $sql);

                                        /* (4) Fetch Results */
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<!-- START: Review -->';
                                                echo '<div class="nk-review">';
                                                /*echo '<div class="nk-review-avatar">';
                                                echo '<a href="#"><img src="assets/images/avatar-1.jpg" alt=""></a>';
                                                echo '</div>';*/
                                                echo '<div class="nk-review-cont">';
                                                echo '<div class="nk-review-meta">';
                                                echo '<div class="nk-review-name"><a href="#">' . $row['name'] . '</a></div>';
                                                echo '<div class="nk-review-date">' . $row['datetime'] . '</div>';
                                                echo '<span class="nk-review-rating">';
                                                echo '<span style="width: ' . $row['rating']*20 . '%;"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>';
                                                echo '<span><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>';
                                                echo '</span>';
                                                echo '</div>';
                                                echo '<div class="nk-review-text">';
                                                echo '<p>' . $row['review'] . '</p>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '<!-- END: Review -->';
                                            }
                                            /* (5) Release Connection */
                                            mysqli_free_result($result);
                                            //$result->close();
                                            mysqli_close($connection);
                                        }
                                    ?>

                                    <div class="nk-gap-1"></div>
                                    <h3 class="h5 text-center">Add a Review</h3>
                                    <div class="nk-gap-1 mnt-7"></div>

                                    <form action="" method="POST" class="nk-form nk-form-style-1">
                                        <div class="nk-rating">
                                            <span>Your Rating</span>

                                            <input type="radio" id="review-rate-5" name="review-rate" value="5">
                                            <label for="review-rate-5">
                                                <span><i class="fa fa-star"></i></span>
                                            </label>

                                            <input type="radio" id="review-rate-4" name="review-rate" value="4">
                                            <label for="review-rate-4">
                                                <span><i class="fa fa-star"></i></span>
                                            </label>

                                            <input type="radio" id="review-rate-3" name="review-rate" value="3">
                                            <label for="review-rate-3">
                                                <span><i class="fa fa-star"></i></span>
                                            </label>

                                            <input type="radio" id="review-rate-2" name="review-rate" value="2">
                                            <label for="review-rate-2">
                                                <span><i class="fa fa-star"></i></span>
                                            </label>

                                            <input type="radio" id="review-rate-1" name="review-rate" value="1">
                                            <label for="review-rate-1">
                                                <span><i class="fa fa-star"></i></span>
                                            </label>
                                        </div>
                                        <span class="nk-rating input_error"><?php echo $review_rate_err; ?></span>

                                        <div class="nk-gap mt-10"></div>
                                        <div class="row vertical-gap">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control required" name="name" placeholder="Your Name" value="<?php echo $name; ?>">
                                                <span class="input_error"><?php echo $name_err; ?></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control required" name="email" placeholder="Your Email" value=<?php echo $email; ?>>
                                                <span class="input_error"><?php echo $email_err; ?></span>
                                            </div>
                                        </div>
                                        <div class="nk-gap-1"></div>
                                        <textarea class="form-control required" name="message" rows="5" placeholder="Your Comment" aria-required="true"><?php echo $message; ?></textarea>
                                        <span class="input_error"><?php echo $message_err; ?></span>

                                        <input type="hidden" name="page_id" value="<?php echo basename($_SERVER['REQUEST_URI']); ?>">

                                        <div class="nk-gap-1"></div>
                                        <div class="text-center">
                                            <button type="submit" class="nk-btn nk-btn-color-dark-1">Add a Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END: Tab Reviews -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Tabs -->
        </div>

        <div class="nk-gap-3"></div>
        <div class="nk-divider nk-divider-color-gray-6"></div>
        <div class="nk-gap-3"></div>
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
