<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css
    https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css" rel="stylesheet">


    <!-- https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js
    https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js
    https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script> -->
    <script src="moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>

    <link rel="stylesheet" href="calendarstyle.css">


  </head>
  <body>

    <div id="container" style="margin-top:50px;margin-left:auto;margin-right:auto;">
      <div><h3 style="text-align:center;"><b>My Calendar</b></h3></div>
      <div id="header" style="margin-top:60px;">
        <div id="monthDisplay"></div>
        <div>
            <a href="welcome.php"  ><i data-toggle="tooltip" data-placement="left" title="Home Page" class="fas fa-home" style="font-size:30px;" id="homebtn"></i></a>
          <div class="btn-group dropleft" >
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Calendar Type
          </button>
          <div class="dropdown-menu">

            <a class="dropdown-item" href="calendar.php" onclick="">Daily</a>
            <a class="dropdown-item" href="calendar_weekly.php" onclick="">Weekly</a>
            <a class="dropdown-item" href="calendar_monthly.php" onclick="">Monthly</a>


          </div>
          </div>
          <button id="todayButton" class="btn btn-primary">Today</button>
          <button id="backButton" class="btn btn-secondary">Back</button>
          <button id="nextButton" class="btn btn-secondary">Next</button>
        </div>
      </div>

      <div id="weekdays">
        <div class="weekdaysin" id="weekday1">Sunday</div>
        <div class="weekdaysin">Monday</div>
        <div class="weekdaysin">Tuesday</div>
        <div class="weekdaysin">Wednesday</div>
        <div class="weekdaysin">Thursday</div>
        <div class="weekdaysin">Friday</div>
        <div class="weekdaysin">Saturday</div>
      </div>

      <div id="calendar"></div>
    </div>
    <!-- ######################################################################################################################################### -->
  <!--To be planned Task Modal -->
    <div class="modal fade" id="showstage1tasks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="stage1title">To be Planned tasks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="stage1list">


          </ul>
          <br><br>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- ######################################################################################################################################### -->
    <!--Safe Task Modal -->
      <div class="modal fade" id="showssafetasks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog alltaskm" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="safetitle">Safe tasks</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <ul class="list-group" id="safelist">
              <li class="list-group-item "></li>

            </ul>
            <br><br>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <!-- ######################################################################################################################################### -->
      <!--Deadline approaching Task Modal -->
        <div class="modal fade" id="showsdeadlineapptasks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog alltaskm" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deadlineapptitle">Deadline approaching tasks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="list-group" id="deadlineapplist">
                <li class="list-group-item "></li>

              </ul>
              <br><br>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
        <!-- ######################################################################################################################################### -->
        <!--Deadline passed Task Modal -->
          <div class="modal fade" id="showsdeadlinepasstasks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog alltaskm" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deadlinepasstitle">Deadline Passed tasks</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <ul class="list-group" id="deadlinepasslist">
                  <li class="list-group-item "></li>

                </ul>
                <br><br>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
          <!-- ######################################################################################################################################### -->
          <!--All Tasks Modal -->
            <div class="modal fade" id="showalltasks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog alltaskm" role="document" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="alltaskstitle">All tasks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <ul class="list-group" id="alltaskslist">
                    <li class="list-group-item "></li>

                  </ul>
                  <br><br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>


              <!-- ######################################################################################################################################### -->
              <!-- Vacation / Out of office modal -->
              <div class="modal fade" id="vacationplanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="vacationplantitle">Out of Office/Vacation Planner</h5>
                      <button type="button" class="close close2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="ooo_form" method="get">
                        <div  class="form-group">
                          <label  for="vstart">Vacation Start
                        </label>
                          <input type="date" class="form-control" id="vstart" placeholder="Vacation Start" name="vstart">
                        </div>
                        <div  class="form-group">
                          <label  for="vend">Vacation End:
                        </label>
                          <input type="date" class="form-control" id="vend" placeholder="Vacation End" name="vend">
                        </div>

                      <div  class="form-group">
                        <label  for="reason">Reason
                      </label>
                      <select class="form-control" id="reason" name="reason">
                        <option selected="true" value=0>--Select Reason--</option>
                          <option value="spld">Special Day</option>
                          <option value="sick">Sick Leave</option>
                          <option value="emeg">Emergency</option>
                          <option value="unpl">Unplanned</option>

                        </select>
                      </div>

                        <div  class="form-group">
                          <label  for="remark">Remark
                        </label>
                          <input type="text" class="form-control" id="remark" placeholder="Remark" name="remark">
                        </div>

                        <button type="button" class="btn btn-secondary close1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary createooo1" name="createooo" id="createooo">Save</button>

                      </form>
                      <div class="alert alert-success alert-dismissible" id="successooo" style="display:none;" >

                      </div>
                      <div class="alert alert-danger alert-dismissible" id="errorooo" style="display:none;">

                      </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>

              <!-- ######################################################################################################################################### -->
              <!-- Remarks modal -->
              <div class="modal fade" id="remarksmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog alltaskm" role="document" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="remarkstitle">Remarks</h5>
                      <button type="button" class="close close2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="cancel_form" method="get">
                        <div  class="form-group">
                          <label  for="vguid" style="display:none;">VGUID
                        </label>
                          <input type="text" class="form-control" id="vguid" placeholder="VGUID" name="vguid" style="display:none;">
                        </div>

                        <div  class="form-group">
                          <label  for="vremark">Remark
                        </label>
                          <input type="text" class="form-control" id="vremark" placeholder="Remark" name="vremark">
                        </div>

                        <button type="button" class="btn btn-secondary close1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger cancelooo" name="cancelooo" id="cancelooo">Cancel Vacation</button>

                      </form>
                      <br><br>
                      <h3 style="text-align: center;"><b>Remarks History</b></h3>
                      <ul class="list-group" id="remarkslist">


                    </ul>

                    </div>

                      <div class="alert alert-success alert-dismissible" id="csuccess" style="display:none;" >

                      </div>
                      <div class="alert alert-danger alert-dismissible" id="cerror" style="display:none;">

                      </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>

<!-- #####################################################################################################-->

    <div id="newEventModal">
      <h2>New Event</h2>

      <input id="eventTitleInput" placeholder="Event Title" />

      <button id="saveButton">Save</button>
      <button id="cancelButton">Cancel</button>
    </div>

    <div id="deleteEventModal">
      <h2>Event</h2>

      <p id="eventText"></p>

      <button id="deleteButton">Delete</button>
      <button id="closeButton">Close</button>
    </div>

    <div id="modalBackDrop" ></div>
    <script src="calendarscript.js"></script>



  </body>
</html>
