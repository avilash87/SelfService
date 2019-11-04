<?php
include('lock.php');
include("config.php");
 if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// username and password sent from Form

	if (addslashes($_POST['requireotp']) == "on"){
		$otp=1;
	}
	else{
		$otp=0;
	}

$privs=addslashes($_POST['accesstype']);
$product_name=addslashes($_POST['product_name']);
$project_name=addslashes($_POST['project_name']);
$script=addslashes($_POST['scriptloc']);
$num_params=addslashes($_POST['num_of_params']);
$notify=addslashes($_POST['notify']);
$params_name="";
$regex_name="";
$comments_name="";
$params_val="";
$regex_val="";
$comments_val="";

	for ($x = 1 ; $x <= $num_params; $x++) {
		$params_name =  $params_name.",param$x";
		$params_val = $params_val.",'".$_POST["param$x"]."'";
		$regex_name = $regex_name.",regex$x";
		$regex_val = $regex_val.",'".$_POST["regex$x"]."'";
		$comments_name = $comments_name.",comment$x";
		$comments_val = $comments_val.",'".$_POST["comment$x"]."'";
	}
$otpnotifier=addslashes($_POST['otpnotifier']);
$taskname=addslashes($_POST['taskname']);
$taskid=str_replace(' ', '_', $_POST['taskid']);
$description=addslashes($_POST['description']);
$createdby=addslashes($_SESSION['login_user']);
$envname="All";




print "<center><font color=Green>".$taskname." Added To Project ".$project_name."</font></center>";
$sql="insert into tasks(otp,privs,product_name,project_name,script".$params_name.$regex_name.$comments_name.",otp_notifier,taskname,createdby,envname,numparams,notify,taskid,description) values('".$otp."',".$privs.",'".$product_name."','".$project_name."','".$script."'".$params_val.$regex_val.$comments_val.",'".$otpnotifier."','".$taskname."','".$createdby."','".$envname."',".$num_params.",'".$notify."','".$taskid."','".$description."')";
$result=mysql_query($sql);
//print($sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <link rel="stylesheet" href="vendor/css/vendor.css" />
    <link rel="stylesheet" href="dist/formbuilder.css" />

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

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<script>
function getProducts()
{
	str = document.getElementById("project_name").value;
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        	  document.getElementById("productpanel").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","getProduct.php?project="+str,true);
    xmlhttp.send();

}

function getEnvs()
{
	str = document.getElementById("product_name").value;
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        	  document.getElementById("envpanel").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","getEnv.php?product="+str,true);
    xmlhttp.send();

}

function getNumParams()
{
	str = document.getElementById("numparams").value;
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        	  document.getElementById("parampanel").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","getNumParams.php?numparams="+str,true);
    xmlhttp.send();

}

</script>
</head>

<body>
  <div class='fb-main'></div>

  <script src="vendor/js/vendor.js"></script>
  <script src="dist/formbuilder.js"></script>

  <script>
    $(function(){
      fb = new Formbuilder({
        selector: '.fb-main',
        bootstrapData: [
          {
            "label": "Unique Task Name",
            "field_type": "text",
            "required": true,
	    "value": "true",
            "field_options": {},
            "cid": "c1"
          },
 
	  {
            "label": "Please enter your clearance number",
            "field_type": "text",
            "required": true,
            "field_options": {},
            "cid": "c6"
          },
          {
            "label": "Security personnel #82?",
            "field_type": "radio",
            "required": true,
            "field_options": {
                "options": [{
                    "label": "Yes",
                    "checked": false
                }, {
                    "label": "No",
                    "checked": false
                }],
                "include_other_option": true
            },
            "cid": "c10"
          },
          {
            "label": "Medical history",
            "field_type": "file",
            "required": true,
            "field_options": {},
            "cid": "c14"
          }
        ]
      });

      fb.on('save', function(payload){
        console.log(payload);
      })
    });
  </script>

</body>

</html>
