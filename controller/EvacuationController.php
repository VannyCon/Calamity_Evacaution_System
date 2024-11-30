<?php 

session_start();
// check if the evacuation is already log in then it will go to index.php
// if (!isset($_SESSION['username'])) {
//     header("Location: ../../../index.php");
//     exit();
// }
// check if the evacuation is already log in then it will go to index.php

    // import evacuation services
    require_once('../../../services/EvacuationServices.php');

    // Instantiate the class from require_once('../../../services/DashboardService.php');
    $evacuationService = new EvacuationServices();
    ////////////////// EVACUATION /////////////////////////

    
    // THIS HANDLE THE UPDATE OF CURRENT AND MAX OF THE EVACUATION
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'updateStatus') {
        // Retrieve form input
        // Santize the Username and password to avoid scripting
        $id = $evacuationService->clean('id', 'post');
        $current = $evacuationService->clean('current', 'post');
        $max = $evacuationService->clean('max', 'post');

        // Check if username and password is exist
        if (!empty($current) && !empty($max)&& !empty($id)) { 
            // username and password is exist then pass to login function from services
            $status = $evacuationService->updateEvacuationStatus($id, $current, $max);
            // if status is true then go to evacuation index
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



    // HANDLE THE POST CREATE,UPDATE, DELETE 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
        // HANDLE DELETE
        if(isset($_POST['locID']) && $_POST['action'] == 'deleteEvacaution'){
            $locID = $_POST['locID'];
            $status = $evacuationService->deleteEvacuationLocation($locID);
            if ($status == true) {
                header("Location: evacaution_location.php");
                exit();
            }
        }
        // HANDLE FORM INPUT
        $location_name = $_POST['location_name'];
        $description = $_POST['description'];
        $location_latitude = $_POST['lat'];
        $location_longhitude = $_POST['lng'];

        // HANDLE UPDATE OF EVACUATION
        if ($_POST['action'] == 'updateLocation') {
            $locID = $_POST['locID'];
            $status = $evacuationService->updateLocation($locID, $location_name, $description, $location_latitude, $location_longhitude);
            if ($status == true) {
                header("Location: evacaution_location.php");
                exit();
            }
        // HANDLE CREATE OF EVACUATION
        }else if($_POST['action'] == 'createEvacuationLocation'){
            $current = $_POST['current'];
            $max = $_POST['max'];
            $status = $evacuationService->createEvacuationLocation($location_name, $description,  $location_latitude, $location_longhitude, $current, $max);
            if ($status == true) {
                header("Location: evacaution_location.php");
                exit();
            }
        }
    }
    ////////////////// EVACUATION /////////////////////////


        // THIS HANDLE THE UPDATE OF CURRENT AND MAX OF THE EVACUATION
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'resetEvactionData') {
            $status = $evacuationService->resetEvacuationData();
            if ($status == true) {
                if($_POST['from'] == 'table'){
                    header("Location: table.php");
                }else if($_POST['from'] == 'map'){
                    header("Location: map.php");
                }
            }

        }
?>