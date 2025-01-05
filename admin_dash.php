<?php
session_start();

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
    
    <!-- Header Section -->
        <header>
            <div class="logo">
                <table>
                    <tr>
                        <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                        <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                        <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - ALYA FARISAH</h3></td>
                        <td><h3>&nbsp;&nbsp;&nbsp;Welcome, <?php echo $_SESSION['fullname']; ?>!</h3></td>
                    </tr>
                </table>
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

    <!-- Main Dashboard Content -->

    <!-- Page Title -->
    <h1 class="page-title">Dashboard | <small>Admin Dashboard</small></h1>

    <!-- Dashboard Section -->
    <div class="dashboard-container">
        <div class="dashboard-item">
            <h2>Maintenance Task Management</h2>
            <p><strong>Total Tasks:</strong> 45</p>
            <p><strong>Pending Tasks:</strong> 10</p>
            <p><strong>Completed Tasks:</strong> 35</p>
            <a href="#">View Issues</a>
        </div>

        <div class="dashboard-item">
            <h2>User Management</h2>
                <p><strong>Total Users:</strong> 150</p>
                <p><strong>Active Users:</strong> 140</p>
                <p><strong>Inactive Users:</strong> 10</p>
                <a href="#">View Issues</a>
        </div>

        <div class="dashboard-item">
            <h2>Reported Issues</h2>
            <p><strong>Total Issues Reported:</strong> 20</p>
            <p><strong>Resolved Issues:</strong> 15</p>
            <p><strong>Pending Issues:</strong> 5</p>
            <a href="#">View Issues</a>
        </div>
    </div>


    <script>
        // JavaScript for Dropdown Menu
        const userIcon = document.getElementById('userIcon');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        userIcon.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!userIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    </script>
    </body>
</html>
