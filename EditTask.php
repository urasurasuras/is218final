<div id="task-edit">
    <h2>Edit Current Task</h2>
    <span onclick="document.getElementById('task-edit').style.display='none'" class="close">&times;</span>
    <form action="taskInfo.php" method="post" name="editTask">

        <label for="title">Name: </label>
        <input type="text" name="title" id="title" placeholder="New Name" value="" required>

        <Label for="description">Description: </Label>
        <textarea name="description" id="description" rows="10" cols="30" placeholder="New task desciption"></textarea>

        <label for="due">New Due Date:</label>
        <input type="date" name="due" id="due">

        <label for="urgency">New Task Urgency: </label>
        <select name="urgency" id="urgency" required>
            <option value="Normal">Normal</option>
            <option value="Important">Important</option>
            <option value="Very-Important">Very Important</option>
        </select>

        <input hidden name="taskID" id="taskID"></input>

        <input hidden value="editTask" name="action_type" id="action_type" ></input>

        <input type="submit" value="Edit Task">
    </form>
</div>