<?php

session_start();
// check if the admin is already log in then it will go to index.php
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}
// import Admin services
require_once('../../../services/DashboardServices.php');

// Instantiate the class from require_once('../../../services/DashboardService.php');
$dashboardService = new DashboardServices();
$error_message = '';
?>
