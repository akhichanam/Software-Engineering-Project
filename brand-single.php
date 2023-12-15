<?php
session_start();
error_reporting(0);
include('config.php');
include('conn.php');

if($_GET['bid']){
$cid1=intval($_GET['bid']);
}
else if($_GET['id']){
$cid1=intval($_GET['id']);
}
$query=mysqli_query($con,"select * from brand where id='$cid1'");
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
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
            <style>
#loading
{
    text-align:center; 
    background: url('loader.gif') no-repeat center; 
    height: 150px;
}
</style>

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
                <h2>Brand</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Brand</li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $brand; ?></li>
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
        <div class="modal fade" id="product-view1<?php echo $row['pid']?>">
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

    <?php include('style2.php'); ?>

<script>
function changeFunc(i){

    if(i=='az'){
    document.getElementById('az').click();
    }
    if(i=='za'){
    document.getElementById('za').click();
    }
    if(i=='lowprice'){
    document.getElementById('lowprice').click();
    }if(i=='highprice'){
    document.getElementById('highprice').click();
    }if(i=='featured'){
    document.getElementById('featured').click();
    }if(i=='bestseller'){
    document.getElementById('bestseller').click();
    }if(i=='datelow'){
    document.getElementById('datelow').click();
    }if(i=='datehigh'){
    document.getElementById('datehigh').click();
    }
}

</script>





        <!--=====================================
                    SHOP PART START
        =======================================-->
        <section class="inner-section shop-part">
            <div class="container">
                <div class="row content-reverse">
                    <div class="col-lg-3">
                                <?php 
$query=mysqli_query($con,"select * from shopposter where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

                        <div class="shop-widget-promo">
                            <a href="<?php echo htmlentities($row['link']);?>"><img src="admin/homeposter/<?php echo htmlentities($row['image']);?>"  alt="promo"></a>
                        </div>



<?php 

    
}
                    $queryprice = mysqli_query($con,"SELECT discountprice FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['discountprice']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




<div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Price<a style="float:right;" onclick="open1()">+</a></h6>
                                <ul id="f1"  class="shop-widget-list shop-widget-scroll" >
<?php

                    $query = "SELECT Count(*) as discountcount,discountprice,id FROM product where brand='$cid' group by discountprice ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check1<?php echo $cnt;?>" class="common_selector pricee" value="<?php echo $row['discountprice']; ?>">
<label for="check1<?php echo $cnt;?>">  <?php echo $cnt1; echo "-"; echo $row['discountprice']; ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['discountprice']; $cnt+=1;} ?>

                                </ul>


                        </div>



<?php } ?>




                        

      <script>
window.onload = function() {
  // Get a reference to the checkbox element
  var checkbox = document.getElementById("cat");
  
  // Simulate a click on the checkbox
  checkbox.click();
  
          document.getElementById('v0').value=18;
        document.getElementById('v0').click();
        document.getElementById('v1').click();

};
</script>

  
                        
                        <div class="shop-widget" style="display:none;">
                            <h6 class="shop-widget-title">Filter by Brand<a style="float:right;" onclick="open5()">+</a></h6>
                                <ul id="f5"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT * FROM product where  brand='$cid' ORDER BY id ASC ";
                    
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="cat" class="common_selector brand" value="<?php echo $row['brand']; ?>">
<label for="cat"> <?php echo $row['brand']; ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php
                                        
                                        $id=$row['brand'];
$ret=mysqli_query($con,"select * from product where brand='$id' and brand='$cid' ");
$num=mysqli_num_rows($ret);

echo $num;

