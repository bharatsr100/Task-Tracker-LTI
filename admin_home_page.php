<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

  </head>
  <body>

<button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
<button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:20px;">Home</button>
<br><br><br>
<h1 style="text-align:center; margin-top:50px;">Admin Page</h1>
<br><br><br>

<button onclick="location.href='admin_page.php';" type="button" class="btn btn-secondary" style="margin-left:100px;width:170px;">Task Search </button>
<button onclick="location.href='admin_mass_taskupload.php';" type="button" class="btn btn-secondary" style="width:170px;">Mass Upload Task</button>
<button onclick="location.href='\#';" type="button" class="btn btn-secondary" style="width:200px;">Mass Upload Task Step</button>


</body>
</html>
