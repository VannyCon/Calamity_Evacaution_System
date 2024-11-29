<?php 

require_once('../../../controller/CalamityController.php');

$histories = $calamityService->getNotActiveCalamity();
?>
<?php require_once('../../components/header.php')?>


<!-- DELETE MODAL -->
<div class="modal fade" id="reactiveModal" tabindex="-1" aria-labelledby="reactiveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reactiveModalLabel">Confirm Reactivation of Calamity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Reactivation this Calamity? 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    <input type="hidden" name="reactiveID" id="reactiveID">
                    <input type="hidden" name="action" value="reactiveCalamity">
                    <button type="submit" class="btn btn-info">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="p-1 p-md-5">

    <div class="p-0">
        <h3 class="text-dark">Calamity History</h3>

        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for pest...">
        </div>

        <div class="table-responsive card p-3">
            <!-- Table for nursery owners -->
            <table border="1" class="table p-3" id="pestData">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Type Of Calamity</th>
                        <th>Level</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($histories)): ?>
                        <?php foreach ($histories  as $history): ?>
                            <!-- table row highlight base on the current and max of the specific evacuation -->
                            
                            <tr>
                                <td><?php
                                    $date = new DateTime($history['calamity_date']);
                                    echo $date->format('F j, Y')?>
                                </td>
                                <td><?php
                                    $time = new DateTime($history['calamity_time']);
                                    echo $time->format('g:i A')?>
                                </td>
                                <td><?php echo htmlspecialchars($history['type_calamity_type']); ?></td>
                                <td><?php echo htmlspecialchars($history['status_level']); ?></td>
                                <td><?php echo htmlspecialchars($history['status_color']); ?></td>
                                <td>
                                    <?php 
                                    $datenow = new DateTime('now'); 
                                    // Compare formatted dates as strings
                                    if ($date->format('F j, Y') == $datenow->format('F j, Y')) {
                                    ?>
                                        <button type="button" class="btn btn-info mx-0 mx-md-2 my-1 my-md-0" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#reactiveModal"
                                                data-bs-id="<?php echo htmlspecialchars($history['id']); ?>">
                                                Reactive
                                        </button>
                                    <?php 
                                    } else {
                                    ?>
                                        <p>Unavailable</p>
                                    <?php 
                                    }
                                    ?>
                                </td>

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
<!-- Corrected Bootstrap and other JS includes -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        const reactiveModal = document.getElementById('reactiveModal');

        reactiveModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Use vanilla JS to get the triggering button
            const id = button.getAttribute('data-bs-id'); // Get the data-bs-id value
            const modalInput = reactiveModal.querySelector('#reactiveID'); // Select the input field
            modalInput.value = id; // Set the input value
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



<?php require_once('../../components/footer.php')?>
