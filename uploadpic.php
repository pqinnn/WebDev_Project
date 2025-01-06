<?php
session_start();
$email = $_SESSION['email'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture']) && $email) {
    // Define upload directory
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Validate file type
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        // Update the database with the new image URL
        $conn = new mysqli("localhost", "root", "", "ktmb");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET ImageURL = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $target_file, $email);

        if ($stmt->execute()) {
            echo "Profile picture updated successfully.";
            header("Location: profile.php"); // Redirect to the profile page
        } else {
            echo "Error updating profile picture: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "Invalid request.";
}
?>
