<?php
$offer_price = $offer_loc = $offer_remarks = "";
$submit_price = $submit_loc = $submit_remarks = "";
$price_err = $loc_err = $remarks_err = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["offer_submit"])) {
    $submit_price = trim($_POST["submit_price"]);
    $submit_loc = trim($_POST["submit_loc"]);
    $submit_remarks = trim($_POST["submit_remarks"]);
    $seller_id = $_POST["seller_id"];

    $page = $_POST["page_id"];
    //$page_id = substr($page, -1);
    $page_id = $_GET["id"];

    if (empty($submit_price) || !preg_match("/^((SGD *)|(\$))*[0-9]+(?:\.[0-9]{2})?$/i", $submit_price)) {
        $price_err = "Please enter a valid price.";
        $error_msg = $error_msg . "Please enter a valid price.\n ";
    }

    if (empty($submit_loc) || !preg_match("/^[a-zA-Z0-9 ]*$/", $submit_loc)) {
        $loc_err = "Please enter a valid location.";
        $error_msg = $error_msg . "Please enter a valid location.\n ";
    }

    if (empty($submit_remarks) || !preg_match("/^[a-zA-Z0-9!.,&+():\?\'\/ ]*$/", $submit_remarks)) {
        $remarks_err = "Please refrain from using special characters";
        $error_msg = $error_msg . "Please refrain from using special characters.\n ";
    }

    if ($error_msg != "") {
        echo '.................... | ERROR MESSAGE. PLEASE RESOLVE.';
        echo $error_msg;
        echo '<script >alert("' . $error_msg . '")</script>';
        $error_msg = "";
    } else {
        /* (1) Connect to Database */
        require_once('..\..\protected\config_fasttrade.php');
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

        /* (2) Handle Connection Error */
        if (mysqli_connect_errno()) {
            die(mysqli_connect_errno());    // die() is equivalent to exit()
        }

        /* (3) Query DB */
        $sql = "INSERT INTO offer (buyer_id, item_id, seller_id, accept, asking_price, trading_place, remarks) VALUES (?, ?, ?, 2, ?, ?, ?)";

        /* (4) Insert Into DB */
        if ($stmt = mysqli_prepare($connection, $sql)) {
            //echo '.................... | came into $stmt';
            mysqli_stmt_bind_param($stmt, "sisdss", $userid, $page_id, $seller_id, $submit_price, $submit_loc, $submit_remarks);
            $result = mysqli_execute($stmt);
            if ($result == 0) {
                echo '<script>alert("You have already made an offer for this product!")</script>';
            } else {
                echo '<script>alert("Offer successfully submitted!")</script>';
            }

            /* (5) Release Connection */
            mysqli_stmt_close($stmt);
        } /*else {
            echo '.................... | did not go into $stmt';
        }*/
        mysqli_close($connection);
        //header("location: " . $page);
    }
}
?>