<?php
include('emp_lock.php');
include("config.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Self Service!</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>

 <!-- PNotify -->
    <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>

   
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        </head>
        <script>
function fireCommand()
{
	extraparam="";
	paramnum = parseInt(document.getElementById("numparams").value);
	for(i=1; i<=paramnum; i++){
		extraparam += "&param"+i+"="+document.getElementById("param"+i).value
	}
	urlval = "fireCommand.php?prod="+document.getElementById("prod").value+"&proj="+document.getElementById("proj").value+"&script="+document.getElementById("script").value+"&numparams="+document.getElementById("numparams").value+"&envname="+document.getElementById("envname").value+"&uname="+document.getElementById("uname").value+"&notify="+document.getElementById("notify").value+"&privs="+document.getElementById("privs").value+"&tname="+document.getElementById("tname").value+"&isotp="+document.getElementById("isotp").value + extraparam;
	document.getElementById("res").innerHTML="<center><img align=center src=images/loading.gif><br>Executing script in the backend. Please wait!!!</center>";
	var xmlhttp=new XMLHttpRequest();
    	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			  document.getElementById("res").innerHTML=xmlhttp.responseText ;
				
        }
    }
   
	xmlhttp.open("GET",urlval,true);
	
    xmlhttp.send();
    
}

function getOTP()
{
	reply="";
	if (document.getElementById("envname").value!= ""){
	envname = document.getElementById("envname").value;
	project = document.getElementById("proj").value;
	product = document.getElementById("prod").value;
	taskname = document.getElementById("tname").value;
	uname = document.getElementById("uname").value;
	notify = document.getElementById("otpnotify").value;
	
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        	  document.getElementById("res").innerHTML=xmlhttp.responseText;
        	  reply=xmlhttp.responseText;;
        }
    }
    xmlhttp.open("GET","getOTP.php?project="+project+"&product="+product+"&taskname="+taskname+"&uname="+uname+"&notify="+notify+"&env="+envname,true);
    xmlhttp.send();
    var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "OTP Requested",
                type: "dark",
                text: reply,
                nonblock: {
                    nonblock: true
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - :)",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });

        });
  }
  else
  	alert("Select Server!!!");
}
</script>

<body style="background:#F7F7F7;">
<div id=res name=res>


<form id="myform" method=post action=""><center>
<?php 
$taskname=addslashes($_GET['task']);
$product=addslashes($_GET['product']);
$project=addslashes($_GET['project']);
echo "<input type=hidden name=uname id=uname value=".$_SESSION['emp_login_user']."><input type=hidden name=tname id=tname value=$taskname><input type=hidden name=proj id=proj value=$project><input type=hidden name=prod id=prod value=$product>";
$sql="SELECT * from tasks where product_name='".$product."'  and taskid='".$taskname."'";
$result=mysql_query($sql);
while ($data = mysql_fetch_array($result)){
		$numparams = $data['numparams'];
		$otp = $data['otp'];
		$script = $data['script'];
		$otpnotifier = $data['otp_notifier'];
		$notify = $data['notify'];
		$isotp =  $data['otp'];
		$taskval = $data['taskname'];
		$details = $data['description'];
		$privs = $data['privs'];
		$taskid = $data['taskid'];
		echo "<input type=hidden name=isotp id=isotp value=$isotp>";
		echo "<input type=hidden name=notify id=notify value=$notify>";
		echo "<input type=hidden name=otpnotify id=otpnotify value=$otpnotifier>";
		echo "<input type=hidden name=script id=script value=$script>";
		echo "<input type=hidden name=privs id=privs value=$privs>";
		echo "<input type=hidden name=numparams id=numparams value=$numparams>";


	
		echo "<tr ><td align=right>Server Name</td><td><select name=envname id=envname ><option value=''></option>";
			$sqla="SELECT * from environments where product_name='".$prod."' or product_name='All' ";
			$resulta=mysql_query($sqla);
			while ($dataa = mysql_fetch_array($resulta)){
				$prod = $dataa['machine'];
				echo "<option value=".$dataa['tuxip'].">".$prod."</option>";
			}
			echo "</select></td></tr>";
		
		echo "<br/>";
		echo "<table align=center style='background-repeat:no-repeat; margin:0;' cellpadding='0' cellspacing='0' border=1>";
		echo "<tr><td><b>Script</b>: $script </td></tr>";
		for ($x = 1; $x <= $numparams; $x++) {
			echo "<tr><td><input type=text name=param".$x." id=param".$x." placeholder=".$data['param'.$x]." required pattern='".$data['regex'.$x]."' title=".$data['comment'.$x]." ></td></tr>";
		}    
		if ( $otp == 1 ){
			echo "<tr><td align=center><input type=text id='otpvalue' placeholder='OTP' name='otpvalue' required pattern='[0-9]{4}' title='Requires OTP authentication to execute'><input type=button onClick=getOTP() value='Request OTP'></td></tr>";
		}
}
?>


        
        <tr><td align=center><input id="button1" type="button" value=Trigger onClick=fireCommand()></td></tr>
        </table><br><br>
<?php
echo "<br><center><img src='selfs.png' width=100 height=100></center>";	
echo "<br><center><h4><b>$taskval:</b> </h4></center><h4><center><font face=calibri color=blue>$details</font></center></h4>";

?>
</center>
</form>
</div>