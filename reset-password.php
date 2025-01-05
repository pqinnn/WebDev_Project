<?php
require_once 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token is valid
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = :token AND reset_token_expiry > NOW()");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newPassword = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];

            // Check if the passwords match
            if ($newPassword !== $confirmPassword) {
                echo "Passwords do not match.";
                exit;
            }

            // Validate password strength
            if (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $newPassword) || strlen($newPassword) < 8) {
                echo "Password does not meet the required criteria.";
                exit;
            }

            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $stmt = $conn->prepare("UPDATE users SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :token");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':token', $token);
            if ($stmt->execute()) {
                echo "Password reset successful! <a href='login.html'>Login here</a>";
            } else {
                echo "Password reset failed.";
            }
        }
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="form-container">
        <h1>Reset Your Password</h1>
        <form action="reset-password.php?token=<?php echo $_GET['token']; ?>" method="POST">
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required onkeyup="checkPasswordStrength()">
                <div id="password-strength" class="strength-indicator"></div>
                <div id="password-suggestions" class="suggestions-box"></div>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required onkeyup="checkPasswordMatch()">
                <div id="password-match" class="match-indicator"></div>
            </div>
            <button type="submit" id="reset-button" class="form-button" disabled>Reset Password</button>
        </form>
    </section>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const resetButton = document.getElementById('reset-button');
            const strengthIndicator = document.getElementById('password-strength');
            const suggestionsBox = document.getElementById('password-suggestions');

            // Regular expressions for password validation
            const uppercaseRegex = /[A-Z]/;
            const lowercaseRegex = /[a-z]/;
            const numberRegex = /[0-9]/;
            const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

            let strength = 0;
            let suggestions = [];

            if (password.length >= 8) {
                strength++;
            } else {
                suggestions.push("Password must be at least 8 characters long.");
            }

            if (uppercaseRegex.test(password)) {
                strength++;
            } else {
                suggestions.push("Add at least one uppercase letter.");
            }

            if (lowercaseRegex.test(password)) {
                strength++;
            } else {
                suggestions.push("Add at least one lowercase letter.");
            }

            if (numberRegex.test(password)) {
                strength++;
            } else {
                suggestions.push("Add at least one number.");
            }

            if (specialCharRegex.test(password)) {
                strength++;
            } else {
                suggestions.push("Add at least one special character.");
            }

            // Display the password strength
            let strengthText;
            switch (strength) {
                case 0:
                case 1:
                    strengthText = "Very Weak";
                    strengthIndicator.style.color = "red";
                    resetButton.disabled = true;
                    break;
                case 2:
                    strengthText = "Weak";
                    strengthIndicator.style.color = "orange";
                    resetButton.disabled = true;
                    break;
                case 3:
                    strengthText = "Moderate";
                    strengthIndicator.style.color = "yellow";
                    resetButton.disabled = true;
                    break;
                case 4:
                    strengthText = "Strong";
                    strengthIndicator.style.color = "lightgreen";
                    break;
                case 5:
                    strengthText = "Very Strong";
                    strengthIndicator.style.color = "green";
                    break;
            }

            strengthIndicator.textContent = "Strength: " + strengthText;
            suggestionsBox.innerHTML = "<strong>Suggestions:</strong><br>" + suggestions.join("<br>");
            checkPasswordMatch();
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const resetButton = document.getElementById('reset-button');
            const matchIndicator = document.getElementById('password-match');

            if (password === confirmPassword && password.length > 0) {
                matchIndicator.textContent = "Passwords match!";
                matchIndicator.style.color = "green";
                resetButton.disabled = false;
            } else {
                matchIndicator.textContent = "Passwords do not match.";
                matchIndicator.style.color = "red";
                resetButton.disabled = true;
            }
        }
    </script>
</body>
</html>
