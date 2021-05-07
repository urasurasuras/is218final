<!--
    -User info- username
    -logout
    -tasks stuff
-->

<?php
include_once('header.php');
require("connection.php");

if (!isset($_SESSION['loginInfo'])) {
    header("Location: loginForm.php");
}
$loginInfo = $_SESSION['loginInfo'][0];
// print_r($loginInfo);

$conn = new SqlConnection();
$conn->connect();

// Show incomplete tasks
$sql = "SELECT * FROM `tasks` WHERE `completion`=0 AND `username`='" . $loginInfo['username'] . "'";

if (isset($_GET['sort_incomplete'])) {
    $sql = sortTable($sql, $_GET['sort_incomplete']);
} else {
    $sql .= " ORDER BY `due` DESC";
}
$incompleteTasks = $conn->runQuery($sql);
// echo "sadsad ".$sql;
// echo "<BR>";

$sql = "SELECT * FROM `tasks` WHERE `completion`=1 AND `username`='" . $loginInfo['username'] . "'";
if (isset($_GET['sort_complete'])) {
    $sql = sortTable($sql, $_GET['sort_complete']);
} else {
    $sql .= " ORDER BY `due` DESC";
}
// echo "sadsad ".$sql;
// echo "<BR>";
$completeTasks = $conn->runQuery($sql);
?>

<p>NOTE: Complete, incomplete, and delete task buttons are buggy so click them more than once</p>
<div class="task-count">

    <span>
        <p>Tasks Incomplete:</p>
        <?php
        echo count($incompleteTasks);
        ?>

    </span>
    <span>
        <p>Tasks Completed:</p>
        <?php
        echo count($completeTasks);
        ?>
    </span>

</div>

<main>
    <h2>My Tasks</h2>
    <hr>
    <div class="controls">
        <div class="buttons">
            <button id="add-task">Add Task</button>

        </div>
        <div class="filter_by">
            <form class="sort_by" action="home.php">
                <label for="sort_incomplete">Sort TO-DO by: </label>
                <select name="sort_incomplete" id="sort_incomplete">
                    <option value="descending_date">Date (descending)</option>
                    <option value="ascending_date">Date (ascending)</option>
                    <option value="descending_urgency">Urgency (descending)</option>
                    <option value="ascending_urgency">Urgency (ascending)</option>
                </select>
                <br><br>
                <input type="submit" value="Sort">
            </form>
        </div>

        <div class="filter_by">
            <form class="sort_by" action="home.php">
                <label for="sort_complete">Sort complete by: </label>
                <select name="sort_complete" id="sort_complete">
                    <option value="descending_date">Date (descending)</option>
                    <option value="ascending_date">Date (ascending)</option>
                    <option value="descending_urgency">Urgency (descending)</option>
                    <option value="ascending_urgency">Urgency (ascending)</option>
                </select>
                <br><br>
                <input type="submit" value="Sort">
            </form>
        </div>

    </div>


    <?php @include_once 'CreateTask.php'; ?>
    <?php @include_once 'EditTask.php'; ?>

    <?php

    echo "<table class='stats' id='incompleteTable' cellspacing='0'>";
    echo "<tr>
        <td class='head' colspan='8'>TO-DO Tasks</td>
          </tr>
        <tr>
        <th></th>

        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Due date</th>
        <th>Urgency</th>
        
        <th></th>
        <th></th>

        </tr>";
    foreach ($incompleteTasks as $row) {

        echo "<tr>";
        echo "<form method='post'>";
        echo '<td><button class="btn" value="btnCompleteTask" name="btnCompleteTask"><i class="fas fa-check-square"></i></button></td>';

        $datetime = new DateTime($row['due']);
        $due = $datetime->format('D, M j');

        $now = new DateTime(); // current date/time
        $diff = $now->diff($datetime);

        echo '<input hidden type="text" id="ID" name="ID" value="' . $row['ID'] . '">';
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $due . "<br>(" . $diff->d . "days, " . $diff->h . "hours.)</td>";
        echo "<td>" . $row['urgency'] . "</td>";

        echo '<td><button class="btn" value="btnDeleteTask" name="btnDeleteTask"><i class="fa fa-trash"></i></button></td>';
        echo '<td><button type="button" 
        onclick="handleEdit(
            \'' . $row['ID'] . '\'
            )" class="btn" value="btnEditTask" name="btnEditTask"><i class="fas fa-edit"></i></button></td>';

        echo "</form>";
        echo "</tr>";
    }

    // Show completed tasks
    echo "<table border='4' class='stats' cellspacing='0'>";
    echo "<tr>
        <td class='hed' colspan='8'>Completed Tasks</td>
          </tr>
        <tr>

        <th></th>

        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Due date</th>
        <th>Urgency</th>

        <th></th>
        <th></th>

        </tr>";
    foreach ($completeTasks as $row) {

        echo "<tr>";

        echo "<form method='post'>";

        $datetime = new DateTime($row['due']);
        $due = $datetime->format('D, M j');

        $now = new DateTime(); // current date/time
        $diff = $now->diff($datetime);

        echo '<td><button class="btn" value="btnUnCompleteTask" name="btnUnCompleteTask"><i class="fas fa-check-square"></i></button></td>';

        echo '<input hidden type="text" id="ID" name="ID" value="' . $row['ID'] . '">';
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $due . "<br>(" . $diff->d . "days, " . $diff->h . "hours.)</td>";
        echo "<td>" . $row['urgency'] . "</td>";
        echo '<td><button class="btn" value="btnDeleteTask" name="btnDeleteTask"><i class="fa fa-trash"></i></button></td>';
        echo '<td><button type="button" 
        onclick="handleEdit(
            \'' . $row['ID'] . '\'
            )" class="btn" value="btnEditTask" name="btnEditTask"><i class="fas fa-edit"></i></button></td>';

        echo "</form>";

        echo "</tr>";
    }

    if (array_key_exists('btnCompleteTask', $_POST)) {
        completeTask($conn);
    } else if (array_key_exists('btnUnCompleteTask', $_POST)) {
        unCompleteTask($conn);
    } else if (array_key_exists('btnDeleteTask', $_POST)) {
        deleteTask($conn);
    } else if (array_key_exists('btnEditTask', $_POST)) {
    }
    function completeTask($conn)
    {

        $sql = "UPDATE `tasks` SET `completion`=1 WHERE `ID`=" . $_POST['ID'];

        $results = $conn->runQuery($sql);
    }
    function unCompleteTask($conn)
    {

        $sql = "UPDATE `tasks` SET `completion`=0 WHERE `ID`=" . $_POST['ID'];

        $results = $conn->runQuery($sql);
    }
    function deleteTask($conn)
    {

        $sql = "DELETE FROM `tasks` WHERE `ID`=" . $_POST['ID'];

        $results = $conn->runQuery($sql);
    }

    function sortTable($sql, $sortAction)
    {
        switch ($sortAction) {
            case 'ascending_date':
                $sql .= " ORDER BY `due` ASC";
                break;
            case 'descending_date':
                $sql .= " ORDER BY `due` DESC";
                break;
            case 'descending_urgency':
                $sql .= " ORDER BY `urgency` DESC";
                break;
            case 'ascending_urgency':
                $sql .= " ORDER BY `urgency` ASC";
                break;
            default:
                $sql .= " ORDER BY `due` DESC";
                break;
        }
        return $sql;
    }
    ?>

</main>

<script src="js/scripts.js"></script>

</body>

</html>