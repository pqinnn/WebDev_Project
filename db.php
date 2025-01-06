<?php
// Database connection settings
$host = 'localhost';        // Database host (default for XAMPP)
$dbname = 'ktmb_maintenance_system';  // Your database name
$username = 'root';         // Your MySQL username (default for XAMPP)
$password = '';             // Your MySQL password (leave empty for XAMPP)

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment the next line to check if the connection is successful
    // echo "Connected successfully";
} catch (PDOException $e) {
    // Display an error message if the connection fails
    echo "Connection failed: " . $e->getMessage();
}
?>
