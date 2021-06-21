
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                    include('database.php');
                    $error='';
                    if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
                        $key = $_GET["key"];
                        $email = $_GET["email"];
                        $curDate = date("Y-m-d H:i:s");
                        //$query= mysqli_query($conn,"select * from password_reset_temp where key= '$key' && email='$email'");
                        $query = mysqli_query($conn, "SELECT * FROM `password_reset_temp` WHERE `key`='" . $key . "' and `email`='" . $email . "';");
                        $row = mysqli_num_rows($query);
                        if ($row == "") {
                            $error .= '<h2>Invalid Link</h2>';
                        } else {
                            $row = mysqli_fetch_assoc($query);
                            $expDate = $row['expDate'];
                            if ($expDate >= $curDate) {
                                ?>
                                <h2>Reset Password</h2>
                                <form method="post" action="" name="update">

                                    <input type="hidden" name="action" value="update" class="form-control"/>


                                    <div class="form-group">
                                        <label><strong>Enter New Password:</strong></label>
                                        <input type="password"  name="pass1"  class="form-control"/>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Re-Enter New Password:</strong></label>
                                        <input type="password"  name="pass2"  class="form-control"/>
                                    </div>
                                    <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                                    <div class="form-group">
                                        <input type="submit" id="reset" value="Reset Password"  class="btn btn-primary"/>
                                    </div>

                                </form>
                                <?php
                            } else {
                                $error .= "<h2>Link Expired</h2>>";
                            }
                        }
                        if ($error != "") {
                            echo "<div class='error'>" . $error . "</div><br />";
                        }
                    }


                    if (isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"] == "update")) {
                        $error = "";
                         $pass1 = mysqli_real_escape_string($conn, $_POST["pass1"]);
                         $pass2 = mysqli_real_escape_string($conn, $_POST["pass2"]);
                        $email = $_POST["email"];
                        $curDate = date("Y-m-d H:i:s");
                        if ($pass1 != $pass2) {
                            $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
                        }
                        if ($error != "") {
                            echo $error;
                        } else {
                          $t1="e_emailid";


                        //  $results =  ($conn,"SELECT * FROM `userdata2` WHERE `value`='" . $email . "' and `type`='" . $t1 . "'");
                          $sql1 = "SELECT * FROM userdata2 WHERE value='$email' && type='$t1'";
                        //$results = mysqli_query($conn, $sql1);
                          $results=$conn->query($sql1);
                          $row3 = mysqli_fetch_assoc($results);
                          // //echo "results query=".$results."<br>";
                          // echo "row query=".$row3."<br>";
                          // echo "value=".$row3["value"]."<br>";
                          // echo "type=".$row3['type']."<br>";
                          // echo $row3['uguid'];
                          $uguid= $row3['uguid'];
                        //  echo $uguid;
                        //$sql1=  mysqli_query($conn,"UPDATE userdata1 SET password='$pass1' WHERE uguid= '$uguid'");
                        $sql1= mysqli_query($conn, "UPDATE `userdata1` SET `password` = '" . $pass1 . "' WHERE `uguid` = '" . $uguid . "'");
                        //mysqli_query($conn, "UPDATE `users` SET `password` = '" . $pass1 . "', `trn_date` = '" . $curDate . "' WHERE `email` = '" . $email . "'");

                        // echo "sql query result=".$sql1."<br>";
                            if($sql1){
                              //echo "uguid=".$uguid."<br>";
                            //  echo "uname=".$uname."<br>";
                              echo "<h1><center>Congratulations! Your password has been updated successfully</center></h1>";
                              mysqli_query($conn, "DELETE FROM `password_reset_temp` WHERE `email` = '$email'");
                            }
                            else echo "Some error occured while updating passwprd";
                        }
                    }
                    ?>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>


    </body>
</html>
