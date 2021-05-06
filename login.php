<?php

require("connection.php");
require("user.php");

session_start();

if (isset($_SESSION['loginInfo'])){
    echo "sadljbasjhd";
	header("Location: home.php");
}
else{

    $conn = new SqlConnection();
    $conn->connect();
    $loginInfo = $conn->doLogin($_POST["username"], $_POST["password"]);
    print_r($loginInfo);

    if (!empty($loginInfo)){

        echo "Logged in as: ";
        $_SESSION['loginInfo'] = $loginInfo;
        // $_SESSION['loggedIn'] = $loggedIn;

        // if we logged in, proceed to home
        header("Location: home.php");
    }
    else {
        echo "Could not login, try again";
    }
}
// $userFound = $conn->findUserName($_GET["username"]);
// $emailFound = $conn->findEmail($_GET["email"]);

?>

<p><a href="loginForm.php"> Go back to Login Page </a> </p> <!-- kinda wanna do this in a way that it goes back to the login page but says the error -->