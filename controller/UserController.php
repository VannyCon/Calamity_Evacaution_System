<?php 

require_once('../../../services/CalamityServices.php');
require_once('../../../services/AnnouncementServices.php');
// Instantiate the class from require_once('../../../services/DashboardService.php');
// HANDLE CONNECTION TO CalamitySERVICE WHICH IT WILL GIVE DATA TO USER
$calamity = new CalamityServices();
// HANDLE CONNECTION TO AnnouncementSERVICE WHICH IT WILL GIVE DATA TO USER
$announcement= new AnnouncementServices();
?>