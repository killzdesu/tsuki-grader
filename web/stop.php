<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die("Btoom");}
include_once "lib/db.php";

$gname = $_POST['gname'];

$db = connect_dbi();

$qry = $db->query("SELECT * FROM ".DB_PREFIX()."grader WHERE name=\"$gname\"");
$same = 0;
if($qry->num_rows > 0)$same = 1;

if($same){
	$qry = $db->query("INSERT INTO ".DB_PREFIX()."command (main,arg) VALUES (\"k\",\"$gname\")");
}

$rdt = "Location: console.php?gname=".$gname;
if(!$same){
	header($rdt."&error=not");
}
else {
	header($rdt."&error=stopped");
}
close_db();

?>
