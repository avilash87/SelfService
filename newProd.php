﻿<?php
include('lock.php');
include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	// username and password sent from Form
$project_name=addslashes($_POST['projname']);
$product_name=addslashes($_POST['prodname']);
print "<center><font color=Green>".$product_name." Added To $project_name!!!</font></center>";
$sql="insert into products(product_name,project_name) values('".$product_name."','".$project_name."')";
$result=mysql_query($sql);

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
    <div name="testcon" id="testcon"></div>
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
        	  <div id="login" class="animate form">
                <section class="login_content">
                    <form method=POST action="newProd.php">
                        <h1>New Product</h1>
                         <div>
                        	<select class="form-control" placeholder="Project" required="" name="projname" id="projname">
				<option value='All'>All</option>
                        		<?php
                        			$sql="SELECT * from projects";
                        			$result=mysql_query($sql);
															while ($data = mysql_fetch_array($result)){
																print "<option value=".$data['project_name'].">".$data['project_name']."</option>";
                 							}    
                 						?>
                        	</select>
                        	</div>
                        <div><input type="text" class="form-control" placeholder="Product Name" required="" name="prodname" id="prodname" /></div>
                        <div>
                            <center><input type="submit" value="Create Project" class="btn btn-default submit" ></center>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                           
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><img src=./images/BPT.png width=30px height=30px><i class="fa fa-paws" style="font-size: 26px;"></i> Self Service</h1>

                                <p>All Rights Reserved.RaAv</p>
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
