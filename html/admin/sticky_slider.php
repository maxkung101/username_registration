<!-- The slider has a JSON object list of properties/values for its argument. -->
<script type="text/javascript"> 
$(document).ready(function() {
	//THIS DEFINES THE SLIDER "DIV"
	$("#slide_me").slider(
		{
			value: 	"<?php echo $n ; ?>" ,  //50   STEP SIZE AFFECTS TOO!
			//FOR STICKY FORM
			//THE $x HAS TO BE ALREADY DEFINED BY PRECEDING PHP
			//SO SAY THIS JS CODE CAN COME AFTER THAT

			min: 	0	,
			max: 	24 * 10	,
			step:	.1	,	//can also use arrows to step thru values
			                //but have to click (to select?) slider 
							//first.
			orientation:  'horizontal' ,
			/*
			slide event handler
			The term event is keyword for original JS  browser events and has properties 
			like location & time of event, charCode, etc.
			The ui object is an additional jQuery UI object that allows access to 
			additional information.  In particular: 
						ui.value 
			is the value selected in slider on slide event.
			If the stepes are tiny there may be millions of possible values!
			You can arrow through values (after clicking the slider or field).

			The JS "event" object is requied for the callback handler
			even though the code itself here only refers to ui.
			http://docs.jquery.com/UI/Slider
			http://jqueryui.com/demos/slider/
			*/
			slide: function (  event, ui ) {
				var temp = ui.value ;
				$("#associated").val(temp);
			}
		}
	);
	//The following statement INITIALIZES THE SLIDER'S ASSOCIATED DISPLAY TEXT FIELD
	//to the slider's initial [current] value: $("#slide_me").slider("value")
	//The slide event handler  updates that WHENEVER THERE IS A SLIDE EVENT.
	//But without this the slider associated field is Initially empty.
	//THis is executed just once.

	$("#associated").val( $("#slide_me").slider("value") );

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
<input type="text" id="associated" readonly="readonly" name="associated">
</td>
<!--  HTML UI slider reference 
A style has been added in head to determine width.
-->
<td id="slideme">
<div id="slide_me"></div>
</td>
<td id="slideme">
<!-- Rendered via $("#submit").button(); above -->
<input type="submit" id="submit" value="Go" /> 
</td>
</tr></table>
</form>
