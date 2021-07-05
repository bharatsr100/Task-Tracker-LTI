<?php
session_start();
include 'database.php';
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
// ######################################################################################################################
// Function for deleting task steps
if($_POST['type']=="1"){

  $arr2 = array (

          "tguid"=> "",
          "tsequenceid"=> "",
          "pstart"=>"",
          "statuscode"=>"e",
          "description"=>"Error while deleting task step"

      );

 $uguid=$_SESSION['uguid'];
 $tguid= $_POST['tguid'];
 $tsequenceid= $_POST['tsequenceid'];
 $pstart= $_POST['pstart'];

 $arr2['tguid']="$tguid";
 $arr2['tsequenceid']="$tsequenceid";
 $arr2['pstart']="$pstart";

 if($pstart=="" || $pstart=="0000-00-00" || $pstart=="NULL"){

   $s2 = "DELETE FROM tstep WHERE tguid=$tguid && tsequenceid=$tsequenceid ";
   $res=mysqli_query($conn, $s2);

   if($res) {
     $arr2['statuscode']="s";
     $arr2['description']="Task step successfully deleted";
     echo json_encode($arr2);
     mysqli_close($conn);}
     else {
       $arr2['statuscode']="e";
       $arr2['description']="Error while deleting task step";
       echo json_encode($arr2);
       mysqli_close($conn);
       //echo "<script type='text/javascript'>alert('Error while deleting task step'); window.location.href = 'taskstepsadd_del.php';</script>";
     }

}
else{

 $arr2['statuscode']="e";
 $arr2['description']="Planned Task can not be deleted";
 echo json_encode($arr2);

 //exit();

}

 //echo "<script type='text/javascript'>alert('Task Step deleted successfully'); window.location.href = 'taskstepsadd_del.php';</script>";

}
// ######################################################################################################################
// Function for adding task steps
else if($_POST['type']=="2"){

 $arr2 = array (

         "tguid"=> "",
         "tsequenceid"=> "",
         "tstage"=>"",
         "tstepdescription"=>"",
         "statuscode"=>"e",
         "description"=>"Error while adding task step"

     );

 $tguid= $_POST['tguid'];
 $tsequenceid= $_POST['tsequenceid'];
 $tstage=1;
 $assignto= $_SESSION['uguid'];
 $tstepdescription= $_POST['tstepdescription'];
 $pstart="0000-00-00";
 $pend="0000-00-00";
 $peffort="";
 $astart="0000-00-00";
 $aend="0000-00-00";
 $aeffort="";

 $arr2['tguid']="$tguid";
 $arr2['tsequenceid']="$tsequenceid";
 $arr2['tstage']="$tstage";
 $arr2['tstepdescription']="$tstepdescription";


 $s2 = "INSERT INTO tstep (tguid,tsequenceid,tstage,assignto,tstepdescription,pstart,pend,peffort,astart,aend,aeffort)VALUES ('$tguid','$tsequenceid','$tstage','$assignto','$tstepdescription','$pstart','$pend','$peffort','$astart','$aend','$aeffort')";
 $res=mysqli_query($conn, $s2);

 if($res) {
   //echo "<script type='text/javascript'>alert('Task Step added successfully'); window.location.href = 'taskstepsadd_del.php';</script>";
   $arr2['statuscode']="s";
   $arr2['description']="Task step successfully added";
   echo json_encode($arr2);
   mysqli_close($conn);}

 else {
   //echo "<script type='text/javascript'>alert('Error while added task step'); window.location.href = 'taskstepsadd_del.php';</script>";
   echo json_encode($arr2);
   mysqli_close($conn);
 }
 //exit();

}
// ######################################################################################################################
// Function for loading events into calendar
else if($_POST['type']=="3"){

  $pendingtasks=array();
  $safeinprogressall=array();
  $alertinprogressall=array();
  $dangerinprogressall=array();
  $allprogresstasks=array();
  $allvacations=array();
  $allremarks=array();

  $alltasks=array();
  $uguid=$_SESSION['uguid'];
  $date= $_POST['date'];
  $todotask = array (
          "date"=>$date,
          "tid"=>"",
          "createdon"=>"",
          "tguid"=> "",
          "tsequenceid"=> "",
          "tstage"=>"",
          "tstepdescription"=>"",
          "statuscode"=>"e",
          "description"=>"Error while loading tasks"

      );
      $safeinprogress = array (
              "date"=>$date,
              "tid"=>"",
              "pstart"=>"",
              "pend"=>"",
              "pdiff"=>"",
              "createdon"=>"",
              "tguid"=> "",
              "tsequenceid"=> "",
              "tstage"=>"",
              "tstepdescription"=>"",
              "statuscode"=>"e",
              "description"=>"Error while loading tasks"

          );
        $vacation = array (
                "date"=>$date,
                "vguid"=>"",
                "vid"=>"",
                "vremark"=>"",
                "vstart"=>"",
                "vend"=>"",
                "action"=>"",

                "createdon"=>"",
                "createdat"=> "",
                "createdby"=> "",

                "statuscode"=>"e",
                "description"=>"Error while loading vacations"

            );
          $remark = array (
                  "date"=>$date,
                  "vguid"=>"",
                  "vsequenceid"=>"",
                  "vremark"=>"",

                  "updatedon"=>"",
                  "updatedat"=> "",
                  "updatedby"=> "",

                  "statuscode"=>"e",
                  "description"=>"Error while loading remarks"

              );




$sequence= 0;
$stage=1;
$sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid  && c.tsequenceid!='$sequence' && c.tstage='$stage' && p.createdon <='$date' && c.assignto='$uguid' order by p.tid";
$result=mysqli_query($conn, $sql1);

 while($row=mysqli_fetch_assoc($result)){
  $todotask['tguid']= $row['tguid'];
  $todotask['tid']= $row['tid'];
  $todotask['createdon']= $row['createdon'];
  $todotask['tsequenceid']= $row['tsequenceid'];
  $todotask['tstage']= $row['tstage'];
  $todotask['tstepdescription']= $row['tstepdescription'];
  $todotask['tstage']= $row['tstage'];
  $todotask['statuscode']= "s";
  $todotask['description']= "Task successfully loaded";
  $pendingtasks[]=$todotask;
}

$alltasks[]=$pendingtasks;


$sql2="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid  && c.tsequenceid!='$sequence' && c.tstage!='1' && c.tstage!='4' && c.pstart <='$date' && c.assignto='$uguid'  order by p.tid";
$result2=mysqli_query($conn, $sql2);

while($row=mysqli_fetch_assoc($result2)){
 $safeinprogress['tguid']= $row['tguid'];
 $safeinprogress['tid']= $row['tid'];
 $safeinprogress['pstart']= $row['pstart'];
 $safeinprogress['pend']= $row['pend'];

 //$date2=$row['pend'];
 // $newdate1 = date("Ymd", strtotime($date1));
 // $datenow=$date;
 // $datenow1=date("Ymd",strtotime($datenow));
 // $diff= $newdate1-$datenow1;

 //$date1=$date;
 $date2=date_create($row['pend']);
 $date1=date_create($date);
 $diff=date_diff($date1,$date2);
 $pdiff1= $diff->format("%R%a");
 $pdiff2= (int)$pdiff1;
 $safeinprogress['pdiff']= $pdiff2;

 $safeinprogress['createdon']= $row['createdon'];
 $safeinprogress['tsequenceid']= $row['tsequenceid'];
 $safeinprogress['tstage']= $row['tstage'];
 $safeinprogress['tstepdescription']= $row['tstepdescription'];
 $safeinprogress['tstage']= $row['tstage'];
 $safeinprogress['statuscode']= "s";
 $safeinprogress['description']= "Task successfully loaded";

 $allprogresstasks[]=$safeinprogress;

 if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
 else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
 else $dangerinprogressall[]=$safeinprogress;

}
$vguid="";
$action="cancel";
$r2= mysqli_query($conn,"select * from vtable where  vstart <='$date' && vend>= '$date' && action!='$action' && createdby='$uguid'");
$n2= mysqli_num_rows($r2);
while($row=mysqli_fetch_assoc($r2)){
  $vacation['vguid']= $row['vguid'];
  $vacation['vid']= $row['vid'];
  $vacation['vremark']= $row['vremark'];
  $vacation['vstart']= $row['vstart'];
  $vacation['vend']= $row['vend'];
  $vacation['createdon']= $row['createdon'];
  $vacation['createdat']= $row['createdat'];
  $vacation['createdby']= $row['createdby'];

  $vacation['action']= $row['action'];
  $vacation['statuscode']= "s";
  $vacation['description']= "vacation loaded successfully";

  $allvacations[]=$vacation;


}
  $vguid=$vacation['vguid'];

if($n2){
 $r4= mysqli_query($conn,"select * from vstatus where vguid='$vguid'");
while($row=mysqli_fetch_assoc($r4)){
$remark['vguid']= $row['vguid'];
$remark['vsequenceid']= $row['vsequenceid'];
$remark['vremark']= $row['vremark'];
$remark['updatedon']= $row['updatedon'];
$remark['updatedat']= $row['updatedat'];
$userid=$row['updatedby'];
$seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
//$r6= mysqli_query($conn,"select * from userdata1 where uguid='$userid'");
$row2=mysqli_fetch_assoc($seq);
$remark['updatedby']= $row2['uname'];


$remark['statuscode']= "s";
$remark['description']= "Remarks loaded successfully";

$allremarks[]=$remark;
}
}



$alltasks[]=$safeinprogressall;
$alltasks[]=$alertinprogressall;
$alltasks[]=$dangerinprogressall;
$alltasks[]=$allprogresstasks;
$alltasks[]=$allvacations;
$alltasks[]=$allremarks;


echo json_encode($alltasks);
mysqli_close($conn);

}
// ######################################################################################################################
// Function for saving vacation plan
else if($_POST['type']=="4"){

  $arr2 = array (
  "vguid"=> "",
  "vid"=> "",
  "vstart"=>"",
  "vend"=>"",
  "vremark"=>"",
  "createdon"=> "",
  "createdat"=> "",
  "createdby"=> "",
  "action"=>"",
  "statuscode"=>"e",
  "description"=>"Error occured while adding vacation plan"

);

date_default_timezone_set("Asia/Kolkata");
$date1= date("Ymd");
$time1= date("hsiv");
$time2= date("his");
$digits = 4;
$ran= rand(pow(10, $digits-1), pow(10, $digits)-1);

$vguid=$date1.$time1.$ran;
$uguid=$_SESSION['uguid'];

$vid= $_POST['vid'];
$viddefault=0;
$vstart= $_POST['vstart'];
$vend= $_POST['vend'];
$vremark= $_POST['vremark'];

$createdon=$date1;
$createdat=$time2;
$createdby=$uguid;
$vsequenceid = "ooo";
$action="";

$arr2['vguid']="$vguid";
$arr2['vid']="$vid";
$arr2['vstart']="$vstart";
$arr2['vend']="$vend";
$arr2['vremark']="$vremark";
$arr2['createdon']="$createdon";
$arr2['createdat']="$createdat";
$arr2['createdby']="$createdby";


if($vid!="" && $vstart!="" && $vend!="" && $vremark!="" && $vid!=$viddefault ){

  $r2= mysqli_query($conn,"select * from vtable where ( (vstart <='$vstart' && vend>= '$vstart') || (vstart <='$vend' && vend>= '$vend')) && action!='cancel'");
  $n2= mysqli_num_rows($r2);
  //$n2=1;

if($n2){
  $arr2['description']="Can not have more than one vacation plan on a particular date. Please check already existing vacation plans";

  echo json_encode($arr2);
  mysqli_close($conn);

}
else {  $r1=mysqli_query($conn, "INSERT INTO vtable (vguid,vid,vstart,vend,vremark,createdon,createdat,createdby,action)VALUES ('$vguid','$vid','$vstart','$vend','$vremark','$createdon','$createdat','$createdby','$action')");
  $r2=mysqli_query($conn, "INSERT INTO vstatus (vguid,vsequenceid,updatedon,updatedat,updatedby,vremark)VALUES ('$vguid','$vsequenceid','$createdon','$createdat','$createdby','$vremark')");

  if($r1 && $r2)
  {$arr2['statuscode']="s";
  $arr2['description']="Vacation plannded Successfully";}
  else{

  }

  echo json_encode($arr2);
  mysqli_close($conn);
}

}
else{
  $arr2['statuscode']="e";
  $arr2['description']="Please fill all the details to plan vacation";
  echo json_encode($arr2);
  mysqli_close($conn);
}

}
// ######################################################################################################################
// Function for cancelling vacation plan
else if($_POST['type']=="5"){
  $vguid= $_POST['vguid'];
  $vremark= $_POST['vremark'];

  $arr2 = array (
  "vguid"=> "",
  "statuscode"=>"e",
  "description"=>"Error occured while cancelling vacation plan"

);

  date_default_timezone_set("Asia/Kolkata");
  $date1= date("Ymd");
  $time1= date("hsiv");
  $time2= date("his");

  $uguid=$_SESSION['uguid'];
  $createdon=$date1;
  $createdat=$time2;
  $createdby=$uguid;
  $vsequenceid = "ooo";

  $arr2['vguid']=$vguid;
//"UPDATE userdata2 SET value='$contact' WHERE uguid= '$uguid' && type='$t1'"
  $action= 'cancel';
if($vremark!=""){
  $r1=mysqli_query($conn, "UPDATE vtable SET action='$action' where vguid='$vguid'");
  $r2=mysqli_query($conn, "INSERT INTO vstatus (vguid,vsequenceid,updatedon,updatedat,updatedby,vremark)VALUES ('$vguid','$vsequenceid','$createdon','$createdat','$createdby','$vremark')");


if($r1 && $r2){
  $arr2['statuscode']="s";
  $arr2['description']="Vacation cancelled Successfully";

}
}
else{
  $arr2['description']="Please enter some cancellation remark";
}


echo json_encode($arr2);
mysqli_close($conn);



}
// ######################################################################################################################
// Function for editing main task
else if($_POST['type']=="6"){

  $arr2 = array (

          "uguid"=> "",
          "tguid"=> "",
          "tid"=> "",
          "tdescription"=> "",
          "ttype"=> "",
          "assignto"=> "",
           "pstart"=> "",
          "pend"=> "",
          "peffort"=> "",
          "statuscode"=>"e",
          "description"=>"Error while editing task"

      );

  $uguid=$_POST['uguid1'];
  $tguid= $_POST['tguid1'];
  $tid= $_POST['tid1'];
  $tdescription= $_POST['tdescription1'];
  $ttype= $_POST['ttype1'];
  $assignto= $_POST['assignto1'];
  $pstart= $_POST['pstart1'];
  $pend= $_POST['pend1'];
  $peffort= $_POST['peffort1'];

  $tstage;

  $arr2['uguid']="$uguid";
  $arr2['tid']="$tguid";
  $arr2['tid']="$tid";
  $arr2['tdescription']="$tdescription";
  $arr2['ttype']="$ttype";
  $arr2['assignto']="$assignto";
  $arr2['pstart']="$pstart";
  $arr2['pend']="$pend";
  $arr2['peffort']="$peffort";

  if($pstart=="") $tstage=1;

  else $tstage=2;

  $s3= mysqli_query($conn,"select * from ttable where tid= '$tid' && tguid!='$tguid' && createdby='$uguid'");
  $n3= mysqli_num_rows($s3);


  if($n3){
    $arr2['description']="Task ID Already Exist";
    echo json_encode($arr2);
    mysqli_close($conn);
    //echo "<script type='text/javascript'>alert('Task ID Already Exist.!'); window.location.href = 'mytask.php';</script>";
  }
  else{

  if(($pstart!="" && $pend!="" && $peffort!="") || ($pstart=="" && $pend=="" && $peffort=="") ){
  if($assignto=="") $assignto=$uguid;
  $tsequence=0;
  $s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype' WHERE tguid= '$tguid'");
  $s2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto',tstepdescription='$tdescription',tstage='$tstage', pstart='$pstart',pend='$pend',peffort='$peffort' WHERE tguid= '$tguid' && tsequenceid='$tsequence'");

  if($s1 && $s2){
    $arr2['statuscode']="s";
    $arr2['description']="Task Succcessfully Updated";
    echo json_encode($arr2);
    mysqli_close($conn);
  //echo "<script type='text/javascript'>alert('Successful - Task Updated!'); window.location.href = 'mytask.php';</script>";
  }
  else{
    echo json_encode($arr2);
    mysqli_close($conn);
  //echo "<script type='text/javascript'>alert('UnSuccessful - Task Not Updated!'); window.location.href = 'mytask.php';</script>";
  }
  }
  else{

    $arr2['description']="Please Enter all Planning Details";
    echo json_encode($arr2);
    mysqli_close($conn);

    //echo "<script type='text/javascript'>alert('UnSuccessful - Enter all planning details!'); window.location.href = 'mytask.php';</script>";
  }
  }

}
// ######################################################################################################################
// Function for updating and view comment
else if($_POST['type']=="7"){


    $arr2 = array (

            "comment"=> "",
            "assignto"=> "",
            "tstage"=> "",
            "tguid"=> "",
            "efforth"=> "",
            "effortm"=> "",
             "aeffort"=> "",
            "statuscode"=>"e",
            "description"=>"Error while updating"

        );

  $comment= $_POST['comment4'];
  $assignto=$_POST['userslist'];
  $tstage=$_POST['tstatus4'];
  $tguid= $_POST['tguid4'];
  $efforth=$_POST['efforth'];
  $effortm=$_POST['effortm'];

  $arr2['comment']="$comment";
  $arr2['assignto']="$assignto";
  $arr2['tstage']="$tstage";
  $arr2['tguid']="$tguid";
  $arr2['efforth']="$efforth";
  $arr2['effortm']="$effortm";





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
  $pstart=$row['pstart'];
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
  $arr2['aeffort']="$aeffort";

  if($assignto==0) $assignto=$prev_assignto;

  $r2="";
  $tstageinfo="";

   if($tstage==3)        $tstageinfo="In Progress (Start)";
   else if($tstage==4)   $tstageinfo="Completed";
   else if($tstage==5)   $tstageinfo="On Hold";
   else if($tstage==6)   $tstageinfo="Awaiting";




if($pstart=="0000-00-00"){

  $arr2['description']="Task needs to be planned first";
  echo json_encode($arr2);
  mysqli_close($conn);
  exit();
  // echo "<script type='text/javascript'>alert('Task needs to be planned first'); window.location.href = 'mytask.php';</script>";
  // exit("Task needs to be planned first");
}
if(($astart=="" || $astart=="NULL" || $astart=="0000-00-00") && $tstage==4){
  // echo "<script type='text/javascript'>alert('Task can not be completed before starting it'); window.location.href = 'mytask.php';</script>";
  // exit("Task can not be completed before starting it");
  $arr2['description']="Task can not be completed before starting it";
  echo json_encode($arr2);
  mysqli_close($conn);
  exit();

}

if($tstage==0) $tstage=$prev_tstage;
if($tstage==0 && $prev_tstage==2 && $aeffort!='') $tstage=3;
if($astart=="0000-00-00" && $aeffort!="") $astart=$date1;

$aend="0000-00-00";

$r6= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && astart!='0000-00-00' order by astart asc LIMIT 1");
$n6= mysqli_num_rows($r6);
if($n6){
  $row6=mysqli_fetch_assoc($r6);
  $astart=$row6['astart'];

}


if($tstage==$prev_tstage){

  $r2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto',aeffort='$aeffort',astart='$astart',aend='$aend' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
}
else if($tstage==3){
      $astart=$date1;
      $aend="0000-00-00";
      $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',astart='$astart',aeffort='$aeffort',aend='$aend',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
  }
  else if($tstage==4){

    $aend1= "0000-00-00";
     $r6= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && aend='$aend1' ");
     $n6= mysqli_num_rows($r6);

     if($n6){
       $arr2['description']="Complete all step tasks before completing the main task";
       echo json_encode($arr2);
       mysqli_close($conn);
        exit();

      // echo "<script type='text/javascript'>alert('Complete all steps tasks before completing the main task'); window.location.href = 'mytask.php';</script>";
      // exit();
    }
   else{
     $aend=$date1;
     $r7= mysqli_query($conn,"select MAX(aend) AS max from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' ");
     $n7= mysqli_num_rows($r7);

     if($n7){
       $row7=mysqli_fetch_array($r7);
       $aend=$row7['max'];
     }

      $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',aend='$aend',aeffort='$aeffort',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");

    }

   }
else{

  $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',aeffort='$aeffort',assignto='$assignto',astart='$astart',aend='$aend' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
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



  if($r2 && $r4 ){
    $arr2['statuscode']="s";
    $arr2['description']="Updated Successfully !";
    echo json_encode($arr2);
    mysqli_close($conn);

    //echo "<script type='text/javascript'>alert('Updated Successfully !'); window.location.href = 'mytask.php';</script>";
  }
  else{
    $arr2['description']="Failed to update !";
    echo json_encode($arr2);
    mysqli_close($conn);
    //echo "<script type='text/javascript'>alert('Failed to update !'); window.location.href = 'mytask.php';</script>";
  }

}
// ######################################################################################################################
// Function for edit task steps
else if($_POST['type']=="8"){

  $arr2 = array (

          "uguid"=> "",
          "tguid"=> "",
          "tsequenceid"=> "",
          "pstart"=> "",
          "pend"=> "",
          "peffort"=> "",
          "statuscode"=>"e",
          "description"=>"Error while editing task step"

      );

  $uguid=$_POST['uguid3'];
  $tguid= $_POST['tguid3'];
  $tsequenceid= $_POST['tsequenceid3'];
  $pstart= $_POST['pstart3'];
  $pend= $_POST['pend3'];
  $peffort= $_POST['peffort3'];
  $tstage=2;

  $arr2['uguid']="$uguid";
  $arr2['tguid']="$tguid";
  $arr2['tsequenceid']="$tsequenceid";
  $arr2['pstart']="$pstart";
  $arr2['pend']="$pend";
  $arr2['peffort']="$peffort";


  if($pstart!="" && $pend!="" && $peffort!=""){

  $s2= mysqli_query($conn,"UPDATE tstep SET tstage=$tstage, pstart='$pstart',pend='$pend',peffort='$peffort' WHERE tguid= '$tguid' && tsequenceid='$tsequenceid'");

  if( $s2){
    $arr2['statuscode']="s";
    $arr2['description']="Task Step Updated Successfully !";
    echo json_encode($arr2);
  //echo "<script type='text/javascript'>alert('Successful - Task Step Updated!'); window.location.href = 'mytask.php';</script>";

  }
  else{
    $arr2['description']="Error while updating task step!";
    echo json_encode($arr2);
  //echo "<script type='text/javascript'>alert('UnSuccessful - Task Step Not Updated!'); window.location.href = 'mytask.php';</script>";
  }

   }
   else{

     $arr2['description']="Please enter complete planning details !";
     echo json_encode($arr2);

      //echo "<script type='text/javascript'>alert('UnSuccessful - Enter all planning details!'); window.location.href = 'mytask.php';</script>";
    }




}
// ######################################################################################################################
// Function for update task steps comment
else if($_POST['type']=="9"){


    $arr2 = array (
            "uguid"=> "",
            "comment"=> "",
            "assignto"=> "",
            "tstage"=> "",
            "tsequenceid"=>"",
            "tguid"=> "",
            "efforth"=> "",
            "effortm"=> "",
             "aeffort"=> "",
            "statuscode"=>"e",
            "description"=>"Error while updating task step"

        );

  $uguid=$_SESSION['uguid'];
  $tguid= $_POST['tguid5'];
  $tsequenceid=$_POST['tsequenceid5'];
  $efforth5=$_POST['efforth5'];
  $effortm5=$_POST['effortm5'];
  $comment= $_POST['comment5'];
  $assignto=$_POST['userslist5'];
  $tstage=$_POST['tstatus5'];

  $arr2['uguid']="$uguid";
  $arr2['comment']="$comment";
  $arr2['assignto']="$assignto";
  $arr2['tstage']="$tstage";
  $arr2['tguid']="$tguid";
  $arr2['efforth']="$efforth5";
  $arr2['effortm']="$effortm5";
  $arr2['tsequenceid']="$tsequenceid";

  date_default_timezone_set("Asia/Kolkata");
  $date1= date("Ymd");
  $time1= date("His");

  $updatedon=$date1;
  $updatedat=$time1;
  $updatedby=$uguid;



  if($assignto=="0" || $assignto=="") $assignto=$uguid;

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

  $tstageinfo="";

   if($tstage==3)        $tstageinfo="In Progress (Start)";
   else if($tstage==4)   $tstageinfo="Completed";
   else if($tstage==5)   $tstageinfo="On Hold";
   else if($tstage==6)   $tstageinfo="Awaiting";


  if($prev_aeffort=="") $prev_aeffort=0;
  if($efforth5=="") $efforth5=0;
  if($effortm5=="") $effortm5=0;

  $aeffort= $prev_aeffort+ 60*$efforth5+ $effortm5;


  $r2="";
  $r4="";

  $s7= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid='0'");
  $row7 = mysqli_fetch_assoc($s7);
  $aeffortprev_main=$row7["aeffort"];
  if($aeffortprev_main=="") $aeffortprev_main=0;
  $aeffortnew_main=$aeffortprev_main+ 60*$efforth5+ $effortm5;


  $astart_main="0000-00-00";
  if($aeffortnew_main) $astart_main=$date1;

  $r6= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid!='$tsequenceid' && astart!='0000-00-00' order by astart asc LIMIT 1");

  $n6= mysqli_num_rows($r6);
  if($n6){
    $row6=mysqli_fetch_assoc($r6);
    $astart_main=$row6['astart'];

  }
  if($aeffortnew_main==0) $aeffortnew_main="";
  $r4= mysqli_query($conn,"UPDATE tstep SET astart='$astart_main', aeffort='$aeffortnew_main' WHERE tguid='$tguid' && tsequenceid='0'");


  if($aeffort==0) $aeffort="";

  $arr2['aeffort']="$aeffort";
  if($assignto==0) $assignto=$prev_assignto;



if( $pstart=="0000-00-00"  ){
  $arr2['description']="Task needs to be planned first";
  echo json_encode($arr2);
  exit();
  // echo "<script type='text/javascript'>alert('Task needs to be planned first'); window.location.href = 'mytask.php';</script>";
  // exit("Task needs to be planned first");
}
if(( $astart=="0000-00-00") && $tstage==4){
  $arr2['description']="Task can not be completed before starting it";
  echo json_encode($arr2);
  exit();
  // echo "<script type='text/javascript'>alert('Task can not be completed before starting it'); window.location.href = 'mytask.php';</script>";
  // exit("Task can not be completed before starting it");

}
if($tstage==0 && $prev_tstage==2 && $aeffort!='') $tstage=3;
if($tstage==0) $tstage=$prev_tstage;


if($astart=="0000-00-00" && $aeffort!="") $astart=$date1;
$aend="0000-00-00";

if($tstage==$prev_tstage){

  $r2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto' ,aeffort='$aeffort',astart='$astart',aend='$aend' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");

}
else if($tstage==3){


      $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',astart='$astart',assignto='$assignto',aeffort='$aeffort',aend='$aend' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
  }
  else if($tstage==4){
    $aend=$date1;
    $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',aend='$aend',aeffort='$aeffort',assignto='$assignto' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
  }
else{
  $r2= mysqli_query($conn,"UPDATE tstep SET tstage='$tstage',assignto='$assignto',aeffort='$aeffort',astart='$astart',aend='$aend' WHERE tguid='$tguid' && tsequenceid='$tsequenceid'");
}
$res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
$res4= mysqli_fetch_assoc($res3);
$username= $res4["uname"];
$r3="";


if(($prev_assignto==$assignto) && ($prev_tstage==$tstage) ){
   $r3= mysqli_query($conn, "INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')");

}
else if(($prev_assignto!=$assignto) && ($prev_tstage==$tstage)){
 $comment0= "Assigned to: ".$username." ";
 $r3=mysqli_query($conn,"INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment0'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')");
}
else if(($prev_assignto==$assignto)&&($prev_tstage!=$tstage)){
 $comment1= "Task Phase Changed to: ".$tstageinfo." ";
 $r3=mysqli_query($conn,"INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment1'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')" );

}
else{
 $comment0= "Assigned to: ".$username." ";
 $comment1= "Task Phase Changed to: ".$tstageinfo." ";
 $r3=mysqli_query($conn,"INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment0'), ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment1'),('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')");

}


  if($r2 && $r3 && $r4){
    $arr2['statuscode']="s";
    $arr2['description']="Updated Successfully !";
    echo json_encode($arr2);

    //echo "<script type='text/javascript'>alert('Updated Successfully !'); window.location.href = 'mytask.php';</script>";
  }
  else{
    $arr2['description']="Failed to update !";
    echo json_encode($arr2);
    // echo "<script type='text/javascript'>alert('Failed to update !'); window.location.href = 'mytask.php';</script>";
  }
}
else if($_POST['type']=="10"){

  $arr2 = array (
          "createdon"=> "",
          "assignto"=> "",
          "assignto_id"=> "",
          "tguid"=> "",
          "tid"=>"",
          "tdescription"=> "",
          "ttype"=> "",
          "pstart"=> "",
           "pend"=> "",
           "peffort"=> "",
           "astart"=> "",
           "aend"=> "",
           "aeffort"=> "",
          "statuscode"=>"e",
          "description"=>"Error while updating task step"

      );

  // <th scope="col">Task Creation Date</th>
  // <th scope="col">Assigned to</th>
  // <th scope="col" style="display:none;">Assigned to (id)</th>
  // <th scope="col" style="display:none;" >Task GUID</th>
  // <th scope="col">Task ID</th>
  // <th scope="col">Task Description</th>
  // <th scope="col">Task Type</th>
  // <th scope="col">Planned Start</th>
  // <th scope="col">Planned End</th>
  // <th scope="col">Planned Effort (days)</th>
  // <th scope="col">Actual Start</th>
  // <th scope="col" >Actual End</th>
  // <th scope="col">Actual Effort (mins)</th>
  //
  // <th scope="col" style="width: 160px;">Task Status</th>

}
else if($_POST['type']=="11"){

  $pendingtasks=array();
  $safeinprogressall=array();
  $alertinprogressall=array();
  $dangerinprogressall=array();
  $allprogresstasks=array();
  $allvacations=array();
  $allremarks=array();

  $alltasks=array();
  $allusers = unserialize($_SESSION['allusers']);

  //$uguid=$_SESSION['uguid'];
  $date= $_POST['date'];
  $todotask = array (
          "date"=>$date,
          "tid"=>"",
          "createdon"=>"",
          "tguid"=> "",
          "tsequenceid"=> "",
          "tstage"=>"",
          "tstepdescription"=>"",
          "statuscode"=>"e",
          "description"=>"Error while loading tasks"

      );
      $safeinprogress = array (
              "date"=>$date,
              "tid"=>"",
              "pstart"=>"",
              "pend"=>"",
              "pdiff"=>"",
              "createdon"=>"",
              "tguid"=> "",
              "tsequenceid"=> "",
              "tstage"=>"",
              "tstepdescription"=>"",
              "statuscode"=>"e",
              "description"=>"Error while loading tasks"

          );
        $vacation = array (
                "date"=>$date,
                "vguid"=>"",
                "vid"=>"",
                "vremark"=>"",
                "vstart"=>"",
                "vend"=>"",
                "action"=>"",

                "createdon"=>"",
                "createdat"=> "",
                "createdby"=> "",

                "statuscode"=>"e",
                "description"=>"Error while loading vacations"

            );
          $remark = array (
                  "date"=>$date,
                  "vguid"=>"",
                  "vsequenceid"=>"",
                  "vremark"=>"",

                  "updatedon"=>"",
                  "updatedat"=> "",
                  "updatedby"=> "",

                  "statuscode"=>"e",
                  "description"=>"Error while loading remarks"

              );

$allusers = unserialize($_SESSION['allusers']);
for($i = 0; $i < count($allusers); $i++)
{
$uguid=$allusers[$i]["uguid"];

$sequence= 0;
$stage=1;
$sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid  && c.tsequenceid!='$sequence' && c.tstage='$stage' && p.createdon <='$date' && c.assignto='$uguid' order by p.tid";
$result=mysqli_query($conn, $sql1);

 while($row=mysqli_fetch_assoc($result)){
  $todotask['tguid']= $row['tguid'];
  $todotask['tid']= $row['tid'];
  $todotask['createdon']= $row['createdon'];
  $todotask['tsequenceid']= $row['tsequenceid'];
  $todotask['tstage']= $row['tstage'];
  $todotask['tstepdescription']= $row['tstepdescription'];
  $todotask['tstage']= $row['tstage'];
  $todotask['statuscode']= "s";
  $todotask['description']= "Task successfully loaded";
  $pendingtasks[]=$todotask;
}




$sql2="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid  && c.tsequenceid!='$sequence' && c.tstage!='1' && c.tstage!='4' && c.pstart <='$date' && c.assignto='$uguid'  order by p.tid";
$result2=mysqli_query($conn, $sql2);

while($row=mysqli_fetch_assoc($result2)){
 $safeinprogress['tguid']= $row['tguid'];
 $safeinprogress['tid']= $row['tid'];
 $safeinprogress['pstart']= $row['pstart'];
 $safeinprogress['pend']= $row['pend'];

 //$date2=$row['pend'];
 // $newdate1 = date("Ymd", strtotime($date1));
 // $datenow=$date;
 // $datenow1=date("Ymd",strtotime($datenow));
 // $diff= $newdate1-$datenow1;

 //$date1=$date;
 $date2=date_create($row['pend']);
 $date1=date_create($date);
 $diff=date_diff($date1,$date2);
 $pdiff1= $diff->format("%R%a");
 $pdiff2= (int)$pdiff1;
 $safeinprogress['pdiff']= $pdiff2;

 $safeinprogress['createdon']= $row['createdon'];
 $safeinprogress['tsequenceid']= $row['tsequenceid'];
 $safeinprogress['tstage']= $row['tstage'];
 $safeinprogress['tstepdescription']= $row['tstepdescription'];
 $safeinprogress['tstage']= $row['tstage'];
 $safeinprogress['statuscode']= "s";
 $safeinprogress['description']= "Task successfully loaded";

 $allprogresstasks[]=$safeinprogress;

 if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
 else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
 else $dangerinprogressall[]=$safeinprogress;

}
$vguid="";
$action="cancel";
$r2= mysqli_query($conn,"select * from vtable where  vstart <='$date' && vend>= '$date' && action!='$action' && createdby='$uguid'");
$n2= mysqli_num_rows($r2);
while($row=mysqli_fetch_assoc($r2)){
  $vacation['vguid']= $row['vguid'];
  $vacation['vid']= $row['vid'];
  $vacation['vremark']= $row['vremark'];
  $vacation['vstart']= $row['vstart'];
  $vacation['vend']= $row['vend'];
  $vacation['createdon']= $row['createdon'];
  $vacation['createdat']= $row['createdat'];
  $vacation['createdby']= $row['createdby'];

  $vacation['action']= $row['action'];
  $vacation['statuscode']= "s";
  $vacation['description']= "vacation loaded successfully";

  $allvacations[]=$vacation;


}
  $vguid=$vacation['vguid'];

if($n2){
 $r4= mysqli_query($conn,"select * from vstatus where vguid='$vguid'");
while($row=mysqli_fetch_assoc($r4)){
$remark['vguid']= $row['vguid'];
$remark['vsequenceid']= $row['vsequenceid'];
$remark['vremark']= $row['vremark'];
$remark['updatedon']= $row['updatedon'];
$remark['updatedat']= $row['updatedat'];
$userid=$row['updatedby'];
$seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
//$r6= mysqli_query($conn,"select * from userdata1 where uguid='$userid'");
$row2=mysqli_fetch_assoc($seq);
$remark['updatedby']= $row2['uname'];


$remark['statuscode']= "s";
$remark['description']= "Remarks loaded successfully";

$allremarks[]=$remark;
}
}


}


$alltasks[]=$pendingtasks;
$alltasks[]=$safeinprogressall;
$alltasks[]=$alertinprogressall;
$alltasks[]=$dangerinprogressall;
$alltasks[]=$allprogresstasks;
$alltasks[]=$allvacations;
$alltasks[]=$allremarks;


echo json_encode($alltasks);
mysqli_close($conn);

}


?>
