<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);

// if( isset($_POST['tguidstep']) ){
// $tguidstep= $_POST['tguidstep'];
//
// $arr = array (
//           "tguidstep"=> ""
//         );
// $arr['tguidstep']=$tguidstep;
// $_SESSION['taskguid']=$arr['tguidstep'];
//  echo json_encode($arr);
//  exit;
// }
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

    <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link red="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"> -->
    <script src="app_task.js"></script>
    <title>my tasks</title>

    <style>
    #mytasktable{
      margin:auto;

    }
.table td, .table th, .table thead th {
    vertical-align: middle;
}
    /* #tstage1{
     -webkit-text-stroke-width: 0.5px;
  -webkit-text-stroke-color: white;
  -webkit-font-smoothing: antialiased;
  font-weight: 500;
  text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6);
    border: solid 1px #000;
   border-radius: 10px;
    } */
    #completetask{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }
    #starttask{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
    }
    #forwardtask{
      top:10%;
      right:-30%;
      outline: none;
      overflow:hidden;
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
      #commentbtn1{
        font-weight: 400;
        background: white;
      }
      #stepbtn12{
        background: white;
      }
      #stepbtn12:hover {

        color: white;
        }
      /* #taskstep{
         border: 1px solid #ddd;
          width: 90%;
      } */
      .stmodal{
        max-width: 70%;
      }
      .ctmodal{
        max-width: 70%;
      }
      #commenttask3{
        border: 1px solid #ddd;
        width: 90%;
      }


    </style>

  </head>
  <body>

    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center;">My Tasks</h1>
    <!-- Default dropleft button -->
<div class="btn-group dropleft" style="float: right;">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Color Index
  </button>

    <div class="dropdown-menu">
      <a class="dropdown-item" href="#/"><b>Task in Progress</b></a>
      <br>
      <a class="dropdown-item" href="#/"><i style="color:#5FDB39;font-size:20px;"class="fas fa-circle"></i>&nbsp; End Date is more than 48 calendar hours</a>
      <a class="dropdown-item" href="#/"><i style="color:#F39536 ;font-size:20px;"class="fas fa-circle"></i>&nbsp; End Date is within next 48 clendar hours</a>
      <a class="dropdown-item" href="#/"><i style="color:#EC4819 ;font-size:20px;"class="fas fa-circle"></i>&nbsp; Deadline is already passed</a>

      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#/"><b>Task on Hold</b></a>
      <br>
      <a class="dropdown-item" href="#/"><i style="color:#EDE310;font-size:20px;"class="fas fa-circle"></i>&nbsp; End Date is more than 48 calendar hours</a>
      <a class="dropdown-item" href="#/"><i style="color:#8C1BE0;font-size:20px;"class="fas fa-circle"></i>&nbsp; End Date is within next 48 clendar hours</a>
      <a class="dropdown-item" href="#/"><i style="color:#2227E3 ;font-size:20px;"class="fas fa-circle"></i>&nbsp; Deadline is already passed</a>


    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#/"><b>Task Awaiting</b></a>
    <br>
    <a class="dropdown-item" href="#/"><i style="color:#F2EC82 ;font-size:20px;"class="fas fa-circle"></i>&nbsp; End Date is more than 48 calendar hours</a>
    <a class="dropdown-item" href="#/"><i style="color:#C28BEA ;font-size:20px;"class="fas fa-circle"></i>&nbsp; End Date is within next 48 clendar hours</a>
    <a class="dropdown-item" href="#/"><i style="color:#878AE0 ;font-size:20px;"class="fas fa-circle"></i>&nbsp; Deadline is already passed</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#/"><b>Task yet to be planned</b></a>
    <br>
    <a class="dropdown-item" href="#/"><i style="color:#BEBFCC ;font-size:20px;"class="fas fa-circle"></i>&nbsp; Task is yet to be planned</a>

  </div>



