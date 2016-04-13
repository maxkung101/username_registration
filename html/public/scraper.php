<style>span { font-weight: bold;  color: red; } img { width: 150; height: 100; }</style>
<?php # scraper.php

require ('../includes/config.inc.php'); 
$page_title = 'Image scraper';
include ('../includes/header.html');

if (isset($_SESSION['user_id'])) {
	echo "<h1>".$page_title."</h1>";
} else {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}

function display_images ($url) {
	$fp = fopen($url, "r")  or die("Could not contact $url");
	$contents = "";

	while (  $more = fread( $fp, 100 )  ) {
		$contents .= $more;
	}

	//echo $contents;

	//$count = preg_match_all( '/\w*([aeiou]{2})\w*/i', $contents, $matches, PREG_SET_ORDER);
	$count = preg_match_all( '<\s*A\s*HREF="([^\"]+)"\s*>([^>]*)<\/A>/i', $contents, $matches, PREG_SET_ORDER);
	print "<br/><br/>There were $count  matches";

	foreach ( $matches as $cell ){
		//print "<br/><br/>Full regex match: " . $cell[0] .  "<br/>Dipthong: <span>" . $cell[1] . "</span>" ;
		print "<br/><br/>Full regex match: " . $cell[0] . "</span>" ;

		// Each row of $matches [ named $cell here] foreach-loop runs thru
		// contains 2 cells in PREG_SET_ORDER: $cell[0] and $cell[1]

		// The 1st cell is the match to the complete regular expression
		// The 2nd cell is the match to the extracted sub-pattern (---)
	}
}
display_images( "imagetest.html" );

include ('../includes/footer.html');
?>