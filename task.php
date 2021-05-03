<div id="task-creation">
    <h2>Create a new Task</h2>
    <span class="close">&times;</span>
    <form action="taskInfo.php" method="post">
        <label for="taskName">Name: </label>
        <input type="text" name="taskName" id="taskName" placeholder="Name" required>

        <Label for="taskDesc">Description: </Label>
        <textarea name="message" rows="10" cols="30" placeholder="Enter Description of your Task..."></textarea>

        <label for="dueDate">Due Date:</label>
        <input type="date" name="dueDate" id="dueDate">

        <label for="taskUrgency">Task Urgency: </label>
        <select name="taskUrgency" id="taskUrgency" required>
            <option value="Normal">Normal</option>
            <option value="Important">Important</option>
            <option value="Very Important">Very Important</option>
        </select>

        <input type="submit" value="Add Task">
    </form>
</div>