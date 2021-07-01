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
$tstage=2;

$s3= mysqli_query($conn,"select * from ttable where tid= '$tid' && tguid!='$tguid' && createdby='$uguid'");
$n3= mysqli_num_rows($s3);


if($n3){

  echo "<script type='text/javascript'>alert('Task ID Already Exist.!'); window.location.href = 'mytask.php';</script>";
}
else{

if(($pstart!="" && $pend!="" && $peffort!="") || ($pstart=="" && $pend=="" && $peffort=="") ){
if($assignto=="") $assignto=$uguid;
$tsequence=0;
$s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype' WHERE tguid= '$tguid'");
$s2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto',tstepdescription='$tdescription',tstage='$tstage', pstart='$pstart',pend='$pend',peffort='$peffort' WHERE tguid= '$tguid' && tsequenceid='$tsequence'");

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
else if(isset($_POST['edittaskstepbtn'])){


 //echo "<script type='text/javascript'>alert('Hello Just Testing'); window.location.href = 'mytask.php';</script>";
$uguid=$_SESSION['uguid'];
$tguid= $_POST['tguid3'];
$tsequenceid= $_POST['tsequenceid3'];
$tstage=2;
// $tid= $_POST['tid2'];
// $tdescription= $_POST['tdescription1'];
// $ttype= $_POST['ttype1'];
// $assignto= $_POST['assignto1'];
$pstart= $_POST['pstart3'];
$pend= $_POST['pend3'];
$peffort= $_POST['peffort3'];


// $s3= mysqli_query($conn,"select * from ttable where tid= '$tid' && tguid!='$tguid' && createdby='$uguid'");
// $n3= mysqli_num_rows($s3);



// ($pstart=="" && $pend=="" && $peffort=="")

if($pstart!="" && $pend!="" && $peffort!=""){
//if($assignto=="") $assignto=$uguid;
//$tsequence= 0;
//$s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype' WHERE tguid= '$tguid'");
$s2= mysqli_query($conn,"UPDATE tstep SET tstage=$tstage, pstart='$pstart',pend='$pend',peffort='$peffort' WHERE tguid= '$tguid' && tsequenceid='$tsequenceid'");

if( $s2){
echo "<script type='text/javascript'>alert('Successful - Task Step Updated!'); window.location.href = 'mytask.php';</script>";
}
else{
echo "<script type='text/javascript'>alert('UnSuccessful - Task Step Not Updated!'); window.location.href = 'mytask.php';</script>";
}
 }
 else{
    echo "<script type='text/javascript'>alert('UnSuccessful - Enter all planning details!'); window.location.href = 'mytask.php';</script>";
  }


}
else if(isset($_POST['savecomment5'])){

  $tguid= $_POST['tguid5'];

  $uguid=$_SESSION['uguid'];
  $tsequenceid=$_POST['tsequenceid5'];

  date_default_timezone_set("Asia/Kolkata");
  $date1= date("Ymd");
  $time1= date("His");

  $updatedon=$date1;
  $updatedat=$time1;
  $updatedby=$uguid;


  $comment= $_POST['comment5'];
  $assignto=$_POST['userslist5'];
  //$tstagetext= $_POST['tstatus4'];
  $tstage=$_POST['tstatus5'];


  if($assignto=="0" || $assignto=="") $assignto=$uguid;
  //else $assignto=$_POST['userslist'];
	$s5= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid='$tsequenceid'");
  $row = mysqli_fetch_assoc($s5);

  $aend=$row["aend"];
  $astart=$row["astart"];
  $pstart=$row["pstart"];

  $r2="";
  // if($tstagetext=="In Progress") $tstage=3;
  // else if($tstagetext=="Completed") $tstage=4;
  // else if($tstagetext=="On hold") $tstage=5;
  // else if($tstagetext=="Awaiting") $tstage=6;

if(($pstart=="" || $pstart=="NULL" || $pstart=="0000-00-00" && $tstage==4) || ($pstart=="" || $pstart=="NULL" || $pstart=="0000-00-00" && $tstage==3) ){
  echo "<script type='text/javascript'>alert('Task needs to be planned first'); window.location.href = 'mytask.php';</script>";
  exit("Task needs to be planned first");
}
if(($astart=="" || $astart=="NULL" || $astart=="0000-00-00") && $tstage==4){
  echo "<script type='text/javascript'>alert('Task can not be completed before starting it'); window.location.href = 'mytask.php';</script>";
  exit("Task can not be completed before starting it");
  // echo "<script type='text/javascript'>alert('Task can't be completed before starting it'); window.location.href = 'mytask.php';</script>";
  // exit("Task can't be completed before starting it");
}


if($tstage==0){
  $r2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
}
else if($tstage==3){
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
else if(isset($_POST['savecomment'])){

  $comment= $_POST['comment4'];
  $assignto=$_POST['userslist'];
  $tstage=$_POST['tstatus4'];
  $tguid= $_POST['tguid4'];
  $efforth=$_POST['efforth'];
  $effortm=$_POST['effortm'];

  $uguid=$_SESSION['uguid'];
  $tsequenceid=0;

  date_default_timezone_set("Asia/Kolkata");

  $date1= date("Ymd");
  $time1= date("His");

  $updatedon=$date1;
  $updatedat=$time1;
  $updatedby=$uguid;



	$s5= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid='$tsequenceid'");
  $row = mysqli_fetch_assoc($s5);

  $aend=$row["aend"];
  $astart=$row["astart"];
  $pstart=$row["pstart"];
  $prev_assignto=$row["assignto"];
  $prev_tstage=$row['tstage'];
  $prev_aeffort=$row['aeffort'];
  $prev_astart=$row['astart'];
  $prev_aend=$row['aend'];

  if($prev_aeffort=="") $prev_aeffort=0;
  if($efforth=="") $efforth=0;
  if($effortm=="") $effortm=0;

  $aeffort= $prev_aeffort+ 60*$efforth+ $effortm;
  if($aeffort==0) $aeffort="";

  if($assignto==0) $assignto=$prev_assignto;

  $r2="";
  $tstageinfo="";

   if($tstage==3)        $tstageinfo="In Progress (Start)";
   else if($tstage==4)   $tstageinfo="Completed";
   else if($tstage==5)   $tstageinfo="On Hold";
   else if($tstage==6)   $tstageinfo="Awaiting";

if($pstart=="" || $pstart=="NULL" || $pstart=="0000-00-00"){
  echo "<script type='text/javascript'>alert('Task needs to be planned first'); window.location.href = 'mytask.php';</script>";

  // echo "<script type='text/javascript'>$('#error12').show();
  // $('#error12').html(dataResult.description);</script>";
  exit("Task needs to be planned first");
}
if(($astart=="" || $astart=="NULL" || $astart=="0000-00-00") && $tstage==4){
  echo "<script type='text/javascript'>alert('Task can not be completed before starting it'); window.location.href = 'mytask.php';</script>";
  exit("Task can not be completed before starting it");
  // echo "<script type='text/javascript'>alert('Task can't be completed before starting it'); window.location.href = 'mytask.php';</script>";
  // exit("Task can't be completed before starting it");
}

if($tstage==0) $tstage=$prev_tstage;
if($tstage==$prev_tstage){

  $astart=$date1;
  $aend="0000-00-00";

  $r6= mysqli_query($conn,"select MIN(astart) AS min from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && astart!='0000-00-00' ");
  $n6= mysqli_num_rows($r6);
  if($n6){
    $row6=mysqli_fetch_array($r6);
    $astart=$row6['min'];
  }

  $r2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto',aeffort='$aeffort',astart='$astart',aend='$aend' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
}
else if($tstage==3){
      $astart=$date1;
      $aend="0000-00-00";

      //select MIN(astart) AS min from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && astart!=''
      //$r6= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && astart!='0000-00-00' order by astart desc LIMIT 1");
      $r6= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && astart!='0000-00-00' order by astart asc LIMIT 1");

      $n6= mysqli_num_rows($r6);
      if($n6){
        $row6=mysqli_fetch_assoc($r6);
        $astart=$row6['astart'];

      }

      //$r1= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && (astart!='0000-00-00' && astart!='' &astart!=NULL)");
      //$n1= mysqli_num_rows($r1);


      $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',astart='$astart',aeffort='$aeffort',aend='$aend',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
  }
  else if($tstage==4){
    //$sql2= "select * from tstep"
    $aend1= "0000-00-00";

     $r6= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && aend='$aend1' ");
     $n6= mysqli_num_rows($r6);


     // echo $n6;
     // echo "<br><br><br><br><br><br>";
     // while($row6=mysqli_fetch_assoc($r6)){
     //   echo $n6;
     //   echo $row['tguid'];
     //   echo " &nbsp;&nbsp;";
     //   echo $row6['tsequenceid'];
     //   echo " &nbsp;&nbsp;";
     //   echo $row6['tstepdescription'];
     //   echo "<br><br>";
     //
     //   $n6= $n6-1;
     //
     // }
    //echo "<script type='text/javascript'>alert(Complete all steps tasks before completing the main task'); window.location.href = 'mytask.php';</script>";
     if($n6){
      echo "<script type='text/javascript'>alert('Complete all steps tasks before completing the main task'); window.location.href = 'mytask.php';</script>";
      exit();
    }
   else{
     $aend=$date1;

     $r7= mysqli_query($conn,"select MAX(aend) AS max from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' ");
     $n7= mysqli_num_rows($r7);

     if($n7){
       $row7=mysqli_fetch_array($r7);
       $aend=$row7['max'];
     }

      //$diff = abs(strtotime($aend) - strtotime($astart));

      // $years = floor($diff / (365*60*60*24));
      // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      //
      // $aeffort= $days+1;

      $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',aend='$aend',aeffort='$aeffort',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");

    }

   }
else{
  $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',aeffort='$aeffort',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
}

  $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
  $res4= mysqli_fetch_assoc($res3);
  $username= $res4["uname"];
  $r4="";


   if(($prev_assignto==$assignto) && ($prev_tstage==$tstage) ){
      $r4= mysqli_query($conn, "INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')");

   }
   else if(($prev_assignto!=$assignto) && ($prev_tstage==$tstage)){
    $comment0= "Assigned to: ".$username." ";
    $r4=mysqli_query($conn,"INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment0'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')");
  }
  else if(($prev_assignto==$assignto)&&($prev_tstage!=$tstage)){
    $comment1= "Task Phase Changed to: ".$tstageinfo." ";
    $r4=mysqli_query($conn,"INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment1'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')" );

  }
  else{
    $comment0= "Assigned to: ".$username." ";
    $comment1= "Task Phase Changed to: ".$tstageinfo." ";
    $r4=mysqli_query($conn,"INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment0'), ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment1'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')");

  }

    //$comment0= "Assigned to: ".$username." ";
    //$s4="INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment0'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')";
    //$s4="INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment0'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')";
    //,('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')
    //$r4=mysqli_query($conn,$s4);


  if($r2 && $r4 ){
    echo "<script type='text/javascript'>alert('Updated Successfully !'); window.location.href = 'mytask.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Failed to update !'); window.location.href = 'mytask.php';</script>";
  }


}

?>
