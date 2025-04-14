<?php
require_once '../Backend/connect_db.php';
session_start();

// Check if the booking_id is provided in either GET or POST request
if (isset($_GET['booking_id'])) {
    $booking_id = intval($_GET['booking_id']);
} elseif (isset($_POST['booking_id'])) {
    $booking_id = intval($_POST['booking_id']);
} else {
    echo "No booking ID provided.";
    exit;
}

// Fetch booking details to ensure the booking exists
$sql = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    // Proceed with updating the booking status to 'booked'
    $update_sql = "UPDATE bookings SET status = 'booked' WHERE booking_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $booking_id);

    if ($update_stmt->execute()) {
        // Successfully updated the status, redirect to profile.php
        header("Location: profile.php?payment=success");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Failed to update booking status: " . $conn->error;
    }
} else {
    echo "Booking not found.";
}
?>