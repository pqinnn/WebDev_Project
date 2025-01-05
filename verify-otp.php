<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = trim($_POST['otp']);

    if (empty($otp)) {
        echo "Please enter the OTP.";
        exit;
    }

    try {
        // Check if the OTP is correct
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND otp = :otp");
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->bindParam(':otp', $otp);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Clear the OTP from the database
            $stmt = $conn->prepare("UPDATE users SET otp = NULL WHERE email = :email");
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->execute();

            // Store the user's role in the session
            $_SESSION['role'] = $user['role'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['user_id'] = $user['id'];

            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header("Location: admin_dash.php");
            } elseif ($user['role'] === 'staff') {
                header("Location: staff_dash.php");
            }
            
            exit;
        } else {
            echo "Invalid OTP.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="form-container">
        <h1>Verify OTP</h1>
        <form action="verify-otp.php" method="POST">
            <div class="form-group">
                <label for="otp">Enter OTP:</label>
                <input type="text" id="otp" name="otp" required>
            </div>
            <button type="submit" class="form-button">Verify</button>
        </form>
    </section>
</body>
</html>
