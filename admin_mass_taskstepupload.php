<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mass Task Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <style>

    #selectcolumn1{
      width:50px;

    }
    .selectcolumn{
      width:50px;


    }
    .remarkcolumn{
      width:150px;

    }

    /* .mass_task_table{
      color:blue;
    } */
    /* #mass_task_table1{
      color:red;
    } */
    .mass_task_table td{
      padding:5px;
    }
    /* .selectcolumn input{
      height: 50px;
      width: 50px;
    } */
    /* .mass_task_table th{
      padding:0px;
    } */
    </style>
  </head>
  <body>
    <button onclick="location.href='admin_home_page.php';" type="button" class="btn btn-primary" >Back</button>
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:20px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center; margin-top:50px;">Mass Task Step Upload</h1>
    <br><br><br><br><br>


<p style="margin-left:100px;">Choose CSV file:</p>
<div class="custom-file mb-3" style="width:200px;margin-left:100px;">
  <input type="file" class="custom-file-input" id="upload_masstask" name="upload_masstask">
  <label class="custom-file-label" for="upload_masstask">Choose file</label>
</div>
<div>
<input type="button" id="uploadbtn" value="Upload" class="btn btn-primary uploadbtn" style="margin-left:100px;"/>
<input type="button" id="downloadbtn" value="Download demo file" class="btn btn-primary downloadbtn" style="margin-left:10px;"/>
<!-- onclick="Upload()" -->
</div>
<div class="alert alert-success alert-dismissible" id="success_display" style="display:none;width:400px;margin-left:100px;margin-top:50px;" >
</div>
<div class="alert alert-danger alert-dismissible" id="error_display" style="display:none;width:400px;margin-left:100px;margin-top:50px;">
</div>

<div id="dvCSV" style="margin-top:100px;">
</div>

<div id="action_buttons" style="display:none;">
<button onclick="check_data()" type="button" class="btn btn-primary" style="float: left;margin-left:10px;">Check</button>
<button onclick="upload_data()" type="button" class="btn btn-primary" style="float: left;margin-left:10px;">Save</button>
</div>

<div class="alert alert-success alert-dismissible" id="success_uploadorcheck" style="display:none;width:400px;margin-left:50px;margin-top:100px;" >
</div>
<div class="alert alert-danger alert-dismissible" id="error_uploadorcheck" style="display:none;width:400px;margin-left:50px;margin-top:100px;">
</div>

    <script src="admin_mass_taskstepscript.js"></script>
  </body>
</html>
