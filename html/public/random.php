<?php //session_start();

/*
Randomly generates integers from several different "ranges"
The ranges correspond 
via the ASCII representation to the numeric representations for:
   digits, upper case, and lower case letters.
Then it  concatenates these together to make the random string.
*/

function _generateRandom($length=6) {
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

	for ( $i=0; $i<$length; $i++ ) {
	    $K=rand(0, sizeof( $_rand_src ) - 1);	//$K lies on [0, 2]
		$random_string .= chr( rand( $_rand_src[$K][0], $_rand_src[$K][1]) );
	}

	return $random_string;
}

$rand = _generateRandom(8);
echo "<br />Random characters:  $rand " ; 
echo "<br />Single random character:  $rand[1] " ; 
?> 
