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
    </style>
</head>
<body>
    <?php
    // Start the session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <header class="hero-section d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent px-4 pt-3">
            <div class="container-fluid">
                <a class="navbar-brand text-white fw-bold" href="#">
                    <img class="ml-0" src="assets/logo.png" alt="TripMates Logo" style="height: 50px;">
                </a>
                <div class="collapse navbar-collapse justify-content-center">
                    <ul class="navbar-nav mb-2 mb-lg-0 gap-4">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="bi bi-house-door me-2"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="bi bi-box-seam me-2"></i> Packages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="bi bi-search me-2"></i> Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="bi bi-telephone me-2"></i> Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex">
                    <?php if(isset($_SESSION['user_id'])): ?>

                        <a href="profile.php" class="dropdown profile-dropdown">
                            <img src="<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'https://static.vecteezy.com/system/resources/previews/020/765/399/original/default-profile-account-unknown-icon-black-silhouette-free-vector.jpg'; ?>" 
                             
                            class="profile-image dropdown-toggle" 
                            id="profileDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                            alt="Profile Picture">
                             
                           
                      
                    </a>
                    <?php else: ?>
                    
                        <a href="signup.php" class="btn btn-orange">Signup / Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <div class="search-bar d-flex align-items-center gap-2">
            <input type="text" class="form-control flex-grow-1 search-input" placeholder="Find your escape">
            <button class="btn btn-orange search-button">Search</button>
        </div>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 