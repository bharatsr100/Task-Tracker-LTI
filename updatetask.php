<?php
session_start();
include 'database.php';
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

if(isset($_POST['edittaskbtn'])){

 //echo "<script type='text/javascript'>alert('Hello Just Testing'); window.location.href = 'mytask.php';</script>";
$uguid=$_SESSION['uguid'];
$tguid= $_POST['tguid1'];
$tid= $_POST['tid1'];
$tdescription= $_POST['tdescription1'];
$ttype= $_POST['ttype1'];
$assignto= $_POST['assignto1'];
$pstart= $_POST['pstart1'];
$pend= $_POST['pend1'];
$peffort= $_POST['peffort1'];

$s3= mysqli_query($conn,"select * from ttable where tid= '$tid' && tguid!='$tguid' && createdby='$uguid'");
$n3= mysqli_num_rows($s3);


if($n3){

  echo "<script type='text/javascript'>alert('Task ID Already Exist.!'); window.location.href = 'mytask.php';</script>";
}
else{

if(($pstart!="" && $pend!="" && $peffort!="") || ($pstart=="" && $pend=="" && $peffort=="") ){
if($assignto=="") $assignto=$uguid;
$tsequence= 11;
$s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype' WHERE tguid= '$tguid'");
$s2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto',tstepdescription='$tdescription', pstart='$pstart',pend='$pend',peffort='$peffort' WHERE tguid= '$tguid' && tsequenceid='$tsequence'");

if($s1 && $s2){
echo "<script type='text/javascript'>alert('Successful - Task Updated!'); window.location.href = 'mytask.php';</script>";
}
else{
echo "<script type='text/javascript'>alert('UnSuccessful - Task Not Updated!'); window.location.href = 'mytask.php';</script>";
}
}
else{
  echo "<script type='text/javascript'>alert('UnSuccessful - Enter all planning details!'); window.location.href = 'mytask.php';</script>";
}
}
}
else if(isset($_POST['savecomment'])){
  $tguid= $_POST['tguid4'];
  $uguid=$_SESSION['uguid'];

  date_default_timezone_set("Asia/Kolkata");

  $date1= date("Ymd");
  $time1= date("his");

  $updatedon=$date1;
  $updatedat=$time1;
  $updatedby=$uguid;
  $tsequenceid=11;
  $comment= $_POST['comment4'];

  $sql3 = "INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')";
  $r3=mysqli_query($conn, $sql3);
  if($r3){
    echo "<script type='text/javascript'>alert('Comment Created Successfully !'); window.location.href = 'mytask.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Failed to create Comment !'); window.location.href = 'mytask.php';</script>";
  }


}

?>