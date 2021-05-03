<?php

require("connection.php");
require("user.php");

$conn = new SqlConnection();
$conn->connect();
print_r($_POST);
if (
	isset($_POST["username"]) &&
	isset($_POST["password"]) &&
	isset($_POST["firstName"]) &&
	isset($_POST["lastName"]) &&
	isset($_POST["email"])
) {

	$user = new User($_POST["username"], $_POST["email"], $_POST["password"], $_POST["firstName"], $_POST["lastName"]);

	$results = $conn->registerUser($user);
	if (!empty($result)) { // Null result from runQuery, assume duplicate username

		echo "RESULT ARRAY: ";
		print_r($result);
		echo "Couldn't create Account.";
	} else { // successful name change
		echo "Account " . $_POST["username"] . " created successfully!";
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

<p><a href="login.html"> Go to Login Page </a> </p>