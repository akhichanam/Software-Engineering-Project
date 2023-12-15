
<?php
session_start();
error_reporting(0);
include('config.php');
// Code user Registration
// Code for User login
if(isset($_POST['submit']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query1=mysqli_query($con,"SELECT * FROM user WHERE email='$email'");
$result1=mysqli_fetch_array($query1);
$otpverify=$result1['otpconfirmed'];
$otpsend=$result1['otpsend'];

$query=mysqli_query($con,"SELECT * FROM user WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0 && $otpverify==$otpsend)
{
$extra="index.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else if($otpverify!=$otpsend){
$extra="otp.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
echo "<script>alert('Wrong Email Or Password');</script>";
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
echo "<script>alert('Wrong Email Or Password');</script>";
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Password";
exit();
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
                                <p>Login with our secured System</p>
                            </div>
                            
                            <div class="user-form-group">                                   

                                <form class="user-form" role="form"  method="post" name="login" onSubmit="return valid();">
                                    <div class="form-group">
                                        <input type="email" name="email" required class="form-control" placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" required class="form-control" placeholder="Enter your password">
                                    </div>


                                    <div class="form-button">
                                        <button type="submit" name="submit">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="user-form-remind">
                            <p>Forgot Password?<a href="resetpassword.php">reset password</a></p>
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