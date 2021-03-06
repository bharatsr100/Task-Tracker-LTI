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
                  "remarktest"=>"",
                  "statuscode"=>"e",
                  "description"=>"Error while loading remarks"

              );

              $subremarktest = array (
                "id"=>"",
                "name"=>""
              );
              $allsubremarktes=array();




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
$action2="Rejected";
$r2= mysqli_query($conn,"select * from vtable where  vstart <='$date' && vend>= '$date' && action!='$action' && action!='$action2' && createdfor='$uguid'");
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

for($i = 0; $i < 5; $i++) {
  $subremarktest['id']=$i;
  $subremarktest['name']="test";
  $allsubremarktest[]=$subremarktest;

}
$remark['remarktest']=$allsubremarktest;

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
  "createdfor"=> "",
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
$createdfor=$uguid;
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
$arr2['createdfor']="$createdfor";


if($vid!="" && $vstart!="" && $vend!="" && $vremark!="" && $vid!=$viddefault ){

  $r2= mysqli_query($conn,"select * from vtable where ( (vstart <='$vstart' && vend>= '$vstart') || (vstart <='$vend' && vend>= '$vend') || (vstart>='$vstart' && vend<='$vend' )) && action!='cancel' && createdfor='$uguid'");
  $n2= mysqli_num_rows($r2);
  //$n2=1;

if($n2){
  $arr2['description']="Can not have more than one vacation plan on a particular date. Please check already existing vacation plans";

  echo json_encode($arr2);
  mysqli_close($conn);

}
else {
  $r1=mysqli_query($conn, "INSERT INTO vtable (vguid,vid,vstart,vend,vremark,createdon,createdat,createdby,createdfor,action)VALUES ('$vguid','$vid','$vstart','$vend','$vremark','$createdon','$createdat','$createdby','$createdfor','$action')");
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
          "priority"=>"",
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
  $priority= $_POST['priority1'];

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
  $arr2['priority']="$priority";

  if($pstart=="") $tstage=1;

  else $tstage=2;

  $s3= mysqli_query($conn,"select * from ttable where tid= '$tid' && tguid!='$tguid' ");
  $n3= mysqli_num_rows($s3);


  if($n3){
    $arr2['description']="Task ID Already Exist";
    echo json_encode($arr2);
    mysqli_close($conn);
    //echo "<script type='text/javascript'>alert('Task ID Already Exist.!'); window.location.href = 'mytask.php';</script>";
  }
  else{

  if($pstart=="" && $pend=="" && $peffort==0 && $priority!=0){
    $s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype',priority='$priority' WHERE tguid= '$tguid'");
    $arr2['statuscode']="s";
    $arr2['description']="Task Succcessfully Updated";
    echo json_encode($arr2);
    mysqli_close($conn);
    exit();
  }

  if(($pstart!="" && $pend!="" && $peffort!=0) || ($pstart=="" && $pend=="" && $peffort==0) ){
  if($assignto=="") $assignto=$uguid;
  $tsequence=0;
  $s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype',priority='$priority' WHERE tguid= '$tguid'");
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
// Function for updating and view comment for my task
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




if($pstart=="0000-00-00" && $aeffort=!""){

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

  $s5= mysqli_query($conn,"select * from tstep where tguid='$tguid' && tsequenceid=0");
  $row= mysqli_fetch_assoc($s5);
  $pstart_main=$row["pstart"];

  if($pstart_main=="0000-00-00" && $pstart!="0000-00-00"){
    $arr2['description']="Task Step can not be planned for a unplanned main task";
    echo json_encode($arr2);
    exit();
  }

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



if( $pstart=="0000-00-00"  && $aeffort!=""){
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
//Function to fetch tasks and vacation for my team daily calendar
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
          "assignto"=>"",
          "assignto_id"=>"",
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
              "assignto"=>"",
              "assignto_id"=>"",
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
                "createdfor"=> "",
                "createdfor_name"=> "",
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
                  "createdfor"=> "",

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
  $todotask['assignto_id']=$row['assignto'];
  $username=$row['assignto'];
  $sql_name=mysqli_query($conn,"select * from userdata1 where uguid='$username'");
  $res_name=mysqli_fetch_array($sql_name);
  $todotask['assignto']=$res_name['uname'];
  $pendingtasks[]=$todotask;
}


$sql2="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid  && c.tsequenceid!='$sequence' && c.tstage!='1' && c.tstage!='4' && c.pstart <='$date' && c.assignto='$uguid'  order by p.tid";
$result2=mysqli_query($conn, $sql2);

while($row=mysqli_fetch_assoc($result2)){
 $safeinprogress['tguid']= $row['tguid'];
 $safeinprogress['tid']= $row['tid'];
 $safeinprogress['pstart']= $row['pstart'];
 $safeinprogress['pend']= $row['pend'];

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
 $safeinprogress['assignto_id']=$row['assignto'];
 $username=$row['assignto'];
 $sql_name=mysqli_query($conn,"select * from userdata1 where uguid='$username'");
 $res_name=mysqli_fetch_array($sql_name);
 $safeinprogress['assignto']=$res_name['uname'];
 $allprogresstasks[]=$safeinprogress;

 if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
 else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
 else $dangerinprogressall[]=$safeinprogress;

}
$vguid="";
$action="cancel";
$action2="Rejected";
$r2= mysqli_query($conn,"select * from vtable where  vstart <='$date' && vend>= '$date' && action!='$action' && action!='$action2' && createdfor='$uguid'");
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

  $userid=$row['createdfor'];
  $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
  $row2=mysqli_fetch_assoc($seq);
  $vacation['createdfor_name']= $row2['uname'];

  $vacation['createdfor']= $row['createdfor'];
  $vacation['action']= $row['action'];

  if($vacation['action']=="") $vacation['action']="Requested";
  $vacation['statuscode']= "s";
  $vacation['description']= "vacation loaded successfully";

  $allvacations[]=$vacation;


}
  $vguid=$vacation['vguid'];
  $createdby=  $vacation['createdfor'];

if($n2){
 $r4= mysqli_query($conn,"select * from vstatus where vguid='$vguid'");
while($row=mysqli_fetch_assoc($r4)){
$remark['vguid']= $row['vguid'];
$remark['vsequenceid']= $row['vsequenceid'];
$remark['vremark']= $row['vremark'];
$remark['updatedon']= $row['updatedon'];
$remark['updatedat']= $row['updatedat'];
$userid=$row['updatedby'];
$userid_for= $createdby;
$seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
$row2=mysqli_fetch_assoc($seq);
$remark['updatedby']= $row2['uname'];

$seq3=mysqli_query($conn, "select * from userdata1 where uguid='$userid_for'");
$row3=mysqli_fetch_assoc($seq3);
$remark['createdfor']= $row3['uname'];

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

//function for team vacation plan
else if($_POST['type']=="12"){

  $arr2 = array (
  "vguid"=> "",
  "vid"=> "",
  "vstart"=>"",
  "vend"=>"",
  "vremark"=>"",
  "createdon"=> "",
  "createdat"=> "",
  "createdby"=> "",
  "createdfor"=> "",
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
$createdfor=$_POST['createdfor'];
if($createdfor==0) $createdfor=$uguid;

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
$arr2['createdfor']="$createdfor";


if($vid!="" && $vstart!="" && $vend!="" && $vremark!="" && $vid!=$viddefault ){

  $r2= mysqli_query($conn,"select * from vtable where ( (vstart <='$vstart' && vend>= '$vstart') || (vstart <='$vend' && vend>= '$vend') || (vstart>='$vstart' && vend<='$vend' )) && action!='cancel' && createdfor='$createdfor'");
  $n2= mysqli_num_rows($r2);
  //$n2=1;

if($n2){
  $arr2['description']="Can not have more than one vacation plan on a particular date. Please check already existing vacation plans";

  echo json_encode($arr2);
  mysqli_close($conn);

}
else {
  $r1=mysqli_query($conn, "INSERT INTO vtable (vguid,vid,vstart,vend,vremark,createdon,createdat,createdby,createdfor,action)VALUES ('$vguid','$vid','$vstart','$vend','$vremark','$createdon','$createdat','$createdby','$createdfor','$action')");
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
//function for team vacation plan
else if($_POST['type']=="13")
{
  $allvacations=array();
  $vacation = array (
  "vguid"=> "",
  "createdfor_id"=> "",
  "createdfor"=> "",
  "vstart"=>"",
  "vend"=>"",
  "vremark"=>"",
  "vreason"=>"",
  "action"=>"",
  "statuscode"=>"e",
  "description"=>"Error occured while loading vacation"

);
$allvremark_foraleave=array();
$eachremark=array(
  "updatedby"=>"",
  "updatedby"=>"",
  "updatedby_name"=>"",
  "updatedon"=>"",
  "updatedat"=>"",
  "sub_vremark"=>""
);

$allusers = unserialize($_SESSION['allusers']);

//$index=0;
$user_uguid= $_SESSION['uguid'];
for($i = 0; $i < count($allusers); $i++) {
  if($allusers[$i]["uguid"]==$user_uguid) unset($allusers[$i]);
}

for($i = 0; $i < count($allusers); $i++) {
$uguid=$allusers[$i]["uguid"];
$uname=$allusers[$i]["uname"];
$r2= mysqli_query($conn,"select * from vtable where createdfor='$uguid'");

while($row=mysqli_fetch_assoc($r2)){
  $vacation['vguid']= $row['vguid'];
  $vacation['createdfor']= $uname;
  $vacation['createdfor_id']= $row['createdfor'];
  $vacation['vstart']= $row['vstart'];
  $vacation['vend']= $row['vend'];
  $vacation['action']= $row['action'];
  $vacation['statuscode']= "s";
  $vacation['description']= "vacation loaded successfully";

  $vguid=$row['vguid'];
  $vid= $row['vid'];
  $vreason="";

  if($vid=="sick") $vreason="Sick Leave";
  else if($vid="spld") $vreason="Special day";
  else if($vid="emeg") $vreason="Emergency";
  else $vreason="Unplanned";

  $vacation['vreason']= $vreason;
  // $vacation['vremark']= $row['vremark'];
$r4= mysqli_query($conn,"select * from vstatus where vguid='$vguid'");

unset($allvremark_foraleave);
$allvremark_foraleave = array();
 while($row1=mysqli_fetch_assoc($r4)){
   $eachremark['updatedby']= $row1['updatedby'];
   $eachremark['updatedon']= $row1['updatedon'];
   $eachremark['updatedat']= $row1['updatedat'];
   $updatedby= $eachremark['updatedby'];
   $eachremark['sub_vremark']= $row1['vremark'];

   $seq_1=mysqli_query($conn, "select * from userdata1 where uguid='$updatedby'");
   $row_user=mysqli_fetch_assoc($seq_1);
   $eachremark['updatedby_name']=$row_user['uname'];
   $allvremark_foraleave[]=$eachremark;

 }
  $vacation['vremark']=$allvremark_foraleave;

  $allvacations[]=$vacation;


}

}

echo json_encode($allvacations);
mysqli_close($conn);

}
//Function to approve vacation
else if($_POST['type']=="14")
{
  $arr2 = array (
  "vguid"=> "",
  "action"=>"",
  "vremark"=>"",
  "statuscode"=>"e",
  "description"=>"Error occured while approving vacation plan"

);
$date1= date("Ymd");
$time2= date("his");
$uguid=$_SESSION['uguid'];

$updatedon=$date1;
$updatedat=$time2;
$updatedby=$uguid;

$vguid= $_POST['vguid'];
$vremark= $_POST['vremark_action'];
$vsequenceid="ooo";

$arr2['vguid']=$vguid;
$arr2['vremark']=$vremark;
$action="Approved";
$s1= mysqli_query($conn,"UPDATE vtable SET action='$action'WHERE vguid= '$vguid'");
if($s1){
  $arr2['action']=$action;
  $arr2['statuscode']= "s";
  $arr2['description']= "Vacation Approved successfully";
}
if($vremark!=""){
  $r2=mysqli_query($conn, "INSERT INTO vstatus (vguid,vsequenceid,updatedon,updatedat,updatedby,vremark)VALUES ('$vguid','$vsequenceid','$updatedon','$updatedat','$updatedby','$vremark')");
}
echo json_encode($arr2);
mysqli_close($conn);

}
//Function to reject vacation
else if($_POST['type']=="15")
{
  $arr2 = array (
  "vguid"=> "",
  "action"=>"",
  "vremark"=>"",
  "statuscode"=>"e",
  "description"=>"Error occured while rejecting vacation plan"

);
$date1= date("Ymd");
$time2= date("his");
$uguid=$_SESSION['uguid'];

$updatedon=$date1;
$updatedat=$time2;
$updatedby=$uguid;
$vremark= $_POST['vremark_action'];
$vsequenceid="ooo";

$vguid= $_POST['vguid'];
$arr2['vguid']=$vguid;
$arr2['vremark']=$vremark;

$action="Rejected";
$s1= mysqli_query($conn,"UPDATE vtable SET action='$action'WHERE vguid= '$vguid'");
if($s1){
  $arr2['action']=$action;
  $arr2['statuscode']= "s";
  $arr2['description']= "Vacation Rejected successfully";
}
if($vremark!=""){
  $r2=mysqli_query($conn, "INSERT INTO vstatus (vguid,vsequenceid,updatedon,updatedat,updatedby,vremark)VALUES ('$vguid','$vsequenceid','$updatedon','$updatedat','$updatedby','$vremark')");
}
echo json_encode($arr2);
mysqli_close($conn);

}

//Function to cancel team vacation
else if($_POST['type']=="16")
{
  $arr2 = array (
  "vguid"=> "",
  "action"=>"",
  "vremark"=>"",
  "statuscode"=>"e",
  "description"=>"Error occured while cancelling vacation plan"

);
$date1= date("Ymd");
$time2= date("his");
$uguid=$_SESSION['uguid'];

$updatedon=$date1;
$updatedat=$time2;
$updatedby=$uguid;
$vremark= $_POST['vremark_action'];
$vsequenceid="ooo";

$vguid= $_POST['vguid'];
$arr2['vguid']=$vguid;
$arr2['vremark']=$vremark;

$action="cancel";
$s1= mysqli_query($conn,"UPDATE vtable SET action='$action'WHERE vguid= '$vguid'");
if($s1){
  $arr2['action']=$action;
  $arr2['statuscode']= "s";
  $arr2['description']= "Vacation cancelled successfully";
}
if($vremark!=""){
  $r2=mysqli_query($conn, "INSERT INTO vstatus (vguid,vsequenceid,updatedon,updatedat,updatedby,vremark)VALUES ('$vguid','$vsequenceid','$updatedon','$updatedat','$updatedby','$vremark')");
}
echo json_encode($arr2);
mysqli_close($conn);

}
//Function for admin search results
else if($_POST['type']=="17")
{ $all_ttypes=array();
  $sql_ttype1=mysqli_query($conn,"select * from task_types");
  while($row_ttype=mysqli_fetch_assoc($sql_ttype1)){
    $ttype_id=$row_ttype["ttype"];
    $ttype_desc=$row_ttype["ttype_desc"];

    $all_ttypes[$ttype_id]=$ttype_desc;

  }

  $tid= $_POST['tid'];
  if($tid=="") $tid="%";
  $createdon_from= $_POST['createdon_from'];
  $createdon_to= $_POST['createdon_to'];
  $pstart_from= $_POST['pstart_from'];
  $pstart_to= $_POST['pstart_to'];
  $pend_from= $_POST['pend_from'];
  $pend_to= $_POST['pend_to'];
  $astart_from= $_POST['astart_from'];
  $astart_to= $_POST['astart_to'];
  $aend_from= $_POST['aend_from'];
  $aend_to= $_POST['aend_to'];
  $peffort_from=($_POST['peffort_from']);
  if($peffort_from=="") $peffort_from=0;
  else $peffort_from=$peffort_from*480;
  $peffort_to= ($_POST['peffort_to']);
  if($peffort_to=="") $peffort_to=9999999;
  else $peffort_to=$peffort_to*480;

  $aeffort_from=($_POST['aeffort_from']);
  if($aeffort_from=="") $aeffort_from=0;
  else $aeffort_from=$aeffort_from*480;
  $aeffort_to= ($_POST['aeffort_to']);
  if($aeffort_to=="") $aeffort_to=9999999;
  else $aeffort_to=$aeffort_to*480;

  $tstatus= $_POST['tstatus'];
  if($tstatus==0) $tstatus="%";

  $userslist= $_POST['userslist'];
  if($userslist==0) $userslist="%";

  $userinfo= $_POST['userinfo'];

  if($createdon_from=="" && $createdon_to!="") $createdon_from=$createdon_to;
  if($createdon_to=="" && $createdon_from!="") $createdon_to=$createdon_from;
  if($pstart_from=="" && $pstart_to!="") $pstart_from=$pstart_to;
  if($pstart_to=="" && $pstart_from!="") $pstart_to=$pstart_from;
  if($pend_from=="" && $pend_to!="") $pend_from=$pend_to;
  if($pend_to=="" && $pend_from!="") $pend_to=$pend_from;
  if($astart_from=="" && $astart_to!="") $astart_from=$astart_to;
  if($astart_to=="" && $astart_from!="") $astart_to=$astart_from;
  if($aend_from=="" && $aend_to!="") $aend_from=$aend_to;
  if($aend_to=="" && $aend_from!="") $aend_to=$aend_from;

  if($createdon_from=="") $createdon_from="0000-00-00";
  if($createdon_to=="") $createdon_to="9999-12-31";
  if($pstart_from=="") $pstart_from="0000-00-00";
  if($pstart_to=="") $pstart_to="9999-12-31";
  if($pend_from=="") $pend_from="0000-00-00";
  if($pend_to=="") $pend_to="9999-12-31";
  if($astart_from=="") $astart_from="0000-00-00";
  if($astart_to=="") $astart_to="9999-12-31";
  if($aend_from=="") $aend_from="0000-00-00";
  if($aend_to=="") $aend_to="9999-12-31";

  $alltasks= array();
  $task = array (
          "tguid"=> "",
          "tid"=>"",
          "createdon"=>"",
          "assignto"=>"",
          "assignto_id"=>"",
          "tsequenceid"=> "",
          "tstepdescription"=>"",
          "ttype"=>"",
          "ttype_desc"=>"",
          "pstart"=>"",
          "pend"=>"",
          "date_today"=>"",
          "peffort"=>"",
          "astart"=>"",
          "aend"=>"",
          "aeffort"=>"",
          "tstage"=>"",
          "tstatus"=>"",
          "statuscode"=>"e",
          "description"=>"Error while loading tasks"

      );
      $date_today=date("Y-m-d");

      // if($tid=="" && $createdon_from=="" && $createdon_to=="" && $tstatus==0 && $userslist==0 && $userinfo==0){
        if($userinfo==0 || $userslist=="%")
{        if ($tstatus!=3) $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.tid like '$tid' &&  p.createdon>='$createdon_from' && p.createdon<='$createdon_to' && c.assignto like '$userslist' && c.tstage like '$tstatus'
        &&  c.pstart>='$pstart_from' && c.pstart<='$pstart_to' &&  c.pend>='$pend_from' && c.pend<='$pend_to' &&  c.astart>='$astart_from' && c.astart<='$astart_to' &&  c.aend>='$aend_from' && c.aend<='$aend_to' && c.peffort>='$peffort_from' && c.peffort<='$peffort_to' && c.aeffort>='$aeffort_from' && c.aeffort<='$aeffort_to' order by p.tid";
        else $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.tid like '$tid' &&  p.createdon>='$createdon_from' && p.createdon<='$createdon_to' && c.assignto like '$userslist' && (c.tstage =2 || c.tstage=3)  && c.peffort>='$peffort_from' && c.peffort<='$peffort_to' && c.aeffort>='$aeffort_from' && c.aeffort<='$aeffort_to' order by p.tid";
        $result=mysqli_query($conn, $sql1);

        while($row=mysqli_fetch_assoc($result)){
         $task['tguid']= $row['tguid'];
         $task['tid']= $row['tid'];
         $task['createdon']= $row['createdon'];
         $task['assignto_id']= $row['assignto'];

         $userid=$row['assignto'];
         $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
         $row2=mysqli_fetch_assoc($seq);
         $task['assignto']= $row2['uname'];

         $task['tsequenceid']= $row['tsequenceid'];
         $task['tstepdescription']= $row['tstepdescription'];
         $task['ttype']= $row['ttype'];
         $ttype_t=$row['ttype'];
         $task['ttype_desc']=$all_ttypes[$ttype_t];
         $task['pstart']= $row['pstart'];
         $task['pend']= $row['pend'];
         $task['date_today']=$date_today;
         $task['peffort']= $row['peffort'];
         $task['astart']= $row['astart'];
         $task['aend']= $row['aend'];
         $task['aeffort']= $row['aeffort'];
         $task['tstage']= $row['tstage'];
         $tstage=$row['tstage'];

         if($tstage==1) $task['tstatus']="To be Planned";
         else if($tstage==2 || $tstage==3) $task['tstatus']= "In Progress";
         else if($tstage==4) $task['tstatus']= "Completed";
         else if($tstage==5) $task['tstatus']="On Hold";
         else $task['tstatus']="Awaiting";

         $task['statuscode']= "s";
         $task['description']= "Task successfully loaded";

         $alltasks[]=$task;
       }
     }
     else if($userinfo==1){

       $users = array (
               "uguid"=> "",
               "uname"=> ""
             );

       $allusers= array ();

    function traversetree($conn,$tr6,$users,&$allusers){
     $n1=mysqli_num_rows($tr6);
     if($n1==0) return;

     while($rr6=mysqli_fetch_assoc($tr6)){
       $newowner=$rr6["reportee"];
       $tr= mysqli_query($conn,"select * from user_map where owner='$newowner'");

       traversetree($conn,$tr,$users,$allusers);

       $users['uguid']= $rr6['reportee'];
       $users['uname']= $rr6['reportee_name'];
       $allusers[]=$users;



     }


    }
    $tr6= mysqli_query($conn,"select * from user_map where owner='$userslist'");
    traversetree($conn,$tr6,$users,$allusers);


       for($i = 0; $i < count($allusers); $i++) {
       $uguid=$allusers[$i]["uguid"];
       if ($tstatus!=3) $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.tid like '$tid' &&  p.createdon>='$createdon_from' && p.createdon<='$createdon_to' && c.assignto = '$uguid' && c.tstage like '$tstatus'
           &&  c.pstart>='$pstart_from' && c.pstart<='$pstart_to' &&  c.pend>='$pend_from' && c.pend<='$pend_to' &&  c.astart>='$astart_from' && c.astart<='$astart_to' &&  c.aend>='$aend_from' && c.aend<='$aend_to'  && c.peffort>='$peffort_from' && c.peffort<='$peffort_to' && c.aeffort>='$aeffort_from' && c.aeffort<='$aeffort_to' order by p.tid";
           else $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.tid like '$tid' &&  p.createdon>='$createdon_from' && p.createdon<='$createdon_to' && c.assignto ='$uguid' && (c.tstage =2 || c.tstage=3)  && c.peffort>='$peffort_from' && c.peffort<='$peffort_to' && c.aeffort>='$aeffort_from' && c.aeffort<='$aeffort_to' order by p.tid";
           $result=mysqli_query($conn, $sql1);

           while($row=mysqli_fetch_assoc($result)){
            $task['tguid']= $row['tguid'];
            $task['tid']= $row['tid'];
            $task['createdon']= $row['createdon'];
            $task['assignto_id']= $row['assignto'];

            $userid=$row['assignto'];
            $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
            $row2=mysqli_fetch_assoc($seq);
            $task['assignto']= $row2['uname'];

            $task['tsequenceid']= $row['tsequenceid'];
            $task['tstepdescription']= $row['tstepdescription'];
            $task['ttype']= $row['ttype'];
            $ttype_t=$row['ttype'];
            $task['ttype_desc']=$all_ttypes[$ttype_t];
            $task['pstart']= $row['pstart'];
            $task['pend']= $row['pend'];
            $task['date_today']=$date_today;
            $task['peffort']= $row['peffort'];
            $task['astart']= $row['astart'];
            $task['aend']= $row['aend'];
            $task['aeffort']= $row['aeffort'];
            $task['tstage']= $row['tstage'];
            $tstage=$row['tstage'];

            if($tstage==1) $task['tstatus']="To be Planned";
            else if($tstage==2 || $tstage==3) $task['tstatus']= "In Progress";
            else if($tstage==4) $task['tstatus']= "Completed";
            else if($tstage==5) $task['tstatus']="On Hold";
            else $task['tstatus']="Awaiting";

            $task['statuscode']= "s";
            $task['description']= "Task successfully loaded";

            $alltasks[]=$task;
          }


     }
     }
     else{
       $users = array (
               "uguid"=> "",
               "uname"=> ""
             );

       $allusers= array ();

    function traversetree($conn,$tr6,$users,&$allusers){
     $n1=mysqli_num_rows($tr6);
     if($n1==0) return;

     while($rr6=mysqli_fetch_assoc($tr6)){
       $newowner=$rr6["reportee"];
       $tr= mysqli_query($conn,"select * from user_map where owner='$newowner'");

       traversetree($conn,$tr,$users,$allusers);

       $users['uguid']= $rr6['reportee'];
       $users['uname']= $rr6['reportee_name'];
       $allusers[]=$users;



     }


    }
    $tr6= mysqli_query($conn,"select * from user_map where owner='$userslist'");
    traversetree($conn,$tr6,$users,$allusers);

    $s5= mysqli_query($conn,"select * from userdata1 where uguid='$userslist'");
    $row5 = mysqli_fetch_assoc($s5);
    $userslist_name=$row5["uname"];

    $users['uguid']= $userslist;
    $users['uname']= $userslist_name;
    $allusers[]=$users;

       for($i = 0; $i < count($allusers); $i++) {
       $uguid=$allusers[$i]["uguid"];
       if ($tstatus!=3) $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.tid like '$tid' &&  p.createdon>='$createdon_from' && p.createdon<='$createdon_to' && c.assignto = '$uguid' && c.tstage like '$tstatus'
           &&  c.pstart>='$pstart_from' && c.pstart<='$pstart_to' &&  c.pend>='$pend_from' && c.pend<='$pend_to' &&  c.astart>='$astart_from' && c.astart<='$astart_to' &&  c.aend>='$aend_from' && c.aend<='$aend_to'  && c.peffort>='$peffort_from' && c.peffort<='$peffort_to' && c.aeffort>='$aeffort_from' && c.aeffort<='$aeffort_to' order by p.tid";
           else $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && p.tid like '$tid' &&  p.createdon>='$createdon_from' && p.createdon<='$createdon_to' && c.assignto ='$uguid' && (c.tstage =2 || c.tstage=3)  && c.peffort>='$peffort_from' && c.peffort<='$peffort_to' && c.aeffort>='$aeffort_from' && c.aeffort<='$aeffort_to' order by p.tid";
           $result=mysqli_query($conn, $sql1);

           while($row=mysqli_fetch_assoc($result)){
            $task['tguid']= $row['tguid'];
            $task['tid']= $row['tid'];
            $task['createdon']= $row['createdon'];
            $task['assignto_id']= $row['assignto'];

            $userid=$row['assignto'];
            $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
            $row2=mysqli_fetch_assoc($seq);
            $task['assignto']= $row2['uname'];

            $task['tsequenceid']= $row['tsequenceid'];
            $task['tstepdescription']= $row['tstepdescription'];
            $task['ttype']= $row['ttype'];
            $ttype_t=$row['ttype'];
            $task['ttype_desc']=$all_ttypes[$ttype_t];
            $task['pstart']= $row['pstart'];
            $task['pend']= $row['pend'];
            $task['date_today']=$date_today;
            $task['peffort']= $row['peffort'];
            $task['astart']= $row['astart'];
            $task['aend']= $row['aend'];
            $task['aeffort']= $row['aeffort'];
            $task['tstage']= $row['tstage'];
            $tstage=$row['tstage'];

            if($tstage==1) $task['tstatus']="To be Planned";
            else if($tstage==2 || $tstage==3) $task['tstatus']= "In Progress";
            else if($tstage==4) $task['tstatus']= "Completed";
            else if($tstage==5) $task['tstatus']="On Hold";
            else $task['tstatus']="Awaiting";

            $task['statuscode']= "s";
            $task['description']= "Task successfully loaded";

            $alltasks[]=$task;
          }


     }

     }



 echo json_encode($alltasks);
 mysqli_close($conn);


}
else if($_POST['type']=="18")
{

  $task = array (
          "tguid"=> "",
          "tid"=>"",
          "assignto"=>"",
          "tsequenceid"=> "",
          "tstepdescription"=>"",
          "ttype"=>"",
          "pstart"=>"",
          "pend"=>"",
          "peffort"=>"",
          "astart"=>"",
          "aend"=>"",
          "aeffort"=>"",
          "tstage"=>"",
          "statuscode"=>"e",
          "description"=>"Error while updating task details"

      );

  $assignto= $_POST['assignto'];
  $tguid= $_POST['tguid'];
  $tid= $_POST['tid'];
  $tsequenceid= $_POST['tsequenceid'];
  $tdescription= $_POST['tdescription'];
  $ttype= $_POST['ttype'];
  $pstart= $_POST['pstart'];
  $pend= $_POST['pend'];
  $peffort= $_POST['peffort']*480;
  $astart= $_POST['astart'];
  $aend= $_POST['aend'];
  $aeffort= $_POST['aeffort']*480;
  $tstage= $_POST['tstatus'];

  $s1= mysqli_query($conn,"UPDATE ttable SET tid='$tid', tdescription='$tdescription',ttype='$ttype' WHERE tguid= '$tguid'");
  $s2= mysqli_query($conn,"UPDATE tstep SET assignto='$assignto',tstepdescription='$tdescription',tstage='$tstage', pstart='$pstart',pend='$pend',peffort='$peffort',astart='$astart',aend='$aend',aeffort='$aeffort',tstage='$tstage' WHERE tguid= '$tguid' && tsequenceid='$tsequenceid'");

  $task['assignto']= $assignto;
  $task['tguid']= $tguid;
  $task['tid']= $tid;
  $task['tsequenceid']= $tsequenceid;
  $task['tdescription']= $tdescription;
  $task['ttype']= $ttype;
  $task['pstart']= $pstart;
  $task['pend']= $pend;
  $task['peffort']= $peffort;
  $task['astart']= $astart;
  $task['aend']= $aend;
  $task['aeffort']= $aeffort;
  $task['tstage']= $tstage;

if($s1 && $s2){
  $task['statuscode']= "s";
  $task['description']= "Task successfully loaded";}
 echo json_encode($task);
 mysqli_close($conn);

}
else if($_POST['type']=="19")
{ $tguid= $_POST['tguid'];

  $all_ttypes=array();
  $sql_ttype1=mysqli_query($conn,"select * from task_types");
    while($row_ttype=mysqli_fetch_assoc($sql_ttype1)){
      $ttype_id=$row_ttype["ttype"];
      $ttype_desc=$row_ttype["ttype_desc"];
      $all_ttypes[$ttype_id]=$ttype_desc;

    }
  $task = array (
          "tguid"=> $tguid,
          "tid"=>"",
          "tsteps"=>"",
          "createdon"=>"",
          "assignto"=>"",
          "assignto_id"=>"",
          "tsequenceid"=> "",
          "tstepdescription"=>"",
          "ttype"=>"",
          "pstart"=>"",
          "pend"=>"",
          "peffort"=>"",
          "astart"=>"",
          "aend"=>"",
          "aeffort"=>"",
          "tstage"=>"",
          "tstatus"=>"",
          "statuscode"=>"e",
          "comments"=>"",
          "description"=>"Error while loading task details"

      );
    $comment =array(
        "tguid"=> $tguid,
        "tsequenceid"=>"",
        "updatedon"=>"",
        "updatedat"=>"",
        "updatedby"=>"",
        "updatedby_id"=>"",
        "comment"=>""

    );
    $allcomments =array();

    $taskstep= array(
      "tguid"=> $tguid,
      "tid"=>"",
      "assignto"=>"",
      "tsequenceid"=> "",
      "tstepdescription"=>"",
      "pstart"=>"",
      "pend"=>"",
      "peffort"=>"",
      "astart"=>"",
      "aend"=>"",
      "aeffort"=>"",
      "tstage"=>"",
      "tstatus"=>"",
      "statuscode"=>"e",
      "description"=>"Error while updating task step details"
    );

    $alltasksteps=array();

            $sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid && c.tguid='$tguid' && tsequenceid=0 ";
            $result=mysqli_query($conn, $sql1);
            while($row=mysqli_fetch_assoc($result)){

             $task['tid']= $row['tid'];
             $task['createdon']= $row['createdon'];
             $task['assignto_id']= $row['assignto'];

             $userid=$row['assignto'];
             $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
             $row2=mysqli_fetch_assoc($seq);
             $task['assignto']= $row2['uname'];

             $task['tsequenceid']= $row['tsequenceid'];
             $task['tstepdescription']= $row['tstepdescription'];
             $ttype_t=$row["ttype"];
             $task['ttype_desc']=$all_ttypes[$ttype_t];
             $task['pstart']= $row['pstart'];
             $task['pend']= $row['pend'];
             $task['peffort']= $row['peffort'];
             $task['astart']= $row['astart'];
             $task['aend']= $row['aend'];
             $task['aeffort']= $row['aeffort'];
             $task['tstage']= $row['tstage'];
             $tstage=$row['tstage'];

             if($tstage==1) $task['tstatus']="To be Planned";
             else if($tstage==2 || $tstage==3) $task['tstatus']= "In Progress";
             else if($tstage==4) $task['tstatus']= "Completed";
             else if($tstage==5) $task['tstatus']="On Hold";
             else $task['tstatus']="Awaiting";

             $task['statuscode']= "s";
             $task['description']= "Task successfully loaded";

           }

           $sql2 = mysqli_query($conn,"select * from tstatus where tguid='$tguid' order by updatedon,updatedat");
           while($row=mysqli_fetch_assoc($sql2)){
             $comment['tsequenceid']= $row['tsequenceid'];
             $comment['updatedon']= $row['updatedon'];;
             $comment['updatedat']= $row['updatedat'];;
             $comment['updatedby_id']= $row['updatedby'];;
             $comment['comment']= $row['comment'];;

             $userid=$row['updatedby'];
             $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
             $row2=mysqli_fetch_assoc($seq);
             $comment['updatedby']= $row2['uname'];

             $allcomments[]=$comment;

           }
            $task['comments']=$allcomments;

            $sql3="select * from tstep where tguid='$tguid' && tsequenceid!=0 ";
            $result=mysqli_query($conn, $sql3);
            while($row=mysqli_fetch_assoc($result)){


             $taskstep['assignto_id']= $row['assignto'];
             $taskstep['tsequenceid']= $row['tsequenceid'];
             $taskstep['tstepdescription']= $row['tstepdescription'];
             $taskstep['pstart']= $row['pstart'];
             $taskstep['pend']= $row['pend'];
             $taskstep['peffort']= $row['peffort'];
             $taskstep['astart']= $row['astart'];
             $taskstep['aend']= $row['aend'];
             $taskstep['aeffort']= $row['aeffort'];
             $taskstep['tstage']= $row['tstage'];
             $tstage=$row['tstage'];

             if($tstage==1) $taskstep['tstatus']="To be Planned";
             else if($tstage==2 || $tstage==3) $taskstep['tstatus']= "In Progress";
             else if($tstage==4) $taskstep['tstatus']= "Completed";
             else if($tstage==5) $taskstep['tstatus']="On Hold";
             else $taskstep['tstatus']="Awaiting";

             $userid=$row['assignto'];
             $seq=mysqli_query($conn, "select * from userdata1 where uguid='$userid'");
             $row2=mysqli_fetch_assoc($seq);
             $taskstep['assignto']= $row2['uname'];


             $taskstep['statuscode']= "s";
             $taskstep['description']= "Task Step successfully loaded";

             $alltasksteps[]=$taskstep;
           }
           $task['tsteps']=$alltasksteps;

           echo json_encode($task);
           mysqli_close($conn);





}
//Function for loading task for team member_name

else if($_POST['type']=="20"){

    $pendingtasks=array();
    $safeinprogressall=array();
    $alertinprogressall=array();
    $dangerinprogressall=array();
    $allprogresstasks=array();
    $allvacations=array();
    $allremarks=array();

    $alltasks=array();
    $uguid=$_POST['uguid'];
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
                    "remarktest"=>"",
                    "statuscode"=>"e",
                    "description"=>"Error while loading remarks"

                );

                $subremarktest = array (
                  "id"=>"",
                  "name"=>""
                );
                $allsubremarktes=array();




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
  $action2="Rejected";
  $r2= mysqli_query($conn,"select * from vtable where  vstart <='$date' && vend>= '$date' && action!='$action' && action!='$action2' && createdfor='$uguid'");
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

  for($i = 0; $i < 5; $i++) {
    $subremarktest['id']=$i;
    $subremarktest['name']="test";
    $allsubremarktest[]=$subremarktest;

  }
  $remark['remarktest']=$allsubremarktest;

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
// Function for creating vacation for team member through member_calendar
else if($_POST['type']=="21"){

    $arr2 = array (
    "vguid"=> "",
    "vid"=> "",
    "vstart"=>"",
    "vend"=>"",
    "vremark"=>"",
    "createdon"=> "",
    "createdat"=> "",
    "createdby"=> "",
    "createdfor"=> "",
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
  $createdfor=$_POST['createdfor'];
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
  $arr2['createdfor']="$createdfor";


  if($vid!="" && $vstart!="" && $vend!="" && $vremark!="" && $vid!=$viddefault ){

    $r2= mysqli_query($conn,"select * from vtable where ( (vstart <='$vstart' && vend>= '$vstart') || (vstart <='$vend' && vend>= '$vend') || (vstart>='$vstart' && vend<='$vend' )) && action!='cancel' && createdfor='$createdfor'");
    $n2= mysqli_num_rows($r2);
    //$n2=1;

  if($n2){
    $arr2['description']="Can not have more than one vacation plan on a particular date. Please check already existing vacation plans";

    echo json_encode($arr2);
    mysqli_close($conn);

  }
  else {
    $r1=mysqli_query($conn, "INSERT INTO vtable (vguid,vid,vstart,vend,vremark,createdon,createdat,createdby,createdfor,action)VALUES ('$vguid','$vid','$vstart','$vend','$vremark','$createdon','$createdat','$createdby','$createdfor','$action')");
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

//Function to fetch tasks for members weeekly
else if($_POST['type']=="22"){
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
  $date3= $_POST['date2'];
  $todotask = array (
          "date"=>$date,
          "tid"=>"",
          "createdon"=>"",
          "tguid"=> "",
          "tsequenceid"=> "",
          "tstage"=>"",
          "assignto"=>"",
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
              "assignto"=>"",
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
                "createdfor"=> "",

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
                  "remarktest"=>"",
                  "statuscode"=>"e",
                  "description"=>"Error while loading remarks"

              );

              $subremarktest = array (
                "id"=>"",
                "name"=>""
              );
              $allsubremarktes=array();




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

  $assignto=$row['assignto'];
  $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
  $res4= mysqli_fetch_assoc($res3);
  $username= $res4["uname"];
  $todotask['assignto']=$username;

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

 $assignto=$row['assignto'];
 $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
 $res4= mysqli_fetch_assoc($res3);
 $username= $res4["uname"];
 $safeinprogress['assignto']=$username;

 $allprogresstasks[]=$safeinprogress;

 if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
 else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
 else $dangerinprogressall[]=$safeinprogress;

}
$vguid="";
$action="cancel";
$action2="Rejected";
$r2= mysqli_query($conn,"select * from vtable where  ((vstart >='$date3' && vstart<= '$date')||(vend >='$date3' && vend<= '$date')) && action!='$action' && action!='$action2' && createdfor='$uguid'");
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
  if($row['action']==""){
    $vacation['action']="Requested";
  }
  $createdfor= $row['createdfor'];
  $res3= mysqli_query($conn,"select * from userdata1 where uguid='$createdfor'");
  $res4= mysqli_fetch_assoc($res3);
  $username= $res4["uname"];
  $vacation['createdfor']=$username;

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

for($i = 0; $i < 5; $i++) {
  $subremarktest['id']=$i;
  $subremarktest['name']="test";
  $allsubremarktest[]=$subremarktest;

}
$remark['remarktest']=$allsubremarktest;

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
//Function to fetch tasks and vacations for my team monthly calendar
else if($_POST['type']=="23"){
  $pendingtasks=array();
  $safeinprogressall=array();
  $alertinprogressall=array();
  $dangerinprogressall=array();
  $allprogresstasks=array();
  $allvacations=array();
  $allremarks=array();

  $alltasks=array();
  $date= $_POST['date'];
  $date3= $_POST['date2'];
  $todotask = array (
          "date"=>$date,
          "tid"=>"",
          "createdon"=>"",
          "tguid"=> "",
          "tsequenceid"=> "",
          "tstage"=>"",
          "assignto"=>"",
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
              "assignto"=>"",
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
                "createdfor"=> "",

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
                  "remarktest"=>"",
                  "statuscode"=>"e",
                  "description"=>"Error while loading remarks"

              );

              $subremarktest = array (
                "id"=>"",
                "name"=>""
              );
              $allsubremarktes=array();



// $allusers = unserialize($_SESSION['allusers']);
$allusers = unserialize($_SESSION['allusers']);
for($i = 0; $i < count($allusers); $i++)
{
$uguid=$allusers[$i]["uguid"];
$sequence= 0;
$stage=1;
$sql1="select c.*, p.* from tstep c,ttable p where c.tguid=p.tguid  && c.tsequenceid!='$sequence' && c.tstage='$stage' &&  p.createdon <='$date' && c.assignto='$uguid' order by p.tid";
$result=mysqli_query($conn, $sql1);

 while($row=mysqli_fetch_assoc($result)){
  $todotask['tguid']= $row['tguid'];
  $todotask['tid']= $row['tid'];
  $todotask['createdon']= $row['createdon'];
  $todotask['tsequenceid']= $row['tsequenceid'];
  $todotask['tstage']= $row['tstage'];
  $todotask['tstepdescription']= $row['tstepdescription'];
  $todotask['tstage']= $row['tstage'];

  $assignto=$row['assignto'];
  $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
  $res4= mysqli_fetch_assoc($res3);
  $username= $res4["uname"];
  $todotask['assignto']=$username;

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

 $assignto=$row['assignto'];
 $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
 $res4= mysqli_fetch_assoc($res3);
 $username= $res4["uname"];
 $safeinprogress['assignto']=$username;

 $allprogresstasks[]=$safeinprogress;

 if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
 else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
 else $dangerinprogressall[]=$safeinprogress;

}
$vguid="";
$action="cancel";
$action2="Rejected";
$r2= mysqli_query($conn,"select * from vtable where  ((vstart >='$date3' && vstart<= '$date')||(vend >='$date3' && vend<= '$date')) && action!='$action' && action!='$action2' && createdfor='$uguid'");
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
  if($row['action']==""){
    $vacation['action']="Requested";
  }
  $createdfor= $row['createdfor'];
  $res3= mysqli_query($conn,"select * from userdata1 where uguid='$createdfor'");
  $res4= mysqli_fetch_assoc($res3);
  $username= $res4["uname"];
  $vacation['createdfor']=$username;

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
//Function to fetch tasks and vacations member monthly calendar
else if($_POST['type']=="24"){

    $pendingtasks=array();
    $safeinprogressall=array();
    $alertinprogressall=array();
    $dangerinprogressall=array();
    $allprogresstasks=array();
    $allvacations=array();
    $allremarks=array();

    $alltasks=array();
    $uguid=$_POST['uguid'];
    $date= $_POST['date'];
    $date3= $_POST['date2'];
    $todotask = array (
            "date"=>$date,
            "tid"=>"",
            "createdon"=>"",
            "tguid"=> "",
            "tsequenceid"=> "",
            "tstage"=>"",
            "assignto"=>"",
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
                "assignto"=>"",
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
                  "createdfor"=> "",

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
                    "remarktest"=>"",
                    "statuscode"=>"e",
                    "description"=>"Error while loading remarks"

                );

                $subremarktest = array (
                  "id"=>"",
                  "name"=>""
                );
                $allsubremarktes=array();




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

    $assignto=$row['assignto'];
    $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
    $res4= mysqli_fetch_assoc($res3);
    $username= $res4["uname"];
    $todotask['assignto']=$username;

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

   $assignto=$row['assignto'];
   $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
   $res4= mysqli_fetch_assoc($res3);
   $username= $res4["uname"];
   $safeinprogress['assignto']=$username;

   $allprogresstasks[]=$safeinprogress;

   if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
   else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
   else $dangerinprogressall[]=$safeinprogress;

  }
  $vguid="";
  $action="cancel";
  $action2="Rejected";
  $r2= mysqli_query($conn,"select * from vtable where  ((vstart >='$date3' && vstart<= '$date')||(vend >='$date3' && vend<= '$date')) && action!='$action' && action!='$action2' && createdfor='$uguid'");
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
    if($row['action']==""){
      $vacation['action']="Requested";
    }
    $createdfor= $row['createdfor'];
    $res3= mysqli_query($conn,"select * from userdata1 where uguid='$createdfor'");
    $res4= mysqli_fetch_assoc($res3);
    $username= $res4["uname"];
    $vacation['createdfor']=$username;

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

  for($i = 0; $i < 5; $i++) {
    $subremarktest['id']=$i;
    $subremarktest['name']="test";
    $allsubremarktest[]=$subremarktest;

  }
  $remark['remarktest']=$allsubremarktest;

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
//Function to fetch tasks and vacations for weekly member calendar
else if($_POST['type']=="25"){

    $pendingtasks=array();
    $safeinprogressall=array();
    $alertinprogressall=array();
    $dangerinprogressall=array();
    $allprogresstasks=array();
    $allvacations=array();
    $allremarks=array();

    $alltasks=array();
    $uguid=$_POST['uguid'];
    $date= $_POST['date'];
    $date3= $_POST['date2'];
    $todotask = array (
            "date"=>$date,
            "tid"=>"",
            "createdon"=>"",
            "tguid"=> "",
            "tsequenceid"=> "",
            "tstage"=>"",
            "assignto"=>"",
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
                "assignto"=>"",
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
                  "createdfor"=> "",

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
                    "remarktest"=>"",
                    "statuscode"=>"e",
                    "description"=>"Error while loading remarks"

                );

                $subremarktest = array (
                  "id"=>"",
                  "name"=>""
                );
                $allsubremarktes=array();




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

    $assignto=$row['assignto'];
    $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
    $res4= mysqli_fetch_assoc($res3);
    $username= $res4["uname"];
    $todotask['assignto']=$username;

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

   $assignto=$row['assignto'];
   $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
   $res4= mysqli_fetch_assoc($res3);
   $username= $res4["uname"];
   $safeinprogress['assignto']=$username;

   $allprogresstasks[]=$safeinprogress;

   if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
   else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
   else $dangerinprogressall[]=$safeinprogress;

  }
  $vguid="";
  $action="cancel";
  $action2="Rejected";
  $r2= mysqli_query($conn,"select * from vtable where  ((vstart >='$date3' && vstart<= '$date')||(vend >='$date3' && vend<= '$date')) && action!='$action' && action!='$action2' && createdfor='$uguid'");
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
    if($row['action']==""){
      $vacation['action']="Requested";
    }
    $createdfor= $row['createdfor'];
    $res3= mysqli_query($conn,"select * from userdata1 where uguid='$createdfor'");
    $res4= mysqli_fetch_assoc($res3);
    $username= $res4["uname"];
    $vacation['createdfor']=$username;

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

  for($i = 0; $i < 5; $i++) {
    $subremarktest['id']=$i;
    $subremarktest['name']="test";
    $allsubremarktest[]=$subremarktest;

  }
  $remark['remarktest']=$allsubremarktest;

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
//Function to fetch tasks and vacation for my team weekly calendar
else if($_POST['type']=="26"){


      $pendingtasks=array();
      $safeinprogressall=array();
      $alertinprogressall=array();
      $dangerinprogressall=array();
      $allprogresstasks=array();
      $allvacations=array();
      $allremarks=array();

      $alltasks=array();

      $date= $_POST['date'];
      $date3= $_POST['date2'];
      $todotask = array (
              "date"=>$date,
              "tid"=>"",
              "createdon"=>"",
              "tguid"=> "",
              "tsequenceid"=> "",
              "tstage"=>"",
              "assignto"=>"",
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
                  "assignto"=>"",
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
                    "createdfor"=> "",

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
                      "remarktest"=>"",
                      "statuscode"=>"e",
                      "description"=>"Error while loading remarks"

                  );

                  $subremarktest = array (
                    "id"=>"",
                    "name"=>""
                  );
                  $allsubremarktes=array();



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

      $assignto=$row['assignto'];
      $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
      $res4= mysqli_fetch_assoc($res3);
      $username= $res4["uname"];
      $todotask['assignto']=$username;

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

     $assignto=$row['assignto'];
     $res3= mysqli_query($conn,"select * from userdata1 where uguid='$assignto'");
     $res4= mysqli_fetch_assoc($res3);
     $username= $res4["uname"];
     $safeinprogress['assignto']=$username;

     $allprogresstasks[]=$safeinprogress;

     if($pdiff2>=2) $safeinprogressall[]=$safeinprogress;
     else if($pdiff2<2 && $pdiff2>=0) $alertinprogressall[]=$safeinprogress;
     else $dangerinprogressall[]=$safeinprogress;

    }
    $vguid="";
    $action="cancel";
    $action2="Rejected";
    $r2= mysqli_query($conn,"select * from vtable where  ((vstart >='$date3' && vstart<= '$date')||(vend >='$date3' && vend<= '$date')) && action!='$action' && action!='$action2' && createdfor='$uguid'");
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
      if($row['action']==""){
        $vacation['action']="Requested";
      }
      $createdfor= $row['createdfor'];
      $res3= mysqli_query($conn,"select * from userdata1 where uguid='$createdfor'");
      $res4= mysqli_fetch_assoc($res3);
      $username= $res4["uname"];
      $vacation['createdfor']=$username;

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

    // for($i = 0; $i < 5; $i++) {
    //   $subremarktest['id']=$i;
    //   $subremarktest['name']="test";
    //   $allsubremarktest[]=$subremarktest;
    //
    // }
    // $remark['remarktest']=$allsubremarktest;

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

//Function to upload mass task upload
else if($_POST['type']=="27" ){
  $tasktypes =array(

  );
  $sql1= mysqli_query($conn,"select * from task_types");
  while($row=mysqli_fetch_array($sql1)){
    $seq_id=$row["ttype"];
    $seq_des=$row["ttype_desc"];

    $tasktypes[$seq_des]=$seq_id;
  }

  $uguid=$_SESSION['uguid'];
  $all_tasks= array();

  $task = array (

          "tguid"=> "",
          "tid"=> "",
          "tdescription"=> "",
          "ttype"=> "",
          "createdon"=>"",
          "createdat"=>"",
          "createdby"=> $uguid,
          "priority"=>"",
          "priority_num"=>"",
          "tstage"=>"",
          "tstage_num"=>"",
          "assignto"=> "",
          "assignto_id"=>"",
           "pstart"=> "",
          "pend"=> "",
          "peffort"=> "",
          "astart"=>"",
          "aend"=> "",
          "aeffort"=> "",
          "remark"=>"",
          "remark_id"=>"",
          "statuscode"=>"e",
          "description"=>"Error while uploading tasks"

      );

          $priority_arr =array(

        "1-Very High"=>"1",
        "2-High"=>"2",
        "3-Medium"=>"3",
        "4-Low"=>"4",
        "5-Very Low"=>"5",
          );

          $tstage_arr =array(

        "To be Planned"=>"1",
        "In Progress"=>"3",
        "Completed"=>"4",
        "On Hold"=>"5",
        "Awaiting"=>"6",
          );



      $alltasks = $_POST['alltasks'];

      for($i = 0; $i < count($alltasks); $i++) {
        date_default_timezone_set("Asia/Kolkata");
        $date1= date("Ymd");
        $time1= date("hsiv");
        $time2= date("his");
        $digits = 4;
        $ran= rand(pow(10, $digits-1), pow(10, $digits)-1);
        $tguid=$date1.$time1.$ran;
        // $tguid=$alltasks[$i]["tguid"];
        $tid=$alltasks[$i]["tid"];
        $tdescription=$alltasks[$i]["tdescription"];
        $ttype=$alltasks[$i]["ttype"];

        $createdon=$alltasks[$i]["createdon"];
        $createdat=$alltasks[$i]["createdat"];
        $createdby=$uguid;
        $priority=$alltasks[$i]["priority"];
        $tstage=$alltasks[$i]["tstage"];
        $assignto=$alltasks[$i]["assignto"];
        $pstart=$alltasks[$i]["pstart"];
        if($pstart=="") $pstart="0000-00-00";
        $pend=$alltasks[$i]["pend"];
        if($pend=="") $pend="0000-00-00";
        $peffort=$alltasks[$i]["peffort"];
        if($peffort=="") $peffort=0;
        else $peffort=(int)((int)$peffort)*480;
        $astart=$alltasks[$i]["astart"];
        if($astart=="") $astart="0000-00-00";
        $aend=$alltasks[$i]["aend"];
        if($aend=="") $aend="0000-00-00";
        $aeffort=$alltasks[$i]["aeffort"];
        if($aeffort=="") $aeffort=0;
        else $aeffort=(int)((int)$aeffort)*480;
        $remark_id=$alltasks[$i]["remark_id"];

        $remark="Test Remark";

        $priority_num=$priority_arr[$priority];
        $priority_num=(int)$priority_num;
        $task["priority_num"]=$priority_num;

        $tstage_num=$tstage_arr[$tstage];
        $tstage_num=(int)$tstage_num;
        $task["tstage_num"]=$tstage_num;

        if($tstage_num==3 && $astart=="0000-00-00") $tstage_num=2;

        $task['tguid']= $tguid;
        $task['tid']= $tid;
        $task['tdescription']= $tdescription;
        $task['ttype']= $ttype;
        $task['createdon']= $createdon;
        $task['createdat']= $createdat;
        $task['priority']= $priority;
        $task['tstage']= $tstage;
        $task['assignto']= $assignto;
        $task['pstart']= $pstart;
        $task['pend']= $pend;
        $task['peffort']= $peffort;
        $task['astart']= $astart;
        $task['aend']= $aend;
        $task['aeffort']= $aeffort;
        $task['remark']= $remark;
        $task['remark_id']= $remark_id;
        $task['statuscode']= "e";
        // $task['statuscode']= "s";
        // $task['description']= "Task Uploaded";



        if(($tid!="" && $tdescription!="" && $pstart!="0000-00-00" && $pend!="0000-00-00" && $peffort!=0) || ($tid!="" && $tdescription!="" && $pstart=="0000-00-00" && $pend=="0000-00-00" && $peffort==0)  )
        {
          $st= mysqli_query($conn,"select * from ttable where tid= '$tid' ");
          $nt= mysqli_num_rows($st);
        if($nt){
          $task['description']="Task ID Already Exist";

        }
        else{
          if (array_key_exists($ttype,$tasktypes)){
          $ttype_num= $tasktypes[$ttype];
          $t1="contact";
          $t2="employeeid";
          $t3="e_emailid";
          $t4="p_emailid";

          $s1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && value='$assignto'");
          $s2= mysqli_query($conn,"select * from userdata2 where type='$t2' && value='$assignto'");
          $s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$assignto'");
          $s4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && value='$assignto'");
          $n1= mysqli_num_rows($s1);
          $n2= mysqli_num_rows($s2);
          $n3= mysqli_num_rows($s3);
          $n4= mysqli_num_rows($s4);
          $row1 = mysqli_fetch_assoc($s1);
          $row2 = mysqli_fetch_assoc($s2);
          $row3 = mysqli_fetch_assoc($s3);
          $row4 = mysqli_fetch_assoc($s4);

          if($n1 || $n2 || $n3|| $n4){

            if($n1) $assignto_id= $row1["uguid"];
            else if($n2) $assignto_id= $row2["uguid"];
            else if($n3) $assignto_id= $row3["uguid"];
            else $assignto_id= $row4["uguid"];

            $task['assignto']=$assignto;
            $task['assignto_id']=$assignto_id;
            $sql1 = "INSERT INTO ttable (tguid,tid,tdescription,ttype,createdon,createdat,createdby,priority)VALUES ('$tguid','$tid','$tdescription','$ttype_num','$createdon','$createdat','$createdby','$priority_num')";
            $r1=mysqli_query($conn, $sql1);
            $tsequenceid=0;
            $sql2 = "INSERT INTO tstep (tguid,tsequenceid,tstepdescription,tstage,assignto,pstart,pend,peffort,astart,aend,aeffort)VALUES ('$tguid','$tsequenceid','$tdescription','$tstage_num','$assignto_id','$pstart','$pend','$peffort','$astart','$aend','$aeffort')";
            $r2=mysqli_query($conn, $sql2);

            if($r1 && $r2){
            $task['statuscode']="s";
            $task['description']="Task Created Successfully";

          }
          else{
            $task['statuscode']="e";
            $task['description']="Error while creating task";
          }
          }
          else{
            $task['statuscode']="e";
            $task['description']="Invalid User ID";
          }

        }
        else{
          $task['statuscode']="e";
          $task['description']="Invalid Task Type";
        }

        }
        }

      else{

        if($tid=="" || $tdescription==""){
          $task['statuscode']="e";
        $task['description']="Enter all required details (Task ID and Task Description)";

      }
      else{
        $task['statuscode']="e";
        $task['description']="Enter all Planning details (Planned Start , Planned End and Planned Effort)";
      }


      }

        $all_tasks[]=$task;

      }

      echo json_encode($all_tasks);
}
//Function to check mass task upload
else if($_POST['type']=="28" ){

  $tasktypes =array(

  );

  $sql1= mysqli_query($conn,"select * from task_types");
  while($row=mysqli_fetch_array($sql1)){
    $seq_id=$row["ttype"];
    $seq_des=$row["ttype_desc"];

    $tasktypes[$seq_des]=$seq_id;
  }
  // if (array_key_exists($ttype,$tasktypes))

  $uguid=$_SESSION['uguid'];
  $all_tasks= array();

  $task = array (


          "tid"=> "",
          "tdescription"=> "",
          "ttype"=> "",
          "createdon"=>"",
          "createdat"=>"",
          "createdby"=> $uguid,
          "priority"=>"",
          "priority_num"=>"",
          "tstage"=>"",
          "tstage_num"=>"",
          "assignto"=> "",
           "pstart"=> "",
          "pend"=> "",
          "peffort"=> "",
          "astart"=>"",
          "aend"=> "",
          "aeffort"=> "",
          "remark"=>"",
          "remark_id"=>"",
          "statuscode"=>"e",
          "description"=>"Error while checking tasks"

      );

        $priority_arr =array(

      "1-Very High"=>"1",
      "2-High"=>"2",
      "3-Medium"=>"3",
      "4-Low"=>"4",
      "5-Very Low"=>"5",
        );

        $tstage_arr =array(

      "To be Planned"=>"1",
      "In Progress"=>"3",
      "Completed"=>"4",
      "On Hold"=>"5",
      "Awaiting"=>"6",
        );



      $alltasks = $_POST['alltasks'];

      for($i = 0; $i < count($alltasks); $i++) {

        $tid=$alltasks[$i]["tid"];
        $tdescription=$alltasks[$i]["tdescription"];
        $ttype=$alltasks[$i]["ttype"];
        $createdon=$alltasks[$i]["createdon"];
        $createdat=$alltasks[$i]["createdat"];
        $createdby=$uguid;
        $priority=($alltasks[$i]["priority"]);
        $tstage=$alltasks[$i]["tstage"];
        $assignto=$alltasks[$i]["assignto"];
        $pstart=$alltasks[$i]["pstart"];
        if($pstart=="") $pstart="0000-00-00";
        $pend=$alltasks[$i]["pend"];
        if($pend=="") $pend="0000-00-00";
        $peffort=$alltasks[$i]["peffort"];
        if($peffort=="") $peffort=0;
        else $peffort=(int)((int)$peffort)*480;
        $astart=$alltasks[$i]["astart"];
        if($astart=="") $astart="0000-00-00";
        $aend=$alltasks[$i]["aend"];
        if($aend=="") $aend="0000-00-00";
        $aeffort=$alltasks[$i]["aeffort"];
        if($aeffort=="") $aeffort=0;
        else $aeffort=(int)((int)$aeffort)*480;
        $remark_id=$alltasks[$i]["remark_id"];

        $remark="Test Remark";

        $task['tid']= $tid;
        $task['tdescription']= $tdescription;
        $task['ttype']= $ttype;
        $task['createdon']= $createdon;
        $task['createdat']= $createdat;
        $task['priority']= $priority;
        $task['tstage']= $tstage;
        $task['assignto']= $assignto;
        $task['pstart']= $pstart;
        $task['pend']= $pend;
        $task['peffort']= $peffort;
        $task['astart']= $astart;
        $task['aend']= $aend;
        $task['aeffort']= $aeffort;
        $task['remark']= $remark;
        $task['remark_id']= $remark_id;
        $task['statuscode']= "e";
        // $task['description']= "Task Uploaded";

          $priority_num=$priority_arr[$priority];
          $priority_num=(int)$priority_num;
          $task["priority_num"]=$priority_num;

          $tstage_num=$tstage_arr[$tstage];
          $tstage_num=(int)$tstage_num;
          $task["tstage_num"]=$tstage_num;

        if($tstage_num==3 && $astart=="0000-00-00") $tstage_num=2;

        if(($tid!="" && $tdescription!="" && $pstart!="0000-00-00" && $pend!="0000-00-00" && $peffort!=0) || ($tid!="" && $tdescription!="" && $pstart=="0000-00-00" && $pend=="0000-00-00" && $peffort==0)  )
        {
          $st= mysqli_query($conn,"select * from ttable where tid= '$tid' ");
          $nt= mysqli_num_rows($st);
        if($nt){
          $task['statuscode']="e";
          $task['description']="Task ID Already Exist";

        }
        else{

          if (array_key_exists($ttype,$tasktypes)){
          $t1="contact";
          $t2="employeeid";
          $t3="e_emailid";
          $t4="p_emailid";

          $s1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && value='$assignto'");
          $s2= mysqli_query($conn,"select * from userdata2 where type='$t2' && value='$assignto'");
          $s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$assignto'");
          $s4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && value='$assignto'");
          $n1= mysqli_num_rows($s1);
          $n2= mysqli_num_rows($s2);
          $n3= mysqli_num_rows($s3);
          $n4= mysqli_num_rows($s4);
          $row1 = mysqli_fetch_assoc($s1);
          $row2 = mysqli_fetch_assoc($s2);
          $row3 = mysqli_fetch_assoc($s3);
          $row4 = mysqli_fetch_assoc($s4);

          if($n1 || $n2 || $n3|| $n4){

            if($n1) $assignto= $row1["uguid"];
            else if($n2) $assignto= $row2["uguid"];
            else if($n3) $assignto= $row3["uguid"];
            else $assignto= $row4["uguid"];

            $task['assignto']=$assignto;
            $task['statuscode']="s";
            $task['description']="Task can be created";
          }
          else{
            $task['statuscode']="e";
            $task['description']="Invalid User ID";
          }



          }
          else{
            $task['statuscode']="e";
            $task['description']="Invalid Task Type";
          }
        }
      }
      else{

        if($tid=="" || $tdescription==""){
        $task['statuscode']="e";
        $task['description']="Enter all required details (Task ID and Task Description)";

      }
      else{
        $task['statuscode']="e";
        $task['description']="Enter all Planning details (Planned Start , Planned End and Planned Effort)";
      }


      }

        $all_tasks[]=$task;

      }

      echo json_encode($all_tasks);
}
//Function to upload mass task steps upload
else if($_POST['type']=="29" ){
  $uguid=$_SESSION['uguid'];
  $all_tasks= array();

  $tasksteps =array(

  );
  $sql1= mysqli_query($conn,"select * from task_steps");
  while($row=mysqli_fetch_array($sql1)){
    $seq_id=$row["tsequenceid"];
    $seq_des=$row["tstepdescription"];

    $tasksteps[$seq_des]=$seq_id;
  }

  $tstage_arr =array(

"To be Planned"=>"1",
"In Progress"=>"3",
"Completed"=>"4",
"On Hold"=>"5",
"Awaiting"=>"6",
  );



  $task = array (


          "tid"=> "",
          "tguid"=>"",
          "tstepdescription"=> "",
          "tstepid"=>"",
          "createdby"=> $uguid,
          "tstage"=>"",
          "tstage_num"=>"",
          "assignto"=> "",
           "pstart"=> "",
          "pend"=> "",
          "peffort"=> "",
          "astart"=>"",
          "aend"=> "",
          "aeffort"=> "",
          "remark"=>"",
          "remark_id"=>"",
          "statuscode"=>"e",
          "description"=>"Error while checking tasks"

      );


      $alltasks = $_POST['alltasks'];

      for($i = 0; $i < count($alltasks); $i++) {

        $tid=$alltasks[$i]["tid"];
        $tstepdescription=$alltasks[$i]["tstepdescription"];
        $createdby=$uguid;
        $tstage=$alltasks[$i]["tstage"];
        $assignto=$alltasks[$i]["assignto"];
        $pstart=$alltasks[$i]["pstart"];
        if($pstart=="") $pstart="0000-00-00";
        $pend=$alltasks[$i]["pend"];
        if($pend=="") $pend="0000-00-00";
        $peffort=$alltasks[$i]["peffort"];
        if($peffort=="") $peffort=0;
        else $peffort=(int)((int)$peffort)*480;
        $astart=$alltasks[$i]["astart"];
        if($astart=="") $astart="0000-00-00";
        $aend=$alltasks[$i]["aend"];
        if($aend=="") $aend="0000-00-00";
        $aeffort=$alltasks[$i]["aeffort"];
        if($aeffort=="") $aeffort=0;
        else $aeffort=(int)((int)$aeffort)*480;
        $remark_id=$alltasks[$i]["remark_id"];

        $remark="Test Remark";

        $task['tid']= $tid;
        $task['tstepdescription']= $tstepdescription;
        $task['tstage']= $tstage;
        $task['assignto']= $assignto;
        $task['pstart']= $pstart;
        $task['pend']= $pend;
        $task['peffort']= $peffort;
        $task['astart']= $astart;
        $task['aend']= $aend;
        $task['aeffort']= $aeffort;
        $task['remark']= $remark;
        $task['remark_id']= $remark_id;

        $tstage_num=$tstage_arr[$tstage];
        $tstage_num=(int)$tstage_num;
        $task["tstage_num"]=$tstage_num;

        if($tstage_num==3 && $astart=="0000-00-00") $tstage_num=2;


        if(($tid!="" && $tstepdescription!="" && $pstart!="0000-00-00" && $pend!="0000-00-00" && $peffort!=0) || ($tid!="" && $tstepdescription!="" && $pstart=="0000-00-00" && $pend=="0000-00-00" && $peffort==0)  )
        {
          $st= mysqli_query($conn,"select * from ttable where tid= '$tid' ");
          $nt= mysqli_num_rows($st);
          $rowt = mysqli_fetch_assoc($st);
        // if($nt){
        //   $task['description']="Task ID Already Exist";
        //
        // }
        if($nt){
          $tguid= $rowt["tguid"];
          $task["tguid"]=$tguid;
          $t1="contact";
          $t2="employeeid";
          $t3="e_emailid";
          $t4="p_emailid";

          $s1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && value='$assignto'");
          $s2= mysqli_query($conn,"select * from userdata2 where type='$t2' && value='$assignto'");
          $s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$assignto'");
          $s4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && value='$assignto'");
          $n1= mysqli_num_rows($s1);
          $n2= mysqli_num_rows($s2);
          $n3= mysqli_num_rows($s3);
          $n4= mysqli_num_rows($s4);
          $row1 = mysqli_fetch_assoc($s1);
          $row2 = mysqli_fetch_assoc($s2);
          $row3 = mysqli_fetch_assoc($s3);
          $row4 = mysqli_fetch_assoc($s4);

          if($n1 || $n2 || $n3|| $n4){

            if($n1) $assignto= $row1["uguid"];
            else if($n2) $assignto= $row2["uguid"];
            else if($n3) $assignto= $row3["uguid"];
            else $assignto= $row4["uguid"];

            $task['assignto']=$assignto;

            if (array_key_exists($tstepdescription,$tasksteps)){
              $tstepid=$tasksteps[$tstepdescription];
              $tstepid=(int)$tstepid;
              $task["tstepid"]=$tstepid;

              $seq1= mysqli_query($conn,"select * from tstep where tguid= '$tguid' && tsequenceid='$tstepid'");
              $nq1= mysqli_num_rows($seq1);
              if($nq1){
                $task['statuscode']="e";
                $task['description']="Task Step already exist";
              }
              else
              {
              $sql2 = "INSERT INTO tstep (tguid,tsequenceid,tstepdescription,tstage,assignto,pstart,pend,peffort,astart,aend,aeffort)VALUES ('$tguid','$tstepid','$tstepdescription','$tstage_num','$assignto','$pstart','$pend','$peffort','$astart','$aend','$aeffort')";
              $r2=mysqli_query($conn, $sql2);

              if($r2){
              $task['statuscode']="s";
              $task['description']="Task Step successfully created";}
            }
            }
            else{
              $task['statuscode']="e";
              $task['description']="No such task step exist";
            }

          }
          else{
            $task['statuscode']="e";
            $task['description']="Invalid User ID";
          }




        }
        else{
          $task['statuscode']="e";
          $task['description']="Task ID doesn't Exist";
        }

      }
      else{

        if($tid=="" || $tdescription==""){
        $task['statuscode']="e";
        $task['description']="Enter all required details (Task ID and Task Step Description)";

      }
      else{
        $task['statuscode']="e";
        $task['description']="Enter all Planning details (Planned Start , Planned End and Planned Effort)";
      }


      }

        $all_tasks[]=$task;

      }

      echo json_encode($all_tasks);
}

//Function to check mass task steps upload
else if($_POST['type']=="30" ){
  $uguid=$_SESSION['uguid'];
  $all_tasks= array();

  $tasksteps =array(

  );

  $sql1= mysqli_query($conn,"select * from task_steps");
  while($row=mysqli_fetch_array($sql1)){
    $seq_id=$row["tsequenceid"];
    $seq_des=$row["tstepdescription"];

    $tasksteps[$seq_des]=$seq_id;
  }

  $task = array (
          "tid"=> "",
          "tguid"=>"",
          "tstepdescription"=> "",
          "tstepid"=>"",
          "createdby"=> $uguid,
          "tstage"=>"",
          "assignto"=> "",
           "pstart"=> "",
          "pend"=> "",
          "peffort"=> "",
          "astart"=>"",
          "aend"=> "",
          "aeffort"=> "",
          "remark"=>"",
          "remark_id"=>"",
          "statuscode"=>"e",
          "description"=>"Error while checking tasks"

      );
      $tstage_arr =array(

    "To be Planned"=>"1",
    "In Progress"=>"3",
    "Completed"=>"4",
    "On Hold"=>"5",
    "Awaiting"=>"6",
      );


      $alltasks = $_POST['alltasks'];

      for($i = 0; $i < count($alltasks); $i++) {

        $tid=$alltasks[$i]["tid"];
        $tstepdescription=$alltasks[$i]["tstepdescription"];
        $createdby=$uguid;
        $tstage=$alltasks[$i]["tstage"];
        $assignto=$alltasks[$i]["assignto"];
        $pstart=$alltasks[$i]["pstart"];
        if($pstart=="") $pstart="0000-00-00";
        $pend=$alltasks[$i]["pend"];
        if($pend=="") $pend="0000-00-00";
        $peffort=$alltasks[$i]["peffort"];
        if($peffort=="") $peffort=0;
        else $peffort=(int)((int)$peffort)*480;
        $astart=$alltasks[$i]["astart"];
        if($astart=="") $astart="0000-00-00";
        $aend=$alltasks[$i]["aend"];
        if($aend=="") $aend="0000-00-00";
        $aeffort=$alltasks[$i]["aeffort"];
        if($aeffort=="") $aeffort=0;
        else $aeffort=(int)((int)$aeffort)*480;
        $remark_id=$alltasks[$i]["remark_id"];

        $remark="Test Remark";

        $task['tid']= $tid;
        $task['tstepdescription']= $tstepdescription;
        $task['tstage']= $tstage;
        $task['assignto']= $assignto;
        $task['pstart']= $pstart;
        $task['pend']= $pend;
        $task['peffort']= $peffort;
        $task['astart']= $astart;
        $task['aend']= $aend;
        $task['aeffort']= $aeffort;
        $task['remark']= $remark;
        $task['remark_id']= $remark_id;
        // $task['statuscode']= "s";
        // $task['description']= "Task Uploaded";
        $tstage_num=$tstage_arr[$tstage];
        $tstage_num=(int)$tstage_num;
        $task["tstage_num"]=$tstage_num;

        if($tstage_num==3 && $astart=="0000-00-00") $tstage_num=2;


        if(($tid!="" && $tstepdescription!="" && $pstart!="0000-00-00" && $pend!="0000-00-00" && $peffort!=0) || ($tid!="" && $tstepdescription!="" && $pstart=="0000-00-00" && $pend=="0000-00-00" && $peffort==0)  )
        {
          $st= mysqli_query($conn,"select * from ttable where tid= '$tid' ");
          $nt= mysqli_num_rows($st);
          $rowt = mysqli_fetch_assoc($st);
        // if($nt){
        //   $task['description']="Task ID Already Exist";
        //
        // }
        if($nt){
          $tguid= $rowt["tguid"];
          $task["tguid"]=$tguid;
          $t1="contact";
          $t2="employeeid";
          $t3="e_emailid";
          $t4="p_emailid";

          $s1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && value='$assignto'");
          $s2= mysqli_query($conn,"select * from userdata2 where type='$t2' && value='$assignto'");
          $s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$assignto'");
          $s4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && value='$assignto'");
          $n1= mysqli_num_rows($s1);
          $n2= mysqli_num_rows($s2);
          $n3= mysqli_num_rows($s3);
          $n4= mysqli_num_rows($s4);
          $row1 = mysqli_fetch_assoc($s1);
          $row2 = mysqli_fetch_assoc($s2);
          $row3 = mysqli_fetch_assoc($s3);
          $row4 = mysqli_fetch_assoc($s4);

          if($n1 || $n2 || $n3|| $n4){

            if($n1) $assignto= $row1["uguid"];
            else if($n2) $assignto= $row2["uguid"];
            else if($n3) $assignto= $row3["uguid"];
            else $assignto= $row4["uguid"];

            $task['assignto']=$assignto;

            if (array_key_exists($tstepdescription,$tasksteps)){
              $tstepid=$tasksteps[$tstepdescription];
              $tstepid=(int)$tstepid;
              $task["tstepid"]=$tstepid;

              $seq1= mysqli_query($conn,"select * from tstep where tguid= '$tguid' && tsequenceid='$tstepid'");
              $nq1= mysqli_num_rows($seq1);
              if($nq1){
                $task['statuscode']="e";
                $task['description']="Task Step already exist";
              }
              else
              {
              $task['statuscode']="s";
              $task['description']="Task Step can be created";}
            }
            else{
              $task['statuscode']="e";
              $task['description']="No such task step exist";
            }

          }
          else{
            $task['statuscode']="e";
            $task['description']="Invalid User ID";
          }




        }
        else{
          $task['statuscode']="e";
          $task['description']="Task ID doesn't Exist";
        }

      }
      else{

        if($tid=="" || $tdescription==""){
        $task['statuscode']="e";
        $task['description']="Enter all required details (Task ID and Task Step Description)";

      }
      else{
        $task['statuscode']="e";
        $task['description']="Enter all Planning details (Planned Start , Planned End and Planned Effort)";
      }


      }

        $all_tasks[]=$task;

      }

      echo json_encode($all_tasks);
}
//Function to create task steps
else if($_POST['type']=="31" ){

  $taskstep = array (
          "tsequenceid"=> "",
          "tstepdescription"=> "",
          "statuscode"=>"e",
          "description"=>"Error while creating task step"

      );
      $tsequenceid= $_POST['tsequenceid'];
      $tstepdescription= $_POST['tstepdescription'];

      $taskstep['tsequenceid']="$tsequenceid";
      $taskstep['tstepdescription']="$tstepdescription";

      $r2= mysqli_query($conn,"select * from task_steps where tsequenceid='$tsequenceid'");
      $n2= mysqli_num_rows($r2);
      if($n2){
        $taskstep['description']="Task Step Sequence ID already exist";
      }
      else
{      $sql1=mysqli_query($conn, "INSERT INTO task_steps (tsequenceid,tstepdescription)VALUES ('$tsequenceid','$tstepdescription')");
      if($sql1){
        $taskstep['statuscode']="s";
        $taskstep['description']="Task Step Created Successfully";

      }
    }

      echo json_encode($taskstep);

}
//Function to fetch all task steps
else if($_POST['type']=="32" ){
  $all_tasksteps= array();

  $taskstep = array (
          "tsequenceid"=> "",
          "tstepdescription"=> "",
          "statuscode"=>"e",
          "description"=>"Error while creating task step"

      );
$r1= mysqli_query($conn,"select * from task_steps");

while($row=mysqli_fetch_assoc($r1)){
 $taskstep['tsequenceid']= $row['tsequenceid'];
 $taskstep['tstepdescription']= $row['tstepdescription'];
 $taskstep['statuscode']= "s";
 $taskstep['description']= "Task Step successfully loaded";
 $all_tasksteps[]=$taskstep;
}

echo json_encode($all_tasksteps);

}
//function to delte task steps
else if($_POST['type']=="33" ){
  $taskstepsdeleted = array ();
      $deletedsteps=array(
        "tsequenceid"=> "",
        "tstepdescription"=> "",
        "remark_id"=>"",
        "statuscode"=>"e",
        "description"=>"Error while deleting task step"
      );

  $alltasksteps = $_POST['alltasksteps'];
  for($i = 0; $i < count($alltasksteps); $i++) {
    $tsequenceid=$alltasksteps[$i]["tsequenceid"];
    $tstepdescription=$alltasksteps[$i]["tstepdescription"];
    $remark_id=$alltasksteps[$i]["remark_id"];

    $deletedsteps["tsequenceid"]=$tsequenceid;
    $deletedsteps["tstepdescription"]=$tsequenceid;
    $deletedsteps["remark_id"]=$remark_id;

    $sql2= mysqli_query($conn,"select * from tstep where tsequenceid='$tsequenceid'");
    $n2=mysqli_num_rows($sql2);
    if($n2){
      $deletedsteps['statuscode']= "e";
      $deletedsteps['description']= "Some task exist for this task step";
    }
      else {
        $sql3= mysqli_query($conn,"select * from ttype_map_tstep where tsequenceid='$tsequenceid'");
        $n3=mysqli_num_rows($sql3);

          if($n3){
            $deletedsteps['statuscode']= "e";
            $deletedsteps['description']= "Some mapping exit for this task steps";
          }

          else{
          $sql1 = "DELETE FROM task_steps WHERE tsequenceid='$tsequenceid' ";
          $res=mysqli_query($conn, $sql1);

          if($res){
            $deletedsteps['statuscode']= "s";
            $deletedsteps['description']= "Task Step Successfully deleted";

          }
          else{
            $deletedsteps['statuscode']= "e";
            $deletedsteps['description']= "Error while deleting task steps";
          }
        }
  }

    $taskstepsdeleted[]=$deletedsteps;

  }
  echo json_encode($taskstepsdeleted);
}
//Function to create task type
else if($_POST['type']=="34" ){
  $tasktype = array (
          "ttype"=> "",
          "ttytpe_desc"=> "",
          "statuscode"=>"e",
          "description"=>"Error while creating task type"

      );
      $ttype= $_POST['ttype'];
      $ttytpe_desc= $_POST['ttytpe_desc'];

      $tasktype['ttype']="$ttype";
      $tasktype['ttytpe_desc']="$ttytpe_desc";

      $r2= mysqli_query($conn,"select * from task_types where ttype='$ttype'");
      $n2= mysqli_num_rows($r2);
      if($n2){
        $tasktype['description']="Task Type ID already exist";
      }
      else
{
//     $sql1=mysqli_query($conn, "INSERT INTO task_steps (tsequenceid,tstepdescription)VALUES ('$tsequenceid','$tstepdescription')");
      $sql1=mysqli_query($conn, "INSERT INTO task_types (ttype,ttype_desc)VALUES ('$ttype','$ttytpe_desc')");
      if($sql1){
        $tasktype['statuscode']="s";
        $tasktype['description']="Task Type Created Successfully";

      }
      else{
        $tasktype['description']=mysqli_error($conn);
      }

    }

      echo json_encode($tasktype);

}
//Function to fetch all task types
else if($_POST['type']=="35" ){
  $all_tasksteps= array();

  $taskstep = array (
          "ttype"=> "",
          "ttype_desc"=> "",
          "statuscode"=>"e",
          "description"=>"Error while creating task step"

      );
$r1= mysqli_query($conn,"select * from task_types");

while($row=mysqli_fetch_assoc($r1)){
 $taskstep['ttype']= $row['ttype'];
 $taskstep['ttype_desc']= $row['ttype_desc'];
 $taskstep['statuscode']= "s";
 $taskstep['description']= "Task Step successfully loaded";
 $all_tasksteps[]=$taskstep;
}

echo json_encode($all_tasksteps);

}
//function to delte task types
else if($_POST['type']=="36" ){
  $taskstepsdeleted = array ();
      $deletedsteps=array(
        "ttype"=> "",
        "ttype_desc"=> "",
        "remark_id"=>"",
        "statuscode"=>"e",
        "description"=>"Error while deleting task step"
      );

  $alltasksteps = $_POST['alltasksteps'];
  for($i = 0; $i < count($alltasksteps); $i++) {
    $tsequenceid=$alltasksteps[$i]["ttype"];
    $tstepdescription=$alltasksteps[$i]["ttype_desc"];
    $remark_id=$alltasksteps[$i]["remark_id"];

    $deletedsteps["ttype"]=$tsequenceid;
    $deletedsteps["ttype_desc"]=$tsequenceid;
    $deletedsteps["remark_id"]=$remark_id;

    $sql2= mysqli_query($conn,"select * from ttable where ttype='$tsequenceid'");
    $n2=mysqli_num_rows($sql2);
    if($n2){
      $deletedsteps['statuscode']= "e";
      $deletedsteps['description']= "Some task exist for this task type";
    }
      else {
        $sql3= mysqli_query($conn,"select * from ttype_map_tstep where ttype='$tsequenceid'");
        $n3=mysqli_num_rows($sql3);

        if($n3)
        {
        $deletedsteps['statuscode']= "e";
        $deletedsteps['description']= "Some Mapping exist for this task type";
          }

          else
          {
          $sql1 = "DELETE FROM task_types WHERE ttype=$tsequenceid ";
          $res=mysqli_query($conn, $sql1);

          if($res){
            $deletedsteps['statuscode']= "s";
            $deletedsteps['description']= "Task Type Successfully deleted";

          }
          else{
            $deletedsteps['statuscode']= "e";
            $deletedsteps['description']= "Error while deleting task Type";
          }
        }
  }

    $taskstepsdeleted[]=$deletedsteps;

  }
  echo json_encode($taskstepsdeleted);
}
//function to fetch mapped task types.....not mapped but all
else if($_POST['type']=="37" ){
  $all_ttypes= array();

  $task_ttype = array (
          "ttype"=> "",
          "ttype_desc"=> "",
          "statuscode"=>"e",
          "description"=>"Error while loading task type"

      );
  // $sql1="select DISTINCT (p.ttype), p.ttype_desc from task_types p, ttype_map_tstep q where p.ttype=q.ttype order by p.ttype";
  $sql1="select * from task_types order by ttype";
  $res=mysqli_query($conn, $sql1);
  if($res)
  {
  while($row=mysqli_fetch_assoc($res))
  {

   $task_ttype['ttype']= $row['ttype'];
   $task_ttype['ttype_desc']= $row['ttype_desc'];
   $task_ttype['statuscode']= "s";
   $task_ttype['description']= "Task Mapp loaded successfult";



     $all_ttypes[]=$task_ttype;


  }
  echo json_encode($all_ttypes);
  }
  else{
    $task_ttype['description']= mysqli_error($conn);
    echo json_encode($task_ttype);
  }

// mysqli_error($conn);
}
//Function to fetch all task steps, mapped task steps and remaining task steps
else if($_POST['type']=="38" ){

  $ttype=$_POST['ttype'];
  $tsteps = array (
          "all_tsteps"=> "",
          "mapped_tsteps"=> "",
          "remaining_tsteps"=>""
      );
      $all_tsteps= array();
      $mapped_tsteps= array();
      $remaining_tsteps= array();

      $taskstep = array (
              "tsequenceid"=> "",
              "tstepdescription"=> "",
              "peffort_per"=>"",
              "statuscode"=>"e",
              "description"=>"Error while loading task step"

          );
    $r1= mysqli_query($conn,"select * from task_steps");


    if($r1){
       while($row=mysqli_fetch_assoc($r1))
      {
     $taskstep['tsequenceid']= $row['tsequenceid'];
     $taskstep['tstepdescription']= $row['tstepdescription'];
     $taskstep['statuscode']= "s";
     $taskstep['description']= "Task Step successfully loaded";
     $all_tsteps[]=$taskstep;
    }
    }
    else{
      $taskstep['statuscode']= "e";
      $taskstep['description']= mysqli_error($conn);;
      $all_tsteps[]=$taskstep;
    }

    $sql1="select DISTINCT (p.tsequenceid), p.tstepdescription, q.peffort_per from task_steps p, ttype_map_tstep q where p.tsequenceid=q.tsequenceid && q.ttype='$ttype' order by p.tsequenceid";
    $res=mysqli_query($conn, $sql1);
    if($res)
    {
    while($row=mysqli_fetch_assoc($res))
    {
      $taskstep['tsequenceid']= $row['tsequenceid'];
      $taskstep['tstepdescription']= $row['tstepdescription'];
      $taskstep['peffort_per']= $row['peffort_per'];
      $taskstep['statuscode']= "s";
      $taskstep['description']= "Mapped Task Step loaded successfult";

     $mapped_tsteps[]=$taskstep;

    }
  }
  else{
    $taskstep['statuscode']= "s";
    $taskstep['description']= mysqli_error($conn);
    $mapped_tsteps[]=$taskstep;
  }

function udiffCompare($all_tsteps, $mapped_tsteps)
{
    return ($all_tsteps['tsequenceid'] - $mapped_tsteps['tsequenceid']);
}

$array_diff = array_udiff($all_tsteps, $mapped_tsteps, 'udiffCompare');
$remaining_tsteps= array_values ($array_diff);

    $tsteps["all_tsteps"]=$all_tsteps;
    $tsteps["mapped_tsteps"]=$mapped_tsteps;
    $tsteps["remaining_tsteps"]=$remaining_tsteps;

    echo json_encode($tsteps);
}
//Funstion to delete mapped task step
else if($_POST['type']=="39" ){
$ttype=$_POST['ttype'];
$tstep_delete=$_POST['alltasksteps'];

$deletedsteps=array(
  "tsequenceid"=> "",
  "tstepdescription"=> "",
  "statuscode"=>"e",
  "description"=>"Error while deleting task step"
);

$taskstepsdeleted=array();

for($i = 0; $i < count($tstep_delete); $i++) {

  $tsequenceid=$tstep_delete[$i]["tsequenceid"];
  $tstepdescription=$tstep_delete[$i]["tstepdescription"];


  $deletedsteps["tsequenceid"]=$tsequenceid;
  $deletedsteps["tstepdescription"]=$tsequenceid;

        $sql1 = "DELETE FROM ttype_map_tstep WHERE ttype='$ttype' && tsequenceid='$tsequenceid' ";
        $res=mysqli_query($conn, $sql1);
        if($res){
          $deletedsteps['statuscode']= "s";
          $deletedsteps['description']= "Task Step Successfully deleted";

        }
        else{
          $deletedsteps['statuscode']= "e";
          $deletedsteps['description']= "Error while deleting task steps";
        }
  $taskstepsdeleted[]=$deletedsteps;

}

echo json_encode($taskstepsdeleted);
}
//Funstion to add mapped task step
else if($_POST['type']=="40" ){
$ttype=$_POST['ttype'];
$tstep_add=$_POST['alltasksteps'];

$addedsteps=array(
  "tsequenceid"=> "",
  "tstepdescription"=> "",
  "statuscode"=>"e",
  "description"=>"Error while deleting task step"
);

$taskstepsadded=array();

for($i = 0; $i < count($tstep_add); $i++) {

  $tsequenceid=$tstep_add[$i]["tsequenceid"];
  $tstepdescription=$tstep_add[$i]["tstepdescription"];

  $addedsteps["tsequenceid"]=$tsequenceid;
  $addedsteps["tstepdescription"]=$tsequenceid;

        $sql1=mysqli_query($conn, "INSERT INTO ttype_map_tstep (ttype,tsequenceid)VALUES ('$ttype','$tsequenceid')");
        if($sql1){
          $addedsteps['statuscode']= "s";
          $addedsteps['description']= "Task Step Successfully deleted";

        }
        else{
          $addedsteps['statuscode']= "e";
          $addedsteps['description']= "Error while deleting task steps";
        }
  $taskstepsadded[]=$addedsteps;
}

echo json_encode($taskstepsadded);
}

//Funstion to edit peffort prcentage in ttype and tstep mapping
else if($_POST['type']=="41" ){
  $ttype=$_POST['ttype'];
  $tstep_add=$_POST['alltasksteps'];
  $allresult=array(
    "total_per"=>"",
    "all_tsteps"=>""
  );

  $all_tsteps= array();
  $taskstep = array (
          "tsequenceid"=> "",
          "tstepdescription"=> "",
          "peffort_per"=>"",
          "statuscode"=>"e",
          "description"=>"Error while loading task step"

      );
$total_per=0;
for($i = 0; $i < count($tstep_add); $i++) {
  $total_per= $total_per+floatval($tstep_add[$i]["peffort_per"]);

}


if($total_per<=100)
{
for($i = 0; $i < count($tstep_add); $i++) {
  $peffort_per= floatval($tstep_add[$i]["peffort_per"]);
  $tsequenceid= $tstep_add[$i]['tsequenceid'];
  $r1=mysqli_query($conn, "UPDATE ttype_map_tstep SET peffort_per='$peffort_per' where ttype='$ttype' && tsequenceid='$tsequenceid'");

  if($r1){
    $taskstep['tsequenceid']= $tstep_add[$i]['tsequenceid'];
    $taskstep['tstepdescription']= $tstep_add[$i]['tstepdescription'];
    $taskstep['peffort_per']= floatval($tstep_add[$i]['peffort_per']);
    $taskstep['statuscode']= "s";
    $taskstep['description']= "Peffort Percentage updated successfuly";
  }
  else{
    $taskstep['statuscode']= "e";
    $taskstep['description']= mysqli_error($conn);
  }
  $all_tsteps[]=$taskstep;
}
}

$allresult['total_per']= $total_per;
$allresult['all_tsteps']=$all_tsteps;

echo json_encode($allresult);
}
//Function to delete task step from admin task search page
else if($_POST['type']=="42" ){
      $taskstepsdeleted = array ();
      $deletedsteps=array(
        "tsequenceid"=> "",
        "tguid"=> "",
        "astart"=>"",
        "remark_id"=>"",
        "statuscode"=>"e",
        "description"=>"Error while deleting task step"
      );

  $alltasksteps = $_POST['alltasksteps'];
  for($i = 0; $i < count($alltasksteps); $i++) {
    $tsequenceid=$alltasksteps[$i]["tsequenceid"];
    $tguid=$alltasksteps[$i]["tguid"];
    $astart=$alltasksteps[$i]["astart"];
    $remark_id=$alltasksteps[$i]["remark_id"];

    $deletedsteps["tsequenceid"]=$tsequenceid;
    $deletedsteps["tguid"]=$tguid;
    $deletedsteps["astart"]=$astart;
    $deletedsteps["remark_id"]=$remark_id;
    if($astart==""){
      $sql1=mysqli_query($conn,"delete from tstep where tguid='$tguid' && tsequenceid='$tsequenceid' ");
      if($sql1){
        $deletedsteps["statuscode"]="s";
        $deletedsteps["description"]="Task Step deleted successfully";
      }
      else{
        $deletedsteps["statuscode"]="e";
        $deletedsteps["description"]=mysqli_error($conn);
      }
    }
    else{
      $deletedsteps["statuscode"]="e";
      $deletedsteps["description"]="Task in progress can not be deleted";
    }
    $taskstepsdeleted[]=$deletedsteps;
  }

  echo json_encode($taskstepsdeleted);

}

//Function to delete tasks from admin task search page
else if($_POST['type']=="43" ){

  $taskstepsdeleted = array ();
  $deletedsteps=array(
    "tguid"=> "",
    "astart"=>"",
    "remark_id"=>"",
    "statuscode"=>"e",
    "description"=>"Error while deleting task step"
  );

$alltasksteps = $_POST['alltasksteps'];
for($i = 0; $i < count($alltasksteps); $i++) {

$tguid=$alltasksteps[$i]["tguid"];
$astart=$alltasksteps[$i]["astart"];
$remark_id=$alltasksteps[$i]["remark_id"];

$deletedsteps["tguid"]=$tguid;
$deletedsteps["astart"]=$astart;
$deletedsteps["remark_id"]=$remark_id;
if($astart==""){
  $sql1=mysqli_query($conn,"delete from tstep where tguid='$tguid' ");
  $sql2=mysqli_query($conn,"delete from ttable where tguid='$tguid'");
  if($sql1 && $sql2){
    $deletedsteps["statuscode"]="s";
    $deletedsteps["description"]="Task deleted successfully";
  }
  else{
    $deletedsteps["statuscode"]="e";
    $deletedsteps["description"]=mysqli_error($conn);
  }
}
else{
  $deletedsteps["statuscode"]="e";
  $deletedsteps["description"]="Task in progress can not be deleted";
}
$taskstepsdeleted[]=$deletedsteps;
}

echo json_encode($taskstepsdeleted);

}
//Function to fetch form data for user profile

else if($_POST['type']=="44"){

  $uguid=$_POST['uguid'];
  $arr=array(
    "uguid"=>$uguid,
    "uname"=>"",
    "shortname"=>"",
    "contact"=>"",
    "employeeid"=>"",
    "e_emailid"=>"",
    "p_emailid"=>""
  );
  $sql1=mysqli_query($conn,"select * from userdata1 where uguid='$uguid'");
  $row1=mysqli_fetch_assoc($sql1);
  $arr["uname"]=$row1["uname"];
  $arr["shortname"]=$row1["shortname"];

  $sql2=mysqli_query($conn, "select * from userdata2 where uguid='$uguid'");
  while($row2=mysqli_fetch_assoc($sql2)){
    $arr[$row2["type"]]=$row2["value"];
  }
  echo json_encode($arr);
}
//FUnction to update user profile information
else if($_POST["type"]=="45"){
  $uguid=$_POST["uguid"];
  $uname=$_POST["uname"];
  $shortname=$_POST["shortname"];
  $contact=$_POST["contact"];
  $employeeid=$_POST["employeeid"];
  $e_emailid=$_POST["e_emailid"];
  $p_emailid=$_POST["p_emailid"];
  $password=$_POST["password"];

  $arr=array(
    "uguid"=>$uguid,
    "uname"=>$uname,
    "shortname"=>$shortname,
    "contact"=>$contact,
    "employeeid"=>$employeeid,
    "e_emailid"=>$e_emailid,
    "p_emailid"=>$p_emailid,
    // "password"=>$password,
    "statuscode"=>"e",
    "description"=>"error while updating user profile"
  );
  $p2= mysqli_query($conn,"select * from userdata1 where password= '$password' && uguid='$uguid'");
  $n1= mysqli_num_rows($p2);

  if($n1){

    $t1="contact";
    $t2="employeeid";
    $t3="e_emailid";
    $t4="p_emailid";
    $s1= mysqli_query($conn,"UPDATE userdata1 SET uname='$uname', shortname='$shortname' WHERE uguid= '$uguid'");
    $s2= mysqli_query($conn,"UPDATE userdata2 SET value='$contact' WHERE uguid= '$uguid' && type='$t1'");
    $s3= mysqli_query($conn,"UPDATE userdata2 SET value='$employeeid' WHERE uguid= '$uguid' && type='$t2'");
    $s4= mysqli_query($conn,"UPDATE userdata2 SET value='$e_emailid' WHERE uguid= '$uguid' && type='$t3'");
    $s5= mysqli_query($conn,"UPDATE userdata2 SET value='$p_emailid' WHERE uguid= '$uguid' && type='$t4'");

      if ($s1 && $s2 && $s3 && $s4 && $s5){
        $arr["statuscode"]="s";
        $arr["description"]="Updated Successfully";
      }
    }
    else{
      $arr["statuscode"]="e";
      $arr["description"]="Wrong Password";
    }
  echo json_encode($arr);
}
//Function to update user login password
else if($_POST["type"]=="46"){
  $uguid=$_POST["uguid"];
  $opassword=$_POST["opassword"];
  $npassword=$_POST["npassword"];
  $ncpassword=$_POST["ncpassword"];

  $arr=array(
    "opassword"=>$opassword,
    "npassword"=>$npassword,
    "ncpassword"=>$ncpassword,
    "statuscode"=>"e",
    "description"=>"Error while updating password"
  );

  $p2= mysqli_query($conn,"select * from userdata1 where password= '$opassword' && uguid='$uguid'");
  $n1= mysqli_num_rows($p2);
  if($n1){
    if($npassword==$ncpassword){
      $s1= mysqli_query($conn,"UPDATE userdata1 SET password='$npassword' WHERE uguid= '$uguid'");
      if($s1){
        $arr["statuscode"]="s";
        $arr["description"]="Password updated successfully";
      }
      else{
        $arr["statuscode"]="e";
        $arr["description"]=mysqli_error($conn);
      }

    }
    else{
      $arr["statuscode"]="e";
      $arr["description"]="Passwords are not matching";
    }
  }
  else{
    $arr["statuscode"]="e";
    $arr["description"]="Wrong Password";
  }

  echo json_encode($arr);
}
?>
