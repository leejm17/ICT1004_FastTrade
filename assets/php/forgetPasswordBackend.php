<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//for SendGrid email validation
require 'vendor/autoload.php';
require_once '..\..\..\..\protected\config_sendgrid.php';

//init of db
// TODO: make sure we keep note of the location of this file when porting over to hosting platform
require_once '..\..\..\..\protected\config_fasttrade.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

//mysqli_connnect_errno returns last error code
if (mysqli_connect_errno()){
    die(mysqli_connect_error()); //exits connection
}

session_start();

$identifierErr = '';
$identifier = '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["identifier"])){
        
        //remove leading and trailing spaces
        $identifier = trim($_POST["identifier"]);
        
        if (!empty($identifier)){
            //check with db and see if have identifier.
            $email = $name = '';
            $identifier_ret_sql = "SELECT email, name FROM user WHERE user_id = ? or email = ? LIMIT 1";
            if($statement = mysqli_prepare($connection, $identifier_ret_sql)){
                mysqli_stmt_bind_param($statement, "ss", $identifier, $identifier);
                mysqli_stmt_execute($statement);
                mysqli_stmt_bind_result($statement, $email, $name);
                mysqli_stmt_fetch($statement);
            
                /* close statement */
                mysqli_stmt_close($statement);

                if($email == NULL){
                    $identifierErr = 'Username/email not found, Please try again!'; //if no result found
                    $_SESSION['identifierErr'] = $identifierErr;
                    $_SESSION['identifier'] = $identifier;
                } else{ //result found! send email!

                    //create hash for email verification
                    $hash_email = md5(rand(0,1000)); 

                    //do db stuff here - still susceptible to sqli attack. TODO: change this to be escaped!
                    //name and password has to be backticked because they are reserved words
                    $not_activated = 0;

                    $update_sql = "UPDATE user SET email_hash = ? WHERE email = ? or user_id = ?";
                    $statement = $connection->prepare($update_sql);
                    if($statement){
                        $statement->bind_param("sss", $hash_email, $identifier, $identifier);
                        $statement->execute();
                    } else{
                        print_r($connection->error_list);
                    }

                    //do email verification stuff here
                    //https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824
                    // HARDCODED - will need to change url for verification link based on website hosting. TODO: when we port proj to main hosting server, change!
                    
                    $emailobj = new SendGrid\Mail\Mail(); 
                    $emailobj->setFrom("donotreply@fasttrade.com", "donotreply");
                    $emailobj->setSubject("FastTrade - Forget Password");
                    $emailobj->addTo($email, $name);
                    $emailobj->addContent("text/plain", "Hello $name!
                                    We have noted that you have forgotton your password.
                                    
                                    Please click this link to change your password:
                                    http://localhost/ICT1004Assignment_FastTrade/verifyForgetPassword.php?email=$email&hash=$hash_email");
                    $sendgrid = new \SendGrid(API_KEY);
                    try {
                        $response = $sendgrid->send($emailobj);
                        print $response->statusCode() . "\n";
                        print_r($response->headers());
                        print $response->body() . "\n";
                        $_SESSION['need_verification'] = 1;
                    } catch (Exception $e) {
                        echo 'Caught exception: '. $e->getMessage() ."\n";
                    }
                }
            }
        }
     

    header('Location: '. $_SERVER['HTTP_REFERER']);

    //close db connection
    mysqli_close($connection);

    }
}
?>