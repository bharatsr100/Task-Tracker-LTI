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

    <div id="tstep_div" style="margin-top:80px;">
      <table class="table table-bordered task_step_table" id="task_step_table" style="margin-left:10px;margin-left:auto;margin-right:auto;max-width:1000px;">
        <thead>
          <tr>
            <th scope="col" id="selectcolumn1"><input type='checkbox' onclick='select_all("selectcolumn1 input","selectcolumn input")'/>&nbsp;</th>
            <th scope="col">Task Sequence ID</th>
            <th scope="col">Task Step Description</th>
            <th scope="col">Planned Effort (%)</th>
            <th scope="col">Remarks</th>
          </tr>
        </thead>
        <tbody id="task_step_table_tbody">
        </tbody>
      </table>
      <button  type="button" class="btn btn-danger deletebtn" id="deletebtn" onclick="" style="margin-left:auto;margin-right:auto;margin-top:30px;display:block;">Delete Task Steps</button>
      <div class="alert alert-success alert-dismissible" id="success_delete" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;" >
      </div>
      <div class="alert alert-danger alert-dismissible" id="error_delete" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;">
      </div>
    </div>
    <h1 style="text-align:center; margin-top:110px;" >Available Task Steps</h1>

    <div id="tstep_div2" style="margin-top:80px;">
      <table class="table table-bordered task_step_table2" id="task_step_table2" style="margin-left:10px;margin-left:auto;margin-right:auto;max-width:1000px;">
        <thead>
          <tr>
            <th scope="col" id="selectcolumn2"><input type='checkbox' onclick='select_all("selectcolumn2 input","selectcolumn2 input")'/>&nbsp;</th>
            <th scope="col">Task Sequence ID</th>
            <th scope="col">Task Step Description</th>
            <th scope="col">Remarks</th>
          </tr>
        </thead>
        <tbody id="task_step_table_tbody2">
        </tbody>
      </table>
      <button  type="button" class="btn btn-success addbtn" id="addbtn"  style="margin-left:auto;margin-right:auto;margin-top:30px;display:block;">Add Task Steps</button>
      <div class="alert alert-success alert-dismissible" id="success_add" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;" >
      </div>
      <div class="alert alert-danger alert-dismissible" id="error_add" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;">
      </div>
    </div>
    <script src="tsteps_mapped_script.js"></script>
  </body>
</html>
