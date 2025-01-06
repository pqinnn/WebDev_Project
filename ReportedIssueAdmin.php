<?php
session_start();

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit;
}

// Database connection
$servername = "localhost"; // Change if needed
$username = "root";        // Database username
$password = "";            // Database password
$database = "ktmb_issues"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch issues from the database
$sql = "SELECT id, title, description, priority, category, related_issue, file_path, reported_by, reported_date, status FROM Issues";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css">
        <style>

        main {
    padding: 20px;
}

.reported-issues h1 {
    color: #01397e;
    margin-bottom: 10px;
}

.reported-issues p {
    margin-bottom: 20px;
}

/* Table Container */
.table-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    overflow-x: auto;
}

.issues-table {
    width: 100%;
    border-collapse: collapse;
}

.issues-table thead {
    background-color: #024da0;
    color: #fff;
}

.issues-table th,
.issues-table td {
    text-align: left;
    padding: 10px 15px;
    border: 1px solid #ddd;
}

.issues-table tbody tr:nth-child(odd) {
    background-color: #f7f9fc;
}

.issues-table tbody tr:hover {
    background-color: #e1e9f7;
}

.issues-table .resolve-btn {
    background-color: #0269d9;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.issues-table .resolve-btn:hover {
    background-color: #01397e;
}
</style>
    </head>

    <body>
    
    <!-- Header Section -->
        <header>
            <div class="logo">
                <table>
                    <tr>
                        <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                        <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
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
                <li><a href="ReportedIssueAdmin.php">Reported Issue</a></li>
                <li><a href="aboutUs_staff.php" class="active">About Us</a></li>
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
        <main>
    <div class="reported-issues">
        <h1>Reported Issues</h1>
        <p>Welcome, Admin! Below are the reported issues that require your attention.</p>

        <!-- Container for the Table -->
        <div class="table-container">
            <table class="issues-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Category</th>
                        <th>Related Issue</th>
                        <th>File Path</th>
                        <th>Reported By</th>
                        <th>Reported Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['priority'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['related_issue'] . "</td>";
                            echo "<td>" . $row['file_path'] . "</td>";
                            echo "<td>" . $row['reported_by'] . "</td>";
                            echo "<td>" . $row['reported_date'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td><button class='resolve-btn'>Resolve</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No issues found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div> 
    </div>         
</main>


</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
