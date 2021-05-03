<?php
// print current login data 
include_once('header.php');
$loginInfo = $_SESSION['loginInfo'][0];
//print_r($loginInfo);

?>

<main id="profile">
	<div class="tab">
		<button class="tablinks" onclick="openTab(event, 'change_username');">Change Username</button>
		<button class="tablinks" onclick="openTab(event, 'change_password');">Change Password</button>
	</div>

	<div id="change_username" class="tabcontent">
		<!-- Change username form -->
		<form action="changeUsername.php" method="POST">


			<label for="new_username"><b>New Username</b></label>
			<input type="text" placeholder="Enter New Username" name="new_username" required>


			<label for="current_password"><b>Password</b></label>
			<input type="password" placeholder="Enter password to confirm" name="current_password" required>


			<button type="submit">Change Username</button>

		</form>
	</div>

	<div id="change_password" class="tabcontent">
		<!-- Change password form -->
		<form action="changePassword.php" method="POST">


			<label for="new_password"><b>New Password</b></label>
			<input type="password" placeholder="Enter new password" name="new_password" required>


			<label for="current_password"><b>Current Password</b></label>
			<input type="password" placeholder="Enter current password to confirm" name="current_password" required>


			<button type="submit">Change Password</button>


		</form>
	</div>
</main>
<script src="js/scripts.js"></script>
<?php
// this is where we print whatever messaage we have that we probably got from changing credentials
if (isset($_SESSION['message'])) {
	echo $_SESSION['message'];
}
?>


<!-- Just unga bunga yote this in here to make the 2 forms stand next to each other -->
<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_two_columns -->