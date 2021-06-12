<!DOCTYPE html>
<html>

<head>
  <meta charset="ISO-8859-1">
  <title>Registration Page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

</body>
<div align="center">
  <form id="form" action="validation_reg.php" method="post">

    <h1>Sign Up</h1>
    <table>
      <tr>

        <td><input type="text" name="uname" placeholder="Full Name" style="width:250px;" required /></td>
      </tr>
      <tr>

        <td><input type="text" name="shortname" placeholder="Short Name" style="width:250px;" required /></td>
      </tr>

      <tr >


        <td style="padding-top: 50px;"><input type="text" name="employeeid" placeholder="Employee ID" style="width:250px;" required /></td>
      </tr>
      <tr>

        <td><input type="tel" name="contact" placeholder="Contact No" pattern="[0-9]{10}" style="width:250px;" required /></td>
      </tr>
      <tr>

        <td><input type=" email" name="e_emailid" placeholder="Employee Email ID" style="width:250px;" required /></td>
      </tr>
      <tr>

        <td><input type="email" name="p_emailid" placeholder="Project Email ID" style="width:250px;" required /></td>
      </tr>
      <tr>

        <td><input type="password" placeholder="Password" name="password" id="password"  style="width:250px;" required /></td>
      </tr>
      <tr>

        <td><input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword"  style="width:250px;" required  /></td>
        </tr>

        <tr id= "message" style="width:250px;height:30px">
          </tr>


    </table>
    <br>

    <input type="submit" name="register" value="Register" id="register">

  </form>

  <br>
  <a href="login.php"> Already have an account? Login here</a>
</div>



<script>
$(document).ready(function(){

$('#password, #cpassword').keyup(function(){
  var pwd=$('#password').val();
  var cpwd=$('#cpassword').val();
if((cpwd!=pwd){
  $('#message').html('**Passwords are not matching').css('color','red');
  return false;
}
else{
    $('#message').html('');
    return true;
}
});

});
</script>

</html>
