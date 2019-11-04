<?php
 // initilize all variables
 $conn = mysqli_connect("localhost","root","root123","selfservice");

 $params = $columns = $totalRecords = $data = array();
 $params = $_REQUEST;
 //define index of columns
 $columns = array(
 0 =>'username',
 1 =>'envname',
 2 => 'dttm'
 );
 $where = $sqlTot = $sqlRec = "";
 // getting total number records from table without any search
 $sql = "SELECT username,envname,dttm,taskname,project,product	 FROM `activitylog` ";
 $sqlTot .= $sql;
 $sqlRec .= $sql;
 $sqlRec .= " ORDER BY username";
 $queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));
 $totalRecords = mysqli_num_rows($queryTot);
 $queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");
 // iterate on results row and create new index array of data
 while( $row = mysqli_fetch_row($queryRecords) ) {
 $data[] = $row;
 }
 $json_data = array(
 "draw" => 1,
 "recordsTotal" => intval( $totalRecords ),
 "recordsFiltered" => intval($totalRecords),
 "data" => $data
 );
 // send data as json format
 echo json_encode($json_data);
 ?>
