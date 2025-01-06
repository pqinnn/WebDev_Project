<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];
    $priority_level = $_POST['priority_level'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    try {
        $stmt = $conn->prepare("INSERT INTO tasks (task_name, priority_level, start_date, end_date) 
                                VALUES (:task_name, :priority_level, :start_date, :end_date)");
        $stmt->bindParam(':task_name', $task_name);
        $stmt->bindParam(':priority_level', $priority_level);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();

        // Redirect back to the main page
        header("Location: maintenance.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
