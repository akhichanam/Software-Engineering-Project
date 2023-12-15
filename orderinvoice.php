<?php
session_start();
error_reporting(0);
include('config.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
                <link rel="stylesheet" href="css/invoice.css">

    </head>
    <body>



<?php include('header.php') ?>









        <!--=====================================
                    BANNER PART START

        =======================================-->


         <?php 
$query=mysqli_query($con,"select * from breadcrumbanner where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

        <section class="inner-section single-banner" style="background: url(admin/breadcrumbanner/<?php echo htmlentities
        ($row['image']) ?>) no-repeat center;">
        <?php } ?>
            <div class="container">
                <h2>invoice</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Order Invoice</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->



        <!--=====================================
                    INVOICE PART START
        =======================================-->
        <section class="inner-section invoice-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert-info">
                            <p>Thank you! We have recieved your order.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>order recieved</h4>
                            </div>
                            <div class="account-content">
                                <div class="invoice-recieved">
                                    <?php
                                    $pid=$_GET['pid'];
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid' order by id desc ");
    
$orderdate='';
$coupon='';
$payment='';
$t='';
if ($row=mysqli_fetch_array($ret)) 
{
    $coupon=$row['couponused'];
?>            

                                    <h6>order number <span><?php echo $row['orderid'] ?></span></h6>
                                    <h6>order date <span><?php echo $row['orderdate'];$orderdate=$row['orderdate']; ?></span></h6>
                                    <h6>total amount <span>$<?php echo $t=$row['total'] ?></span></h6>
                                    <h6>payment method <span><?php echo $payment=$row['paymentmethod'] ?></span></h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>Order Details</h4>
                            </div>
                            <div class="account-content">
                                    <?php
                                    $pid=$_GET['pid'];
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid' order by id desc ");
    
$count=0;
while ($row=mysqli_fetch_array($ret)) 
{
    $count+=$row['quantity'];
} 
?>            
                                <ul class="invoice-details">
                                    <li>
                                        <h6>Total Item</h6>
                                        <p><?php echo $count; ?> Items</p>
                                    </li>
                                    <li>
                                        <h6>Order Time</h6>
                                        <p><?php echo $orderdate; ?></p>
                                    </li>
                                    
                                    <li>
                                        <h6>Delivery Location</h6>
                                        <p>                                    <?php
                                    
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='$pid' ");
    
if ($row=mysqli_fetch_array($ret)) 
{
    echo $row['useraddress']; echo " ";
    echo $row['picode'];
}
?>            
</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>Amount Details</h4>
                            </div>
                            <div class="account-content">
                                <ul class="invoice-details">
                                    <li>
                                        <h6>Sub Total</h6>
                                        <p>$<?php echo $t;?></p>
                                    </li>

                                    <li>
                                        <h6>discount</h6>
                                        <p>-<?php
                                    
$ret=mysqli_query($con,"select * from coupon where code='$coupon' ");
$per=0;
    if(mysqli_num_rows($ret)==1){
$row=mysqli_fetch_array($ret);
    echo $per=$row['percentage'];
    echo "%";
    }
        else{
            echo "NONE";
        }
    
?>            </p>
                                    </li>
                                    <li>
                                        <h6>Payment Method</h6>
                                        <p><?php echo $payment; ?></p>
                                    </li>
                                    <li>
                                        <h6>Delivery Charge</h6>
                                        <p><?php 
                                                                                $user=mysqli_query($con,"select * from user where id='".$_SESSION['id']."' ");

    	$userr1=mysqli_fetch_array($user);
    	$userr=$userr1['email'];

                                            $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."'");
             $results=mysqli_fetch_array($sql);
             $code=$results['picode'];

             $sql1=mysqli_query($con,"select *  from pincode where pincode='$code'");
             $results1=mysqli_fetch_array($sql1);
             $code1=$results1['price'];

echo $code1; ?></p>
                                    </li>
                                    <li>
                                        <h6>Total<small>(Incl. VAT)</small></h6>
                                        <p>$<?php 
                                        
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
    
    $tt=intval($t+$code1);
}
else{
 $tt=($t-(($per/100)*$t))+($code1);
 $tt=$tt;
}
 echo $tt;


 ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-scroll">
                            <table class="table-list">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">brand</th>
                                        <th scope="col">quantity</th>
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
                                        <td class="table-serial"><h6><?php echo $cnt; ?></h6></td>
                                        
                                        <?php $ret1=mysqli_query($con,"select * from productimage where productid='$ids' order by id desc ");
    
if ($row1=mysqli_fetch_array($ret1)) {
 ?>
                                        <td class="table-image"><img src="admin/productimages/<?php echo $ids; ?>/<?php echo $row1['image'] ?>" alt="product"></td>
                                        <?php } ?>

                                        <?php $ret2=mysqli_query($con,"select * from product where id='$ids' order by id desc ");
    
if ($row2=mysqli_fetch_array($ret2)) {
 ?>

                                        <td class="table-name"><h6><?php echo mb_strimwidth($row2['name'],0,20,'...') ?></h6></td>
                                        <td class="table-price"><h6>$<?php echo $row2['discountprice'] ?></small></h6></td>
                                        <td class="table-brand"><h6><?php echo $row2['brand'] ?></h6></td>
                                        
                                        <?php } ?>
                                        <td class="table-quantity"><h6><?php echo $row['quantity'] ?></h6></td>
                                    </tr>
                                    <?php $cnt++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center mt-5">
                        <a class="btn btn-inline" target="_blank" href="download.php?pid=<?php echo $pid; ?>">
                            <i class="icofont-download"></i>
                            <span>download invoice</span>
                        </a>
                        <div class="back-home">
                            <a href="index.php">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    INVOICE PART END
        =======================================-->





<?php include('footer.php') ?>


    </body>
</html>






