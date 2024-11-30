<?php 
$title = "admin";
$part = "table";
require_once('../../../controller/EvacuationController.php');

$evacautionStatus = $evacuationService->getEvacuationStatus();

?>
<?php require_once('../../components/header.php')?>


<!-- Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Confirm Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <p><small>If you Reset all the Evacaution Center Occupied will reset and all the Evacuee will Reset also.</small></p>
                    <p>Are you sure you want to reset?</p>
                    <input type="hidden" name="action" value="resetEvactionData"> <!-- Example hidden input -->
                    <input type="hidden" name="from" value="table"> <!-- Example hidden input -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="p-2 p-md-5">

    <div class="p-0">
        <h3 class="text-dark">Evacaution Status Table</h3>

        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for pest...">
        </div>

        <div class="table-responsive card p-3">
            <div class="d-flex justify-content-between">
                <h4 class="text-success">Evacuation Center</h4>
                <!-- Reset Button -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#resetModal">
                    Reset
                </button>
            </div>
            <!-- Table for nursery owners -->
            <table border="1" class="table p-3" id="pestData">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Baranggay</th>
                        <th>Description</th>
                        <th>Occupied</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($evacautionStatus)): ?>
                        <?php foreach ($evacautionStatus as $evacaution): ?>
                            <!-- table row highlight base on the current and max of the specific evacuation -->
                            
                            <tr 
                            
                            class="<?php 
                                        $percentage = 0;
                                        if ($evacaution['location_max_accommodate'] > 0) {
                                            $percentage = ($evacaution['location_current_no_of_evacuue'] / $evacaution['location_max_accommodate']) * 100;
                                        }
                                        if ($percentage <= 50) {
                                            echo 'table-success';  
                                        } elseif ($percentage <= 75) {
                                            echo 'table-info';  
                                        } elseif ($percentage <= 99) {
                                            echo 'table-warning';  
                                        } else {
                                            echo 'table-danger';  
                                        }
                                    ?>
                                    ">
                                <td><?php echo htmlspecialchars($evacaution['id']); ?></td>
                                <td><?php echo htmlspecialchars($evacaution['location_name']); ?></td>
                                <td><?php echo htmlspecialchars($evacaution['location_description']); ?></td>
                                <td><?php echo htmlspecialchars($evacaution['location_current_no_of_evacuue'].'/'.$evacaution['location_max_accommodate']); ?></td>
                                <td>
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-info mx-0 mx-md-2 my-1 my-md-0" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateModal"
                                        data-bs-id="<?php echo htmlspecialchars($evacaution['id']); ?>"
                                        data-bs-brgy="<?php echo htmlspecialchars($evacaution['location_name']); ?>"
                                        data-bs-current="<?php echo htmlspecialchars($evacaution['location_current_no_of_evacuue']); ?>"
                                        data-bs-max="<?php echo htmlspecialchars($evacaution['location_max_accommodate']); ?>">
                                        Update
                                    </button>
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

<!-- Modal for Updating Pest Info -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Status of <span id="brgy"></span> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="statusID" name="id">
                    <div class="form-group">
                        <label for="current">Current</label>
                        <input type="number" class="form-control" id="current" name="current" required>
                    </div>
                    <div class="form-group">
                        <label for="max">Max</label>
                        <input type="number" class="form-control" id="max" name="max" required min="1">

                    </div>
                </div>
                <input type="hidden" name="action" value="updateStatus">
                <input type="hidden" name="part" value="table">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Corrected Bootstrap and other JS includes -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
            modal.find('.modal-body #current').val(current);
            modal.find('.modal-body #max').val(max);
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
