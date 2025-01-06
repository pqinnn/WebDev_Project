<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "ktmb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Delete Requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "User deleted successfully!";
    }
    exit;
}

// Fetch Users for Display
$result = $conn->query("SELECT * FROM users");
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Management</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo_miniktm.png" alt="KTMB Logo">
            <h1>KERETAPI TANAH MELAYU BERHAD</h1>
        </div>
        <div class="user-info">Owner - WAN SULHA | Welcome, Admin</div>
    </header>

    <nav class="navbar2">
            <ul class="trytgok">
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="maintenance.php">Maintenance Task Management</a></li>
                <li><a href="Usermanage.php">User Management</a></li>
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
        <h1 class="page-title">User Management</h1>

        <div class="user-table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>ID Number</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['fullname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['idnumber'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <button class="delete-user-button" onclick="deleteUser(<?= $user['id'] ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ action: 'delete', id })
                }).then(() => location.reload());
            }
        }
    </script>
</body>
</html>
