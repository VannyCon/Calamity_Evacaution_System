<?php
$title = "User";
require_once('../../../controller/UserController.php');

$activeCalamities = $calamity->getActiveCalamity();
$activeAnnouncement = $announcement->getActiveAnnouncement();
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
        #map { height: 500px; width: 98%; margin: 10px}
    </style>
</head>
<body class="px-1 px-md-5">
    <h3 class="ms-2 mt-3"><strong>Evacuation Status Map</strong></h3>
    <div id="map" style="height: 450px;"></div>
    <div class="p-2">
        <button id="showNearestBtn" class="btn btn-primary mb-3 w-100 w-md-50">Show Nearest Evacuation Center</button>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-success">
                        <p class="card-title p-0 text-white"><strong>Evacuation Status</strong></p>
                    </div>
                    <div class="card-body">
                        <div class="m-2">
                            <p class="mb-1"><img src="../../../assets/images/green.png" alt="" width="20">Green 25% Full</p>
                            <p class="mb-1"><img src="../../../assets/images/blue.png" alt="" width="20">Blue 50% Full</p>
                            <p class="mb-1"><img src="../../../assets/images/yellow.png" alt="" width="20">Yellow 75% Full</p>
                            <p class="mb-1"><img src="../../../assets/images/red.png" alt="" width="20">Red 100%</p>
                            <p class="mb-1"><img src="../../../assets/images/mylocation.png" alt="" width="20">Your Location</p>
                        </div>
                    </div>
                </div>
                <br>

                <div class="card ">
                    <div class="card-header p-0 px-3 py-2 bg-success">
                        <p class="card-title p-0 text-white"><strong>Active Calamity</strong></p>
                    </div>
                    <div class="card-body">

                            <?php if (!empty($activeCalamities)): ?>
                                <?php foreach ($activeCalamities as $activeCalamity): ?>
                                    <div class="card">
                                        <div class="card-header bg-danger">
                                            <p class="card-title p-0 text-white"><strong></strong><?php
                                            $date = new DateTime($activeCalamity['calamity_date']);
                                            $time = new DateTime($activeCalamity['calamity_time']);
                                            echo $date->format('F j, Y').' '.$time->format('g:i A')?></p>
                                        </div>
                                        <div class="card-body">
                                            <p class="m-0"><strong>Type Of Calamity: </strong><?php echo $activeCalamity['type_calamity_type']?></p>
                                            <p class="m-0"><strong>Description: </strong><?php echo $activeCalamity['calamity_description']?></p>
                                            <p class="m-0"><strong>Calamity Information: </strong><?php echo $activeCalamity['type_calamity_description']?></p>
                                            <p class="m-0"><strong>Level: </strong><?php echo $activeCalamity['status_level']?></p>
                                            <p class="m-0"><strong>Level Color: </strong><?php echo $activeCalamity['status_color']?></p>
                                            <p class="m-0"><strong>Level Description: </strong><?php echo $activeCalamity['status_description']?></p>
                                            <!-- <button class="btn btn-outline-danger my-2">Things Need to Do</button> -->
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <?php endforeach; ?>
                                <?php else: ?>
                                        <p>There's no Active Calamity</p>
                            <?php endif; ?>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header p-0 px-3 py-2 bg-success">
                        <p class="card-title p-0 text-white"><strong>Announcement</strong></p>
                    </div>
                    <div class="card-body">

                            <?php if (!empty($activeAnnouncement)): ?>
                                <?php foreach ($activeAnnouncement as $announcement): ?>
                                    <div class="card">
                                        <div class="card-header bg-secondary">
                                            <p class="card-title p-0 text-white"><strong></strong><?php
                                            $date = new DateTime($announcement['announcement_date']);
                                            $time = new DateTime($announcement['announcement_time']);
                                            echo $date->format('F j, Y').' '.$time->format('g:i A')?></p>
                                        </div>
                                        <div class="card-body">
                                            <p class="m-0"><strong>Title: </strong><?php echo $announcement['announcement_title']?></p>
                                            <p class="m-0"><strong>Description: </strong><?php echo $announcement['announcement_description']?></p>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <?php endforeach; ?>
                                <?php else: ?>
                                        <p>There's no Active Calamity</p>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

  

    <script>
    // ... (your JavaScript code here)
    
    // Add this at the end of your script
    document.getElementById('showNearestBtn').addEventListener('click', showNearestEvacuationCenter);
    </script>

<?php require_once('../../components/footer.php')?>

    <script>
    // Initialize map
var map = L.map('map').setView([10.86688963, 123.39300603], 15);

// Load OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

const icons = {
    green: '../../../assets/images/green.png',
    blue: '../../../assets/images/blue.png',
    yellow: '../../../assets/images/yellow.png',
    red: '../../../assets/images/red.png',
    user: '../../../assets/images/mylocation.png'
};

function createIcon(url) {
    return L.icon({
        iconUrl: url,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });
}

const greenIcon = createIcon(icons.green);
const blueIcon = createIcon(icons.blue);
const yellowIcon = createIcon(icons.yellow);
const redIcon = createIcon(icons.red);
const userIcon = createIcon(icons.user);

let evacuationCenters = [];
let userMarker, nearestMarker, routeLayer;

