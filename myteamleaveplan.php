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
    </style>
  </head>
  <body>
    <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
    <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
    <br><br><br>
    <h1 style="text-align:center;" id="headone">My Team Leave Plan</h1><br><br><br>
    <center>
      <div id="teamvacation_div" style="display:contents">
        <table class="table table-hover" id="teamvacation_table">
          <thead>
            <tr>
              <th scope="col">VGUID</th>
              <th scope="col">Created for(id)</th>
              <th scope="col">Created for</th>
              <th scope="col">From</th>
              <th scope="col">To</th>
              <th scope="col">Reason</th>
              <th scope="col">Remarks</th>
              <th scope="col">Action </th>
            </tr>
          </thead>
          <tbody id="tbody_team_vacation">
          </tbody>
        </table>
      </div>
    </center>

    <!-- <form method="post" action="testjson.php">
      <button name="create" type="submit">Create JSON</button>
    </form> -->
  </body>
</html>
