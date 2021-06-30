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
$r2= mysqli_query($conn,"select * from vtable where  vstart <='$date' && vend>= '$date' && action!='$action'");
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

  $r2= mysqli_query($conn,"select * from vtable where  (vstart <='$vstart' && vend>= '$vstart') || (vstart <='$vend' && vend>= '$vend')");
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

?>
