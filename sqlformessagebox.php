<?php 

	session_start();

    if (!isset($_SESSION['userid']) && !isset($_SESSION['activated'])){
        header('Location: 403.php');
    } else {
        $userid = $_SESSION['userid'];										/* Gets current user's user_id*/
        $activate = $_SESSION['activated'];
    }

	$page = basename($_SERVER['REQUEST_URI']);
    $itemID = $_POST["id"];                                                  /* Gets item id */

    /* (1) Connect to Database */
    require_once('..\..\protected\config_fasttrade.php');
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

    /* (2) Handle Connection Error */
    //      mysqli_connect_errno returns the last error code
    if (mysqli_connect_errno()) {
        die(mysqli_connect_errno());    // die() is equivalent to exit()
    }


    // Set default $receipientID value
    $receipientID = "";

    $chatContents = [];

    // If $_GET['buyer_id'] is set 
    if (isset($_GET['buyer_id'])){
    	$receipientID = $_GET['buyer_id'];									/* If is seller talking to buyer, set recipient to become buyer's id. itemID and userID remains the same */
    	/* Retrieve messages  */
		$selectSQL = 'SELECT * FROM message WHERE item_id = '.$itemID.' AND sender_id IN (\''.$userid.'\',\''.$receipientID.'\') AND receipient_id IN (\''.$userid.'\',\''.$receipientID.'\')';
		$result2 = $conn->query($selectSQL);

		/* Check the result of the select SQL query */
		if ($result2) {												
			$i=0;
		    //echo "Records selected! " . $result2->num_rows;
		    while($row2 = $result2->fetch_assoc()){								/* If insert successfully, fetch rows */
		    	$message = $row2['message_text'];
		    	$timestamp = $row2['message_timestamp'];
		    	if ($row2['sender_id']==$userid){
		    		$chatContents[$i][0]="buyermessage_div_css";
		    		$chatContents[$i][1]=$message;
		    		$chatContents[$i][2]=$timestamp;
		    		$i++;
		    	}
		    	else{
		    		$chatContents[$i][0]="sellermessage_div_css";
		    		$chatContents[$i][1]=$message;
		    		$chatContents[$i][2]=$timestamp;
		    		$i++;
		    	}
		    }
			echo json_encode($chatContents);
		}
    }
    else{
    	/* Get the user id of the item's seller */
	    //$getsellerID = 'SELECT user_id FROM item WHERE item_id='.$itemID.'';
	    //$sellerIDquery = $conn->query($getsellerID);

	    /* Check the result of the sellerID SQL query */
	    //if ($sellerIDquery->num_rows > 0) {                                     /* If select successfully, fetch rows */
	        //while ($row = $sellerIDquery->fetch_assoc()){
	            //$sellerID = $row['user_id'];                                    /* sellerID is captured */
	            //echo "sellerIDquery retrieved: " . $sellerID . "<br>";

	        //}
	    //}

    	/* Echo results of the select query where item_id = $itemID, and sender_id/receipient_id = $userid (current user) */

		/* Retrieve messages  */
		$selectSQL = 'SELECT * FROM message WHERE item_id = '.$itemID.' AND (sender_id=\''.$userid.'\' OR receipient_id=\''.$userid.'\')';
		//$selectSQL = 'SELECT * FROM message WHERE item_id=5 AND sender_id="leejm" OR receipient_id="leejm")';

		$result2 = $conn->query($selectSQL);

		/* Check the result of the insert SQL query */
		if ($result2) {												
			$i=0;
		    //echo "Records selected! " . $result2->num_rows;
		    while($row2 = $result2->fetch_assoc()){								/* If insert successfully, fetch rows */
		    	$message = $row2['message_text'];
		    	$timestamp = $row2['message_timestamp'];
		    	if ($row2['sender_id']==$userid){
		    		$chatContents[$i][0]="buyermessage_div_css";
		    		$chatContents[$i][1]=$message;
		    		$chatContents[$i][2]=$timestamp;
		    		$i++;
		    	}
		    	else{
		    		$chatContents[$i][0]="sellermessage_div_css";
		    		$chatContents[$i][1]=$message;
		    		$chatContents[$i][2]=$timestamp;
		    		$i++;
		    	}
		    }
			echo json_encode($chatContents);
		}
    	



    }
	/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
	

	$conn->close();														/* Close the db connection */

	//unset($_POST['refresh']);											/* Unset the 'text' POST variable once the page is refreshed */
	//echo json_encode($chatContents);									/* Encode the array in json and send it back */
?>