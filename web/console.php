<?php
include "lib/rain.tpl.class.php";
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$error = "";
$gname = "";
if(!empty($_GET['error']))
	$error = $_GET['error'];
// Fix this to be POST -----------***
if(!empty($_GET['gname']))
	$gname = $_GET['gname'];

// config
$config = array(
	"base_url"      => null,
	"tpl_dir"       => "template/",
	"cache_dir"     => "cache/",
	"debug"         => true, // set to false to improve the speed
	);

raintpl::configure( $config );
	
$tmpl = new RainTPL();
$vtmpl = array("content"=>"cmd");
$vtmpl += array("dname"=>$_SESSION['userCakeUser']->displayname);
$vtmpl += array('now'=>"prob");
$vtmpl += array('err'=>$error);
$vtmpl += array('gname'=>$gname);
$tmpl->assign($vtmpl);
$tmpl->draw('layout');
?>