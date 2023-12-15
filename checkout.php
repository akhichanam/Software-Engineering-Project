<?php
session_start();
error_reporting(0);
include('config.php');

$pid= $_GET['pid'];

if(isset($_POST['contactadd'])){
    
    $type=$_POST['type'];
    $number=$_POST['number'];
    $query=mysqli_query($con,"insert into usercontacts(type,number,userid) values('$type','$number','".$_SESSION['id']."')");
    echo "<script>alert('Contact Added');</script>" ;
}

if(isset($_POST['contactcontact'])){
    
    $type=$_POST['type'];
    $number=$_POST['address'];
    $pincode=$_POST['pincode'];
    $query=mysqli_query($con,"insert into useaddress(type,address,picode,userid) values('$type','$number','$pincode','".$_SESSION['id']."')");
    echo "<script>alert('Contact Address Added');</script>" ;
}


if(isset($_GET['pid']) && $_GET['action']=="remove" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
$pid= $_GET['pid'];

mysqli_query($con,"delete from checkout where  productid='".$_GET['pid']."'");
echo "<script>alert('Product removed from checkout');</script>";

}
}






?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
                <link rel="stylesheet" href="css/checkout.css">

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
                <h2>checkout list</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">checkout</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->



<?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>



        <!--=====================================
                    PRODUCT VIEW START
        =======================================-->
        <div class="modal fade" id="product-view<?php echo $row['pid']?>">
            <div class="modal-dialog"> 
                <div class="modal-content">
                    <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
                    <div class="product-view">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="view-gallery">
                                    <div class="view-label-group">                                                                                    <?php if($row['new']==1){echo '<label class="view-label new">new</label>';}else{}?>

                                        <label class="view-label off"><?php $discount=(($row['discountprice']/$row['actualprice'])*100)-100; echo intval($discount); echo "%"; ?></label>
                                    </div>
                                <ul class="preview-slider slider-arrow"> 

<?php 
$ids1=$row['pid'];
$query2=mysqli_query($con,"select * from productimage where productid='$ids1'");

while($row2=mysqli_fetch_array($query2))
{
    ?>                                     
                                        <li><img loading="lazy" src="admin/productimages/<?php echo $ids1?>/<?php echo $row2['image']?>" alt="product"></li>
                                    <?php } ?>
                                    </ul>
                                    <ul class="thumb-slider">
<?php $ids2=$row['pid'];
$query3=mysqli_query($con,"select * from productimage where productid='$ids2'");

