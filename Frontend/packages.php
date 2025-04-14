<?php
    session_start();
    require_once '../Backend/connect_db.php';

    //rediredts to login (no user in session)
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user = [
        'name' => '',
        'age' => '',
        'email' => '',
        'phone' => '',
        'gender' => ''
    ];

    $user_id = $_SESSION['user_id'];
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalabahal Peak Trek - TripMates</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./styles/packages.css">

   
</head>
<body>

    <div id="header-container"></div>
   
    <script>
      fetch('header.php')
        .then(res => res.text())
        .then(data => {
          document.getElementById('header-container').innerHTML = data;
        });
    </script>

    

<div class="container mt-5 mb-5">
    <div class="row">

      <div class="col-lg-8">
      <?php

require_once '../Backend/connect_db.php';

$user_id = $_SESSION['user_id']; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $sql = "SELECT * FROM packages WHERE package_id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '
        <h1 class="package-title">' . htmlspecialchars($row['name']) . '</h1>
        <p class="package-subtitle">' . htmlspecialchars($row['description']) . '</p>
        </div>

        <div class="col-lg-4">
          <div class="price-card">
            <div class="price-box-header">All Details:</div>
            <ul class="list-unstyled mt-3 mb-4">
              <li><i class="bi bi-calendar icon"></i> ' . htmlspecialchars($row['start_date']) . ' to ' . htmlspecialchars($row['end_date']) . '</li>
              <li><i class="bi bi-people icon"></i> ' . htmlspecialchars($row['totalsize']) . '</li>
              <li><i class="bi bi-person-check icon"></i> ' . htmlspecialchars($row['agegroup']) . '</li>
              <li><i class="bi bi-geo-alt icon"></i> 1,000 ft altitude</li>
            </ul>
            <h5 class="fw-bold mb-3"> ₹' . htmlspecialchars($row['price']) . '</h5>

            <form action="./book.php" method="POST">
              <input type="hidden" name="user_id" value="' . $user_id . '">
              <input type="hidden" name="package_id" value="' . htmlspecialchars($row['package_id']) . '">
              <input type="hidden" name="total_price" value="' . htmlspecialchars($row['price']) . '">
              <button class="booking-btn w-100">Book Now</button>
            </form>
          </div>
        </div>
        </div>
        </div>';
    } else {
        echo "No package with this ID.";
    }
} else {
    echo "No ID provided.";
}
?>

       
        
     
        <div class="similar-packages mr-20 p-10">
            <h2 class="section-title">More Like This</h2>
            <div class="package-cards  mr-20 p-10">
                <div class="package-card">
                    <img src="assets/beach.jpg" alt="Beach Vacation" class="package-card-image">
                    <div class="package-card-content">
                        <h3 class="package-card-title">Beach Vacation Package</h3>
                        <span class="package-card-price">₹15,999</span>
                        <a href="#" class="package-card-btn">View</a>
                    </div>
                </div>
                
                <div class="package-card">
                    <img src="assets/beach.jpg" alt="Beach Vacation" class="package-card-image">
                    <div class="package-card-content">
                        <h3 class="package-card-title">Beach Vacation Package</h3>
                        <span class="package-card-price">₹15,999</span>
                        <a href="#" class="package-card-btn">View</a>
                    </div>
                </div>
                
                <div class="package-card">
                    <img src="assets/beach.jpg" alt="Beach Vacation" class="package-card-image">
                    <div class="package-card-content">
                        <h3 class="package-card-title">Beach Vacation Package</h3>
                        <span class="package-card-price">₹15,999</span>
                        <a href="#" class="package-card-btn">View</a>
                    </div>
                </div>

                <div class="package-card">
                    <img src="assets/beach.jpg" alt="Beach Vacation" class="package-card-image">
                    <div class="package-card-content">
                        <h3 class="package-card-title">Beach Vacation Package</h3>
                        <span class="package-card-price">₹15,999</span>
                        <a href="#" class="package-card-btn">View</a>
                    </div>
                </div>

                <div class="package-card">
                    <img src="assets/beach.jpg" alt="Beach Vacation" class="package-card-image">
                    <div class="package-card-content">
                        <h3 class="package-card-title">Beach Vacation Package</h3>
                        <span class="package-card-price">₹15,999</span>
                        <a href="#" class="package-card-btn">View</a>
                    </div>
                </div>
            </div>
        </div>
        
    
    </div>
    

    <div id="footer-container"></div>
   
    <script>
      fetch('footer.html')
        .then(res => res.text())
        .then(data => {
          document.getElementById('footer-container').innerHTML = data;
        });
    </script>

   