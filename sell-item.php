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

    <title>Fast Trade | Sell An Item</title>

    <meta name="description" content="Sell An Item">
    <meta name="keywords" content="sell, product, item">
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

            <!-- START: Sell Item -->

			<!--START: TURN OFF PHP ERRORS-->
			<?php error_reporting(0); ?>
			<!--END: TURN OFF PHP ERRORS-->
			<!-- START: FORM FIELDS ERRROR CHECKING -->
			<?php

			//Errors
			$title_err = $description_err = $category_err = $price_err = $picture1_err = $condition_err = $age_err = $adduration_err = $picturename_err = "";
			$inputpass = 0; //Field values aka checksum


					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							//Title
							if (empty($_POST['title'])) {
									$title_err = "<p style='color:red;'>*Title is required</p>";
							} else {
									//echo ("Title: " .$_POST["title"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}
							//Description
							if (empty($_POST['description'])) {
									$description_err = "<p style='color:red;'>*Description is required</p>";
							} else {
									//echo ("Description: " .$_POST["description"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}
							//Condition
							if ($_POST['condition'] == "") {
									$condition_err = "<p style='color:red;'>*Select a condition</p>";
							} else {
									//echo ("Condition: " .$_POST["condition"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}
							//Price
							if (empty($_POST['price'])) {
									$price_err = "<p style='color:red;'>*Please enter a price?</p>";
							} else if ( (strval($_POST['price'])) != (strval(floatval($_POST['price']))) ) {
									$price_err = "<p style='color:red;'>*Please enter valid integers for price</p>";
							} else {
									//echo ("Price: " .$_POST["price"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}
							//Category
							if ($_POST['category'] == "") {
									$category_err = "<p style='color:red;'>*Select a category</p>";
							} else {
									//echo ("Category: " .$_POST["category"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}
							//Age
							if (empty($_POST['age'])) {
									$age_err = "<p style='color:red;'>*How long have you owned this item?</p>";
							} else if ( (strval($_POST['age'])) != (strval(intval($_POST['age']))) ) {
									$age_err = "<p style='color:red;'>*Please enter valid integers for age</p>";
							} else {
									//echo ("Age: " .$_POST["age"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}
							//Ad Duration
							if (empty($_POST['adduration'])) {
									$adduration_err = "<p style='color:red;'>*How long do you want this to be advertised?</p>";
							} else if ( (strval($_POST['adduration'])) != (strval(intval($_POST['adduration']))) ) {
									$adduration_err = "<p style='color:red;'>*Please enter valid integers for duration</p>";
							} else {
									//echo ("Ad Duration: " .$_POST["adduration"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}

							//if (empty($_POST['picture1'])) {
							if (empty($_FILES['picture1']['tmp_name'])) {
									$picture1_err = "<p style='color:red;'>*Main picture cannot be empty</p>";
							} else {
									//echo ("Image: " .$_POST["picture1"]. "<br/>");
									$inputpass = ($inputpass + 1);
							}

							//Pictures cant have the same name
							if ( $_FILES['picture1']['name'] == $_FILES['picture2']['name'] ) {
									$picturename_err = "<p style='color:red;'>*Picture names cannot be the same!</p>";
							} else if ( $_FILES['picture1']['name'] == $_FILES['picture3']['name'] ) {
									$picturename_err = "<p style='color:red;'>*Picture names cannot be the same!</p>";
							} else if ( ($_FILES['picture2']['name'] && $_FILES['picture3']['name'] != "") && ($_FILES['picture2']['name'] == $_FILES['picture3']['name']) )  {
									$picturename_err = "<p style='color:red;'>*Picture names cannot be the same!</p>";
							} else {
									$inputpass = ($inputpass + 1);
							}


							//if inputpass is not 9 {
							if ($inputpass != 9) {
									echo("<div class='alert alert-danger'>
											<strong style='padding-right:1em;'>Error!</strong> Fill in all the *required fields.
									</div>");
							}

					}
			?>
			<!-- END: FORM FIELDS ERRROR CHECKING -->
			<!-- START: INSERT FORM DATA -->
			<?php
			//if ($inputpass == 11) { //Old form debugging (Status, Sold)
			if ($inputpass == 9) {
					// Credentials
					require_once('..\..\protected\config_fasttrade.php');
					// Create connection
					//$conn = new mysqli($servername, $username, $password, $dbname);
					$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
					if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
					}
					// Query to insert form input
					$sql = "
							INSERT INTO item (`title`, `description`, `condition`, `price`, `status`, `sold`, `user_id`, `category_id`, `age`, `ad_duration`, `due_date`)
							VALUES ('".$_POST["title"]."', '".$_POST["description"]."', '".$_POST["condition"]."', '".$_POST["price"]."', '1', '0', '".$_SESSION['userid']."', '".$_POST["category"]."', '".$_POST["age"]."', '".$_POST["adduration"]."', date_add(NOW(), INTERVAL ".$_POST["adduration"]." YEAR))
							;";
					$result = $conn->query($sql);
					echo("
							<div class='alert alert-success'>
									<strong>Success!</strong> '".$_POST["title"]."' has been successfully listed!.
							</div>");
			}else{
					echo "";
			}
			?>
			<!-- END: INSERT FORM DATA -->
			<!-- START: INSERT PICTURE DATA -->
			<?php
			$theitemid = 0;
			//if ($inputpass == 11) { //Old form debugging (Status, Sold, userid(static))
			if ($inputpass == 9) { //If all input fields are filled
					//Credentials
					require_once('..\..\protected\config_fasttrade.php');
					// Create connection
					//$conn = new mysqli($servername, $username, $password, $dbname);
					$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
					if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
					}
					// Query to get Item ID
					$sql = "
									SELECT item_id
									FROM item
									ORDER BY `item_id`
									DESC
									LIMIT 1
									;";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
									$theitemid = $row['item_id'];
							}
					}
					if ($theitemid != 0) {
							//First Image
							//Escaped Image
							$imgData1 = addslashes(file_get_contents($_FILES['picture1']['tmp_name']));
							// Query to insert picture1 to db
							$sql = "
											INSERT INTO `item_photo` (`item_id`, `photo`)
											VALUES ('".$theitemid."', '".$imgData1."')
											;";
							$result = $conn->query($sql);
							//echo("<p>".$_FILES['picture1']['name']." has been added!<p>");
							//Second Image
							if (empty(file_get_contents($_FILES['picture2']['tmp_name']))) {
									//echo("Picture2 is empty<br>");
							}else{
									//Escaped Image
									$imgData2 = addslashes(file_get_contents($_FILES['picture2']['tmp_name']));
									// Query to insert picture2 to db
									$sql = "
													INSERT INTO `item_photo` (`item_id`, `photo`)
													VALUES ('".$theitemid."', '".$imgData2."')
													;";
									$result = $conn->query($sql);
									//echo("<p>".$_FILES['picture2']['name']." has been added!</p>");

							}

							//Third Image
							if (empty(file_get_contents($_FILES['picture3']['tmp_name']))) {
									//echo("Picture3 is empty<br>");
							}else{
									//Escaped Image
									$imgData3 = addslashes(file_get_contents($_FILES['picture3']['tmp_name']));
									// Query to insert picture2 to db
									$sql = "
													INSERT INTO `item_photo` (`item_id`, `photo`)
													VALUES ('".$theitemid."', '".$imgData3."')
													;";
									$result = $conn->query($sql);
									//echo("<p>".$_FILES['picture3']['name']." has been added!</p>");
							}
					}
			}else{
					echo "";
			}

			?>
			<!-- END: INSERT PICTURE DATA -->

            <div class="nk-box">
                    <div class = "col-md-7">
                            <h3>Sell item</h3>
                            <form class="form-horizontal" action="sell-item.php" enctype="multipart/form-data" method="POST">
                                    <!--Title-->
                                    <div class="form-group">
                                            <label for="title" class="inlabels control-label col-sm-5" style="font-size:1.25em;" >Title:</label>
                                            <input name="title" class="form-control" type="text" id="title" placeholder="Enter Title" value="<?php echo($_POST['title']); ?>">
                                            <?php echo ($title_err); ?>
                                    </div>
                                    <!--Desc-->
                                    <div class="form-group">
                                            <label for="description" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Description:</label>
                                            <input name="description" class="form-control" type="text" id="description" placeholder="Enter Description" value="<?php echo($_POST['description']); ?>">
                                            <?php echo ($description_err); ?>
                                    </div>
                                    <!--Condition-->
                                    <div class="form-group">
                                            <label class="inlabels control-label col-sm-5" for="condition" style="font-size:1.25em;">Condition: </label>
                                            <select name="condition" class="form-control col-sm-5">
                                                    <option value ="">---Choose a Condition---</option>
                                                    <option value ="5" <?php if($_POST['condition'] == 5){echo("selected='selected'");}?>>Never Opened</option>
                                                    <option value ="4" <?php if($_POST['condition'] == 4){echo("selected='selected'");}?>>Perfect</option>
                                                    <option value ="3" <?php if($_POST['condition'] == 3){echo("selected='selected'");}?>>Great</option>
                                                    <option value ="2" <?php if($_POST['condition'] == 2){echo("selected='selected'");}?>>Good</option>
                                                    <option value ="1" <?php if($_POST['condition'] == 1){echo("selected='selected'");}?>>Minor Scratches</option>
                                            </select>
                                            <?php echo ($condition_err); ?>
                                    </div>
                                    <!--Price-->
                                    <div class="form-group">
                                            <label for="price" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Price:</label>
                                            <input name="price" class="form-control" type="text" id="price" placeholder="Enter Price" value="<?php echo($_POST['price']); ?>">
                                            <?php echo ($price_err); ?>
                                    </div>
                                    <!--Status--><!--values here dont affect query, but must be >0 to pass error check-->
                                    <!--
                                    <div class="form-group">
                                            <label for="status" class="inlabels control-label col-sm-5" >Status:</label>
                                            <input name="status" class="form-control" type="text" id="status" placeholder="Enter Status" value="1">
                                            <?php// echo ($status_err); ?>
                                    </div>
                                    -->
                                    <!--Sold--><!--values here dont affect query, but must be 0 to pass error check-->
                                    <!--
                                    <div class="form-group">
                                            <label for="sold" class="inlabels control-label col-sm-5" >Sold:</label>
                                            <input name="sold" class="form-control" type="text" id="sold" placeholder="Enter Sold" value="0">
                                            <?php// echo ($sold_err); ?>
                                    </div>
                                    -->
                                    <!--UserID-->
									<!--
                                    <div class="form-group">
                                            <label for="userid" class="inlabels control-label col-sm-5" style="font-size:1.25em;">UserID:</label>
                                            <input name="userid" class="form-control" type="text" id="userid" placeholder="Enter UserID" value="jonsaysquack">
                                            <?php echo ($userid_err); ?>
                                    </div>
									-->
                                    <!--Category-->
                                    <div class="form-group">
                                            <label class="inlabels control-label col-sm-5" for="category" style="font-size:1.25em;">Category: </label>
                                            <select name="category" class="form-control col-sm-5">
                                                    <option value ="">---Choose a Category---</option>
                                                    <option value ="1" <?php if($_POST['condition'] == 1){echo("selected='selected'");}?>>Computers and IT</option>
                                                    <option value ="2" <?php if($_POST['condition'] == 2){echo("selected='selected'");}?>>Furniture</option>
                                                    <option value ="3" <?php if($_POST['condition'] == 3){echo("selected='selected'");}?>>Home Appliance</option>
                                                    <option value ="4" <?php if($_POST['condition'] == 4){echo("selected='selected'");}?>>Home Repair</option>
                                                    <option value ="5" <?php if($_POST['condition'] == 5){echo("selected='selected'");}?>>Kids</option>
                                                    <option value ="6" <?php if($_POST['condition'] == 6){echo("selected='selected'");}?>>Services</option>
                                            </select>
                                            <?php echo ($category_err); ?>
                                    </div>
                                    <!--Age-->
                                    <div class="form-group">
                                            <label for="age" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Years of possession:</label>
                                            <input name="age" class="form-control" type="text" id="age" placeholder="Year(s)" value="<?php echo($_POST['age']); ?>">
                                            <?php echo ($age_err); ?>
                                    </div>
                                    <!--Ad Duration-->
                                    <div class="form-group">
                                            <label for="adduration" class="inlabels control-label col-sm-5" style="font-size:1.25em;">Advertise for:</label>
                                            <input name="adduration" class="form-control" type="text" id="adduration" placeholder="Year(s)" value="<?php echo($_POST['adduration']); ?>">
                                            <?php echo ($adduration_err); ?>
                                    </div>
                                    <!--Image (1st)-->
                                    <div class="form-group">
                                            <label for="picture1" class="inlabels control-label col-sm-4" style="font-size:1.25em;">Upload Image:</label>
                                            <input name="picture1" type="file" onclick="document.getElementById('oppic2').style.setProperty('display', 'block');"/>
                                            <?php echo ($picture1_err); ?>
                                    </div>
                                    <!--Optional 2nd image-->
                                    <a id="oppic2" onclick="document.getElementById('pic2').style.setProperty('display', 'block');document.getElementById('oppic2').style.setProperty('display', 'none');" style="display:none;"><p>Upload another image?</p></a>
                                    <!--Image (2nd)-->
                                    <div class="form-group" style="display:none;" id="pic2">
                                            <i class="fas fa-times" onclick="document.getElementById('pic2').style.setProperty('display', 'none');document.getElementById('oppic2').style.setProperty('display', 'block');" ></i>
                                            <label for="picture2" class="inlabels control-label col-sm-4" style="font-size:1.25em;">Upload another:</label>
                                            <input name="picture2" type="file" onclick="document.getElementById('oppic3').style.setProperty('display', 'block');"/>
                                            <?php// echo ($picture2_err); ?>
                                    </div>
                                    <!--Optional 2nd image-->
                                    <a id="oppic3" onclick="document.getElementById('pic3').style.setProperty('display', 'block');document.getElementById('oppic3').style.setProperty('display', 'none');" style="display:none;"><p>Upload another image?</p></a>
                                    <!--Image (3rd)-->
                                    <div class="form-group" style="display:none;" id="pic3">
                                            <i class="fas fa-times" onclick="document.getElementById('pic3').style.setProperty('display', 'none');document.getElementById('oppic3').style.setProperty('display', 'block');" ></i>
                                            <label for="picture3" class="inlabels control-label col-sm-4" style="font-size:1.25em;">Upload another:</label>
                                            <input name="picture3" type="file"/>
                                            <?php// echo ($picture3_err); ?>
                                    </div>
									<?php echo($picturename_err); ?>
                                    <div class="form-group">
                                            <button class="nk-btn nk-btn-outline nk-btn-color-dark ml-10">Submit</button>
                                    </div>
                            </form>

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
