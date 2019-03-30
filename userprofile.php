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


	<?php
		require_once('..\..\protected\config_fasttrade.php');
		$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
		if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
		}
		// Query from user table to get user's variables
		$sql = "SELECT *
				FROM user
				WHERE user_id = '".$_SESSION['userid']."'
				;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
						$username = $row['name'];
						$email = $row['email'];
						$pic = $row['pic'];
				}
		}
		// Query from item && item_review table to get rating
		$itemrating = $itemratingcount = 0;
		$sql = "SELECT *
				FROM `item_review` 
				INNER JOIN `item` 
				ON item_review.item_id = item.item_id
				WHERE item.user_id = '".$_SESSION['userid']."'
				;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
						$itemrating += $row['rating'];
						$itemratingcount += 1;
				}
		} else {
			$itemrating = 0;
			$itemratingcount = 0;
		}
		// Query from item && item_photo to find the 3 most recent item ids
		$sql = "SELECT DISTINCT item.item_id, title
				FROM `item`
				INNER JOIN `item_photo`
				ON item.item_id = item_photo.item_id
				WHERE user_id = '".$_SESSION['userid']."'
				ORDER BY item.item_id
				DESC
				LIMIT 3
				;";
		$result = $conn->query($sql);
		$top3id=array("","","");
		$arraypos = 0;
		if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$top3id[$arraypos] = $row['item_id'];
					$arraypos += 1;
				}
		}
		//If recent items are <3
		$arraysize = 0;
		if ($top3id[2] != ""){
			$arraysize = 3;
		} else if ($top3id[1] != "") {
			$arraysize = 2;
		} else if ($top3id[0] != "") {
			$arraysize = 1;
		} else {
			$arraysize = 0;
		}
		$itemselect = 0;
		$recentlistings = '';
		//Query to print the 3 most recent listings
		while ($arraysize > 0) {
			$sql = "SELECT DISTINCT *
					FROM `item` 
					INNER JOIN `item_photo`
					ON item.item_id = item_photo.item_id
					WHERE user_id = '".$_SESSION['userid']."' AND item.item_id = '".$top3id[$itemselect]."'
					ORDER BY item.item_id
					DESC
					LIMIT 1
					;";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$itemsid = $row['item_id'];
						$itemstitle = $row['title'];
						$itemsdesc = $row['description'];
						$itemsimg = $row['photo'];
						$itemsprice = $row['price'];
						$itemsstatus = $row['status'];
						$itemssold = $row['sold'];
						if ($itemsstatus == 1) {
							$itemsstatus = "color:green;'>Active";
						} else {
							$itemsstatus = "color:red;'>Inactive";
						}
						if ($itemssold == 1) {
							$itemssold = "color:green;'>Sold!";
						} else {
							$itemssold = "color:orange;'>Not sold";
						}
						$recentlistings .= "<div style='float:left; margin-left:2%; margin-right:2%; margin-bottom:1%; max-width:280px; background-color:#f2f2f2; border-radius:5%;'>
												<img src='data:image/jpeg;base64,".base64_encode($itemsimg)."' style='width:100%; height:200px; padding-bottom:1em; border-radius:8%; padding:5%;'/>
												<!--<p>".$itemsid."</p>-->
												<p class='nk-product-title h3' style='padding-left:0.5em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>".$itemstitle."</p>
												<p class='nk-product-price' style='padding-left:0.5em; margin-bottom:0px;'>$".$itemsprice."</p>
												<p class='nk-product-description' style='padding-left:0.5em; height:100px; margin-top:0px; white-space: normal; overflow: auto;'>".$itemsdesc."</p>
												<p class='nk-product-description' style='padding-left:0.5em; margin-bottom:0px;".$itemsstatus."</p>
												<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;".$itemssold."</p>
												<a href='#' style='float:right; padding-right:1em; font-size:1.2em;'>Edit item</a>
											</div>";
					}
			} else {
				$recentlistings = "";
			}
			$arraysize -= 1;
			$itemselect += 1;
		}
		
		//User Display Picture
		$pic = '<img src="data:image/jpeg;base64,'.base64_encode($pic).'" style="width:280px; padding-bottom:1em; border-radius:5%;"/>';
		//User Display Name
		$username = "<h3>".$username."</h3>";
		//User Display Email
		$email = "<p>".$email."</p>";
		//User Display Rating
		if ($itemratingcount == 0) {
			$itemrating = "<h4>No reviews yet</h4>";
		} else if ($itemratingcount == 1) {
			$itemrating = "<h4>".$itemrating."/5 stars from ".$itemratingcount." review</h4>";
		} else {
			$itemrating = ($itemrating / 5);
			$itemrating = "<h4>".$itemrating."/5 stars from ".$itemratingcount." reviews</h4>";
		}
		//User Recent Listings
		if ($recentlistings == "") {
			$recentlistings = "<h4>No items listed! <a href='#'>List now?</a></h4>";
		}
		
	?>


    <div class="bg-white">
        <div class="container">
            <!-- START: Shop Header -->
            <div class="nk-shop-header">
                <a href="index.php" class="nk-shop-header-back"><span class="nk-icon-arrow-left"></span> Back to Main Shop</a>
            </div>
            <!-- END: Shop Header -->

            <!-- START: USER PROFILE MAIN -->
            <div class="nk-box">
				<div class = "col-md-7">
					<div style="float:left; padding-right:1em;" >
						<?php echo($pic)?>
					</div>
					<div>
						<?php echo($username);?>
						<?php echo($itemrating);?>
						<?php echo($email);?>
						<p><a href="updateProfile.php" title="Editing of Profile"><button class="nk-btn nk-btn-color-dark-1">Edit Profile</button></a></p><br/>
					</div>
				</div>
			</div>
			<!-- START: ADD NEW ITEM -->
			<div>
				<h3 style="margin-top:2em;">List new item</h3>
					<p><a href="sell-item.php" title="Sell item"> <i class="far fa-plus-square fa-6x" style="color:black;"></i> </a></p><br/>
				<div style='clear: both;'></div>
			</div>
			<!-- END: ADD NEW ITEM -->
			<!-- START: SHOW RECENT LISTINGS-->
			<div>
				<h3 style="margin-top:2em;">Recent Listings</h3>
				<div>
					<?php echo($recentlistings);?>
				</div>
				
				<a href="display-item.php" style="float:right;">View all listings</a>
				<div style='clear: both;'></div>
			</div>
			<!-- END: SHOW RECENT LISTINGS-->
			<!-- START: USER PROFILE MAIN -->
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