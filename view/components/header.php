<?php 
    include_once('../../../controller/LogoutController.php');
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
    <style>

/* Hide sidebar on mobile */
@media (max-width: 767.98px) {
    .sidebar {
        display: none !important;
        position: static !important;
        width: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .home {
        left: 0 !important;
        width: 100% !important;
        padding-top: 60px;
        /* Space for mobile navbar */
    }
}

/* Show sidebar on desktop */
@media (min-width: 768px) {
    .navbar {
        display: none !important;
    }
}
.mobile-nav-bg {
    background-color: #8fd691;

}

    </style>    
    <?php if (isset($_SESSION['username']) && $part != "User") {?>
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
                                    <li class='nav-link  <?php echo $part == 'dashboard' ? 'active' : ''; ?>'>
                                        <a href='index.php'>
                                            <i class='bx bx-home-alt icon'></i>
                                            <span class='text nav-text'>Dashboard</span>
                                        </a>
                                    </li>

                                    <li class='nav-link <?php echo $part == 'calamity' ? 'active' : ''; ?>'>
                                        <a href='calamity.php'>
                                            <i class='bx bx-grid-alt icon'></i>
                                            <span class='text nav-text'>Calamity</span>
                                        </a>
                                    </li>

                                    <li class='nav-link <?php echo $part == 'map' ? 'active' : ''; ?>'>
                                        <a href='map.php'>
                                            <i class='bx bx-map-alt icon'></i>
                                            <span class='text nav-text'>Map</span>
                                        </a>
                                    </li>



                                    <li class='nav-link <?php echo $part == 'table' ? 'active' : ''; ?>'>
                                        <a href='table.php'>
                                            <i class='bx bx-table icon'></i>
                                            <span class='text nav-text'>Table</span>
                                        </a>
                                    </li>

                                    <li class='nav-link <?php echo $part == 'announcement' ? 'active' : ''; ?>'>
                                        <a href='annoucement.php'>
                                            <i class='bx bx-microphone icon'></i>
                                            <span class='text nav-text'>Annoucement</span>
                                        </a>
                                    </li>
                                    <li class='nav-link <?php echo $part == 'facilitator' ? 'active' : ''; ?>'>
                                        <a href='facilitator.php'>
                                            <i class='bx bx-user-check icon'></i>
                                            <span class='text nav-text'>Facilitator</span>
                                        </a>
                                    </li>
                                    <li class='nav-link <?php echo $part == 'evacuation' ? 'active' : ''; ?>'>
                                        <a href='evacaution_location.php'>
                                            <i class='bx bx-map-pin icon'></i>
                                            <span class='text nav-text'>Evacaution Center</span>
                                        </a>
                                    </li>

                                    <li class='nav-link <?php echo $part == 'history' ? 'active' : ''; ?>'>
                                        <a href='history.php'>
                                            <i class='bx bx-history icon'></i>
                                            <span class='text nav-text'>History</span>
                                        </a>
                                    </li>
                                      <li class='nav-link <?php echo $part == 'report' ? 'active' : ''; ?>'>
                                        <a href='report.php'>
                                            <i class='bx bx-book-content  icon'></i>
                                            <span class='text nav-text'>Report</span>
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


                    
                <nav class='navbar navbar-expand-md d-md-none fixed-top mobile-nav-bg'>
                    <div class='container-fluid'>
                        <a class='navbar-brand' href='#'>
                            <img src='../../../assets/images/logo.png' alt='' width='50' height='50'>
                        </a>
                        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#mobileNav' 
                                aria-controls='mobileNav' aria-expanded='false' aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        
                        <div class='collapse navbar-collapse bg-light p-2 rounded' id='mobileNav'>
                            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'dashboard' ? 'active' : ''; ?>' href='index.php'>
                                        <i class='bx bx-home-alt'></i> Dashboard
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'calamity' ? 'active' : ''; ?>' href='calamity.php'>
                                        <i class='bx bx-grid-alt'></i> Calamity
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'map' ? 'active' : ''; ?>' href='map.php'>
                                        <i class='bx bx-map-alt'></i> Map
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'table' ? 'active' : ''; ?>' href='table.php'>
                                        <i class='bx bx-table'></i> Table
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'announcement' ? 'active' : ''; ?>' href='annoucement.php'>
                                        <i class='bx bx-microphone'></i> Announcement
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'evacuation' ? 'active' : ''; ?>' href='evacaution_location.php'>
                                        <i class='bx bx-map-pin'></i> Evacaution Center
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'history' ? 'active' : ''; ?>' href='history.php'>
                                        <i class='bx bx-history'></i> History
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link <?php echo $part == 'report' ? 'active' : ''; ?>' href='report.php'>
                                        <i class='bx bx-book-content'></i> Report
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <form action='' method='post'>
                                        <input type='hidden' name='action' value='logout'>
                                        <button type='submit' class='nav-link text-danger border-0 bg-transparent'>
                                            <i class='bx bx-log-out'></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
    <?php }?>        
                

   <section class="home mb-3 p-1 p-lg-4 pt-5 pt-md-0 mt-5 mt-lg-0">
