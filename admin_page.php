<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Task Serach and Task Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script> -->
    <!-- <script src="jspdf.umd.min.js"></script> -->
    <!-- <script src="jspdf.plugin.autotable.js"></script> -->

    <style>
    .hidden_cells{
      display:none;
    }
    .tid_button{
      border-color: black;
    }
    .expbtn{
      display:none;
    }
    .t_descr_button{
      color: black;
      font-weight:700;
      text-decoration: underline;
      /* border-color:white; */
    }
    .t_descr_button:hover{
      color: black;
    }
    </style>
  </head>
  <body>
<button onclick="location.href='admin_home_page.php';" type="button" class="btn btn-primary" >Back</button>
<button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float:right;">Log Out</button>
<button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float:right;margin-right:10px;">Home</button>
<br><br><br>
<h1 style="text-align:center; margin-top:50px;">Task Search and Task Report</h1>
<br><br><br><br><br>

<form id="task_search" method="get" style="margin-left:50px;">
  <div  class="form-group" style="width:300px;float:left;">
    <label  for="tid">Task ID
  </label>
  <input type="text" class="form-control" id="tid" placeholder="Task ID" name="tid" >
  </div>

  <div  class="form-group" style="width:300px;float:left;margin-left:20px;">
    <label  for="createdon_from">Task Creation Date (From)
  </label>
    <input type="date" class="form-control" id="createdon" placeholder="Task Creation Date (From)" name="createdon">
  </div>
  <div  class="form-group" style="width:300px;float:left;margin-left:20px;">
    <label  for="createdon_to">Task Creation Date (To)
  </label>
    <input type="date" class="form-control" id="createdon_to" placeholder="Task Creation Date (To)" name="createdon_to">
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
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="userinfo">Fetch Team Info:
</label>
<select class="form-control" id="userinfo" name="userinfo">
    <option value=0 selected="true">Include User's info</option>
    <option value=1>Include Team's info</option>
    <option value=2>Both</option>


  </select>
</div>
<div  class="form-group" style="width:300px;float:left;clear:left;">
  <label  for="pstart_from">Planned Start Date (From)
</label>
  <input type="date" class="form-control" id="pstart_from" placeholder="Planned Start Date (From)" name="pstart_from">
</div>
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="pstart_to">Planned Start Date (To)
</label>
  <input type="date" class="form-control" id="pstart_to" placeholder="Planned Start Date (To)" name="pstart_to">
</div>
<div  class="form-group" style="width:300px;float:left;clear:left;">
  <label  for="pend_from">Planned End Date (From)
</label>
  <input type="date" class="form-control" id="pend_from" placeholder="Planned End Date (From)" name="pend_from">
</div>
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="pend_to">Planned End Date (To)
</label>
  <input type="date" class="form-control" id="pend_to" placeholder="Planned Start Date (To)" name="pend_to">
</div>
<div  class="form-group" style="width:300px;float:left;clear:left;">
  <label  for="astart_from">Actual Start Date (From)
</label>
  <input type="date" class="form-control" id="astart_from" placeholder="Actual Start Date (From)" name="astart_from">
</div>
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="astart_to">Actual Start Date (To)
</label>
  <input type="date" class="form-control" id="astart_to" placeholder="Actual Start Date (To)" name="astart_to">
</div>
<div  class="form-group" style="width:300px;float:left;clear:left;">
  <label  for="aend_from">Actual End Date (From)
</label>
  <input type="date" class="form-control" id="aend_from" placeholder="Actual End Date (From)" name="aend_from">
</div>
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="aend_to">Actual End Date (To)
</label>
  <input type="date" class="form-control" id="aend_to" placeholder="Actual Start Date (To)" name="aend_to">
</div>
<div  class="form-group" style="width:300px;float:left;clear:left;">
  <label  for="peffort_from">Planned Effort (From)
</label>
  <input type="number" step="any" class="form-control" id="peffort_from" placeholder="Planned Effort (From)" name="peffort_from">
