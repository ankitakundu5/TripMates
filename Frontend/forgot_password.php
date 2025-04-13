<?php
date_default_timezone_set('Asia/Kolkata');

require_once '../Backend/connect_db.php';

$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Generate a reset token (or a temp password)
            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime("+15 minutes"));

            // Save token to DB (assuming you have a reset_token & token_expiry column)
            $update = $conn->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
            $update->bind_param("sss", $token, $expires, $email);
            $update->execute();

            // Simulate sending email (You can integrate PHPMailer or similar)
            $resetLink = "http://localhost/TripMates-main/Frontend/reset_password.php?token=$token";
            $success = "Password reset link: <a href='$resetLink'>Click here</a>";
        } else {
            $error = "Email not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h3>Forgot Password</h3>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Enter your email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>
</body>
</html>
