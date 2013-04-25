<?php

	/*
	define("MYSQL_HOST", "110.77.143.212");
	define("DB_LOCAL", "127.0.0.1");
	define("MYSQL_USER", "boardjui");
	define("MYSQL_PASSWD", "jui95");
	define("MYSQL_DATABASE", "boardjui");
	define("MYSQL_PREFIX", "tsk_");
	//*/
	//*
	define("MYSQL_HOST", "127.0.0.1");
	define("DB_LOCAL", "127.0.0.1");
	define("MYSQL_USER", "tkg");
	define("MYSQL_PASSWD", "tsuki22");
	define("MYSQL_DATABASE", "tsuki");
	define("MYSQL_PREFIX", "tsk_");
	//*/

function DB_PREFIX()
{
	return MYSQL_PREFIX;
}

function connect_dbi()
{
	$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWD);
	if(mysqli_connect_errno()) {
		echo "Connection Failed: " . mysqli_connect_errno();
		exit();
	}
	$mysqli->select_db(MYSQL_DATABASE);
	$mysqli->set_charset(“utf8″);
	return $mysqli;
}

function connect_db()
{
  global $myserv;

  $myserv = mysql_connect("127.0.0.1",MYSQL_USER,MYSQL_PASSWD);

   if(!$myserv){
            print "Can't connect to database";
            exit();
        }
		
	else {
	}
  mysql_select_db(MYSQL_DATABASE);
  mysql_query("SET NAMES UTF8");
}

function close_db()
{
  global $myserv;

  mysql_close($myserv);
}

//connect_db();
//close_db();

?>
