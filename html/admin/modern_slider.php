<!-- The slider has a JSON object list of properties/values for its argument. -->
<script type="text/javascript">
function updateTextInput(val) {
	document.getElementById('associated').value=val; 
}
$(document).ready(function() {
	//THIS DEFINES THE SLIDER "DIV"
	//The following statement INITIALIZES THE SLIDER'S ASSOCIATED DISPLAY TEXT FIELD
	//to the slider's initial [current] value: $("#slide_me").slider("value")
	//The slide event handler  updates that WHENEVER THERE IS A SLIDE EVENT.
	//But without this the slider associated field is Initially empty.
	//THis is executed just once.

	//This makes a jQuery UI style button.
	$("#submit").button();
});
</script>
<form action="view_users.php">
<!--  	Associated display field for slide event handler 
		Make readonly to protect its value which is seet by slide event
		on associated slider.
-->
<table id="slide"><tr id="slideme">
<td id="slideme">
<input type="text" id="associated" readonly="readonly" name="associated" value="<?php echo $n ; ?>">
</td>
<!--  HTML UI slider reference 
A style has been added in head to determine width.
-->
<td id="slideme">
<div id="slide_me"><input id="slider1" type="range" value="<?php echo $n ; ?>" min="0" max="240" step=".1" onchange="updateTextInput(this.value);"></div>
</td>
<td id="slideme">
<!-- Rendered via $("#submit").button(); above -->
<input type="submit" id="submit" value="Go"> 
</td>
</tr></table>
</form>
