
<?php
session_start();
error_reporting(0);
include('config.php');
// Code user Registration

if(isset($_POST['submit']))
{
    
$name=$_POST['name'];
$email=$_POST['email'];
$gstid=$_POST['gst'];
$address=$_POST['address'];
$pincode=$_POST['pincode'];
$phone=$_POST['phone'];

$password=md5($_POST['password']);
    $image='user.png';

$otp=rand(100000,999999);
    $query=mysqli_query($con,"select * from user where email='$email'");
    $result=mysqli_fetch_array($query);
    if($result['email']==null)
{
$query=mysqli_query($con,"insert into user(image,name,email,password,otpsend,otpconfirmed,gst) values('$image','$name','$email','$password','$otp','$otp','$gstid')");


$address1=mysqli_query($con,"select * from user where email='$email'");
$result2=mysqli_fetch_array($address1);
$iddd=$result2['id'];

mysqli_query($con,"insert into useaddress(type,address,picode,userid) values('home','$address','$pincode','$iddd')");
mysqli_query($con,"insert into usercontacts(type,number,userid) values('primary','$phone','$iddd')");



if($query)
{
    
                    $from ="unishoppers@gmail.com";
                    $to=$email;
                    $subject="verify-account-otp";
 
                    // Generating otp with php rand variable
                    $message=strval($otp);
                    $headers="From:" .$from;
                    if(mail($to,$subject,$message,$headers)){
                        $_SESSION["username"]=$email;
                        $_SESSION["OTP"]=$otp;
                        $_SESSION["Email"]=$email;
                        $_SESSION["Password"]=$password;
                            echo "<script>alert('You are successfully register otp send to registered mail check in inbox or spam');</script>";
                            header("location:otp.php");

                    }else{
                            echo "<script>alert('Failed');</script>";
                            header("location:otp.php");
                    }

    
}
else{
echo "<script>alert('Not register something went worng');</script>";
}
    
}
else{
echo "<script>alert('Email Id Already Exist');</script>";
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
                                <h2>Join Now!</h2>
                                <p>Setup A New Account In A Minute</p>
                            </div>
                            <div class="user-form-group">
                                                                
                                <form class="user-form" role="form"  method="post" action="register.php" name="register" onSubmit="return valid();" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="name" required class="form-control" placeholder="Enter your name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" required class="form-control" placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="address" required class="form-control" placeholder="Enter your complete address">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="pincode" required class="form-control" placeholder="Enter your pincode">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" name="phone" required class="form-control" placeholder="Enter your phone number">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="form-control" placeholder="Enter your password">
                                        <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="gst"  class="form-control" placeholder="Enter your GST">
                                    </div>


                                    

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required value="" id="check">
                                        <label class="form-check-label" for="check">Accept all the <a href="#">Terms & Conditions</a></label>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit" name="submit">register</button>
                                    </div>
                                </form>
                            </div>
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