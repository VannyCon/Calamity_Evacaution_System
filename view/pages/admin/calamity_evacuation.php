<?php 
   include_once('../../../controller/FacilitatorController.php');
   session_start();
if (isset($_GET['calamity_id'])) {
    $calamity_id = $_GET['calamity_id'];
    $calamity_type = $_GET['calamity_type'];
    $calamity_description = $_GET['description'];
} else {
    header('Location: report.php');
    exit(); 
}

$evacautionStatus = $facilitatorServices->getAllEvacuationByID($calamity_id);

?>
<?php require_once('../../components/header.php')?>
<div class="p-2 p-md-5">

    <div class="p-0">
        <div class="d-flex justify-content-between">
            <h3 class="text-dark">Evacaution Status Table</h3>
        </div>
        <div class="table-responsive card p-3">
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
                            
                            <tr>
                                <td><?php echo htmlspecialchars($evacaution['id']); ?></td>
                                <td><?php echo htmlspecialchars($evacaution['location_name']); ?></td>
                                <td><?php echo htmlspecialchars($evacaution['location_description']); ?></td>
                                <td><?php echo htmlspecialchars($evacaution['evacuee_count'].'/'.$evacaution['location_max_accommodate']); ?></td>
                                <td>
                                <a href="calamity_evacue_report.php?calamity_id=<?php echo $calamity_id; ?>&calamity_type=<?php echo $calamity_type; ?>&location_name=<?php echo urlencode($evacaution['location_name']); ?>&calamitytype=<?php echo urlencode($calamity_type); ?>&description=<?php echo urlencode($calamity_description); ?>" 
                                class="btn btn-info">
                                    Print Evacuees
                                </a>
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
                <h5 class="modal-title" id="updateModalLabel">Encode Data in <span id="brgy"></span> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
            
                <div class="modal-body">
                    <input type="hidden" id="statusID" name="id">
                    <input type="hidden" id="evacuationID" name="evacuation_locid" >
                    <p class="text-dark">
                       <strong>Occupied:</strong> 
                        <span id="status"></span>
                    </p>

                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select class="form-control" id="sex" name="sex" required>
                            <option value="" disabled selected>Select sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="isPwd" id="isPwd" value="1">
                        <input type="hidden" name="isPwdHidden" value="0">
                        <label class="form-check-label" for="isPwd">
                            Is PWD?
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="isSenior" id="isSenior" value="1">
                        <input type="hidden" name="isSeniorHidden" value="0">
                        <label class="form-check-label" for="isSenior">
                            Senior Citizen?
                        </label>
                    </div>



                    <!-- <div class="form-group mt-4">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="isPwd">Is PWD?</label>
                            <input type="checkbox" class="form-check-input py-2 px-2" id="isPwd" name="isPwd" value="1">
                        </div>
                    </div> -->
                </div>
                <input type="hidden" name="action" value="encodeEvacuees">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Encode</button>
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
            var locID = button.data('bs-locid');
            var brgy = button.data('bs-brgy');
            var current = button.data('bs-current');
            var max = button.data('bs-max');

            // Update the modal's content.
            var modal = $(this);
            modal.find('.modal-body #statusID').val(id);
            modal.find('.modal-body #evacuationID').val(locID);
            modal.find('#brgy').text(brgy);
            modal.find('.modal-body #status').text(current+ "/"+max); // Update the span with current value

        });

            // Target the form within the modal by its ID
        const modalForm = document.querySelector('#updateModal form');
        
        // Add a submit event listener
        modalForm.addEventListener('submit', function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Grab the checkboxes
            const isPwdCheckbox = document.getElementById('isPwd');
            const isSeniorCheckbox = document.getElementById('isSenior');

            // Log their statuses (for testing/debugging purposes)
            console.log('Is PWD Checked:', isPwdCheckbox.checked ? 1 : 0);
            console.log('Is Senior Checked:', isSeniorCheckbox.checked ? 1 : 0);

            // Update the hidden input fields
            document.querySelector('input[name="isPwd"]').value = isPwdCheckbox.checked ? 1 : 0;
            document.querySelector('input[name="isSenior"]').value = isSeniorCheckbox.checked ? 1 : 0;

            // Submit the form programmatically after setting the hidden inputs
            modalForm.submit();
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
