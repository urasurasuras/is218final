<?php

require("connection.php");
require("user.php");
session_start();

$conn = new SqlConnection();
$conn->connect();
print_r($_POST);
echo "<br>";
if (
	isset($_POST["username"]) &&
	isset($_POST["password"]) &&
	isset($_POST["firstName"]) &&
	isset($_POST["lastName"]) &&
	isset($_POST["email"])
) {

	$messages = array();

	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];

	if (!preg_match("/^([^0-9]*)$/", $firstName ) ||
	!preg_match("/^([^0-9]*)$/", $lastName))	{

		array_push($messages, "Firstname and lastname can only have letters");
	}
	if (preg_match("/[&=_'+,<>-]/", $username ) ||
		preg_match("/[.]{2,}/", $username)){

		array_push($messages, "Username cannot ahve VASHDGASJK");
	}
	if (!preg_match("(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$)", $password )){

		array_push($messages, "Password must have 1 uppercase, 1 lowercase");
	} 
	if (strlen($password) > 30){

		array_push($messages, "Password cannot be longer than 30 characters");
	}
	else if (strlen($password) < 8 ){

		array_push($messages, "Password cannot be shorter than 8 characters");
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		array_push($messages, "Invalid email address");
	}

	print_r($messages);

	if (!empty($messages)){
		$_SESSION['message'] = $messages;
		// echo $_SESSION['message'];
		header("Location: loginForm.php");
	}
	else{
		
		$user = new User($_POST["username"], $_POST["email"], $_POST["password"], $_POST["firstName"], $_POST["lastName"]);

		$results = $conn->registerUser($user);
		if (!empty($result)) { // Null result from runQuery, assume duplicate username

			echo "RESULT ARRAY: ";
			print_r($result);
			array_push($messages, "Couldn't create account, try another username.");

			header("Location: loginForm.php");
		} else { // successful name change
			echo "Account " . $_POST["username"] . " created successfully!";
			header("Location: home.php");
		}
	}
}

if (!empty($_POST["remember"])) {
	setcookie("username", $_POST["username"], time() + 3600);
	setcookie("password", $_POST["password"], time() + 3600);
	echo "Cookies Set Successfuly";
} else {
	setcookie("username", "");
	setcookie("password", "");
	echo "Cookies Not Set";
}

?>

<p><a href="loginForm.php"> Go to Login Page </a> </p>