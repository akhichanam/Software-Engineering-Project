
<?php
session_start();
error_reporting(0);
include('config.php');
// Code user Registration

if(isset($_POST['submit1']))
{
    

    $one=$_POST['otpconfirmed'];
    $email=$_POST['email'];
    $query=mysqli_query($con,"select * from user where email='$email'");
    $result=mysqli_fetch_array($query);
    if($result['email']!=null && $result['otpsend']==$one)
    {
    
$sql=mysqli_query($con,"update user set otpconfirmed='$one' where email='$email'");
header("location:login.php");
}
else{
echo "<script>alert('Wrong Email Or OTP');</script>";
}


}



if(isset($_POST['submit2']))
{

    $email1=$_POST['email'];
    $query=mysqli_query($con,"select * from user where email='$email1'");
    $result=mysqli_fetch_array($query);
    if($result['email']!=null)
    {

                $from ="unishoppers@gmail.com";
                    $to=$email1;
                    $otp=$result['otpsend'];

                    $subject="verify-account-otp";
 
                    // Generating otp with php rand variable
                    $message=strval($otp);
                    $headers="From:" .$from;
                    if(mail($to,$subject,"YOUR OTP IS______ ".$message,$headers)){
                        $_SESSION["username"]=$email;
                        $_SESSION["OTP"]=$otp;
                        $_SESSION["Email"]=$email1;
                        $_SESSION["Password"]=$password;
                            echo "<script>alert('You are successfully register otp send to registered mail check in inbox or spam');</script>";
                            header("location:otp.php");

                    }else
                        echo("mail send faild");
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
                                                <style>/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>

        <section class="user-form-part">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                        <div class="user-form-card">
                            <div class="user-form-title">
                                <h2>OTP!</h2>
                                <p>Check Your Mail for otp in Inbox/Spam</p>
                            </div>




                            












                            <div  class="user-form-group" >
                                <form  class="user-form" role="form"  method="post" name="register" onSubmit="return valid();">
                                    <div class="form-group">
                                        <input type="number" name="otpconfirmed" required class="form-control" placeholder="Enter your otp">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" required class="form-control" placeholder="Enter your email">
                                    </div>
                                    <div class="form-button">
                                        <button type="submit" name="submit1">OTP Verify</button>
                                    </div>
                                </form>
                            </div>
                            <br/><br/><br/><br/>
                            <div  class="user-form-group">
                                <form  class="user-form" role="form"  method="post" name="register" onSubmit="return valid();">
                                        <input type="email" name="email" required class="form-control" placeholder="Enter your email">
                                    </div>
                                    <div class="form-button">
                                        <button type="submit" name="submit2">OTP Resend</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        </div>

                        <div class="user-form-remind">
                            <p>New Customer?<a href="register.php">register here</a></p>
                        </div>
                        <div class="user-form-remind">
                            <p>Already Have An Account?<a href="login.php">login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    USER FORM PART END
        =======================================-->


<?php include('footer.php'); ?>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>


    </body>
</html>