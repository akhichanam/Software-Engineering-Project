<?php
session_start();
include('config.php');


if(isset($_POST['myform3'])){
    
$productimage1=$_FILES["fileToUpload"]["name"];
    	$ad=$_POST['address'];
    	$pi=$_POST['pincode'];
    	$co=$_POST['number'];


$cart=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."' ");
    	
    	
    	$user=mysqli_query($con,"select * from useaddress where id='".$_SESSION['id']."' and address='".$_POST['address']."' ");
    	$user1=mysqli_query($con,"select * from usercontacts where id='".$_SESSION['id']."' and number='".$_POST['number']."' ");
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
    	
    	$paymentid=rand(100000,999999);

    	$orderid=rand(100000,999999);
    	while($row=mysqli_fetch_array($cart)){
    	    
    	    $productid=$row['productid'];
    	    $userid=$row['userid'];

    	    $quantity=$row['quantity'];
    	$status="Bank";
    	
    	    $sql1=mysqli_query($con,"insert into orders(productid,userid,quantity,paymentmethod,orderstatus,orderid,paymentid,paymentproof,couponused,total,useraddress,picode,phone) 
    	    values('$productid','$userid','$quantity','$status','pending','$orderid','$paymentid','$productimage1','$coupons','$total','$ad','$pi','$co')");

    	}
    	    	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"admin/payment/".$_FILES["fileToUpload"]["name"]);

    	mysqli_query($con,"delete from cart where userid = '".$_SESSION['id']."' ");
    	mysqli_query($con,"delete from checkout where userid = '".$_SESSION['id']."' ");
    	header('location:orderinvoice.php?pid='.$orderid);


    	

}

else{
    echo 'not received';
}


?>