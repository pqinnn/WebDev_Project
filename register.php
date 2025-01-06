<?php
require_once 'db.php';  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data from the registration form
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $idnumber = trim($_POST['idnumber']);
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate the form inputs
    if (empty($fullname) || empty($email) || empty($idnumber) || empty($role) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
        exit;
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Validate the password strength
    if (!preg_match('/[A-Z]/', $password)) {
        echo "Password must contain at least one uppercase letter.";
        exit;
    }

    if (!preg_match('/[a-z]/', $password)) {
        echo "Password must contain at least one lowercase letter.";
        exit;
    }

    if (!preg_match('/[0-9]/', $password)) {
        echo "Password must contain at least one number.";
        exit;
    }

    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        echo "Password must contain at least one special character.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if the email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "This email is already registered.";
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, idnumber, role, password) VALUES (:fullname, :email, :idnumber, :role, :password)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':idnumber', $idnumber);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                // Redirect to the login page after successful registration
                header("Location: login.html");
                exit;
            } else {
                echo "Registration failed.";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
