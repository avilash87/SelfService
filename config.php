<?php
// Turn off all error reporting
//error_reporting(0);
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "root123";
$mysql_database = "selfservice";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Opps some thing went wrong while connecting DB");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>
