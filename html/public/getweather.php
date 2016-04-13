<?php # weather
require ('../includes/config.inc.php'); 
$page_title = 'Weather';
include ('../includes/header.html');

if (isset($_SESSION['user_id'])) {
	echo "<h1>".$page_title."</h1>";
} else {
	$url = BASE_URL . '../index.html'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}
?>

<script type="text/javascript" charset="utf-8">
$(document).ready( function() {

var forecast;
$("#press").click( function() {  
    // get zipcode store in javascript variable name
	var zip = $("#zip").val();
	// run ajax:
    $.ajax({
		type: 	"POST" ,
		url: 	"js/weather.php",
		data: 	"zipcode=" + zip,		             //+ and &junk=+Math.random() 
		beforeSend: function() { $("#B").html("<mark>Loading...</mark>\n<div class=\"spinner\"></div>"); },                                   //SPINNERS: http://codepen.io/collection/HtAne

		error:function(xhr, status, error) {
			alert( "Error Message: \r\nNumeric code is: " + xhr.status + " \r\nError is undefined");
		},	 //TEST THIS WITH MISSING FILE 

		success: function(result) {

			result=jQuery.parseJSON( result );

			//alert(result);
			$("#B").html("");
			forecast = "";
			forecast += "<mark>" +
				+ "<h3>" + result.weather.curren_weather[0].weather_text + "</h3><br/><br/>"
				+ "Humidity: " + result.weather.curren_weather[0].humidity + "<br/>"
				+ "Pressure: " + result.weather.curren_weather[0].pressure + "<br/>"
				+ "Temperature: " + result.weather.curren_weather[0].temp + " " + result.weather.curren_weather[0].temp_unit
				+ "</mark>";
			$("#B").html("<h2><mark>Forecast</mark></h2><br/>").append(forecast);

			console.log(result.weather.curren_weather);
		}   
	});
});

});
</script>
<mark><b>Zipcode for weather:</b></mark> <input type = text id = "zip" />
<input type=button value="Go" id="press" /><br/><br/>
<div id="B"></div>

<?php include ('../includes/footer.html'); ?>