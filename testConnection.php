<?php
$username=$_GET['user'];
$password=$_GET['passwd'];
$machine=$_GET['machine'];

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

?>