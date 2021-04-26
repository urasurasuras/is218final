<?php

require("connection.php");
require("user.php");

$conn = new SqlConnection();
$conn->connect();
$loggedIn = $conn->doLogin($_POST["username"], $_POST["password"]);
// $userFound = $conn->findUserName($_GET["username"]);
// $emailFound = $conn->findEmail($_GET["email"]);


if(!empty($_POST["remember"])) {
	setcookie ("username",$_POST["username"],time()+ 3600);
	setcookie ("password",$_POST["password"],time()+ 3600);
	echo "Cookies Set Successfuly";
} else {
	setcookie("username","");
	setcookie("password","");
	echo "Cookies Not Set";
}

?>

<p><a href="login.php"> Go to Login Page </a> </p>