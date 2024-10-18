<?php

$title = "admin";
require_once('../../../controller/EvacuationController.php');
require_once('../../components/header.php');
?>


<!-- Create MODAL -->
<div class="modal fade" id="createEvacuationModal" tabindex="-1" aria-labelledby="createEvacuationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEvacuationModalLabel">Create Evacaution Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="createEvacuationForm" method="POST" action="">
                <div class='mb-3'>
                        <label for='location_name' class='form-label'>Baranggay</label>
                            <select class='form-select' id='location_name' name='location_name' aria-label='Location' required>
                                <option value='' selected disabled>Choose a Baranggay</option>
                                <option value='Andres Bonifacio'>Andres Bonifacio</option>
                                <option value='Bato'>Bato</option>
                                <option value='Baviera'>Baviera</option>
                                <option value='Bulanon'>Bulanon</option>
                                <option value='Campo Himoga-an'>Campo Himoga-an</option>
                                <option value='Campo Santiago'>Campo Santiago</option>
                                <option value='Colonia Divina'>Colonia Divina</option>
                                <option value='Rafaela Barrera'>Rafaela Barrera</option>
                                <option value='Fabrica'>Fabrica</option>
                                <option value='General Luna'>General Luna</option>
                                <option value='Himoga-an Baybay'>Himoga-an Baybay</option>
                                <option value='Lopez Jaena'>Lopez Jaena</option>
                                <option value='Malubon'>Malubon</option>
                                <option value='Maquiling'>Maquiling</option>
                                <option value='Molocaboc'>Molocaboc</option>
                                <option value='Old Sagay'>Old Sagay</option>
                                <option value='Paraiso'>Paraiso</option>
                                <option value='Plaridel'>Plaridel</option>
                                <option value='Poblacion I (Barangay 1)'>Poblacion I (Barangay 1)</option>
                                <option value='Poblacion II (Barangay 2)'>Poblacion II (Barangay 2)</option>
                                <option value='Puey'>Puey</option>
                                <option value='Rizal'>Rizal</option>
                                <option value='Sewahon'>Sewahon</option>
                                <option value='Taba-ao'>Taba-ao</option>
                                <option value='Tadlong'>Tadlong</option>
                                <option value='Vito'>Vito</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="current">Current</label>
                            <input type="number" class="form-control" id="current" name="current" required>
                        </div>
                        <div class="form-group">
                            <label for="max">Max</label>
                            <input type="number" class="form-control" id="max" name="max" required min="1">
                        </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">
                    <input type="hidden" name="action" value="createEvacuationLocation">
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- DELETE MODAL -->
<div class="modal fade" id="deleteEvacuationModal" tabindex="-1" aria-labelledby="deleteEvacuationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEvacuationModalLabel">Confirm Deleting the Evacuation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Delete this Evacaution? 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    <input type="hidden" name="locID" id="locID">
                    <input type="hidden" name="action" value="deleteEvacaution">
                    <button type="submit" class="btn btn-info">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="p-0 p-md-2">
        <h3 class="text-dark">Evacaution Location</h3>
        <div id="map"></div>
        <div class="m-3">
            <p class="mb-1"><img src="../../../assets/images/marker.png" alt="" srcset="" width="20"> Evacuation Center</p>
        </div>
</div>

    <script>

    const deleteEvacuationModal = document.getElementById('deleteEvacuationModal');
    
    // Modal event listener for showing the selected location
    deleteEvacuationModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-bs-locID');  // Check value

        // Set values in the hidden input fields
        document.getElementById('locID').value = id ;
    });



    
    const createEvacuationModal = document.getElementById('createEvacuationModal');
    
    // Modal event listener for showing the selected location
    createEvacuationModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const lat = button.getAttribute('data-bs-lat');  // Check value
        const lng = button.getAttribute('data-bs-lng');  // Check value

        // Set values in the hidden input fields
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
    });
        // Initialize the map
        var map = L.map('map').setView([10.86722679, 123.38962560], 12);
          // Load OpenStreetMap tiles
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        var evacaution = L.icon({
            iconUrl: '../../../assets/images/marker.png', // Your blue icon URL
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
                    var locID = location.location_id;
                    var locName = location.location_name;
                    var locDescription = location.location_description;
                    var current = parseInt(location.location_current_no_of_evacuue);
                    var max = parseInt(location.location_max_accommodate);  // Fixed typo

                    // Calculate the percentage of the current number of evacuees relative to the max capacity
                    var percentage = (current / max) * 100;

                    // Select the appropriate icon based on the percentage
                   
                        icon = evacaution;  // 25% or less


                    // Add marker with popup
                    L.marker([lat, lng], { icon: icon }).addTo(map)
                        .bindPopup(`<div>
                            <strong>Location:</strong> ${locName} <br>
                            <strong>Description:</strong> ${locDescription} <br>
                            <strong>Current Evacuees:</strong> ${current}/${max} <br><br>
                            <div class="d-flex">
                                <a href='update_map.php?locID=${locID}' class='btn btn-info w-100 text-white'>Change</a>
                                <button type="button" class="btn btn-danger w-100  mx-2 " 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteEvacuationModal"
                                        data-bs-locID="${locID}">
                                        Delete
                                    </button>
                            </div>
                            
                        </div>`);
                });
            })
            .catch(error => {
                console.error('Error fetching GPS data:', error);
            });


        // Function to handle confirming a location and redirecting to create.php
        function confirmLocation(lat, lng) {
            // Redirect to create.php with latitude and longitude as URL parameters
            window.location.href = `update.php?incidentID=`;
        }


        // Add click event listener to the map
        map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(8);
        const lng = e.latlng.lng.toFixed(8);

        const popupContent = `
            <div>
                <p>Don't have Evacuation Center Here!</p>
                <button type="button" class="btn btn-warning w-100" 
                    data-bs-toggle="modal" 
                    data-bs-target="#createEvacuationModal"
                    data-bs-lat="${lat}"
                    data-bs-lng="${lng}">
                    Add
                </button>
            </div>
        `;
        L.popup()
            .setLatLng(e.latlng)
            .setContent(popupContent)
            .openOn(map);
    });




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
