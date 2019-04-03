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
	if(!isset($_SESSION['userid']) && !isset($_SESSION['activated']))
	{
		header('Location: 403.php');
	} else {
            $userid = $_SESSION['userid'];
            $activate = $_SESSION['activated'];
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Fast Trade | My Listings</title>

    <meta name="description" content="All Listings">
    <meta name="keywords" content="myproducts, myitems">
    <meta name="author" content="Tan Chin How">

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
    <link rel="stylesheet" href="assets/css/ft_css.css">
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
<?php include("php/navbar.inc.php") ?>
<!-- END: Navbar Header -->



    <!--
        START: Main Content

        Additional Classes:
            .nk-main-dark
    -->
    <div class="nk-main">

    <div class="bg-white">
        <div class="container">
            <!-- START: User Profile Header -->
            <?php include 'php/profile_header.inc.php'; ?>
            <!-- END: User Profile Header -->

            <!--
                START: Shop Filter

                Additional Classes:
                    .active
            -->
            <div class="nk-shop-filter">
                <div class="row vertical-gap">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <h3 class="nk-shop-filter-item-title">Sort By</h3>
                        <ul class="nk-shop-filter-item">
                            <li data-filter="Default AllCat AllPrice" ><a class="active" href="#">Default</a></li>
                            <!--<li><a href="#">Popularity</a></li>-->
                            <li data-filter="Default Newest AllCat AllPrice"><a href="#">Newest</a></li>
                            <li data-filter="Default LowHigh AllCat AllPrice"><a href="#">Price: Low to High</a></li>
                            <li data-filter="Default HighLow AllCat AllPrice"><a href="#">Price: High to Low</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-4">
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

                    <div class="col-lg-4 col-sm-4 col-md-4">
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
			<div class="nk-box">


				<div class="col-sm-10 col-md-10 col-lg-10" style="border-style:solid; border-width:2px; margin-left: 10%;">
				<?php


						require_once('..\..\protected\config_fasttrade.php');
						// Create connection
						$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
				 		if ($connection->connect_error) {
							die("connection failed: " . $connection->connect_error);
						}

						$sql = 'SELECT * FROM item_photo INNER JOIN item ON item.item_id = item_photo.item_id WHERE item.user_id = "' . $userid . '" GROUP BY item.item_id';
						$result = $connection->query($sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result))
                                                    {


                                                        echo '<div class = "col-lg-12 col-sm-12 col-md-12"><figure><img style="width:85%; margin-top:1%; margin-left:7.5%; margin-right:7.5%; margin-top:8%;" class="img-responsive" src="data:image/jpg;base64,' .
                                                        base64_encode($row['photo']) . '"/></figure><br/></div>';
                                                        ?>
                                                                        <!--- Get the values($row["values"]) from the query and display it
                                                                                  Disabled editing from user unless they click the button edit which will direct them to edit-item.
                                                                                  edit-item page will get the item id of that particular item and allow editing.
                                                                        --->

                                                                        <div class="form-group container-fluid">
                                                                                <label for="title" class="inlabels control-label col-md-8 col-lg-8 col-sm-8" style="margin-left:7.5%;">Title:</label>
                                                                                <input name="title" class="form-control col-md-8 col-lg-8 col-sm-8" type="text" id="title" value="<?php echo $row["title"]?>" style="margin-left:7.5%;" readonly >
                                                                        </div>

                                                                        <div class="form-group container-fluid">
                                                                                <label for="description" class="inlabels control-label col-md-8 col-lg-8 col-sm-8" style="margin-left:7.5%;">Description:</label>
                                                                                <input name="description" class="form-control col-md-8 col-lg-8 col-sm-8" type="text" id="description" value="<?php echo $row["description"] ?>" style="margin-left:7.5%;" readonly>
                                                                        </div>

                                                                        <div class="form-group container-fluid">
                                                                                <label class="inlabels control-label col-sm-5" style="margin-left:7.5%;" for="condition">Condition: </label>
                                                                                <select name="condition" class="form-control col-md-8 col-lg-8 col-sm-8" style="margin-left:7.5%;" disabled >


                                                                                        <option value ="">
                                                                                        <?php
                                                                                        $condition = '';
                                                                                        if ($row["condition"]==1)
                                                                                        {
                                                                                                $condition = "Minor Scratches (1)";
                                                                                        }
                                                                                        else if ($row["condition"]==2 )
                                                                                        {
                                                                                                $condition = "Good (2)";
                                                                                        }
                                                                                        else if ($row["condition"]==3)
                                                                                        {
                                                                                                $condition = "Great (3)";
                                                                                        }
                                                                                        else if ($row["condition"]==4)
                                                                                        {
                                                                                                $condition = "Perfect (4)";
                                                                                        }
                                                                                        else if ($row["condition"]==5)
                                                                                        {
                                                                                                $condition = "Never Opened (5)";
                                                                                        }

                                                                                        echo('---'.$condition);?>---</option>

                                                                                        <option value ="5">Never Opened</option>
                                                                                        <option value ="4">Perfect</option>
                                                                                        <option value ="3">Great</option>
                                                                                        <option value ="2">Good</option>
                                                                                        <option value ="1">Minor Scratches</option>
                                                                                </select>
                                                                        </div>
                                                                                        <div class="form-group container-fluid">
                                                                                        <label class="inlabels control-label col-sm-5" style="margin-left:7.5%;" for="category">Category: </label>
                                                                                        <select name="category" class="form-control col-md-8 col-lg-8 col-sm-8" style="margin-left:7.5%;" disabled>
                                                                                                <option value ="">

                                                                                        <?php
                                                                                        if ($row["category_id"]==1)
                                                                                        {
                                                                                                $category = "Home Appliance (1)";
                                                                                        }
                                                                                        else if ($row["category_id"]==2 )
                                                                                        {
                                                                                                $category = "Furniture (2)";
                                                                                        }
                                                                                        else if ($row["category_id"]==3)
                                                                                        {
                                                                                                $category = "Computers and IT (3)";
                                                                                        }
                                                                                        else if ($row["category_id"]==4)
                                                                                        {
                                                                                                $category = "Kids (4)";
                                                                                        }
                                                                                        else if ($row["category_id"]==5)
                                                                                        {
                                                                                                $category = "Home Repair (5)";
                                                                                        }
                                                                                        else if ($row["category_id"]==6)
                                                                                        {
                                                                                                $category = "Services (6)";
                                                                                        }

                                                                                        echo('---'.$category);?>---</option>
                                                                                                <option value ="1">Home Appliance</option>
                                                                                                <option value ="2">Furniture</option>
                                                                                                <option value ="3">Computers and IT</option>
                                                                                                <option value ="4">Kids</option>
                                                                                                <option value ="5">Home Repair</option>
                                                                                                <option value ="6">Services</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="form-group container-fluid">
                                                                                <label for="age" class="inlabels control-label col-md-8 col-lg-8 col-sm-8" style="margin-left:7.5%;">Years of possession:</label>
                                                                                <input name="age" class="form-control col-md-8 col-lg-8 col-sm-8" type="number" id="age" style="margin-left:7.5%;" value="<?php echo $row["age"] ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group container-fluid">
                                                                                <label for="adduration" class="inlabels control-label col-md-8 col-lg-8 col-sm-8" style="margin-left:7.5%;">Advertise for:</label>
                                                                                <input name="adduration" class="form-control col-md-8 col-lg-8 col-sm-8" type="number" id="adduration" style="margin-left:7.5%;" value="<?php echo $row["ad_duration"] ?>" readonly>
                                                                        </div>

                                                                        <div class="form-group container-fluid">
                                                                            <a class="nk-btn nk-btn-outline nk-btn-color-dark ml-5" href="edit-item.php?item_id_var=<?php echo $row["item_id"] ?>">Edit</a>
                                                                        </div>

                                                                        <div class="nk-gap-1"></div>
                                                                        <div class="nk-divider nk-divider-color-gray-6"></div>


                                                                        <?php
                                                    }
                                                } else {
                                                    echo '
                                                    <div class="nk-gap-1"></div>
                                                    <div class="row">
                                                        <div style="text-align: center;" class="col-lg-12 col-md-6 col-sm-3">
                                                            <p style="font-size: 24px;">You have not listed any items.</p>
                                                            <a href="sell-item.php" class="text-center" style="font-size:20px;">List one now!</a>
                                                        </div>
                                                    </div>
                                                    <div class="nk-gap-1"></div>
                                                    ';
                                                }
                                                $connection->close();
				?>
				</div>

			</div>

			<!-- END: Sell Item -->
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
<?php
        }
?>