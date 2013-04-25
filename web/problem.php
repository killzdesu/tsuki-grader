<?php
include "lib/rain.tpl.class.php";
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
include_once "lib/db.php";

	// config
	$config = array(
					"base_url"      => null,
					"tpl_dir"       => "template/",
					"cache_dir"     => "cache/",
					"debug"         => true, // set to false to improve the speed
				   );

	raintpl::configure( $config );
	
	$tmpl = new RainTPL();
	$vtmpl = array("content"=>"prob_list");
	$admin = 0;
	if ($loggedInUser->checkPermission(array(0=>2))){ 
		$admin = 1;
	}
	
	$vtmpl += array('admin'=>$admin);
	/* ----- Old MySQL
	connect_db();
	$qry = mysql_query("SELECT * FROM ".DB_PREFIX()."prob_info");
	$rows = mysql_num_rows($qry);
	//*
	$res = array();
	for($i = 0;$i < $rows;$i++)
	{
		$pid = mysql_result($qry,$i,'id');
		$name = mysql_result($qry,$i,'name');
		$fname = mysql_result($qry,$i,'fullname');
		array_push($res,array("id"=>$pid,"name"=>$name,"fullname"=>$fname));
	}
	close_db();
	//*/
	
	$db = connect_dbi();
	$qry = "SELECT * FROM ".DB_PREFIX()."prob_info";
	$res = array();
	if( $result = $db->query($qry))
	{
		while($row = $result->fetch_assoc())
		{
			// array_push($res, $row);
			$res[] = $row;
		}
		$result->free();
	}
	$db->close();
	
	$vtmpl += array("prob_info"=>$res);
	$vtmpl += array("dname"=>$_SESSION['userCakeUser']->displayname);
	$vtmpl += array('now'=>"prob");
	$tmpl->assign($vtmpl);
	$tmpl->draw('layout');
?>
