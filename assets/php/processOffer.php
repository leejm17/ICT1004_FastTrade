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

    //$page = $_POST["item_id"];
    $item_id = $_GET["id"];

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

        /* (3a) Query if record exists due to offer being rejected before */
        $sql_checkrecord = "SELECT buyer_id, item_id FROM offer WHERE accept = 0 AND buyer_id='". $userid ."' AND item_id=". $item_id;

        /* (3b) Query DB */
        $sql_newoffer = "INSERT INTO offer (buyer_id, item_id, seller_id, accept, asking_price, trading_place, remarks) VALUES (?, ?, ?, 2, ?, ?, ?)";

        /* (4a) Update DB */
        if ($result_1 = mysqli_query($connection, $sql_checkrecord)) {  // if able to fetch, means user has made a previous offer

            // Check if it is an existing/pending offer or rejected, by looking at $row['accept']
            while ($row_1 = mysqli_fetch_assoc($result_1)) {
                /* (5a) Update DB */
                $sql_reoffer = 'UPDATE offer SET accept = 2, asking_price = "'. $submit_price .'", trading_place = "'. $submit_loc .'", remarks = "'. $submit_remarks .'" WHERE buyer_id = "'. $userid .'" AND item_id = '. $item_id;

                if (mysqli_query($connection, $sql_reoffer)) {
                    echo '<script>alert("New offer successfully submitted!")</script>';
                    mysqli_free_result($result_1);
                    return;
                } else {
                    echo '<script>alert("Update failed!")</script>';
                    mysqli_free_result($result_1);
                    return;
                }
            }
            mysqli_free_result($result_1);

        }

        /* (4b) Update DB */
        if ($stmt = mysqli_prepare($connection, $sql_newoffer)) {  // else user had not made any offers for this product before
            //echo '.................... | came into $stmt';
            mysqli_stmt_bind_param($stmt, "sisdss", $userid, $item_id, $seller_id, $submit_price, $submit_loc, $submit_remarks);
            $result_2 = mysqli_execute($stmt);
            if ($result_2 == 0) {
                echo '<script>alert("You have already made an offer for this product!")</script>';
            } else {
                echo '<script>alert("Offer successfully submitted!")</script>';
            }
            //echo '.................... | out of $stmt';

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