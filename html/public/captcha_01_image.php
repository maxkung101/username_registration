<?php session_start() ;

function _generateRandom($length=6)
{
	$_rand_src = array(
		  array(48,57)  //digits
		, array(97,122) //lowercase letters
  		, array(65,90)  //uppercase letters

			//makes 3x2 array:
			//  48  57
			//  97  122
			//  65  90
	); 

	srand ( (double) microtime() * 1000000 );  	// random seed for the function 
												//     rand(a,b)  
												// which is used below.
												// As of PHP4.2+ the seed is not required 
												// but is included here because it's interesting.
	$random_string = "";

	for($i=0;$i<$length;$i++)
	{
	    $K=rand(0, sizeof( $_rand_src ) - 1);	//$K lies on [0, 2]

		$random_string .= chr( rand( $_rand_src[$K][0], $_rand_src[$K][1]) );
	}

	return $random_string;
}

//SET ENVIROMENT VARIABLE FOR GD [WIDELY USED GRAPHICS LIBRARY]
putenv('GDFONTPATH=' . realpath('.') );

//TO ACCESS SUBDIRECTORY OF FONT FILES
//putenv('GDFONTPATH=' . realpath('.') . '/fonts');

//NAME FONT TO USE - NO .TTF EXTENSION.
//$font = 'LaBelleAurore.ttf';
$font = $_SESSION["font"];

//SET content-type header FOR OUTPUT IMAGE
//SENT BEFORE ANY OTHER OUTPUT

header('Content-Type: image/png');

//CREATE IMAGE RECTANGLE
$im 	= imagecreatetruecolor(144, 144);

//CREATE SOME COLORS
$white 		= imagecolorallocate($im, 255, 255, 255);
$greyish 	= imagecolorallocate($im, 215, 215, 215);
$black 		= imagecolorallocate($im,   0,   0,   0);

imagefilledrectangle($im, 3, 3, 140, 140, $greyish);

//CAPTCHA TEXT TO DRAW ON IMAGE
$rand = _generateRandom(6);
//$text 	= 'Testing...Hello';
$text = $rand;

//SESSION VARIABLE SHARED WITH FORM SCRIPT
$_SESSION["captcha"] = $text;

//ADD SHADOW TO TEXT
imagettftext( $im, 20,  45, 26, 70, $white, $font, $text[0].$text[1].$text[2] );
imagettftext( $im, 20, -45, 80, 75, $white, $font, $text[3].$text[4].$text[5] );

//ADD THE TEXT [OVERLAYS THE ABOVE 'SHADOW' TEXT!]
imagettftext( $im, 20,  45, 25, 69, $black, $font, $text[0].$text[1].$text[2] );
imagettftext( $im, 20, -45, 79, 74, $black, $font, $text[3].$text[4].$text[5] );

//TRANSMIT IMAGE TO BROWSER. 
//USING IMAGEPNG() RESULTS IN CLEARER TEXT COMPARED WITH IMAGEJPEG()

imagepng($im);

//DESTROY SERVER-SIDE STORAGE FOR IMAGE

imagedestroy($im);
?>