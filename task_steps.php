<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Task Steps</title>
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
    <button onclick="location.href='admin_home_page.php';" type="button" class="btn btn-primary" >Back</button>
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:20px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center; margin-top:50px;">Task Steps</h1>
    <br><br><br><br><br>
    <button  type="button" class="btn btn-secondary createbtn" style="margin-left:10px;">
    <i class="fas fa-plus"></i> Create Task Step</button>
    <br><br><br>
    <!-- ######################################################################################################################################### -->
    <!--Create Task Step Modal -->

    <div class="modal fade" id="createtaskstepmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Task Step Details</h5>
            <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="task_step_form" method="get">

            <div  class="form-group">
              <label  for="tsequenceid">Task Step Sequence ID:
            </label>
              <input type="text" class="form-control" id="tsequenceid" placeholder="Task Step Sequence ID" name="tsequenceid" >
            </div>
            <div  class="form-group">
              <label  for="tstepdescription">Task Step Description:
            </label>
              <input type="text" class="form-control" id="tstepdescription" placeholder="Task Step Description" name="tstepdescription">
            </div>

            <button type="button" class="btn btn-secondary close1" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary createtaskstep" name="createtaskstep" id="createtaskstep">Create</button>
          </form>

          <div class="alert alert-success alert-dismissible" id="successtask" style="display:none;" >

          </div>
          <div class="alert alert-danger alert-dismissible" id="errortask" style="display:none;">

          </div>
          </div>

          <div class="modal-footer" align="center" >


          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <div id="tstep_div" style="margin-top:50px;">
      <table class="table table-bordered task_step_table" id="task_step_table" style="margin-left:10px;margin-left:auto;margin-right:auto;max-width:1000px;">
        <thead>
          <tr>
            <th scope="col" id="selectcolumn1"><input type='checkbox' onclick='select_all()'/>&nbsp;</th>
            <th scope="col">Task Sequence ID</th>
            <th scope="col">Task Step Description</th>
            <th scope="col">Remarks</th>
          </tr>
        </thead>
        <tbody id="task_step_table_tbody">
        </tbody>
      </table>
      <button  type="button" class="btn btn-danger deletebtn" id="deletebtn" onclick="" style="margin-left:auto;margin-right:auto;margin-top:30px;display:block;">Delete Task Steps</button>
      <div class="alert alert-success alert-dismissible" id="success_deleteorcheck" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;" >
      </div>
      <div class="alert alert-danger alert-dismissible" id="error_deleteorcheck" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;">
      </div>
    </div>
  <script src="task_steps_script.js"></script>
  </body>
</html>
