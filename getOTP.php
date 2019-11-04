<?php
include('emp_lock.php');
include("config.php");
$otpnotifier = $_GET['notify'];
$project = $_GET['project'];
$product = $_GET['product'];
$taskname = $_GET['taskname'];
$uname = $_GET['uname'];
$env = $_GET['env'];

$otp=rand(1111, 9999);
$message = "Project: $project \r\nProduct: $product \r\nTask: $taskname \r\nRequested By: $uname \r\nEnv: $env\r\nOTP : $otp";
$message = wordwrap($message, 70, "\r\n");
mail($otpnotifier, 'OTP', $message);

$val=substr($otpnotifier, 0, strpos($otpnotifier, '@'));
echo "<center><font face=calibri color=white>OTP sent to $val </font></center>";
$sql="insert into otp(otp,task_name,username,product,project,dttm,envname) values(".$otp.",'".$taskname."','".$uname."','".$product."','".$project."','".date('Y-m-d h:i:s', time())."','".$env."')";
$result=mysql_query($sql);
?>
