<!DOCTYPE html>
<html>

<head>
  <meta charset="ISO-8859-1">
  <title>Login Page</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <div align="center">
    <h1> Login</h1>
    <form id="form" action="validation_log.php" method="post">
      <table >
        <tr>
          <!-- <td>User ID</td> -->
          <td><input type="text" name="userid" placeholder="USER ID" id="userid" /></td>
        </tr>
        <tr>
          <!-- <td>Password</td> -->
          <td><input type="password" placeholder="Password" name="password" id="password" /></td>
        </tr>
      </table>
      <br>
      <br>
      <input type="submit" name="login" value="Login" />

    </form>
<br>
    <a href="#"> Forgot Password </a>
    <a href="registration.html" style="padding-left: 10px;"> Sign Up here </a>

</div>

</body>


</html>
