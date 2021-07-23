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
    <title>My Team Leave Plan</title>
    <script src="team_vacation.js"></script>
    <style>
    .vremark_format{
      max-width: 400px;
    }
    .row_vacation_table:hover {
      background-color:#DEDBEE;

    }
    .vguid_vacation_table{
      display:none;
    }
    .createdfor_vacation_table{
      display:none;
    }
    </style>
  </head>
  <body>
      <img src="pics/logo.jpg" alt="LTI-Veolia Logo" style="height:70px;width:auto;">
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
<!-- ########################################################################################################################################### -->
  <!-- Approve/Reject Vacation Modal -->
    <div class="modal fade" id="approve_reject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="app_rej_modal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Take action for the Vacation Plan</h5>
            <button type="button" class="close close1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="app_rej_form" name="app_rej_form" method="post"  >

            <div  class="form-group">
              <label  for="vguid" style="display:none;">VGUID:
            </label>
              <input type="text" class="form-control" id="vguid" placeholder="VGUID" name="vguid" style="display:none;" readonly>
            </div>
            <div  class="form-group">
              <label  for="createdfor" >Name:
            </label>
              <input type="text" class="form-control" id="createdfor" placeholder="Created for" name="createdfor" readonly>
            </div>
            <div  class="form-group">
              <label  for="vstart" >Vacation Start Date:
            </label>
              <input type="text" class="form-control" id="vstart" placeholder="Start Date" name="vstart" readonly>
            </div>
            <div  class="form-group">
              <label  for="vend" >Vacation End Date:
            </label>
              <input type="text" class="form-control" id="vend" placeholder="End Date" name="vend" readonly>
            </div>
            <div  class="form-group">
              <label  for="vend" >Reason:
            </label>
              <input type="text" class="form-control" id="vreason" placeholder="Reason" name="vreason" readonly>
            </div>
            <div  class="form-group">
              <label  for="vremark_action">Remark:
            </label>
              <input type="text" class="form-control" id="vremark_action" placeholder="Remark" name="vremark_action" >
            </div>


            <button type="button" class="btn btn-secondary close1" data-dismiss="modal" >Close</button>
            <button type="submit" class="btn btn-primary approve_vacation" id="approve_vacation" name="approve_vacation"  >Approve</button>
            <button type="submit" class="btn btn-primary reject_vacation" id="reject_vacation" name="reject_vacation">Reject</button>
            <button type="submit" class="btn btn-primary cancel_vacation" id="cancel_vacation" name="reject_vacation">Cancel</button>
          </form>
          <div class="alert alert-success alert-dismissible" id="success_action" style="display:none;" >

          </div>
          <div class="alert alert-danger alert-dismissible" id="error_action" style="display:none;">

          </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

    <br><br>
    <h1 style="text-align:center;" id="headone">Planned team vacations</h1><br><br><br>
    <center>
      <div id="teamvacation_appr_div" style="display:contents">
        <table class="table table-hover" id="teamvacation_appr_table">
          <thead>
            <tr>
              <th scope="col" style="display:none;">VGUID</th>
              <th scope="col" style="display:none;">Created for(id)</th>
              <th scope="col">Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Reason</th>
              <th scope="col">Remarks</th>
              <th scope="col">Action Taken</th>

            </tr>
          </thead>
          <tbody id="tbody_team_vacation_appr">
          </tbody>
        </table>
      </div>
      <br><br><br>
    </center>
    <h1 style="text-align:center;" id="headone">Team Vacations (Action Pending)</h1><br><br>
    <center>
      <div id="teamvacation_div" style="display:contents">
        <table class="table table-hover" id="teamvacation_table">
          <thead>
            <tr>
              <th scope="col" style="display:none;">VGUID</th>
              <th scope="col" style="display:none;">Created for(id)</th>
              <th scope="col">Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Reason</th>
              <th scope="col">Remarks</th>
              <th scope="col">Approve/Reject</th>

            </tr>
          </thead>
          <tbody id="tbody_team_vacation">
          </tbody>
        </table>
      </div>
      <br><br><br>
    </center>
    <h1 style="text-align:center;" id="headone">Team Vacation History</h1><br><br>
    <center>
      <div id="teamvacation_div_history" style="display:contents">
        <table class="table table-hover" id="teamvacation_history_table">
          <thead>
            <tr>
              <th scope="col" style="display:none;">VGUID</th>
              <th scope="col" style="display:none;">Created for(id)</th>
              <th scope="col">Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Reason</th>
              <th scope="col">Remarks</th>
              <th scope="col">Action Taken</th>

            </tr>
          </thead>
          <tbody id="tbody_team_vacation_history">
          </tbody>
        </table>
      </div>
      <br><br><br>
    </center>

    <!-- <form method="post" action="testjson.php">
      <button name="create" type="submit">Create JSON</button>
    </form> -->
  </body>
</html>
