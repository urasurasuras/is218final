<div id="task-change">
    <h2>Edit an Existing Task</h2>
    <span class="edit-close">&times;</span>
    <form action="editTaskInfo.php" method="post">
        <label for="displayID">Available Tasks: </label>
        <select name="displayID" id="displayID">
            <?php if (count($taskIDs) > 0) {

                foreach ($results as $option) {
                    echo "<option value=''>" . $option["ID"] . "<\option>";
                }
            } else {
                echo '0 results';
            } ?>
        </select>
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
            <option value="Very Important">Very Important</option>
        </select>

        <input type="submit" value="Edit Task">
    </form>
</div>