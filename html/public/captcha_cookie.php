<?php session_start() ;

if ( isset($_GET["menuChoice"]) && $_GET["menuChoice"] != "" )
{
	$_SESSION["font"] = $_GET["menuChoice"];
}
elseif ( isset($_COOKIE["fontCookie"]) )
{
	 $_SESSION["font"] = $_COOKIE["fontCookie"];
}
else
{
	 $_SESSION["font"] = "LaBelleAurore.ttf";
}
setcookie("fontCookie", $_SESSION["font"], time() + 3600*24*100);
?>
