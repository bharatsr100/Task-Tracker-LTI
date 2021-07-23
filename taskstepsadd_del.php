<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="tasksteps.js"></script>

    <title>my task steps addition</title>

    <style>

    .taskid23{
      display:none;
    }
    .tseqid23{
      display:none;
    }
    </style>
  </head>
  <body>
    <!-- <button onclick="location.href='mytask.php';" type="button" class="btn btn-primary" >Back</button> -->
    <img src="pics/logo.jpg" alt="LTI-Veolia Logo" style="height:70px;width:auto;">
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
    <br><br><br>
    <!--Delete Task Step Modal -->
      <div class="modal fade" id="deletetaskmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="deletemodal1">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this task step?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- action="updatetask.php" -->
            <form id="delete_form2" name="deleteform2" method="post"  >

              <div  class="form-group">
                <label  for="tguidd" style="display:none;">TGUID:
              </label>
                <input type="text" class="form-control" id="tguidd" placeholder="Task Sequence ID" name="tguidd" style="display:none;">
              </div>
              <div  class="form-group">
                <label  for="tsequenceidd" style="display:none;">Task Sequence ID:
              </label>
                <input type="text" class="form-control" id="tsequenceidd" placeholder="TGUID" name="tsequenceidd" style="display:none;">
              </div>
              <div  class="form-group">
                <label  for="tpstart" style="display:none;" >Planned Start Date:
              </label>
                <input type="date" class="form-control" id="tpstart" placeholder="Planned Start Date" name="tpstart" style="display:none;">
              </div>
              <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
              <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
              <button type="button" class="btn btn-secondary close1" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-primary deletetaskstp" id="deletetaskstp" name="deletetaskstp">Yes</button>
            </form>
            <div class="alert alert-success alert-dismissible" id="successadd" style="display:none;" >

            </div>
            <div class="alert alert-danger alert-dismissible" id="erroradd" style="display:none;">

            </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    <!-- ######################################################################################################################################### -->
    <!--Add Task Step Modal -->
      <div class="modal fade" id="addtaskmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="deletemodal1">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Do you want to add this task step?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <form id="add_form2" name="addform2" method="post" >

              <div  class="form-group">
                <label  for="tguidd23" style="display:none;">TGUID:
              </label>
                <input type="text" class="form-control" id="tguidd23" placeholder="Task Sequence ID" name="tguidd23" style="display:none;">
              </div>
              <div  class="form-group">
                <label  for="tsequenceidd23" style="display:none;">Task Sequence ID:
              </label>
                <input type="text" class="form-control" id="tsequenceidd23" placeholder="TGUID" name="tsequenceidd23" style="display:none;">
              </div>
              <div  class="form-group">
                <label  for="tstepdescription23" style="display:none;">Task Description:
              </label>
                <input type="text" class="form-control" id="tstepdescription23" placeholder="Task Description" name="tstepdescription23" style="display:none;">
              </div>
              <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
              <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
              <button type="button" class="btn btn-secondary close1" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-primary addtaskstp" id="addtaskstp" name="addtaskstp">Yes</button>
            </form>
            <div class="alert alert-success alert-dismissible" id="successdelete" style="display:none;" >

            </div>
            <div class="alert alert-danger alert-dismissible" id="errordelete" style="display:none;">

            </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    <!-- ######################################################################################################################################### -->

    <h1 style="text-align:center;" id="headone"></h1><br><br><br>



    <center>
     <div id="tsteps23" style="display:contents">
    <table  class="table table-hover" id="taskstep23">
      <thead>
      <tr>
        <!-- <th scope="col">Select</th> -->
        <th scope="col" style="display:none;">Task GUID</th>
        <th scope="col" style="display:none;">Task Sequence</th>
        <!-- <th scope="col" style="display:none;">Task ID</th> -->
        <!-- <th scope="col">Task Sequence No</th> -->
        <th scope="col">Task Step Description</th>
        <th scope="col">Assigned to</th>
        <th  scope="col">Planned Start</th>
        <th scope="col">Planned End</th>
        <th scope="col">Planned Effort</th>
        <th scope="col">Actual Start</th>
        <th scope="col">Actual End</th>
        <th scope="col">Actual Effort</th>
        <th scope="col">Task Status</th>
        <th scope="col">Action </th>


      </tr>
      </thead>

    <tbody id="tbodystep23">
    </tbody>
    </table>
    </div>




        <br><br><br><br><h1>Available Task Steps List</h1><br><br><br>
        <table  class="table table-hover" id="tasksteplist23">
          <thead>
          <tr>
            <th scope="col" style="display:none;">Task GUID</th>
            <th scope="col" style="display:none;">Task Sequence</th>
            <th scope="col">Task Step Description</th>
            <th scope="col">Action </th>
          </tr>
        </thead>

      <tbody id="tbodylist23">

      </tbody>
      </table>

      </center>
    <script>
    var taskid = sessionStorage.getItem("taskid23");
    var tguidstep = sessionStorage.getItem("tguidstep23");

    var tidd= taskid.trim();
    var l= tidd.length;
    var tids = tidd.substring(0, l/2);
    tids =tids.trim();

    $("#headone").html("Task Steps for: "+tids);

    </script>
  </body>
</html>