while($row3=mysqli_fetch_array($query3))
{
    ?>                                     
                                        <li><img loading="lazy" src="admin/productimages/<?php echo $ids2?>/<?php echo $row3['image']?>" alt="product"></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-6">
                                <div class="view-details">
                                    <h3 class="view-name">
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?></a>
                                    </h3>
                                    <div class="view-meta">
                                        <p>SKU:<span><?php echo $row['sku']; ?></span></p>
                                        <p>BRAND:<a href="#"><?php echo $row['brand']; ?></a></p>
                                    </div>
                                    <div class="view-rating">

<?php $ids10=$row['pid'];
$query10=mysqli_query($con,"select * from review where productid='$ids10'");

$rate1=0;
$rate2=0;
$rate3=0;
$rate4=0;
$rate5=0;
$totalrate=0;
$rates=0;
while($row10=mysqli_fetch_array($query10))
{
    if($row10['rating']==1){
        $rate1++;
    }
    if($row10['rating']==2){
        $rate2++;
    }
    if($row10['rating']==3){
        $rate3++;
    }
    if($row10['rating']==4){
        $rate4++;
    }
    if($row10['rating']==5){
        $rate5++;
    }
    $totalrate++;
    $rates=intval((($rate1*1)+($rate2*2)+($rate3*3)+($rate4*4)+($rate5*5))/$totalrate);

    ?>                                     
                                    <?php } ?>

                                    <?php for($i=0;$i<$rates;$i++){ ?>
                                        <i class="active icofont-star"></i>
<?php } ?>
                                        <i class="icofont-star"></i>
                                        <a href="product-details.php?pid=<?php echo $ids1;?>">(<?php echo $totalrate;?> reviews)</a>
                                    </div>
                                    <h3 class="view-price">
                                        <del>$<?php echo $row['actualprice']; ?></del>
                                        <span>$<?php echo $row['discountprice']; ?></span>
                                    </h3>
                                    <p class="view-desc"><?php echo $row['shortdescription']; ?></p>
                                    <div class="view-list-group">
                                        <label class="view-list-title">tags:</label>
                                        <ul class="view-tag-list">
<?php $ids3=$row['pid'];
$query4=mysqli_query($con,"select * from tags where productid='$ids3'");

while($row4=mysqli_fetch_array($query4))
{
    ?>                                     
                                            <li><a href="product-details.php?pid=<?php echo $ids1;?>"><?php echo $row4['name'] ?></a></li>
                                        <?php }?>
                                        </ul>
                                    </div>
                                    <div class="view-list-group">
                                        <label class="view-list-title">Share:</label>
                                        <ul class="view-share-list">
                                            <li><a href="#" class="icofont-facebook" title="Facebook"></a></li>
                                            <li><a href="#" class="icofont-twitter" title="Twitter"></a></li>
                                            <li><a href="#" class="icofont-linkedin" title="Linkedin"></a></li>
                                            <li><a href="#" class="icofont-instagram" title="Instagram"></a></li>
                                        </ul>
                                    </div>
                                    <div class="view-add-group">
                                    <a class="product-add"href="index.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>
                                    </div>
                                    <div class="view-action-group">
                                            <a class="wish" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" title="Add to Wishlist"><i class="icofont-heart"></i></a>
                                            <a class="wish" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" title="Add to Wishlist"><i class="icofont-random"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>



        <!--=====================================
                    PRODUCT VIEW END
        =======================================-->
<?php } ?>


        <!--=====================================
                    CHECKOUT PART START
        =======================================-->
        <section class="inner-section checkout-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>Your order</h4>
                            </div>
                            <div class="account-content">
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
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
$query=mysqli_query($con,"select *,product.id as pid,product.name as pname,product.discountprice as pprice,product.brand as pbrand,product.stock as pstock,product.new as pnew,product.actualprice as pactualprice,product.sku as psku, product.brand as pbrand,product.shortdescription as pshortdescription from cart join product on product.id=cart.productid where userid='".$_SESSION['id']."' group by productid");
$cnt=1;
$quan=0;
while($row=mysqli_fetch_array($query))
{
  
$ids=$row['pid'];

?>

                                            <tr>
                                                <td class="table-serial"><h6><?php echo $cnt; ?></h6></td>
<?php 
$query1=mysqli_query($con,"select * from productimage where productid='$ids'");

if($row1=mysqli_fetch_array($query1))
{
    ?>
  
                                        <td class="table-image"><img src="admin/productimages/<?php echo $ids?>/<?php echo $row1['image']?>" alt="product"></td>
                                    <?php } ?>                                       
                                                                            <td class="table-name"><h6><?php echo mb_strimwidth($row['pname'],0,20);?></h6></td>
                                        <td class="table-price"><h6>$ <?php echo $row['discountprice']?></h6></td>
                                        <td class="table-vendor"><a href="#"><?php echo $row['pbrand']?></a></td>


            <td class="table-quantity">
                
                <h6>
                                <button class="action-minus" title="Quantity Minus" style="color:#0195B3;"><a class="" href="<?php    
      
    echo $str;   ?>?pid=<?php echo $row['pid']; ?>&&action=removee"><i class="icofont-minus" style="color:#0195B3;margin-right:10px;"></i></a></button>
                
                <?php echo $row['quantity']; $quan+=$row['quantity']; ?>
                                <button class="action-plus" title="Quantity Plus" style="color:#0195B3;"><a class="" href="<?php 
      
    echo $str;   ?>?pid=<?php echo $row['pid']; ?>&&action=add"><i class="icofont-plus" style="color:#0195B3;margin-left:10px;"></i></a></button>
                
                
                </h6></td>


                                                <td class="table-action">
                                                          <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid'] ?>"><i class="fas fa-eye"></i></a>

                                                    <a class="trash" href="<?php     
      
    echo $str;   ?>?pid=<?php echo $row['pid']; ?>&&action=removecart" title="Remove"><i class="icofont-trash"></i></a>
                                                </td>


                                            </tr>
<?php $cnt++; } ?>                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="chekout-coupon">
                <button class="coupon-btn">Do you have a coupon code?</button>
             <?php $sql=mysqli_query($con,"select *  from checkout where userid='".$_SESSION['id']."'");
             $results=mysqli_fetch_array($sql);
             $code2=$results['coupon'];
             $subtotal=$results['total'];
             $percentage=$results['percentage'];
             if($code==null){

    ?>

                <form class="coupon-form" method="post" action="<?php echo $str;?>" >
                    <input type="text" name="coupon1" placeholder="Enter your coupon code">
                    <button type="submit" name="coupon"><span>apply</span></button>
                </form>
            <?php } else{ ?>
                <form class="coupon-form" method="post" action="<?php echo $str;?>" >
                    <input type="text" name="coupon1" value="<?php echo $code; ?>" disabled   placeholder="Enter your coupon code">
                    <button type="submit"  name="removecode"><span>remove</span></button>
                </form>

            <?php } ?>

                                </div>
                                <div class="checkout-charge">
                                    <ul>
                                        <li>
                                            <span>Sub total</span>
                                            <span>$<?php echo $subtotal; ?></span>
                                        </li>
                                        <li>
                                            <span>delivery fee as per your address pincode</span>
                                            <span>+$<?php 
                                            $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."'");
             $results=mysqli_fetch_array($sql);
             $code=$results['picode'];
             $add=$results['address'];
             $co=$results['picode'];
                                            $contact=mysqli_query($con,"select *  from usercontacts where userid='".$_SESSION['id']."'");
             $contacts=mysqli_fetch_array($contact);
             $phone=$contacts['number'];

             $sql1=mysqli_query($con,"select *  from pincode where pincode='$code'");
             $results1=mysqli_fetch_array($sql1);
             $code1=$results1['price'];
    ?>
