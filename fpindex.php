<?php
session_start();
?>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Forgot Password</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <center>
    <h3>Enter Employee Email ID And Recover Your Account</h3>
  </center>
  <form method="post" class="form-horizontal">
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">

  	</div>
  	<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">

  	</div>

    <div class="form-group">
      <!-- <label class="col-sm-3 control-label">Employee Email ID</label> -->
      <div class="col-sm-6">
        <br><br>
        <input type="text" id="e_emailid" class="form-control" style="margin-left:380px;" placeholder="Enter Employee Email ID" </div>
      </div>
      <div class="form-group">
        <div style="margin-top:30px;" class="col-sm-offset-3 col-sm-9 m-t-15">
          <input type="submit" id="btn_send" class="btn btn-success" value="Send Mail">
        </div>
      </div>
  </form>

  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on("click", "#btn_send", function(e) {
        var email = $("#e_emailid").val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".com");
        if (email == "") {
          alert("Please Enter Email Address");
        } else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
          alert("Please Enter Valid Email Address !");
        } else {
          $.ajax({
            url: "send_email.php",
            method: "post",
            data: {
              uemail: email
            },
            success: function(response) {
              $("#msg").html(response);

            }
          });
        }
      });
    });
  </script>
</body>

</html>
