<?php

session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
$arr = unserialize($_SESSION['arr']);
$uguid=$_SESSION['uguid'];

//echo $arr['shortname'];
//echo $arr['contact']
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$db="userdatabase";
/*Create connection*/
$conn = mysqli_connect($servername, $username, $password,$db);

if(isset($_POST['update']))
{ $password= $_POST['password'];
  $p2= mysqli_query($conn,"select * from userdata1 where password= '$password' && uguid='$uguid'");
  $n1= mysqli_num_rows($p2);

  if($n1){
  $uname= $_POST['uname'];
  $shortname= $_POST['shortname'];
  $employeeid= $_POST['employeeid'];
  $contact= $_POST['contact'];
  $e_emailid= $_POST['e_emailid'];
  $p_emailid= $_POST['p_emailid'];
  $t1="contact";
  $t2="employeeid";
  $t3="e_emailid";
  $t4="p_emailid";


    //$s1 ="UPDATE userdata1 SET uname='$uname', shortname='$shortname' WHERE uguid= '$uguid'" ;
    $s1= mysqli_query($conn,"UPDATE userdata1 SET uname='$uname', shortname='$shortname' WHERE uguid= '$uguid'");
    //$s2 ="UPDATE userdata2 SET value='$contact' WHERE type= $t1 && uguid= $uguid" ;
    $s2= mysqli_query($conn,"UPDATE userdata2 SET value='$contact' WHERE uguid= '$uguid' && type='$t1'");
    $s3= mysqli_query($conn,"UPDATE userdata2 SET value='$employeeid' WHERE uguid= '$uguid' && type='$t2'");
    $s4= mysqli_query($conn,"UPDATE userdata2 SET value='$e_emailid' WHERE uguid= '$uguid' && type='$t3'");
    $s5= mysqli_query($conn,"UPDATE userdata2 SET value='$p_emailid' WHERE uguid= '$uguid' && type='$t4'");

    // $s3 ="UPDATE userdata2 SET value='$employeeid'  WHERE type= $t2 && uguid= $uguid" ;
    // $s4 ="UPDATE userdata2 SET value='$e_emailid' WHERE type= $t3 && uguid= $uguid" ;
    // $s5 ="UPDATE userdata2 SET value='$p_emailid' WHERE type= $t4 && uguid= $uguid" ;
    //$sql1 = "UPDATE employeedata SET firstname='$firstname',email='$email',contact='$contact' WHERE employeeid=$employeeid";
    //$r1 = mysql_query( $s1, $conn);
    //&& $conn->query($s2)  && $conn->query($s3)  && $conn->query($s4)  && $conn->query($s5)
    if ($s1 && $s2 && $s3 && $s4 && $s5)
        { echo "<script type='text/javascript'>alert('Successful - Record Updated!'); window.location.href = 'user_profile.php';</script>"; }
    else
        { echo "<script type='text/javascript'>alert('Unsuccessful - ERROR!'); window.location.href = 'user_profile.php';</script>"; }

}
else {
  echo "<script type='text/javascript'>alert('Wrong Password! Try again!!'); window.location.href = 'user_profile.php';</script>";
}
}

if(isset($_POST['u_password'])){
    $password= $_POST['opassword'];
    $p2= mysqli_query($conn,"select * from userdata1 where password= '$password' && uguid='$uguid'");
    $n1= mysqli_num_rows($p2);
    if($n1){
      $npassword= $_POST['npassword'];
      $ncpassword= $_POST['ncpassword'];
      if($npassword==$ncpassword){
        $s1= mysqli_query($conn,"UPDATE userdata1 SET password='$npassword' WHERE uguid= '$uguid'");
        if($s1){
          echo "<script type='text/javascript'>alert('Successful - Password Updated!'); window.location.href = 'user_profile.php';</script>";
        }
        else{
          echo "<script type='text/javascript'>alert('Unsuccessful - ERROR!'); window.location.href = 'user_profile.php';</script>";
        }
      }
      else{
        echo "<script type='text/javascript'>alert('Passwords Not Matching !! Try again!!'); window.location.href = 'user_profile.php';</script>";
      }

    }
    else{

        echo "<script type='text/javascript'>alert('Wrong Password! Try again!!'); window.location.href = 'user_profile.php';</script>";

    }

}
// $query1=mysql_query("SELECT * FROM tbl_staffs WHERE username='".mysql_real_escape_string($_SESSION["VALID_USER"])."'  AND user_levels = '".mysql_real_escape_string('1')."'");
// $query2=mysql_fetch_array($query1);

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
  <script src="uprofile.js"></script>
  <title> user profile page</title>
</head>

<body>

  <button onclick="location.href='logout.php';" type="button" class="btn btn-primary" style="float: right;">Log Out</button>
  <button onclick="location.href='welcome.php';" type="button" class="btn btn-primary" style="float: right; margin-right:10px;">Home</button>
  <br><br><br>


  <h1 style="text-align:center;"> User Profile <?php
echo $arr['shortname'];
?> </h1>
  <br><br>
  <div style="margin: auto;width: 60%;">
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">

    </div>
    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">

    </div>
    <button type="button" class="btn btn-secondary" id="userprofile">Update User Profile</button>
    <button type="button" class="btn btn-secondary" id="upassword">Password and Security</button>

    <form id="update_form" name="form1" method="post" action="user_profile.php" style="margin-top:50px;">
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

        <input type="submit" name="update" class="btn btn-primary" value="Update" id="update">
      </div>
    </form>

    <form id="update_password" name="form4" method="post" action="user_profile.php" style="margin-top:50px;display:none;">
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
        <input type="password" class="form-control" id="ncpasswod" placeholder="Confirm New Password" name="ncpassword">
      </div>

      <input type="submit" name="u_password" class="btn btn-primary" value="Update Password" id="u_password">
    </form>



</body>

</html>
