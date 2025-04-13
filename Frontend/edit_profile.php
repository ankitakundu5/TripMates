<?php
session_start();
require_once '../Backend/connect_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = $error = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $age = trim($_POST['age']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];

    // Validation
    if (!preg_match('/^\d{10}$/', $phone)) {
        $error = "Phone number must be exactly 10 digits.";
    } elseif (!filter_var($age, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 120]])) {
        $error = "Age must be a valid number between 1 and 120.";
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, age=?, phone=?, gender=? WHERE user_id=?");
        $stmt->bind_param("ssssi", $name, $age, $phone, $gender, $user_id);

        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
            // Optionally update session data
            $_SESSION['name'] = $name;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;
            $_SESSION['gender'] = $gender;

            header("Location: profile.php");
            exit;
        } else {
            $error = "Failed to update profile.";
        }

        $stmt->close();
    }
}

// Fetch current user data
$stmt = $conn->prepare("SELECT name, age, email, phone, gender FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
<div class="container">
  <h3>Edit Profile</h3>
  <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
  <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

  <form method="POST" action="edit_profile.php">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Age</label>
      <input type="text" name="age" class="form-control" value="<?= htmlspecialchars($user['age']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Gender</label>
      <select name="gender" class="form-control">
        <option <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        <option <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
    <a href="profile.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
