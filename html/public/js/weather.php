<?php # weather.php

$uac = "         "; // unique access code goes here
$zipcode = $_POST["zipcode"];
//header("Content-type: application/json");

$url = "http://www.myweather2.com/developer/forecast.ashx?uac=".$uac."&output=json&query=".$zipcode."&temp_unit=F";

$weather = fopen($url, "r") or die("Could not contact $url");

$contents = "";

while ( $more = fread( $weather, 100 ) ) {
	$contents .= $more;
}

echo $contents;
?>