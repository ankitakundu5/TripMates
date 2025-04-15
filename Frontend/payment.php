<?php
require_once '../Backend/connect_db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - TripMates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./styles/payment.css">
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $raw_id = $_POST['booking_id'];
    $id = intval($raw_id);
    $persons = 1;

    $bookingSql = "SELECT * FROM bookings WHERE booking_id = $id";
    $bookingResult = $conn->query($bookingSql);

    if ($bookingResult && $bookingResult->num_rows > 0) {
        $booking = $bookingResult->fetch_assoc();
        $package_id = $booking['package_id'];

        $sql = "SELECT * FROM packages WHERE package_id = $package_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $price_per_person = $row['price'];
            $equipment_rental = 500;
            $taxes = 549;

            $package_total = $price_per_person * $persons;
            $grand_total = $package_total + $equipment_rental + $taxes;
?>

<div class="container">
    <div class="payment-container">
        <div class="payment-form">
            <h2 class="section-title">Payment Details</h2>

            <div class="payment-methods">
                <div class="payment-method active"><i class="far fa-credit-card"></i><p>Credit Card</p></div>
                <div class="payment-method"><i class="fab fa-paypal"></i><p>PayPal</p></div>
                <div class="payment-method"><i class="fas fa-university"></i><p>Bank Transfer</p></div>
            </div>

            <div class="card-icons">
                <div class="card-icon"><i class="fab fa-cc-visa"></i></div>
                <div class="card-icon"><i class="fab fa-cc-mastercard"></i></div>
                <div class="card-icon"><i class="fab fa-cc-amex"></i></div>
                <div class="card-icon"><i class="fab fa-cc-discover"></i></div>
            </div>

            <!-- Card Input Form (Not submitted) -->
            <div class="form">
                <div class="form-group">
                    <label for="card-name">Name on Card</label>
                    <input type="text" id="card-name" placeholder="John Doe">
                </div>

                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" placeholder="1234 5678 9012 3456">
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="expiry">Expiry Date</label>
                        <input type="text" id="expiry" placeholder="MM/YY">
                    </div>

                    <div class="form-group half-width">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" placeholder="123">
                    </div>
                </div>

                <h2 class="section-title">Billing Information</h2>

                <div class="form-group">
                    <label for="billing-name">Full Name</label>
                    <input type="text" id="billing-name" placeholder="John Doe">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="john.doe@example.com">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" placeholder="+1 (123) 456-7890">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" placeholder="123 Main St">
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="city">City</label>
                        <input type="text" id="city" placeholder="New York">
                    </div>

                    <div class="form-group half-width">
                        <label for="zip">Zip/Postal Code</label>
                        <input type="text" id="zip" placeholder="10001">
                    </div>
                </div>
            </div>

            <!-- PAY NOW Form -->
            <form action="booked.php" method="POST" style="display:inline;">
                <input type="hidden" name="booking_id" value="<?php echo $id; ?>">
                <button type="submit" class="btn pay">PAY NOW</button>
            </form>
        </div>

        <!-- Trip Summary -->
        <div class="order-summary">
            <h2 class="section-title">Trip Summary</h2>

            <div class="package-info">
                <img src="<?php echo htmlspecialchars($row['imageUrl']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="package-image">
                <div class="package-details">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo $persons; ?> Person<?php echo ($persons > 1 ? 's' : ''); ?></p>
                    <p>Date: <?php echo date("d F Y", strtotime($row['start_date'])); ?></p>
                </div>
            </div>

            <div class="total-row">
                <span>Package Price (<?php echo $persons; ?> × ₹<?php echo $price_per_person; ?>)</span>
                <span>₹<?php echo number_format($package_total); ?></span>
            </div>
        </div>
    </div>
</div>

<?php
        } else {
            echo "<p>No package found with this ID.</p>";
        }
    } else {
        echo "<p>Invalid booking ID.</p>";
    }
} else {
    echo "<p>No ID provided.</p>";
}
?>

<!-- Footer -->
<div id="footer-container"></div>
<script>
  fetch('footer.html')
    .then(res => res.text())
    .then(data => {
      document.getElementById('footer-container').innerHTML = data;
    });

  const paymentMethods = document.querySelectorAll('.payment-method');
  paymentMethods.forEach(method => {
      method.addEventListener('click', () => {
          paymentMethods.forEach(m => m.classList.remove('active'));
          method.classList.add('active');
      });
  });
</script>
</body>
</html>
