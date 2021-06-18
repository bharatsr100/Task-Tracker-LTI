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

    <style>
    #tstage1{
    /* -webkit-text-stroke-width: 0.5px;
  -webkit-text-stroke-color: white;
  -webkit-font-smoothing: antialiased; */
  font-weight: 500;
  text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
   /* border: solid 1px #000; */
   border-radius: 10px;
    }
    #updatemodal{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }
    #planmodal{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }
    #holdmodal{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }
    #awaitmodal{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }
    #deletemodal{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }

    </style>

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
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createtaskmodal">

    <i class="fas fa-plus"></i>  Create Task
    </button>
    <br>
    <a href="#" onclick="testfunction(129);" style="display:none">Cick here</a>
    <!-- ######################################################################################################################################### -->
    <!--Create Task Modal -->

    <div class="modal fade" id="createtaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <input type="text" class="form-control" id="ttype" placeholder="Task Type" name="ttype">
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
            <div class="action" style="display:none">
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
    <!-- ######################################################################################################################################### -->
    <!-- Update task modal -->
    <div class="modal fade" id="updatetaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="updatemoda">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="update_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="updatetask">Update</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <!-- Plan task modal -->
    <div class="modal fade" id="plantaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="planmodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Plan task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="plan_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="pstart">Planned Start:
            </label>
              <input type="date" class="form-control" id="pstart" placeholder="Planned Start" name="pstart">
            </div>
            <div  class="form-group">
              <label  for="ttype">Planned End:
            </label>
              <input type="date" class="form-control" id="pend" placeholder="Planned End" name="pend">
            </div>
            <div  class="form-group">
              <label  for="comment">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="plantask">Plan</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
      <!--Hold Task Modal -->
    <div class="modal fade" id="holdtaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="holdmodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hold task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="hold_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="holdtask">Put On Hold</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <!--Edit Task Modal-->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Task Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="task_form1" name="form1" method="post" action="updatetask.php" >
            <div  class="form-group">
              <label style="display:none;" for="tguid">Task GUID:
            </label>
              <input style="display:none;" type="text" class="form-control" id="tguid1" placeholder="Task GUID" name="tguid1" >
            </div>
            <div  class="form-group">
              <label  for="tid">Task ID:
            </label>
              <input type="text" class="form-control" id="tid1" placeholder="Task ID" name="tid1" >
            </div>
            <div  class="form-group">
              <label  for="tdescription">Task Description:
            </label>
              <input type="text" class="form-control" id="tdescription1" placeholder="Task Description" name="tdescription1" >
            </div>
            <div  class="form-group">
              <label  for="ttype">Task Type:
            </label>
              <input type="text" class="form-control" id="ttype1" placeholder="Task Type" name="ttype1">
            </div>

            <div  class="form-group">
              <label  for="assignto">Assign to
            </label>
              <input type="text" class="form-control" id="assignto1" placeholder="Assigned to" name="assignto1">
            </div>
            <div  class="form-group">
              <label  for="pstart">Planned Start
            </label>
              <input type="date" class="form-control" id="pstart1" placeholder="Planned Start" name="pstart1">
            </div>
            <div  class="form-group">
              <label  for="pend">Planned End:
            </label>
              <input type="date" class="form-control" id="pend1" placeholder="Planned End" name="pend1">
            </div>
            <div  class="form-group">
              <label  for="ttype">Planned Effort:
            </label>
              <input type="text" class="form-control" id="peffort1" placeholder="Planned Effort" name="peffort1">
            </div>
            <!-- <div  class="form-group">
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
            <div class="action" style="display:none">
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
          </div> -->
            <!-- <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment1" placeholder="Comment" name="comment">
            </div> -->

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="edittaskbtn" name="edittaskbtn" >Save</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <!-- Update task modal -->
    <div class="modal fade" id="updatetaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="updatemodal2">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="update_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="updatetask">Update</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
      <!--Hold Task Modal -->
    <div class="modal fade" id="holdtaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="holdmodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hold task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="hold_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="holdtask">Put On Hold</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
      <!--Hold Task Modal -->
    <div class="modal fade" id="awaittaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="awaitmodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Await task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="await_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="awaittask">Awaiting Someone</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
  <!--Await Task Modal -->
    <div class="modal fade" id="deletetaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="deletemodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this task?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="delete_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="ttype">Comment:
            </label>
              <input type="text" class="form-control" id="comment" placeholder="Comment" name="comment">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary" id="deletetask">Yes</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">Task Creation Date</th>
        <th scope="col" style="display:none;">Task GUID</th>


        <th scope="col">Task ID</th>
        <th scope="col">Task Description</th>
        <th scope="col">Task Type</th>
        <th scope="col">Planned Start</th>
        <th scope="col">Planned End</th>
        <th scope="col">Planned Effort</th>
        <th scope="col">Actual Start</th>
        <th scope="col">Actual End</th>
        <th scope="col">Actual Effort</th>

        <th scope="col">Task Status</th>
        <th scope="col" style="display:none;">Actions</th>
        <!-- <th scope="col">Task Stage</th>
        <th scope="col">Created By</th> -->
      </tr>
      </thead>
      <?php
  include 'database.php';
  $uguid=$_SESSION['uguid'];
  //$sql2= "SELECT ttable.createdon,ttable.tid,ttable.tdescription,tstep.pstart,tstep.pend,tstep.peffort,tstep.astart,tstep.aend,tstep.aeffort FROM ttable,tstep WHERE ttable.tguid=tstep.tguid";
  $sql2="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.createdby='$uguid'";
  //$sql3="select * from tstatus where tguid="
  //$result=mysql_query("SELECT ttable.* , tstatus.* FROM tbl_categories c,tbl_products p WHERE c.cat_id=p.cat_id");
  $result=mysqli_query($conn, $sql2);

  while($row=mysqli_fetch_assoc($result))
  {
  ?>
      <tr>
        <th scope="row"><?php echo $row['createdon']; ?></th>
        <td style="display:none;"><?php echo $row['tguid']; ?></td>

        <td><button onclick="location.href='#';" type="button" class="btn btn-success editbtn" ><?php echo $row['tid']; ?></button></td>

        <td><?php echo $row['tdescription']; ?></td>
         <td><?php echo $row['ttype']; ?></td>
        <td><?php

        // $date1=$row['pstart'];
        // $datenow=date("Ymd");
        // echo("<script>console.log('Planned Start: " . $date1 . "');</script>");
        // $newdate1 = date("Ymd", strtotime($date1));
        // echo("<script>console.log('Planned Start: " . $newdate1 . "');</script>");
        // echo("<script>console.log('Date Now: " . $datenow . "');</script>");
        // $diff= $datenow-$newdate1;
        // echo("<script>console.log('Difference: " . $diff . "');</script>");

        if($row['pstart']=="0000-00-00") {echo "";}
        else {echo $row['pstart'];}
         ?></td>

        <td><?php
        if($row['pend']=="0000-00-00") echo "";
         else echo $row['pend']; ?></td>
        <td><?php echo $row['peffort']; ?></td>
        <td><?php
        if($row['astart']=="0000-00-00") echo "";
        else echo $row['astart']; ?></td>
        <td><?php


        if($row['aend']=="0000-00-00") echo "";
        else echo $row['aend']; ?></td>
        <td><?php echo $row['aeffort']; ?></td>
         <td id="tstage1" bgcolor=<?php

         date_default_timezone_set("Asia/Kolkata");
         if($row['tstage']==1) echo "#BEBFCC";
         else if($row['tstage']==2 || $row['tstage']==3){

           $date1=$row['pend'];
           $newdate1 = date("Ymd", strtotime($date1));
           $datenow=date("Ymd");
           $diff= $newdate1-$datenow;

           if($diff>2) echo "#5FDB39";
           else if($diff<=2 && $diff>=0) echo "#F39536";
           else echo "#EC4819";

          }
         else if($row['tstage']==4) echo "#4BF1F6";
         else if($row['tstage']==5) {

           $date1=$row['pend'];
           $newdate1 = date("Ymd", strtotime($date1));
           $datenow=date("Ymd");
           $diff= $newdate1-$datenow;

           if($diff>2) echo "#EDE310";
           else if($diff<=2 && $diff>=0) echo "#8C1BE0";
           else echo "#2227E3";


           }
         else if($row['tstage']==6) {

           $date1=$row['pend'];
           $newdate1 = date("Ymd", strtotime($date1));
           $datenow=date("Ymd");
           $diff= $newdate1-$datenow;

           if($diff>2) echo "#F2EC82";
           else if($diff<=2 && $diff>=0) echo "#C28BEA";
           else echo "#878AE0";


         }
         ?>><?php
         if($row['tstage']==1) echo "<b>To be planned</b>";
         else if($row['tstage']==2) echo "<b>Planned but not started</b>";
         else if($row['tstage']==3) echo "<b>In Progress</b>";
         else if($row['tstage']==4) echo "<b>Completed</b>";
         else if($row['tstage']==5) echo "<b>On Hold</b>";
         else if($row['tstage']==6) echo "<b>Awaiting</b>"; ?></td>
        <td style="display:none;">
          <a href="#updatetaskmodal"  data-toggle="modal" data-target="#updatetaskmodal"><i data-toggle="tooltip" data-placement="left" title="Update Task" class="fas fa-edit" style="font-size:20px;" id="update"></i></a>
          &nbsp;
          <a href="#plantaskmodal"  data-toggle="modal" data-target="#plantaskmodal"><i data-toggle="tooltip" data-placement="left" title="Plan Task" class="far fa-play-circle" style="font-size:20px;" id="plan"></i></a>
          &nbsp;
          <a href="#holdtaskmodal"  data-toggle="modal" data-target="#holdtaskmodal"><i  data-toggle="tooltip" data-placement="left" title="Put task on hold" class="fas fa-pause-circle" style="font-size:20px;" id="on hold"></i></a>
          &nbsp;
          <a href="#awaittaskmodal"  data-toggle="modal" data-target="#awaittaskmodal"><i  data-toggle="tooltip" data-placement="left" title="Awaiting for someone" class="fas fa-user-edit" style="font-size:20px;" id="Awaiting"></i></a>
          <!--   &nbsp;
        <a href="#deletetaskmodal"  data-toggle="modal" data-target="#deletetaskmodal"><i data-toggle="tooltip" data-placement="left" title="Delete Task" class="fas fa-trash-alt" style="color:red;font-size:20px;" id="delete"></i></a> -->


        </td>

      </tr>
      <?php
  }
  ?>
    </table>
    <script>

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();

  // testfunction = function(item_id) {
  //   console.log(item_id);
  // };
  $('.editbtn').on('click',function(){
    $tr= $(this).closest('tr');
    var data=$tr.children("td").map(function(){
    return $(this).text();
    }).get();
    console.log(data);
    if(data[4]!=""){
    //  $('#editmodal').modal('hide');
    alert("Task is already planned please contact your admin");
     }

     else{
       $('#editmodal').modal('show');

       $('#tid1').val(data[1]);
       $('#tguid1').val(data[0]);
       //$('#assignto1').val(data[2]);
       $('#tdescription1').val(data[2]);
       $('#ttype1').val(data[3]);

     }

  });
});


</script>

  </body>
</html>
