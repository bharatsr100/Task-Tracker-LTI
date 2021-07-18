<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Task Type and Step Mapping</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <style>
  .t_descr_button{
    color: black;
    font-weight:700;
    text-decoration: underline;
    /* border-color:white; */
  }
  </style>
  </head>
  <body>
    <button onclick="location.href='admin_home_page.php';" type="button" class="btn btn-primary" >Back</button>
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:20px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center; margin-top:50px;">Task Type and Steps Mapping</h1>

    <div id="tmap_div" style="margin-top:80px;">
      <table class="table table-bordered task_map_table" id="task_map_table" style="margin-left:10px;margin-left:auto;margin-right:auto;max-width:1000px;">
        <thead>
          <tr>

            <th scope="col">Task Type</th>
            <th scope="col">Task Type Description</th>
          </tr>
        </thead>
        <tbody id="task_map_table_tbody">
        </tbody>
      </table>
      <!-- <button  type="button" class="btn btn-danger deletebtn" id="deletebtn" onclick="" style="margin-left:auto;margin-right:auto;margin-top:30px;display:block;">Delte Task Steps</button> -->
      <div class="alert alert-success alert-dismissible" id="success_map" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;" >
      </div>
      <div class="alert alert-danger alert-dismissible" id="error_map" style="display:none;width:400px;margin-left:auto;margin-right:auto;margin-top:40px;">
      </div>
    </div>
    <script src="ttype_map_tstep_script.js"></script>
  </body>
</html>
