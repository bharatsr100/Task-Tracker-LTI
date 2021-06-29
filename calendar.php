<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Task Calendar</title>
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
    <div id="home"><button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; display:none">Home</button>
    </div>
    <br><br>
    <div id="container" style="margin-top:50px;">
      <div id="header">
        <div id="monthDisplay"></div>
        <div>
          <a href="welcome.php"  ><i data-toggle="tooltip" data-placement="left" title="Home Page" class="fas fa-home" style="font-size:30px;" id="homebtn"></i></a>

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
  <!--Delete Task Modal -->
    <div class="modal fade" id="showstage1tasks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" id="deletemodal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="stage1title">To be Planned tasks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="stage1list">
            <li class="list-group-item ">Cras justo odio</li>
            
          </ul>
          <br><br>


            <!-- <h3 id="headstage1" style="text-align:center;">To be Planned Tasks </h3> -->

          <!-- <form id="delete_form" name="form1" method="post" >

            <div  class="form-group">
              <label  for="comment7">Comment:
            </label>
              <input type="text" class="form-control" id="comment7" placeholder="Comment" name="comment7">
            </div>
            </form> -->

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="submit" class="btn btn-primary" id="deletetask">Yes</button> -->


          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>



    <!-- ######################################################################################################################################### -->

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