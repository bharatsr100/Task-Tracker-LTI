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

    <div id="container">
      <div id="header">
        <div id="monthDisplay"></div>
        <div>
          <button id="todayButton" class="btn btn-primary">Today</button>
          <button id="backButton" class="btn btn-secondary">Back</button>
          <button id="nextButton" class="btn btn-secondary">Next</button>
        </div>
      </div>

      <div id="weekdays">
        <div>Sunday</div>
        <div>Monday</div>
        <div>Tuesday</div>
        <div>Wednesday</div>
        <div>Thursday</div>
        <div>Friday</div>
        <div>Saturday</div>
      </div>

      <div id="calendar"></div>
    </div>

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
