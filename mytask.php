<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    	<script src="app_task.js"></script>
    <title>my tasks</title>
  </head>
  <body>

    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center;">My Tasks</h1>
    <!-- <button onclick="location.href='mytask.php';" type="button" class="btn btn-secondary"><i class="fas fa-plus"></i>  Create Task</button> -->
    <!-- Button trigger modal -->
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
    </div>
    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
    </div>
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-plus"></i>  Create Task
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Task Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="task_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="tid">Task ID:
            </label>
              <input type="text" class="form-control" id="tid" placeholder="Task ID" name="tid" required>
            </div>
            <div  class="form-group">
              <label  for="tdescription">Task Description:
            </label>
              <input type="text" class="form-control" id="tdescription" placeholder="Task Description" name="tdescription" required>
            </div>
            <div  class="form-group">
              <label  for="ttype">Task Type:
            </label>
              <input type="text" class="form-control" id="ttype" placeholder="Task Type" name="ttype" required>
            </div>
            <div  class="form-group">
              <label  for="assignto">Assign to
            </label>
              <input type="text" class="form-control" id="assignto" placeholder="Assigned to" name="assignto">
            </div>
            <div  class="form-group">
              <label  for="pstart">Planned Start
            </label>
              <input type="date" class="form-control" id="pstart" placeholder="Planned Start" name="pstart">
            </div>
            <div  class="form-group">
              <label  for="pend">Planned End:
            </label>
              <input type="date" class="form-control" id="pend" placeholder="Planned End" name="pend">
            </div>
            <div  class="form-group">
              <label  for="ttype">Planned Effort:
            </label>
              <input type="text" class="form-control" id="peffort" placeholder="Planned Effort" name="peffort">
            </div>
            <div  class="form-group">
              <label  for="astart">Actual Start:
            </label>
              <input type="date" class="form-control" id="astart" placeholder="Actual Start" name="astart">
            </div>
            <div  class="form-group">
              <label  for="aend">Actual End:
            </label>
              <input type="date" class="form-control" id="aend" placeholder="Actual End" name="aend">
            </div>
            <div  class="form-group">
              <label  for="aeffort">Actual Effort:
            </label>
              <input type="text" class="form-control" id="aeffort" placeholder="Actual Effort" name="aeffort">
            </div>
            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="createtask">Create</button>
          </form>

          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>
  </body>
</html>
