<?php
include 'database.php';
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}
//isset($_POST['tguid'])

if( $_POST['type']==1){
$tguid= $_POST['tguid'];

$arrcomment = array (
          "tguid"=> "",
          "createdon"=>"",
          "createdat"=>"",
          "comment"=>""

        );
        $arrs=array();
        $sequenceid=11;
        $s1= mysqli_query($conn,"select * from tstatus where tguid= '$tguid' && tsequenceid='$sequenceid'");
        while($row=mysqli_fetch_assoc($s1)){
            $arrcomment['tguid']= $tguid;
            $arrcomment['createdon']= $row['updatedon'];
            $arrcomment['createdat']= $row['updatedat'];
            $arrcomment['comment']= $row['comment'];

            $arrs[]=$arrcomment;
        }
        echo json_encode($arrs);
        mysqli_close($conn);

}
else if( $_POST['type']==2) {

$tguid= $_POST['tguids'];
$tsequenceid= $_POST['tsequenceids'];

$arrcomment = array (
          "tguid"=> "",
          "createdon"=>"",
          "createdat"=>"",
          "comment"=>""

        );
        $arrs=array();
        $s1= mysqli_query($conn,"select * from tstatus where tguid= '$tguid' && tsequenceid='$tsequenceid'");

        while($row=mysqli_fetch_assoc($s1)){
            $arrcomment['tguid']= $tguid;
            $arrcomment['createdon']= $row['updatedon'];
            $arrcomment['createdat']= $row['updatedat'];
            $arrcomment['comment']= $row['comment'];

            $arrs[]=$arrcomment;
        }
        echo json_encode($arrs);
        mysqli_close($conn);
}
?>
