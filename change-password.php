
<?php
session_start();
error_reporting(0);
include('config.php');
// Code user Registration
// Code for User login
if(isset($_POST['submit']))
{
	$email1=$_POST['email'];
	$query=mysqli_query($con,"select * from user where email='$email1'");
	$result=mysqli_fetch_array($query);
	if($result['email']!=null)
	{

                $from ="unishopper@gmail.com";
                    $to=$email1;
                    $otp=$result['otpsend'];

                    $subject="verify-account-otp";
 
                    // Generating otp with php rand variable
                    $message=strval($otp);
                    $headers="From:" .$from;
                    if(mail($to,$subject,"YOUR OTP IS______ ".$message,$headers)){
                        	echo "<script>alert('You are successfully register otp send to registered mail check in inbox or spam');</script>";

                    }else
                        echo("mail send faild");
	}
}



if(isset($_POST['reset']))
{
	$email1=$_POST['email'];
	$password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM user WHERE email='$email1'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($con,"update user set password='$password' WHERE email='$email1'  ");
header('location:profile.php');
}
else
{
                            	echo "<script>alert('Wrong Email Please Renter proper');</script>";

}
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
                <link rel="stylesheet" href="css/user-auth.css">

    </head>
    <body>



<?php include('header.php') ?>

               <!--=====================================
                    USER FORM PART START
        =======================================-->
                                                
        <section class="user-form-part">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                        <div class="user-form-card">
                            <div class="user-form-title">
                                <h2>Start Shopping Now!</h2>
                            </div>
                            <div class="user-form-group">
                                
                                <form class="user-form" role="form"  method="post" name="login" onSubmit="return valid();">
                                    <div class="form-group">
                                        <input type="email" name="email" required class="form-control" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" required class="form-control" placeholder="Enter your New Password">
                                    </div>


                                    <div class="form-button">
                                        <button type="submit" name="reset">Reset Password</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="user-form-remind">
                            <p>New Customer?<a href="register.php">register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    USER FORM PART END
        =======================================-->


<?php include('footer.php'); ?>

    </body>
</html>