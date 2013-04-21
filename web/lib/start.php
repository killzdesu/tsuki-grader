<?php
die("ffff");
//require_once "lib/rain.tpl.class.php";
//if (!securePage($_SERVER['PHP_SELF'])){die();}
die("fuck");
include_once "lib/db.php";
die("grad");
$gname = $_POST['gname'];

connect_db();
die("grad");
$qry = mysql_query("SELECT * FROM grader");
$rows = mysql_num_rows($qry);
$same = 0;
for($i=0;$i<$rows;$i++)
{
	if(mysql_result($qry,$i,'grader') == $gname)$same=1;
}
if($same){
	header("Location: console.php&error='same'");
}
else {
	header("Location: console.php&error='not'");
}
close_db();

?>x