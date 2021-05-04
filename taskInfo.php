<?php

require("connection.php");
require("task.php");
session_start();
$loginInfo = $_SESSION['loginInfo'][0];

$title = $_POST['title'];
$description = $_POST['description'];
$due = $_POST['due'];
$urgency = $_POST['urgency'];

$conn = new SqlConnection();
$conn->connect();

if (isset($_POST)) {

    $task = new Task($loginInfo['username'], $title, $description, $due, $urgency);

    $results = $conn->createTask($task);
    if (!empty($result)) { // Null result from runQuery, assume duplicate username

        echo "RESULT ARRAY: ";
        print_r($result);
        echo "Couldn't create Account.";
    } else { // successful Task addition
        echo "Task for " . $loginInfo['username'] . " created successfully!";
        header("Location: home.php");
    }
}

// Close connection
unset($pdo);
