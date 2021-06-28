<?php
include 'database.php';
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

if( isset($_POST['tguidstep']) ){
$tguid= $_POST['tguidstep'];

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

 echo json_encode($arrs);
 mysqli_close($conn);

}
?>
