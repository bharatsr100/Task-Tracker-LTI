<?php
session_start();
if(!isset($_SESSION['uname'])){
header('location:index.php');
}
?>
<html >
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title> welcome page</title>
  </head>
  <body>
<a href="logout.php"> Logout</a>
<h1> Welcome <?php echo $_SESSION['uname']; ?> </h1>
  </body>
</html>
