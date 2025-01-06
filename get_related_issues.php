<?php
// Include the database connection file
include 'database.php';

// SQL query to fetch the issue IDs and titles from the database
$query = "SELECT id, title FROM issues";

// Execute the query and store the result
$result = mysqli_query($conn, $query);

// Check if the query execution was successful
if (!$result) {
    // Log the error to the server's error log for debugging
    error_log("Database query failed: " . mysqli_error($conn));
    
    // Output a default option indicating no issues are available
    echo "<option value=''>None</option>";
    
    // Exit the script to prevent further execution
    exit();
}

// Loop through each row in the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Output an HTML <option> element for each issue
    // The value of the option is the issue ID, and the displayed text is the issue title
    echo "<option value='{$row['id']}'>{$row['title']}</option>";
}

// Close the database connection to free resources
mysqli_close($conn);
?>