<?php
require_once 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        echo "Please enter your email.";
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $token = bin2hex(random_bytes(50));

            $stmt = $conn->prepare("UPDATE users SET reset_token = :token, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $resetLink = "http://localhost/WebDev_Project/reset-password.php?token=" . $token;

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
            $mail->Subject = 'Password Reset Request';

            // Button styling
            $mail->Body = "
            <h2>Password Reset Request</h2>
            <p>Click the button below to reset your password:</p>
            <a href='$resetLink' style='display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: #007bff; text-decoration: none; border-radius: 5px;'>Reset Password</a>
            <p>If the button doesn't work, copy and paste the link below into your browser:</p>
            <p><a href='$resetLink'>$resetLink</a></p>
            ";

            if ($mail->send()) {
                echo "A password reset link has been sent to your email.";
            } else {
                echo "Failed to send email.";
            }
        } else {
            echo "No account found with that email.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Email error: " . $e->getMessage();
    }
}
?>
