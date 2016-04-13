<?php # index.php
// This is the main page for the site.

// Include the configuration file:
require ('../includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'Welcome to this Site!';
include ('../includes/header.html');

// Welcome the user (by name if they are logged in):
echo '<h1>Welcome';
if (isset($_SESSION['first_name'])) {
	echo ", {$_SESSION['first_name']}";
} else {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
echo '!</h1>';
?>

<div><a href="browse_prints.php" title="E-commerce">E-commerce</a></div>
<div><a href="forum.php" title="Forum">Forum</a></div>
<div><a href="getweather.php" title="Weather">Weather</a></div>
<div><a href="scraper.php" title="Image Scraping">Image Scraping</a></div>
<?php # add administrative links
if ($_SESSION['user_level'] == 1) {
	echo '<div><a href="../admin/add_artist.php" title="Forum">Add artists</a></div>';
	echo '<div><a href="../admin/add_print.php" title="Forum">Add prints</a></div>';
}
?>
<p>Spam spam spam spam spam spam
spam spam spam spam spam spam 
spam spam spam spam spam spam 
spam spam spam spam spam spam.</p>
<p>Spam spam spam spam spam spam
spam spam spam spam spam spam 
spam spam spam spam spam spam 
spam spam spam spam spam spam.</p>

<?php include ('../includes/footer.html'); ?>
