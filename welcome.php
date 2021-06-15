<?php
session_start();
if(!isset($_SESSION['arr'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);
$name="Hello  there!!";
?>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <title> welcome page</title>
</head>

<body>
  <!-- <a href="logout.php"> Logout</a> -->
  <button onclick="location.href='logout.php';" type="button" class="btn btn-primary">Log Out</button>
  <h1 style="text-align:center;"> Welcome <?php
  //echo $_SESSION['uname'];
  echo $arr['uname'];
  // echo $name;
  // echo $arr['uguid'];
  ?> </h1>


  <br><br>
  <button onclick="location.href='#';" type="button" class="btn btn-secondary">User Profile</button>
  <button onclick="location.href='#';" type="button" class="btn btn-secondary">My Task</button>
  <button onclick="location.href='#';" type="button" class="btn btn-secondary">Calendar</button>


</body>

</html>
