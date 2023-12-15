<?php
session_start();
error_reporting(0);
include('config.php');
include('conn.php');

if($_GET['cid']){
$cid1=intval($_GET['cid']);
}
else if($_GET['id']){
$cid1=intval($_GET['id']);
}
$query=mysqli_query($con,"select * from category where id='$cid1'");
$row=mysqli_fetch_array($query);

$brand=$row['name'];
$cid=$brand;
if(isset($_GET['pid']) && $_GET['action']=="remove" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
$pid= $_GET['pid'];

mysqli_query($con,"delete from compare where  productid='".$_GET['pid']."'");
echo "<script>alert('Product removed from compare');</script>";

}
}









?>
