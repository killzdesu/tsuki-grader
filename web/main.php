<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die("Btoom");}

    // namespace
    //use Rain\Tpl;

	// include
	//include "lib/Tpl.php";
	include "lib/rain.tpl.class.php";

	// config
	$config = array(
					"base_url"      => null,
					"tpl_dir"       => "template/",
					"cache_dir"     => "cache/",
					"debug"         => true, // set to false to improve the speed
				   );

	raintpl::configure( $config );

	// Add PathReplace plugin
	//require_once('lib/Tpl/Plugin/PathReplace.php');
	//Rain\Tpl::registerPlugin( new Rain\Tpl\Plugin\PathReplace() );
	$tmpl = new RainTPL();
	$vtmpl = array('content'=>"temp");
	$admin = 0;
	if ($loggedInUser->checkPermission(array(0=>2))){ 
		$admin = 1;
	}
	$vtmpl += array('admin'=>$admin);
	$vtmpl += array("dname"=>$_SESSION['userCakeUser']->displayname);
	$vtmpl += array('now'=>"home");
	$tmpl->assign($vtmpl);
	$tmpl->draw('layout');
?>
