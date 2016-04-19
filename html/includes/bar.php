<?php # bar.php
// This page completes the HTML template.
// Display links based upon the login status:
if (isset($_SESSION['user_id'])) {
	echo '<a href="../index.html" class="bar" title="Home Page"><li>Home Page</li></a>
	<a href="../public/logout.php" class="bar" title="Sign out"><li>Sign out</li></a>
<a href="../public/change_password.php" class="bar" title="Change Password"><li>Change Password</li></a>
';
	// Add links if the user is an administrator:
	if ($_SESSION['user_level'] == 1) {
		echo '<a href="../admin/view_users.php?associated=48" class="bar" title="Last Login Users"><li>Last Login Users</li></a>
		<a href="../admin/view_users.php?associated=0" class="bar" title="View All Users"><li>View All Users</li></a>';
	}
} else { //  Not logged in.
	echo '<a href="../aboutus.html" class="bar" title="About us"><li>About us</li></a>
	<a href="../contactus.html" class="bar" title="Contact us"><li>Contact us</li></a>';
}
?>