<?php
session_start();
session_destroy();
unset($_SESSION['uguid']);
header("Location:index.php");
?>
