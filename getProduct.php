<?php
include('lock.php');
include("config.php");
?>
Categories<select onChange=getEnvs() class="form-control" placeholder="Product" required="" name="product_name" id="product_name">
<option value=""></option>
<?php
	$sql="SELECT * from products where project_name='".$_GET['project']."' or project_name='All'";
        $result=mysql_query($sql);
	while ($data = mysql_fetch_array($result)){
		print "<option value=".$data['product_name'].">".$data['product_name']."</option>";
        }    
?>
</select>
