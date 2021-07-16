<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mapped Task Steps</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

  </head>
  <body>
    <button onclick="location.href='ttype_map_tstep.php';" type="button" class="btn btn-primary" >Back</button>
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:20px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center; margin-top:50px;" id="head_tsteps" >Mapped Task Steps</h1>
    <br><br><br><br><br>

    <script src="tsteps_mapped_script.js"></script>
  </body>
</html>
