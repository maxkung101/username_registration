<?php # bar.php
// This page completes the HTML template.
// Display links based upon the login status:
if (isset($_SESSION['user_id'])) {
	echo '<a href="../public/logout.php" class="bar" title="Logout"><li>Logout</li></a>
<a href="../public/change_password.php" class="bar" title="Change Password"><li>Change Password</li></a>
';
	// Add links if the user is an administrator:
	if ($_SESSION['user_level'] == 1) {
		echo '<a href="../admin/view_users.php?associated=48" class="bar" title="Last Login Users"><li>Last Login Users</li></a>
		<a href="../admin/view_users.php?associated=0" class="bar" title="View All Users"><li>View All Users</li></a>';
	}
} else { //  Not logged in.
	echo '<a href="../public/register.php" class="bar" title="Register"><li>Register</li></a>
<a href="../public/login.php" class="bar" title="Login"><li>Login</li></a>
<a href="../public/forgot_password.php" class="bar" title="Retrieve Password"><li>Retrieve Password</li></a>
';
}
?>