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

 $arr2['tguid']="$tguid";
 $arr2['tsequenceid']="$tsequenceid";
 $arr2['tstage']="$tstage";
 $arr2['tstepdescription']="$tstepdescription";


 $s2 = "INSERT INTO tstep (tguid,tsequenceid,tstage,assignto,tstepdescription)VALUES ('$tguid','$tsequenceid','$tstage','$assignto','$tstepdescription')";
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

?>
