<?php
include('config.php');
session_start();
$user_check=$_SESSION['emp_login_user'];
 
$ses_sql=mysql_query("select name from user where name='$user_check' ");
 
$row=mysql_fetch_array($ses_sql);
 
$login_session=$row['name'];
 
if(!isset($login_session))
{
header("Location: emp_login.php");
}
?>