<?php

session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);
$uguid=$_SESSION['uguid'];

?>


<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <script src="uprofile.js"></script>
  <title> user profile page</title>
  <style>

  #userprofile{
    /* border: 2px solid black; */
  }
  #upassword{

  }
  </style>
</head>

<body>
  <img src="pics/logo.jpg" alt="LTI-Veolia Logo" style="height:70px;width:auto;">
  <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
  <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
  <br><br><br>

  <h1 style="text-align:center;" id="head_profile"> Edit Profile </h1>
  <br><br>
  <div style="margin: auto;width: 60%;">

    <button type="button" class="btn btn-secondary" id="userprofile">Update User Profile</button>
    <button type="button" class="btn btn-secondary" id="upassword">Password and Security</button>

    <form id="update_form" name="form1" method="get" style="margin-top:50px;">
      <div class="form-group">
        <label for="uguid1" style="display:none;">Uguid:</label>
        <input type="text" class="form-control" id="uguid1" name="uguid1" value="<?php echo $uguid;?>" style="display:none;">
      </div>
      <div class="form-group">
        <label for="uname">Full Name:</label>
        <input type="text" class="form-control" id="uname" name="uname">
      </div>
      <div class="form-group">
        <label for="shortname">Short Name:</label>
        <input type="text" class="form-control" id="shortname" name="shortname">
      </div>
      <div class="form-group" style="margin-top:50px;">
        <label for="employeeid">Employee ID:</label>
        <input type="text" class="form-control" id="employeeid" name="employeeid">
      </div>
      <div class="form-group">
        <label for="contact">Contact No:</label>
        <input type="text" class="form-control" id="contact" name="contact">
      </div>
      <div class="form-group">
        <label for="e_emailid">Employee Email ID:</label>
        <input type="email" class="form-control" id="e_emailid" name="e_emailid">
      </div>
      <div class="form-group">
        <label for="p_emailid">Project Email ID:</label>
        <input type="email" class="form-control" id="p_emailid" name="p_emailid">
      </div>
      <br><br>
      <div class="form-group">
        <label for="password">Enter your Current Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
      </div>
      <div style="margin-left:10px; width:200px;height:30px;float:left;">

        <input type="button" name="update" class="btn btn-primary" value="Update" id="update">
      </div>
    </form>

    <form id="update_password" name="form4" method="get" style="margin-top:50px;display:none;">
      <div class="form-group" >
        <label for="opassword">Current Password</label>
        <input type="password" class="form-control" id="opassword" placeholder="Current Password" name="opassword">
      </div>
      <div class="form-group" style="margin-top:50px;">
        <label for="npassword">New Password:</label>
        <input type="password" class="form-control" id="npassword" placeholder="New Password" name="npassword">
      </div>
      <div class="form-group" >
        <label for="ncpassword">Confirm New Password:</label>
        <input type="password" class="form-control" id="ncpassword" placeholder="Confirm New Password" name="ncpassword">
      </div>

      <input type="button" name="u_password" class="btn btn-primary" value="Update Password" id="u_password">
    </form>
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;margin-top:100px;">
    </div>
    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;margin-top:100px;">
    </div>



</body>

</html>
