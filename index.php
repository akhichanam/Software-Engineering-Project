<?php
session_start();
error_reporting(0);
include('config.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>

    </head>
    <body>

<?php include('header.php') ?>




        <!--=====================================
                    BANNER PART START
        =======================================-->
        <section class="banner-part">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-3" id="categoryless">
                        <div class="banner-category">
                            <div class="banner-category-head">
                                <i class="fas fa-bars"></i>
                                <span>top categories</span>
                            </div>
                            <ul class="banner-category-list">
<?php
$ret=mysqli_query($con,"select * from category order by subcatcount desc limit 11");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...
$ids=$row['id'];

?>            
                    <li class="banner-category-item">
                                    <a href="category.php?id=<?php echo htmlentities($row['id']) ?>">
                                        <img loading="lazy" width="25" height="25" style="margin-right:15px" src='admin/category/<?php echo htmlentities($row['icon']) ?>'>

                                        <span ><?php echo htmlentities($row['name']) ?></span>
                                    </a>
                                    <style>
.dropbtn {
}


.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

</style>


<?php
$ret122=mysqli_query($con,"select * from subcategory where catid='$ids'");
$cou=mysqli_num_rows($ret122);
if($cou>1){
?>            

                                    <div class="banner-category-dropdown">
                                        <h5><?php echo htmlentities($row['name']) ?> ITEM</h5>
                                        <div class="banner-sub-category">
                                            <ul>
<?php
$ret1=mysqli_query($con,"select * from subcategory where catid='$ids' order by name asc limit 0,8");
while ($row1=mysqli_fetch_array($ret1)) 
{
    # code...
$ids1=$row1['id'];

?>            

                                            
                    <li class="banner-category-item dropdown">
                                    <a class="dropbtn" href="subcategory.php?id=<?php echo htmlentities($row1['id']) ?>">
                                        <img loading="lazy" width="25" height="25" style="margin-right:15px" src='admin/category/<?php echo htmlentities($row['icon']) ?>'>

                                        <span ><?php echo htmlentities($row1['name']) ?></span>
                                    </a>


                                                </li>

                                        <?php } ?>
                                            </ul>




                                            <ul>
<?php
$ret1=mysqli_query($con,"select * from subcategory where catid='$ids' order by name asc limit 8,8");
while ($row1=mysqli_fetch_array($ret1)) 
{
    # code...
$ids1=$row1['id'];

?>            

                                            
                    <li class="banner-category-item dropdown">
                                    <a class="dropbtn" href="subcategory.php?id=<?php echo htmlentities($row1['id']) ?>">
                                        <img loading="lazy" width="25" height="25" style="margin-right:15px" src='admin/category/<?php echo htmlentities($row['icon']) ?>'>

                                        <span ><?php echo htmlentities($row1['name']) ?></span>
                                    </a>

                                                

                                                </li>

                                        <?php } ?>
                                            </ul>

                                            <ul>
<?php
$ret1=mysqli_query($con,"select * from subcategory where catid='$ids' order by name asc limit 16,8");
while ($row1=mysqli_fetch_array($ret1)) 
{
    # code...
$ids1=$row1['id'];

?>            

                                            
                    <li class="banner-category-item dropdown">
                                    <a class="dropbtn" href="subcategory.php?id=<?php echo htmlentities($row1['id']) ?>">
                                        <img loading="lazy" width="25" height="25" style="margin-right:15px" src='admin/category/<?php echo htmlentities($row1['icon']) ?>'>

                                        <span ><?php echo htmlentities($row['name']) ?></span>
                                    </a>

                                                

                                                </li>

                                        <?php } ?>
                                            </ul>



                                        </div>
                                    </div>
                                    
                                <?php } ?>
                                
                                </li>


                            <?php } ?>
                            </ul>
                        </div>
                    </div>




                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="home-grid-slider slider-dots">
    <?php 
$query=mysqli_query($con,"select * from homeslider");
while($row=mysqli_fetch_array($query))
{
  


?>

                                    <div class="banner-wrap bg1">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="banner-content">
                                                    <h2><?php echo htmlentities($row['title']);?></h2>
                                                    <a href="<?php echo htmlentities($row['link']);?>" class="btn btn-inline">
                                                        <i class="fas fa-shopping-basket"></i>
                                                        <span>shop now</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="banner-image">
                                                    <img loading="lazy" src="admin/homeslider/<?php echo htmlentities($row['image']);?>"  alt="slider">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php } ?>

                                </div>
                            </div>


                                <?php 