?>)</span>
                                    </li>
									<?php $cnt+=1;} ?>

                                </ul>


                        </div>
                        
                        
  <?php                      $queryprice = mysqli_query($con,"SELECT stock FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['stock']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>
                        
                        
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Availability<a style="float:right;" onclick="open6()">+</a></h6>
                                <ul id="f6"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,stock,id from product where brand='$cid' group by stock ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check6<?php echo $cnt;?>" class="common_selector availability" value="<?php echo $row['stock']; ?>">
<label for="check6<?php echo $cnt;?>">  <?php if($row['stock']==null){echo "NONE";}else{ echo $row['stock'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['stock']; $cnt+=1;} ?>

                                </ul>


                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT motherboardchipset FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['motherboardchipset']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>
                        



                        
                        
                        
                        
                        
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Motherboard Chipset<a style="float:right;" onclick="open7()">+</a></h6>
                                <ul id="f7"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,motherboardchipset,id from product where brand='$cid' group by motherboardchipset ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check7<?php echo $cnt;?>" class="common_selector motherboardchipset" value="<?php echo $row['motherboardchipset']; ?>">
<label for="check7<?php echo $cnt;?>">  <?php if($row['motherboardchipset']==null){echo "NONE";}else{ echo $row['motherboardchipset'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['motherboardchipset']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT memory FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['memory']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>
                        




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Memory<a style="float:right;" onclick="open8()">+</a></h6>
                                <ul id="f8"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,memory,id from product where brand='$cid' group by memory ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check8<?php echo $cnt;?>" class="common_selector memory" value="<?php echo $row['memory']; ?>">
<label for="check8<?php echo $cnt;?>">  <?php if($row['memory']==null){echo "NONE";}else{ echo $row['memory'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['memory']; $cnt+=1;} ?>

                                </ul>

                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        

  <?php }                     $queryprice = mysqli_query($con,"SELECT cpucollertype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cpucollertype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cpucoolertype<a style="float:right;" onclick="open9()">+</a></h6>
                                <ul id="f9"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cpucollertype,id from product where brand='$cid' group by cpucollertype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check9<?php echo $cnt;?>" class="common_selector cpucoolertype" value="<?php echo $row['cpucollertype']; ?>">
<label for="check9<?php echo $cnt;?>">  <?php if($row['cpucollertype']==null){echo "NONE";}else{ echo $row['cpucollertype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cpucollertype']; $cnt+=1;} ?>

                                </ul>

                        </div>



  <?php }                     $queryprice = mysqli_query($con,"SELECT watt FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['watt']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by watt<a style="float:right;" onclick="open10()">+</a></h6>
                                <ul id="f10"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,watt,id from product where brand='$cid' group by watt ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check10<?php echo $cnt;?>" class="common_selector watt" value="<?php echo $row['watt']; ?>">
<label for="check10<?php echo $cnt;?>">  <?php if($row['watt']==null){echo "NONE";}else{ echo $row['watt'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['watt']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT cpugeneration FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cpugeneration']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cpugeneration<a style="float:right;" onclick="open11()">+</a></h6>
                                <ul id="f11"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cpugeneration,id from product where brand='$cid' group by cpugeneration ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check11<?php echo $cnt;?>" class="common_selector cpugeneration" value="<?php echo $row['cpugeneration']; ?>">
<label for="check11<?php echo $cnt;?>">  <?php if($row['cpugeneration']==null){echo "NONE";}else{ echo $row['cpugeneration'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cpugeneration']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT cpusocket FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cpusocket']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cpusocket<a style="float:right;" onclick="open12()">+</a></h6>
                                <ul id="f12"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cpusocket,id from product where brand='$cid' group by cpusocket ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check12<?php echo $cnt;?>" class="common_selector cpusocket" value="<?php echo $row['cpusocket']; ?>">
<label for="check12<?php echo $cnt;?>">  <?php if($row['cpusocket']==null){echo "NONE";}else{ echo $row['cpusocket'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cpusocket']; $cnt+=1;} ?>

                                </ul>

                        </div>
  <?php }                     $queryprice = mysqli_query($con,"SELECT ramspeed FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['ramspeed']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>





                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by ramspeed<a style="float:right;" onclick="open13()">+</a></h6>
                                <ul id="f13"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,ramspeed,id from product where brand='$cid' group by ramspeed ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check13<?php echo $cnt;?>" class="common_selector ramspeed" value="<?php echo $row['ramspeed']; ?>">
<label for="check13<?php echo $cnt;?>">  <?php if($row['ramspeed']==null){echo "NONE";}else{ echo $row['ramspeed'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['ramspeed']; $cnt+=1;} ?>

                                </ul>

                        </div>



  <?php }                     $queryprice = mysqli_query($con,"SELECT cabinetfantype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cabinetfantype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>


                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cabinetfantype<a style="float:right;" onclick="open14()">+</a></h6>
                                <ul id="f14"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cabinetfantype,id from product where brand='$cid' group by cabinetfantype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check14<?php echo $cnt;?>" class="common_selector cabinetfantype" value="<?php echo $row['cabinetfantype']; ?>">
<label for="check14<?php echo $cnt;?>">  <?php if($row['cabinetfantype']==null){echo "NONE";}else{ echo $row['cabinetfantype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cabinetfantype']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT motherboardgeneration FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['motherboardgeneration']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by motherboardgeneration<a style="float:right;" onclick="open15()">+</a></h6>
                                <ul id="f15"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,motherboardgeneration,id from product where brand='$cid' group by motherboardgeneration ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check15<?php echo $cnt;?>" class="common_selector motherboardgeneration" value="<?php echo $row['motherboardgeneration']; ?>">
<label for="check15<?php echo $cnt;?>">  <?php if($row['motherboardgeneration']==null){echo "NONE";}else{ echo $row['motherboardgeneration'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['motherboardgeneration']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT ramcapacity FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['ramcapacity']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by ramcapacity<a style="float:right;" onclick="open16()">+</a></h6>
                                <ul id="f16"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,ramcapacity,id from product where brand='$cid' group by ramcapacity ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check16<?php echo $cnt;?>" class="common_selector ramcapacity" value="<?php echo $row['ramcapacity']; ?>">
<label for="check16<?php echo $cnt;?>">  <?php if($row['ramcapacity']==null){echo "NONE";}else{ echo $row['ramcapacity'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['ramcapacity']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT hddformfactor FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['hddformfactor']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by hddformfactor<a style="float:right;" onclick="open17()">+</a></h6>
                                <ul id="f17"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,hddformfactor,id from product where brand='$cid' group by hddformfactor ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check17<?php echo $cnt;?>" class="common_selector hddformfactor" value="<?php echo $row['hddformfactor']; ?>">
<label for="check17<?php echo $cnt;?>">  <?php if($row['hddformfactor']==null){echo "NONE";}else{ echo $row['hddformfactor'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['hddformfactor']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT graphiccardmemory FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['graphiccardmemory']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by graphiccardmemory<a style="float:right;" onclick="open18()">+</a></h6>
                                <ul id="f18"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,graphiccardmemory,id from product where brand='$cid' group by graphiccardmemory ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check18<?php echo $cnt;?>" class="common_selector graphiccardmemory" value="<?php echo $row['graphiccardmemory']; ?>">
<label for="check18<?php echo $cnt;?>">  <?php if($row['graphiccardmemory']==null){echo "NONE";}else{ echo $row['graphiccardmemory'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['graphiccardmemory']; $cnt+=1;} ?>

                                </ul>

                        </div>



  <?php }                     $queryprice = mysqli_query($con,"SELECT cpuseries FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cpuseries']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>


                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cpuseries<a style="float:right;" onclick="open19()">+</a></h6>
                                <ul id="f19"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cpuseries,id from product where brand='$cid' group by cpuseries ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check19<?php echo $cnt;?>" class="common_selector cpuseries" value="<?php echo $row['cpuseries']; ?>">
<label for="check19<?php echo $cnt;?>">  <?php if($row['cpuseries']==null){echo "NONE";}else{ echo $row['cpuseries'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cpuseries']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT externalhddtypes FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['externalhddtypes']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by externalhddtype<a style="float:right;" onclick="open20()">+</a></h6>
                                <ul id="f20"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,externalhddtypes,id from product where brand='$cid' group by externalhddtypes ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check20<?php echo $cnt;?>" class="common_selector externalhddtype" value="<?php echo $row['externalhddtypes']; ?>">
<label for="check20<?php echo $cnt;?>">  <?php if($row['externalhddtypes']==null){echo "NONE";}else{ echo $row['externalhddtypes'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['externalhddtypes']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT internalhddcapacity FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['internalhddcapacity']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by internalhddcapacity<a style="float:right;" onclick="open21()">+</a></h6>
                                <ul id="f21"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,internalhddcapacity,id from product where brand='$cid' group by internalhddcapacity ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check21<?php echo $cnt;?>" class="common_selector internalhddcapacity" value="<?php echo $row['internalhddcapacity']; ?>">
<label for="check21<?php echo $cnt;?>">  <?php if($row['internalhddcapacity']==null){echo "NONE";}else{ echo $row['internalhddcapacity'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['internalhddcapacity']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT graphiccardcapacity FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['graphiccardcapacity']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by graphiccardcapacity<a style="float:right;" onclick="open22()">+</a></h6>
                                <ul id="f22"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,graphiccardcapacity,id from product where brand='$cid' group by graphiccardcapacity ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check22<?php echo $cnt;?>" class="common_selector graphiccardcapacity" value="<?php echo $row['graphiccardcapacity']; ?>">
<label for="check22<?php echo $cnt;?>">  <?php if($row['graphiccardcapacity']==null){echo "NONE";}else{ echo $row['graphiccardcapacity'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['graphiccardcapacity']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT externalhddinterface FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['externalhddinterface']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by externalhddinterface<a style="float:right;" onclick="open23()">+</a></h6>
                                <ul id="f23"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,externalhddinterface,id from product where brand='$cid' group by externalhddinterface ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check23<?php echo $cnt;?>" class="common_selector externalhddinterface" value="<?php echo $row['externalhddinterface']; ?>">
<label for="check23<?php echo $cnt;?>">  <?php if($row['externalhddinterface']==null){echo "NONE";}else{ echo $row['externalhddinterface'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['externalhddinterface']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT cabinetcasetype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cabinetcasetype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cabinetcasetype<a style="float:right;" onclick="open24()">+</a></h6>
                                <ul id="f24"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cabinetcasetype,id from product where brand='$cid' group by cabinetcasetype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check24<?php echo $cnt;?>" class="common_selector cabinetcasetype" value="<?php echo $row['cabinetcasetype']; ?>">
<label for="check24<?php echo $cnt;?>">  <?php if($row['cabinetcasetype']==null){echo "NONE";}else{ echo $row['cabinetcasetype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cabinetcasetype']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT powercapacity FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['powercapacity']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by powercapacity<a style="float:right;" onclick="open25()">+</a></h6>
                                <ul id="f25"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,powercapacity,id from product where brand='$cid' group by powercapacity ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check25<?php echo $cnt;?>" class="common_selector powercapacity" value="<?php echo $row['powercapacity']; ?>">
<label for="check25<?php echo $cnt;?>">  <?php if($row['powercapacity']==null){echo "NONE";}else{ echo $row['powercapacity'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['powercapacity']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT rammemorytype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['rammemorytype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by rammemorytype<a style="float:right;" onclick="open26()">+</a></h6>
                                <ul id="f26"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,rammemorytype,id from product where brand='$cid' group by rammemorytype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check26<?php echo $cnt;?>" class="common_selector rammemorytype" value="<?php echo $row['rammemorytype']; ?>">
<label for="check26<?php echo $cnt;?>">  <?php if($row['rammemorytype']==null){echo "NONE";}else{ echo $row['rammemorytype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['rammemorytype']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT motherboardseries FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['motherboardseries']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by motherboardseries<a style="float:right;" onclick="open27()">+</a></h6>
                                <ul id="f27"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,motherboardseries,id from product where brand='$cid' group by motherboardseries ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check27<?php echo $cnt;?>" class="common_selector motherboardseries" value="<?php echo $row['motherboardseries']; ?>">
<label for="check27<?php echo $cnt;?>">  <?php if($row['motherboardseries']==null){echo "NONE";}else{ echo $row['motherboardseries'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['motherboardseries']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT smpswatt FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['smpswatt']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by smpswatt<a style="float:right;" onclick="open28()">+</a></h6>
                                <ul id="f28"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,smpswatt,id from product where brand='$cid' group by smpswatt ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check28<?php echo $cnt;?>" class="common_selector smpswatt" value="<?php echo $row['smpswatt']; ?>">
<label for="check28<?php echo $cnt;?>">  <?php if($row['smpswatt']==null){echo "NONE";}else{ echo $row['smpswatt'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['smpswatt']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT ramtype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['ramtype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by ramtype<a style="float:right;" onclick="open29()">+</a></h6>
                                <ul id="f29"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,ramtype,id from product where brand='$cid' group by ramtype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check29<?php echo $cnt;?>" class="common_selector ramtype" value="<?php echo $row['ramtype']; ?>">
<label for="check29<?php echo $cnt;?>">  <?php if($row['ramtype']==null){echo "NONE";}else{ echo $row['ramtype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['ramtype']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT smpscertification FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['smpscertification']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by smpscertification<a style="float:right;" onclick="open30()">+</a></h6>
                                <ul id="f30"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,smpscertification,id from product where brand='$cid' group by smpscertification ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check30<?php echo $cnt;?>" class="common_selector smpscertification" value="<?php echo $row['smpscertification']; ?>">
<label for="check30<?php echo $cnt;?>">  <?php if($row['smpscertification']==null){echo "NONE";}else{ echo $row['smpscertification'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['smpscertification']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT internalhddtype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['internalhddtype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>





                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by internalhddtype<a style="float:right;" onclick="open31()">+</a></h6>
                                <ul id="f31"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,internalhddtype,id from product where brand='$cid' group by internalhddtype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check31<?php echo $cnt;?>" class="common_selector internalhddtype" value="<?php echo $row['internalhddtype']; ?>">
<label for="check31<?php echo $cnt;?>">  <?php if($row['internalhddtype']==null){echo "NONE";}else{ echo $row['internalhddtype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['internalhddtype']; $cnt+=1;} ?>

                                </ul>

                        </div>
  <?php }                     $queryprice = mysqli_query($con,"SELECT externalhddcapacity FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['externalhddcapacity']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>





                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by externalhddcapacity<a style="float:right;" onclick="open32()">+</a></h6>
                                <ul id="f32"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,externalhddcapacity,id from product where brand='$cid' group by externalhddcapacity ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check32<?php echo $cnt;?>" class="common_selector externalhddcapacity" value="<?php echo $row['externalhddcapacity']; ?>">
<label for="check32<?php echo $cnt;?>">  <?php if($row['externalhddcapacity']==null){echo "NONE";}else{ echo $row['externalhddcapacity'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['externalhddcapacity']; $cnt+=1;} ?>

                                </ul>

                        </div>



  <?php }                     $queryprice = mysqli_query($con,"SELECT interface FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['interface']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>


                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by interface<a style="float:right;" onclick="open33()">+</a></h6>
                                <ul id="f33"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,interface,id from product where brand='$cid' group by interface ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check33<?php echo $cnt;?>" class="common_selector interface" value="<?php echo $row['interface']; ?>">
<label for="check33<?php echo $cnt;?>">  <?php if($row['interface']==null){echo "NONE";}else{ echo $row['interface'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['interface']; $cnt+=1;} ?>

                                </ul>

                        </div>



  <?php }                     $queryprice = mysqli_query($con,"SELECT graphiccardseries FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['graphiccardseries']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>


                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by graphiccardseries<a style="float:right;" onclick="open34()">+</a></h6>
                                <ul id="f34"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,graphiccardseries,id from product where brand='$cid' group by graphiccardseries ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check34<?php echo $cnt;?>" class="common_selector graphiccardseries" value="<?php echo $row['graphiccardseries']; ?>">
<label for="check34<?php echo $cnt;?>">  <?php if($row['graphiccardseries']==null){echo "NONE";}else{ echo $row['graphiccardseries'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['graphiccardseries']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT ledlighting FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['ledlighting']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by ledlighting<a style="float:right;" onclick="open35()">+</a></h6>
                                <ul id="f35"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,ledlighting,id from product where brand='$cid' group by ledlighting ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check35<?php echo $cnt;?>" class="common_selector ledlighting" value="<?php echo $row['ledlighting']; ?>">
<label for="check35<?php echo $cnt;?>">  <?php if($row['ledlighting']==null){echo "NONE";}else{ echo $row['ledlighting'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['ledlighting']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT motherboardcompatibility FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['motherboardcompatibility']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by motherboardcompatibility<a style="float:right;" onclick="open36()">+</a></h6>
                                <ul id="f36"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,motherboardcompatibility,id from product where brand='$cid' group by motherboardcompatibility ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check36<?php echo $cnt;?>" class="common_selector motherboardcompatibility" value="<?php echo $row['motherboardcompatibility']; ?>">
<label for="check36<?php echo $cnt;?>">  <?php if($row['motherboardcompatibility']==null){echo "NONE";}else{ echo $row['motherboardcompatibility'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['motherboardcompatibility']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT threedrivebays FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['threedrivebays']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by 3.5' drive bays<a style="float:right;" onclick="open37()">+</a></h6>
                                <ul id="f37"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,threedrivebays,id from product where brand='$cid' group by threedrivebays ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check37<?php echo $cnt;?>" class="common_selector thirthyfivedrivebays" value="<?php echo $row['threedrivebays']; ?>">
<label for="check37<?php echo $cnt;?>">  <?php if($row['threedrivebays']==null){echo "NONE";}else{ echo $row['threedrivebays'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['threedrivebays']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT twodrivebays FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['twodrivebays']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by 2.5' Drive Bays<a style="float:right;" onclick="open38()">+</a></h6>
                                <ul id="f38"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,twodrivebays,id from product where brand='$cid' group by twodrivebays ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check38<?php echo $cnt;?>" class="common_selector twentyfivedrivebays" value="<?php echo $row['twodrivebays']; ?>">
<label for="check38<?php echo $cnt;?>">  <?php if($row['twodrivebays']==null){echo "NONE";}else{ echo $row['twodrivebays'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['twodrivebays']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT formfactor FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['formfactor']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by formfactor<a style="float:right;" onclick="open39()">+</a></h6>
                                <ul id="f39"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,formfactor,id from product where brand='$cid' group by formfactor ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check39<?php echo $cnt;?>" class="common_selector formfactor" value="<?php echo $row['formfactor']; ?>">
<label for="check39<?php echo $cnt;?>">  <?php if($row['formfactor']==null){echo "NONE";}else{ echo $row['formfactor'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['formfactor']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT graphiccompatibility FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['graphiccompatibility']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by graphiccompatibility<a style="float:right;" onclick="open40()">+</a></h6>
                                <ul id="f40"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,graphiccompatibility,id from product where brand='$cid' group by graphiccompatibility ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check40<?php echo $cnt;?>" class="common_selector graphiccompatibility" value="<?php echo $row['graphiccompatibility']; ?>">
<label for="check40<?php echo $cnt;?>">  <?php if($row['graphiccompatibility']==null){echo "NONE";}else{ echo $row['graphiccompatibility'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['graphiccompatibility']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT cpusupport FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['cpusupport']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by cpusupport<a style="float:right;" onclick="open41()">+</a></h6>
                                <ul id="f41"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,cpusupport,id from product where brand='$cid' group by cpusupport ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check41<?php echo $cnt;?>" class="common_selector cpusupport" value="<?php echo $row['cpusupport']; ?>">
<label for="check41<?php echo $cnt;?>">  <?php if($row['cpusupport']==null){echo "NONE";}else{ echo $row['cpusupport'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['cpusupport']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT chipset FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['chipset']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by chipset<a style="float:right;" onclick="open42()">+</a></h6>
                                <ul id="f42"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,chipset,id from product where brand='$cid' group by chipset ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check42<?php echo $cnt;?>" class="common_selector chipset" value="<?php echo $row['chipset']; ?>">
<label for="check42<?php echo $cnt;?>">  <?php if($row['chipset']==null){echo "NONE";}else{ echo $row['chipset'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['chipset']; $cnt+=1;} ?>

                                </ul>

                        </div>


  <?php }                     $queryprice = mysqli_query($con,"SELECT memorysupporttype FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['memorysupporttype']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>



                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by memorysupporttype<a style="float:right;" onclick="open43()">+</a></h6>
                                <ul id="f43"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,memorysupporttype,id from product where brand='$cid' group by memorysupporttype ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check43<?php echo $cnt;?>" class="common_selector memorysupporttype" value="<?php echo $row['memorysupporttype']; ?>">
<label for="check43<?php echo $cnt;?>">  <?php if($row['memorysupporttype']==null){echo "NONE";}else{ echo $row['memorysupporttype'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['memorysupporttype']; $cnt+=1;} ?>

                                </ul>

                        </div>

  <?php }                     $queryprice = mysqli_query($con,"SELECT motherboardplateform FROM product where brand='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['motherboardplateform']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>




                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by motherboardplate<a style="float:right;" onclick="open44()">+</a></h6>
                                <ul id="f44"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT Count(*) as discountcount,motherboardplateform,id from product where brand='$cid' group by motherboardplateform ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    $cntt=0;
                    $cnt1=0;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check44<?php echo $cnt;?>" class="common_selector motherboardplate" value="<?php echo $row['motherboardplateform']; ?>">
<label for="check44<?php echo $cnt;?>">  <?php if($row['motherboardplateform']==null){echo "NONE";}else{ echo $row['motherboardplateform'];} ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php 
                                        $cntt=$row['discountcount'];
                                        echo $cntt;?>)</span>
                                    </li>
									<?php $cnt1=$row['motherboardplateform']; $cnt+=1;} ?>

                                </ul>

                        </div>

<?php } ?>

<div class="widget widget-brands" style="display:none">

								
								<div class="widget-title">
									<h3>Sort<span></span></h3>
								</div>
								
								
								<div class="widget-content">
									<ul class="box-checkbox scroll">
								<input type="radio" id="lowprice" name="fav_language" class="common_selector lowprice" value="HTML"> <label for="html">HTML</label><br>
                                        <input type="radio" id="az" name="fav_language" class="common_selector az" value="CSS"> <label for="css">CSS</label><br>
                                                            <input type="radio" id="za" class="common_selector za" name="fav_language" value="JavaScript"> <label for="javascript">JavaScript</label>
                                                            <input type="radio" id="highprice" class="common_selector highprice" name="fav_language" class="common_selector az" value="CSS"> <label for="css">CSS</label><br>
                                                            <input type="radio" id="featured" class="common_selector featured" name="fav_language" class="common_selector az" value="CSS"> <label for="css">CSS</label><br>
                                                            <input type="radio" id="bestseller" class="common_selector bestseller" name="fav_language" class="common_selector az" value="CSS"> <label for="css">CSS</label><br>
                                                            <input type="radio" id="datelow" class="common_selector datelow" name="fav_language" class="common_selector az" value="CSS"> <label for="css">CSS</label><br>
                                                            <input type="radio" id="datehigh" class="common_selector datehigh" name="fav_language" class="common_selector az" value="CSS"> <label for="css">CSS</label><br>
									</ul>
								</div>
					
								
								
								
								
								
							</div><!-- /.widget widget-brands -->
<?php $sql11=mysqli_query($con,"select * from product where brand='$cid' ");
$num=mysqli_num_rows($sql11);
?>



<script>
    function changeFunc1(i){
        document.getElementById('v0').value=i;
        document.getElementById('testprint').innerHTML= "Showing "+i+" of <?php echo $num ?>";
        document.getElementById('v0').click();
        document.getElementById('v1').click();
        document.getElementById('v0').click();
        document.getElementById('v1').click();
    }
</script>

<div class="widget widget-brands" style="display:none">

								
								<div class="widget-title">
									<h3>Sort<span></span></h3>
								</div>
								
								
								<div class="widget-content">
									<ul class="box-checkbox scroll">

				<input type="checkbox" id="v0" class="common_selector v0" name="fav_language" value="12"> <br>

									</ul>
								</div>
					
								
								
								
								
								
							</div><!-- /.widget widget-brands -->

<div class="widget widget-brands" style="display:none">

								
								<div class="widget-title">
									<h3>Sort<span></span></h3>
								</div>
								
								
								<div class="widget-content">
									<ul class="box-checkbox scroll">

				<input type="checkbox" id="v1" class="common_selector v1" name="fav_language" value="0"> <br>

									</ul>
								</div>
					
								
								
								
								
								
							</div><!-- /.widget widget-brands -->



                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="top-filter">
                                    <div class="filter-show">
                                        <label class="filter-label">Show :</label>

                                        <select class="form-select filter-select" onchange="changeFunc1(value);">
<?php $sql11=mysqli_query($con,"select * from product where brand='$cid'");
$num=mysqli_num_rows($sql11);
$cnt=0;
while($num>$cnt && $num<=($cnt+12) || $num>($cnt+12))
{
?>

                                            <option value="<?php echo $cnt+12; ?>"><?php echo $cnt+12; ?></option>
<?php $cnt+=12; } ?>
                                        </select>

                                    </div>
                                    <div class="filter-short">
                                        <label class="filter-label">Short by :</label>
											<select name="popularity" class="form-select filter-select" onchange="changeFunc(value);" style="width:fit-content">
											    <option> Select</option>
											    <option id="az" value="az">Alphabetically, A-Z</option>
											    <option   value="za">Alphabetically, Z-A</option>
												<option value="lowprice">Price, Low To High</option>
												<option  value="highprice">Price, High To Low</option>
												<option  value="featured">Featured</option>
												<option  value="bestseller">Best Selling</option>
												<option  value="datelow">Date, Low To High</option>
												<option  value="datehigh">Date, High To Low</option>
										</select>
                                    </div>
                                    <div class="filter-action">
                                        <a onclick="changeview3();" class="active" title="Three Column"><i class="fas fa-th"></i></a>
                                        <a onclick="changeview2();" title="Two Column"><i class="fas fa-th-large"></i></a>
                                        <a onclick="changeview1();" title="One Column"><i class="fas fa-th-list"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script>
                            function changeview3(){
                                document.getElementById('filter_data').style.display='block';
                                document.getElementById('filter_data2').style.display='none';
                                document.getElementById('filter_data1').style.display='none';
                            }
                            function changeview2(){
                                document.getElementById('filter_data2').style.display='block';
                                document.getElementById('filter_data').style.display='none';
                                document.getElementById('filter_data1').style.display='none';
                            }
                            function changeview1(){
                                document.getElementById('filter_data1').style.display='block';
                                document.getElementById('filter_data2').style.display='none';
                                document.getElementById('filter_data').style.display='none';
                            }
                        </script>
                        
                            <div id="filter_data" class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-3" ></div>

                            <div id="filter_data2" style="display:none;" class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-2"></div>
                            <div id="filter_data1" style="display:none;" class="row"></div>

                        <div class="row"  style="width:100%;">
                            <div class="col-lg-12">
                                <div class="bottom-paginate">
                                    <p class="page-info" id="testprint"> Showing 12 of <?php echo $num; ?> Results</p>
                                    <ul class="pagination">
                                        <li class="page-item">
<?php if($num>0){
?>                                            
                                            <a class="page-link" onclick="changefuncc();" id="prevvv" style="display:none;">
                                                <i class="fas fa-long-arrow-alt-left"></i>
                                            </a>
              <?php } ?>                              
                                            <script>
                                                function changefuncc(){
                                                    i=12;
                                                     document.getElementById('v1').value-=i;
                                    document.getElementById('testprint').innerHTML= "Showing "+(parseInt(document.getElementById('v1').value)+12)+" of <?php echo $num ?>";

        document.getElementById('v1').click();
        document.getElementById('v0').click();
        document.getElementById('v1').click();
        document.getElementById('v0').click();
            document.getElementById('nexttt').style.display='block';
        if(document.getElementById('v1').value<=0){
            document.getElementById('prevvv').style.display='none';
            document.getElementById('nexttt').style.display='block';
        }
}
                                            </script>
                                        </li>
                                        
<?php $sql11=mysqli_query($con,"select * from product where brand='$cid' ");
$num=mysqli_num_rows($sql11);
$cnt=0;
$cn=1;
while($num>$cnt && $num<=($cnt+12) || $num>($cnt+12))
{
?>

                                        <li class="page-item"><a class="page-link " id="num<?php echo $cnt; ?>" onclick='changefunc2<?php echo $cnt; ?>();'><?php echo $cn; ?></a></li>
                                        
                                        <script>
                                            function changefunc2<?php echo $cnt; ?>(){
                                                var i=<?php echo $cnt; ?>;
//                                                document.getElementById('num<?php echo $cnt; ?>').classList.add("active");
                                                     document.getElementById('v1').value=i;
                                        document.getElementById('testprint').innerHTML= "Showing "+(i+12)+" of <?php echo $num ?>";

        document.getElementById('v1').click();
        document.getElementById('v0').click();
                                                        if(document.getElementById('v1').value<= <?php echo $cnt; ?> ){
                                                        document.getElementById('prevvv').style.display='none';
                                                    }
                                                        if((i+12)>= <?php echo $num; ?> ){
                                                        document.getElementById('nexttt').style.display='none';
                                                    }
                                                        if((i+12)<= <?php echo $num; ?> ){
                                                        document.getElementById('nexttt').style.display='block';
                                                    }


                                                        if(i< 12 ){
                                                        document.getElementById('prevvv').style.display='none';
                                                    }
                                                        if(i>= 12 ){
                                                        document.getElementById('prevvv').style.display='block';
                                                    }
        document.getElementById('v1').click();
        document.getElementById('v0').click();
   
                                            }
                                        </script>
                                        <?php $cn++;$cnt+=12; }?>
                                        <li class="page-item">
                                            <?php if($num<=$cnt){ ?>
                                            <a class="page-link" onclick="changefuncc1();" id="nexttt">
                                                <i class="fas fa-long-arrow-alt-right"></i>
                                            </a>
                                            <?php } ?>
                                                                                        <script>
                                                function changefuncc1(){
                                                    i=12;
                                                     document.getElementById('v1').value=parseInt(document.getElementById('v1').value)+i;
                                    document.getElementById('testprint').innerHTML= "Showing "+(parseInt(document.getElementById('v1').value)+12)+" of <?php echo $num ?>";

        document.getElementById('v1').click();
        document.getElementById('v0').click();
        document.getElementById('v1').click();
        document.getElementById('v0').click();

            document.getElementById('prevvv').style.display='block';
        if(document.getElementById('v1').value<=<?php echo $num; ?>){
            document.getElementById('prevvv').style.display='block';
        }
        if((parseInt(document.getElementById('v1').value)+12)><?php echo $num; ?>){
            document.getElementById('nexttt').style.display='none';
        }
        else{
            document.getElementById('nexttt').style.display='block';
            
        }
}
                                            </script>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    SHOP PART END
        =======================================-->











<?php include('footer.php') ?>


    </body>
</html>






