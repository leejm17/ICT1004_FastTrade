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
    } else {
        $userid = $_SESSION['userid'];
        $activate = $_SESSION['activated'];
?>

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
    <link rel="stylesheet" href="assets/css/custom-minimal-shop.css">
    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Google Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> 

</head>







<!--
    Additional Classes:
        .nk-bg-gradient
-->
<body class="product_body">


<!-- POST to Process Review action -->
<?php include 'assets/php/processReview.php'; ?>

<!-- POST to Process Modal action -->
<?php include 'assets/php/processOffer.php'; ?>




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
                        <a href="https://www.facebook.com/" title="Share page on Facebook" data-share="facebook"><span class="fa fa-facebook-official"></span></a>
                        <a href="https://plus.google.com/" title="Share page on Google+" data-share="google-plus"><span class="fa fa-google"></span></a>
                        <a href="https://twitter.com/" title="Share page on Twitter" data-share="twitter"><span class="fa fa-twitter"></span></a>
                        <a href="https://pinterest.com/" title="Share page on Pinterest" data-share="pinterest"><span class="fa fa-pinterest"></span></a>
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
                                //$page_id = substr($page, -1);
                                $page_id = $_GET["id"];

                                /* (1) Connect to Database */
                                require_once('..\..\protected\config_fasttrade.php');
                                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                                /* (2) Handle Connection Error */
                                //      mysqli_connect_errno returns the last error code
                                if (mysqli_connect_errno()) {
                                    die(mysqli_connect_errno());    // die() is equivalent to exit()
                                }

                                /* (3) Query DB */
                                $sql = "SELECT item_photo.photo, item.title FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id WHERE item.sold=0 AND item_photo.item_id=" . $page_id . ";";

                                /* (4) Fetch Results */
                                if ($result = mysqli_query($connection, $sql)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<div class="active"><img height=100 src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="' . $row['title'] . '" /></div>';
                                    }
                                    /* (5) Release Connection */
                                    mysqli_free_result($result);
                                    mysqli_close($connection);
                                }
                            ?>
                            </div>
                        </div>
                        <div class="nk-carousel-3" data-size="1" data-autoplay="0" data-loop="false" data-dots="true" data-arrows="false" data-cell-align="center" data-parallax="true">
                            <div class="nk-carousel-inner nk-popup-gallery">
                            <?php
                                $page = basename($_SERVER['REQUEST_URI']);
                                //$page_id = substr($page, -1);
                                $page_id = $_GET["id"];

                                /* (1) Connect to Database */
                                require_once('..\..\protected\config_fasttrade.php');
                                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                                /* (2) Handle Connection Error */
                                //      mysqli_connect_errno returns the last error code
                                if (mysqli_connect_errno()) {
                                    die(mysqli_connect_errno());    // die() is equivalent to exit()
                                }

                                /* (3) Query DB */
                                $sql = "SELECT item_photo.photo, item.title FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id WHERE item.sold=0 AND item_photo.item_id=" . $page_id . ";";

                                /* (4) Fetch Results */
                                if ($result = mysqli_query($connection, $sql)) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '
                                        <div>
                                            <div>
                                                <a href="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" class="nk-gallery-item" data-size="700x800"><img src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="' . $row['title'] . '" class="nk-carousel-parallax-img"></a>
                                            </div>
                                        </div>
                                        ';
                                    }

                                    /* (5) Release Connection */
                                    mysqli_free_result($result);
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
                    //$page_id = substr($page, -1);
                    $page_id = $_GET["id"];

                    /* (1) Connect to Database */
                    require_once('..\..\protected\config_fasttrade.php');
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                    /* (2) Handle Connection Error */
                    //      mysqli_connect_errno returns the last error code
                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_errno());    // die() is equivalent to exit()
                    }

                    /* (3) Query DB */
                    $sql = "SELECT item.title, item.description, item.price, COUNT(DISTINCT item_review.datetime) AS count_review, SUM(item_review.rating)/COUNT(item_review.item_id) AS avg_rating FROM item INNER JOIN item_photo ON item.item_id = item_photo.item_id INNER JOIN item_review ON item.item_id = item_review.item_id WHERE item.sold=0 AND item_photo.item_id=" . $page_id . ";";

                    /* (4) Fetch Results */
                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-md-5 ml-auto">
                                <!-- START: Title + Rating -->
                                <h1 class="nk-product-title h3">' . $row['title'] . '</h1>
                                    <a class="nk-product-rating" href="#tab-reviews">
                                        <span style="width: ' . $row['avg_rating']*20 . '%;"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>
                                        <span><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>
                                    </a>
                                    <small>(';
                                        if ($row['count_review'] == 1) {
                                            echo '1 Review';
                                        } else {
                                            echo $row['count_review'] . ' Reviews';
                                        }
                            echo ')</small>
                                <!-- END: Title + Rating -->
                                <div class="nk-product-description">
                                    <p>' . $row['description'] . '</p>
                                <div class="nk-product-price">SGD ' . $row['price'] . '</div>
                            </div>
                            ';
                        }

                        /* (5) Release Connection */
                        mysqli_free_result($result);
                        mysqli_close($connection);
                    }
                ?>


                <!-- START: Make An Offer -->

                <?php
                    $page = basename($_SERVER['REQUEST_URI']);
                    //$page_id = substr($page, -1);
                    $page_id = $_GET["id"];

                    /* (1) Connect to Database */
                    require_once('..\..\protected\config_fasttrade.php');
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                    /* (2) Handle Connection Error */
                    //      mysqli_connect_errno returns the last error code
                    if (mysqli_connect_errno()) {
                        die(mysqli_connect_errno());    // die() is equivalent to exit()
                    }

                    /* (3) Query DB */
                    $sql = "SELECT item_id, user_id , sold, due_date FROM item WHERE item_id=" . $page_id . " GROUP BY item.user_id ";

                    /* (4) Fetch Results */
                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($userid == $row['user_id']) {
                                echo '
                                <div class="alert alert-danger" style="display:inline-block;">
                                    You own this item!
                                    <a href="edit-item.php?item_id_var=' . $row["item_id"] . '" style="float:right; padding-left:1em;"><i class="far fa-edit"></i>Edit</a>
                                </div>
                                <br />
                                <a href="#" class="alert alert-info dropdown-toggle" data-toggle="dropdown">
                                    View All Chats
                                </a>
                                <ul class="dropdown-menu" style="border-width: 0px;">';

                                    $sql_1 = "SELECT item_id, buyer_id FROM offer WHERE item_id=". $page_id .";";
                                    if ($result_1 = mysqli_query($connection, $sql_1)) {
                                        if (mysqli_num_rows($result_1) > 0) {
                                            while ($row = mysqli_fetch_assoc($result_1)) {
                                                echo '
                                                <li class="alert alert-info" style="background: white; margin: 0px;"><a id="chat_btn" href="product.php?id='. $row['item_id'] .'&buyer_id='. $row['buyer_id'] .'">Chat with '. $row['buyer_id'] .'</a></li>
                                                ';
                                            }
                                        } else {
                                            echo '
                                            <li class="alert alert-info" style="background: white; margin: 0px;">There are no offers yet</li>
                                            ';
                                        }
                                        mysqli_free_result($result_1);
                                    }

                                echo '
                                </ul>
                                ';
                            } else if ($row['sold'] == 1) {
                                echo '
                                <div class="alert alert-danger" style="display:inline-block;">
                                    This item has been sold.
                                </div>
                                ';
                            } else if ($row['due_date'] < date("Y-m-d H:i:s")) {
                                echo '
                                <div class="alert alert-danger" style="display:inline-block;">
                                    This item has passed its due date.
                                </div>
                                ';
                            } else {
                                echo '
                                <button id="chat_btn" type="button" class="btn btn-info">
                                    Chat!
                                </button>
                                <button id="make_offer" type="button" class="btn btn-primary" data-toggle="modal" data-target="#offerModal">
                                    Make an Offer!
                                </button>
                                ';
                            }
                        }

                        /* (5) Release Connection */
                        mysqli_free_result($result);
                        mysqli_close($connection);
                    }
                ?>

                <!-- START: Offer modal -->
                <div class="container-fluid">
                    <div class="col-lg-6">
                        <form id="js_offer_review" method="POST">
                            <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="offerModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="offerModalLabel">What is your offer?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-lg-5 col-md-3 col-sm-3 col-xs-12" for="offer_price">I would like to offer:</label>
                                          <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="div_offer_price">
                                              <input type="text" class="form-control" id="offer_price" name="offer_price" placeholder="enter up to two decimal values" value="<?php echo $offer_price; ?>">
                                              <!--<span class="input_error" id="offer_price_error">s</span>-->
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-5 col-md-3 col-sm-3 col-xs-12" for="offer_loc">Meetup Location:</label>
                                          <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="div_offer_loc">
                                              <input type="text" class="form-control" id="offer_loc" name="offer_loc" placeholder="where is a convenient location?" value="<?php echo $offer_loc; ?>">
                                              <!--<span class="input_error" id="offer_price_error"></span>-->
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-lg-5 col-md-3 col-sm-3 col-xs-12" for="offer_remarks">Remarks (if any):</label>
                                          <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="div_offer_remarks">
                                              <input type="text" class="form-control" id="offer_remarks" name="offer_remarks" value="<?php echo $offer_remarks; ?>">
                                              <!--<span class="input_error" id="offer_price_error"></span>-->
                                          </div>
                                      </div>
                                      <input type="hidden" name="page_id" value="<?php echo basename($_SERVER['REQUEST_URI']) ?>">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info">Review Offer</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Offer modal -->

                <!-- START: Confirm modal -->
                <div class="container-fluid">
                    <div class="col-lg-6">
                        <form class="form-horizontal" method="POST">
                            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="confirmModalLabel">Please review your offer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <table class="table nk-shop-table-info" style="width:100%">
                                              <?php
                                                $page = basename($_SERVER['REQUEST_URI']);
                                                //$page_id = substr($page, -1);
                                                $page_id = $_GET["id"];

                                                /* (1) Connect to Database */
                                                require_once('..\..\protected\config_fasttrade.php');
                                                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                                                /* (2) Handle Connection Error */
                                                //      mysqli_connect_errno returns the last error code
                                                if (mysqli_connect_errno()) {
                                                    die(mysqli_connect_errno());    // die() is equivalent to exit()
                                                }

                                                /* (3) Query DB */
                                                $sql = "SELECT title, user_id, price FROM item WHERE item.sold=0 AND item_id=" . $page_id . " AND item.due_date>NOW();";

                                                /* (4) Fetch Results */
                                                if ($result = mysqli_query($connection, $sql)) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                        <tr>
                                                            <td style="width:25%"></td>
                                                            <td style="width:25%"><span class="font-weight-bold">Product:</span></td>
                                                            <td colspan="2"><span class="">' . $row['title'] . '</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:25%"></td>
                                                            <td style="width:25%"><span class="font-weight-bold">Seller:</span></td>
                                                            <td colspan="2"><span class="">' . $row['user_id'] . '</span></td>
                                                            <input type=hidden name="seller_id" value="' . $row['user_id'] . '" />
                                                        </tr>
                                                        <td colspan="4"></td>
                                                        <tr>
                                                            <td colspan="2" style="text-align:center;"><span class="font-weight-bold"><u>Original Price</u></span></td>
                                                            <td colspan="2" style="text-align:center;"><span class="font-weight-bold"><u>Your Bargain</u></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="text-align:center;"><span class="text-black">SGD ' . $row['price'] . '</span></td>
                                                            <td colspan="2" style="text-align:center;">SGD <span class="text-black" id="submit_price" name="submit_price"></span></td>
                                                            <input type=hidden id="hidden_submit_price" name="submit_price" />
                                                        </tr>
                                                        ';
                                                    }

                                                    /* (5) Release Connection */
                                                    mysqli_free_result($result);
                                                    mysqli_close($connection);
                                                }
                                            ?>
                                              <td colspan="4"></td>
                                              <tr>
                                                  <td colspan="4" style="text-align:center;">Meetup Location: <span class="text-black" id="submit_loc" name="submit_loc"></span></td>
                                                  <input type=hidden id="hidden_submit_loc" name="submit_loc" />
                                              </tr>
                                              <tr>
                                                  <td colspan="4" style="text-align:center;">Remarks (if any): <span class="text-black" id="submit_remarks" name="submit_remarks"></span></td>
                                                  <input type=hidden id="hidden_submit_remarks" name="submit_remarks" />
                                              </tr>
                                          </table>
                                      </div>
                                      <input type="hidden" name="page_id" value="<?php echo basename($_SERVER['REQUEST_URI']) ?>">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#offerModal">Go Back</button>
                                    <button type="submit" name="offer_submit" class="btn btn-success">Submit Offer!</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Confirm modal -->

                <!-- END: Make An Offer -->

            </div>
            <!-- END: Product Details -->

        </div>

        <div class="nk-gap-3 hide-chat"></div>
        <div class="nk-divider nk-divider-color-gray-6 hide-chat"></div>
        <div class="nk-gap-3 hide-chat"></div>

        <!-- START: Chat Function -->
        <div hide-chat>

        </div>
        <!-- END: Chat Function -->

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
                                    <?php
                                        $page = basename($_SERVER['REQUEST_URI']);
                                        //$page_id = substr($page, -1);
                                        $page_id = $_GET["id"];

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

                                        /* (4) Fetch Results */
                                        if ($result = mysqli_query($connection, $sql)) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '(' . $row['count_review'] . ')';
                                            }

                                            /* (5) Release Connection */
                                            mysqli_free_result($result);
                                            mysqli_close($connection);
                                        }
                                    ?>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

