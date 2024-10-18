<?php

session_start();
// check if the admin is already log in then it will go to index.php
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}
// import Admin services
require_once('../../../services/AdminService.php');

// Instantiate the class from require_once('../../../services/DashboardService.php');
$adminService = new AdminServices();

$error_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'updateStatus') {
    // Retrieve form input
    // Santize the Username and password to avoid scripting
    $id = $adminService->clean('id', 'post');
    $current = $adminService->clean('current', 'post');
    $max = $adminService->clean('max', 'post');

    // Check if username and password is exist
    if (!empty($current) && !empty($max)&& !empty($id)) { 
        // username and password is exist then pass to login function from services
        $status = $adminService->updateEvacuationStatus($id, $current, $max);
        // if status is true then go to admin index
        if($status == true){
            if ($_POST['part'] == 'map') {
                header("Location: map.php");
            } else {
                header("Location: table.php");
            }
            exit();  // Ensure script stops after redirection
        
        }else{
            header("Location: index.php?error=1");
        }
       
    } else {
        $error = "Please fill in both fields.";
    }
}


    ////////////////// CALAMITY /////////////////////////
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

        if(isset($_POST['reactiveID']) && $_POST['action'] == 'reactiveCalamity'){
            $id = $_POST['reactiveID'];
            $status = $adminService->reactiveCalamity($id);
            if ($status == true) {
                header("Location: history.php");
                exit();
            }
        }

        $calamity_date = $_POST['date'];
        $calamity_time = $_POST['time'];
        $calamity_type_id = $_POST['type'];
        $calamity_status_id = $_POST['status'];

        if ($_POST['action'] == 'createCalamity') {
            $status = $adminService->createCalamity($calamity_type_id, $calamity_status_id, $calamity_date, $calamity_time);
            if ($status == true) {
                header("Location: calamity.php");
                exit();
            }
        } else if ($_POST['action'] == 'updateCalamity') {
            $id = $_POST['id'];
            $calamity_active = isset($_POST['active']) ? 1 : 0;
            $status = $adminService->updateCalamity($id, $calamity_type_id, $calamity_status_id, $calamity_active, $calamity_date, $calamity_time);
            if ($status == true) {
                header("Location: calamity.php");
                exit();
            }
        }
    }
     ////////////////// CALAMITY /////////////////////////


    

?>
