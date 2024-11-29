<?php 

    require('../../../services/FacilitatorServices.php');
    // Instantiate the class Facilitator to Get Services
    $facilitator = new FacilitatorServices();

    // Check if the action is login                   
    // <input type="hidden" name="action" value="login">
    // if POST is the request method ata the sametime the action is login then this will run
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form input
        // Santize the username and password to avoid scripting
        $username = $facilitator->clean('username', 'post');
        $password = $facilitator->clean('password', 'post');

        // Check if username and password is exist
        if (!empty($username) && !empty($password)) { 
            // username and password is exist then pass to login function from services
            $status = $facilitator->login($username,$password);
            // if status is true then go to admin index
            if($status == true){
                header("Location: dashboard.php");
                exit();
            }else{
                header("Location: index.php?error=1");
            }
           
        } else {
            $error = "Please fill in both fields.";
        }
    }

    // this is the part will pass the Log out which from config() located
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'logout') {
        $status = $facilitator->logout();
        if($status == true){
            header("Location: index.php");
            exit();
        }else{
            header("Location: index.php?error=1");
        }
    }

    
    // this is the part will pass the Log out which from config() located
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'encodeEvacuees') {
         // Santize the username and password to avoid scripting
         $id = $facilitator->clean('id', 'post');
         $fullname = $facilitator->clean('fullname', 'post');
         $address = $facilitator->clean('address', 'post');
         $age = $facilitator->clean('age', 'post');
         $birthdate = $facilitator->clean('birthdate', 'post');
         $sex = $facilitator->clean('sex', 'post');
         $isPwd = $facilitator->clean('isPwd', 'post');

         $status = $facilitator->addEvacuae($id, $fullname, $address, $age, $birthdate, $sex, $isPwd);

        if($status == true){
            header("Location: dashboard.php");
            exit();
        }else{
            header("Location: index.php?error=1");
        }
    }


?>