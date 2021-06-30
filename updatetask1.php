<?php
session_start();
include 'database.php';
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

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
else if($_POST['type']=="3"){

  $pendingtasks=array();
  $safeinprogressall=array();
  $alertinprogressall=array();
  $dangerinprogressall=array();
  $allprogresstasks=array();

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
      $alertinprogress = array (
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
        $dangerinprogress = array (
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
$alltasks[]=$safeinprogressall;
$alltasks[]=$alertinprogressall;
$alltasks[]=$dangerinprogressall;
$alltasks[]=$allprogresstasks;



echo json_encode($alltasks);
mysqli_close($conn);

}

?>
