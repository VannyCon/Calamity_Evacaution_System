<?php
$title = "admin";
$part = "report";
$title = "admin";
require_once('../../../controller/DashboardController.php'); 
require_once('../../../controller/CalamityController.php');
require_once('../../components/header.php');
?>
<div class="container-fluid py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-lg text-center pt-3">
                <img src="../../../assets/images/report.png" class="card-img-top img-fluid mx-auto" alt="Report Image" style="height: 50px; width: 50px;">
                <div class="card-body">
                    <p class="card-title"><strong>Calamity Report This Year</strong></p>
                    <p class="card-text">Summary of Calamity this Year and Total Evacuation.</p>
                    <!-- Year Selection -->
                    <!--  -->
                    <!-- Download Button -->
                    <a class="btn btn-success w-100" href="reportpdf.php">
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
         <!-- Card 2 -->
         <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-lg text-center pt-3">
                <img src="../../../assets/images/evacauerep.png" class="card-img-top img-fluid mx-auto" alt="Report Image" style="height: 50px; width: 50px;">
                <div class="card-body">
                    <p class="card-title"><strong>Evacue Report</strong></p>
                    <p class="card-text">Print all Evacue info in a specific Evacuation Center.</p>

                    <!-- Select Dropdown for Calamity -->
                    <div class="mb-3">
                        <select id="evacueReportCalamity" class="form-select">
                            <option value="">Select a Calamity</option>
                            <?php
                            // Fetch calamities
                            $histories = $calamityService->getNotActiveCalamity();
                            foreach ($histories as $calamity) {
                                $calamityId = htmlspecialchars($calamity['id']);
                                $calamity_id = htmlspecialchars($calamity['calamity_id']);
                                $calamity_type = htmlspecialchars($calamity['type_calamity_type']);
                                $type = htmlspecialchars($calamity['type_calamity_type']);
                                $description = htmlspecialchars($calamity['calamity_description']);
                                $date = htmlspecialchars($calamity['calamity_date']);
                                $date_end = htmlspecialchars($calamity['calamity_end_datetime']);
                                $time = htmlspecialchars($calamity['calamity_time']);
                                $calamityDescription = htmlspecialchars($calamity['calamity_description']);

                                // Store all necessary data as JSON in a data attribute
                                echo "<option value='$calamityId' 
                                    data-calamity-id='$calamity_id'
                                    data-date='$date' 
                                    data-calamity-type='$calamity_type'
                                    data-time='$time' 
                                    data-date-end='$date_end' 
                                    data-description='$calamityDescription'>
                                    $type - $description
                                </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Check Button -->
                    <button class="btn btn-info w-100" onclick="checkEvacueReport()">
                        <i class="bi bi-download"></i> Check
                    </button>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-lg text-center pt-3">
                <img src="../../../assets/images/excel.png" class="card-img-top img-fluid mx-auto" alt="Report Image" style="height: 50px; width: 50px;">
                <div class="card-body">
                    <p class="card-title"><strong>Evacuation Status Report</strong></p>
                    <p class="card-text">Print all the Evacuation Status based on the Calamity.</p>
                    <!-- Select Dropdown for Calamity -->
                    <div class="mb-3">
                        <select id="evacuationStatusReport" class="form-select">
                            <option value="">Select a Calamity</option>
                            <?php
                            // Fetch calamities
                            $histories = $calamityService->getNotActiveCalamity();
                            foreach ($histories as $calamity) {
                                $calamityId = htmlspecialchars($calamity['id']);
                                $calamity_id = htmlspecialchars($calamity['calamity_id']);
                                $type = htmlspecialchars($calamity['type_calamity_type']);
                                $description = htmlspecialchars($calamity['calamity_description']);
                                $date = htmlspecialchars($calamity['calamity_date']);
                                $time = htmlspecialchars($calamity['calamity_time']);

                                // Store all necessary data as JSON in a data attribute
                                echo "<option value='$calamityId' 
                                    data-date='$date' 
                                    data-calamity-id='$calamity_id'
                                    data-time='$time' 
                                    data-calamitytype='$type'
                                    data-description='$description'>
                                    $type - $description
                                </option>";
                            }
                            ?>
                        </select>
                    </div>
                     <!-- Check Button -->
                     <button class="btn btn-success w-100" onclick="checkEvacuationStatusReport()">
                        <i class="bi bi-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function downloadCalamityReport() {
        // Get the selected year
        const selectedYear = document.getElementById('calamityReportYear').value;
        // Redirect to the download URL with the selected year as a query parameter
        window.location.href = `reportpdf.php`;
    }

    function checkEvacueReport() {
        // Get the selected calamity from the dropdown
        const calamitySelect = document.getElementById('evacueReportCalamity');
        const selectedOption = calamitySelect.options[calamitySelect.selectedIndex];

        if (!selectedOption.value) {
            alert('Please select a calamity first.');
            return;
        }

        // Get calamity details from the selected option's data attributes
        const calamity_id = selectedOption.getAttribute('data-calamity-id');
        const calamity_type = selectedOption.getAttribute('data-calamity-type');
        const calamityDate = selectedOption.getAttribute('data-date');
        const calamityEndDate = selectedOption.getAttribute('data-date-end');
        const calamityTime = selectedOption.getAttribute('data-time');
        const calamityDescription = selectedOption.getAttribute('data-description');

        
        // Redirect to the report page with the calamity details as query parameters
        window.location.href = `calamity_evacuation.php?calamity_id=${calamity_id}&calamity_type=${calamity_type}&date=${encodeURIComponent(calamityDate)}&enddate=${encodeURIComponent(calamityEndDate)}&description=${encodeURIComponent(calamityDescription)}`;
    }

    function checkEvacuationStatusReport() {
        // Get the selected calamity from the dropdown
        const calamitySelect = document.getElementById('evacuationStatusReport');
        const selectedOption = calamitySelect.options[calamitySelect.selectedIndex];

        if (!selectedOption.value) {
            alert('Please select a calamity first.');
            return;
        }

        // Get calamity details from the selected option's data attributes
        const calamity_id = selectedOption.getAttribute('data-calamity-id');
        const calamityDate = selectedOption.getAttribute('data-date');
        const calamityTime = selectedOption.getAttribute('data-time');
        const calamitytype = selectedOption.getAttribute('data-calamitytype');
        const calamityDescription = selectedOption.getAttribute('data-description');

        // Redirect to the report page with the calamity details as query parameters
        window.location.href = `calamity_report.php?calamity_id=${calamity_id}&date=${encodeURIComponent(calamityDate)}&calamitytype=${encodeURIComponent(calamitytype)}&description=${encodeURIComponent(calamityDescription)}`;
    }
</script>
<?php include_once('../../components/footer.php'); ?>
