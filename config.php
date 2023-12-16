<?php
include('config.php');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$query=mysqli_query($con,"select * from paymentdetails");
if($row=mysqli_fetch_array($query))
{
$keyId = $row['key_id'];
$keySecret = $row['key_secret'];
$displayCurrency = 'USD';
}
error_reporting(E_ALL);
ini_set('display_errors', 1);