<?php  echo $code1; ?></span>
                                        </li>
                                        <li>
                                            <span>discount-<?php echo $code2; ?></span>
                                            <span>- <?php echo $percentage; echo"%";  ?></span>
                                        </li>
                                        <li>
                                            <span>Total<small>(Incl. GST)</small></span>
                                            <span>$<?php
$ret3=mysqli_query($con,"select * from checkout where userid='".$_SESSION['id']."'");
$cnt4=mysqli_fetch_array($ret3);
if($cnt4['total']==0){echo '0';}

else{

    if($cnt4['percentage']==null){
echo $cnt4['total'];        
    }

    else{
 $tt=($cnt4['total']-((($cnt4['percentage'])/100)*$cnt4['total']))+($code1);
 
 echo intval($tt);} } ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>contact number</h4>
                                <button data-bs-toggle="modal" data-bs-target="#contact-add">add contact</button>
                            </div>
                            <div class="account-content">
                                <div class="row">
    <?php $sql=mysqli_query($con,"select *  from usercontacts where userid='".$_SESSION['id']."' order by type asc ");
             while($row=mysqli_fetch_array($sql)){
 ?>                                
                                    <div class="col-md-6 col-lg-4 alert fade show">
                                        <div class="profile-card contact <?php if($row['type']=='primary'||$row['Primary']){echo 'active';}else{} ?>">
                                            <h6><?php echo $row['type']; ?></h6>
                                            <p><?php echo $row['number']; ?></p>
                                            <ul>
                                                <li><button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#contact-edit<?php echo $row['id']; ?>"></button></li>
                                                <li><a href="checkout.php?userid=<?php echo $_SESSION['id']; ?>&id=<?php echo $row['id']; ?>&removecontact=removecontact" class="trash icofont-ui-delete" title="Remove This" ></a></li>
                                            </ul>
                                        </div>
                                    </div>
                             <?php } ?>       
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>delivery address</h4>
                                <button data-bs-toggle="modal" data-bs-target="#address-add">add address</button>
                            </div>
                            <div class="account-content">
                                <div class="row">
    <?php $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."' order by type asc ");
             while($row=mysqli_fetch_array($sql)){
 ?>                                
                                    
                                    <div class="col-md-6 col-lg-4 alert fade show">
                                        <div class="profile-card address <?php if($row['type']=='home'){echo 'active';}else{} ?>">
                                            <h6><?php echo $row['type']; ?></h6>
                                            <p><?php echo $row['address']; echo " "; ?> <?php echo $row['picode']; ?></p>
                                            <ul class="user-action">
                                                <li><button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit<?php echo $row['id']; ?>"></button></li>
                                                <li><a href="checkout.php?userid=<?php echo $_SESSION['id']; ?>&id=<?php echo $row['id']; ?>&removeaddress=removeaddress" class="trash icofont-ui-delete" title="Remove This" ></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>                    

<script>
    
    function qr(){
        document.getElementById('myform2').style.display='block';
        document.getElementById('myform3').style.display='none';
        document.getElementById('myform').style.display='none';
    }
    function razor(){
        document.getElementById('myform').style.display='block';
        document.getElementById('myform3').style.display='none';
        document.getElementById('myform2').style.display='none';
    }
    function bank(){
        document.getElementById('myform3').style.display='block';
        document.getElementById('myform2').style.display='none';
        document.getElementById('myform').style.display='none';
    }
</script>
                    <div class="col-lg-12">
                        <div class="account-card mb-0">
                            <div class="account-title">
                                <h4>payment option</h4>
                            </div>
                            <div class="account-content">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4 alert fade show" onclick="qr();">
                                        <div class="payment-card payment active">
                                            <h4>QR CODE</h4>
                                            <p>
								    <?php
$query=mysqli_query($con,"select * from paymentdetails where statusqr=1");
if($row=mysqli_fetch_array($query))
{
?>

									<div id="qr">
									    
											<img src="admin/payment/<?php echo htmlentities($row['qrcode']);?>" height="100%" width="100%" style="height:200px;"  alt="">
									<h5>Please Upload QR Payment Screenshot</h5>

</div>


<?php } else{ ?>
									<div id="qr">

<h3>QR Payment Not Active</h3>
</div>
<?php
}?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 alert fade show" onclick="bank();" >
                                        <div class="payment-card payment">
                                            <h4>BANK TRANSFER</h4>
                                            <p>
								    <?php
$query=mysqli_query($con,"select * from paymentdetails where statusbank=1");
if($row=mysqli_fetch_array($query))
{
?>

									<div id="bank" >
<h4>Bank Name: <?php echo $row['bankname']?></h4>
<h4>Account Name: <?php echo $row['accountname']?></h4>
<h4>Account Number: <?php echo $row['accountnumber']?></h4>
<h4>IFSC: <?php echo $row['ifsc']?></h4>
<h4>UPI ID: <?php echo $row['upiid']?></h4>
<h4>Branch: <?php echo $row['branch']?></h4>
									<h5>Please Upload Bank Payment Screenshot</h5>
</div>







<?php } else{ ?>
									<div id="bank" >

<h3>Bank Payment Not Active</h3>
</div>			
<?php
}?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 alert fade show" onclick="razor();">
                                        <div class="payment-card payment">
                                            <h4>Online PAYMENT</h4>
                                            <p>
                                                <img src="images/visa.png" width="100" height="100">
                                                <img src="images/mastercard.png" width="100" height="100">
                                                <img src="images/rupay.png" width="100" height="100">
                                                <img src="images/upi.png" width="100" height="100">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

									<form class="modal-form" action="uploadqr.php" id="myform2" style="width:100%;" method="post" enctype="multipart/form-data">


                        <div class="form-group">
                            <label class="form-label">Select file to upload:</label>
                            <input class="form-control" required name="fileToUpload" type="file" >
                        </div>
                        <div class="form-group">
                            <label class="form-label">Please Confirm Address Selected Above</label>
                            <select class="form-control" name="address" required class=""  >
<?php $query=mysqli_query($con,"select * from useaddress where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['address'];?>"><?php echo $row['type'];?>-<?php echo $row['address'];?></option>
<?php } ?>
</select>

                        </div>
                        <div class="form-group">
                            <label class="form-label">Please Confirm Address Pincode Selected Above</label>
<select class="form-control" name="pincode"  class=""  >
<?php $query=mysqli_query($con,"select * from useaddress where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['picode'];?>"><?php echo $row['type'];?>-<?php echo $row['picode'];?></option>
<?php } ?>
</select>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Please Confirm Contact Selected Above</label>
<select class="form-control" name="number"  class=""  >
<?php $query=mysqli_query($con,"select * from usercontacts where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['number'];?>"><?php echo $row['type'];?>-<?php echo $row['number'];?></option>
<?php } ?>
</select>
                        </div>





<div class="checkout-proced" id="checkout" style="display:block;">
<button type="submit" name="myform2" style="display:block;" class="btn btn-inline">proced to checkout with qr</button>
</div>

</form>




									<form action="uploadbank.php"  class="modal-form"style="display:none; width:100%;" id="myform3" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="form-label">Select file to upload:</label>
                            <input class="form-control" required name="fileToUpload" type="file" >
                        </div>
                        <div class="form-group">
                            <label class="form-label">Please Confirm Address Selected Above</label>
                            <select class="form-control" name="address" required class=""  >
<?php $query=mysqli_query($con,"select * from useaddress where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['address'];?>"><?php echo $row['type'];?>-<?php echo $row['address'];?></option>
<?php } ?>
</select>

                        </div>
                        <div class="form-group">
                            <label class="form-label">Please Confirm Address Pincode Selected Above</label>
<select class="form-control" name="pincode" required class=""  >
<?php $query=mysqli_query($con,"select * from useaddress where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['picode'];?>"><?php echo $row['type'];?>-<?php echo $row['picode'];?></option>
<?php } ?>
</select>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Please Confirm Contact Selected Above</label>
<select class="form-control" name="number" required class=""  >
<?php $query=mysqli_query($con,"select * from usercontacts where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['number'];?>"><?php echo $row['type'];?>-<?php echo $row['number'];?></option>
<?php } ?>
</select>
                        </div>


<div class="checkout-proced" id="checkout" style="display:block;">
<button type="submit" name="myform3" style="display:block;" class="btn btn-inline">proced to checkout with bank</button>
</div>
</form>

								    <?php
$query=mysqli_query($con,"select * from paymentdetails where status=1");
if($row=mysqli_fetch_array($query))
{
?>

<form method="post" class="modal-form" id="myform" style="display:none;width:100%;" action="razorpaypayment/pay.php">
		    	
		    							<input type="text" name="pid" id="pid" value="<?php echo $_SESSION['pid']; ?>" hidden>
				             <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" hidden>
				             				<input type="text" name="rpprice" id="rpprice" value="<?php echo $_SESSION['tp']="$totalprice"; ?>" hidden>
							<input type="email" name="emailid" id="emailid" placeholder="enter email id" value="<?php echo $row['email'];?>"hidden >
							<input type="number" name="phoneno" id="phoneno" placeholder="enter phoneno" value="<?php echo $row['contactno'];?>" hidden>


                        <div class="form-group">
                            <label class="form-label">Please Confirm Address Selected Above</label>
                            <select class="form-control" name="address" required class=""  >
<?php $query=mysqli_query($con,"select * from useaddress where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['address'];?>"><?php echo $row['type'];?>-<?php echo $row['address'];?></option>
<?php } ?>
</select>

                        </div>
                        <div class="form-group">
                            <label class="form-label">Please Confirm Address Pincode Selected Above</label>
<select class="form-control" name="pincode" required class=""  >
<?php $query=mysqli_query($con,"select * from useaddress where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['picode'];?>"><?php echo $row['type'];?>-<?php echo $row['picode'];?></option>
<?php } ?>
</select>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Please Confirm Contact Selected Above</label>
<select class="form-control" name="number" required class=""  >
<?php $query=mysqli_query($con,"select * from usercontacts where userid='".$_SESSION['id']."' ORDER BY id");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['number'];?>"><?php echo $row['type'];?>-<?php echo $row['number'];?></option>
<?php } ?>
</select>
                        </div>


<div class="checkout-proced" id="checkout" style="display:block;">
<button type="submit" name="myform" style="display:block;" class="btn btn-inline">proced to checkout with razor</button>
</div>
		</form>

									<?php } else{
									?>
									<a href="#" id="razor" style="pointer-events: none; cursor: default;">NOT ACTIVE</a>
									
									
									<?php 
									}?>



                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    CHECKOUT PART END
        =======================================-->


        <!--=====================================
                    MODAL ADD FORM START
        =======================================-->
        <!-- contact add form -->
        <div class="modal fade" id="contact-add">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>add new contact</h3>
                        </div>
                        <div class="form-group" >
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type">
                                <option selected>choose type</option>
                                <option value="primary">primary</option>
                                <option value="secondary">secondary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">number</label>
                            <input class="form-control" name="number" type="tel" placeholder="Enter your number">
                        </div>
                        <button class="form-btn" name="contactadd" type="submit">save contact info</button>
                    </form>
                </div> 
            </div> 
        </div>

        <!-- address add form -->
        <div class="modal fade" id="address-add">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>add new address</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">type</label>
                            <select class="form-select" name="type">
                                <option selected>choose type</option>
                                <option value="home">home</option>
                                <option value="office">office</option>
                                <option value="bussiness">Bussiness</option>
                                <option value="academy">academy</option>
                                <option value="others">others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pincode</label>
                            <input class="form-control" name="pincode" type="number" placeholder="Enter your number">
                        </div>                        <div class="form-group">
                            <label class="form-label">address</label>
                            <textarea class="form-control" name="address" placeholder="Enter your address"></textarea>
                        </div>
                        <button class="form-btn" name="contactcontact" type="submit">save address info</button>
                    </form>
                </div> 
            </div> 
        </div>

        <!--=====================================
                    MODAL ADD FORM END
        =======================================-->

        
        <!--=====================================
                    MODAL EDIT FORM START
        =======================================-->
        <!-- profile edit form -->
        <div class="modal fade" id="profile-edit">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>edit profile info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">name</label>
                            <input class="form-control" name="name" type="text" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">email</label>
                            <input class="form-control" name="email" type="text" value="<?php echo $email; ?>">
                        </div>
                        <button class="form-btn" name="personal" type="submit">save profile info</button>
                    </form>
                </div> 
            </div> 
        </div>

        <!-- contact edit form -->
            <?php $sql=mysqli_query($con,"select *  from usercontacts where userid='".$_SESSION['id']."'");
             while($row=mysqli_fetch_array($sql)){
 ?>                                

        <div class="modal fade" id="contact-edit<?php echo $row['id']; ?>">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>edit contact info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">title</label>
                            <select name="type" class="form-select">
                                <option selected><?php echo $row['type'] ?></option>
                                <option value="<?php if( $row['type']=='primary'){echo 'secondary';}else{ echo 'primary';} ?>"><?php if( $row['type']=='primary'){echo 'secondary';}else{ echo 'primary';} ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">number</label>
                            <input class="form-control" type="tel" name="number" value="<?php echo $row['number'] ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" name="id" hidden  value="<?php echo $row['id'] ?>">
                        </div>
                        <button class="form-btn" type="submit" name="phone" type="submit">save contact info</button>
                    </form>
                </div> 
            </div> 
        </div>
        <?php } ?>

        <!-- address edit form -->
            <?php $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."'");
             while($row=mysqli_fetch_array($sql)){
 ?>                                
        
        <div class="modal fade" id="address-edit<?php echo $row['id']; ?>">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>edit address info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">title</label>
                            <select name="type" class="form-select">
                                <option selected><?php echo $row['type'] ?></option>
                                <option value="home">home</option>
                                <option value="office">office</option>
                                <option value="bussiness">Bussiness</option>
                                <option value="academy">academy</option>
                                <option value="others">others</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">pincode</label>
                            <input class="form-control" type="number" name="pincode" value="<?php echo $row['picode']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" name="id" hidden  value="<?php echo $row['id'] ;?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">address</label>
                            <input class="form-control" name="addresss1" value="<?php echo $row['address']; ?>" >
                        </div>
                        <button class="form-btn" name="address" type="submit">save address info</button>
                    </form>
                </div> 
            </div> 
        </div>
        <?php } ?>
        <!--=====================================
                    MODAL EDIT FORM END
        =======================================-->



































<?php include('footer.php') ?>


    </body>
</html>






