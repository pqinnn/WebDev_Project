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
    <title>KTMB - User Profile</title>
    <style>
    /* Paste the CSS code you provided here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #dceaf5;
        }

        /* Header styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #4475ad;
            color: white;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }

        header .user-info {
            font-size: 14px;
        }

        /* Navigation bar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2C3E50;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #e06a4e;
        }

        .navbar ul li a.active {
            color: #e06a4e;
        }

        /* User profile styles */
        .user-profile {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            display: flex;
            align-items: center;
        }

        .user-profile .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .user-profile .profile-info h2 {
            margin: 0;
            font-size: 24px;
            color: #4475ad;
        }

        .user-profile .profile-info p {
            margin: 5px 0;
            color: #666;
        }

        .user-profile .edit-profile {
            margin-left: auto;
            background-color: #4475ad;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .user-profile .edit-profile:hover {
            background-color: #366a99;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <table>
                <tr>
                    <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                    <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - INTAN SABRINA</h3></td>
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
            <li><a href="#">History</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="aboutUs_staff.php">About Us</a></li>
        </ul>

        <!-- User Icon -->
        <div class="user-icon2">
            <img src="src/user icon.png" alt="User Icon" id="userIcon">
            <div class="dropdown-menu">
                <a href="UserProfileStaff.php">User Profile</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="user-profile">
            <img src="Profile-Picture.jpg" alt="Profile Picture" class="profile-picture">
            <div class="profile-info">
                <h2>Hana Montana</h2>
                <p>Staff No: 0120</p>
                <p>Role: Staff</p>
                <p>Email: hanamontana@ktmb.com</p>
                <p>Last Login: 2024-11-1 09:45 AM</p>
            </div>
            <button class="edit-profile">Edit Profile</button>
        </div>
    </main>