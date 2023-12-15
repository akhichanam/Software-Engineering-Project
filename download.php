<?php 
session_start();
error_reporting(0);
include('config.php');
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>Unishoppers</title>

        <style>
            @media (max-width: 767px) {
                .table-scroll {
                    overflow-x: scroll;
                }

                .tables {
                    width: 900px;
                }

                .header-info {
                    justify-content: flex-start !important;
                    align-items: flex-start !important;
                    flex-direction: column;
                }
            }

            @media (max-width: 400px) {
                .header-info li p:nth-child(2) {
                    width: 135px !important;
                }
            }
        </style>
        <script>
            window.print();
        </script>
    </head>
    <body style="font-size:14px;font-weight:400;font-family:'Rubik', sans-serif;">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-lg-12">
 <?php 
$query=mysqli_query($con,"select * from logo where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>
                            <img class="mb-3" width="180" src="admin/logo/<?php echo $row['logo'];?>" alt="logo">


        <?php } ?>
                    <h6 class="mb-5 text-capitalize text-success">Thank you! We have recieved your order.</h6>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between header-info">
                        <div class="mb-4">
                            <h6 class="text-capitalize mb-3">order recieved</h6>
                            <ul class="p-0">
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 150px;">name</p>
                                    <p class="text-capitalize mb-0" style="width: 200px;"> 
                                    <?php 
$query=mysqli_query($con,"select * from user where id='".$_SESSION['id']."'");
if($row=mysqli_fetch_array($query))
{
  echo $row['name'];
 } ?>
</p>
</li>


<?php
                                    $pid=$_GET['pid'];
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid' order by id desc ");
$orderid='';    
$orderdate='';
$coupon='';
$payment='';
$t='';
$orderstatuss='';
if ($row=mysqli_fetch_array($ret)) 
{
    $coupon=$row['couponused'];
?>            

                                    <?php  
                                    $orderid=$row['orderid'];
                                    $t=$row['total'];
                                    $payment=$row['paymentmethod'];
                                    $orderdate=$row['orderdate'];
                                    $orderstatuss=$row['orderstatus'];
                                    
                                    
                                    
                                    ?>
                                    <?php } ?>

                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 150px;">total item</p>
                                    <p class="mb-0" style="width: 200px;">                                    <?php
                                    $pid=$_GET['pid'];
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid' order by id desc ");
    
$count=0;
while ($row=mysqli_fetch_array($ret)) 
{
    $count+=$row['quantity'];
} 
?>            
                                        <?php echo $count; ?> Items</p>
                                    
                                </li>
                                
                                
                                
                                
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 150px;">total amount</p>
                                    <p class="mb-0" style="width: 200px;">$<?php echo $t; ?></p>
                                </li>
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 150px;">payment type</p>
                                    <p class="mb-0" style="width: 200px;"><?php echo $payment; ?></p>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h6 class="text-capitalize mb-3">Shipment Details</h6>
                            <ul class="p-0">
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 160px;">order id</p>
                                    <p class="mb-0" style="width: 200px;">#<?php echo $orderid; ?></p>
                                </li>
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 160px;">order date</p>
                                    <p class="mb-0" style="width: 200px;"><?php echo $orderdate; ?></p>
                                </li>
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 160px;">order status</p>
                                    <p class="mb-0" style="width: 200px;"><?php echo $orderstatuss; ?></p>
                                </li>
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 160px;">contact number</p>
                                    <p class="mb-0" style="width: 200px;">
                                        
 <?php 
$query=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid'");
if($row=mysqli_fetch_array($query))
{
  echo $row['phone'];
 } ?>                                        
                                        </p>
                                </li>
                                <li class="d-flex align-items-start justify-content-start mb-1">
                                    <p class="text-capitalize mb-0" style="width: 160px;">delivery location</p>
                                    <p class="mb-0" style="width: 200px;">
                                         <?php 
$query=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid'");
if($row=mysqli_fetch_array($query))
{
  echo $row['useraddress']; echo " ";echo $row['picode'];
 } ?>
                                        </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <table class="table table-bordered text-center tables">
                            <thead>
                                <tr class=" text-white" bgcolor="#00a859">
                                    <th scope="col" class="fw-normal" style="padding: 12px 0px;">SL.</th>
                                    <th scope="col" class="fw-normal" style="padding: 12px 0px;">Product</th>
                                    <th scope="col" class="fw-normal" style="padding: 12px 0px;">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $pid=$_GET['pid'];
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid' order by id desc ");
    $cnt=1;
while ($row=mysqli_fetch_array($ret)) 
{
    $ids=$row['productid'];
?>            
                                <tr>
                                    <th scope="row"><?php echo $cnt; ?></th>
                                      <?php $ret2=mysqli_query($con,"select * from product where id='$ids' order by id desc ");
    
if ($row2=mysqli_fetch_array($ret2)) {
 ?>
                                    <td class="text-capitalize"><?php echo $row2['name'] ?></td>
                                    
                                    <td>$<?php echo $row2['discountprice'] ?></td>
                                    
                                    <?php } ?>
                                </tr>
                                
                                <?php $cnt++; } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end border-bottom mb-3">
                        <ul class="p-3 mb-0">
                            <li class="d-flex mb-1">
                                <h6 class="text-capitalize" style="font-weight: 500; width: 250px;">total price:</h6>
                                <p class="mb-0"><?php 
                                        
                                        $user=mysqli_query($con,"select * from user where id='".$_SESSION['id']."' ");

    	$userr1=mysqli_fetch_array($user);
    	$userr=$userr1['email'];

                                            $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."'");
             $results=mysqli_fetch_array($sql);
             $code=$results['picode'];

             $sql1=mysqli_query($con,"select *  from pincode where pincode='$code'");
             $results1=mysqli_fetch_array($sql1);
             $code1=$results1['price'];
$tt=0;
if($per==0 || $per==null){
    
    $tt=intval(($t+$code1));
}
else{
 $tt=($t-(($per/100)*$t))+($code1);
 $tt=$tt;
}
 echo $tt;


 ?></p></p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

