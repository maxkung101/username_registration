<?php # post_comment.php

require ('../includes/config.inc.php');
$page_title = 'post_comment';
include ('../includes/header.html');

if (!isset($_SESSION['user_id'])) {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}

$forum        = $_GET['forumId'];
$forumsubject = $_GET['subject'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Need the database connection:
	require (MYSQL);
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	$user = $_SESSION['user_id'];
	$comment = mysqli_real_escape_string ($dbc, $trimmed['comment']);

	$qry = "INSERT INTO messages VALUES (NULL, '".$comment."', NOW(), ".$user.", ".$forum.")";
	$read = mysqli_query ($dbc, $qry) or trigger_error("Query: ".$qry."\n<br/>MySQL Error: " . mysqli_error($dbc));

	mysqli_close($dbc);
} // End of the main Submit conditional.

$url = BASE_URL . 'read.php?subject='.$forumsubject.'&tid='.$forum; // Define the URL.
ob_end_clean(); // Delete the buffer.
header("Location: $url");
exit(); // Quit the script.
?>

<?php include ('../includes/footer.html'); ?>