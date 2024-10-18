<?php 

require_once('../../../controller/AdminController.php');

$activeCalamities = $adminService->getActiveCalamity();

?>
<?php require_once('../../components/header.php')?>

<div class="p-0 p-md-5">

    <div class="p-4">
        <h3 class="text-dark">Active Calamities</h3>

        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for Calamity...">
        </div>
        <button type="button" class="btn btn-success mx-0 my-md-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#calamityModal"
                                        data-bs-action="create">
                                        Create
                                    </button>
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
                    <?php if (!empty($activeCalamities)): ?>
                        <?php foreach ($activeCalamities  as $calamity): ?>
                            <!-- table row highlight base on the current and max of the specific evacuation -->
                            
                            <tr>
                                <td><?php
                                    $date = new DateTime($calamity['calamity_date']);
                                    echo $date->format('F j, Y')?>
                                </td>
                                <td><?php
                                    $time = new DateTime($calamity['calamity_time']);
                                    echo $time->format('g:i A')?>
                                </td>
                                <td><?php echo htmlspecialchars($calamity['type_calamity_type']); ?></td>
                                <td><?php echo htmlspecialchars($calamity['status_level']); ?></td>
                                <td><?php echo htmlspecialchars($calamity['status_color']); ?></td>
                                <td><button type="button" class="btn btn-info mx-0 mx-md-2 my-1 my-md-0" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#calamityModal"
                                        data-bs-id="<?php echo htmlspecialchars($calamity['id']); ?>"
                                        data-bs-calamity_date="<?php echo htmlspecialchars($calamity['calamity_date']); ?>"
                                        data-bs-calamity_time="<?php echo htmlspecialchars($calamity['calamity_time']); ?>"
                                        data-bs-type_calamity_type="<?php echo htmlspecialchars($calamity['type_calamity_id']); ?>"
                                        data-bs-status_level="<?php echo htmlspecialchars($calamity['status_id']); ?>"
                                        data-bs-calamity_active="<?php echo htmlspecialchars($calamity['calamity_active']); ?>"
                                        data-bs-action="update">
                                        Update
                                </button></td>
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
<div class="modal fade" id="calamityModal" tabindex="-1" role="dialog" aria-labelledby="calamityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calamityModalLabel"><span id="modalTypeTitle"></span> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                        <label for="time">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                        <label for="type">Type Of Calamity</label>
                        <select class="form-select" name="type" id="type" required>
                            <option value="" selected disabled>Choose a Type of Calamity</option>
                            <option value="TYPE-001">Storm</option>
                            <option value="TYPE-002">Earthquake</option>
                            <option value="TYPE-003">Flood</option>
                            <option value="TYPE-004">Landslide</option>
                            <option value="TYPE-005">Drought</option>
                        </select>
                        <label for="status">Status</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="" selected disabled>Choose a status</option>
                            <option value="Lvl-1">Level 1 Green</option>
                            <option value="Lvl-2">Level 2 YellowGreen</option>
                            <option value="Lvl-3">Level 3 Yellow</option>
                            <option value="Lvl-4">Level 4 Orange</option>
                            <option value="Lvl-5">Level 5 Red</option>
                        </select>
                        <label for="max">Active</label>
                        <div class="form-check form-switch">
                            <input style="width: 50px; height: 30px; cursor: pointer" class="form-check-input" name="active" type="checkbox" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" id="actionType">
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
        $('#calamityModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var action = button.data('bs-action'); // Get the action value
            var modal = $(this); // Current modal instance

            if (action === 'create') {
                modal.find('#modalTypeTitle').text('Create');
                modal.find('#actionType').val("createCalamity");
                modal.find('.modal-body input').val(''); 
                modal.find('#type').val("").trigger('change');
                modal.find('#status').val("").trigger('change');
                modal.find('#flexSwitchCheckChecked').prop('checked', true).prop('disabled', true).val("1");
            } else if (action === 'update') {
                var id = button.data('bs-id');
                var isActive = button.data('bs-calamity_active');
                var date = button.data('bs-calamity_date');
                var time = button.data('bs-calamity_time');
                var type = button.data('bs-type_calamity_type');
                var status = button.data('bs-status_level');

                console.log('Type:', type); 
                console.log('Status:', status);

                modal.find('#modalTypeTitle').text('Update');
                modal.find('#id').val(id);
                modal.find('#date').val(date);
                modal.find('#time').val(time);
                modal.find('#type').val(type).trigger('change'); 
                modal.find('#status').val(status).trigger('change'); 
                modal.find('#actionType').val("updateCalamity");
                modal.find('#flexSwitchCheckChecked').prop('checked', isActive).prop('disabled', false).val(isActive);
            }
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