$query=mysqli_query($con,"select * from homeposter1 where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

                            <div class="col-md-6 col-lg-6">
                                <div class="banner-promo">
                                    <a href="<?php echo htmlentities($row['link']);?>"><img loading="lazy" src="admin/homeposter/<?php echo htmlentities($row['image']);?>" alt="promo"></a>
                                </div>
                            </div>
                        <?php } ?>
                                <?php 
$query=mysqli_query($con,"select * from homeposter1 where id=2");
if($row=mysqli_fetch_array($query))
{
  


?>

                            <div class="col-md-6 col-lg-6">
                                <div class="banner-promo">
                                    <a href="<?php echo htmlentities($row['link']);?>"><img loading="lazy" src="admin/homeposter/<?php echo htmlentities($row['image']);?>" alt="promo"></a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->




        <!--=====================================
                    INTRO PART START
        =======================================-->

        <section class="section intro-part" >
            <div class="container">
                <div class="row intro-content">
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                               <?php
$ret=mysqli_query($con,"select * from iconbox where id=2 ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <div class="intro-content">
                                <h5><?php echo htmlentities($row['title']) ?></h5>
                                <p><?php echo htmlentities($row['description']) ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                               <?php
$ret=mysqli_query($con,"select * from iconbox where id=4 ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <div class="intro-content">
                                <h5><?php echo htmlentities($row['title']) ?></h5>
                                <p><?php echo htmlentities($row['description']) ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                               <?php
$ret=mysqli_query($con,"select * from iconbox where id=1 ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <div class="intro-content">
                                <h5><?php echo htmlentities($row['title']) ?></h5>
                                <p><?php echo htmlentities($row['description']) ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="intro-wrap">
                            <div class="intro-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                               <?php
$ret=mysqli_query($con,"select * from iconbox where id=3 ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <div class="intro-content">
                                <h5><?php echo htmlentities($row['title']) ?></h5>
                                <p><?php echo htmlentities($row['description']) ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    INTRO PART END
        =======================================-->

        <!--=====================================
                    FEATURED PART START
        =======================================-->
        <section class="section feature-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>our featured items</h2>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
<?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.featured='1'  GROUP BY productimage.productid ORDER BY rand() limit 6");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                    <div class="col">
                        <div class="feature-card <?php if($row['stock']=="Out of Stock") { echo "product-disable";}else{} ?>">
                            <div class="feature-media">
                                <div class="feature-label">
                                    <?php if($row['featured']==1){echo '<label class="label-text feat">feature</label>';}else{}?>
                                </div>
                                <a class="feature-image" href="product-details.php?pid=<?php echo $row['pid']?>">
                                    <img loading="lazy" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimg']);?>" alt="product">
                                </a>
                                <div class="feature-widget">
                                    <a title="Product Wishlist" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid']?>"></a>
                                </div>
                            </div>
                            <div class="feature-content">
                                <h6 class="feature-name">
                                    <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?> - <?php echo $row['brand']; ?></a>
                                </h6>
                                <div class="feature-rating">
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
                                        <a href="product-details.php?pid=<?php echo $ids;?>">(<?php echo $totalrate;?> reviews)</a>
                                </div>
                                <h6 class="feature-price">
                                    <span>$<?php echo $row['discountprice']; ?></span>
                                </h6>
                                <p class="feature-desc"><?php echo mb_strimwidth($row['shortdescription'],0,40,'...'); ?></p>
<a class="product-add"href="index.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>                            </div>
                        </div>
                    </div>
<?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-25">
                            <a href="shop.php" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all feature</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    FEATURE PART END
        =======================================-->


        <!--=====================================
                    PROMO PART START
        =======================================-->
        <?php 
$query4=mysqli_query($con,"select * from homeposter2 ");

while($row4=mysqli_fetch_array($query4))
{
    ?>                                     

        <section class="section promo-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="promo-content" style="background: url(admin/homeposter/<?php echo $row4['image']?>) no-repeat center;">
                            <h3>only <span><?php echo $row4['title1']?></span> </h3>
                            <h2><?php echo $row4['title2']?></h2>
                            <a href="<?php echo $row4['link']?>" class="btn btn-inline">
                                <i class="fas fa-shopping-basket"></i>
                                <span>shop now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--=====================================
                    PROMO PART END
        =======================================-->


        <!--=====================================
                    NEW ITEM PART START
        =======================================-->
        <section class="section newitem-part">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section-heading">
                            <h2>collected new items</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <ul class="new-slider slider-arrow">
                            <?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.new='1'  GROUP BY productimage.productid ORDER BY rand()");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                            <li>
                                
                                <div class="product-card <?php if($row['stock']=="Out of Stock") { echo "product-disable";}else{} ?>">
                                    <div class="product-media">
                                        <div class="product-label">
<?php if($row['new']==1){echo '<label class="label-text new">new</label>';}else{}?>
                                        </div>
                                <a class="product-image" href="product-details.php?pid=<?php echo htmlentities($row['pid']);?>">
                                    <img loading="lazy" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimg']);?>" alt="product">
                                </a>
                                <div class="product-widget">
                                    <a title="Product Wishlist" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid']?>"></a>
                                </div>

                                    </div>
                                    <div class="product-content">
                                        <div class="product-rating">
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
                                        <a href="product-details.php?pid=<?php echo $ids;?>">(<?php echo $totalrate;?> reviews)</a>
                                </div>
                                <h6 class="product-name">
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?> - <?php echo $row['brand']; ?></a>
                                </h6> 
                                <h6 class="product-price">
                                        <del>$<?php echo $row['actualprice']; ?></del>
                                        <span>$<?php echo $row['discountprice']; ?></span>
                                </h6>
                                    
                                    <a class="product-add" href="index.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>

                                    </div>
                                </div>
                            </li>
 <?php } ?>                           
                            
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="section-btn-25">
                            <a href="shop.php" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all new item</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <!--=====================================
                    NEW ITEM PART END
        =======================================-->


        <!--=====================================
                    NICHE PART START
        =======================================-->
        <section class="section niche-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h2>Browse by Top Niche</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#top-sales" class="tab-link active" data-bs-toggle="tab">
                                    <i class="icofont-price"></i>
                                    <span>top Selling</span>
                                </a>
                            </li>
                            <li>
                                <a href="#top-rate" class="tab-link" data-bs-toggle="tab">
                                    <i class="icofont-star"></i>
                                    <span>top new</span>
                                </a>
                            </li>
                            <li>
                                <a href="#top-disc" class="tab-link" data-bs-toggle="tab">
                                    <i class="icofont-sale-discount"></i>
                                    <span>top featured</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="tab-pane fade show active" id="top-sales">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                        <?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.bestselling='1'  GROUP BY productimage.productid ORDER BY rand() limit 10");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                        <div class="col">
                            <div class="product-card <?php if($row['stock']=="Out of Stock") { echo "product-disable";}else{} ?>">
                                <div class="product-media">
                                    <div class="product-label">
<?php if($row['bestselling']==1){echo '<label class="label-text sale">best</label>';}else{}?>                                        
                                    </div>
                                    <a class="product-image" href="product-details.php?pid=<?php echo $row['pid']?>">
                                        <img loading="lazy" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimg']);?>" alt="product">
                                    </a>
                                    <div class="product-widget">
                                    <a title="Product Wishlist" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid']?>"></a>

                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-rating">
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
                                        <a href="product-details.php?pid=<?php echo $ids;?>">(<?php echo $totalrate;?> reviews)</a>
                                </div>
                                    <h6 class="product-name">
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?> - <?php echo $row['brand']; ?></a>

                                    </h6>
                                    <h6 class="product-price">
                                    <span>$<?php echo $row['discountprice']; ?></span>
                                    </h6>
<a class="product-add"href="index.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>   
                                </div>
                            </div>
                        </div>
  <?php } ?>                      
                        
                    </div>
                </div>

                <div class="tab-pane fade" id="top-rate">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                    <?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.new='1'  GROUP BY productimage.productid ORDER BY rand() limit 10");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                        <div class="col">
                            <div class="product-card <?php if($row['stock']=="Out of Stock") { echo "product-disable";}else{} ?>">
                                <div class="product-media">
                                    <div class="product-label">
<?php if($row['new']==1){echo '<label class="label-text rate">new</label>';}else{}?>                                        
                                    </div>
                                    <a class="product-image" href="product-details.php?pid=<?php echo $row['pid']?>">
                                        <img loading="lazy" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimg']);?>" alt="product">
                                    </a>
                                    <div class="product-widget">
                                    <a title="Product Wishlist" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid']?>"></a>

                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-rating">
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
                                        <a href="product-details.php?pid=<?php echo $ids;?>">(<?php echo $totalrate;?> reviews)</a>
                                </div>
                                    <h6 class="product-name">
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?> - <?php echo $row['brand']; ?></a>

                                    </h6>
                                    <h6 class="product-price">
                                    <span>$<?php echo $row['discountprice']; ?></span>
                                    </h6>
<a class="product-add"href="index.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>   
                                </div>
                            </div>
                        </div>
  <?php } ?>                      

                    </div>
                </div>

                <div class="tab-pane fade" id="top-disc">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                    <?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.featured='1'  GROUP BY productimage.productid ORDER BY rand() limit 10");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                        <div class="col">
                            <div class="product-card <?php if($row['stock']=="Out of Stock") { echo "product-disable";}else{} ?>">
                                <div class="product-media">
                                    <div class="product-label">
<?php if($row['featured']==1){echo '<label class="label-text off">best</label>';}else{}?>                                        
                                    </div>
                                    <a class="product-image" href="product-details.php?pid=<?php echo $row['pid']?>">
                                        <img loading="lazy" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimg']);?>" alt="product">
                                    </a>
                                    <div class="product-widget">
                                    <a title="Product Wishlist" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="index.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid']?>"></a>

                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-rating">
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
                                        <a href="product-details.php?pid=<?php echo $ids;?>">(<?php echo $totalrate;?> reviews)</a>
                                </div>
                                    <h6 class="product-name">
                                        
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?> - <?php echo $row['brand']; ?></a>

</h6>
                                    <h6 class="product-price">
                                    <span>$<?php echo $row['discountprice']; ?></span>
                                    </h6>
<a class="product-add"href="index.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>   
                                </div>
                            </div>
                        </div>
  <?php } ?>                      

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-25">
                            <a href="shop.php" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all niche</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    NICHE PART END
        =======================================-->


        <!--=====================================
                    CATEGORY PART START
        =======================================-->
        <section class="section category-part">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2>shop by categories</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="category-slider slider-arrow" >
                              <?php
$ret=mysqli_query($con,"select * from category order by id asc ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...
    $cd=$row['name'];


?>

                            <div class="category-wrap">
                                <div class="category-media">
                                    <img loading="lazy" src="admin/category/<?php echo $row['logo'] ?>" alt="category" >
                                    <div class="category-overlay">
                                        <a href="category.php?cid=<?php echo $row['id'] ?>"><i class="fas fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="category-meta">
                                    <h4><?php echo $row['name'] ?></h4>
                                    <?php $query=mysqli_query($con,"select * from product where categoryid='$cd' ");
                                    $cou=mysqli_num_rows($query);
?>
                                    <p>(<?php echo $cou;?> items)</p>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-50">
                            <a href="allcategory.php" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all category</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    CATEGORY PART END
        =======================================-->


        <!--=====================================
                    BRAND PART START
        =======================================-->
        <section class="section brand-part">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2>shop by brands</h2>
                        </div>
                    </div>
                </div>
                <div class="brand-slider slider-arrow">
  <?php
$ret=mysqli_query($con,"select * from brand order by name asc ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...
    $cd=$row['name'];


?>                  
                    <div class="brand-wrap">
                        <div class="brand-media">
                            
                            <img loading="lazy" src="admin/brands/<?php echo $row['image'] ?>" style="width:150px; height:150px;" alt="brand">
                            <div class="brand-overlay">
                                <a href="brand-single.php?bid=<?php echo $row['id']; ?>"><i class="fas fa-link"></i></a>
                            </div>
                        </div>
                        <div class="brand-meta">
                            <h4><?php echo $row['name'] ?></h4>
                                    <?php $query=mysqli_query($con,"select * from product where brand='$cd' ");
                                    $cou=mysqli_num_rows($query);
?>
                                    <p>(<?php echo $cou;?> items)</p>

                        </div>
                    </div>
            <?php } ?>        
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-50">
                            <a href="brands.php" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all brands</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    BRAND PART END
        =======================================-->



        <!--=====================================
                      BLOG PART START
        =======================================-->
        <section class="section blog-part">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2>Read our articles</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-slider slider-arrow">
                            <?php
$ret=mysqli_query($con,"select * from blog order by id asc limit 4 ");
while ($row=mysqli_fetch_array($ret)) 
{


?>
                            <div class="blog-card">
                                <div class="blog-media">
                                    <a class="blog-img" href="#">
                                        <img loading="lazy" src="admin/blog/<?php echo $row['image'] ?>" style="width:250; height:250px;" alt="blog">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <ul class="blog-meta">
                                        <li>
                                            <i class="fas fa-user"></i>
                                            <span>admin</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-calendar-alt"></i>
                                            <span><?php echo $row['date'] ?></span>
                                        </li>
                                    </ul>
                                    <h4 class="blog-title">
                                        <a href="blog-details.php?blogid=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a>
                                    </h4>
                                </div>
                            </div>
                            
                       <?php } ?>     
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-25">
                            <a href="blog.php" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all blog</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                      BLOG PART END
        =======================================-->



<?php include('footer.php') ?>
    </body>
</html>






