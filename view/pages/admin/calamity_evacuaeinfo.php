<?php 
include_once('../../../controller/FacilitatorController.php');
session_start();
// Check if the admin is logged in
if (!isset($_SESSION['facilitator'])) {
    header("Location: index.php");
    exit();
}

// Validate location data
if (!isset($_GET['locID']) || !isset($_GET['locName']) || !isset($_GET['locDesciption'])) {
    header("Location: dashboard.php");
    exit();
}

// Fetch location data
$locID = $_GET['locID']; 
$locName = $_GET['locName']; 
$locDesciption = $_GET['locDesciption'];
$facilitatorName = $_GET['facilitatorName'];

$evacueDatas = $facilitatorServices->getEvacueByLocID($locID);

// Get current date and day of the week
$currentDate = date('F j, Y');
$currentDay = date('l'); // Day of the week
?>

<?php require_once('../../components/header.php')?>
<div class="p-2 p-md-5">

    <div class="d-flex justify-content-between">
        <h3 class="text-dark">Evacuees Info</h3>
        <form action="" method="post" class="no-print">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <a href="dashboard.php" class="btn btn-outline-danger mb-3 no-print">Back</a>

    <p class="print-only"><strong>Printed On: </strong> <?php echo $currentDate . ' (' . $currentDay . ')'; ?></p>

    <div class="table-responsive card p-3">
        <div class="d-flex justify-content-between w-100">
            <div> 
                <p><strong>Barangay: </strong> <?php echo htmlspecialchars($locName); ?></p>
                <p><strong>Center: </strong> <?php echo htmlspecialchars($locDesciption); ?></p>
                <p><strong>Facilitator Name: </strong> <?php echo htmlspecialchars($facilitatorName); ?></p>
            </div>
            <div class="mt-3 no-print">
                <button onclick="window.print();" class="btn btn-primary">Print</button>
            </div>
        </div>

            

        <!-- Evacuee Data Table -->
        <table border="1" class="table p-3" id="pestData">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>isPwd</th>
                    <th>Senior</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($evacueDatas)): ?>
                    <?php foreach ($evacueDatas as $evacueData): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($evacueData['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($evacueData['address']); ?></td>
                            <td><?php echo htmlspecialchars($evacueData['age']); ?></td>
                            <td><?php echo htmlspecialchars($evacueData['sex']); ?></td>
                            <td><?php echo ($evacueData['isPwd'] == 1) ? "Yes" : "No"; ?></td>
                            <td><?php echo ($evacueData['isSenior'] == 1) ? "Yes" : "No"; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Print and Export Buttons -->
</div>
<?php require_once('../../components/footer.php')?>