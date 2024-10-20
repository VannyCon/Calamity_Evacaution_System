<?php

$title = "admin";
require_once('../../../controller/DashboardController.php'); 

$m = $dashboardService->getCalamityThisYear();
$topCalamities = $dashboardService->topCalamityThisYear();
$getTotal = $dashboardService->getViewTotal();


// Initialize the monthly data with zero counts
$monthlyCounts = [
    'January' => 0, 'February' => 0, 'March' => 0, 'April' => 0, 
    'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0, 
    'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0
];
// Map the results from the database to the corresponding month
if (!empty($m)) {
    foreach ($m as $entry) {
        $monthlyCounts[$entry['month_name']] = $entry['calamity_count'];
    }
}


require_once('../../components/header.php')?>
<style>
    .dashboard-text{
        font-size: 35px;
        font-weight: bold;
        color: #40aa44;
    }
    .dashboard-subtext{
        font-size: 15px;
        font-weight: light;
    }

</style>

<div class="p-2 p-md-5">
<h3 class="text-dark">Dashboard</h3>
    <div class="container-fluid mt-2">
        <div class="row g-3">
            <div class="col-md-12">
                 <div class="card p-3" style="height: 100%;">
                    <div class="stat-label"><strong>Calamity this year.</strong></div>
                    <div style="width: 100%; margin: auto;" class="mt-2">
                        <canvas id="monthAnalytics"></canvas>
                    </div>
                 </div>
            </div>
        </div>
        
        <div class="row mt-3">

            <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Top Calamity This Year</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Calamity Type</th>
                                <th>Cases</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($topCalamities)): ?>
                            <?php foreach ($topCalamities as $top): ?>
                            <tr>
                                <td><?php echo $top['calamity_type']?></td>
                                <td><?php echo $top['calamity_count']?></td>
                            </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No records found.</td>
                                </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


            <!-- Cards Column -->
        <div class="col-md-4 mt-2 mt-md-0">
            <div class="row h-100">
                <div class="col-md-6 d-flex flex-column">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h5 class="dashboard-subtext">Total evacuation</h5>
                            <p class="dashboard-text m-0 text-center mt-3 mt-md-5" style="font-size: 60px"><?php echo $getTotal['total_evacuations']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h5 class="dashboard-subtext">Total Active Calamity</h5>
                            <h5  class="dashboard-text m-0 text-center mt-3 mt-md-5" style="font-size: 60px"><?php echo $getTotal['active_calamities']?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        </div>
    </div>
</div>
   
    <script>
        const Jan = <?php echo $monthlyCounts['January']; ?>;
        const Feb = <?php echo $monthlyCounts['February']; ?>;
        const Mar = <?php echo $monthlyCounts['March']; ?>;
        const Apr = <?php echo $monthlyCounts['April']; ?>;
        const May = <?php echo $monthlyCounts['May']; ?>;
        const Jun = <?php echo $monthlyCounts['June']; ?>;
        const Jul = <?php echo $monthlyCounts['July']; ?>;
        const Aug = <?php echo $monthlyCounts['August']; ?>;
        const Sep = <?php echo $monthlyCounts['September']; ?>;
        const Oct = <?php echo $monthlyCounts['October']; ?>;
        const Nov = <?php echo $monthlyCounts['November']; ?>;
        const Dec = <?php echo $monthlyCounts['December']; ?>;
        
       // Create the bar chart
        const ctx = document.getElementById('monthAnalytics').getContext('2d');
        const monthAnalytics = new Chart(ctx, {
            type: 'bar',  // Change to bar chart
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Calamity this Year',
                    data: [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec],
                    backgroundColor: 'rgba(77, 192, 120, 0.5)',  // Light red background
                    borderColor: 'rgba(77, 192, 120, 1)',  // Dark red border
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>

   
<?php require_once('../../components/footer.php')?>
