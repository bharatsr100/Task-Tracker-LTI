<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

  </head>
  <body>
<button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
<br><br><br>
<h1 style="text-align:center; margin-top:50px;">Admin Page</h1>
<br><br><br><br><br>

<form id="task_search" method="get" style="margin-left:50px;">
  <div  class="form-group" style="width:300px;float:left;">
    <label  for="tid">Task ID
  </label>
  <input type="text" class="form-control" id="tid" placeholder="Task ID" name="tid" >
  </div>

  <div  class="form-group" style="width:300px;float:left;margin-left:20px;">
    <label  for="createdon">Task Creation Date
  </label>
    <input type="date" class="form-control" id="createdon" placeholder="Task Creation Date" name="createdon">
  </div>
  <div  class="form-group" style="width:300px;clear:left;float:left">
    <label  for="tstatus">Task Status:
  </label>
  <select class="form-control" id="tstatus" name="tstatus">
    <option selected="true" value= 0>--Select Task Phase--</option>
      <option value=1>To be Planned</option>
      <option value=3>In Progress</option>
      <option value=4>Completed</option>
      <option value=5>On Hold</option>
      <option value=6>Awaiting</option>

    </select>
  </div>

<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="userslist">Assignto
</label>
<select class="form-control" id="userslist" name="userslist">
  </select>
</div>

  <div style="clear:left;">
  <button type="button" class="btn btn-secondary reset1" >Reset</button>
  <button type="submit" class="btn btn-primary search_admin" name="search_admin" id="search_admin">Search</button>
</div>
</form>

<div class="alert alert-success alert-dismissible" id="success_find" style="display:none;" >
</div>
<div class="alert alert-danger alert-dismissible" id="error_find" style="display:none;">
</div>
<script src="admin_script.js"></script>
  </body>
</html>
