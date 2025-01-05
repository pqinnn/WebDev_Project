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
    <nav class="navbar">
        <ul>
            <li><a href="admin_dash.php">Dashboard</a></li>
            <li><a href="maintenance.html" class="active">Maintenance Task Management</a></li>
            <li><a href="#">User Management</a></li>
            <li><a href="#">Feedback Management</a></li>
            <li><a href="#">Reported Issue</a></li>
        </ul>
        <!-- User Icon -->
        <div class="user-icon">
            <img src="src/user icon.png" alt="User Icon" id="userIcon">
            <div class="dropdown-menu">
                <a href="#">User Profile</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <main>
        <section class="overview-panels">
            <div class="panel">
                <h3>Total Users</h3>
                <p>Admins: 5 | Staff: 120 | Users: 500</p>
            </div>
            <div class="panel">
                <h3>Reported Issues</h3>
                <p>Open: 25 | In Progress: 10 | Resolved: 200</p>
            </div>
            <div class="panel">
                <h3>Maintenance Tasks</h3>
                <p>Pending: 15 | Completed: 30</p>
            </div>
            <div class="panel">
                <h3>Login Stats</h3>
                <p>Daily Logins: 150 | Monthly Logins: 3200</p>
            </div>
        </section>

        <section class="notifications">
            <h2>Recent Notifications</h2>
            <ul>
                <li>New issue reported by staff #45.</li>
                <li>Maintenance task #120 nearing its deadline.</li>
                <li>User #200 completed profile update.</li>
                <li>Suspicious login attempt detected.</li>
            </ul>
        </section>

        <section class="data-visualization">
            <h2>Reports and Analytics</h2>
            <div class="chart-container">
                <div id="issue-status-chart">[Chart Placeholder: Issue Statistics]</div>
                <div id="task-completion-chart">[Chart Placeholder: Task Progress]</div>
            </div>
        </section>
    </main>
</body>
</html>
