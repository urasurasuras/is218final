<?php
class Task {
    public $id;
    public $username;
    public $title;
    public $description;
    public $due;
    public $urgency;
    public $completion;

   
    function __construct($username, $title, $description, $due, $urgency,  $id = NULL, $completion = false) {
        $this->username = $username;
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->due = $due;
        $this->urgency = $urgency;
        $this->completion = $completion;
    }

    
}

?>