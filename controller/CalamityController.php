<?php

session_start();
// check if the calamity is already log in then it will go to index.php
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}
// import calamity services
require_once('../../../services/CalamityServices.php');

// Instantiate the class from require_once('../../../services/DashboardService.php');
$calamityService = new CalamityServices();

$error_message = '';

    ////////////////// CALAMITY /////////////////////////
    // THIS PART HANDLE CALAMITY CREATE,UPDATE,DELETE
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

        // HANDLE DELETE
        if(isset($_POST['reactiveID']) && $_POST['action'] == 'reactiveCalamity'){
            $id = $_POST['reactiveID'];
            $status = $calamityService->reactiveCalamity($id);
            if ($status == true) {
                header("Location: history.php");
                exit();
            }
        }

        //CATCH FORM INPUT
        $calamity_date = $_POST['date'];
        $calamity_time = $_POST['time'];
        $calamity_type_id = $_POST['type'];
        $calamity_status_id = $_POST['status'];

        // HANDLE CREATE
        if ($_POST['action'] == 'createCalamity') {
            $status = $calamityService->createCalamity($calamity_type_id, $calamity_status_id, $calamity_date, $calamity_time);
            if ($status == true) {
                header("Location: calamity.php");
                exit();
            }
        // HANDLEU PDATE 
        } else if ($_POST['action'] == 'updateCalamity') {
            $id = $_POST['id'];
            $calamity_active = isset($_POST['active']) ? 1 : 0;
            $status = $calamityService->updateCalamity($id, $calamity_type_id, $calamity_status_id, $calamity_active, $calamity_date, $calamity_time);
            if ($status == true) {
                header("Location: calamity.php");
                exit();
            }
        }
    }
     ////////////////// CALAMITY /////////////////////////
?>
