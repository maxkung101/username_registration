<?php # Script 18.7 - activate.php
// This page activates the user's account.
require ('includes/config.inc.php'); 
$page_title = 'Activate Users Account';
include ('includes/header.html');

if ( isset($_GET['id'], $_GET['n']) ) {
	// Update the database...
	require (MYSQL);
	$q = "UPDATE users SET active=NULL WHERE (user_id=" . $_GET['id'] . ") LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));

	mysqli_close($dbc);

	$url = BASE_URL . 'view_users.php?associated='.$_GET['n']; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.

} else { // Redirect.

	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.

} // End of main IF-ELSE.

include ('includes/footer.html');
?>