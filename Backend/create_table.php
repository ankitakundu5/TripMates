<?php
require_once 'connect_db.php';

// Select the database
$dbname = 'tripmates';
if (!$conn->select_db($dbname)) {
    die("Failed to select database '$dbname': " . $conn->error);
}

// Array of SQL table creation statements
$tables = [

"CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    phone VARCHAR(20),
    gender VARCHAR(20), 
    age INT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)",

"CREATE TABLE IF NOT EXISTS packages (
    package_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    destination VARCHAR(255) NOT NULL,
    activities TEXT,  
    price INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,   
    size INT NOT NULL,
    totalsize INT NOT NULL,
    agegroup INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)",

"CREATE TABLE IF NOT EXISTS destinations (
    destination_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL
)",

"CREATE TABLE IF NOT EXISTS activities (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL
)",

"CREATE TABLE IF NOT EXISTS package_destinations (
    package_id INT,
    destination_id INT,
    PRIMARY KEY (package_id, destination_id),
    FOREIGN KEY (package_id) REFERENCES packages(package_id) ON DELETE CASCADE,
    FOREIGN KEY (destination_id) REFERENCES destinations(destination_id) ON DELETE CASCADE
)",

"CREATE TABLE IF NOT EXISTS package_activities (
    package_id INT,
    activity_id INT,
    PRIMARY KEY (package_id, activity_id),
    FOREIGN KEY (package_id) REFERENCES packages(package_id) ON DELETE CASCADE,
    FOREIGN KEY (activity_id) REFERENCES activities(activity_id) ON DELETE CASCADE
)",

"CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    package_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'pending',
    total_price INT NOT NULL,
    UNIQUE (user_id, package_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (package_id) REFERENCES packages(package_id) ON DELETE CASCADE
)",

"CREATE TABLE IF NOT EXISTS payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    user_id INT,
    amount INT NOT NULL,
    payment_status VARCHAR(50) DEFAULT 'pending',      
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
)"

];

// Execute each SQL statement
foreach ($tables as $index => $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "✅ Table " . ($index + 1) . " created successfully.<br>";
    } else {
        echo "❌ Error creating table " . ($index + 1) . ": " . $conn->error . "<br>";
    }
}

// Close the connection
$conn->close();
?>
