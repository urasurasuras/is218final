<!--
    -User info- username
    -logout
    -tasks stuff
-->

<?php 
    include_once ('header.php') ;

    if (!isset($_SESSION['loginInfo'])){
        header("Location: login.html");
    }

?>

<div class="task-count">
    <span></span>
    <p>Completed:</p></span>
    <span></span>
    <p>Incomplete:</p></span>
</div>

<main>
    <h2>My Tasks</h2>
    <div class="controls">
        <button id="add-task">Add Task</button>
        <button>Delete Task</button>
    </div>
    <hr>
    <div class="content"></div>
    <?php @include_once 'task.php'; ?>
    
</main>

<script src="js/scripts.js"></script>
</body>

</html>
