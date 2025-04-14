<?php
require_once '../Backend/connect_db.php';

$successMsg = $errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Invalid email format.";
    } else {
      
        $check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $errorMsg = "Email already registered. Try logging in.";
        } else {
            // Hash password & insert
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            
            $stmt->bind_param("sss", $name, $email, $hashedPassword);
            if ($stmt->execute()) {
                $successMsg = "✅ Account created! You can now log in.";
                header("Location: login.php");
            } else {
                $errorMsg = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TripMates Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
    }
    .signup-container {
      min-height: 100vh;
    }
    .form-section {
      padding: 60px 40px;
    }
    .form-control {
      border-radius: 8px;
      padding: 12px;
    }
    .btn-dark {
      border-radius: 8px;
      padding: 10px;
      width: 100%;
    }
    .logo {
      font-family: 'Comic Sans MS', cursive;
      font-size: 24px;
      color: #f97316;
      font-weight: bold;
    }
    .image-section img {
      width: 100%;
      height: 100vh;
      object-fit: cover;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row signup-container">
      <!-- Left Side: Form -->
      <div class="col-md-6 d-flex flex-column justify-content-center form-section">
        <div class="mb-4 logo">TripMates</div>
        <h4 class="mb-4">SIGN UP</h4>

        <form action="signup.php" method="POST">
        <div class="mb-3">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Example@email.com" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="At least 8 characters" required>
          </div>
          <button type="submit" class="btn btn-dark">Sign up</button>
        </form>

        <footer class="mt-5 text-muted text-center" style="font-size: 12px;">
          © 2025 ALL RIGHTS RESERVED
        </footer>
      </div>

      <!-- Show Success or Error -->
      <?php if ($successMsg): ?>
      <div class="alert alert-success"><?php echo $successMsg; ?></div>
      <?php elseif ($errorMsg): ?>
      <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
      <?php endif; ?>

      <!-- Right Side: Image -->
      <div class="col-md-6 image-section p-0">
        <img src="https://images.pexels.com/photos/2526025/pexels-photo-2526025.jpeg?cs=srgb&dl=pexels-mattdvphotography-2526025.jpg&fm=jpg" alt="Camp Image">
      </div>
    </div>
  </div>
</body>
</html>