<!--                             START: Tab Description
                            <div role="tabpanel" class="tab-pane fade show active" id="tab-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque rhoncus orci a purus lacinia consectetur. </p>
                            </div>
                             END: Tab Description -->

                            <!-- START: Tab Parameters -->
                            <div role="tabpanel" class="tab-pane fade" id="tab-info">
                                <div class="row">
                                    <div class="col-md-10 offset-md-3">
                                        <table class="table nk-shop-table-info" style="width:60%;">
                                        <?php
                                            $page = basename($_SERVER['REQUEST_URI']);
                                            //$page_id = substr($page, -1);
                                            $page_id = $_GET["id"];

                                            /* (1) Connect to Database */
                                            require_once('..\..\protected\config_fasttrade.php');
                                            $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                                            /* (2) Handle Connection Error */
                                            //      mysqli_connect_errno returns the last error code
                                            if (mysqli_connect_errno()) {
                                                die(mysqli_connect_errno());    // die() is equivalent to exit()
                                            }

                                            /* (3) Query DB */
                                            $sql = "SELECT item.user_id, category.name, item.condition, item.age, item.ad_duration, DATE_FORMAT(due_date, '%D %M %Y') AS format_date FROM item INNER JOIN category ON category.category_id = item.category_id WHERE item_id=" . $page_id . ";";

                                            /* (4) Fetch Results */
                                            if ($result = mysqli_query($connection, $sql)) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '
                                                    <tr>
                                                        <td class="addinfo_table_right"><span class="text-black">Due By:</span></td>
                                                        <td class="addinfo_table_left">' . $row['format_date'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="addinfo_table_right"><span class="text-black">Seller:</span></td>
                                                        <td class="addinfo_table_left">' . $row['user_id'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="addinfo_table_right"><span class="text-black">Product Category:</span></td>
                                                        <td class="addinfo_table_left">' . $row['name'] . '</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="addinfo_table_right"><span class="text-black">Product Condition:</span></td>
                                                        <td class="addinfo_table_left">' . $row['condition'] . '/10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="addinfo_table_right"><span class="text-black">Product Age:</span></td>
                                                        <td class="addinfo_table_left">' . $row['age'] . ' years</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="addinfo_table_right"><span class="text-black">Ad Duration:</span></td>
                                                        <td class="addinfo_table_left">' . $row['ad_duration'] . ' years</td>
                                                    </tr>
                                                    ';
                                                }

                                                /* (5) Release Connection */
                                                mysqli_free_result($result);
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
                                        //$page_id = substr($page, -1);
                                        $page_id = $_GET["id"];

                                        /* (1) Connect to Database */
                                        require_once('..\..\protected\config_fasttrade.php');
                                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                                        /* (2) Handle Connection Error */
                                        //      mysqli_connect_errno returns the last error code
                                        if (mysqli_connect_errno()) {
                                            die(mysqli_connect_errno());    // die() is equivalent to exit()
                                        }

                                        /* (3) Query DB */
                                        $sql = "SELECT name, rating, review, DATE_FORMAT(datetime, '%D %M %Y') AS format_date  FROM item INNER JOIN item_review ON item.item_id = item_review.item_id WHERE item.sold=0 AND item_review.item_id=" . $page_id . " ORDER BY datetime DESC;";

                                        /* (4) Fetch Results */
                                        if ($result = mysqli_query($connection, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '
                                                    <!-- START: Review -->
                                                    <div class="nk-review">
                                                    ' .
                                                    //<div class="nk-review-avatar">
                                                      //<a href="#"><img src="assets/images/avatar-1.jpg" alt=""></a>
                                                    //</div>
                                                    '
                                                    <div class="nk-review-cont">
                                                        <div class="nk-review-meta">
                                                            <div class="nk-review-name" style="font-size:18px">' . $row['name'] . '</div>
                                                                <div class="nk-review-date">' . $row['format_date'] . '</div>
                                                                    <span class="nk-review-rating">
                                                                        <span style="width: ' . $row['rating']*20 . '%;"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>
                                                                        <span><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></span>
                                                                    </span>
                                                        </div>
                                                        <div class="nk-review-text">
                                                            <p>' . $row['review'] . '</p>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- END: Review -->
                                                    ';
                                                    }
                                            } else {
                                                echo '
                                                <div class="row">
                                                    <div style="text-align: center;" class="col-lg-12 col-md-6 col-sm-3">
                                                        <p style="font-size: 24px">Be the first to review this product!</p>
                                                    </div>
                                                </div>
                                                ';
                                            }

                                            /* (5) Release Connection */
                                            mysqli_free_result($result);
                                            mysqli_close($connection);
                                        }
                                    ?>

                                    <?php
                                        $page = basename($_SERVER['REQUEST_URI']);
                                        //$page_id = substr($page, -1);
                                        $page_id = $_GET["id"];

                                        /* (1) Connect to Database */
                                        require_once('..\..\protected\config_fasttrade.php');
                                        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                                        /* (2) Handle Connection Error */
                                        //      mysqli_connect_errno returns the last error code
                                        if (mysqli_connect_errno()) {
                                            die(mysqli_connect_errno());    // die() is equivalent to exit()
                                        }

                                        /* (3) Query DB */
                                        $sql = "SELECT user_id FROM item WHERE sold=0 AND item_id=" . $page_id . " AND due_date>NOW();";

                                        /* (4) Fetch Results */
                                        if ($result = mysqli_query($connection, $sql)) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                if ($userid != $row['user_id']) {
                                                    echo '
                                                    <div class="nk-gap-3"></div>
                                                    <div class="nk-divider nk-divider-color-gray-6"></div>
                                                    <div class="nk-gap-3"></div>

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
                                                        <span class="nk-rating input_error">'. $review_rate_err . '</span>

                                                        <div class="nk-gap mt-10"></div>
                                                        <div class="row vertical-gap">
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control required" name="name" placeholder="Title" value="' . $name . '">
                                                                <span class="input_error">' . $name_err . '</span>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control required" name="email" placeholder="By: ' . $userid . '" disabled value="' . $userid . '">
                                                                <!--<span class="input_error">' . $email_err . '</span>-->
                                                            </div>
                                                        </div>
                                                        <div class="nk-gap-1"></div>
                                                        <textarea class="form-control required" name="message" rows="5" placeholder="Your Comment" aria-required="true">' . $message . '</textarea>
                                                        <span class="input_error">' . $message_err . '</span>

                                                        <input type="hidden" name="page_id" value="' . basename($_SERVER['REQUEST_URI']) . '">
                                                        
                                                        <div class="nk-gap-1"></div>
                                                        <!-- Google reCAPTCHA box -->
                                                        <div class="g-recaptcha" data-sitekey="6LfTIpsUAAAAALfjbRj_5YAEZJNA0BmubsmkbX-f"></div>
                                                        <span class="input_error">' . $recaptcha_err . '</span>

                                                        <div class="nk-gap-1"></div>
                                                        <div class="text-center">
                                                            <button type="submit" name="review_submit" class="nk-btn nk-btn-color-dark-1">Add a Review</button>
                                                        </div>
                                                    </form>
                                                    ';
                                                }
                                            }

                                            /* (5) Release Connection */
                                            mysqli_free_result($result);
                                            mysqli_close($connection);
                                        }
                                    ?>
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


<!--START: Footer
    Additional Classes:
        .nk-footer-transparent
-->
<?php include 'php/footer.inc.php'; ?>
<!-- END: Footer -->





<!-- START: Scripts -->

<!-- Custom Styles -->
<script src="assets/js/custom.js"></script>

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
    }//closing brace for earlier statement (session)
?>