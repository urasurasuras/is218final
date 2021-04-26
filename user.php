<?php
class User {
    public $username;
    public $email;
    public $password;
    public $firstName;
    public $lastName;

   
    function __construct( $username, $email, $password, $firstName, $lastName) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    function display(){
        echo "<tr><td>".$this->username."</td><td>".$this->email."</td><td>".$this->firstName."</td><td>".$this->lastName."</td></tr>";
    }
}

?>