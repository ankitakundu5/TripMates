<?php
session_start();
require_once '../Backend/connect_db.php';

$user_id = $_POST['user_id'];
$package_id = $_POST['package_id'];


$userQuery = mysqli_query($conn, "SELECT age FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($userQuery);

$packageQuery = mysqli_query($conn, "SELECT agegroup, price FROM packages WHERE package_id = $package_id");
$package = mysqli_fetch_assoc($packageQuery);

if ($user['age'] < $package['agegroup']) {
    echo "<script>alert('You are not eligible to book this package'); window.location.href='profile.php';</script>";
    exit();
}

// Insert booking
$price = $package['price'];
mysqli_query($conn, "INSERT INTO bookings (user_id, package_id, total_price) VALUES ($user_id, $package_id, $price)");

header("Location: profile.php");
?>
