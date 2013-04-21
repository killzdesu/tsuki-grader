<?php
include_once "lib/rain.tpl.class.php";
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die("Btoom");}
include_once "lib/db.php";
//die("grad");
$gname = $_POST['gname'];

connect_db();

$qry = mysql_query("SELECT * FROM grader");
$rows = mysql_num_rows($qry);
$same = 0;
print $gname;
for($i=0;$i<$rows;$i++)
{
	if(mysql_result($qry,$i,'name') == $gname)$same=1;
}

if(!$same){
	$qry = mysql_query("INSERT INTO command (main,arg) VALUES (\"s\",\"$gname\")");
}

$rdt = "Location: console.php?gname=".$gname;
if($same){
	header($rdt."&error=same");
}
else {
	header($rdt."&error=pass");
}
close_db();

?>