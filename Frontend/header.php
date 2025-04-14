<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$current_page = basename($_SERVER['PHP_SELF']);

$base_url = "http://localhost/TripMates/Frontend/";

$header_config = [
    'index.php' => [
        'height' => 'hero-height-full',
        'search_text' => 'Find your escape',
        'show_search_bar' => true
    ],
    'packages.php' => [
        'height' => 'hero-height-small',
        'page_description' => 'Discover our curated travel packages',
        'show_search_bar' => false
    ],
    'search.php' => [
        'height' => 'hero-height-small',
        'page_description' => 'Find your perfect destination',
        'show_search_bar' => false
    ],
    'contact.php' => [
        'height' => 'hero-height-small',
        'page_description' => 'Get in touch with our team',
        'show_search_bar' => false
    ],
    'profile.php' => [
        'height' => 'hero-height-small',
        'page_description' => 'Manage your account and bookings',
        'show_search_bar' => false
    ],
    'payment.php' => [
        'height' => 'hero-height-small',
        'page_description' => 'Manage your account and bookings',
        'show_search_bar' => false
    ]
];

if (!isset($header_config[$current_page])) {
    $header_config[$current_page] = [
        'height' => 'hero-height-small',
        'page_description' => 'Explore TripMates',
        'show_search_bar' => false
    ];
}

$current_config = $header_config[$current_page];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripMates</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/header.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Kavoon&display=swap');
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
        
        .dropdown-menu {
            min-width: 200px;
        }
        
        .profile-dropdown .dropdown-item i {
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }
        
        .hero-height-full {
            min-height: 500px;
        }
        
        .hero-height-small {
            height: 300px; 
        }
        
    
        .btn-orange {
            background-color: #FF7A00;
            color: white;
            border: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        
        .btn-orange:hover {
            background-color: #e06e00;
            color: white;
        }
        
  
        .page-description {
            color: white;
            text-align: center;
            margin-top: auto;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            font-family: 'Kavoon', cursive;

        }
        
               .search-bar {
            margin: auto auto 2rem auto;
            width: 80%;
            max-width: 800px;
            padding: 0.75rem;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body>
    <header class="hero-section d-flex flex-column <?php echo $current_config['height']; ?>">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent px-4 pt-3">
            <div class="container-fluid">
                <a class="navbar-brand text-white fw-bold" href="<?php echo $base_url; ?>index.php">
                    <img class="ml-0" src="<?php echo $base_url; ?>assets/logo.png" alt="TripMates Logo" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav mb-2 mb-lg-0 gap-4">
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" 
                               href="<?php echo $base_url; ?>home.php"><i class="bi bi-house-door me-2"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo ($current_page == 'packages.php') ? 'active' : ''; ?>" 
                               href="<?php echo $base_url; ?>profile.php"><i class="bi bi-box-seam me-2"></i> Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo ($current_page == 'search.php') ? 'active' : ''; ?>" 
                               href="<?php echo $base_url; ?>search.php"><i class="bi bi-search me-2"></i> Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" 
                               href="<?php echo $base_url; ?>contact.php"><i class="bi bi-telephone me-2"></i> Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex">
                    <?php if(isset($_SESSION['user_id'])): ?>
                   
                        <div class="dropdown profile-dropdown">
                            <img src="<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : $base_url . 'https://static.vecteezy.com/system/resources/previews/005/544/718/non_2x/profile-icon-design-free-vector.jpg'; ?>" 
                                 class="profile-image dropdown-toggle" 
                                 id="profileDropdown" 
                                
                                 alt="Profile Picture">
                            
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><h6 class="dropdown-header">Welcome, <?php echo $_SESSION['username'] ?? 'User'; ?></h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>profile.php"><i class="bi bi-person"></i> My Profile</a></li>
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>bookings.php"><i class="bi bi-calendar-check"></i> My Bookings</a></li>
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo $base_url; ?>logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
  
                        <a href="<?php echo $base_url; ?>signup.php" class="btn btn-orange">Signup / Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <?php if ($current_config['show_search_bar']): ?>

        <div class="search-bar d-flex align-items-center gap-2">
            <input type="text" class="form-control flex-grow-1 search-input" placeholder="<?php echo $current_config['search_text']; ?>">
            <button class="btn btn-orange search-button">Search</button>
        </div>
        <?php else: ?>

        <div class="page-description container">
            <h2><?php echo $current_config['page_description']; ?></h2>
        </div>
        <?php endif; ?>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>