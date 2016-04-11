<?php # view_users.php
# This is the view users page for the site.

require ('includes/config.inc.php');
$page_title = 'View users';
include ('includes/header.html');

if (isset($_SESSION['user_id'])) {
	if ($_SESSION['user_level'] == 1) {
		echo "<h1>".$page_title."</h1>";
	} else { die ("You do not have permission to see this page.</div></body></html>"); }
} else {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
?>
<script>/*
Modernizr.load( {
  test: Modernizr.inputtypes.range ,
  yep : "my_yep_script.js" ,
  nope: "my_nope_script.js"
});*/
</script>
<?php // inserts sticky_slider.php
$n = $_GET ["associated"];
include ("sticky_slider.php");
?>

<table id="tablemain">
<tr>
	<th>Id</th>
	<th>Active</th>
	<th>Name</th>
	<th>Level</th>
	<th>Email</th>
	<th>registration_date</th>
	<th>Last logged on</th>
</tr>
<?php # view_users.php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require (MYSQL);

	$x = $n * 3600;
	if ($x == 0) {
		$s = "SELECT user_id, first_name, last_name, IF(user_level=1,'Admin','User') AS `level`, email, registration_date, last_logged_on, active "
			. "FROM users ";
	} else {
		$s = "SELECT user_id, first_name, last_name, IF(user_level=1,'Admin','User') AS `level`, email, registration_date, last_logged_on, active "
			. "FROM users "
			. "WHERE UNIX_TIMESTAMP(`last_logged_on`) > UNIX_TIMESTAMP() - $x ";
	}
	$r = mysqli_query ($dbc, $s) or trigger_error("Query: ".$s."\n<br/>MySQL Error: " . mysqli_error($dbc));

	while ( $sql = mysqli_fetch_array ($r, MYSQLI_ASSOC) ) {

		$user_id           = $sql["user_id"];
		$name              = $sql["first_name"]." ".$sql["last_name"];
		$level             = $sql["level"];
		$email             = $sql["email"];
		$registration_date = $sql["registration_date"];
		$time              = $sql["last_logged_on"];
		$active            = $sql["active"];

		echo "<tr>\n" ;
		echo " <td>".$user_id."</td>\n";
		if ( $active == NULL )
			echo " <th><img src=\"images/check-mark.png\" width=\"12\" alt=\"\"/></th>\n";
		else
			echo " <td><a href=\"activate.php?id=".$user_id."&n=".$n."\">Activate</a></td>\n";
		echo " <td>".$name."</td>\n";
		echo " <td>".$level."</td>\n";
		echo " <td>".$email."</td>\n";
		echo " <td>".$registration_date."</td>\n";
		echo " <td>".$time."</td>\n";
		echo "</tr>\n";

	}
	mysqli_close($dbc);
}
?>
</table><br/>

<?php include ('includes/footer.html'); ?>