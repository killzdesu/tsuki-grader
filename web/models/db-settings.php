<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/
include_once "lib/db.php";
//Database Information
$db_host = MYSQL_HOST; //Host address (most likely localhost)
$db_name = MYSQL_DATABASE; //Name of Database
$db_user = MYSQL_USER; //Name of database user
$db_pass = MYSQL_PASSWD; //Password for database user
$db_table_prefix = DB_PREFIX()."uc_";

GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();

/* Create a new mysqli object with database connection parameters */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
GLOBAL $mysqli;

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

//Direct to install directory, if it exists
if(is_dir("install/"))
{
	header("Location: install/");
	die();

}

?>
