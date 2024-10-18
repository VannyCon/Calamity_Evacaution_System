<?php 
    include_once('../../../controller/LogoutController.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursery Owners</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        #map { height: 500px; width: 98%; margin: 10px}
    </style>
</head>
<body class="px-1 px-md-5">    
<?php 
    // Redirect to login if not logged in
    if (isset($_SESSION['username']) && $title != "User") {
        echo "          
                <nav class='sidebar close'>
                        <header>
                            <div class='image-text'>
                                <span class='image'>
                                    <img src='../../../assets/images/logo.png' alt=''>
                                </span>

                                <div class='text logo-text'>
                                    <span class='name'>Calamity System</span>
                                    <span class='profession'>Admin
                                    </span>
                                </div>
                            </div>

                            <i class='bx bx-chevron-right toggle'></i>
                        </header>

                        <div class='menu-bar'>
                            <div class='menu'>
                                <ul class='menu-links p-0'>
                                    <li class='nav-link'>
                                        <a href='index.php'>
                                            <i class='bx bx-home-alt icon'></i>
                                            <span class='text nav-text'>Dashboard</span>
                                        </a>
                                    </li>

                                    <li class='nav-link'>
                                        <a href='calamity.php'>
                                            <i class='bx bx-grid-alt icon'></i>
                                            <span class='text nav-text'>Calamity</span>
                                        </a>
                                    </li>

                                    <li class='nav-link'>
                                        <a href='map.php'>
                                            <i class='bx bx-map-alt icon'></i>
                                            <span class='text nav-text'>Map</span>
                                        </a>
                                    </li>



                                    <li class='nav-link'>
                                        <a href='table.php'>
                                            <i class='bx bx-table icon'></i>
                                            <span class='text nav-text'>Table</span>
                                        </a>
                                    </li>

                                    <li class='nav-link'>
                                        <a href='annoucement.php'>
                                            <i class='bx bx-microphone icon'></i>
                                            <span class='text nav-text'>Annoucement</span>
                                        </a>
                                    </li>

                                    <li class='nav-link'>
                                        <a href='evacaution_location.php'>
                                            <i class='bx bx-map-pin icon'></i>
                                            <span class='text nav-text'>Location</span>
                                        </a>
                                    </li>

                                    <li class='nav-link'>
                                        <a href='history.php'>
                                            <i class='bx bx-history icon'></i>
                                            <span class='text nav-text'>History</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class='bottom-content' class='w-100'>
                                <form action='' method='post' class='w-100'>
                                    <input type='hidden' name='action' value='logout'>
                                    <li class='w-100'>
                                        <button type='submit' class='d-flex w-100 btn-logout p-0 py-3' style='padding-left: -10px'>
                                            <i class='bx bx-log-out icon p-0 m-0' style='margin-left: -10px;'></i>
                                            <span class='text nav-text text-start' style='line-height: 1;'>Logout</span>
                                        </button>
                                    </li>
                                </form>
                            </div>
                        </div>
                    </nav>
                    
        ";
    }
?>
   <section class="home mb-3 p-4">
