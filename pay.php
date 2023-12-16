<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();



// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//


if(isset($_POST['myform'])){
    
    	$_SESSION['ad']=$_POST['address'];
    	$_SESSION['pi']=$_POST['pincode'];
    	$_SESSION['co']=$_POST['number'];
}

$cart=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."'");
$qnty1=0;
while($row1=mysqli_fetch_array($cart)){
    
    $qnty1+=$row1['quantity'];
    
}

    	$user=mysqli_query($con,"select * from user where id='".$_SESSION['id']."' ");
    	$coupon=mysqli_query($con,"select * from checkout where userid='".$_SESSION['id']."' ");

    	$userr1=mysqli_fetch_array($user);
    	$userr=$userr1['email'];
    	$coupon1=mysqli_fetch_array($coupon);
    	$coup=$coupon1['coupon'];
    	$pr=$coupon1['total'];
    	if($coup==null){
    	$coupons="NONE";
    	    
    	}else{
    	$coupons=$coupon1['coupon'];
    	    
    	}


                                            $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."'");
             $results=mysqli_fetch_array($sql);
             $code=$results['picode'];

             $sql1=mysqli_query($con,"select *  from pincode where pincode='$code'");
             $results1=mysqli_fetch_array($sql1);
             $code1=$results1['price'];

$ret3=mysqli_query($con,"select * from checkout where userid='".$_SESSION['id']."'");
$cnt4=mysqli_fetch_array($ret3);
if($cnt4['total']==0){echo '0';}

else{

    if($cnt4['percentage']==null){
echo $cnt4['total'];        
    }

    else{
 $tt=($cnt4['total']-((($cnt4['percentage'])/100)*$cnt4['total']))+($code1);
 
 $price= intval($tt+((18/100)*$tt));
        
    } } 
 

$qnty=$qnty1;
$emailid=$userr;
$price=$price*100;








$orderData = [
    'receipt'         => 3456,
    'amount'          => $price, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $price = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $price * 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}
$query=mysqli_query($con,"select * from logo");
$row=mysqli_fetch_array($query);
$image=$row['logo'];
$data = [
    "key"               => $keyId,
    "amount"            => $price,
    "name"              => $row['title'],
    "description"       => $row['title'],
    "image"             => "../admin/logo/".$image,
    "prefill"           => [
    "name"              => "Ecommerce",
    "email"             => $emailid,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "FPSrZ2RiG7znrC",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
