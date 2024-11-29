<?php
$title = "admin";
$part = "report";
$title = "admin";
require_once('../../../controller/DashboardController.php'); 

require_once('../../components/header.php')?>
    <div class="container d-flex justify-content-center align-items-center h-100">
                <!-- Centered Card -->
    <div class="card shadow-lg  justify-content-center align-items-center pt-3" style="width: 20rem;">
        <img src="../../../assets/images/report.png" class="card-img-top" alt="Report Image" style="height: 50px; width: 50px;">
        <div class="card-body text-center">
            <h5 class="card-title">Download Report</h5>
            <p class="card-text">Click the button below to download your report.</p>
            <a href="reportpdf.php" class="btn btn-success w-100" >
                <i class="bi bi-download"></i> Download
            </a>
        </div>
    </div>
    </div>

    <?php include_once('../../components/footer.php'); ?>