</div>


    <!-- <button onclick="location.href='mytask.php';" type="button" class="btn btn-secondary"><i class="fas fa-plus"></i>  Create Task</button> -->
    <!-- Button trigger modal -->
    <!-- <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
    </div>
    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
    </div> -->
    <button onclick="location.href='#'" type="button" class="btn btn-secondary createbtn">

    <i class="fas fa-plus"></i>  Create Task
    </button>
    <br>

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
              <label  for="peffort">Planned Effort:
            </label>
              <input type="text" class="form-control" id="peffort" placeholder="Planned Effort" name="peffort">
            </div>
            <div class="action" style="display:none">
            <div  class="form-group">
              <label  for="astart">Actual Start:
            </label>
              <input type="date" class="form-control" id="astart" placeholder="Actual Start" name="astart" value="">
            </div>
            <div  class="form-group">
              <label  for="aend">Actual End:
            </label>
              <input type="date" class="form-control" id="aend" placeholder="Actual End" name="aend" value="">
            </div>
            <div  class="form-group">
              <label  for="aeffort">Actual Effort:
            </label>
              <input type="text" class="form-control" id="aeffort" placeholder="Actual Effort" name="aeffort" value="">
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
            <button type="submit" class="btn btn-primary createtask1" id="createtask">Create</button>
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
              <input type="text" class="form-control" id="comment1" placeholder="Comment" name="comment">
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
              <input type="date" class="form-control" id="pstart2" placeholder="Planned Start" name="pstart">
            </div>
            <div  class="form-group">
              <label  for="ttype">Planned End:
            </label>
              <input type="date" class="form-control" id="pend2" placeholder="Planned End" name="pend">
            </div>
            <div  class="form-group">
              <label  for="comment">Comment:
            </label>
              <input type="text" class="form-control" id="comment2" placeholder="Comment" name="comment">
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
              <input type="text" class="form-control" id="comment3" placeholder="Comment" name="comment">
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
    <!--Start Task Modal -->
  <div class="modal fade" id="starttaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="starttask">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Start task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <form id="start_form" name="form1" method="post" >

          <div  class="form-group">
            <label  for="ttype">Comment:
          </label>
            <input type="text" class="form-control" id="commentstart" placeholder="Comment" name="comment">
          </div>

          <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
          <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="starttask12">Start Task</button>
        </form>

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- ######################################################################################################################################### -->
  <!--Forward Task Modal -->
<div class="modal fade" id="forwardtaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="forwardtask">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forward task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div  class="form-group">
          <label  for="forwardto12">Forward to:
        </label>
          <input type="text" class="form-control" id="forwardto12" placeholder="Forward To" name="forwardto12">
        </div>



        <div  class="form-group">
          <label  for="commentforward">Comment:
        </label>
          <input type="text" class="form-control" id="commentforward" placeholder="Comment" name="commentforward">
        </div>

        <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
        <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="forwardtask12">Forward Task</button>
      </form>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- ######################################################################################################################################### -->
