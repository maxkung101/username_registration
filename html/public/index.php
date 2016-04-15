<?php # index.php
// This is the main page for the site.

// Include the configuration file:
require ('../includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'Welcome to this Site!';
$redirect = '<script src="js/point.js"></script>';
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
<div id="largemap">
<script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=0fzgbxscsjv&amp;m=7&amp;s=320&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
</div>
<div id="mediummap">
<script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=04obpvtejkd&amp;m=7&amp;s=270&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
</div>
<div id="smallmap">
<script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=04obpvtejkd&amp;m=7&amp;s=220&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
</div>
<div id="googleMap"></div>
<p>Spam spam spam spam spam spam
spam spam spam spam spam spam 
spam spam spam spam spam spam 
spam spam spam spam spam spam.</p>
<p>Spam spam spam spam spam spam
spam spam spam spam spam spam 
spam spam spam spam spam spam 
spam spam spam spam spam spam.</p>

<?php include ('../includes/footer.html'); ?>