<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once "database.php";
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
// Get user enter email via $.ajax() method
if(isset($_POST['uemail']))
{
$email = $_POST["uemail"];
$t3="e_emailid";
// Select email from the user table
// $select_stmt=$db->prepare("SELECT * FROM user WHERE email=:user_email");
// $select_stmt->execute(array(":user_email"=>$email));
// $row=$select_stmt->fetch(PDO::FETCH_ASSOC);


$s3= mysqli_query($conn,"select * from userdata2 where type='$t3' && value='$email'");
$n3= mysqli_num_rows($s3);
$row = mysqli_fetch_assoc($s3);

if($n3)
{
// If email present in the table, then sends email to user mailbox / junk
if($email==$row["e_emailid"])
{
$dbusername = $row["e_emailid"];
$dbtoken = "token";
// They can click on this link to reset the password with the token.
$reset_link = "Hi,Click here to reset your password http://localhost/assign_manager/reset_password.php";
$subject = "Reset Password";
$body = $reset_link;
// Send email code
$mail = new PHPMailer();

//smtp settings
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "jaydeepsr100@gmail.com";
$mail->Password = 'Jsr@8769';
$mail->Port = 465;
$mail->SMTPSecure = "ssl";

//email settings
$mail->isHTML(true);
$mail->setFrom("jaydeepsr100@gmail.com");
$mail->addAddress($email);
$mail->Subject = ("$subject");
$mail->Body = $body;

if($mail->send())
{
$_SESSION["successMsg"] = "email send check your mail box";
header("location:fpindex.php");
}
else
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
}
else
{
$_SESSION["errorMsg"]="email not found";
header("location:fpindex.php");
}
}
else
{
$_SESSION["errorMsg"]="wrong email";
header("location:fpindex.php");
}
}
?>