</div>
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="peffort_to">Planned Effort (To)
</label>
  <input type="number" step="any" class="form-control" id="peffort_to" placeholder="Planned Effort (To)" name="peffort_to">
</div>
<div  class="form-group" style="width:300px;float:left;clear:left;">
  <label  for="aeffort_from">Actual Effort (From)
</label>
  <input type="number" step="any" class="form-control" id="aeffort_from" placeholder="Actual Effort (From)" name="aeffort_from">
</div>
<div  class="form-group" style="width:300px;float:left;margin-left:20px;">
  <label  for="aeffort_to">Actual Effort (To)
</label>
  <input type="number" step="any" class="form-control" id="aeffort_to" placeholder="Actual Effort (To)" name="aeffort_to">
</div>
  <div style="clear:left;">
  <button type="button" class="btn btn-secondary reset1" id="reset1" >Reset</button>
  <button type="submit" class="btn btn-primary search_admin" name="search_admin" id="search_admin">Search</button>
</div>
</form>
<div class="alert alert-success alert-dismissible" id="success_find" style="display:none;" >
</div>
<div class="alert alert-danger alert-dismissible" id="error_find" style="display:none;">
</div>

<center>
  <h1 style="text-align:center; margin-top:50px;">Task Table</h1>
  <!-- style="display:none;" -->

  <div id="admin_search_div"  style="margin-top:50px;">
    <div id="admin_search_div_in">
    <table class="table table-hover admin_search_table" id="admin_search_table">
      <thead>
        <tr>
          <th scope="col">Task Creation Date</th>
          <th scope="col">Assigned to</th>
          <th scope="col" style="display:none;">Assigned to (id)</th>
          <th scope="col" style="display:none;">Task GUID</th>
          <th scope="col">Task ID</th>
          <th scope="col">Task Description</th>
          <th scope="col">Task Type</th>
          <th scope="col">Planned Start</th>
          <th scope="col">Planned End</th>
          <th scope="col">Planned Effort</th>
          <th scope="col">Actual Start</th>
          <th scope="col" >Actual End</th>
          <th scope="col">Actual Effort</th>
          <th scope="col" style="width:150px;">Task Status</th>
        </tr>
      </thead>
      <tbody id="tbody_admin_search">
      </tbody>
    </table>
  </div>
<button type="button" onclick="exporttable1toexcel()" class="btn btn-secondary expbtn">Export to excel</button>
<button type="button" onclick="exporttable1topdf()" class="btn btn-secondary expbtn">Export to pdf</button>
  </div>


  <br><br><br>
  <h1 style="text-align:center; margin-top:50px;">Task Steps Table</h1>
  <div id="admin_search_step_div"  style="margin-top:50px;">
    <div id="admin_search_step_div_in">
    <table class="table table-hover" id="admin_search_step_table">
      <thead>
        <tr>
          <th scope="col">Task Creation Date</th>
          <th scope="col">Assigned to</th>
          <th scope="col" style="display:none;">Assigned to (id)</th>
          <th scope="col" style="display:none;">Task GUID</th>
          <th scope="col">Task ID</th>
          <th scope="col">Task Description</th>
          <th scope="col">Task Type</th>
          <th scope="col">Planned Start</th>
          <th scope="col">Planned End</th>
          <th scope="col">Planned Effort</th>
          <th scope="col">Actual Start</th>
          <th scope="col" >Actual End</th>
          <th scope="col">Actual Effort</th>
          <th scope="col" style="width:150px;">Task Status</th>
        </tr>
      </thead>
      <tbody id="tbody_admin_step_search">
      </tbody>
    </table>
  </div>
    <button type="button" onclick="exporttable2toexcel()" class="btn btn-secondary expbtn">Export to excel</button>
    <button type="button" onclick="exporttable2topdf()" class="btn btn-secondary expbtn">Export to pdf</button>
  </div>
