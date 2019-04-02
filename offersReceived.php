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

    <title>Fast Trade | Offers Received</title>

    <meta name="description" content="Review Offers Received">
    <meta name="keywords" content="offers, received, review">
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
</head>







<!--
    Additional Classes:
        .nk-bg-gradient
-->
<body class="product_body">


<!-- POST to Process Modal action -->
<?php include 'assets/php/processAmend.php'; ?>




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
            <!-- START: User Profile Header -->
            <?php include 'php/profile_header.inc.php'; ?>
            <!-- END: User Profile Header -->

            <h2 class="text-center">Offers Received</h2>
            <div class="nk-gap-3"></div>

            <?php
                /* (1) Connect to Database */
                require_once('..\..\protected\config_fasttrade.php');
                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                /* (2) Handle Connection Error */
                //      mysqli_connect_errno returns the last error code
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_errno());    // die() is equivalent to exit()
                }

                /* (3) Query DB */
                $sql = "SELECT item_photo.photo, item.title, offer.buyer_id, item.price, offer.asking_price, offer.trading_place, offer.remarks, item.description, item.item_id
                        FROM item
                        INNER JOIN item_photo ON item.item_id = item_photo.item_id
                        INNER JOIN offer ON item.item_id = offer.item_id
                        WHERE offer.seller_id = '" . $userid . "' AND offer.accept = 2 AND item.sold = 0
                        GROUP BY item.item_id;";
                // AND item.due_date>NOW()
                //echo $sql;

                /* (4) Fetch Results */
                if ($result = mysqli_query($connection, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            /*echo '<br>';
                            echo '<img height=100 src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="' . $row['title'] . '" />';
                            echo '<br>';
                            echo $row['title'];
                            echo '<br>';
                            echo $row['buyer_id'];
                            echo '<br>';
                            echo $row['avg_rating']*20;
                            echo '<br>';
                            echo $row['count_review'];
                            echo '<br>';
                            echo $row['price'];
                            echo '<br>';
                            echo $row['asking_price'];
                            echo '<br>';
                            echo $row['trading_place'];
                            echo '<br>';
                            echo $row['remarks'];
                            echo '<br>';*/

                            echo '
                            <!-- START: Offers Received -->

                            <div class="row vertical-gap align-items-center" style="border: 3px solid #999; border-radius: 10px;">
                                    <div class="col-md-3 offset-md-1 col-sm-3 offset-sm-1" style="">
                                        <img style="max-height: 100%; max-width: 100%;" src="data:image/jpeg;base64, ' . base64_encode($row['photo']) . '" alt="' . $row['title'] . '" />
                                    </div>
                                    <div class="col-md-4 col-sm-4" style="">
                                        <!--START: Title-->
                                        <h1 class="nk-product-title h4"><a href="product.php?id='. $row['item_id'] .'" style="color: inherit; text-decoration:none">'. $row['title'] .'</a></h1>
                                        <h1 class="nk-product-title h6">Buyer: '. $row['buyer_id'] .'</h1>
                                         <!--END: Title-->
                                        <div class="nk-product-description">
                                            <!--<p>'. $row['description'] .'</p>-->
                                            <table class="table" style="width:100%;">
                                                <tr>
                                                    <td class="addinfo_table_left"><span><strong>Original: </strong>SGD '. $row['price'] .'</span></td>
                                                    <td class="addinfo_table_left"><span><strong>Bargain: </strong>SGD '. $row['asking_price'] .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="addinfo_table_left"><span><strong>Meetup Location: </strong>'. $row['trading_place'] .'</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="addinfo_table_left"><span><strong>Remarks: </strong>'. $row['remarks'] .'</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3" style="">
                                        <button id="accept_btn" type="button" class="btn btn-success" data-toggle="modal" data-target="#acceptModal'. $row['item_id'] .'">
                                            <span class="fa fa-check"></span> Accept
                                        </button>
                                        <button id="reject_btn" type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal'. $row['item_id'] .'">
                                            <span class="fa fa-close"></span> Reject
                                        </button>
                                    </div>
                            </div>';

                            echo '
                            <div class="nk-gap-1"></div>
                            <div class="nk-divider nk-divider-color-gray-6"></div>
                            <div class="nk-gap-1"></div>
                            ';

                            echo '
                            <!-- START: Accept modal -->
                            <div class="container-fluid">
                                <div class="col-lg-6">
                                    <form class="form-horizontal" method="POST">
                                        <div class="modal fade" id="acceptModal'. $row['item_id'] .'" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel'. $row['item_id'].'" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="acceptModalLabel'. $row['item_id'] .'">Accept this offer?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <table class="table nk-shop-table-info" style="width:100%">
                                                                <tr>
                                                                    <td style="width:25%"></td>
                                                                    <td style="width:25%"><span class="font-weight-bold">Product:</span></td>
                                                                    <td colspan="2"><span class="">' . $row['title'] . '</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:25%"></td>
                                                                    <td style="width:25%"><span class="font-weight-bold">Buyer:</span></td>
                                                                    <td colspan="2"><span class="">' . $row['buyer_id'] . '</span></td>
                                                                    <input type=hidden name="buyer_id" value="' . $row['buyer_id'] . '" />
                                                                </tr>
                                                                    <td colspan="4"></td>
                                                                <tr>
                                                                    <td colspan="2" style="text-align:center;"><span class="font-weight-bold"><u>Your Price</u></span></td>
                                                                    <td colspan="2" style="text-align:center;"><span class="font-weight-bold"><u>The Bargain</u></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align:center;">SGD <span class="text-black">' . $row['price'] . '</span></td>
                                                                    <td colspan="2" style="text-align:center;">SGD <span class="text-black">' . $row['asking_price'] . '</span></td>
                                                                    <input type=hidden id="hidden_accept_submit_price" name="accept_submit_price" value="' . $row['asking_price'] . '" />
                                                                </tr>
                                                                     <td colspan="4"></td>
                                                                <tr>
                                                                    <td colspan="4" style="text-align:center;">Meetup Location: <span class="text-black">' . $row['trading_place'] . '</span></td>
                                                                    <input type=hidden id="hidden_accept_submit_loc" name="accept_submit_loc" value="' . $row['trading_place'] . '" />
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" style="text-align:center;">Remarks (if any): <span class="text-black">' . $row['remarks'] . '</span></td>
                                                                    <input type=hidden id="hidden_accept_submit_remarks" name="accept_submit_remarks" value="' . $row['remarks'] . '" />
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <input type="hidden" name="item_id" value="'. $row['item_id'] .'">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal">Cancel</button>
                                                        <button type="submit" name="offer_accept" class="btn btn-success">Accept Offer!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END: Accept modal -->
                            ';

                            echo '
                            <!-- START: Reject modal -->
                            <div class="container-fluid">
                                <div class="col-lg-6">
                                    <form class="form-horizontal" method="POST">
                                        <div class="modal fade" id="rejectModal'. $row['item_id'] .'" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel'. $row['item_id'] .'" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="rejectModalLabel'. $row['item_id'] .'">Reject this offer?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                                <input type="hidden" name="item_id" value="'. $row['item_id'] .'">
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                <button type="submit" name="offer_reject" class="btn btn-danger">Yes</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END: Reject modal -->

                            <!-- END: Offers Received -->
                            ';
                        }
                    } else {
                        echo '
                        <div class="row">
                            <div style="text-align: center;" class="col-lg-12 col-md-6 col-sm-3">
                                <p style="font-size: 24px">You have not received any offers.</p>
                                <a href="sell-item.php" style="font-size: 20px; color: inherit; text-decoration:none">List one now!</a>
                            </div>
                        </div>

                        <div class="nk-gap-3"></div>
                        <div class="nk-divider nk-divider-color-gray-6"></div>
                        <div class="nk-gap-3"></div>
                        ';
                    }
                    /* (5) Release Connection */
                    mysqli_free_result($result);
                    mysqli_close($connection);
                }
            ?>

        </div>

<!--        <div class="nk-gap-3"></div>
        <div class="nk-divider nk-divider-color-gray-6"></div>
        <div class="nk-gap-3"></div>-->
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
    }
?>