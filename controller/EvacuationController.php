<?php 

session_start();
// check if the admin is already log in then it will go to index.php
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}
// check if the admin is already log in then it will go to index.php

    // import Admin services
    require_once('../../../services/AdminService.php');

    // Instantiate the class from require_once('../../../services/DashboardService.php');
    $adminService = new AdminServices();
    ////////////////// ANNOUNCEMENT /////////////////////////
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

        if(isset($_POST['locID']) && $_POST['action'] == 'deleteEvacaution'){
            $locID = $_POST['locID'];
            $status = $adminService->deleteEvacuationLocation($locID);
            if ($status == true) {
                header("Location: evacaution_location.php");
                exit();
            }
        }
        
        $location_name = $_POST['location_name'];
        $description = $_POST['description'];
        $location_latitude = $_POST['lat'];
        $location_longhitude = $_POST['lng'];


        if ($_POST['action'] == 'updateLocation') {
            $locID = $_POST['locID'];
            $status = $adminService->updateLocation($locID, $location_name, $description, $location_latitude, $location_longhitude);
            if ($status == true) {
                header("Location: evacaution_location.php");
                exit();
            }
        }else if($_POST['action'] == 'createEvacuationLocation'){
            $current = $_POST['current'];
            $max = $_POST['max'];
            $status = $adminService->createEvacuationLocation($location_name, $description,  $location_latitude, $location_longhitude, $current, $max);
            if ($status == true) {
                header("Location: evacaution_location.php");
                exit();
            }
        }
    }
    ////////////////// ANNOUNCEMENT /////////////////////////
?>