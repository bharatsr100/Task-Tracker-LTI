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
<img src="pics/logo.jpg" alt="LTI-Veolia Logo" style="height:70px;width:auto;">
<button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
<button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:20px;">Home</button>
<br><br><br>
<h1 style="text-align:center; margin-top:50px;">Admin Page</h1>
<br><br><br>

<button onclick="location.href='admin_page.php';" type="button" class="btn btn-secondary" style="margin-left:450px;width:170px;">Task Search </button>
<button onclick="location.href='admin_mass_taskupload.php';" type="button" class="btn btn-secondary" style="width:170px;">Mass Upload Task</button>
<button onclick="location.href='admin_mass_taskstepupload.php';" type="button" class="btn btn-secondary" style="width:240px;">Mass Upload Task Step</button>
<br><br>
<button onclick="location.href='task_types.php';" type="button" class="btn btn-secondary" style="margin-left:450px;width:170px;">Task Types</button>
<button onclick="location.href='task_steps.php';" type="button" class="btn btn-secondary" style="width:170px;">Task Steps</button>
<button onclick="location.href='ttype_map_tstep.php';" type="button" class="btn btn-secondary" style="width:240px;">Task Step and Type Mapping</button>


</body>
</html>
