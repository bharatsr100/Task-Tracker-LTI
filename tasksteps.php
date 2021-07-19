<?php
include 'database.php';
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

if( isset($_POST['tguidstep']) ){
$tguid= $_POST['tguidstep'];

$tsteps = array (
        "all_tsteps"=> "",
        "mapped_tsteps"=> "",
        "remaining_tsteps"=>""
    );

$all_tsteps= array();
$taskstep = array (
        "tsequenceid"=> "",
        "tstepdescription"=> "",
        'tguid'=>$tguid,
        "statuscode"=>"e",
        "description"=>"Error while loading task step"

    );

$arrstep = array (
          "tguid"=> "",
          "tsequenceid"=>"",
          "tstepdescription"=>"",
          "assignto"=>"",
          "assigntoname"=>"",
          "pstart"=>"",
          "pend"=>"",
          "peffort"=>"",
          "astart"=>"",
          "aend"=>"",
          "aeffort"=>"",
          "tstage"=>""
        );

$arrs=array();
$sequenceid=0;
$s1= mysqli_query($conn,"select * from tstep where tguid= '$tguid' && tsequenceid!='$sequenceid'");
while($row=mysqli_fetch_assoc($s1)){
  $uguid1= $row['assignto'];

  $s3=mysqli_query($conn,"select * from userdata1 where uguid='$uguid1'");
  $row1= mysqli_fetch_assoc($s3);

    //$arr['uname']=$row["uname"];
    $arrstep['tguid']= $tguid;
    $arrstep['tsequenceid']= $row['tsequenceid'];
    $arrstep['tstepdescription']= $row['tstepdescription'];
    $arrstep['assignto']= $row['assignto'];
    $arrstep['assigntoname']=$row1['uname'];
    $arrstep['pstart']= $row['pstart'];
    $arrstep['pend']= $row['pend'];
    $arrstep['peffort']= $row['peffort'];
    $arrstep['astart']= $row['astart'];
    $arrstep['aend']= $row['aend'];
    $arrstep['aeffort']= $row['aeffort'];
    $arrstep['tstage']= $row['tstage'];

    $arrs[]=$arrstep;
    //array_push($arrs,$arrstep);



}

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
$mapped_tsteps=$arrs;

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
 mysqli_close($conn);

}
?>
