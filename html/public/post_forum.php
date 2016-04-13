<?php # post_forum.php

require ('../includes/config.inc.php');
$page_title = 'post_forum';
include ('../includes/header.html');

if (!isset($_SESSION['user_id'])) {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Need the database connection:
	require (MYSQL);
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	$user = $_SESSION['user_id'];
	$subject = mysqli_real_escape_string ($dbc, $trimmed['name']);
	$content = mysqli_real_escape_string ($dbc, $trimmed['content']);

	$qry = "INSERT INTO forums VALUES (NULL, '".$subject."', '".$content."', '".$user."', NOW())";
	$read = mysqli_query ($dbc, $qry) or trigger_error("Query: ".$qry."\n<br/>MySQL Error: " . mysqli_error($dbc));

	mysqli_close($dbc);
} // End of the main Submit conditional.

$url = BASE_URL . 'forum.php'; // Define the URL.
ob_end_clean(); // Delete the buffer.
header("Location: $url");
exit(); // Quit the script.
?>

<?php include ('../includes/footer.html'); ?>