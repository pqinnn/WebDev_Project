<?php
include 'database.php';

try {
    $stmt = $conn->prepare("SELECT * FROM tasks ORDER BY created_at DESC");
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($task['task_id']) . "</td>";
        echo "<td>" . htmlspecialchars($task['task_name']) . "</td>";
        echo "<td>" . htmlspecialchars($task['priority_level']) . "</td>";
        echo "<td>" . htmlspecialchars($task['start_date']) . "</td>";
        echo "<td>" . htmlspecialchars($task['end_date']) . "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error fetching tasks: " . $e->getMessage();
}
?>
