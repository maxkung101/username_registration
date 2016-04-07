<?php # weather.php

$zipcode = $_POST["zipcode"];
//header("Content-type: application/json");

//$url = "http://www.myweather2.com/developer/weather.ashx?uac=sYHOjcdmh7&uref=8734264b-1988-4d9f-92a6-db3f987e7536";
$url = "http://www.myweather2.com/developer/forecast.ashx?uac=sYHOjcdmh7&output=json&query=".$zipcode."&temp_unit=F";

$weather = fopen($url, "r") or die("Could not contact $url");

$contents = "";

while ( $more = fread( $weather, 100 ) ) {
	$contents .= $more;
}

echo $contents;
?>