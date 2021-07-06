<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);
$allusers = unserialize($_SESSION['allusers']);
$admin=$_SESSION['admin'];
$ulength= sizeof($allusers);
include 'database.php';
// $myFile = "employeelist.txt";
// $fo = fopen($myFile, 'w') or die("can't open file");
// $sql = "SELECT * FROM userdata1";
//$stringData="";
 // fwrite($fo, $stringData);
 // fclose($fo);

?>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

  <!-- <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
  <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table-locale-all.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script> -->

  <title> welcome page</title>

</head>

<body>
  <!-- <a href="logout.php"> Logout</a> -->
  <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
  <?php
  if($admin=="Yes"){?>
  <button onclick="location.href='admin_page.php';" type="button" class="btn btn-primary" style="float:right;margin-right:10px;">Admin</button>
  <?php
  }
  ?>
  <br><br><br>
  
  <h1 style="text-align:center; margin-top:50px;"> Welcome <?php

      echo $arr['uname'];

  ?> </h1>


  <br><br>

  <button onclick="location.href='user_profile.php';" type="button" class="btn btn-secondary" style="margin-left:100px;width:170px;">My Profile</button>
  <button onclick="location.href='mytask.php';" type="button" class="btn btn-secondary" style="width:170px;">My Task</button>
  <button onclick="location.href='calendar.php';" type="button" class="btn btn-secondary" style="width:170px;">My Calendar</button>
  <br><br>
  <?php
  if($ulength>1){?>
    <button onclick="location.href='myteamtask.php';" type="button" class="btn btn-secondary" style="margin-left:100px;width:170px;">My Team Task</button>
    <button onclick="location.href='myteamcalendar.php';" type="button" class="btn btn-secondary" style="width:170px;">My Team Calendar</button>
    <button onclick="location.href='myteamleaveplan.php';" type="button" class="btn btn-secondary" style="width:170px;">My Team Leave Plan</button>
  <?php
  }

  ?>

  <br><br>



</body>

</html>
