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
$RegisterErr = array();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["name"]) || isset($_POST["username"]) || isset($_POST["email"]) || isset($_POST["password"]) || isset($_POST["passwordCfm"])){
        
        //remove leading and trailing spaces
        $name = trim($_POST["name"]);
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $passwordCfm = trim($_POST["passwordCfm"]);

        if (empty($name)){//if name empty
            $RegisterErr[0] = 'Please enter your name';
        }

        //validate username are not empty
        if (empty($username)){
            $RegisterErr[1] = 'Please enter your username';
        }
        
        //check with db and see if have username.        
        $username_ret_sql = "SELECT user_id FROM user";
        if ($result = mysqli_query($connection, $username_ret_sql)){
            while ($row = mysqli_fetch_assoc($result)){
                if($row["user_id"] == $username){
                    $RegisterErr[1] = 'Please enter another username. Username is taken';
                }
            }
        }

        //free $result to be used again
        mysqli_free_result($result);


        if (empty($email)){ //if empty email
            $RegisterErr[2] = 'Please enter an email address';
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email doesnt fit requirements
            $RegisterErr[2] = 'Please enter a valid email address';
        }

        //check with db and see if have email.        
        $email_ret_sql = "SELECT email FROM user";
        if ($result = mysqli_query($connection, $email_ret_sql)){
            while ($row = mysqli_fetch_assoc($result)){
                if($row["email"] == $email){
                    $RegisterErr[2] = 'Please enter another email. Email is taken';
                }
            }
        }

        //free $result to be used again
        mysqli_free_result($result);

        $passwdPattern = "/\w{8,}/";
        if (empty($password)){
            $RegisterErr[3] = 'Please enter a password';
        }elseif (!preg_match($passwdPattern, $password)) {
            $RegisterErr[3] = 'Please enter a password with more complexity';
        }

        if (empty($passwordCfm)){
            $RegisterErr[4] = 'Please enter a password to be confirmed';
        } elseif ($passwordCfm != $password){
            $RegisterErr[4] = 'Please enter a matching password';
        }

        $_SESSION['ErrArray'] = $RegisterErr;

        if(isset($_SESSION['ErrArray'][0]) && !empty($_SESSION['ErrArray'][0])){
            $_SESSION['name'] = $name;
        }
        if(isset($_SESSION['ErrArray'][1]) && !empty($_SESSION['ErrArray'][1])){
            $_SESSION['username'] = $username;
        }
        if(isset($_SESSION['ErrArray'][2]) && !empty($_SESSION['ErrArray'][2])){
            $_SESSION['email'] = $email;
        }

    }
     
    if(empty($RegisterErr) && isset($RegisterErr)){ //success!

        //hash password first
        // https://www.sitepoint.com/hashing-passwords-php-5-5-password-hashing-api/ for password hashing
        $hashed_pwd = password_hash($password, PASSWORD_BCRYPT);

        //create hash for email verification
        $hash_email = md5(rand(0,1000)); 

        //do db stuff here - still susceptible to sqli attack. TODO: change this to be escaped!
        //name and password has to be backticked because they are reserved words
        $not_activated = 0;

        // FORSEE RUNNING INTO PROBS - will need to change url for default photo based on website hosting. TODO: when we port proj to main hosting server, change!
        $default_img_filepath = dirname(__FILE__)."\..\images\default-profile-img.png" ;
        $insert_sql = "INSERT INTO user (user_id, `name`, email, `password`, email_hash, activated, pic) VALUES (?,?,?,?,?,?,LOAD_FILE(?))";
        $statement = $connection->prepare($insert_sql);
        if($statement){
            $statement->bind_param("sssssis", $username, $name, $email, $hashed_pwd, $hash_email, $not_activated, $default_img_filepath);
            $statement->execute();
        } else{
            print_r($connection->error_list);
        }

        //do email verification stuff here
        //https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824
        // HARDCODED - will need to change url for verification link based on website hosting. TODO: when we port proj to main hosting server, change!
        
        $emailobj = new SendGrid\Mail\Mail(); 
        $emailobj->setFrom("donotreply@fasttrade.com", "donotreply");
        $emailobj->setSubject("Verification for FastTrade");
        $emailobj->addTo($email, $name);
        $emailobj->addContent("text/plain", "Welcome to the FastTrade Family $name!
                         Your account has been created! Complete the final step of verification!
                        
                         Please click this link to activate your account:
                         http://localhost/ICT1004Assignment_FastTrade/verifyEmail.php?email=$email&hash=$hash_email");
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

    header('Location: '. $_SERVER['HTTP_REFERER']);

    //close db connection
    mysqli_close($connection);
}
?>