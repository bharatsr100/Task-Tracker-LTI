<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);
$name="Hello  there!!";

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
  <br><br><br>
  <h1 style="text-align:center; margin-top:50px;"> Welcome <?php
  //echo $_SESSION['uname'];
  //echo $_SESSION['uguid'];
  // echo $name;
  // echo $arr['uguid'];
      echo $arr['uname'];
      //
  ?> </h1>


  <br><br>
  <button onclick="location.href='user_profile.php';" type="button" class="btn btn-secondary">User Profile</button>
  <button onclick="location.href='mytask.php';" type="button" class="btn btn-secondary">My Task</button>
  <button onclick="location.href='calendar.php';" type="button" class="btn btn-secondary">Calendar</button>
  <br><br><br>



</body>

</html>