<!--Complete Task Modal -->
<div class="modal fade" id="completetaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document" id="completetask">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Complete task</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <div  class="form-group">
        <label  for="commentforward">Comment:
      </label>
        <input type="text" class="form-control" id="commentcomplete" placeholder="Comment" name="commentcomplete">
      </div>

      <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
      <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary" id="completetask12">Complete Task</button>
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
            <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
            </div>
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
      <!-- Step task modal -->
      <div class="modal fade" id="stepmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog stmodal" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Task Step Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="stepmodalbody">
              <div  class="form-group">
              <label style="display:none;" for="tguid2">Task GUID:
            </label>
              <input style="display:none;" type="text" class="form-control" id="tguid2" placeholder="Task GUID" name="tguid2" >
            </div>
            <div  class="form-group">
              <label style="display:none;" for="tid2">Task ID:
            </label>
              <input style="display:none;" type="text" class="form-control" id="tid2" placeholder="Task ID" name="tid2" >
            </div>

            <center>
             <div id="tsteps" style="display:contents">
            <table  class="table table-hover" id="taskstep">
              <thead>
              <tr>
                <!-- <th scope="col">Select</th> -->
                <th scope="col">Task GUID</th>
                <th scope="col">Task Sequence</th>
                <!-- <th scope="col" style="display:none;">Task ID</th> -->
                <!-- <th scope="col">Task Sequence No</th> -->
                <th scope="col">Task Step Description</th>
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

            <tbody id="tbodystep">
            </tbody>
            </table>
          </div>


                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="stepstaskbtn" name="steptaskbtn" >Save</button> -->

                <br><br><br><br><h5>Task Steps List</h5>
                <table  class="table table-hover" id="tasksteplist">
                  <thead>
                  <tr>
                    <th scope="col">Task GUID</th>
                    <th scope="col">Task Sequence</th>
                    <th scope="col">Task Step Description</th>
                    <th scope="col">Action </th>
                  </tr>
                </thead>

              <tbody id="tbodylist">

              </tbody>
              </table>



              </center>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    <!-- ######################################################################################################################################### -->

    <!-- ######################################################################################################################################### -->
      <!--Await Task Modal -->
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
              <input type="text" class="form-control" id="comment6" placeholder="Comment" name="comment">
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
  <!--Delete Task Modal -->
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
              <input type="text" class="form-control" id="comment7" placeholder="Comment" name="comment">
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

          <form id="delete_form2" name="form1" method="post" >

            <div  class="form-group">
              <label  for="tguidd">TGUID:
            </label>
              <input type="text" class="form-control" id="tguidd" placeholder="Task Sequence ID" name="tguidd">
            </div>
            <div  class="form-group">
              <label  for="tguidd">Task Sequence ID:
            </label>
              <input type="text" class="form-control" id="tsequenceidd" placeholder="TGUID" name="tsequenceidd">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary" id="deletetaskd">Yes</button>
          </form>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  <!-- ######################################################################################################################################### -->
      <!--Comment Modal -->
    <div class="modal fade" id="commenttaskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog ctmodal" role="document" id="commentmodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger alert-dismissible" id="error12" style="display:none;">
            </div>
            <br>

          <form id="comment_form" name="form1" action="updatetask.php" method="post" >

            <div  class="form-group">
              <label  for="tguid4" style="display:none;">TGUID:
            </label>
              <input type="text" class="form-control" id="tguid4" placeholder="TGUID" name="tguid4" style="display:none;">
            </div>
            <div  class="form-group">
              <label  for="userslist">Assign to:
            </label>
            <select class="form-control" id="userslist" name="userslist">
            </select>

            </div>
            <div  class="form-group">
              <label  for="tstatus4">Task Status:
            </label>
            <select class="form-control" id="tstatus4" name="tstatus4">
              <option selected="true">---Select Task Status---</option>
                <option>In Progress</option>
                <option>Completed</option>
                <option>On hold</option>
                <option>Awaiting</option>

              </select>

              <!-- <input type="text" class="form-control" id="tstatus4" placeholder="Task Status" name="tstatus4"> -->
            </div>
            <div  class="form-group">
              <label  for="comment4">New Comment:
            </label>
              <input type="text" class="form-control" id="comment4" placeholder="New Comment" name="comment4">
            </div>

            <!-- <input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
            <input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="savecomment" name="savecomment">Save Comment</button>
          </form>
          <br><br><br>
          <center><h1 >Comment History</h1>
          <br><br>
          <div id="tcomments" style="display:contents">
          <table class="table table-hover" id="commenttask3">

            <thead>
            <tr>

              <th scope="col" >Commented On</th>
              <th scope="col" >Commented At</th>
              <th scope="col">Commment</th>
            </tr>
            </thead>

            <tbody id="tbodycomment">
            </tbody>

          </table>
        </div>
          </center>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <!-- my task table -->
    <table  class="table" id="mytasktable" >
      <thead>
      <tr>
        <th scope="col">Task Creation Date</th>
        <th scope="col" style="display:none;" >Task GUID</th>
        <th scope="col">Task ID</th>
        <th scope="col">Task Description</th>
        <th scope="col">Task Type</th>
        <th scope="col">Planned Start</th>
        <th scope="col">Planned End</th>
        <th scope="col">Planned Effort</th>
        <th scope="col">Actual Start</th>
        <th scope="col" >Actual End</th>
        <th scope="col">Actual Effort</th>

        <th scope="col" style="width: 160px;">Task Status</th>
        <th scope="col" style="width: 150px;display:none;">Actions</th>
        <!-- <th scope="col">Task Stage</th>
        <th scope="col">Created By</th> -->
      </tr>
      </thead>
      <?php
  include 'database.php';
  $uguid=$_SESSION['uguid'];
  $sequence="11";
  //$sql2= "SELECT ttable.createdon,ttable.tid,ttable.tdescription,tstep.pstart,tstep.pend,tstep.peffort,tstep.astart,tstep.aend,tstep.aeffort FROM ttable,tstep WHERE ttable.tguid=tstep.tguid";
  $sql2="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.createdby='$uguid' && c.tsequenceid='$sequence'";
  //$sql3="select * from tstatus where tguid="
  //$result=mysql_query("SELECT ttable.* , tstatus.* FROM tbl_categories c,tbl_products p WHERE c.cat_id=p.cat_id");
  $result=mysqli_query($conn, $sql2);

  while($row=mysqli_fetch_assoc($result))
  {
  ?>
      <tr>

        <th scope="row" style="font-weight:400;"><?php echo $row['createdon']; ?></th>
        <td style="display:none;" ><?php echo $row['tguid']; ?></td>

        <td><button onclick="location.href='#'" type="button" class="btn btn-success editbtn" style="color: black;font-weight: 700;background-color:
        <?php


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


          ?>;" >
        <?php echo $row['tid']; ?>
        </button></td>

        <td><?php echo $row['tdescription']; ?></td>
         <td><button  type="submit" class="btn btn-success stpbtn12" id="stepbtn12" style="color: black;font-weight:700;text-decoration: underline; border-color:white"><?php echo $row['ttype']; ?></button></td>
        <td><?php
        //onclick="location.href = 'taskstepsadd_del.php';"

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
         <td ><button type="submit" class="btn btn-success commentbtn" id="commentbtn1" style="color: black; border-color:white"><?php
         if($row['tstage']==1) echo "<b><u>To be planned</b></u>";
         else if($row['tstage']==2) echo "<b><u>In Progress</b></u>";
         else if($row['tstage']==3) echo "<b><u>In Progress</b></u>";
         else if($row['tstage']==4) echo "<b><u>Completed</b></u>";
         else if($row['tstage']==5) echo "<b><u>On Hold</b></u>";
         else if($row['tstage']==6) echo "<b><u>Awaiting</b></u>"; ?></button></td>
        <td style="display:none;">
          <!-- <a href="#updatetaskmodal"  data-toggle="modal" data-target="#updatetaskmodal"><i data-toggle="tooltip" data-placement="left" title="Update Task" class="fas fa-edit" style="font-size:20px;" id="update"></i></a>
          &nbsp;
          <a href="#plantaskmodal"  data-toggle="modal" data-target="#plantaskmodal"><i data-toggle="tooltip" data-placement="left" title="Plan Task" class="far fa-play-circle" style="font-size:20px;" id="plan"></i></a>
          &nbsp;
          <a href="#holdtaskmodal"  data-toggle="modal" data-target="#holdtaskmodal"><i  data-toggle="tooltip" data-placement="left" title="Put task on hold" class="fas fa-pause-circle" style="font-size:20px;" id="on hold"></i></a>
          &nbsp;
          <a href="#awaittaskmodal"  data-toggle="modal" data-target="#awaittaskmodal"><i  data-toggle="tooltip" data-placement="left" title="Awaiting for someone" class="fas fa-user-edit" style="font-size:20px;" id="Awaiting"></i></a> -->
          <a href="#starttaskmodal"  data-toggle="modal" data-target="#starttaskmodal"><i data-toggle="tooltip" data-placement="left" title="Start Task" class="fas fa-play" style="font-size:20px;" id="startt"></i></a>
          &nbsp;
          <a href="#forwardtaskmodal"  data-toggle="modal" data-target="#forwardtaskmodal"><i data-toggle="tooltip" data-placement="left" title="Forward Task" class="fas fa-share-square" style="font-size:20px;" id="forwardt"></i></a>
          &nbsp;
          <a href="#completetaskmodal"  data-toggle="modal" data-target="#completetaskmodal"><i data-toggle="tooltip" data-placement="left" title="Complete Task" class="fas fa-check-circle" style="font-size:20px;" id="completet"></i></a>
          <!--   &nbsp;
        <a href="#deletetaskmodal"  data-toggle="modal" data-target="#deletetaskmodal"><i data-toggle="tooltip" data-placement="left" title="Delete Task" class="fas fa-trash-alt" style="color:red;font-size:20px;" id="delete"></i></a> -->


        </td>

      </tr>
      <?php
  }
  ?>
    </table>
