<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in and has the 'staff' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    // Redirect to login page if not authorized
    header("Location: login.html");
    exit;
}
?>
<?php 
// Include the database connection file
include 'database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History and Status of Reported Issues</title>
    <link rel="stylesheet" href="styles.css"> <!-- Dashboard Styles -->
    <link rel="stylesheet" href="styles2.css"> <!-- Issue Reporting Table Styles -->
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <table>
                <tr>
                    <!-- Logo -->
                    <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                    <!-- Title -->
                    <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                    <!-- Owner Information -->
                    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - HAMZAH</h3></td>
                    <!-- Welcome Message -->
                    <td><h3>&nbsp;&nbsp;&nbsp;Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3></td>
                </tr>
            </table>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="navbar2">
        <ul class="trytgok">
            <li><a href="staff_dash.php">Dashboard</a></li> <!-- Link to Dashboard -->
            <li><a href="issue_reporting.php">Issue Report</a></li> <!-- Link to Issue Reporting -->
            <li><a href="issue_history_status.php">History</a></li> <!-- Link to History -->
            <li><a href="faq.php">FAQ</a></li> <!-- Link to FAQ -->
            <li><a href="aboutUs_staff.php">About Us</a></li> <!-- Link to About Us -->
        </ul>
        <!-- User Icon with Dropdown -->
        <div class="user-icon2">
            <img src="src/user icon.png" alt="User Icon" id="userIcon">
            <div class="dropdown-menu">
                <a href="#">User Profile</a> <!-- Link to User Profile -->
                <a href="logout.php">Log Out</a> <!-- Link to Log Out -->
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="history-box">
            <h1>History and Status of Reported Issues</h1>
            <table class="issue-table">
                <thead>
                    <tr>
                        <th>Issue ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query to fetch all issues ordered by the reported date
                    $query = "SELECT * FROM issues ORDER BY reported_date DESC";
                    $result = $conn->query($query);

                    // Check if there are any issues
                    if ($result->num_rows > 0) {
                        // Loop through each issue
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>"; // Display Issue ID
                            echo "<td>" . htmlspecialchars($row['title']) . "</td>"; // Display Issue Title
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>"; // Display Issue Status
                            echo "<td><button class='expand-btn' onclick='toggleDetails(this)'>▼</button></td>"; // Expand Button
                            echo "</tr>";

                            // Details Row (hidden by default)
                            echo "<tr class='details-row'>";
                            echo "<td colspan='4'>"; // Merge all columns for detailed view
                            echo "<strong>Description:</strong> " . htmlspecialchars($row['description']) . "<br>";
                            echo "<strong>Priority:</strong> " . htmlspecialchars($row['priority']) . "<br>";
                            echo "<strong>Category:</strong> " . htmlspecialchars($row['category']) . "<br>";
                            echo "<strong>Related Issue:</strong> " . (!empty($row['related_issue']) ? htmlspecialchars($row['related_issue']) : "None") . "<br>";
                            echo "<strong>File:</strong> " . (!empty($row['file_path']) ? "<a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>View File</a>" : "None") . "<br>";
                            echo "<strong>Reported By:</strong> " . htmlspecialchars($row['reported_by']) . "<br>";
                            echo "<strong>Reported Date:</strong> " . htmlspecialchars($row['reported_date']) . "<br>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // No issues found
                        echo "<tr><td colspan='4'>No issues reported yet.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle Details Function
            function toggleDetails(button) {
                const detailsRow = button.closest('tr').nextElementSibling; // Find the next row (details row)
                if (detailsRow.style.display === 'none' || !detailsRow.style.display) {
                    detailsRow.style.display = 'table-row'; // Show details row
                    button.textContent = '▲'; // Change button text to collapse indicator
                } else {
                    detailsRow.style.display = 'none'; // Hide details row
                    button.textContent = '▼'; // Change button text to expand indicator
                }
            }

            // User Icon Dropdown Functionality
            const userIcon = document.getElementById('userIcon');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            // Toggle dropdown on user icon click
            userIcon.addEventListener('click', () => {
                dropdownMenu.classList.toggle('show'); // Toggle the 'show' class
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', (event) => {
                if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show'); // Remove the 'show' class
                }
            });

            // Expose toggleDetails globally for use in buttons
            window.toggleDetails = toggleDetails;
        });
    </script>
</body>
</html>