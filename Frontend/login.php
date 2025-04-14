<?php
session_start();

require_once '../Backend/connect_db.php';

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = " Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT user_id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $name, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['name'] = $name;
                header("Location: profile.php"); // Redirect to user profile
                exit;
            } else {
                $errorMsg = "Incorrect password.";
            }
        } else {
            $errorMsg = " Email not registered.";
        }
        $stmt->close();
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TripMates Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .login-container {
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
    .divider {
      text-align: center;
      margin: 20px 0;
    }
    .divider::before,
    .divider::after {
      content: '';
      display: inline-block;
      width: 40%;
      height: 1px;
      background: #ccc;
      vertical-align: middle;
      margin: 0 10px;
    }
    .google-btn {
      border-radius: 8px;
      padding: 10px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f1f1f1;
    }
    .google-btn img {
      height: 20px;
      margin-right: 8px;
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
    .forgot-password {
      font-size: 0.9rem;
      float: right;
    }
    .signup-link {
      font-size: 0.9rem;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row login-container">
    
      <div class="col-md-6 d-flex flex-column justify-content-center form-section">
        <div class="mb-4 logo">TripMates</div>
        <h4 class="mb-4">LOGIN</h4>

        <?php if (!empty($errorMsg)): ?>
          <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form method="POST" action="">
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Example@email.com" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="At least 8 characters" required>
            <div class="forgot-password mt-1">
              <a href="forgot_password.php" class="text-primary">Forgot Password?</a>
            </div>
          </div>
          <button type="submit" class="btn btn-dark">Sign in</button>
        </form>

        <div class="signup-link">
          No account? <a href="signup.php" class="text-primary">Sign up</a>
        </div>

        <footer class="mt-5 text-muted text-center" style="font-size: 12px;">
          © 2025 ALL RIGHTS RESERVED
        </footer>
      </div>

  
      <div class="col-md-6 image-section p-0">
        <img src="https://img.freepik.com/premium-photo/group-friends-embarking-exciting-whitewater-rafting-adventure-realistic-thrilling-water-highquality-rafts-paddles-rapids-
        teamwork-adrenaline-excitement_1302739-27270.jpg" alt="Rafting Image">
      </div>
    </div>
  </div>
</body>
</html>
