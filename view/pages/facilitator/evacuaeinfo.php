<?php 
include_once('../../../controller/FacilitatorController.php');
// check if the admin is already log in then it will go to index.php
if (!isset($_SESSION['facilitator'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['locID']) && !isset($_GET['locName']) && !isset($_GET['locDesciption'])) {
    header("Location: dashboard.php");
    exit();
}
$locID = $_GET['locID']; 
$locName = $_GET['locName']; 
$locDesciption = $_GET['locDesciption'];




$evacueDatas = $facilitatorServices->getEvacueByLocID($locID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calamity Management System</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../../../assets/images/logo.png" type="image/x-icon" />
    <style>
 
    </style>
</head>
<body class="px-1 px-md-5">    

<div class="p-2 p-md-5">

    <div class="p-0">
        <div class="d-flex justify-content-between">
            <h3 class="text-dark">Evacuees Info</h3>
            <div class='bottom-content'>
                <form action='' method='post'>
                    <input type='hidden' name='action' value='logout'>
                        <button type='submit' class='d-flex w-100 btn btn-danger p-0 px-3 py-2' style='padding-left: -10px'>
                            <i class='bx bx-log-out icon p-0 m-0' style='margin-left: -10px;'></i>
                            <span class='text nav-text text-start' style='line-height: 1;'>Logout</span>
                        </button>
                </form>
            </div>
        </div>
        <div>
            <a href="dashboard.php" class="btn btn-outline-danger mb-3">Back</a>
        </div>

        
        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for pest...">
        </div>

        <div class="table-responsive card p-3">
            <p><strong>Baranggay: </strong> <?php echo $locName?></p>
            <p><strong>Center: </strong><?php echo $locDesciption?></p>
            <!-- Table for nursery owners -->
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
                            <!-- table row highlight base on the current and max of the specific evacuation -->
                        
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

            <!-- Button if no records are found -->
            <div id="noRecords" class="text-center mt-3" style="display: none;">
                <p>No results found.</p>
            </div>
        </div>
    </div>
</div>
<!-- 

<!-- Corrected Bootstrap and other JS includes -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        // Modal functionality
        $('#updateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('bs-id'); // Extract info from data-* attributes
            var brgy = button.data('bs-brgy');
            var current = button.data('bs-current');
            var max = button.data('bs-max');

            // Update the modal's content.
            var modal = $(this);
            modal.find('.modal-body #statusID').val(id);
            modal.find('#brgy').text(brgy);
            modal.find('.modal-body #status').text(current+ "/"+max); // Update the span with current value

        });


        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = document.getElementById('searchInput');
            filter = input.value.toLowerCase();
            table = document.getElementById('pestData');
            tr = table.getElementsByTagName('tr');
            found = false;

            // Loop through all table rows, excluding the header
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none"; // Hide the row initially

                // Check if any cell in the row contains the search input value
                td = tr[i].getElementsByTagName('td');
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = ""; // Show the row if a match is found
                            found = true;
                            break;
                        }
                    }
                }
            }

            // Show or hide the 'No records' message
            var noRecords = document.getElementById('noRecords');
            if (!found) {
                noRecords.style.display = "block"; // Show "no records" message if nothing is found
            } else {
                noRecords.style.display = "none"; // Hide "no records" message if results are found
            }
        });
    });
</script>

 -->

<?php require_once('../../components/footer.php')?>
