<?php
session_start();
include 'database.php';
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

if(isset($_POST['create']))
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
  "updatedby_name"=>"",
  "sub_vremark"=>""
);
$action="cancel";
$allusers = unserialize($_SESSION['allusers']);

//$index=0;
$user_uguid= $_SESSION['uguid'];
for($i = 0; $i < count($allusers); $i++) {
  if($allusers[$i]["uguid"]==$user_uguid) unset($allusers[$i]);
}

for($i = 0; $i < count($allusers); $i++) {
$uguid=$allusers[$i]["uguid"];
$uname=$allusers[$i]["uname"];
$r2= mysqli_query($conn,"select * from vtable where action!='$action' && createdfor='$uguid'");

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

header('Content-type: application/json');
echo json_encode($allvacations, JSON_PRETTY_PRINT);
mysqli_close($conn);


}
?>
