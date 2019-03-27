<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//init of db
// TODO: make sure we keep note of the location of this file when porting over to hosting platform
require_once '..\..\..\..\protected\config_fasttrade.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

//mysqli_connnect_errno returns last error code
if (mysqli_connect_errno()){
    die(mysqli_connect_error()); //exits connection
}

session_start();
$LoginErr = array(); //creates array of errors
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["identifier"]) || isset($_POST["password"])){
        
        //create $user_id and $activated to be stored in session later
        $user_id = '';
        $activated = '';

        //remove leading and trailing spaces
        $identifier = trim($_POST["identifier"]);
        $password = trim($_POST["password"]);

        if (empty($identifier)){ //if no identifier is entered
            $LoginErr[0] = 'Please enter your name/email';
        }
        
        //check with db and see if have identifier.
        $identifier_ret_sql = "SELECT user_id, activated FROM user WHERE email = ? or user_id = ? LIMIT 1";
        if($statement = mysqli_prepare($connection, $identifier_ret_sql)){
            mysqli_stmt_bind_param($statement, "ss", $identifier, $identifier);
            mysqli_stmt_execute($statement);
            mysqli_stmt_bind_result($statement, $user_id, $activated);
            mysqli_stmt_fetch($statement);
        
            if($user_id == NULL){
                $LoginErr[0] = 'Username/email not found, Please try again!'; //if no result found
            } else if ($activated == NULL) {
                $LoginErr[0] = 'Account not activated yet! Please contact your local administrator.'; //if account has not been activated.
            }
            /* close statement */
            mysqli_stmt_close($statement);
        } 

        if (empty($password)){
            $LoginErr[1] = 'Please enter a password';
        }

        //check with db and see if have password.
        $password_ret_sql = "SELECT password FROM user WHERE email = ? or user_id = ? LIMIT 1";
        if($statement = mysqli_prepare($connection, $password_ret_sql)){
            mysqli_stmt_bind_param($statement, "ss", $identifier, $identifier);
            mysqli_stmt_execute($statement);
            mysqli_stmt_bind_result($statement, $db_pwd);
            mysqli_stmt_fetch($statement);
        
            if(!password_verify($password, $db_pwd) && $db_pwd != NULL){//check if password matches that of db
                $LoginErr[1] = 'Password not found, Please try again! '; //if no result found
                                                                        // will not come here unless there is a valid identifier                
            }
            /* close statement */
            mysqli_stmt_close($statement);
        } 

        $_SESSION['ErrArray'] = $LoginErr;
        $_SESSION['identifier'] = $identifier;
    }
     
    if(empty($LoginErr) && isset($LoginErr)){ //success!
        //add user id and activated status to session
        //redirect to index.php
        $_SESSION['userid'] = $user_id;
        $_SESSION['activated'] = $activated;
        header('Location: ../../index.php');
    } else{
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }

    //close db connection
    mysqli_close($connection);
}
?>