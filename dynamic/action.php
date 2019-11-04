<pre>
<?php

$con = mysql_connect("localhost","root","");
if (!$con){
die('Could not connect: ' . mysql_error());
}

mysql_select_db("bpt", $con);

mysql_query("
CREATE TABLE 
`dynamic_form`.`".$_REQUEST['table_name']."`
( `id` INT(11) NOT NULL AUTO_INCREMENT , `".$_REQUEST['txt_field']."` VARCHAR(225) , `".$_REQUEST['text_area']."` TEXT , PRIMARY KEY (`id`))  ;")
?>

Congrulation you have successfully generated <?php echo $_REQUEST['table_name'];?> table