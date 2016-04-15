<?php # location.php
// This is the main page for the site.

// Include the configuration file:
require ('../includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'Welcome to this Site!';
$redirect = '<script src="js/point3.js"></script>';
include ('../includes/header.html');

// Welcome the user (by name if they are logged in):
if (isset($_SESSION['first_name'])) {
	echo "";
} else {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
?>

<div id="googleMap"></div>
<a href="#">Hacklebarney Area Map</a><br>
<a href="#">Videos</a><br>
<a href="#">Article</a><br>
<a href="#">Image</a>

<?php include ('../includes/footer.html'); ?>