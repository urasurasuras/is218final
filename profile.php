<?php
	// print current login data 
	session_start();
	$loginInfo = $_SESSION['loginInfo'][0];
	print_r($loginInfo);
?>

<!-- Change username form -->
<form action="changeUsername.php" method="POST">
<div class="column">

	<label for="new_username"><b>Username</b></label>
	<input type="text" placeholder="Enter New Username" name="new_username" required>

	<br>
	
	<label for="current_password"><b>Password</b></label>
	<input type="password" placeholder="Enter Password" name="current_password" required>	

	<br>
	
	<button type="submit">Change Username</button>
</div>
</form>

<!-- Change password form -->
<form action="changePassword.php" method="POST">
	<div class="column">

	<label for="username"><b>Username</b></label>
	<input type="text" placeholder="Enter Username" name="username" required>

	<br>
	
	<label for="current_password"><b>Current Password</b></label>
	<input type="password" placeholder="Enter Password" name="current_password" required>

	<br>

	<label for="new_password"><b>New Password</b></label>
	<input type="password" placeholder="Enter Password" name="new_password" required>

	<br>
	
	<button type="submit">Change Password</button>
	</div>

</form>


	<?php
		// session_start();
		if (isset($_SESSION['message'])){
			echo $_SESSION['message'];
		}		
	?>
	

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