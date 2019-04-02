<?php

//for recaptcha TO DO: change the domain in admin console, also to port this file over
require_once '..\..\protected\config_recaptcha.php';

$page = $page_id = $name = $email = $message = $review_rate = "";
$name_err = $email_err = $message_err = $review_rate_err = $recaptcha_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["review_submit"])) {
      // Validate reCAPTCHA box
      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        // Google reCAPTCHA API secret key
        $secretKey = SECRET_KEY;

        // Verify the reCAPTCHA response
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);

        // Decode json data
        $responseData = json_decode($verifyResponse);

        // If reCAPTCHA response is valid
        if($responseData->success){
            $name = $_POST["name"];
            //$email = $_POST["email"];
            $message = $_POST["message"];

            $page = $_POST["page_id"];
            //$page_id = substr($page, -1);
            $page_id = $_GET["id"];

            if (empty($name) || !preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
                $name_err = "Please enter a valid title header.";
            }

            /*if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Please enter a valid email address.";
            }*/

            if (empty($message) || !preg_match("/^[a-zA-Z0-9!.,&+()'\"\:\?\/ ]*$/", $message)) {
                $message_err = "Please refrain from using special characters";
            }

            if (empty($_POST["review-rate"])) {
                $review_rate_err = "This field is required.";
            } else {
                $review_rate = $_POST["review-rate"];
            }

            if ($name_err == "" && $message_err == "" && $review_rate_err == "") {
                /* (1) Connect to Database */
                require_once('..\..\protected\config_fasttrade.php');
                $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

                /* (2) Handle Connection Error */
                if (mysqli_connect_errno()) {
                    die(mysqli_connect_errno());    // die() is equivalent to exit()
                }

                /* (3) Query DB */
                $sql = "INSERT INTO item_review (item_id, email_id, datetime, name, review, rating) VALUES (?, ?, NOW(), ?, ?, ?)";

                /* (4) Insert Into DB */
                if ($stmt = mysqli_prepare($connection, $sql)) {
                    //echo '.................... | came into $stmt';
                    mysqli_stmt_bind_param($stmt, "isssi", $page_id, $userid, $name, $message, $review_rate);
                    mysqli_execute($stmt);

                    /* (5) Release Connection */
                    mysqli_stmt_close($stmt);
                }/* else {
                    echo '.................... | no go out of the way';
                }*/
                mysqli_close($connection);
                header("location: " . $page);
            }/* else {
                echo '.................... | ERROR MESSAGE. PLEASE RESOLVE.';
            }*/
        } else{
            $recaptcha_err = 'Robot verification failed, please try again.';
        }
    } else{
        $recaptcha_err = 'Please check the Recaptcha Box';
    }
}
?>