<?php
	
	define("MYSQL_USER","tkg");
	define("MYSQL_PASSWD","tsuki22");
	define("MYSQL_DATABASE","tsuki");
	
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