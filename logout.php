<?php
session_start();
session_destroy();
unset($_SESSION['arr']);
header("Location:index.php");
?>
