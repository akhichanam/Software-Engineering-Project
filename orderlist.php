<?php
session_start();
error_reporting(0);
include('config.php');


if(isset($_GET['cancel'])){
$status=$_GET['status'];
$remark=$_GET['remark'];//space char
$o1id=intval($_GET['o1id']);

$query=mysqli_query($con,"insert into orderhistory(orderid,status,remark) values('$o1id','$status','$remark')");
$sql=mysqli_query($con,"update orders set orderStatus='$status' where id='$o1id'");
echo "<script>alert('Order updated sucessfully...');</script>";
header('location:orderlist.php');

}

    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/orderlist.css">

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
                <h2>History</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Order History</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->








        <!--=====================================
                    ORDERLIST PART START
        =======================================-->
        <section class="inner-section orderlist-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="orderlist-filter">
                            <h5>total order <span>- (<?php 
                            
                            $ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."'");
    echo mysqli_num_rows($ret);
?>)</span></h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        
                      <?php
                                    $pid=$_GET['pid'];
$ret=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' order by id desc ");
    $cnt=1;
while ($row=mysqli_fetch_array($ret)) 
{
    $ids=$row['id'];
?>            
    
                        <div class="orderlist">
                            <div class="orderlist-head">
                                <h5>order#<?php echo $cnt; ?></h5>
                        <a class="" target="_blank" href="orderinvoice.php?pid=<?php echo $row['orderid']; ?>">
                            <i class="icofont-download"></i>
                            <span>invoice</span>
                        </a>
                        <a class="" target="_blank" href="download.php?pid=<?php echo $row['orderid']; ?>">
                            <i class="icofont-download"></i>
                            <span>download invoice</span>
                        </a>
                        <?php if($row['orderstatus']=='pending'||$row['orderstatus']=='in Processing'||$row['orderstatus']=='shipped'){ ?>
<a class="" href="orderlist.php?o1id=<?php echo $row['id']; ?>&cancel=cancel&remark=customercancelled&status=cancel">Cancel Order</a>
<?php } ?>
                                <h5>order <?php if($row['orderstatus']=='pending'){echo 'Received';}
                                else if($row['orderstatus']=='in Processing'){echo 'Processed'; }
                                else if($row['orderstatus']=='shipped'){echo 'Shipped';}
                                else if($row['orderstatus']=='Delivered'){echo 'Delivered';}
                                else{echo 'Cancelled';}?></h5>
                            </div>
                            <div class="orderlist-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="order-track">
                                            <ul class="order-track-list">
                                                <?php if($row['orderstatus']=="pending"){ ?>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order recieved</span>
                                                </li>
                                                <li class="order-track-item">
                                                    <i class="icofont-close"></i>
                                                    <span>order processed</span>
                                                </li>
                                                <li class="order-track-item">
                                                    <i class="icofont-close"></i>
                                                    <span>order shipped</span>
                                                </li>
                                                <li class="order-track-item">
                                                    <i class="icofont-close"></i>
                                                    <span>order delivered</span>
                                                </li>
                                                <?php } ?>

                                                <?php if($row['orderstatus']=="in Processing"){ ?>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order recieved</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order processed</span>
                                                </li>
                                                <li class="order-track-item">
                                                    <i class="icofont-close"></i>
                                                    <span>order shipped</span>
                                                </li>
                                                <li class="order-track-item">
                                                    <i class="icofont-close"></i>
                                                    <span>order delivered</span>
                                                </li>
                                                <?php } ?>
                                                <?php if($row['orderstatus']=="shipping"){ ?>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order recieved</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order processed</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order shipped</span>
                                                </li>
                                                <li class="order-track-item">
                                                    <i class="icofont-close"></i>
                                                    <span>order delivered</span>
                                                </li>
                                                <?php } ?>
                                                <?php if($row['orderstatus']=="Delivered"){ ?>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order recieved</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order processed</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order shipped</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order delivered</span>
                                                </li>
                                                <li class="order-track-item ">
                                                    <i class="icofont-close"></i>
                                                    <span>order cancelled</span>
                                                </li>
                                                <?php } ?>
                                                <?php if($row['orderstatus']=="cancel"){ ?>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order recieved</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-close"></i>
                                                    <span>order processed</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-close"></i>
                                                    <span>order shipped</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-close"></i>
                                                    <span>order delivered</span>
                                                </li>
                                                <li class="order-track-item active">
                                                    <i class="icofont-check"></i>
                                                    <span>order cancelled</span>
                                                </li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <ul class="orderlist-details">
                                            <li>
                                                <h6>order id</h6>
<?php echo $row['orderid'] ?>
</li>
                                            <li>
                                                <h6>Total Item</h6>
                                                <p><?php echo $row['quantity'] ?> Items</p>
                                            </li>
                                            <li>
                                                <h6>Order Time</h6>
                                                <p><?php echo $row['orderdate'] ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <ul class="orderlist-details">
                                            <li>
                                                <h6>Order History<br/>Order Status<br/>Order Remark<br/>Modified Date</h6>
 <p><?php
$ret2=mysqli_query($con,"select * from orderhistory where orderid='$ids' ");
while ($row2=mysqli_fetch_array($ret2)) 
{
    
?>            
                                                <?php echo $row2['status'];?><br/><?php echo $row2['remark'];?><br/><?php echo $row2['postingDate'];?><br/>
                                                <?php } ?>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="orderlist-deliver">
                                            <h6>Delivery location</h6>
                                            <p><?php
                                    
$ret3=mysqli_query($con,"select * from orders where userid='".$_SESSION['id']."' and orderid='".$row['orderid']."' ");
    
if ($row3=mysqli_fetch_array($ret3)) 
{
    echo $row3['useraddress']; echo " ";
    echo $row3['picode'];
}
?>            
</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-scroll">
                                            <table class="table-list">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">brand</th>
                                                        <th scope="col">quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
<?php $ret1=mysqli_query($con,"select * from productimage where productid='$ids' order by id desc ");
    
if ($row1=mysqli_fetch_array($ret1)) {
 ?>
                                        <td class="table-image"><img src="admin/productimages/<?php echo $ids; ?>/<?php echo $row1['image'] ?>" alt="product"></td>
                                        <?php } ?>

                                        <?php $ret2=mysqli_query($con,"select * from product where id='$ids' order by id desc ");
    
 //   mysqli_num_rows
if ($row2=mysqli_fetch_array($ret2)) {
 ?>

                                        <td class="table-name"><h6><?php echo mb_strimwidth($row2['name'],0,20,'...') ?></h6></td>
                                        <td class="table-price"><h6>$<?php echo $row2['discountprice'] ?></small></h6></td>
                                        <td class="table-brand"><h6><?php echo $row2['brand'] ?></h6></td>
                                        
                                        <?php } ?>
                                        <td class="table-quantity"><h6><?php echo $row['quantity'] ?></h6></td>
                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php $cnt++;} ?>

                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    ORDERLIST PART END
        =======================================-->







<?php include('footer.php') ?>


    </body>
</html>


<?php } ?>



