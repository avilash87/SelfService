<?php
include('lock.php');
include("config.php");
?>
Select Number of parameters<br/>
<select name=numparams id=numparams onChange=getNumParams()><option value=0></option>
<?php
	for ($x = 0 ; $x <= 15; $x++) {
		echo "<option value=".$x.">".$x."</option>";
	} 
?>