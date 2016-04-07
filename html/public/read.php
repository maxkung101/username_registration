<?php # read.php
require ('includes/config.inc.php');
$subject = $_GET ["subject"];
$page_title = 'Forum post: '.$subject;
include ('includes/header.html');

if (isset($_SESSION['user_id'])) {
	$tid = $_GET ["tid"];
} else {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
?>

<h2><?php echo $subject;?></h2>
<fieldset>
<?php // displays the forum body

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require (MYSQL);

	$s = "SELECT forums.content, users.first_name, users.last_name FROM forums, users WHERE users.user_id = forums.user_id AND forums.forum_id = ".$tid;
	$r = mysqli_query ($dbc, $s) or trigger_error("Query: ".$s."\n<br>MySQL Error: ".mysqli_error($dbc));
	while ( $sql = mysqli_fetch_array ($r, MYSQLI_ASSOC) ) {
		echo '<div id="thread"><strong>'.$sql["first_name"].' '.$sql["last_name"].'</strong><br>';
		echo '<div id="comment">'.$sql["content"].'</div></div>';
	}
?>
<br><hr>
<?php // write the query

	$ss="SELECT messages.user_id, users.first_name, users.last_name, messages.body FROM messages, users WHERE users.user_id=messages.user_id AND messages.forum_id = ".$tid;
	$rr = mysqli_query ($dbc, $ss) or trigger_error("Query: ".$ss."\n<br>MySQL Error: ".mysqli_error($dbc));
	while ( $sql2 = mysqli_fetch_array ($rr, MYSQLI_ASSOC) ) {

		$person = $sql2["first_name"]." ".$sql2["last_name"];
		$body   = $sql2["body"];

		echo '<div id="thread"><strong>'.$person.'</strong><br>';
		echo '<div id="comment">'.$body.'</div></div><br>';
	}
}
?>

</fieldset><br>
<h3>Write a comment</h3>
<form action="post_comment.php?forumId=<?php echo $tid; ?>&amp;subject=<?php echo $subject; ?>" method="post">
<textarea name="comment" id="comment" required rows=10 cols=100 placeholder=""></textarea><br/>
<input type="submit" name="submit" value="Submit"/>
</form>

<?php include ('includes/footer.html'); ?>