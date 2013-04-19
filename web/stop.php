<?php
include_once "lib/rain.tpl.class.php";
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die("Btoom");}
include_once "lib/db.php";
//die("grad");
$gname = $_POST['gname'];

connect_db();

$qry = mysql_query("SELECT * FROM grader WHERE name=\"$gname\"");
$rows = mysql_num_rows($qry);
$same = 0;
if($rows > 0)$same = 1;

if($same){
	$qry = mysql_query("INSERT INTO command (main,arg) VALUES (\"k\",\"$gname\")");
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