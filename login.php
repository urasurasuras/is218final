<?php

require("connection.php");
require("user.php");

session_start();

if (isset($_SESSION['loggedIn'])){
	header("Location: home.php");
}
else{

    $conn = new SqlConnection();
    $conn->connect();
    $loggedIn = $conn->doLogin($_POST["username"], $_POST["password"]);

    if (!empty($loggedIn)){

        echo "Logged in as: ";
        $_SESSION['loggedIn'] = $loggedIn;

        header("Location: home.php");
    }
    else {
        echo "Could not lotign";
    }
}
// $userFound = $conn->findUserName($_GET["username"]);
// $emailFound = $conn->findEmail($_GET["email"]);

?>

<p><a href="login.php"> Go to Login Page </a> </p>