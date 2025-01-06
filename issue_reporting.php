<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in and has the 'staff' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    // Redirect to login page if the user is not authorized
    header("Location: login.html");
    exit; // Stop further script execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Reporting</title>
    <!-- Link to the main project styles -->
    <link rel="stylesheet" href="gitproj/WebDev_Project/styles.css">
    <!-- Link to additional styles specific to this page -->
    <link rel="stylesheet" href="styles2.css">
    <style>
        /* Styling for the user icon container */
        .user-icon2 {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        /* Styling for the user icon */
        .user-icon2 img {
            width: 40px;
            height: 40px;
            border-radius: 50%; /* Circular icon */
            cursor: pointer;
        }

        /* Styling for the dropdown menu */
        .dropdown-menu {
            display: none; /* Hidden by default */
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff; /* White background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
            border-radius: 5px; /* Rounded corners */
            overflow: hidden;
            z-index: 1000; /* Ensure it appears above other elements */
            min-width: 150px; /* Minimum width of dropdown */
        }

        /* Styling for dropdown menu links */
        .dropdown-menu a {
            display: block;
            padding: 10px 15px; /* Add spacing inside links */
            color: #333; /* Dark text */
            text-decoration: none; /* Remove underline */
            transition: background-color 0.3s ease; /* Smooth hover effect */
        }

        /* Hover effect for dropdown menu links */
        .dropdown-menu a:hover {
            background-color: #f4f4f4; /* Light gray background on hover */
        }

        /* Show dropdown when the 'show' class is added */
        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <table>
                <tr>
                    <!-- KTMB Logo -->
                    <td><img src="gitproj/WebDev_Project/src/logo_miniktm.png" alt="KTMB Logo"></td>
                    <!-- Title -->
                    <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                    <!-- Owner Information -->
                    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - HAMZAH</h3></td>
                    <!-- Welcome Message with Username -->
                    <td><h3>&nbsp;&nbsp;&nbsp;Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3></td>
                </tr>
            </table>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="navbar2">
        <ul class="trytgok">
            <!-- Navigation links to different sections -->
            <li><a href="gitproj/WebDev_Project/staff_dash.php">Dashboard</a></li>
            <li><a href="issue_reporting.php">Issue Report</a></li>
            <li><a href="issue_history_status.php">History</a></li>
            <li><a href="gitproj/WebDev_Project/faq.php">FAQ</a></li>
            <li><a href="gitproj/WebDev_Project/aboutUs_staff.php">About Us</a></li>
        </ul>
        <!-- User Icon and Dropdown -->
        <div class="user-icon2">
            <img src="gitproj/WebDev_Project/src/user icon.png" alt="User Icon" id="userIcon">
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a href="#">User Profile</a>
                <a href="gitproj/WebDev_Project/logout.php">Log Out</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1>Report an Issue</h1>
        <form action="save_issue.php" method="POST" enctype="multipart/form-data" class="issue-form">
            <!-- Input field for issue title -->
            <label for="issue-title">Issue Title:</label>
            <input type="text" id="issue-title" name="issue_title" required>

            <!-- Textarea for issue description -->
            <label for="issue-description">Description:</label>
            <textarea id="issue-description" name="issue_description" rows="5" required></textarea>

            <!-- Dropdown for priority selection -->
            <label for="issue-priority">Priority:</label>
            <select id="issue-priority" name="issue_priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <!-- Dropdown for category selection -->
            <label for="issue-category">Category:</label>
            <select id="issue-category" name="issue_category" required>
                <option value="Electrical">Electrical</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Safety">Safety</option>
                <option value="Other">Other</option>
            </select>

            <!-- Dropdown for selecting related issues -->
            <label for="related-issues">Related Issue (if any):</label>
            <select id="related-issues" name="related_issue">
                <option value="">None</option>
                <?php include 'get_related_issues.php'; // Fetch and display related issues ?>
            </select>

            <!-- File upload for issue attachments -->
            <label for="issue-file">Upload File or Picture:</label>
            <input type="file" id="issue-file" name="issue_file" accept="image/*,application/pdf">

            <!-- Read-only field for the username of the reporter -->
            <label for="reported-by">Reported By:</label>
            <input type="text" id="reported-by" name="reported_by" value="<?php echo $_SESSION['username']; ?>" readonly>

            <!-- Read-only field for the current date and time -->
            <label for="reported-date">Date of Reporting:</label>
            <input type="text" id="reported-date" name="reported_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>

            <!-- Submit button -->
            <button type="submit">Submit Issue</button>
        </form>
    </div>

    <script>
        // Wait for the DOM to load before running the script
        document.addEventListener('DOMContentLoaded', function () {
            // User Icon Dropdown Functionality
            const userIcon = document.getElementById('userIcon');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            // Toggle dropdown on user icon click
            userIcon.addEventListener('click', () => {
                dropdownMenu.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', (e) => {
                if (!userIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>