<?php 
	session_start();
	$servername = "localhost";
	$username = "pswrite";
	$password = "1qwer$#@!";
	$dbname = "test";
	$currentuser = 'hohoho';												/* Change to get from $_SESSION */		
	$itemID = 1;															/* Change to get from $_GET */
	$chatContents = array();														/* Initializing chat contents array to NULL, will be appended with values later (if any) */


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
	/* Get the seller's user_id */
	$getsellerID = 'SELECT user_id FROM item WHERE item_id='.$itemID.'';
	$sellerIDquery = $conn->query($getsellerID);

	/* Check the result of the sellerID SQL query */
	if ($sellerIDquery->num_rows > 0) {										/* If insert successfully, fetch rows */
		    while ($row = $sellerIDquery->fetch_assoc()){
	    	$sellerID = $row['user_id'];
	    	//echo "sellerIDquery retrieved: " . $sellerID . "<br>";

	    }
	    //$sellerID='hohoho';
	} 
	else {
	    //echo "Error: " . $sellerIDquery . "<br>" . $conn->error;
	}
	/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */


	/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
	/* Retrieve messages  */
	$selectSQL = 'SELECT * FROM message WHERE item_id = '.$itemID.' AND (sender_id=\''.$currentuser.'\' OR receipient_id=\''.$currentuser.'\')';
	$result2 = $conn->query($selectSQL);

	/* Check the result of the insert SQL query */
	if ($result2->num_rows > 0) {												
		$i=0;
	    //echo "Records selected! " . $result2->num_rows;
	    while($row2 = $result2->fetch_assoc()){								/* If insert successfully, fetch rows */
	    	$message = $row2['message_text'];
	    	$timestamp = $row2['message_timestamp'];
	    	if ($row2['sender_id']==$currentuser){
	    		//$chatContents .= '&lt;div class=\"buyermessage_div_css\"&gt;&lt;p class=\"messagetext\"&gt;'.$message.'&lt;/p&gt;&lt;p class=\"messagetimestamp\"&gt;'.$timestamp.'&lt;/p&gt;&lt;/div&gt;';
	    		$chatContents[$i][0]="buyermessage_div_css";
	    		$chatContents[$i][1]=$message;
	    		$chatContents[$i][2]=$timestamp;
	    		$i++;
	    	}
	    	else{
	    		//$chatContents .= '&lt;div class=\"sellermessage_div_css\"&gt;&lt;p class=\"messagetext\"&gt;'.$message.'&lt;/p&gt;&lt;p class=\"messagetimestamp\"&gt;'.$timestamp.'&lt;/p&gt;&lt;/div&gt;';
	    		$chatContents[$i][0]="sellermessage_div_css";
	    		$chatContents[$i][1]=$message;
	    		$chatContents[$i][2]=$timestamp;
	    		$i++;
	    	}
	    }
		//echo json_encode($chatContents);
		echo json_encode($chatContents);
	}

	$conn->close();														/* Close the db connection */

	//unset($_POST['refresh']);											/* Unset the 'text' POST variable once the page is refreshed */
	//echo json_encode($chatContents);									/* Encode the array in json and send it back */
?>