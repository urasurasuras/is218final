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

    switch ($_POST['action_type']) {

        case 'createTask':

            $task = new Task($loginInfo['username'], $title, $description, $due, $urgency);
        
            $results = $conn->createTask($task);
            if (!empty($result)) { // Null result from runQuery, assume duplicate username
        
                echo "RESULT ARRAY: ";
                print_r($result);
                echo "Couldn't create task.";
            } else { // successful Task addition
                echo "Task for " . $loginInfo['username'] . " created successfully!";
                
                header("Location: home.php");
            }
            
        break;

        case 'editTask':
                $ID = $_POST['taskID'];
                
                $task = new Task($loginInfo['username'], $title, $description, $due, $urgency, $ID);

                $results = $conn->editTask($task);
                if (!empty($result)) { 

                    echo "RESULT ARRAY: ";
                    print_r($result);
                    echo "Couldn't edit task.";
                } else { // successful Task addition
                    echo "Task for " . $loginInfo['username'] . " edited successfully!";

                    header("Location: home.php");
                }
                
                break;
        default:
            echo "Bruh moment for task form submission";
            break;
    }

    // print_r($_POST);
    
}

// Close connection
unset($pdo);
