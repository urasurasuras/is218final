<div id="task-creation">
    <h2>Create a new Task</h2>
    <span class="close">&times;</span>
    <form action="taskInfo.php" method="post">

        <label for="title">Name: </label>
        <input type="text" name="title" id="title" placeholder="Name" required>

        <Label for="description">Description: </Label>
        <textarea name="description" rows="10" cols="30" placeholder="Enter Description of your Task..."></textarea>

        <label for="due">Due Date:</label>
        <input type="date" name="due" id="due">

        <label for="urgency">Task Urgency: </label>
        <select name="urgency" id="urgency" required>
            <option value="Normal">Normal</option>
            <option value="Important">Important</option>
            <option value="Very-Important">Very Important</option>
        </select>

        <input type="submit" value="Add Task">
    </form>
</div>