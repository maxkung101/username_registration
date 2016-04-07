<?php # Script 18.6 - register.php
// This is the registration page for the site.
require ('includes/config.inc.php');
$page_title = 'Register';
include ('includes/header.html');

if (isset($_SESSION['user_id'])) {
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);

	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$fn = $ln = $e = $p = $c = FALSE;

	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}

	// Check for an email address:
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}

	// Validate the captcha input:
	if (!empty($_POST['captcha']))
	{
		if( isset($_POST["captcha"]) )
		{	
			if($_SESSION["captcha"]==$_POST["captcha"])	
				$c = TRUE;
			else {
				echo '<p class="error">CAPTHCA guess is wrong. Please try again.</p>';
			}
		}
	} else {
		echo '<p class="error">Please input what you read in the image.</p>';
	}

	if ($fn && $ln && $e && $p && $c) { // If everything's OK...

		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { // Available.

			// Create the activation code:
			$a = md5(uniqid(rand(), true));

			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date, last_logged_on) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW(), NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Send the email:
				$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@sitename.com');
				
				// Finish the page:
				echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
				include ('includes/footer.html'); // Include the HTML footer.
				exit(); // Stop the page.
				
			} else { // If it did not run OK.
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { // The email address is not available.
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
		
	} else { // If one of the data tests failed.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} // End of the main Submit conditional.
?>

<script type="text/javascript" src="../../jquery.js"></script>
<script type="text/javascript">

function FNcheck(jQuery){

	var result = true;
	var s1 = $("input#first_name");
	var h1 = s1.val();
	//var p = /^[A-Z \'.-]{2,20}$/;
	var p = /^[A-Za-z]{2,20}$/;

	if ( h1.search (p) == -1 ){
		$("#warning1").html(' The first name is invalid');
		s1.css("background-color", "#ff0000");
	} else {
		$("#warning1").html('');
		s1.css("background-color", "#ffffff");
	}

}

function LNcheck(jQuery){

	var result = true;
	var s2 = $("input#last_name");
	var h2 = s2.val();
	//var p = /^[A-Z \'.-]{2,40}$/;
	var p = /^[A-Za-z]{2,40}$/;

	if ( h2.search (p) == -1 ){
		$("#warning2").html(' The last name is invalid');
		s2.css("background-color", "#ff0000");
	} else {
		$("#warning2").html('');
		s2.css("background-color", "#ffffff");
	}

}

function Emailcheck(jQuery){
	var result = true;
	var s3 = $("input#email");
	var h3 = s3.val();
	var m = /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;

	if ( h3.search (m) == -1 ){
		$("#warning3").html(' Not a valid email address');
		s3.css("background-color", "#ff0000");
	} else {
		$("#warning3").html('');
		s3.css("background-color", "#ffffff");
	}

}

function PW1check(jQuery){

	var result = true;
	var s4 = $("input#password1");
	var h4 = s4.val();
	var pass = /^\w{4,20}$/;

	if ( h4.search (pass) == -1 ){
		$("#warning4").html(' The password is invalid');
		s4.css("background-color", "#ff0000");
	} else {
		$("#warning4").html('');
		s4.css("background-color", "#ffffff");
	}

}

function PW2check(jQuery){

	var result = true;
	var s5 = $("input#password1");
	var s6 = $("input#password2");
	var h5 = String(s5.val());
	var h6 = String(s6.val());

	if ( h6 != h5 ){
		$("#warning5").html(' Your password did not match the confirmed password!');
		s6.css("background-color", "#ff0000");
	} else {
		$("#warning5").html('');
		s6.css("background-color", "#ffffff");
	}

}

</script>

<h1><?php echo $page_title; ?></h1>
<form id="target" action="register.php" method="post">
	<fieldset>
	<p><mark><b>First Name:</b></mark><br/><input type="text" id="first_name" name="first_name" size="25" maxlength="20" onkeyup= "FNcheck()" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /><span id="warning1" class="error"></span></p>

	<p><mark><b>Last Name:</b></mark><br/><input type="text" id="last_name" name="last_name" size="25" maxlength="40" onkeyup= "LNcheck()" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /><span id="warning2" class="error"></span></p>

	<p><mark><b>Email Address:</b></mark><br/><input type="text" id="email" name="email" size="30" maxlength="60" onkeyup= "Emailcheck()" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /> <span id="warning3" class="error"></span></p>
		
	<p><mark><b>Password:</b></mark><br/><input type="password" id="password1" name="password1" size="25" maxlength="20" onkeyup= "PW1check()" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" /> <span id="warning4" class="error"></span><mark><small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></mark></p>

	<p><mark><b>Confirm Password:</b></mark><br/><input type="password" id="password2" name="password2" size="25" maxlength="20" onkeyup= "PW2check()" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" /><span id="warning5" class="error"></span></p>

	<p class="captcha_input"><h3><mark>Prove that you are a real person</mark></h3>
<?php // This script creates a captcha cookie.
if ( isset($_COOKIE["fontCookie"]) )
	{ $_SESSION["font"] = $_COOKIE["fontCookie"] ; }
else
	{ $_SESSION["font"] = "LaBelleAurore.ttf"    ; }

setcookie("fontCookie", $_SESSION["font"], time() + 3600*24*100);
?>
		<div id="captcha_input"><img src="captcha_01_image.php" id="A" width=200px height=200px/></div>
		<br />
		<br />
		<input type="text" name="captcha" size=30
			autocomplete="off" placeholder="What's in the box?" />
	</p>
	</fieldset>

	<div align="center"><input type="submit" name="submit" value="Register" /></div>

</form>

<?php include ('includes/footer.html'); ?>