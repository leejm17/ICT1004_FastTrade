<?php
session_start();

$userid = $_SESSION['userid'];
$activated = $_SESSION['activated'];

//init of db
// TODO: make sure we keep note of the location of this file when porting over to hosting platform
require_once '..\..\..\..\protected\config_fasttrade.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

//mysqli_connnect_errno returns last error code
if (mysqli_connect_errno()){
    die(mysqli_connect_error()); //exits connection
}

$UpdatePwdErr = array();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["old_password"]) || isset($_POST["new_password"]) || isset($_POST["new_password_cfm"])){

        $old_pwd= $_POST["old_password"];
        $new_pwd = $_POST["new_password"];
        $cfm_pwd = $_POST["new_password_cfm"];

        //check with db for old password
        $db_pwd = ''; 
        $profile_ret_sql = "SELECT password FROM user WHERE user_id = ? or activated = ? LIMIT 1";
        if($statement = mysqli_prepare($connection, $profile_ret_sql)){
            mysqli_stmt_bind_param($statement, "si", $userid, $activated);
            mysqli_stmt_execute($statement);
            mysqli_stmt_bind_result($statement, $db_pwd);
            mysqli_stmt_fetch($statement);
            
            /* close statement */
            mysqli_stmt_close($statement);
        }

        $passwdPattern = "/\w{8,}/";
        if(empty($new_pwd) || empty($cfm_pwd) || empty($old_pwd)){
            $UpdatePwdErr[0] = 'Ensure that no fields are empty!';
        } else if(!password_verify($old_pwd, $db_pwd) && $db_pwd != NULL){
            $UpdatePwdErr[0] = 'Password not found, Please try again! ';            
        }else if($cfm_pwd != $new_pwd){
            $UpdatePwdErr[0] = 'Please enter matching passwords!';
        } else if(!preg_match($passwdPattern, $new_pwd)){
            $UpdatePwdErr[0] = 'Please enter a password with more complexity!';
        } else{
            $hashed_pwd = password_hash($new_pwd, PASSWORD_BCRYPT);
            $update_sql = "UPDATE user SET password = ? WHERE user_id = ? AND activated = ?";
            $statement = $connection->prepare($update_sql);
            if($statement){
                $statement->bind_param("sss", $hashed_pwd, $userid, $activated);
                $statement->execute();
            } else{
                print_r($connection->error_list);
            }
            $UpdatePwdErr[1] = "Updating of passwords is successful!";  
        }

        $_SESSION['UpdatePwdErr'] = $UpdatePwdErr;
        header('Location: '. $_SERVER['HTTP_REFERER']);   
    }
}

?>