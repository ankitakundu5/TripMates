
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripMates</title>
    
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap JS (with Popper) -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="./styles/home.css">
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

    <section class="services">
        <h2>TripMates Holidays</h2>
        <div class="service-grid">
            <div class="service-item">
                <img src="assets/icons8-island-100.png" alt="Beach" style="width:100px;"><br>Beach Trips
            </div>
            <div class="service-item">
                <img src="assets/icons8-mountain-96.png" alt="Mountains" style="width:100;"><br>Mountain Treks
            </div>
            <div class="service-item">
                <img src="assets/icons8-city-96.png" alt="City Tour" style="width:100px;"><br>City Tours
            </div>
            <div class="service-item">
                <img src="assets/icons8-adventure-96.png" alt="Adventure" style="width:100px;"><br>Adventure Sports
            </div>
          
        </div>
    </section>

      
       <div class="  ">
        <h3><strong>Our Best Packages</strong></h3>
        <div id="pack">
        <?php
        
        require_once '../Backend/connect_db.php';
        
        $sql = "SELECT * FROM packages";
        $result = $conn->query($sql);
  
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              
                echo '
                <div class="">
                    <div class="position-relative package-card">
                        <span class="badge-top">'.htmlspecialchars($row['activities']).'</span>
                        <img src="'.htmlspecialchars($row['imageUrl']).'" alt="'.htmlspecialchars($row['name']).'" style="width:100%; height:200px; object-fit:cover;">
                        <div class="package-card-content">
                            <div class="card-location">'.htmlspecialchars($row['destination']).'</div>
                            <div class="card-title">'.htmlspecialchars($row['name']).'</div>
                        </div>
                    </div>
                </div>';


            }
        } else {
            echo "No packages found.";
        }
        
  ?>
  </div>
  
        <div class="row g-10" id="card-container">
      
        </div>
      </div>

        <div class="container-fluid bg-pink py-5">
            <div class="container">
                <div class="title-container">
                    <h2 class="mb-3">Why start with <span class="brand-text">TripMates</span>?</h2>
                    <p class="subtitle mb-5">It’s not just about sightseeing. With us, you can choose from yoga retreats, diving adventures, hiking trails, cultural tours, and so much more. We tailor your journey around what you love most.</p>
                </div>
                
                <div class="row">
              
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="circle-img">
                                <img src="./assets/beach.jpg" alt="Underwater diving scene">
                            </div>
                            <h3>Exclusive activities</h3>
                            <p class="feature-text">Authentic experiences, safety, reliability, and deep respect for local traditions—this is what you can expect from our travel destinations and curated adventures</p>
                        </div>
                    </div>
              
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="circle-img">
                                <img src="./assets/beach.jpg" alt="Orange van on beach">
                            </div>
                            <h3>Destinations</h3>
                            <p class="feature-text">Local guides and experts will lead you to the best spots and hidden gems—whether it’s your first time exploring or you’re a seasoned traveler.</p>
                        </div>
                    </div>
                    
                  
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="circle-img">
                                <img src="./assets/beach.jpg" alt="People watching sunset">
                            </div>
                            <h3>Suitable for everyone</h3>
                            <p class="feature-text">Local instructors and surfers will take you to the best waves for you. Whether you have never picked up a board or are already at an advanced level.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <section class="map">
        <h2>Choose your next destination</h2>
        <img id="india" src="./assets/india.png" alt="India Map">
    </section>
    
    
    <section class="destinations">
      <h2 class="destination-heading">All Destinations</h2>
      <div class="destination-container">
        <div class="destination-item">
          <div class="destination-card">
            <img src="assets/beach.jpg" alt="beach destination" class="destination-image">
          </div>
        </div>
        <div class="destination-item">
          <div class="destination-card">
            <img src="assets/beach.jpg" alt="beach destination" class="destination-image">
          </div>
        </div>
        <div class="destination-item">
          <div class="destination-card">
            <img src="assets/beach.jpg" alt="beach destination" class="destination-image">
          </div>
        </div>
        <div class="destination-item">
          <div class="destination-card">
            <img src="assets/beach.jpg" alt="beach destination" class="destination-image">
          </div>
        </div>
      </div>
</section>

    
    <section>
    <div class="container py-5">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h1 class="fw-bold">Opinions of those who have travelled with us</h1>
                <p class="lead text-secondary mt-3">
                    We have helped over 3000 people like you have an unforgettable surfing holiday.
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testimonial-card text-center">
                    <img src="https://tse2.mm.bing.net/th?id=OIP.W8pbMr2kaHuKEMhzf3gfNAAAAA&pid=Api&P=0&h=180" alt="Jatin Singh" class="testimonial-img">
                    <h4 class="mb-1">Jatin Singh</h4>
               
                    <div class="divider"></div>
                    <p class="mb-0">"Convenient for booking short tours with flexible cancellation, though some options are pricey."</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="testimonial-card text-center">
                    <img src="https://images.pexels.com/photos/938639/pexels-photo-938639.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Sameer" class="testimonial-img">
                    <h4 class="mb-1">Sameer</h4>
                    <div class="divider"></div>
                    <p class="mb-0">"Great for curated local tours, but last-minute availability can be an issue."</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="testimonial-card text-center">
                    <img src="https://images.pexels.com/photos/1102341/pexels-photo-1102341.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Sanskriti" class="testimonial-img">
                    <h4 class="mb-1">Sanskriti</h4>
                 
                    <div class="divider"></div>
                    <p class="mb-0">"Budget-friendly for short trips, with discounts."</p>
                </div>
            </div>
        </div>
    </div>
  </section>



    <div id="footer-container"></div>
   
    <script>
      fetch('footer.html')
        .then(res => res.text())
        .then(data => {
          document.getElementById('footer-container').innerHTML = data;
        });
     </script>
   


</body>
</html>
