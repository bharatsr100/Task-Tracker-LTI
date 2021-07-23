<!DOCTYPE html>
<html>
<head>
	<title>Logout and Login Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

	<script src="app.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">

	</div>
	<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">

	</div>
	<button type="button" class="btn btn-success btn-sm" id="register">Register</button>
	 <button type="button" class="btn btn-success btn-sm" id="login">Login</button>

	<form id="register_form" name="form1" method="post" style="margin-top:50px;display:none;">
		<div class="form-group">
			<label for="uname">Full Name:</label>
			<input type="text" class="form-control" id="uname" placeholder="Full Name" name="uname">
		</div>
		<div class="form-group">
			<label for="shortname">Short Name:</label>
			<input type="text" class="form-control" id="shortname" placeholder="Short Name" name="shortname">
		</div>
		<div class="form-group" style="margin-top:50px;">
			<label for="employeeid">Employee ID:</label>
			<input type="text" class="form-control" id="employeeid" placeholder="Employee ID" name="employeeid">
		</div>
		<div class="form-group">
			<label for="contact">Contact No:</label>
			<input type="text" class="form-control" id="contact" placeholder="Contact No" name="contact">
		</div>
		<div class="form-group">
			<label for="e_emailid">Employee Email ID:</label>
			<input type="email" class="form-control" id="e_emailid" placeholder="Employee Email ID" name="e_emailid">
		</div>
		<div class="form-group">
			<label for="p_emailid">Project Email ID:</label>
			<input type="email" class="form-control" id="p_emailid" placeholder="Project Email ID" name="p_emailid">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" placeholder="Password" name="password">
		</div>

		<div class="form-group">
			<label for="cpassword">Confirm Password:</label>
			<input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword">
		</div>
		<div style="margin-left:10px; width:200px;height:30px;float:left;">

		<input type="button" name="save" class="btn btn-primary" value="Register" id="butsave">
	</div>
	<div id="message1" style="margin-left:-80px;margin-top: 10px;width:200px;height:30px;float:left;" ></div>

	</form>
	<form id="login_form" name="form1" method="post" >

		<div style="margin-top:50px;" class="form-group">
			<label title="Use Employee Number, Employee Email ID, Project Email ID or Contact Number as User ID" for="userid">User ID:
		</label>
			<input type="text" class="form-control" id="userid" placeholder="User ID" name="userid">
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="password_log" placeholder="Password" name="password_log">
		</div>
		<input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
		<input type="button" name="save" class="btn btn-primary" value="Forgot Password ?" id="f_password">
	</form>
</div>
<div id="message1" style="margin-top:50px;width:250px;height:30px" ></div>
<br>


<script>
$(document).ready(function(){

    $('#password, #cpassword').keyup(function(){
      var pwd=$('#password').val();
      var cpwd=$('#cpassword').val();
    if(cpwd!=pwd){
      $('#message1').html('**Passwords are not matching').css('color','red');
      return false;
    }
    else{
        $('#message1').html('');
        return true;
    }
  });
});
</script>
</body>
</html>
