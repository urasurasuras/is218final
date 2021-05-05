<!--
    -User info- username
    -logout
    -tasks stuff
-->

<?php
include_once('header.php');
require("connection.php");

if (!isset($_SESSION['loginInfo'])) {
    header("Location: login.html");
}

$conn = new SqlConnection();
$conn->connect();

// Show incomplete tasks
$sql = "SELECT * FROM `tasks` WHERE `completion`=0";

if (isset($_GET['sort'])){
    switch ($_GET['sort']) {
        case 'ascending_date':
            $sql .= " ORDER BY `due` ASC";
            break;
        case 'descending_date':
            $sql .= " ORDER BY `due` DESC";
            break;
        default:
            $sql .= " ORDER BY `due` DESC";
            break;
    }
}
else{
    $sql .= " ORDER BY `due` DESC"; 
}
// echo $sql;
$incompleteTasks = $conn->runQuery($sql);

$sql = "SELECT * FROM `tasks` WHERE `completion`=1";
$completeTasks = $conn->runQuery($sql);
?>

<div class="task-count">
    <p>NOTE: Complete, incomplete, and delete task buttons are buggy so click them more than once</p>

    <p>Incomplete:</p>

    <span>
        <?php
        echo count($incompleteTasks);
        ?>

    </span>
    <span>
        <p>Completed:</p>
        <?php
        echo count($completeTasks);
        ?>
    </span>

</div>

<main>
    <h2>My Tasks</h2>
    <hr>
    <div class="controls">
        <button id="add-task">Add Task</button>
        <div class="filter_by">
            <form action="home.php">
                <label for="sort">Sort by: </label>
                    <select name="sort" id="sort">
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
    <?php @include_once 'taskContent.php'; ?>

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

        echo "</form>";

        echo "</tr>";
    }

    if (array_key_exists('btnCompleteTask', $_POST)) {
        completeTask($conn);
    } else if (array_key_exists('btnUnCompleteTask', $_POST)) {
        unCompleteTask($conn);
    } else if (array_key_exists('btnDeleteTask', $_POST)) {
        deleteTask($conn);
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
    ?>

</main>

<script src="js/scripts.js"></script>

</body>

</html>