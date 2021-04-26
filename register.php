<?php

require("connection.php");
require("user.php");

$conn = new SqlConnection();
$conn->connect();

if (isset($_GET["username"]) && 
    isset($_GET["password"]) &&
    isset($_GET["firstName"]) &&
    isset($_GET["lastName"]) &&
    isset($_GET["email"]) 
    ){

    $user = new User($_GET["username"], $_GET["email"], $_GET["password"], $_GET["firstName"], $_GET["lastName"]);

	$sql = "INSERT INTO `users`(`username`, `email`, `password`, `LastName`, `FirstName`) VALUES ('$user->username', '$user->email','$user->password', '$user->lastName', '$user->firstName')";
    echo $sql;
	$conn->runQuery($sql);
	// $results = $conn->runQuery($sql);

	// print_r( $results );
}

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