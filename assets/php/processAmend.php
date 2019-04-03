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

    $item_id = $_POST["page_id"];

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
        $sql = 'UPDATE offer SET asking_price = "'. $submit_price .'", trading_place = "'. $submit_loc .'", remarks = "'. $submit_remarks .'" WHERE buyer_id = "'. $userid .'" AND item_id = '. $item_id;

        /* (4) Update DB */
        if (mysqli_query($connection, $sql)) {
            echo '<script>alert("Your offer has been updated!")</script>';
        } else {
            echo '<script>alert("Update failed!")</script>';
        }

        /* (5) Release Connection */
        mysqli_close($connection);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["offer_delete"])) {
    $item_id = $_POST["page_id"];

    /* (1) Connect to Database */
    require_once('..\..\protected\config_fasttrade.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

    /* (2) Handle Connection Error */
    if (mysqli_connect_errno()) {
        die(mysqli_connect_errno());    // die() is equivalent to exit()
    }

    /* (3) Query DB */
    $sql = "DELETE FROM offer WHERE item_id = ". $item_id;

    /* (4) Delete DB */
    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("Your offer has been removed!")</script>';
    } else {
        echo '<script>alert("Delete failed!")</script>';
    }

    /* (5) Release Connection */
    mysqli_close($connection);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["offer_accept"])) {
    $buyer_id = $_POST["buyer_id"];
    $seller_id = $_POST["seller_id"];
    $item_id = $_POST["item_id"];

    /* (1) Connect to Database */
    require_once('..\..\protected\config_fasttrade.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

    /* (2) Handle Connection Error */
    if (mysqli_connect_errno()) {
        die(mysqli_connect_errno());    // die() is equivalent to exit()
    }

    /* (3) Query DB */
    $sql = "UPDATE item, offer
            SET item.status=0, item.sold=1, offer.accept=1
            WHERE offer.buyer_id='". $buyer_id ."' AND offer.item_id=" . $item_id ." AND item.user_id='". $seller_id ."' AND item.item_id=". $item_id;

    /* (4) Update DB */
    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("You have accepted this offer!")</script>';
    } else {
        echo '<script>alert("Accept failed!")</script>';
    }

    /* (5) Release Connection */
    mysqli_close($connection);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["offer_reject"])) {
    $item_id = $_POST["item_id"];
    $buyer_id = $_POST["buyer_id"];

    /* (1) Connect to Database */
    require_once('..\..\protected\config_fasttrade.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

    /* (2) Handle Connection Error */
    if (mysqli_connect_errno()) {
        die(mysqli_connect_errno());    // die() is equivalent to exit()
    }

    /* (3) Query DB */
    $sql = "UPDATE offer
            SET offer.accept=0
            WHERE offer.buyer_id='". $buyer_id ."' AND offer.item_id=" . $item_id;

    /* (4) Update DB */
    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("You have rejected this offer!")</script>';
    } else {
        echo '<script>alert("Reject failed!")</script>';
    }

    /* (5) Release Connection */
    mysqli_close($connection);
}
?>