<?php

// Include the database connection file
include 'database.php'; // Ensure this file establishes a valid database connection

// Check if the request method is POST to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form input data from the POST request
    $title = $_POST['issue_title']; // Title of the issue
    $description = $_POST['issue_description']; // Detailed description of the issue
    $priority = $_POST['issue_priority']; // Priority level of the issue (Low, Medium, High)
    $category = $_POST['issue_category']; // Category of the issue (e.g., Electrical, Mechanical)
    $relatedIssue = !empty($_POST['related_issue']) ? $_POST['related_issue'] : NULL; // Related issue ID (optional)
    $reportedBy = $_POST['reported_by']; // User who reported the issue
    $reportedDate = $_POST['reported_date']; // Date and time when the issue was reported

    // Initialize the file path variable
    $filePath = NULL;

    // Handle file upload if a file is attached
    if (!empty($_FILES['issue_file']['name'])) {
        // Get the original file name
        $fileName = basename($_FILES['issue_file']['name']);
        $targetDir = 'uploads/'; // Directory where files will be stored
        $filePath = $targetDir . $fileName; // Full file path

        // Check if the uploads directory exists, and create it if it doesn't
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory with full permissions
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES['issue_file']['tmp_name'], $filePath)) {
            echo "Error uploading file."; // Display error if the file upload fails
            exit(); // Stop further script execution
        }
    }

    // Prepare SQL query to insert the issue into the database
    $query = "INSERT INTO issues (title, description, priority, category, related_issue, file_path, reported_by, reported_date)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($query);

    // Bind the input values to the prepared statement
    $stmt->bind_param("ssssssss", $title, $description, $priority, $category, $relatedIssue, $filePath, $reportedBy, $reportedDate);

    // Execute the statement and check if the query was successful
    if ($stmt->execute()) {
        // If the query is successful, display an alert and redirect the user
        echo "<script>
                alert('Issue reported successfully!');
                window.location.href = 'issue_reporting.php'; // Redirect to the issue reporting page
              </script>";
    } else {
        // Display an error message if the query fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement to free resources
    $stmt->close();

    // Close the database connection to prevent resource leaks
    $conn->close();
}
?>