﻿<?php
include("config.php");
 session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// username and password sent from Form
$myusername=addslashes($_POST['username']);
$mypassword=addslashes($_POST['password']);
 print "<center><font color=red> Invalid username Passowrd. Please Try Again</font></center>";
$sql="SELECT id,profile FROM admin WHERE username='$myusername' and passcode='$mypassword'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$profile=$row['profile'];
$count=mysql_num_rows($result);
  
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
//session_register("myusername");
$_SESSION['login_user']=$myusername;
$_SESSION['profile']=$profile;

header("location: index.php");
}
else
{
$error="Your Login Name or Password is invalid";
}
}

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

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method=POST action="login.php">
                        <h1>Self Service</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" name="username" id="username" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="password" id="password"/>
                        </div>
                        <div>
                            <input type="submit" value="Log In" class="btn btn-default submit" >
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><img src=./images/BPT.png><i class="fa fa-paws" style="font-size: 26px;"></i> </h1>

                                <p>All Rights Reserved.Accenture</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" name="username" id="username"/>
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" name="email" id="email"/>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="password" id="password"/>
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><img src=./images/BPT.png><i class="fa fa-paws" style="font-size: 26px;"></i></h1>

                                <p> All Rights Reserved. Accenture</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>
