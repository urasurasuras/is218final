<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<div class="row">

<!-- Login form  -->
<form action="login.php" method="POST">

	<div class="column">
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="username" required>
		<br>

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required>
		<br>

		<button type="submit">Login</button>
	</div>

</form>

<!-- Register form -->
<form action="register.php" method="POST">

	<div class="column">

		<label for="firstName"><b>First Name</b></label>
		<input type="text" placeholder="Enter First Name" name="firstName" required
		>

		<br>

		<label for="lastName"><b>Last Name</b></label>
		<input type="text" placeholder="Enter Last Name" name="lastName" required
		>

		<br>
		
		<label for="username"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="username" required
		>
	
		<br>
		
		<label for="password"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required
		>
		<!-- https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a -->
		
	
		<br>
		
		<label for="email"><b>E-mail</b></label>
		<input type="email" placeholder="Enter E-mail" name="email" required>
		
		<!-- https://www.w3schools.com/tags/att_input_pattern.asp -->

		<br>
		
		<button type="submit">Register</button>

		<?php
			session_start();
			// print_r($_SESSION);

			if (!empty($_SESSION['message'])){
				$messages = $_SESSION['message'];
				// echo $_SESSION['message'][0];
				// for ($i=0; $i < count($messages); $i++) { 
				// 	echo $_SESSION['message'][$i];
				// 	echo "<br>";
				// }
				foreach ($messages as $item) {
					echo $item;
					echo "<br>";
				}
			}
			$_SESSION['message'] ="";
		?>
	</div>
</form>
</div>


<!-- Just unga bunga yote this in here to make the 2 forms stand next to each other -->
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_two_columns -->
<style>

	* {
		  box-sizing: border-box;
		}
		
		/* Create two equal columns that floats next to each other */
		.column {
		  float: left;
		  width: 50%;
		  padding: 10px;
		  height: 300px; /* Should be removed. Only for demonstration */
		}
		
		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
	</style>