</center>
<!-- ######################################################################################################################################### -->
    <!--Edit Task Modal Admin-->
    <div class="modal fade" id="edit_task_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Task Details</h5>
            <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form id="task_edit_form" name="form1" method="get"  >
              <div  class="form-group">
                <label  for="assignto1">Assigned to:
              </label>
              <select class="form-control" id="assignto1" name="assignto1">
                </select>
                <!-- <input  type="text" class="form-control" id="assignto1" placeholder="Assign to" name="assignto1" > -->
              </div>
            <div  class="form-group">
              <label  for="tguid" style="display:none;">Task GUID:
            </label>
              <input type="text" class="form-control" id="tguid1" placeholder="Task GUID" name="tguid1" style="display:none;" readonly>
            </div>
            <div  class="form-group">
              <label  for="tsequenceid1" style="display:none;">Task Sequence ID:
            </label>
              <input type="text" class="form-control" id="tsequenceid1" placeholder="Task Sequence ID" name="tsequenceid1" style="display:none;" readonly>
            </div>
            <div  class="form-group">
              <label  for="tid1">Task ID:
            </label>
              <input type="text" class="form-control" id="tid1" placeholder="Task ID" name="tid1" >
            </div>

            <div  class="form-group">
              <label  for="tdescription1">Task Description:
            </label>
              <input type="text" class="form-control" id="tdescription1" placeholder="Task Description" name="tdescription1" >
            </div>
            <div  class="form-group">
              <label  for="ttype1">Task Type:
            </label>
              <input type="text" class="form-control" id="ttype1" placeholder="Task Type" name="ttype1">
            </div>
            <div  class="form-group">
              <label  for="pstart1">Planned Start
            </label>
              <input type="date" class="form-control" id="pstart1" placeholder="Planned Start" name="pstart1">
            </div>
            <div  class="form-group">
              <label  for="pend1">Planned End:
            </label>
              <input type="date" class="form-control" id="pend1" placeholder="Planned End" name="pend1">
            </div>
            <div  class="form-group">
              <label  for="ttype1">Planned Effort:
            </label>
              <input type="text" class="form-control" id="peffort1" placeholder="Planned Effort" name="peffort1">
            </div>
            <div  class="form-group">
              <label  for="astart1">Actual Start
            </label>
              <input type="date" class="form-control" id="astart1" placeholder="Actual Start" name="astart1">
            </div>
            <div  class="form-group">
              <label  for="aend1">Actual End:
            </label>
              <input type="date" class="form-control" id="aend1" placeholder="Actual End" name="aend1">
            </div>
            <div  class="form-group">
              <label  for="aeffort1">Actual Effort:
            </label>
              <input type="text" class="form-control" id="aeffort1" placeholder="Actual Effort" name="aeffort1">
            </div>
            <div  class="form-group">
              <label  for="tstatus1">Task Status:
            </label>
            <select class="form-control" id="tstatus1" name="tstatus1">
              <option selected="true" value= 0>--Select Task Phase--</option>
                <option value=1>To be Planned</option>
                <option value=2>Planned</option>
                <option value=3>In Progress</option>
                <option value=4>Completed</option>
                <option value=5>On Hold</option>
                <option value=6>Awaiting</option>

              </select>
              <!-- <input type="text" class="form-control" id="tstatus1" placeholder="Task Status" name="tstatus1"> -->
            </div>
            <!-- data-dismiss="modal" -->
            <button type="button" class="btn btn-secondary close1" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary edittaskbtn" id="edittaskbtn" name="edittaskbtn" >Save</button>
          </form>
          <div class="alert alert-success alert-dismissible" id="successedittask" style="display:none;" >

          </div>
          <div class="alert alert-danger alert-dismissible" id="erroredittask" style="display:none;">

          </div>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <script src="admin_script.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.js"></script> -->
    <script src="	https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <!-- <script src="https://cdn.rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script> -->
    <!-- <script src="jquery.table2excel.js"></script> -->
    <!-- <script type="text/javascript" src="jspdf.debug.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->
    <!-- <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> -->
    <script src="https://rawgit.com/davidkonrad/table2excel/master/table2excel.js"></script>

  </body>
</html>
