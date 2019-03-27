<?php
session_start();
//init of db
// TODO: make sure we keep note of the location of this file when porting over to hosting platform
require_once '..\..\..\..\protected\config_fasttrade.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if(isset($_POST["insert"]))  
{  
    $user_id = $_SESSION['userid'];
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
    $query = "UPDATE user SET pic='$file' WHERE user_id = '$user_id'";  
    if(mysqli_query($connection, $query))  
    {  
        $_SESSION['profilepic_msg'] = 1;
    } else{
        $_SESSION['profilepic_msg'] = 0;
    }

    header('Location: '. $_SERVER['HTTP_REFERER']);        

}  
?>