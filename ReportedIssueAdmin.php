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
$database = "your_database"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch issues from the database
$sql = "SELECT IssueID, Description, ReportedBy, Status, DateReported FROM Issues";
$result = $conn->query($sql);

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
                        <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - INTAN SABRINA </h3></td>
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
                    <a href="#">Log Out</a>
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
                            <th>Issue ID</th>
                            <th>Description</th>
                            <th>Reported By</th>
                            <th>Status</th>
                            <th>Date Reported</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['IssueID'] . "</td>";
                                    echo "<td>" . $row['Description'] . "</td>";
                                    echo "<td>" . $row['ReportedBy'] . "</td>";
                                    echo "<td>" . $row['Status'] . "</td>";
                                    echo "<td>" . $row['DateReported'] . "</td>";
                                    echo "<td><button class='resolve-btn'>Resolve</button></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No issues found</td></tr>";
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
