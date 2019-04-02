<?php 
    
    session_start();

    if (!isset($_SESSION['userid']) && !isset($_SESSION['activated'])){
        header('Location: 403.php');
    } else {
        $userid = $_SESSION['userid'];
        $activate = $_SESSION['activated'];
    }

    $page = basename($_SERVER['REQUEST_URI']);
    $itemID = $_GET["id"];                                                  /* Gets item id */

    if (isset($_GET['buyer_id'])){
    	$buyerID = $_GET['buyer_id'];
    }

    /* (1) Connect to Database */
    require_once('..\..\protected\config_fasttrade.php');
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

    /* (2) Handle Connection Error */
    //      mysqli_connect_errno returns the last error code
    if (mysqli_connect_errno()) {
        die(mysqli_connect_errno());    // die() is equivalent to exit()
    }

    /* Get the user id of the item's seller */
    $getsellerID = 'SELECT user_id FROM item WHERE item_id='.$itemID.'';
    $sellerIDquery = $conn->query($getsellerID);

    /* Check the result of the sellerID SQL query */
    if ($sellerIDquery->num_rows > 0) {                                     /* If select successfully, fetch rows */
        while ($row = $sellerIDquery->fetch_assoc()){
            $sellerID = $row['user_id'];                                    /* sellerID is captured */
            //echo "\nsellerIDquery retrieved: \n" . $sellerID . "<br>";

        }
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    /* Checks if any text was posted to this page */
    if (isset($_POST['textfield']) && strlen(trim($_POST['textfield'])) > 0){
    	//echo "textfield is set\n";
        // Set default $receipientID value
        $receipientID = NULL;

        // If $_GET['buyer_id'] is set ()
        // INSERT: sender_id=$userid, receipient_id=$_GET['buyer_id'], item_id=$itemID
        if (isset($_GET['buyer_id'])){
            $receipientID = $_GET['buyer_id'];
        }
        //If $_GET['buyer_id'] is not set
        // INSERT: sender_id=$userid, receipient_id=$sellerID, item_id=$itemID
        else{
            /* Get the seller's user_id */
            $getsellerID = 'SELECT user_id FROM item WHERE item_id='.$itemID.'';    /* Gets item seller's user_id */
            $receipientIDquery = $conn->query($getsellerID);

            /* Check the result of the sellerID SQL query */
            if ($receipientIDquery->num_rows > 0) {                                     /* If retrieve sellers' user_id successfully, fetch rows */
                    while ($row = $receipientIDquery->fetch_assoc()){
                    $receipientID = $row['user_id'];
                    //echo "receipientIDquery retrieved: " . $receipientID . "<br>";
                }
            }
        }


        $text = addslashes($_POST['textfield']);                            /* Assign posted value 'textfield' to $text variable while escaping any quotes inside */
        date_default_timezone_set('Singapore');                             /* Set timezone to Singapore's timezone */
        $datetime = (date('Y/m/d h:i:s a', time()));                        /* Assign date and time to $datetime variable */


        $insertSQL = $conn->prepare("INSERT into message (sender_id, receipient_id, item_id, message_text, message_timestamp) VALUES (?, ?, ?, ?, ?)");
        $insertSQL->bind_param("ssiss",$userid,$receipientID,$itemID,$text,$datetime);
        $insertSQL->execute();

        /* Check the result of the insert SQL query */
        //if ($result === TRUE) {                                             /* If insert successfully, fetch rows */
            //echo "New record created successfully";
        //} 
        //else {
            //echo "Error: " . $insertSQL . "<br>" . $conn->error;
        //}
        unset($_POST['textfield']);                                             /* Unset the 'textfield' POST variable once done with it */
        $insertSQL->close();

    }


    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    $conn->close();
    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
?>

<html>
<head>
	<title>Chat with '<?php if(isset($_GET['buyer_id'])){ echo $buyerID; } else{ echo $sellerID; } ?>'</title>
	<link rel='stylesheet' type='text/css' href='assets/css/stylesht.css' />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function(){
            refresh_content();
        });

        function refresh_content(){
            var chatBODYnode = document.getElementById("ChatBody");


            while (chatBODYnode.firstChild) {
                chatBODYnode.removeChild(chatBODYnode.firstChild);
            }

            /* Defining the XMLHttpRequest */
            var httpreq = new XMLHttpRequest();
            var url = 'sqlformessagebox.php';
            var params =  "<?php if (isset($_GET['buyer_id'])){
            						 echo "id=$itemID&buyer_id=$buyerID"; 
            					} 
            					else{ 
            						echo "id=$itemID"; 
            					} ?>";
            httpreq.open('POST',url,true);

            //Send the proper header information along with the request
            httpreq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            httpreq.onreadystatechange=function(){
                if (httpreq.readyState==4 && httpreq.status==200)
                    var response = httpreq.responseText.substring(1, httpreq.responseText.length-1);

                	// once get a valid response
                    if (response){
                        var resArray = response.split("],[");

                        /* If element starts with a '[', or if element ends with a ']', remove it using substring */
                        for (var i=0; i<resArray.length; i++){
                            if (resArray[i].charAt(0)==='['){
                                resArray[i] = resArray[i].substring(1,resArray[i].length);
                            }
                            if (resArray[i].charAt(resArray[i].length-1)===']'){
                                resArray[i] = resArray[i].substring(0,resArray[i].length-1);
                            }

                            resArray[i] = resArray[i].split("\",\"");

                            /* If element starts with a '"', or if element ends with a '"', remove it using substring */
                            for (var n=0; n<resArray[i].length; n++){
                                if (resArray[i][n].charAt(0)==='\"'){
                                    resArray[i][n] = resArray[i][n].substring(1,resArray[i][n].length);
                                }
                                if (resArray[i][n].charAt(resArray[i][n].length-1)==='\"'){
                                    resArray[i][n] = resArray[i][n].substring(0,resArray[i][n].length-1);
                                }
                            }

                        }       /* End of string formatting */

                        /* Iterate the multidimensional array and create the corresponding nodes in the HTML */

                        for (var array_counter =0; array_counter<resArray.length; array_counter++){
                            //alert(typeof resArray[array_counter][0]);
                            var tempDIV = document.createElement("div");        // div class
                            tempDIV.setAttribute("class",resArray[array_counter][0])    

                            var tempP = document.createElement("p");            // message_text
                            tempP.setAttribute("class","messagetext");
                            var tempPtextnode = document.createTextNode(resArray[array_counter][1]);
                            tempP.appendChild(tempPtextnode);

                            var tempP2 = document.createElement("p");           // message_timestamp
                            tempP2.setAttribute("class","messagetimestamp");
                            var tempP2textnode = document.createTextNode(resArray[array_counter][2]);
                            tempP2.appendChild(tempP2textnode);

                            // append the 2 <p> created into the message's <div>
                            tempDIV.appendChild(tempP);
                            tempDIV.appendChild(tempP2);

                            // append the message's <div> into ChatBody
                            chatBODYnode.appendChild(tempDIV);
                        }

                        /* Always make the chat room view scroll to bottom on every refresh  */
                        document.getElementById("ChatBody").lastChild.scrollIntoView();

                	}           /* End of if got response */

            	}
            	httpreq.send(params);                             /* Send the httprequest */

            setTimeout(function(){refresh_content();}, 10000);           /* Call the function again after 8seconds */
         }

    </script>
</head>
<body>
	<div class="container-fluid">
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6 ChatBox">
				<div class="ChatHeader">
					<h3><?php if(isset($_GET['buyer_id'])){ echo $buyerID; } else{echo $sellerID;}; ?></h3>
					<span><figure></figure></span>
				</div>
				<div class="ChatBody" id="ChatBody">
					
				</div>
				<div class="ChatInput">
					<form method='post' action="messagebox.php?<?php if (isset($buyerID)){ echo "id=".$itemID."&buyer_id=".$buyerID; } else{ echo "id=".$_GET['id']; } ?>" id='chatForm'>
						<input type='text' name='textfield' id='text' placeholder="Type your message to the seller..." autocomplete="off"/>
						<input type='submit' name='submit' value='Send' id="sendbutton"/>
					</form>
				</div>
			</div>
		</div>

	</div>
</body>
</html>
