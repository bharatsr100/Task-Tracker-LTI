<?php
include 'database.php';
session_start();
if(!isset($_SESSION['uguid'])){
header('location:index.php');
}

 if($_POST['type']=="1"){
$arr2 = array (

        "tid"=> "",
        "tdescription"=> "",
        "ttype"=> "",
        "assignto"=> "",
         "pstart"=> "",
        "pend"=> "",
        "astart"=> "",
       "aend"=> "",
        "peffort"=> "",
        "comment"=>"",
        "statuscode"=>"e",
        "description"=>"Error while creating task"

    );
    // $rawdate = htmlentities($_POST['date']);
    // $date = date('Y-m-d', strtotime($rawdate));

    date_default_timezone_set("Asia/Kolkata");
    $date1= date("Ymd");
    $time1= date("hsiv");
    $time2= date("his");
    $digits = 4;
    $ran= rand(pow(10, $digits-1), pow(10, $digits)-1);
    $tguid=$date1.$time1.$ran;

    $uguid=$_SESSION['uguid'];
    $tid= $_POST['tid'];
    $tdescription= $_POST['tdescription'];
    $ttype= $_POST['ttype'];
    $assignto= $_POST['assignto'];
    $pstart= $_POST['pstart'];
    $pend= $_POST['pend'];
    $astart= $_POST['astart'];
    $aend= $_POST['aend'];
    $peffort= $_POST['peffort'];
    $aeffort="";
    // $astart= $_POST['astart'];
    // $aend= $_POST['aend'];
    // $aeffort= $_POST['aeffort'];
    $comment= $_POST['comment'];
    $createdon=$date1;
    $createdat=$time2;
    $createdby=$uguid;

    $updatedon=$date1;
    $updatedat=$time2;
    $updatedby=$uguid;

    $arr2['tid']="$tid";
    $arr2['tdescription']="$tdescription";
    $arr2['ttype']="$ttype";
    $arr2['assignto']="$assignto";
     $arr2['pstart']="$pstart";
    $arr2['pend']="$pend";
    $arr2['astart']="$astart";
    $arr2['aend']="$aend";
    $arr2['peffort']="$peffort";
    $arr2['comment']="$comment";


    if(($tid!="" && $tdescription!="" && $pstart!="" && $pend!="" && $peffort!="") || ($tid!="" && $tdescription!="" && $pstart=="" && $pend=="" && $peffort=="")  ){
      if($assignto=="" || $assignto==0 || $assignto== NULL ) $assignto=$uguid;
      $st= mysqli_query($conn,"select * from ttable where tid= '$tid' && createdby='$createdby'");
      $nt= mysqli_num_rows($st);

      if($nt){
        $arr2['statuscode']="e";
        $arr2['description']="Task ID Already Exist";
        echo json_encode($arr2);
        //echo "<script type='text/javascript'>alert('Task ID Already Exist.!'); window.location.href = 'mytask.php';</script>";

        mysqli_close($conn);
      }
      else{

        $sql1 = "INSERT INTO ttable (tguid,tid,tdescription,ttype,createdon,createdat,createdby)VALUES ('$tguid','$tid','$tdescription','$ttype','$createdon','$createdat','$createdby')";
        $r1=mysqli_query($conn, $sql1);
        $tsequenceid=0;
        $tstage=0;
        if($pstart==""){
          $tstage=1;
        }
        else {
          $tstage=2;
        }


        $sql2 = "INSERT INTO tstep (tguid,tsequenceid,tstepdescription,tstage,assignto,pstart,pend,peffort,astart,aend,aeffort)VALUES ('$tguid','$tsequenceid','$tdescription','$tstage','$assignto','$pstart','$pend','$peffort','$astart','$aend','$aeffort')";
        $r2=mysqli_query($conn, $sql2);
        $sql3 = "INSERT INTO tstatus (tguid,tsequenceid,updatedon,updatedat,updatedby,comment)VALUES ('$tguid','$tsequenceid','$updatedon','$updatedat','$updatedby','$comment')";
        $r3=mysqli_query($conn, $sql3);
         if($r1 && $r2 && $r3) {
           $arr2['statuscode']="s";
           $arr2['description']="Task Created Successfully";
           //echo "<script type='text/javascript'>alert('Task Created Successfully.!'); window.location.href = 'mytask.php';</script>";
           echo json_encode($arr2);
           mysqli_close($conn);
         }
         else{

           $arr2['description']="Some issue while creating task";
           echo json_encode($arr2);
           mysqli_close($conn);
         }
        //echo json_encode($arr2);


      }





    }

  else{

    if($tid=="" || $tdescription==""){
    $arr2['description']="Please enter all required details (Task ID and Task Description)";
  }
  else{
    $arr2['description']="Please enter all Planning details (Planned Start , Planned End and Planned Effort)";
  }
    echo json_encode($arr2);
    mysqli_close($conn);

  }
}
?>
