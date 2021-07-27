<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="task_details_app.js"></script>
    <title>Task Details</title>
    <style>
    .date_div{
      font-weight: normal;
      font-size:15px;
      float:left;
      padding-right:20px;


    }
    .name_div{
      font-weight: normal;
      font-size:15px;
    }
    .comment_div{
      font-weight: normal;
      font-size:15px;

    }
    .comments_full_div{
      padding:20px;
      width:90%;
      /* background-color:grey; */
    }
    </style>
  </head>
  <body>
      <button onclick="location.href='admin_page.php';" type="button" class="btn btn-primary" >Back</button>
      <br><br><br><br><br>

       <!--  -->
      <div id="task_details_admin" style="margin-left:40px;float:left;width:90%;" >
        <h4 style="text-align:center;" id="headone"><b>Task Details</b></h4>
        <br><br>
        <div style="width:90%;height:40px;">
            <div  style="width:25%;float:left;">
                  <div style="font-size:15px;float:left;"><b>Task ID:&emsp;</b></div>
                  <div style="font-size:15px;float:left;"id="tid"></div>
            </div>
            <div  style="margin-left:40px;width:70%;float:left;">
                <div style="font-size:15px;float:left;"><b>Task Description:&emsp;</b></div>
                <div style="font-size:15px;float:left;"id="tstepdescription"></div>
            </div>
      </div>
      <div style="margin-top:20px;width:90%;height:40px;">
        <div  style="width:25%;float:left;">
              <div style="font-size:15px;float:left;"><b>Planned Start:&emsp;</b></div>
              <div style="font-size:15px;float:left;"id="pstart"></div>
        </div>
        <div  style="margin-left:40px;width:25%;float:left;">
            <div style="font-size:15px;float:left;"><b>Planned End:&emsp;</b></div>
            <div style="font-size:15px;float:left;"id="pend"></div>
        </div>
        <div  style="margin-left:40px;width:25%;float:left;">
            <div style="font-size:15px;float:left;"><b>Planned Effort:&emsp;</b></div>
            <div style="font-size:15px;float:left;"id="peffort"></div>
        </div>
      </div>
      <div style="margin-top:20px;width:90%;height:40px;">
        <div  style="width:25%;float:left;">
              <div style="font-size:15px;float:left;"><b>Actual Start:&emsp;</b></div>
              <div style="font-size:15px;float:left;"id="astart"></div>
        </div>
        <div  style="margin-left:40px;width:25%;float:left;">
            <div style="font-size:15px;float:left;"><b>Actual End:&emsp;</b></div>
            <div style="font-size:15px;float:left;"id="aend"></div>
        </div>
        <div  style="margin-left:40px;width:25%;float:left;">
            <div style="font-size:15px;float:left;"><b>Actual Effort:&emsp;</b></div>
            <div style="font-size:15px;float:left;"id="aeffort"></div>
        </div>
      </div>
      <div style="margin-top:50px;width:100%;">
        <h4 style="text-align:center;"> <b>Task Step Details<b> </h4>
        <br><br>
        <center>
        <table class="table table-hover" id="tstep_table" style="display:none;font-size:15px;">
          <thead>
            <tr>
              <th scope="col">Assigned to</th>
              <th scope="col">Task Description</th>
              <th scope="col">Planned Start</th>
              <th scope="col">Planned End</th>
              <th scope="col">Planned Effort</th>
              <th scope="col">Actual Start</th>
              <th scope="col" >Actual End</th>
              <th scope="col">Actual Effort</th>
              <th scope="col" style="width:150px;">Task Status</th>
            </tr>
          </thead>
          <tbody id="tbody_tstep_table">
          </tbody>
        </table>
      </center>
      </div>
      <div style="margin-top:50px;width:100%;" id="allcomments_div">
        <h4 style="text-align:center;"> <b>Comments History</b> </h4>
        <br><br>
      </div>
      </div>

      </div>
      <center>
      <button type="button" onclick="exporttasktopdf()" class="btn btn-secondary expbtn">Export to pdf</button>
      <center>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="	https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.js" ></script>
  </body>
</html>
