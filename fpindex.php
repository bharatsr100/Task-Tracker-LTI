
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Forgot Password</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <div id="msg">
  </div>

  <center>
    <h3>Enter Employee Email ID And Recover Your Account</h3>
  </center>
  <form method="post" class="form-horizontal" action="send_email.php">
    <div class="form-group">
      <!-- <label class="col-sm-3 control-label">Employee Email ID</label> -->
      <div class="col-sm-6">
        <br><br>
        <input type="text" name="email" id="email" class="form-control" style="margin-left:380px;" placeholder="Enter Employee Email ID" </div>
      </div>
      <div class="form-group">
        <div style="margin-top:30px;" class="col-sm-offset-3 col-sm-9 m-t-15">
          <input type="submit" id="reset" class="btn btn-success" value="Send Mail">
        </div>
      </div>
  </form>


</body>

</html>
