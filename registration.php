<!DOCTYPE html>
<html>

<head>
  <meta charset="ISO-8859-1">
  <title>Registration Page</title>
</head>

<body>

</body>
<div align="center">
  <form id="form" action="validation_reg.php" method="post">

    <h1>Sign Up</h1>
    <table>
      <tr>
        <!-- <td>Full Name</td> -->
        <td><input type="text" name="uname" placeholder="Full Name" required /></td>
      </tr>
      <tr>
        <!-- <td>Short Name</td> -->
        <td><input type="text" name="shortname" placeholder="Short Name" required /></td>
      </tr>

      <tr >

        <!-- <td>EmployeeID</td> -->
        <td style="padding-top: 50px;"><input type="text" name="employeeid" placeholder="Employee ID"  required /></td>
      </tr>
      <tr>
        <!-- <td>Contact No</td> -->
        <td><input type="tel" name="contact" placeholder="Contact No" pattern="[0-9]{10}" required /></td>
      </tr>
      <tr>
        <!-- <td>Employee Email ID</td> -->
        <td><input type=" email" name="e_emailid" placeholder="Employee Email ID" required /></td>
      </tr>
      <tr>
        <!-- <td>Project Email ID</td> -->
        <td><input type="email" name="p_emailid" placeholder="Project Email ID" required /></td>
      </tr>
      <tr>
        <!-- <td>Password</td> -->
        <td><input type="password" placeholder="Password" name="password" id="password" /></td>
      </tr>
      <tr>
        <!-- <td>Password</td> -->
        <td><input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" /></td>
      </tr>


    </table>
    <br>
    <input type="submit" name="register" value="Register" id="register">
  </form>
  <br>
  <a href="login.html"> Already have an account? Login here</a>
</div>

</html>
