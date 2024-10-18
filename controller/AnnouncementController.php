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

        if(isset($_POST['announcementID']) && $_POST['action'] == 'deleteAnnouncement'){
            $id = $_POST['announcementID'];
            $status = $adminService->deleteAnnouncement($id);
            if ($status == true) {
                header("Location: annoucement.php");
                exit();
            }
        }

        $announcement_date = $_POST['date'];
        $announcement_time = $_POST['time'];
        $announcement_title = $_POST['title'];
        $announcement_description = $_POST['description'];

        if ($_POST['action'] == 'createAnnouncement') {
            $status = $adminService->createAnnouncement($announcement_title, $announcement_description, $announcement_date, $announcement_time);
            if ($status == true) {
                header("Location: annoucement.php");
                exit();
            }
        } else if ($_POST['action'] == 'updateAnnouncement') {
            $id = $_POST['announcementID'];
            $status = $adminService->updateAnnouncement($id, $announcement_title, $announcement_description, $announcement_date, $announcement_time);
            if ($status == true) {
                header("Location: annoucement.php");
                exit();
            }
        }
    }
    ////////////////// ANNOUNCEMENT /////////////////////////
?>