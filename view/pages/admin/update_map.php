<?php
$title = 'Update';
if (isset($_GET['locID'])) {
    $locID = $_GET['locID'];
    $locName = $_GET['locName'];
    $description = $_GET['description'];
    $facilitator_id = $_GET['facilitator_id'];
} else {
    header("Location: map.php");
    exit();
}
require_once('../../../controller/FacilitatorController.php');
//Get here
$activeFacilitator = $facilitatorServices->getAllFacilitator();
require_once('../../../controller/EvacuationController.php');

require_once('../../components/header.php');
?>

<!-- UPDATE LOCATION MODAL -->
<div class="modal fade" id="changeLocationModal" tabindex="-1" aria-labelledby="changeLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeLocationModalLabel">Confirm Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="updateForm" method="POST" action="">
                Are you sure you want to change the location?
                <div class='mb-3'>
                        <label for='location_name' class='form-label'>Baranggay</label>
                        <select class='form-select' id='location_name' name='location_name' aria-label='Location' required>
                            <option value='' disabled>Choose a Baranggay</option>
                            <?php
                            $locations = [
                                'Andres Bonifacio', 'Bato', 'Baviera', 'Bulanon', 
                                'Campo Himoga-an', 'Campo Santiago', 'Colonia Divina', 
                                'Rafaela Barrera', 'Fabrica', 'General Luna', 'Himoga-an Baybay',
                                'Lopez Jaena', 'Malubon', 'Maquiling', 'Molocaboc', 
                                'Old Sagay', 'Paraiso', 'Plaridel', 'Poblacion I (Barangay 1)', 
                                'Poblacion II (Barangay 2)', 'Puey', 'Rizal', 'Sewahon', 
                                'Taba-ao', 'Tadlong', 'Vito'
                            ];

                            foreach ($locations as $location) {
                                $selected = ($location === $locName) ? 'selected' : '';
                                echo "<option value='$location' $selected>$location</option>";
                            }
                            ?>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" value="<?php echo $description?>" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="facilitator">Facilitator</label>
                            <select class='form-select' id='facilitator' name='facilitator_id' aria-label='Facilitator' required>
                                <option value="" disabled <?= empty($facilitator_id) ? 'selected' : '' ?>>Choose a Facilitator</option>
                                <?php foreach ($activeFacilitator as $facilitator): ?>
                                    <option value="<?= htmlspecialchars($facilitator['id']) ?>" 
                                        <?= $facilitator['id'] == $facilitator_id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($facilitator['facilitator_fullname']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>


            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                
                
                    <input type="hidden" name="locID" id="locID">
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">
                    <input type="hidden" name="action" value="updateLocation">
                    <button type="submit" class="btn btn-info">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="p-0 p-md-2">

    
    <h3 class="text-dark ms-3">Update Evacuation Location</h3>
    <a type="button" href="evacaution_location.php" class="btn btn-outline-danger ms-3">Back</a>
    <div id="map"></div>
    <div class="m-3">
        <p class="mb-1">
            <img src="../../../assets/images/evacuation.png" alt="" width="20"> Evacuation Center
        </p>
    </div>
</div>

<script>
    const changeLocationModal = document.getElementById('changeLocationModal');
    
    // Modal event listener for showing the selected location
    changeLocationModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-bs-locID');
        const lat = button.getAttribute('data-bs-lat');
        const lng = button.getAttribute('data-bs-lng');

        // Set values in the hidden input fields
        document.getElementById('locID').value = id;
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
    });

    // Initialize the map
    var map = L.map('map').setView([10.948713, 123.336492], 14);

    // Load OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var evacuationIcon = L.icon({
        iconUrl: '../../../assets/images/evacuation.png',
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
                var locName = location.location_name;

                // Add marker with popup
                L.marker([lat, lng], { icon: evacuationIcon }).addTo(map)
                    .bindPopup(`
                        <div>
                            <strong class="text-danger">This Location already has an Evacuation</strong><br>
                            <strong>Location:</strong> ${locName}<br>
                        </div>
                    `);
            });
        })
        .catch(error => {
            console.error('Error fetching GPS data:', error);
        });

    // Handle map click to select a new location
    map.on('click', function (e) {
        var lat = e.latlng.lat.toFixed(8);
        var lng = e.latlng.lng.toFixed(8);

        var popupContent = `
            <div>
                <p>No evacuation here!</p>
                <button type="button" class="btn btn-warning w-100" 
                    data-bs-toggle="modal" 
                    data-bs-target="#changeLocationModal"
                    data-bs-locID="<?php echo htmlspecialchars($locID); ?>"
                    data-bs-lat="${lat}"
                    data-bs-lng="${lng}">
                    Select this Location
                </button>
            </div>
        `;

        L.popup()
            .setLatLng(e.latlng)
            .setContent(popupContent)
            .openOn(map);
    });

    // Load GeoJSON layer for Sagay City boundaries
    fetch('sagay_city_geojson.php')
        .then(response => response.json())
        .then(geoData => {
            const geoJsonStyle = {
                color: 'green',
                fillColor: 'lightgreen',
                fillOpacity: 0.2,
                weight: 2
            };

            L.geoJSON(geoData, { style: geoJsonStyle }).addTo(map);
        })
        .catch(error => {
            console.error('Error fetching GeoJSON data:', error);
        });
</script>

<?php require_once('../../components/footer.php'); ?>
