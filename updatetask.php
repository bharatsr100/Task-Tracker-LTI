<?php
session_start();
include 'database.php';
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

if(isset($_POST['deletetaskstp'])){

  $uguid=$_SESSION['uguid'];
  $tguid= $_POST['tguidd'];
  $tsequenceid= $_POST['tsequenceidd'];
  $pstart= $_POST['tpstart'];

  if($pstart!="" && $pstart!="0000-00-00" && $pstart=="NULL"){
  echo "<script type='text/javascript'>alert('Planned Task Step can not be deleted'); window.location.href = 'taskstepsadd_del.php';</script>";
  exit();
}
else{

  $s2 = "DELETE FROM tstep WHERE tguid=$tguid && tsequenceid=$tsequenceid ";
  $res=mysqli_query($conn, $s2);
  if($res) echo "<script type='text/javascript'>alert('Task Step deleted successfully'); window.location.href = 'taskstepsadd_del.php';</script>";
  else echo "<script type='text/javascript'>alert('Error while deleting task step'); window.location.href = 'taskstepsadd_del.php';</script>";
  exit();

}

}
else if(isset($_POST['addtaskstp'])){


  $tguid= $_POST['tguidd23'];
  $tsequenceid= $_POST['tsequenceidd23'];
  $tstage=1;
  $assignto= $_SESSION['uguid'];
  $tstepdescription= $_POST['tstepdescription23'];

  $s2 = "INSERT INTO tstep (tguid,tsequenceid,tstage,assignto,tstepdescription)VALUES ('$tguid','$tsequenceid','$tstage','$assignto','$tstepdescription')";
  $res=mysqli_query($conn, $s2);

  if($res) echo "<script type='text/javascript'>alert('Task Step added successfully'); window.location.href = 'taskstepsadd_del.php';</script>";
  else echo "<script type='text/javascript'>alert('Error while added task step'); window.location.href = 'taskstepsadd_del.php';</script>";
  exit();

}

else if(isset($_POST['edittaskbtn'])){


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
  $tsequenceid=11;
  date_default_timezone_set("Asia/Kolkata");

  $date1= date("Ymd");
  $time1= date("His");

  $updatedon=$date1;
  $updatedat=$time1;
  $updatedby=$uguid;
  $tsequenceid=11;

  $comment= $_POST['comment4'];
  $assignto=$_POST['userslist'];
  $tstagetext= $_POST['tstatus4'];

  if($assignto=="0" || $assignto=="") $assignto=$uguid;
  //else $assignto=$_POST['userslist'];
	$s5= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid='$tsequenceid'");
  $row = mysqli_fetch_assoc($s5);
  $tstage=$row["tstage"];
  $aend=$row["aend"];
  $astart=$row["astart"];
  $pstart=$row["pstart"];

  $r2="";
  if($tstagetext=="In Progress") $tstage=3;
  else if($tstagetext=="Completed") $tstage=4;
  else if($tstagetext=="On hold") $tstage=5;
  else if($tstagetext=="Awaiting") $tstage=6;

if(($pstart=="" || $pstart=="NULL" || $pstart=="0000-00-00" && $tstage==4) || ($pstart=="" || $pstart=="NULL" || $pstart=="0000-00-00" && $tstage==3) ){
  echo "<script type='text/javascript'>alert('Task needs to be planned first'); window.location.href = 'mytask.php';</script>";
  exit("Task needs to be planned first");
}
if($astart=="" || $astart=="NULL" || $astart=="0000-00-00" && $tstage==4){
  echo "<script type='text/javascript'>alert('Task can not be completed before starting it'); window.location.href = 'mytask.php';</script>";
  exit("Task can not be completed before starting it");
  // echo "<script type='text/javascript'>alert('Task can't be completed before starting it'); window.location.href = 'mytask.php';</script>";
  // exit("Task can't be completed before starting it");
}
  if($tstage==3){
      $astart=$date1;
      $aend="";

      $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',astart='$astart',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
  }
  else if($tstage==4){
    $aend=$date1;
    $diff = abs(strtotime($aend) - strtotime($astart));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    $aeffort= $days+1;

    $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',aend='$aend',aeffort=$aeffort,assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
  }
else{
  $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
}


  $sql3 = "INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')";
  $r3=mysqli_query($conn, $sql3);

  //$r4=mysqli_query($conn,"UPDATE ttable SET createdby='$assignto' WHERE tguid='$tguid'");


  if($r2 && $r3 ){
    echo "<script type='text/javascript'>alert('Updated Successfully !'); window.location.href = 'mytask.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Failed to update !'); window.location.href = 'mytask.php';</script>";
  }


}

?>
