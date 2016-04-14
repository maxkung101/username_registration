<?php # bar.php
// This page completes the HTML template.
// Display links based upon the login status:
if (isset($_SESSION['user_id'])) {
	echo '<li><a href="../public/logout.php" class="bar" title="Logout">Logout</a></li>
<li><a href="../public/change_password.php" class="bar" title="Change Password">Change Password</a></li>
';
	// Add links if the user is an administrator:
	if ($_SESSION['user_level'] == 1) {
		echo '<li><a href="../admin/view_users.php?associated=48" class="bar" title="Last Login Users">Last Login Users</a></li>
		<li><a href="../admin/view_users.php?associated=0" class="bar" title="View All Users">View All Users</a></li>';
	}
} else { //  Not logged in.
	echo '<li><a href="../public/register.php" class="bar" title="Register">Register</a></li>
<li><a href="../public/login.php" class="bar" title="Login">Login</a></li>
<li><a href="../public/forgot_password.php" class="bar" title="Retrieve Password">Retrieve Password</a></li>
';
}
?>