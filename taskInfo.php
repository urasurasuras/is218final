<?php

require("connection.php");
require("user.php");

$task_name = $_POST['taskName'];
$text_box = $_POST['message'];
$due_date = $_POST['dueDate'];
$urgency = $_POST['taskUrgency'];



$conn = new SqlConnection();
$conn->connect();


try {
    $sql = "INSERT into tasks($task_name,$text_box,$due_date,$urgency) VALUES (:task_name,:text_box,:due_date,:urgency)";

    $stmt = $conn->conn->prepare($sql);

    // Bind parameters to statement
    $stmt->bindParam(':task_name', $_REQUEST['taskName']);
    $stmt->bindParam(':text_box', $_REQUEST['message']);
    $stmt->bindParam(':due_date', $_REQUEST['dueDate']);
    $stmt->bindParam(':urgency', $_REQUEST['taskUrgency']);

    // Execute the prepared statement
    $stmt->execute();
} catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

// Close connection
unset($pdo);
