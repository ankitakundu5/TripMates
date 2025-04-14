<?php
session_start();
require_once '../Backend/connect_db.php';

// Redirect to login if not logged in
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
$stmt = $conn->prepare("SELECT name, age, email, phone, gender FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./styles/profile.css">
</head>
<body id="profile">
  <div id="header-container"></div>
  <script>
    fetch('header.php')
      .then(res => res.text())
      .then(data => {
        document.getElementById('header-container').innerHTML = data;
      });
  </script>

  <div class="container">
    <div class="card">
        <div class="card-header">DETAILS</div>
        <div class="text-end p-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <div class="profile-section">
            <div class="profile-details">
                <div class="detail-row"><div class="detail-label">Name:</div><div class="detail-value"><?= htmlspecialchars($user['name']) ?></div></div>
                <div class="detail-row"><div class="detail-label">Age:</div><div class="detail-value"><?= htmlspecialchars($user['age']) ?></div></div>
                <div class="detail-row"><div class="detail-label">Email:</div><div class="detail-value"><?= htmlspecialchars($user['email']) ?></div></div>
                <div class="detail-row"><div class="detail-label">Phone No:</div><div class="detail-value"><?= htmlspecialchars($user['phone']) ?></div></div>
                <div class="detail-row"><div class="detail-label">Gender:</div><div class="detail-value"><?= htmlspecialchars($user['gender']) ?></div></div>
                <a href="edit_profile.php" class="btn btn-edit">EDIT</a>
            </div>
            <div class="profile-avatar">
                <svg width="60" height="60" viewBox="0 0 60 60">
                    <path d="M30 0C13.432 0 0 13.432 0 30s13.432 30 30 30 30-13.432 30-30S46.568 0 30 0zm0 10c5.523 0 10 4.477 10 10s-4.477 10-10 10-10-4.477-10-10 4.477-10 10-10zm0 44c-8.284 0-15.623-4.152-20-10.476 0.065-6.629 13.335-10.276 20-10.276s19.935 3.647 20 10.276C45.623 49.848 38.284 54 30 54z" fill="#664433"/>
                    <rect x="22" y="28" width="16" height="6" fill="#b98b56"/>
                </svg>
            </div>
        </div>
    </div>

 
    <div class="card">
        <div class="card-header">BOOKINGS</div>
         <?php     
   

      $user_id = $_SESSION['user_id'];

      $bookings = mysqli_query($conn, "
          SELECT b.booking_id, p.name AS package_name,p.destination AS destination, p.imageUrl AS url, b.status 
          FROM bookings b
          JOIN packages p ON b.package_id = p.package_id
          WHERE b.user_id = $user_id
      ");
      ?>

   

                           
       

        <?php
        if (mysqli_num_rows($bookings) > 0) {
            while ($row = mysqli_fetch_assoc($bookings)) {
        ?>
            <div class="booking-card">
                <div class="booking-image">
                    <img src=<?php echo $row['url']; ?> alt="Beach">
                </div>
                <div class="booking-details">
                    <div class="booking-title"><?php echo $row['package_name']; ?></div>
                    <div class="booking-location"><?php echo $row['destination']; ?></div> 
                    <div class="booking-message">
                        <?php 
                            if ($row['status'] == 'booked') {
                                echo "Your booking is confirmed! Pack your bags!";
                            } else {
                                echo "Pay now to confirm you slot!";
                            }
                        ?>
                    </div>
                    <div class="booking-actions">
                        <button class="btn btn-booking btn-booking-<?php echo ($row['status'] == 'booked') ? 'green' :'yellow'; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </button>

                        <?php if ($row['status'] == 'pending') { ?>
                          <form action="payment.php" method="POST" style="display:inline;">
                            <?php echo htmlspecialchars($row['booking_id']);?>
                              <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($row['booking_id']); ?>">
                              <button type="submit" class="btn btn-booking btn-booking-green">PAY</button>
                          </form>
                        <?php }else{
                            echo "<button class='btn btn-booking btn-booking-green'>VIEW ITINERARY</button>";

                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p style='text-align:center; font-weight:bold; margin-top: 20px;'>No bookings found.</p>";
        }
        ?>

            </div>

    <button class="btn btn-explore">Explore</button>
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
