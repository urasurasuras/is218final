<?php
	// print current login data 
	session_start();
	$loginInfo = $_SESSION['loginInfo'][0];
	print_r($loginInfo);
?>

<div class="row">
<!-- Change username form -->
<form action="changeUsername.php" method="POST">
<div class="column">

	<label for="new_username"><b>New Username</b></label>
	<input type="text" placeholder="Enter New Username" name="new_username" required>

	<br>
	
	<label for="current_password"><b>Password</b></label>
	<input type="password" placeholder="Enter password to confirm" name="current_password" required>	

	<br>
	
	<button type="submit">Change Username</button>
</div>
</form>

<!-- Change password form -->
<form action="changePassword.php" method="POST">
	<div class="column">
	
	<label for="new_password"><b>New Password</b></label>
	<input type="password" placeholder="Enter new password" name="new_password" required>

	<br>

	<label for="current_password"><b>Current Password</b></label>
	<input type="password" placeholder="Enter current password to confirm" name="current_password" required>

	<br>
	
	<button type="submit">Change Password</button>
	</div>

</form>
</div>


	<?php
		// this is where we print whatever messaage we have that we probably got from changing credentials
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