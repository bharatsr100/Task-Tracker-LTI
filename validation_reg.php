<?php
// session_start();
$server_name="localhost";
$username="root";
$password="";
$database_name="userdatabase";
$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
die("Connection Failed:" . mysqli_connect_error());
}

// date_default_timezone_set("Asia/Kolkata");
$date1= date("Ymd");
$time1= date("hsiv");
$digits = 4;
$ran= rand(pow(10, $digits-1), pow(10, $digits)-1);
$uguid=$date1.$time1.$ran;
$uname= $_POST['uname'];
$shortname= $_POST['shortname'];
$employeeid= $_POST['employeeid'];
$contact= $_POST['contact'];
$e_emailid= $_POST['e_emailid'];
$p_emailid= $_POST['p_emailid'];
$password= $_POST['password'];
$cpassword= $_POST['cpassword'];
$a_status="active";


$sql1 = "INSERT INTO userdata1 (uguid,uname,shortname,password,a_status)VALUES ('$uguid','$uname','$shortname','$password','$a_status')";
$sql2 = "INSERT INTO userdata2 (type,value,uguid)VALUES ('employeeid','$employeeid',$uguid),('contact','$contact',$uguid),('e_emailid','$e_emailid',$uguid),('p_emailid','$p_emailid',$uguid)";
// $sql2 .= "INSERT INTO userdata2 (type,value,uguid)VALUES ('contact','$contact',$uguid);";
// $sql2 .= "INSERT INTO userdata2 (type,value,uguid)VALUES ('e_emailid','$e_emailid',$uguid);";
// $sql2 .= "INSERT INTO userdata2 (type,value,uguid)VALUES ('p_emailid','$p_emailid',$uguid)";
$r1=mysqli_query($conn, $sql1);
$r2=mysqli_query($conn, $sql2);
if($r1 && $r2){
echo "New Details Entry inserted successfully in table1 and table2!";
}
else
{
echo "Error Occured while creating entry in table1 and table2!";
}
// if($r1){
// echo "<br>New Details Entry inserted successfully in table2!";
// }
// else
// {
// echo "Error Occured while creating entry in table2 !";
// }

mysqli_close($conn);

?>
