<?php
include('lock.php');
?>
<html>
<head>

<script src="jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>



</head>
<body>
<script>
$( document ).ready(function() {
 $('#example').DataTable({
 "processing": true,
 "sAjaxSource":"data.php",
 "pageLength": 50,
 "dom": 'lBfrtip',
 "buttons": [
 {
 extend: 'collection',
 text: 'Export only in Chrome',
 buttons: [
 'copy',
 'excel',
 'csv',
 'pdf',
 'print'
 ]
 }
 ]
 });
 });
 </script>
<table id="example" class="display" width="100%" cellspacing="0">
 <thead>
 <tr>
 <th>Username</th>
 <th>EnvName</th>
 <th>Date Time</th>
 <th>Task Name</th>
 <th>Project</th>
 <th>Product</th>
 </tr>
 </thead>
 </table>

</body>
</html>
