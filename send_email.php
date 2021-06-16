
<!-- use PHPMailer\PHPMailer\PHPMailer;
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
} -->

<?php
include('database.php');
use PHPMailer\PHPMailer\PHPMailer;
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";
$error='';
$t1="e_emailid";
if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
    $email = $_POST["email"];
    // $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error .="Invalid email address";
    } else {
        $sel_query = "SELECT * FROM userdata2 WHERE value='$email' && type='$t1'";
        $results = mysqli_query($conn, $sel_query);
        $row = mysqli_num_rows($results);
        if ($row == "") {
            $error .= "User Not Found";
        }
    }
    if ($error != "") {
        echo $error;
    } else {

        $output = '';

        $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y"));
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $key = md5(time());
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;
        // Insert Temp Table
        $s9=mysqli_query($conn, "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");
        //"INSERT INTO password_reset_temp (emai,key,expDate)VALUES ('$email','$key','$expDate')"
        //$s9=mysqli_query($conn,"INSERT INTO password_reset_temp (email,key,expDate)VALUES ('$email','$key','$expDate')");

        $output.='<p>Please click on the following link to reset your password.</p>';
        //replace the site url
        $output.='<p><a href="http://localhost/assignment_manager/reset_password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">http://localhost/assignment_manager/reset_password.php?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
        $body = $output;
        $subject = "Password Recovery";

        $email_to = $email;


        //autoload the PHPMailer
        //require("vendor/autoload.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com"; // Enter your host here
        $mail->SMTPAuth = true;
        $mail->Username = "jaydeepsr100@gmail.com"; // Enter your email here
        $mail->Password = "Jsr@8769"; //Enter your passwrod here
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->From = "jaydeepsr100@gmail.com";
        $mail->FromName = "Jaydeep Singh";
        $mail->SMTPSecure = "ssl";

        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "<br><br> <h1>An Email is sent</h1><br><br>";
        }
    }
}
?>