<br><br><br><h1 style="text-align:center;">My Task Steps</h1>
<!-- ####################################################################################################################################################### -->
<!-- Task Sequence Table -->

<table  class="table table-hover" id="taskdequencetable">
  <thead>
  <tr>
    <th scope="col">Created On</th>
    <th scope="col" style="display:none;">Task GUID</th>


    <th scope="col">Task ID</th>
    <!-- <th scope="col">Task Sequence No</th> -->
    <th scope="col">Task Step Description</th>
    <!-- <th scope="col">Task Type</th> -->
    <th scope="col">Planned Start</th>
    <th scope="col">Planned End</th>
    <th scope="col">Planned Effort</th>
    <th scope="col">Actual Start</th>
    <th scope="col">Actual End</th>
    <th scope="col">Actual Effort</th>

    <th scope="col">Task Status</th>
    <!-- <th scope="col">Task Stage</th> -->
    <th scope="col" style="display:none;">Actions</th>
  </tr>
  </thead>
  <?php
include 'database.php';
$uguid=$_SESSION['uguid'];
$sequence="11";
//$sql2= "SELECT ttable.createdon,ttable.tid,ttable.tdescription,tstep.pstart,tstep.pend,tstep.peffort,tstep.astart,tstep.aend,tstep.aeffort FROM ttable,tstep WHERE ttable.tguid=tstep.tguid";
$sql2="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.createdby='$uguid' ";
//$sql3="select * from tstatus where tguid="
//$result=mysql_query("SELECT ttable.* , tstatus.* FROM tbl_categories c,tbl_products p WHERE c.cat_id=p.cat_id");
$result=mysqli_query($conn, $sql2);

while($row=mysqli_fetch_assoc($result))
{
?>
  <tr>
    <th scope="row"><?php echo $row['createdon']; ?></th>
    <td style="display:none;"><?php echo $row['tguid']; ?></td>

    <td><?php echo $row['tid']; ?></td>
    <!-- <td><?php //echo $row['tsequenceid']; ?></td> -->
    <td><?php echo $row['tstepdescription']; ?></td>
     <!-- <td><?php //echo $row['ttype']; ?></td> -->
    <td><?php


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
     <td id="tstage2" bgcolor=<?php

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
<!-- <p id="demo"></p>

<script>
$(document).ready(function() {
function stagefunction(stage){

  var myObject = { 1: 'Planned', 2: 'In Progress', 3: 'On Hold' };
  console.log(myObject);
  return myObject[stage];


}
});
document.getElementById("demo").innerHTML = stagefunction(2);
</script> -->





  </body>
</html>
