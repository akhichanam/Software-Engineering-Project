<?php
session_start();

require('config.php');

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    
    
    
    	$cart=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."' ");
    	
    	$user=mysqli_query($con,"select * from useaddress where id='".$_SESSION['id']."' ");
    	$user1=mysqli_query($con,"select * from usercontacts where id='".$_SESSION['id']."' ");
    	$coupon=mysqli_query($con,"select * from checkout where userid='".$_SESSION['id']."' ");

    	$userr1=mysqli_fetch_array($user);
    	$userr=$userr1['address'];
    	$picode=$userr1['picode'];
    	$address=$userr+$picode;
    	$userr11=mysqli_fetch_array($user1);
    	$userr111=$userr11['number'];

    	$coupon1=mysqli_fetch_array($coupon);
    	$coup=$coupon1['coupon'];
    	$total=$coupon1['total'];
    	if($coup==null){
    	$coupons="NONE";
    	    
    	}else{
    	$coupons=$coupon1['coupon'];
    	    
    	}
    	
    	$paymentid=$_POST['razorpay_payment_id'];;

    	$orderid=$_SESSION['razorpay_order_id'];
    	while($row=mysqli_fetch_array($cart)){
    	    
    	    $productid=$row['productid'];
    	    $userid=$row['userid'];

    	    $quantity=$row['quantity'];
    	$status="razor";
    	
    	    $sql1=mysqli_query($con,"insert into orders(productid,userid,quantity,paymentmethod,orderstatus,orderid,paymentid,paymentproof,couponused,total,useraddress,picode,phone) 
    	    values('$productid','$userid','$quantity','$status','pending','$orderid','$paymentid','$productimage1','$coupons','$total','".$_SESSION['ad']."','".$_SESSION['pi']."','".$_SESSION['co']."')");

    	}
    	    	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"admin/payment/".$_FILES["fileToUpload"]["name"]);

    	mysqli_query($con,"delete from cart where userid = '".$_SESSION['id']."' ");
    	mysqli_query($con,"delete from checkout where userid = '".$_SESSION['id']."' ");

    
    
    


    	header('location:../orderinvoice.php?pid='.$orderid);

}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

