<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <table>
                <tr>
                    <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                    <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - Haziq</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;Welcome, <?php echo $_SESSION['fullname']; ?>!</h3></td>
                </tr>
            </table>
        </div>
    </header>
        
    <!-- Navigation Bar -->
    <nav class="navbar2">
        <ul class="trytgok">
            <li><a href="staff_dash.php">Dashboard</a></li>
            <li><a href="#">Issue Report</a></li>
            <li><a href="#">Feedback</a></li>
            <li><a href="#">History</a></li>
        </ul>
        <!-- User Icon -->
        <div class="user-icon2">
            <img src="src/user icon.png" alt="User Icon" id="userIcon">
            <div class="dropdown-menu">
                <a href="#">User Profile</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>

    <!-- Page Title -->
    <h1 class="page-title">Dashboard | <small>Staff Dashboard</small></h1>

    <!-- Dashboard Section -->
    <div class="dashboard-container">
        <div class="dashboard-item">
            <h2>Upcoming Tasks</h2>
            <p>You have 3 upcoming tasks to complete.</p>
            <a href="#">View Tasks</a>
        </div>
        <div class="dashboard-item">
            <h2>Recent Feedback</h2>
            <p>You have received 2 new feedback messages.</p>
            <a href="#">View Feedback</a>
        </div>
        <div class="dashboard-item">
            <h2>Reported Issues</h2>
            <p>There are 5 reported issues that need attention.</p>
            <a href="#">View Issues</a>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">...</a>
        <a href="#">6</a>
        <a href="#">Next &raquo;</a>
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
