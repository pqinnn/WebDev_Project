<?php
session_start();
require_once 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please fill in both email and password.";
        exit;
    }

    try {
        // Check if the user exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Generate a 6-digit OTP
            $otp = rand(100000, 999999);

            // Store the OTP in the database temporarily
            $stmt = $conn->prepare("UPDATE users SET otp = :otp WHERE email = :email");
            $stmt->bindParam(':otp', $otp);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Send the OTP via email
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mar.hazem03@gmail.com';
            $mail->Password = 'amupkyaoxpynqocn';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mar.hazem03@gmail.com', 'KTMB Maintenance System');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Login';
            $mail->Body = "<h2>Your OTP is: <strong>$otp</strong></h2><p>This OTP will expire in 10 minutes.</p>";

            if ($mail->send()) {
                // Store user data in the session temporarily
                $_SESSION['email'] = $email;
                header("Location: verify-otp.php");
                exit;
            } else {
                echo "Failed to send OTP.";
            }
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Email error: " . $e->getMessage();
    }
}
?>