// Load evacuation center data from the server
async function loadEvacuationCenters() {
    try {
        const response = await fetch('evacuation_json.php');
        const data = await response.json();
        evacuationCenters = data.map(location => {
            const lat = parseFloat(location.location_latitude);
            const lng = parseFloat(location.location_longhitude);
            const percentage = (location.location_current_no_of_evacuue / location.location_max_accommodate) * 100;
            const current = parseFloat(location.location_current_no_of_evacuue);
            const max = parseFloat(location.location_max_accommodate);

            const icon = percentage <= 50 ? greenIcon :
                         percentage <= 75 ? blueIcon :
                         percentage <= 99 ? yellowIcon :
                         redIcon;

            const marker = L.marker([lat, lng], { icon }).addTo(map)
                .bindPopup(`<strong>${location.location_name}</strong><br><strong>${location.location_description}</strong><br>Evacuees: ${location.location_current_no_of_evacuue}/${location.location_max_accommodate}`);

            return { lat, lng, name: location.location_name, icon, percentage, current, max, marker };
        });
        console.log('Evacuation centers loaded:', evacuationCenters.length);
    } catch (error) {
        console.error('Error fetching evacuation centers:', error);
    }
}

// Get user's location and calculate nearest evacuation center
async function getUserLocationAndRoute() {
    if (!navigator.geolocation) {
        console.error('Geolocation not supported');
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            if (userMarker) {
                map.removeLayer(userMarker);
            }

            userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map)
                .bindPopup('<strong>Your Location</strong>').openPopup();
            map.setView([userLat, userLng], 14);

            console.log('User location set:', userLat, userLng);
        },
        (error) => {
            console.error('Error getting location:', error);
        }
    );
}

function showNearestEvacuationCenter() {
    console.log('showNearestEvacuationCenter called');
    if (!userMarker) {
        alert("Please wait for your location to be determined.");
        return;
    }

    const userLat = userMarker.getLatLng().lat;
    const userLng = userMarker.getLatLng().lng;

    const nearest = findNearestEvacuation(userLat, userLng, evacuationCenters);
    if (nearest) {
        const distance = haversine(userLat, userLng, nearest.lat, nearest.lng).toFixed(2);

        if (nearestMarker) {
            map.removeLayer(nearestMarker);
        }
        if (routeLayer) {
            map.removeLayer(routeLayer);
        }

        nearestMarker = L.marker([nearest.lat, nearest.lng], { icon: nearest.icon }).addTo(map)
            .bindPopup(`<strong>Nearest Evacuation Center:</strong> ${nearest.name}<br>
                        <strong>Status:</strong> ${nearest.percentage}%<br>
                        <strong>Overall:</strong> ${nearest.current}/${nearest.max}<br>
                        <strong>Distance:</strong> ${distance} km`)
            .openPopup();

        drawRoute(userLat, userLng, nearest.lat, nearest.lng);
        console.log('Nearest evacuation center found:', nearest.name);
    } else {
        console.log('No nearest evacuation center found');
    }
}

// Find the nearest evacuation center using Haversine formula
function findNearestEvacuation(userLat, userLng, centers) {
    let nearestCenter = null;
    let minDistance = Infinity;

    centers.forEach(center => {
        if (center.percentage < 100) { // Skip centers that are 100% occupied
            const distance = haversine(userLat, userLng, center.lat, center.lng);
            if (distance < minDistance) {
                minDistance = distance;
                nearestCenter = center;
            }
        }
    });

    if (!nearestCenter) {
        alert("All nearby evacuation centers are fully occupied. Please try a different location.");
    }

    return nearestCenter;
}
// Haversine formula to calculate distance between two points in km
function haversine(lat1, lng1, lat2, lng2) {
    const R = 6371; // Earth's radius in km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLng = (lng2 - lng1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLng / 2) * Math.sin(dLng / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

// Draw route using OSRM routing service
async function drawRoute(userLat, userLng, destLat, destLng) {
    const routeUrl = `https://router.project-osrm.org/route/v1/driving/${userLng},${userLat};${destLng},${destLat}?overview=full&geometries=geojson`;

    try {
        const response = await fetch(routeUrl);
        const data = await response.json();
        const route = data.routes[0].geometry;
        
        if (routeLayer) {
            map.removeLayer(routeLayer);
        }
        
        routeLayer = L.geoJSON(route, {
            style: {
                color: 'limegreen',
                weight: 5,
                opacity: 1,
                dashArray: '10, 12',
                lineCap: 'round',
                lineJoin: 'round'
            }
        }).addTo(map);

        map.fitBounds([
            [userLat, userLng],
            [destLat, destLng]
        ]);
        console.log('Route drawn');
    } catch (error) {
        console.error('Error fetching route:', error);
    }
}

async function loadGeoJSON() {
    try {
        const response = await fetch('sagay_city_geojson.php');
        const geoData = await response.json();
        L.geoJSON(geoData, {
            style: { color: 'blgreenue', fillColor: 'lightgreen', fillOpacity: 0.2, weight: 2 }
        }).addTo(map);
        console.log('GeoJSON loaded');
    } catch (error) {
        console.error('Error fetching GeoJSON data:', error);
    }
}

// Initialize the map and load data
async function initializeMap() {
    await loadGeoJSON();
    await loadEvacuationCenters();
    await getUserLocationAndRoute();
    console.log('Map initialized');
}

// Wait for the DOM to be fully loaded before initializing
document.addEventListener('DOMContentLoaded', function() {
    initializeMap();
    document.getElementById('showNearestBtn').addEventListener('click', showNearestEvacuationCenter);
    console.log('Event listener added');
});
</script>

<?php require_once('../../components/footer.php')?>
