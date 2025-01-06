<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "ktmb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Fetch user details
$email = $_SESSION['email'] ?? null;
$user = null;
if ($email) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTMB - User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo_miniktm.png" alt="KTMB Logo">
            <h1>KERETAPI TANAH MELAYU BERHAD</h1>
        </div>
        <div class="user-info">
            Owner - WAN SULHA | Welcome, <?= htmlspecialchars($user['fullname'] ?? 'Guest') ?>
        </div>
    </header>
            <!-- Navigation Bar -->
            <nav class="navbar2">
            <ul class="trytgok">
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="maintenance.html">Maintenance Task Management</a></li>
                <li><a href="UserManagementPage.html">User Management</a></li>
                <li><a href="#">Reported Issue</a></li>
                <li><a href="aboutUs_staff.php" class="active">About Us</a></li>
            </ul>
        
            <!-- User Icon -->
            <div class="user-icon2">
                <img src="src/user icon.png" alt="User Icon" id="userIcon">
                <div class="dropdown-menu">
                    <a href="#">User Profile</a>
                    <a href="#">Log Out</a>
                </div>
            </div>
        </nav> 
    <main>
        <div class="user-profile">
            <img src="<?= htmlspecialchars($user['ImageURL'] ?? 'default-profile.png') ?>" 
                 alt="Profile Picture" class="profile-picture">
            <div class="profile-info">
                <h2><?= htmlspecialchars($user['fullname'] ?? 'N/A') ?></h2>
                <p>Staff No: <?= htmlspecialchars($user['idnumber'] ?? 'N/A') ?></p>
                <p>Role: <?= htmlspecialchars($user['role'] ?? 'N/A') ?></p>
                <p>Email: <?= htmlspecialchars($user['email'] ?? 'N/A') ?></p>
            </div>
        </div>

        <!-- Form to upload profile picture -->
        <form action="uploadpic.php" method="POST" enctype="multipart/form-data">
            <label for="profile_picture">Update Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
            <button type="submit">Upload Picture</button>
        </form>
    </main>
</body>
</html>
