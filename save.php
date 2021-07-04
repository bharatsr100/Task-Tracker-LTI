<?php
	include 'database.php';
	session_start();
	if($_POST['type']==1){

		// $e_emailid= "e_emailid";
		// $sql="select c.*, p.* from userdata1 c,userdata2 p where c.uguid=p.uguid && p.type='$e_emailid' ";
		// $result = mysqli_query($conn, $sql);
		// $userdata=array();
		// $user = array (
		//           "uguid"=> "",
		//           "uname"=>"",
		//           "e_emailid"=>""
		//         );
		//
		//
		//  while($row=mysqli_fetch_assoc($result)){
		//   $user['uguid']= $row['uguid'];
		//   $user['uname']= $row['uname'];
		//   $user['e_emailid']= $row['value'];
		//
		//   $userdata[]=$user;
		//
		//
		// }
		// $json_data = json_encode($userdata);
		// file_put_contents('employeelist.json', $json_data);


		$user = array (
		          "uguid"=> "",
		          "uname"=>"",
		          "e_emailid"=>""
		        );

		$arr = array (
		        "uguid"=> "",
		        "uname"=> "",
		        "shortname"=> "",
		        "employeeid"=> "",
		        "contact"=> "",
		        "e_emailid"=> "",
		        "p_emailid"=> "",
		        "password"=> "",
		        "cpassword"=> "",
						"statuscode"=>"",
						"description"=>""

		    );
		date_default_timezone_set("Asia/Kolkata");
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
		$t1="contact";
		$t2="employeeid";
		$t3="e_emailid";
		$t4="p_emailid";

		$arr['uguid']="$uguid";
		$arr['uname']="$uname";
		$arr['shortname']="$shortname";
		$arr['employeeid']="$employeeid";
		$arr['contact']="$contact";
		$arr['e_emailid']="$e_emailid";
		$arr['p_emailid']="$p_emailid";
		$arr['password']="$password";
		$arr['cpassword']="$cpassword";

		$user['uguid']="$uguid";
		$user['uname']="$uname";
		$user['e_emailid']="$e_emailid";
		$current_data = file_get_contents('employeelist.json');
		$array_data = json_decode($current_data, true);


		$s1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && value='$contact'");
		$s2= mysqli_query($conn,"select * from userdata2 where type='$t2' && value='$employeeid'");
		$s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$e_emailid'");
		$s4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && value='$p_emailid'");
		$n1= mysqli_num_rows($s1);
		$n2= mysqli_num_rows($s2);
		$n3= mysqli_num_rows($s3);
		$n4= mysqli_num_rows($s4);

		if($password != $cpassword){
		  $arr['statuscode']="pm";
		  $arr['description']="Passwords are not matching";

		  echo json_encode($arr);

		}
		else if($n1){
		  $arr['statuscode']="c";
		  $arr['description']="Contact Number already exist";

		  echo json_encode($arr);

		}
		else if($n2){
		  $arr['statuscode']="e";
		  $arr['description']="Employee ID already exist";

		  echo json_encode($arr);

		}
		else if($n3){
		  $arr['statuscode']="ee";
		  $arr['description']="Employee Email ID already exist";

		  echo json_encode($arr);
		  exit;
		}
		else if($n4){
		  $arr['statuscode']="pe";
		  $arr['description']="Project email id already exist";

		  echo json_encode($arr);

		}
		else{
		  $sql1 = "INSERT INTO userdata1 (uguid,uname,shortname,password,a_status)VALUES ('$uguid','$uname','$shortname','$password','$a_status')";
		  $sql2 = "INSERT INTO userdata2 (type,value,uguid)VALUES ('employeeid','$employeeid','$uguid'),('contact','$contact','$uguid'),('e_emailid','$e_emailid','$uguid'),('p_emailid','$p_emailid','$uguid')";

		  $r1=mysqli_query($conn, $sql1);
		  $r2=mysqli_query($conn, $sql2);

		  $arr['statuscode']="s";
		  $arr['description']="Account Created Successfully";

			$array_data[] = $user;
			$final_data = json_encode($array_data);
			file_put_contents('employeelist.json', $final_data);

		  echo json_encode($arr);

		}
		mysqli_close($conn);
	}
	if($_POST['type']==2){
		$userid=$_POST['userid'];
		$password_log=$_POST['password_log'];
		$uguid="";

		$t1="contact";
		$t2="employeeid";
		$t3="e_emailid";
		$t4="p_emailid";
		$s1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && value='$userid'");
		$s2= mysqli_query($conn,"select * from userdata2 where type='$t2' && value='$userid'");
		$s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$userid'");
		$s4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && value='$userid'");

		$n1= mysqli_num_rows($s1);
		$n2= mysqli_num_rows($s2);
		$n3= mysqli_num_rows($s3);
		$n4= mysqli_num_rows($s4);

		$arr = array (
						"uguid"=> "",
						"uname"=> "",
						"shortname"=> "",
						"employeeid"=> "",
						"contact"=> "",
						"e_emailid"=> "",
						"p_emailid"=> "",
						"password"=> "",
						"role"=>"",
						"rr5"=>"",
						"allusers"=>"",
						"statuscode"=>"e",
						"description"=>"User ID or Password is incorrect"

				);

		$users = array (
						"uguid"=> "",
						"uname"=> ""
					);
		$allusers= array ();


				if($n1){
					$row1 = mysqli_fetch_assoc($s1);
					$uguid= $row1["uguid"];
					$s5= mysqli_query($conn,"select * from userdata1 where uguid='$uguid'");
					$row = mysqli_fetch_assoc($s5);

					$password_conf= $row["password"];

					if($password_log==$password_conf){

						$arr['statuscode']="s";
						$arr['description']="Login Successfull";
						$arr['uname']=$row["uname"];
						$arr['shortname']=$row["shortname"];
						$arr['password']=$row["password"];
						$arr['uguid']=$row["uguid"];


						$tr1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && uguid='$uguid'");
						$rr1 = mysqli_fetch_assoc($tr1);
						$arr['contact']=$rr1["value"];

						$tr2= mysqli_query($conn,"select * from userdata2 where type= '$t2' && uguid='$uguid'");
						$rr2 = mysqli_fetch_assoc($tr2);
						$arr['employeeid']=$rr2["value"];

						$tr3= mysqli_query($conn,"select * from userdata2 where type= '$t3' && uguid='$uguid'");
						$rr3 = mysqli_fetch_assoc($tr3);
						$arr['e_emailid']=$rr3["value"];

						$tr4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && uguid='$uguid'");
						$rr4 = mysqli_fetch_assoc($tr4);
						$arr['p_emailid']=$rr4["value"];

						$tr5= mysqli_query($conn,"select * from user_role where uguid='$uguid'");
						$rr5 = mysqli_fetch_assoc($tr5);
						if($rr5){
							$arr['role']=$rr5["role"];
						}

						$arr['rr5']=$rr5;

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
						$tr6= mysqli_query($conn,"select * from user_map where owner='$uguid'");
						traversetree($conn,$tr6,$users,$allusers);


						$users['uguid']= $arr['uguid'];
						$users['uname']= $arr['uname'];
						$allusers[]=$users;

						$arr['allusers']=$allusers;

						$_SESSION['allusers']=serialize($allusers);
						$_SESSION['arr']=serialize($arr);
						$_SESSION['uguid']=$row['uguid'];
						$_SESSION['uname']=$row["uname"];
						echo json_encode($arr);

					}

				}

				if($n2 && $arr['statuscode']!="s"){

				$row1 = mysqli_fetch_assoc($s2);
				$uguid= $row1["uguid"];
				$s5= mysqli_query($conn,"select * from userdata1 where uguid='$uguid'");
				$row = mysqli_fetch_assoc($s5);

				$password_conf= $row["password"];

				if($password_log==$password_conf){

					$arr['statuscode']="s";
					$arr['description']="Login Successfull";
					$arr['uname']=$row["uname"];
					$arr['shortname']=$row["shortname"];
					$arr['password']=$row["password"];
					$arr['uguid']=$row["uguid"];

					$tr1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && uguid='$uguid'");
					$rr1 = mysqli_fetch_assoc($tr1);
					$arr['contact']=$rr1["value"];

					$tr2= mysqli_query($conn,"select * from userdata2 where type= '$t2' && uguid='$uguid'");
					$rr2 = mysqli_fetch_assoc($tr2);
					$arr['employeeid']=$rr2["value"];

					$tr3= mysqli_query($conn,"select * from userdata2 where type= '$t3' && uguid='$uguid'");
					$rr3 = mysqli_fetch_assoc($tr3);
					$arr['e_emailid']=$rr3["value"];

					$tr4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && uguid='$uguid'");
					$rr4 = mysqli_fetch_assoc($tr4);
					$arr['p_emailid']=$rr4["value"];

					$tr5= mysqli_query($conn,"select * from user_role where uguid='$uguid'");
					$rr5 = mysqli_fetch_assoc($tr5);
					if($rr5){
						$arr['role']=$rr5["role"];
					}
					//$arr['tr5']=$tr5;
					$arr['rr5']=$rr5;

// function traversetree($conn,$owner,$users,&$allusers){
//
// 	$ownerlist = array ();
// 	array_push($ownerlist,$owner);
//  	while(!empty($ownerlist)){
//
// 		 $owner1=$ownerlist[0];
// 		 $sql1= mysqli_query($conn,"select * from user_map where owner='$owner1'");
//
// 		while($rr7=  mysqli_fetch_assoc($sql1))
//
// {		$users['uguid']=$rr7['reportee'];
// 		$users['uname']=$rr7['reportee_name'];
// 		array_push($ownerlist,$users['uguid']);
// 		$allusers[]=$users;}
//
//
// 		array_shift($ownerlist);
//
//
// 	}
//
// }
//traversetree($conn,$uguid,$users,$allusers);

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
$tr6= mysqli_query($conn,"select * from user_map where owner='$uguid'");
traversetree($conn,$tr6,$users,$allusers);

					$users['uguid']= $arr['uguid'];
					$users['uname']= $arr['uname'];
					$allusers[]=$users;

					$arr['allusers']=$allusers;

					$_SESSION['allusers']=serialize($allusers);
					$_SESSION['uguid']=$row['uguid'];
					$_SESSION['arr'] = serialize($arr);
					$_SESSION['uname']=$row["uname"];
					echo json_encode($arr);

				}


			}
			if($n3 && $arr['statuscode']!="s"){

				$row1 = mysqli_fetch_assoc($s3);
				$uguid= $row1["uguid"];
				$s5= mysqli_query($conn,"select * from userdata1 where uguid='$uguid'");
				$row = mysqli_fetch_assoc($s5);

				$password_conf= $row["password"];

				if($password_log==$password_conf){

					$arr['statuscode']="s";
					$arr['description']="Login Successfull";
					$arr['uname']=$row["uname"];
					$arr['shortname']=$row["shortname"];
					$arr['password']=$row["password"];
					$arr['uguid']=$row["uguid"];

					$tr1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && uguid='$uguid'");
					$rr1 = mysqli_fetch_assoc($tr1);
					$arr['contact']=$rr1["value"];

					$tr2= mysqli_query($conn,"select * from userdata2 where type= '$t2' && uguid='$uguid'");
					$rr2 = mysqli_fetch_assoc($tr2);
					$arr['employeeid']=$rr2["value"];

					$tr3= mysqli_query($conn,"select * from userdata2 where type= '$t3' && uguid='$uguid'");
					$rr3 = mysqli_fetch_assoc($tr3);
					$arr['e_emailid']=$rr3["value"];

					$tr4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && uguid='$uguid'");
					$rr4 = mysqli_fetch_assoc($tr4);
					$arr['p_emailid']=$rr4["value"];

					$tr5= mysqli_query($conn,"select * from user_role where uguid='$uguid'");
					$rr5 = mysqli_fetch_assoc($tr5);
					if($rr5){
						$arr['role']=$rr5["role"];
					}

					$arr['rr5']=$rr5;

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
					$tr6= mysqli_query($conn,"select * from user_map where owner='$uguid'");
					traversetree($conn,$tr6,$users,$allusers);

					$users['uguid']= $arr['uguid'];
					$users['uname']= $arr['uname'];
					$allusers[]=$users;

					$arr['allusers']=$allusers;

					$_SESSION['allusers']=serialize($allusers);
					$_SESSION['uguid']=$row['uguid'];
					$_SESSION['arr'] = serialize($arr);
					$_SESSION['uname']=$row["uname"];
					echo json_encode($arr);

				}
			}
			if($n4 && $arr['statuscode']!="s"){
				$row1 = mysqli_fetch_assoc($s4);
				$uguid= $row1["uguid"];
				$s5= mysqli_query($conn,"select * from userdata1 where uguid='$uguid'");
				$row = mysqli_fetch_assoc($s5);

				$password_conf= $row["password"];

				if($password_log==$password_conf){

					$arr['statuscode']="s";
					$arr['description']="Login Successfull";
					$arr['uname']=$row["uname"];
					$arr['shortname']=$row["shortname"];
					$arr['password']=$row["password"];
					$arr['uguid']=$row["uguid"];

					$tr1= mysqli_query($conn,"select * from userdata2 where type= '$t1' && uguid='$uguid'");
					$rr1 = mysqli_fetch_assoc($tr1);
					$arr['contact']=$rr1["value"];

					$tr2= mysqli_query($conn,"select * from userdata2 where type= '$t2' && uguid='$uguid'");
					$rr2 = mysqli_fetch_assoc($tr2);
					$arr['employeeid']=$rr2["value"];

					$tr3= mysqli_query($conn,"select * from userdata2 where type= '$t3' && uguid='$uguid'");
					$rr3 = mysqli_fetch_assoc($tr3);
					$arr['e_emailid']=$rr3["value"];

					$tr4= mysqli_query($conn,"select * from userdata2 where type= '$t4' && uguid='$uguid'");
					$rr4 = mysqli_fetch_assoc($tr4);
					$arr['p_emailid']=$rr4["value"];

					$tr5= mysqli_query($conn,"select * from user_role where uguid='$uguid'");
					$rr5 = mysqli_fetch_assoc($tr5);
					if($rr5){
						$arr['role']=$rr5["role"];
					}


					$arr['rr5']=$rr5;

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
					$tr6= mysqli_query($conn,"select * from user_map where owner='$uguid'");
					traversetree($conn,$tr6,$users,$allusers);

					$users['uguid']= $arr['uguid'];
					$users['uname']= $arr['uname'];
					$allusers[]=$users;
					$arr['allusers']=$allusers;

					$_SESSION['allusers']=serialize($allusers);
					$_SESSION['uguid']=$row['uguid'];
					$_SESSION['arr'] = serialize($arr);
					$_SESSION['uname']=$row["uname"];
					echo json_encode($arr);

				}
			}
			if($arr['statuscode']!="s"){
				echo json_encode($arr);
			}
		// $_SESSION['uname']="Bharat Singh Rajpurohit";
		// echo json_encode($arr);
		mysqli_close($conn);
	}
?>
