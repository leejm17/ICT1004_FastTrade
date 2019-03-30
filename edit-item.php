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
	}
	if (empty($_GET["item_id_var"])){
		header('Location: 403.php');
	}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FastTrade | Login</title>

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
			
			<!-- START: EDIT ITEM MAIN -->
			
			<!-- START: GET VALUES OF ITEM-TO-BE-EDITED -->
			<?php
				
				$item_id_var = $_GET["item_id_var"];
				
				require_once('..\..\protected\config_fasttrade.php');
				$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
				if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
				}
				// Query from item && item_photo table to get item variables
				$sql = "SELECT *
						FROM item
						WHERE user_id = '".$_SESSION['userid']."' AND item_id = '".$item_id_var."'
						;";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
								$item_id = $row['item_id'];
								$title = $row['title'];
								$description = $row['description'];
								$condition = $row['condition'];
								$price = $row['price'];
								$status = $row['status'];
								$sold = $row['sold'];
								$category = $row['category_id'];
								$age = $row['age'];
								$adduration = $row['ad_duration'];
						}
				}
			?>
			<!-- END: GET VALUES OF ITEM-TO-BE-EDITED -->
			
			<!-- START: ERROR CHECK FORM VALUES -->
			<?php
				
			?>
			<!-- END: ERROR CHECK FORM VALUES -->
			
			<!-- START: UPDATE ITEM VALUES -->
			<?php
				
			?>
			<!-- END: UPDATE ITEM VALUES -->
			
			<!-- START: UPDATE PICTURE DATA -->
			<?php
				
			?>
			<!-- END: UPDATE PICTURE DATA -->
			
			<div class="nk-box">
				<div class = "col-md-7">
					<h3>Edit item</h3>
						<form class="form-horizontal" action="edit-item.php" enctype="multipart/form-data" method="POST">
							<!--Title-->
							<div class="form-group">
									<label for="title" class="inlabels control-label col-sm-5" style="font-size:1.25em;" >Title:</label>
									<input name="title" class="form-control" type="text" id="title" value="<?php echo($title); ?>">
									<!--<?php echo ($title_err); ?>-->
							</div>
							<!--Desc-->
							<div class="form-group">
									<label for="description" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Description:</label>
									<input name="description" class="form-control" type="text" id="description" value="<?php echo($description); ?>">
									<!--<?php echo ($description_err); ?>-->
							</div>
							<!--Condition-->
							<div class="form-group">
									<label class="inlabels control-label col-sm-5" for="condition" style="font-size:1.25em;">Condition: </label>
									<select name="condition" class="form-control col-sm-5">
											<option value ="">---Choose a Condition---</option>
											<option value ="5"<?php if ($condition == 5){echo(" selected='selected'");}?>>Never Opened</option>
											<option value ="4"<?php if ($condition == 4){echo(" selected='selected'");}?>>Perfect</option>
											<option value ="3"<?php if ($condition == 3){echo(" selected='selected'");}?>>Great</option>
											<option value ="2"<?php if ($condition == 2){echo(" selected='selected'");}?>>Good</option>
											<option value ="1"<?php if ($condition == 1){echo(" selected='selected'");}?>>Minor Scratches</option>
									</select>
									<!--<?php echo ($condition_err); ?>-->
							</div>
							<!--Price-->
							<div class="form-group">
									<label for="price" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Price:</label>
									<input name="price" class="form-control" type="text" id="price" value="<?php echo($price); ?>">
									<!--<?php echo ($price_err); ?>-->
							</div>
							<!--Status--><!--values here dont affect query, but must be >0 to pass error check-->
							<div class="form-group">
									<label for="status" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Availability:</label>
									<select name="status" class="form-control col-sm-5">
											<option value ="">---Choose a Status---</option>
											<option value ="1"<?php if ($status == 1){echo(" selected='selected'");}?>>Active</option>
											<option value ="0"<?php if ($status == 0){echo(" selected='selected'");}?>>Inactive</option>
									</select>
									<!--<?php// echo ($status_err); ?>-->
							</div>
							<!--Sold--><!--values here dont affect query, but must be 0 to pass error check-->
							<div class="form-group">
									<label for="sold" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Item Status:</label>
									<select name="sold" class="form-control col-sm-5">
											<option value ="">---Choose a Status---</option>
											<option value ="1"<?php if ($sold == 1){echo(" selected='selected'");}?>>Sold</option>
											<option value ="0"<?php if ($sold == 0){echo(" selected='selected'");}?>>Selling</option>
									</select>
									<?php// echo ($sold_err); ?>
							</div>
							<!--Category-->
							<div class="form-group">
									<label class="inlabels control-label col-sm-5" for="category" style="font-size:1.25em;">Category: </label>
									<select name="category" class="form-control col-sm-5">
											<option value ="">---Choose a Category---</option>
											<option value ="1"<?php if ($category == 1){echo(" selected='selected'");}?>>Home Appliance</option>
											<option value ="2"<?php if ($category == 2){echo(" selected='selected'");}?>>Furniture</option>
											<option value ="3"<?php if ($category == 3){echo(" selected='selected'");}?>>Computers and IT</option>
											<option value ="4"<?php if ($category == 4){echo(" selected='selected'");}?>>Kids</option>
											<option value ="5"<?php if ($category == 5){echo(" selected='selected'");}?>>Home Repair</option>
											<option value ="6"<?php if ($category == 6){echo(" selected='selected'");}?>>Services</option>
									</select>
									<!--<?php echo ($category_err); ?>-->
							</div>
							<!--Age-->
							<div class="form-group">
									<label for="age" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Years of possession:</label>
									<input name="age" class="form-control" type="text" id="age" placeholder="Year(s)" value="<?php echo($age); ?>">
									<!--<?php echo ($age_err); ?>-->
							</div>
							<!--Ad Duration-->
							<div class="form-group">
									<label for="adduration" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Advertise for:</label>
									<input name="adduration" class="form-control" type="text" id="adduration" placeholder="Year(s)" value="<?php echo($adduration); ?>">
									<!--<?php echo ($adduration_err); ?>-->
							</div>
							<div class="form-group">
									<button class="nk-btn nk-btn-outline nk-btn-color-dark ml-10">Update</button>
							</div>
						</form>
				</div>
			</div>
			<!-- END: EDIT ITEM MAIN -->
			
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