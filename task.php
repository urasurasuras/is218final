<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>

    <div id="task-creation">
        <h2>Create a new Task</h2>
        <span class="close">&times;</span>
        <form action="" method="post">
            <label for="taskName">Name: </label>
            <input type="text" name="" id="taskName" placeholder="Name" required>

            <Label for="taskDesc">Description: </Label>
            <textarea name="message" rows="10" cols="30">The cat was playing in the garden.</textarea>

            <label for="dueDate">Due Date:</label>
            <input type="date" name="" id="dueDate">

            <label for="taskUrgency">Task Urgency: </label>
            <select id="taskUrgency" required>
                <option value="Normal">Normal</option>
                <option value="Important">Important</option>
                <option value="Very Important">Very Important</option>
            </select>

            <input type="submit" value="Add Task">
        </form>
    </div>
</body>

</html>