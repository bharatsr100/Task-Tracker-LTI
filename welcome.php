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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

  <!-- <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
  <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table-locale-all.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script> -->

  <title> welcome page</title>
  <style>
    /* * {
    margin: 0;
    padding: 0;
    } */
    /* body{
        margin: 0px;
        padding: 0px;
    } */
  a.cardlink,
  a.cardlink:hover {
  color: inherit;
  }
  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 200px;
    height: 250px;
    /* margin-left: 100px; */
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  .container {
    padding: 2px 2px;
    margin-top:auto;
    margin-bottom:0px;
  }
  .tiles{
    margin: 15px;
    width: 200px;
    height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  a.custom-card2,
  a.custom-card2:hover {
  color: inherit;
  }
  .card2 {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 200px;
    height: 280px;
  }

  .card2:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  .container2 {
    padding: 2px 2px;
    margin-top:auto;
    margin-bottom:0px;
  }
  .tiles2{
    margin: 15px;
    width: 200px;
    height: 280px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  #container {
    width: 690px;
    margin-left:auto;
    margin-right:auto;
    display: flex;
    flex-wrap: wrap;

  }


</style>
</head>

<body>
  <!-- <a href="logout.php"> Logout</a> -->
  <img src="pics/logo.jpg" alt="LTI-Veolia Logo" style="height:70px;width:auto;">
  <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
  <?php
  if($admin=="Yes"){?>
  <button onclick="location.href='admin_home_page.php';" type="button" class="btn btn-primary" style="float:right;margin-right:10px;">Admin</button>
  <?php
  }
  ?>
  <br><br><br>

  <h1 style="text-align:center; margin-top:50px;">Welcome <?php

      echo$arr['uname'];

  ?> </h1>
  
  <div id="container" style="margin-top:60px;">
  <div id="user_profile" class="tiles">
  <a href="user_profile.php" class="cardlink">
  <div class="card">
  <img src="pics/user-profile.png" alt="User Profile" style="width:100%;padding:20px;margin-left: auto;margin-right: auto;">
  <div class="container">
    <h4 style="text-align:center;"><b>My Profile</b></h4>
  </div>
</div>
</a>
</div>

<div id="mytask" class="tiles">
<a href="mytask.php" class="cardlink">
<div class="card">
<img src="pics/mytask.png" alt="Tasks" style="width:90%;padding:25px;margin-left: auto;margin-right: auto;">
<div class="container">
  <h4 style="text-align:center;"><b>My Tasks</b></h4>
</div>
</div>
</a>
</div>

<div id="mycalendar" class="tiles">
<a href="calendar.php" class="cardlink">
<div class="card">
<img src="pics/calendar.jpg" alt="Calendar" style="width:100%;padding:25px;margin-left: auto;margin-right: auto;">
<div class="container">
  <h4 style="text-align:center;"><b>My Calendar</b></h4>
</div>
</div>
</a>
</div>
<?php
if($ulength>1){?>

  <div id="myteamtask" class="tiles2">
  <a href="myteamtask.php" class="cardlink">
  <div class="card card2">
  <img src="pics/team_task.jpg" alt="Team Task" style="width:100%;padding:25px;margin-left: auto;margin-right: auto;">
  <div class="container2">
    <h4 style="text-align:center;"><b>My Team Tasks</b></h4>
  </div>
  </div>
  </a>
  </div>
  <div id="myteamcalendar" class="tiles2">
  <a href="myteamcalendar.php" class="cardlink">
  <div class="card card2">
  <img src="pics/team_calendar.jpg" alt="Team Calendar" style="width:100%;padding:25px;margin-left: auto;margin-right: auto;">
  <div class="container2">
    <h4 style="text-align:center;"><b>My Team Calendar</b></h4>
  </div>
  </div>
  </a>
  </div>

  <div id="leaveplan" class="tiles2">
  <a href="myteamleaveplan.php" class="cardlink">
  <div class="card card2">
  <img src="pics/vacation2.png" alt="Team Calendar" style="width:100%;padding:25px;margin-left: auto;margin-right: auto;">
  <div class="container2">
    <h4 style="text-align:center;"><b>My Team Leave Plan</b></h4>
  </div>
  </div>
  </a>
  </div>

  <?php
  }
  ?>
</div>




</body>

</html>
