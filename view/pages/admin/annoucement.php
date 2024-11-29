<?php 
$title = "admin";
$part = "announcement";
require_once('../../../controller/AnnouncementController.php');
$activeAnnouncement = $announcementServices->getActiveAnnouncement();
?>
<?php require_once('../../components/header.php')?>


<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this announcement? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    <input type="hidden" name="announcementID" id="deleteannouncementID">
                    <input type="hidden" name="action" value="deleteAnnouncement">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="p-0 p-md-5">

    <div class="p-4">
        <h3 class="text-dark">Announcement</h3>

        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search for Announcement...">
        </div>
        <button type="button" class="btn btn-success mx-0 my-md-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#announcementModal"
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($activeAnnouncement)): ?>
                        <?php foreach ($activeAnnouncement  as $announcement): ?>
                            <!-- table row highlight base on the current and max of the specific evacuation -->
                            
                            <tr>
                                <td><?php
                                    $date = new DateTime($announcement['announcement_date']);
                                    echo $date->format('F j, Y')?>
                                </td>
                                <td><?php
                                    $time = new DateTime($announcement['announcement_time']);
                                    echo $time->format('g:i A')?>
                                </td>
                                <td><?php echo htmlspecialchars($announcement['announcement_title']); ?></td>
                                <td><?php echo htmlspecialchars($announcement['announcement_description']); ?></td>
                               
                                <td><button type="button" class="btn btn-info mx-0 mx-md-2 my-1 my-md-0" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#announcementModal"
                                        data-bs-id="<?php echo htmlspecialchars($announcement['id']); ?>"
                                        data-bs-date="<?php echo htmlspecialchars($announcement['announcement_date']); ?>"
                                        data-bs-time="<?php echo htmlspecialchars($announcement['announcement_time']); ?>"
                                        data-bs-title="<?php echo htmlspecialchars($announcement['announcement_title']); ?>"
                                        data-bs-description="<?php echo htmlspecialchars($announcement['announcement_description']); ?>"
                                        data-bs-action="update">
                                        Update
                                </button><button type="button" class="btn btn-danger mx-0 mx-md-2 my-1 my-md-0" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal"
                                        data-bs-id="<?php echo htmlspecialchars($announcement['id']); ?>">
                                        Delete
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
<div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel"><span id="modalTypeTitle"></span> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id" name="announcementID">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                        <label for="time">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                        <label for="title">Title</label>
                        <input type="title" class="form-control" id="title" name="title" required>
                        <label for="description">Description</label>
                        <input type="description" class="form-control" id="description" name="description" required>
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('bs-id'); // Extract info from data-* attributes
                const modalInput = deleteModal.querySelector('#deleteannouncementID');
                modalInput.value = id; // Set the value of the hidden input
            });
        });

    $(document).ready(function() {
        // Modal functionality
        $('#announcementModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var action = button.data('bs-action'); // Get the action value
            var modal = $(this); // Current modal instance

            if (action === 'create') {
                modal.find('#modalTypeTitle').text('Create');
                modal.find('#actionType').val("createAnnouncement");
                modal.find('.modal-body input').val(''); 
            } else if (action === 'update') {
                var id = button.data('bs-id');
                var date = button.data('bs-date');
                var time = button.data('bs-time');
                var title = button.data('bs-title');
                var description = button.data('bs-description');

                modal.find('#modalTypeTitle').text('Update');
                modal.find('#id').val(id);
                modal.find('#date').val(date);
                modal.find('#time').val(time);
                modal.find('#title').val(title);
                modal.find('#description').val(description);
                modal.find('#actionType').val("updateAnnouncement");
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
