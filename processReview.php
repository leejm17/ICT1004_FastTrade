<?php

$name = $email = $message = $review_rate = "";
$name_err = $email_err = $message_err = $review_rate_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if (empty($name) || !preg_match("/^[a-zA-Z ]*$/", $name)) {
        $name_err = "This field is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    }

    if (empty($message) || !preg_match("/^[a-zA-Z ]*$/", $message)) {
        $message_err = "This field is required.";
    }

    if (empty($_POST["review-rate"])) {
        $review_rate_err = "This field is required.";
    } else {
        $review_rate = $_POST["review-rate"];
    }

    if ($name_err == "" && $email_err == "" && $message_err == "" && $review_rate_err == "") {
        header("location: product.php?id=1");
    } else {
        $page = basename($_SERVER['REQUEST_URI']);
        $page_id = substr($page, -1);

        /* (1) Connect to Database */
        require_once('../../protected/config_fasttrade.php');
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

        /* (2) Handle Connection Error */
        //      mysqli_connect_errno returns the last error code
        if (mysqli_connect_errno()) {
            die(mysqli_connect_errno());    // die() is equivalent to exit()
        }

        /* (3) Query DB */
        $sql = "INSERT TO item_review (item_id, name, email, message, rating) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_query($connection, $sql);
        
        /* (4) Insert Into DB */
        if ($stmt) {
            mysqli_stmt_bind_param($sql, "isssi", $page_id, $name, $email, $message, $review_rate);
            $sql = mysqli_execute($sql);
            
            /* (5) Release Connection */
            mysqli_free_result($sql);
            mysqli_close($connection);
        }
        
        header("location: product.php?id=1");
    }
}
?>