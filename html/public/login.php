<?php # login.php
# This is the login page for the site.

require ('../includes/config.inc.php'); 
$page_title = 'Sign in';
include ('../includes/header.html');

if (isset($_SESSION['first_name'])) {
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email']);
	} else {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your username or email address!</p>';
	}
	
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}

	// Validate the captcha input:
	$c = TRUE;/*if (!empty($_POST['captcha']))
	{
		if( isset($_POST["captcha"]) )
		{	
			if($_SESSION["captcha"]==$_POST["captcha"])	
				$c = TRUE;
			else {
				$c = FALSE;
				echo '<p class="error">CAPTHCA guess is wrong. Please try again.</p>';
			}
		}
	} else {
		$c = FALSE;
		echo '<p class="error">Please input what do you see in the box.</p>';
	}*/

	if ($e && $p && $c) { // If everything's OK.

		// Query the database:
		$q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$qq = "UPDATE users SET last_logged_on = NOW() WHERE email ='$e' LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		$rr = mysqli_query ($dbc, $qq) or trigger_error("Query: $qq\n<br />MySQL Error: " . mysqli_error($dbc));

		if (@mysqli_num_rows($r) == 1) { // A match was made.
			// cookie
			$choice = $_POST ["choice"];
			if ($choice == "remember") {
				setcookie("email",    $e, time()+3600*24*100);
				setcookie("password", $p, time()+3600*24*100);
			}
			elseif ($choice == "forget") {
				setcookie("email",    "", time()-3600*24*100);
				setcookie("password", "", time()-3600*24*100);
			}

			// Register the values:
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($dbc);

			// Redirect the user:
			$url = BASE_URL . 'index.php'; // Define the URL.
			ob_end_clean(); // Delete the buffer.
			header("Location: $url");
			exit(); // Quit the script.

		} else { // No match was made.
			echo '<p class="error">Invalid email address or password, or you have not yet activated your account.</p>';
		}

	} else { // If everything wasn't OK.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} // End of SUBMIT conditional.
?>

<h1><?php echo $page_title; ?></h1>
<form action="login.php" method="post">
<fieldset>
<legend><mark>Your browser must allow cookies in order to log in.</mark></legend>
<?php # This script creates a cookie.

if (isset($_COOKIE["email"]) && isset($_COOKIE["password"]))
	echo "<p><mark><b>Username or email:</b></mark><br/><input type=\"text\" name=\"email\" size=\"25\" maxlength=\"60\" value=".$_COOKIE["email"]."/> <mark><a href=\"register.php\" title=\"Create account\">Create account</a></mark></p>\n\t"
	   . "<p><mark><b>Password:</b></mark><br/><input type=\"password\" name=\"pass\" size=\"25\" maxlength=\"20\" value=".$_COOKIE["password"]."/> <mark><a href=\"forgot_password.php\" title=\"I forgot my password.\">I forgot my password.</a></mark></p>\n\t"
	   . "<p><input type=\"checkbox\" name=\"choice\" value=\"forget\"/><mark>Forget my username and password</mark></p>\n";
else
	echo "<p><mark><b>Username or email:</b></mark><br /><input type=\"text\" name=\"email\" size=\"25\" maxlength=\"60\"/> <mark><a href=\"register.php\" title=\"Create account\">Create account</a></mark></p>\n\t"
	   . "<p><mark><b>Password:</b></mark><br/><input type=\"password\" name=\"pass\" size=\"25\" maxlength=\"20\"/> <mark><a href=\"forgot_password.php\" title=\"I forgot my password.\">I forgot my password.</a></mark></p>\n\t"
	   . "<p><input type=\"checkbox\" name=\"choice\" value=\"remember\"/><mark>Remember my username and password</mark></p>\n";
?>
<!--<p class="captcha_input"><h3><mark>Prove that you're not a robotic impostor</mark></h3>
<?php # This script creates a captcha cookie.

if ( isset($_COOKIE["fontCookie"]) )
	{ $_SESSION["font"] = $_COOKIE["fontCookie"] ; }
else
	{ $_SESSION["font"] = "LaBelleAurore.ttf"    ; }

setcookie("fontCookie", $_SESSION["font"], time() + 3600*24*100);
?>
<div id="captcha_input"><img src="captcha_01_image.php" id="A" width=200px height=200px/></div><br/><br/>
<input type="text" name="captcha" size=30 autocomplete="off" placeholder="What's in the box?">
</p>-->
<div align="center"><input type="submit" name="submit" value="Login" /></div>
</fieldset>
</form>

<?php include ('../includes/footer.html'); ?>