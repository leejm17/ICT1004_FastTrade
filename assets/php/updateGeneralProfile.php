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

$UpdateGenErr = array();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["name"]) || isset($_POST["gender"]) || isset($_POST["contact_info"])){

        //get info from POST
        $new_name = $_POST["name"];
        $new_gender = $_POST["gender"];
        $new_contactinfo = $_POST["contact_info"];

        if($new_name == "NULL"){ //if name is null as it is default in form, put it as empty str
            $new_name = '';
        }

        if($new_gender == "NULL"){ //if gender is null as it is default in form, put it as empty str
            $new_gender = '';
        }

        if($new_contactinfo == "NULL"){ //if contact is null as it is default in form, put it as empty str
            $new_contactinfo = '';
        }

        if(empty($new_name)){ //empty name
            $UpdateGenErr[0] = "Enter a name!";
        } else if(!empty($new_gender)){
            $new_gender = strtoupper($new_gender);
            if(!($new_gender == 'F' || $new_gender == 'M')){ //if not F or M (1char to put into db)
                $UpdateGenErr[1] = "For Gender, enter either F or M!";
            }else{ //update db
                $update_sql = "UPDATE user SET name = ?, gender = ?, contact_info = ? WHERE user_id = ? AND activated = ?";
                $statement = $connection->prepare($update_sql);
                if($statement){
                    $statement->bind_param("sssss", $new_name, $new_gender, $new_contactinfo, $userid, $activated);
                    $statement->execute();
                } else{
                    print_r($connection->error_list);
                }
            $UpdateGenErr[2] = "Updating of general particulars is successful!";            
            }
        }
        
    //go back to prev form
    $_SESSION['UpdateGenErr'] = $UpdateGenErr;
    header('Location: '. $_SERVER['HTTP_REFERER']);    
    }
}

?>