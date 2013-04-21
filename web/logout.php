<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Log the user out
if(isUserLoggedIn())
{
	$loggedInUser->userLogOut();
	header("Location: login.php");
}
else
{
	header("Location: login.php");
	die();
}

?>