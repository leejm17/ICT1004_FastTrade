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
	} if (empty($_GET["item_id_var"])){
		header('Location: 403.php');
	}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FastTrade | Delete Item</title>

    <meta name="description" content="Keep your item up to date!">
    <meta name="keywords" content="update, product, item">
    <meta name="author" content="Dominic Keeley Gian">

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
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/custom-minimal-shop.css">
    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">


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
            <!-- START: User Profile Header -->
            <?php include 'php/profile_header.inc.php'; ?>
            <!-- END: User Profile Header -->

			<!-- START: EDIT ITEM MAIN -->

			<!-- START: GET VALUES OF ITEM-TO-BE-EDITED -->
			<?php

				$item_id_var = $_GET["item_id_var"];
				$itemshref = 'edit-item.php?item_id_var='.$item_id_var.'';
				$delitemhref = 'delete-item.php?item_id_var='.$item_id_var.'';

				require_once('..\..\protected\config_fasttrade.php');
				$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
				if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
				}
				// Query from item table to get item variables
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
				// Query from item_photo table to get photo variables
				$sql = "SELECT *
						FROM item_photo
						INNER JOIN item
						ON item_photo.item_id = item.item_id
						WHERE item.user_id = '".$_SESSION['userid']."' AND item.item_id = '".$item_id_var."'
						;";
				$result = $conn->query($sql);
				$pic = array("", "", "");
				$picid = array(0, 0, 0);
				$piccount = 0;
				if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
								$picid[$piccount] = (int)$row['item_photo_id'];
								$pic[$piccount] = '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" style="width:280px; padding-bottom:1em; border-radius:5%;"/>';
								$piccount += 1;
						}
				}

			?>
			<!-- END: GET VALUES OF ITEM-TO-BE-EDITED -->
			<!--START: TURN OFF PHP ERRORS-->
			<?php error_reporting(0); ?>
			<!--END: TURN OFF PHP ERRORS-->
			<!-- START: DELETE ITEM LISTING -->
			<?php
				// Credentials
				require_once('..\..\protected\config_fasttrade.php');
				// Create connection
				//$conn = new mysqli($servername, $username, $password, $dbname);
				$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
				if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
				}
				
				if (($_POST['deletelistingbutton']) == 'deletelisting') {
					//Remove the item photo
					$sql = "DELETE
							FROM item_photo
							WHERE item_id = '".$item_id_var."'
							;";
					$result = $conn->query($sql);
					//Remove the item values
					$sql = "DELETE
							FROM item
							WHERE item_id = '".$item_id_var."'
							;";
					$result = $conn->query($sql);
					echo("<div class='alert alert-success'>
								<strong style='padding-right:1em;'>Success!</strong> Item Deleted
						</div>");
				}
				
				mysqli_close($conn);
			?>
			<!-- END: DELETE ITEM LISTING -->

			<div class="nk-box">
				<div class = "col-md-7">
					<h3 style="color:red;">CONFIRM DELETE</h3>
						<!--<form class="form-horizontal" action="edit-item.php?" enctype="multipart/form-data" method="POST">-->
						<br/>
						<form class="form-horizontal" action="<?php echo($delitemhref); ?>" enctype="multipart/form-data" method="POST">
						<!--Title-->
							<p class='nk-product-title h3' style='padding-left:0.5em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'><?php echo($title); ?></p>
						<!--START: Picture values-->
						<div>
							<!--Picture 1-->
							<div class="form-group">
									<?php
										echo($pic[0]);
									?>
							</div><br/>
							<!--Picture 2-->
							<div class="form-group">
									<?php
										if ($pic[1] == "") {
											echo(" No <i class='fas fa-image'></i> uploaded ");
										} else {
											echo($pic[1]);
											echo("<br/><i class='fas fa-minus-circle' style='color:red;'></i> Delete image : <input type='checkbox' name='picture2chk' value='rmpic2'>");
										}
									?>
							</div><br/>
							<!--Picture 3-->
							<div class="form-group">
									<?php
										if ($pic[2] == "") {
											echo(" No <i class='fas fa-image'></i> uploaded ");
										} else {
											echo($pic[2]);
											echo("<br/><i class='fas fa-minus-circle' style='color:red;'></i> Delete image : <input type='checkbox' name='picture3chk' value='rmpic3'>");
										}

									?>
							</div><br/>
						</div>
						<!--END: Picture values-->
						<!--START: Text values-->
						<div>
							<br/>
							<!--Price-->
							<h5>Price:</h5>
							<p class='nk-product-price' style='padding-left:0.5em; margin-top:0px;'>$<?php echo($price); ?></p>
							<!--Desc-->
							<h5>Description:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; max-height:100px; margin-top:0px; white-space: normal; overflow: auto;'><?php echo($description); ?></p>
							<!--Condition-->
							<h5>Condition:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;'><?php if ($condition == 5){echo("In a never opened Condition");}
																												if ($condition == 4){echo("In perfect Condition");}
																												if ($condition == 3){echo("In great Condition");}
																												if ($condition == 2){echo("In good Condition");}
																												if ($condition == 1){echo("Has minor scratches");}?></p>
							<!--Status-->
							<h5>Availability status:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;'><?php if ($status == 1){echo("Active");}
																												if ($status == 0){echo("Inactive");}?></p>
							<!--Sold-->
							<h5>Selling status:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;'><?php if ($sold == 1){echo("Sold");}
																												if ($sold == 0){echo("Selling");}?></p>
							<!--Category-->
							<h5>Category:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;'><?php if ($category == 6){echo("Services");}
																												if ($category == 5){echo("Kids");}
																												if ($category == 4){echo("Home Repair");}
																												if ($category == 3){echo("Home Appliance");}
																												if ($category == 2){echo("Furniture");}
																												if ($category == 1){echo("Computers and IT");}?></p>
							<!--Age-->
							<h5>Age:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;'>Owned for <?php echo($age); ?> years</p>
							<!--Ad Duration-->
							<h5>Duration:</h5>
							<p class='nk-product-description' style='padding-left:0.5em; margin-top:0px;'>Advertised for <?php echo($adduration); ?> years</p>
						</div>
						<!--END: Text values-->
						
						<div class="form-group">
								<button type="submit" class="nk-btn nk-btn-outline nk-btn-color-dark ml-10" style="color:#ff4949 !important;" name="deletelistingbutton" value="deletelisting">Delete</button>
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