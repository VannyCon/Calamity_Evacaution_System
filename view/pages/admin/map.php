<?php
$title = "admin";

require_once('../../../controller/AdminController.php');
require_once('../../components/header.php')?>

<div class="p-1 p-md-2">
<h3 class="text-dark">Evacaution Status Map</h3>
    <div id="map"></div>
    <div class="m-3">
        <p class="mb-1"><img src="../../../assets/images/green.png" alt="" srcset="" width="20">Green 25% Full</p>
        <p class="mb-1"><img src="../../../assets/images/blue.png" alt="" srcset="" width="20">Blue 50% Full</p>
        <p class="mb-1"><img src="../../../assets/images/yellow.png" alt="" srcset="" width="20">Yellow 75% Full</p>
        <p class="mb-1"><img src="../../../assets/images/red.png" alt="" srcset="" width="20">Red 100%</p>
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
                            <input type="number" class="form-control" id="max" name="max" required>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="updateStatus">
                    <input type="hidden" name="part" value="map">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

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
        });
        // Initialize the map
        var map = L.map('map').setView([10.82764090,123.37795334], 12);
          // Load OpenStreetMap tiles
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        var greenIcon = L.icon({
            iconUrl: '../../../assets/images/green.png', // Your blue icon URL
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });
        // Define custom icons for different case counts
        var blueIcon = L.icon({
            iconUrl: '../../../assets/images/blue.png', // Your blue icon URL
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var yellowIcon = L.icon({
            iconUrl: '../../../assets/images/yellow.png', // Your yellow icon URL
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        var redIcon = L.icon({
            iconUrl: '../../../assets/images/red.png', // Your red icon URL
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        // Fetch GPS locations from the database
        fetch('evacuation_json.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(location => {
                    var lat = parseFloat(location.location_latitude);
                    var lng = parseFloat(location.location_longhitude);
                    var id = location.id;
                    var locID = location.location_id;
                    var locName = location.location_name;
                    var locDescription = location.location_description;
                    var current = parseInt(location.location_current_no_of_evacuue);
                    var max = parseInt(location.location_max_accommodate);  // Fixed typo

                    // Calculate the percentage of the current number of evacuees relative to the max capacity
                    var percentage = (current / max) * 100;

                    // Select the appropriate icon based on the percentage
                    var icon;
                    if (percentage <= 50) {
                        icon = greenIcon;  // 25% or less
                    } else if (percentage <= 75) {
                        icon = blueIcon;   // 26-50%
                    } else if (percentage <= 99) {
                        icon = yellowIcon; // 51-75%
                    } else {
                        icon = redIcon;    // Above 75%
                    }


                    // Add marker with popup
                    L.marker([lat, lng], { icon: icon }).addTo(map)
                        .bindPopup(`<div>
                            <strong>Location:</strong> ${locName} <br>
                            <strong>Description:</strong> ${locDescription} <br>
                            <strong>Current Evacuees:</strong> ${current}/${max} <br><br>
                            <button type="button" class="btn btn-info w-100" 
                                data-bs-toggle="modal" 
                                data-bs-target="#updateModal"
                                data-bs-id="${id}"
                                data-bs-brgy="${locName}"
                                data-bs-description="${locDescription}"
                                data-bs-current="${current}"
                                data-bs-max="${max}">
                                Update
                            </button>
                        </div>`);
                });
            })
            .catch(error => {
                console.error('Error fetching GPS data:', error);
            });




        // Function to handle confirming a location and redirecting to create.php
        function confirmLocation(lat, lng) {
            // Redirect to create.php with latitude and longitude as URL parameters
            window.location.href = `create.php?lat=${lat}&long=${lng}`;
        }


        // Add click event listener to the map

        fetch('sagay_city_geojson.php')
        .then(response => response.json())
        .then(geoData => {
            // Define a style for the GeoJSON layer
            const geoJsonStyle = {
                color: 'green', // Outline color
                fillColor: 'lightgreen', // Fill color
                fillOpacity: 0.2, // Fill opacity (0.0 to 1.0)
                weight: 2 // Outline weight
            };

            // Add the GeoJSON layer to the map with the specified style
            L.geoJSON(geoData, { style: geoJsonStyle }).addTo(map);
        })
        .catch(error => {
            console.error('Error fetching GeoJSON data:', error);
        });
    </script>

<?php require_once('../../components/footer.php')?>
