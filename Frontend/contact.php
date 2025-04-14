<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contacts and Info - TripMates</title>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap JS (with Popper) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="./styles/contact.css">

</head>
<body>
   
   
    <?php include 'header.php'; ?>

  <div class="container my-5">
    <h2>Contacts and Info</h2>

    <div class="row mt-4">

      <div class="col-md-8">
        <div class="info-box mb-4" id="info-text">
          <h5><strong>Info & Tours</strong></h5>
          <p>We have been scouting destinations since 2000, continually exploring and developing the most popular ones.</p>
          <h6 class="mt-4">Site</h6>
          <p>India, Mumbai</p>
        </div>
      </div>

     
      <div class="col-md-4">
        <div class="contact-card">

          <p><strong>TripMates Travel Agency</strong></p>
          <p>Tel: +39 29 29 23 74<br>Fax: +39 087 880 00 05</p>
          <p><a href="mailto:info@tripmatesandtourists.it">info@tripmatesandtourists.it</a></p>
          <button class="btn btn-warning mt-2">Contact</button>
        </div>
      </div>
    </div>

    <img src="assets/map.png" alt="Map" class="map-img">


  </div>

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
