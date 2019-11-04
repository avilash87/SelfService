<body bgcolor=black>
<?php
include('emp_lock.php');
include("config.php");

$params_val="";
$product_name=addslashes($_POST['prod']);
$project_name=addslashes($_POST['proj']);
$script=addslashes($_POST['script']);
$num_params=addslashes($_POST['numparams']);
$envname=addslashes($_POST['envname']);
$uname=addslashes($_POST['uname']);
$notify=addslashes($_POST['notify']);
$taskname=addslashes($_POST['tname']);
for ($x = 1 ; $x <= $num_params; $x++) {
		$params_val = $params_val.$_POST["param$x"]." ";
} 

$isotp=addslashes($_POST['isotp']);
if ($isotp == 1){
	$otpval=addslashes($_POST['otpvalue']);
	$osql="SELECT * from otp where envname='".$envname."' and product='".$product_name."' and project='".$project_name."' and task_name='".$taskname."' and otp=".$otpval;
	echo $osql;
	$oresult=mysql_query($osql);

if($odata = mysql_fetch_array($oresult)){
	$rsql="delete from otp where envname='".$envname."' and product='".$product_name."' and project='".$project_name."' and task_name='".$taskname."'";
	$rresult=mysql_query($rsql);
	

	

	$sql="SELECT * from environments where envname='".$envname."' and product_name='".$product_name."' and project_name='".$project_name."'";
	$result=mysql_query($sql);
	if($data = mysql_fetch_array($result)){
		$machine = $data['machine'];
		$username = $data['username'];
		$password = $data['password'];
		$notify = $data['notify'];
		if($ssh = ssh2_connect($machine, 22)) {
	  	if(ssh2_auth_password($ssh, $username, $password)) {
        $stream = ssh2_exec($ssh, $script." ".$params_val);
        echo "<center><font color=yellow face=calibri size=1> ...Executing $username@$machine:$script $params_val <br><br></font></center>";
        stream_set_blocking($stream, true);
        $response = '';
        while($buffer = fread($stream, 4096)) {
        		$response .= nl2br($buffer);
          
        }
        $response .="<center><font color=yellow size=1 face=calibri><br><br>.....End of Result....</font></center>";
        fclose($stream);
        echo "<center><font color=green face=calibri> Execution Result<br></font></center><font face=calibri color=white>".$response."</font>"; // user
    	}
    }	
    $asql="insert into activitylog(username,project,product,taskname,log,envname,dttm) values('".$uname."','".$project_name."','".$product_name."','".$taskname."','".$response."','".$envname."','".date('Y-m-d h:i:s', time())."')";
    $aresult=mysql_query($asql);
    $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$message = "
		<html>
		<head>
  	<title>Self Service Notification</title>
		</head>
		<body>
  	<p></p>
  	<table border=1 bgcolor=#66ccff>
    <tr>
      <th><font face=calibri>Project</font></th><th><font face=calibri>Product</font></th><th><font face=calibri>Task</font></th><th><font face=calibri>Env</font></th>
    </tr>
    <tr>
      <td><font face=calibri>$project_name</font></td><td><font face=calibri>$product_name</font></td><td><font face=calibri>$taskname</font></td><td><font face=calibri>Envname</font></td>
    </tr>
    <tr><td colspan=4 align=center>Output</td></tr>
    <tr><td colspan=4 bgcolor=black><font color=white face=calibri>$response</td></tr>
  	</table>
		</body>
		</html>
		";
		//$message = "Project: $project_name \r\nProduct: $product_name \r\nTask: $taskname \r\nRequested By: $uname \r\nEnv: $envname";
		//$message = wordwrap($message, 70, "\r\n");
		mail($notify, "Self Service Task $taskname performed by $uname", $message,$headers);
	}	
	else{
		echo "<center><font color=red face=calibri> Failed to Connect to ".$machine." with user ".$username."</font></center>";
	}
}
else{
	echo "<center><font color=red face=calibri> OTP Authentication Failure!!!</font></center>";
}
}
else{
	echo $num_params."<<<<<<<<<<<<<<<";


	$sql="SELECT * from environments where envname='".$envname."' and product_name='".$product_name."' and project_name='".$project_name."'";
	$result=mysql_query($sql);
	if($data = mysql_fetch_array($result)){
		$machine = $data['machine'];
		$username = $data['username'];
		$password = $data['password'];
		$notify = $data['notify'];
		if($ssh = ssh2_connect($machine, 22)) {
	  	if(ssh2_auth_password($ssh, $username, $password)) {
        $stream = ssh2_exec($ssh, $script." ".$params_val);
        echo "<center><font color=yellow face=calibri size=1> ...Executing $username@$machine:$script $params_val <br><br></font></center>";
        stream_set_blocking($stream, true);
        $response = '';
        while($buffer = fread($stream, 4096)) {
        		$response .= nl2br($buffer);
          
        }
        $response .="<center><font color=yellow size=1 face=calibri><br><br>.....End of Result....</font></center>";
        fclose($stream);
        echo "<center><font color=green face=calibri> Execution Result<br></font></center><font face=calibri color=white>".$response."</font>"; // user
    	}
    }	
    $asql="insert into activitylog(username,project,product,taskname,log,envname,dttm) values('".$uname."','".$project_name."','".$product_name."','".$taskname."','".$response."','".$envname."','".date('Y-m-d h:i:s', time())."')";
    $aresult=mysql_query($asql);
    $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$message = "
		<html>
		<head>
  	<title>Self Service Notification</title>
		</head>
		<body>
  	<p></p>
  	<table border=1 bgcolor=#66ccff>
    <tr>
      <th><font face=calibri>Project</font></th><th><font face=calibri>Product</font></th><th><font face=calibri>Task</font></th><th><font face=calibri>Env</font></th>
    </tr>
    <tr>
      <td><font face=calibri>$project_name</font></td><td><font face=calibri>$product_name</font></td><td><font face=calibri>$taskname</font></td><td><font face=calibri>Envname</font></td>
    </tr>
    <tr><td colspan=4 align=center>Output</td></tr>
    <tr><td colspan=4 bgcolor=black><font color=white face=calibri>$response</td></tr>
  	</table>
		</body>
		</html>
		";
		//$message = "Project: $project_name \r\nProduct: $product_name \r\nTask: $taskname \r\nRequested By: $uname \r\nEnv: $envname";
		//$message = wordwrap($message, 70, "\r\n");
		mail($notify, "Self Service Task $taskname performed by $uname", $message,$headers);
	}	
	else{
		echo "<center><font color=red face=calibri> Failed to Connect to ".$machine." with user ".$username."</font></center>";
	}
}


/*
if($ssh = ssh2_connect($machine, 22)) {
	  if(ssh2_auth_password($ssh, $username, $password)) {
        $stream = ssh2_exec($ssh, 'uname -a');
        stream_set_blocking($stream, true);
        $data = '';
        while($buffer = fread($stream, 4096)) {
            $data .= $buffer;
          
        }
        fclose($stream);
        echo "<center><font color=green face=calibri> Test Connection successful Server Type: <br>".$data."</center>"; // user
    }
}
else{
		echo "<center><font color=red face=calibri> Failed to Connect to ".$machine." with user ".$username."</font></center>";
	}
*/
?>
</body>