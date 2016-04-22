<?php # forum.php

require ('../includes/config.inc.php'); 
$page_title = 'Forum';
include ('../includes/header.html');

if (isset($_SESSION['user_id'])) {
	echo "<h1>".$page_title."</h1>";
} else {
	$url = BASE_URL . 'login.php?linkedpage=forum'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
?>
<form action="post_forum.php" method="post"><fieldset class="forums">
	<legend><mark><strong>Post to forum: </strong></mark><input type=varchar id="name" name="name" placeholder="Subject" required/></legend>
	<textarea id="content" name="content" rows=2 cols=50 placeholder="Say something" required></textarea><br/>
	<input type="submit" name="submit" value="Submit" align="right">
</fieldset></form>
<table id="tablemain">
<tr>
	<th>Subject</th>
	<th>Posted by</th> 
	<th class="hide2">Posted on</th>
	<th>Replies</th>
	<th class="hide">Latest reply</th>
</tr>
<?php # write the query

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require (MYSQL);

	$s = "SELECT forums.forum_id, forums.name, users.first_name, users.last_name, forums.posted_on FROM forums, users WHERE users.user_id = forums.user_id ORDER BY forum_id DESC";
	$r = mysqli_query ($dbc, $s) or trigger_error("Query: ".$s."\n<br/>MySQL Error: " . mysqli_error($dbc));

	while ( $sql = mysqli_fetch_array ($r, MYSQLI_ASSOC) ) {

		$forum_id   = $sql["forum_id"];
		$name       = $sql["name"];
		$first_name = $sql["first_name"];
		$last_name  = $sql["last_name"];
		$posted_on  = $sql["posted_on"];

		echo "<tr>\n" ;
		echo " <td><a href=\"read.php?subject=".$name."&amp;tid=".$forum_id."\">".$name."</a></td>\n";
		echo " <td>".$first_name." ".$last_name."</td>\n";
		echo " <td class=\"hide2\">".$posted_on."</td>\n";
		$ss = "SELECT count(*) AS NumReplies FROM messages WHERE forum_id = ".$forum_id;
		$rr = mysqli_query ($dbc, $ss) or trigger_error("Query: ".$ss."\n<br/>MySQL Error: " . mysqli_error($dbc));
		if (@mysqli_num_rows($rr) == 0) {
			echo " <td>0</td>\n";
			echo " <tdclass=\"hide\">0000-00-00 0:0:0</td>\n";
		} else {
			while ( $sql2 = mysqli_fetch_array ($rr, MYSQLI_ASSOC) ) {
				$count = $sql2["NumReplies"];
				echo " <td>".$count."</td>\n";
				$sss = "SELECT MAX(date_entered) AS latest FROM messages WHERE forum_id = ".$forum_id;
				$rrr = mysqli_query ($dbc, $sss) or trigger_error("Query: ".$sss."\n<br/>MySQL Error: " . mysqli_error($dbc));
				while ( $sql3 = mysqli_fetch_array ($rrr, MYSQLI_ASSOC) ) {
					$latest = $sql3["latest"];
					echo " <td class=\"hide\">".$latest."</td>\n";
				}
			}
		}
		echo "</tr>\n";

	}
	mysqli_close($dbc);
}
?>
</table>

<?php include ('../includes/footer.html'); ?>