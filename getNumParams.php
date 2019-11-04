<?php
include('lock.php');
include("config.php");
?>
<br/>Fill the required params<br/>

<?php
$num_parms=$_GET['numparams'];
	if($num_parms != 0)	{
		echo "<table style='background-repeat:no-repeat; width:450px;margin:0;' cellpadding='0' cellspacing='0' border=1><tr><th>Parameter Name</th><th>Regex Value</th><th>Comments</th></tr>";		
	}
	for ($x = 1 ; $x <= $num_parms; $x++) {
		echo "<tr><td><input type=text name=param".$x." id=param".$x." placeholder=param".$x."></td><td><input type=text name=regex".$x." id=regex".$x." placeholder=regex".$x."></td><td><input type=text name=comment".$x." id=comment".$x." placeholder=comment".$x."></td></tr>";
	} 
	echo "<input type=hidden name=num_of_params id=num_of_params value=".$num_parms.">";
	echo "<tr><td colspan=3><input type=text name=scriptloc id=scriptloc placeholder='Full Script Path' ></td></tr>";
	echo "<tr><td>Acess Type</td><td colspan=2><select name=accesstype id=accesstype ><option value=0>IT</option><option value=1>Infra</option><option value=2>DBA</option><option value=3>Operations</option><option value=5>All</option></td></tr>";
	echo "<tr><td colspan=3><input type=text placeholder='OTP mail id if reuire is True' id=otpnotifier name=otpnotifier><input type='checkbox'  id=requireotp name=requireotp class='btn btn-default submit'> Require OTP Authentication</td></tr>";
	
?>
</table><br/>