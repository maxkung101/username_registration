<?php # logout.php
# This is the logout page for the site.

require ('../includes/config.inc.php'); 
$page_title = 'Logout';
$redirect = '<meta http-equiv="refresh" content="5;url=../index.html">';
include ('../includes/header.html');

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {

	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.

} else { // Log out the user.

	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-3600); // Destroy the cookie.

} // Print a customized message:
?>
<h3>You are now logged out.</h3>
You will be redirected to the main page in 5 seconds. If not, then click <a href="../index.html">here</a>.
<?php include ('../includes/footer.html'); ?>
