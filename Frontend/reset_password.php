<?php
require_once '../Backend/connect_db.php';

$token = $_GET['token'] ?? ($_POST['token'] ?? '');
$error = $success = '';

if (empty($token)) {
    $error = " Invalid or missing token.";
} else {
   
    $check = $conn->prepare("SELECT user_id FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $check->bind_param("s", $token);
    $check->execute();
    $check->bind_result($user_id);
    if (!$check->fetch()) {
        $error = " Invalid or expired token.";
    }
    $check->close();


    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
        $newPassword = $_POST['password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, token_expiry=NULL WHERE user_id=?");
        $update->bind_param("si", $hashedPassword, $user_id);
        if ($update->execute()) {
            $success = " Password updated. You can now <a href='login.php'>log in</a>.";
        } else {
            $error = " Failed to update password.";
        }
        $update->close();
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <h3>Reset Your Password</h3>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if (!$success): ?>
        <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <div class="mb-3">
                <label>New Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Update Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
