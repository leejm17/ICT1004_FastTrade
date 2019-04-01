<?php 
session_start();
$servername = "localhost";
$username = "pswrite";
$password = "1qwer$#@!";
$dbname = "test";
$currentuser = 'hohoho';												/* Change to get from $_SESSION */		
$itemID = 1;															/* Change to get from $_GET */
$chatContents = "";														/* Initializing chat contents array to NULL, will be appended with values later (if any) */


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
/* Checks if any text was posted to this page */
if (isset($_POST['textfield']) && strlen(trim($_POST['textfield'])) > 0){
	$text = addslashes($_POST['textfield']);							/* Assign posted value 'textfield' to $text variable while escaping any quotes inside */
	date_default_timezone_set('Singapore');								/* Set timezone to Singapore's timezone */
	$datetime = (date('Y/m/d h:i:s a', time()));						/* Assign date and time to $datetime variable */


	$insertSQL = "INSERT into message (sender_id, receipient_id, item_id, message_text, message_timestamp) VALUES ('$currentuser','$sellerID',$itemID,'$text','$datetime')";
	$result = $conn->query($insertSQL);

	/* Check the result of the insert SQL query */
	if ($result === TRUE) {												/* If insert successfully, fetch rows */
	    //echo "New record created successfully";
	} 
	else {
	    echo "Error: " . $insertSQL . "<br>" . $conn->error;
	}
	unset($_POST['textfield']);												/* Unset the 'textfield' POST variable once done with it */

}
/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
$conn->close();
/* ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
?>

<html>
<head>
	<title>Chat Box</title>
	<link rel='stylesheet' type='text/css' href='assets/css/stylesht.css' />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>

		$(document).ready(function(){
			//display_content();
			refresh_content();
		});
		
		function display_content(){
			var content_section = document.getElementById("ChatBody");

			var str = "<?php echo $chatContents ?>";
			content_section.innerHTML = str;
		}

		function refresh_content(){
			var chatBODYnode = document.getElementById("ChatBody");


			while (chatBODYnode.firstChild) {
			    chatBODYnode.removeChild(chatBODYnode.firstChild);
			}

			/* Defining the XMLHttpRequest */
		    var httpreq = new XMLHttpRequest();
		    httpreq.onreadystatechange=function(){
		    	if (httpreq.readyState==4 && httpreq.status==200)
		    		var response = httpreq.responseText.substring(1, httpreq.responseText.length-1);

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

		    			}		/* End of string formatting */

		    			/* Iterate the multidimensional array and create the corresponding nodes in the HTML */

		    			for (var array_counter =0; array_counter<resArray.length; array_counter++){
		    				//alert(typeof resArray[array_counter][0]);
		    				var tempDIV = document.createElement("div");		// div class
		    				tempDIV.setAttribute("class",resArray[array_counter][0])	

		    				var tempP = document.createElement("p");			// message_text
		    				tempP.setAttribute("class","messagetext");
		    				var tempPtextnode = document.createTextNode(resArray[array_counter][1]);
		    				tempP.appendChild(tempPtextnode);

		    				var tempP2 = document.createElement("p");			// message_timestamp
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

		    		}			/* End of if got response */

		    }
		    httpreq.open('POST',"sqlformessagebox.php",true);
		    httpreq.send();								/* Send the httprequest */
		    setTimeout(function(){refresh_content();}, 8000);			/* Call the function again after 8seconds */
		 }

	</script>
</head>
<body>
	<div class="container-fluid">
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6 ChatBox">
				<div class="ChatHeader">
					<h3><?php echo $sellerID; ?></h3>
					<span><figure></figure></span>
				</div>
				<div class="ChatBody" id="ChatBody">
					
				</div>
				<div class="ChatInput">
					<form method='post' action="messagebox.php" id='chatForm'>
						<input type='text' name='textfield' id='text' placeholder="Type your message to the seller..." autocomplete="off"/>
						<input type='submit' name='submit' value='Send' id="sendbutton"/>
					</form>
				</div>
			</div>
		</div>

	</div>
</body>
</html>