<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die("Btoom");}
include_once "lib/db.php";

$gname = $_POST['gname'];

$db = connect_dbi();

$qry = $db->query("SELECT * FROM ".DB_PREFIX()."grader");
$same = 0;
// print $gname;
while($row = $qry->fetch_assoc())
{
	if($row['name'] == $gname)$same=1;
}

if(!$same){
	$qry = $db->query("INSERT INTO ".DB_PREFIX()."command (main,arg) VALUES (\"s\",\"$gname\")");
}

$rdt = "Location: console.php?gname=".$gname;
if($same){
	header($rdt."&error=same");
}
else {
	header($rdt."&error=pass");
}
$db->close();

?>
