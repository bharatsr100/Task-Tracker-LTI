<?php
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);


//echo $arr['shortname'];
//echo $arr['contact']
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <title> user profile page</title>
</head>

<body>
  <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
  <br>
  <h1 style="text-align:center;"> User Profile <?php
echo $arr['uname'];
?> </h1>
  <br><br>
  <div style="margin: auto;width: 60%;">
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">

    </div>
    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">

    </div>
    <form id="update_form" name="form1" method="post" style="margin-top:50px;">
      <div class="form-group">
        <label for="uname">Full Name:</label>
        <input type="text" class="form-control" id="uname" value= "<?php echo $arr['uname']; ?>" name="uname">
      </div>
      <div class="form-group">
        <label for="shortname">Short Name:</label>
        <input type="text" class="form-control" id="shortname" value= "<?php echo $arr['shortname'];?>" name="shortname">
      </div>
      <div class="form-group" style="margin-top:50px;">
        <label for="employeeid">Employee ID:</label>
        <input type="text" class="form-control" id="employeeid" value= "<?php echo $arr['employeeid'];?>" name="employeeid">
      </div>
      <div class="form-group">
        <label for="contact">Contact No:</label>
        <input type="text" class="form-control" id="contact" value= "<?php echo $arr['contact'];?>" name="contact">
      </div>
      <div class="form-group">
        <label for="e_emailid">Employee Email ID:</label>
        <input type="email" class="form-control" id="e_emailid" value= "<?php echo $arr['e_emailid'];?>" name="e_emailid">
      </div>
      <div class="form-group">
        <label for="p_emailid">Project Email ID:</label>
        <input type="email" class="form-control" id="p_emailid" value= "<?php echo $arr['p_emailid'];?>" name="p_emailid">
      </div>
      <br><br>
      <div class="form-group">
        <label for="password">Enter your Current Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
      </div>
      <div style="margin-left:10px; width:200px;height:30px;float:left;">

        <input type="button" name="save" class="btn btn-primary" value="Update" id="update">
      </div>
    </form>



</body>

</html>
