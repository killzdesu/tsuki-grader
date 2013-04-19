<?php
	
	define("MYSQL_USER","homecom_krz");
	define("MYSQL_PASSWD","jui95");
	define("MYSQL_DATABASE","homecom_krz");
	
function connect_db()
{
  global $myserv;

  $myserv = mysql_connect("localhost",MYSQL_USER,MYSQL_PASSWD);
  mysql_select_db(MYSQL_DATABASE);
  mysql_set_charset('utf8');
}

function close_db()
{
  global $myserv;

  mysql_close($myserv);
}

?>