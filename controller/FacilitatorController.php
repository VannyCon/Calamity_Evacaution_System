<?php 
session_start();
    require('../../../services/FacilitatorServices.php');
    // Instantiate the class Facilitator to Get Services
    $facilitatorServices = new FacilitatorServices();

    // Check if the action is login                   
    // <input type="hidden" name="action" value="login">
    // if POST is the request method ata the sametime the action is login then this will run
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form input
        // Santize the username and password to avoid scripting
        $username = $facilitatorServices->clean('username', 'post');
        $password = $facilitatorServices->clean('password', 'post');

        // Check if username and password is exist
        if (!empty($username) && !empty($password)) { 
            // username and password is exist then pass to login function from services
            $status = $facilitatorServices->login($username,$password);
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
        $status = $facilitatorServices->logout();
        if($status == true){
            header("Location: index.php");
            exit();
        }else{
            header("Location: index.php?error=1");
        }
    }

    
    // this is the part will pass the Log out which from config() located
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'encodeEvacuees') {
        $id = $facilitatorServices->clean('id', 'post');
        $evacuation_locid = $facilitatorServices->clean('evacuation_locid', 'post');
        $fullname = $facilitatorServices->clean('fullname', 'post');
        $address = $facilitatorServices->clean('address', 'post');
        $age = $facilitatorServices->clean('age', 'post');
        $birthdate = $facilitatorServices->clean('birthdate', 'post');
        $sex = $facilitatorServices->clean('sex', 'post');
        $isPwd = isset($_POST['isPwd']) ? 1 : 0; // Defaults to 0 if unchecked
        $isSenior = isset($_POST['isSenior']) ? 1 : 0; // Defaults to 0 if unchecked
        
    
        $status = $facilitatorServices->addEvacuae($id, $evacuation_locid, $fullname, $address, $age, $birthdate, $sex, $isPwd, $isSenior);
    
        if ($status) {
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php?error=1");
        }
    }
    



        // Instantiate the class from require_once('../../../services/DashboardService.php');
        ////////////////// facilitator /////////////////////////
        // HANDLE CREATE,UPDATE, DELETE OF ANNOUNCEMENT
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    
            // HANDLE DELETE OF ANNOUNCEMENT
            if(isset($_POST['facilitatorID']) && $_POST['action'] == 'deletefacilitator'){
                $id = $_POST['facilitatorID'];
                $status = $facilitatorServices->deleteFacilitator($id);
                if ($status == true) {
                    header("Location: facilitator.php");
                    exit();
                }
            }
            // CATCH FORM INPUT
            $facilitator_username = $_POST['facilitator_username'];
            $facilitator_password = $_POST['facilitator_password'];
            $facilitator_fullname = $_POST['facilitator_fullname'];
            $facilitator_contact_number = $_POST['facilitator_contact_number'];
            // HANDLE CREATE OF facilitator
            if ($_POST['action'] == 'createFacilitator') {
                $status = $facilitatorServices->createFacilitator($facilitator_username, $facilitator_password, $facilitator_fullname, $facilitator_contact_number);
                if ($status == true) {
                    header("Location: facilitator.php");
                    exit();
                }
            // HANDLE UPDATE OF facilitator
            } else if ($_POST['action'] == 'updateFacilitator') {
                $id = $_POST['facilitatorID'];
                $status = $facilitatorServices->updateFacilitator($id, $facilitator_username, $facilitator_password, $facilitator_fullname, $facilitator_contact_number);
                if ($status == true) {
                    header("Location: facilitator.php");
                    exit();
                }
            }
        }


?>