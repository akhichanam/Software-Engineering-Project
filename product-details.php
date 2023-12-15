<?php
session_start();
error_reporting(0);
include('config.php');
include('conn.php');

$pid= $_GET['pid'];
$c=mysqli_query($con,"select * from product where id='$pid'");
$c1=mysqli_fetch_array($c);
$c2=$c1['categoryid'];
$c3=mysqli_query($con,"select * from category where id='$c2'");
$c4=mysqli_fetch_array($c3);
$c5=$c4['name'];

if(isset($_POST['replys']))
{
	$reply=$_POST['reply'];
	$reviewid=$_POST['reviewid'];
	mysqli_query($con,"insert into reply(reviewid,userid,description) values('$reviewid','".$_SESSION['id']."','$reply')");
}

if(isset($_POST['replies']))
{
	$reply=$_POST['reply'];
	$reviewid=$_POST['reviewid'];
	mysqli_query($con,"insert into reply(reviewid,userid,description) values('$reviewid','".$_SESSION['id']."','$reply')");
}


if(isset($_POST['review']))
{
	$reply=$_POST['description'];

	$reply1=$_POST['rating1'];//5
	$reply2=$_POST['rating2'];//4
	$reply3=$_POST['rating3'];//3
	$reply4=$_POST['rating4'];//2
	$reply5=$_POST['rating5'];//1
	$countttt=0;
if($reply1==null){
    $countttt=5;
}
if($reply2==null){
    $countttt=4;
}
if($reply3==null){
    $countttt=3;
}
if($reply4==null){
    $countttt=2;
}
if($reply5==null){
    $countttt=1;
}

	$sql=mysqli_query($con,"insert into review(userid,productid,rating,description) values('".$_SESSION['id']."','$pid','$countttt','$reply')");
	if(!$sql){
	    echo "<script>alert('problem')</script>";
	}
	else{
	header("location:product-details.php?pid=".$pid);
	    
	}
}




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/product-details.css">
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
                <h2>Product</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="product-details.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->

<style>
    



figure.zoom {
  background-position: 50% 50%;
  position: relative;
  overflow: hidden;
  cursor: zoom-in;
}
figure.zoom img:hover {
  opacity: 0;
}
figure.zoom img {
  transition: opacity .5s;
  display: block;
  width: 100%;
}

</style>

<script>
    const container = document.querySelector('.image-container');
const zoomArea = document.querySelector('.zoom-area');

container.addEventListener('mousemove', function(event) {
  const x = event.offsetX / container.offsetWidth;
  const y = event.offsetY / container.offsetHeight;

  const zoomLevel = 3;

  const newX = x * (100 - zoomLevel) * -1;
  const newY = y * (100 - zoomLevel) * -1;

  zoomArea.style.opacity = '1';
  zoomArea.style.backgroundPosition = `${newX}% ${newY}%`;
  zoomArea.style.width = `${zoomLevel * 100}%`;
  zoomArea.style.height = `${zoomLevel * 100}%`;
});

container.addEventListener('mouseleave', function() {
  zoomArea.style.opacity = '0';
});



function zoom(e){
  var zoomer = e.currentTarget;
  e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
  e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
  x = offsetX/zoomer.offsetWidth*100
  y = offsetY/zoomer.offsetHeight*100
  zoomer.style.backgroundPosition = x + '% ' + y + '%';
}
</script>
        <!--=====================================
                PRODUCT DETAILS PART START
        =======================================-->
     <?php


$result1 = mysqli_query($con,"select * from product where id<'$pid'");
$res1=mysqli_fetch_array($result1);
$previous_post_id = $res1['id'];

$result2 = mysqli_query($con,"select * from product where id>'$pid'");
$res2=mysqli_fetch_array($result2);
$next_post_id = $res2['id'];

$result3 = mysqli_query($con,"select * from product order by id asc limit 1");
$res3=mysqli_fetch_array($result3);
$first_post_id = $res3['id'];

$result4 = mysqli_query($con,"select * from product order by id desc limit 1");
$res4=mysqli_fetch_array($result4);
$last_post_id = $res4['id'];


$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.id='$pid' group by product.id");

$count=mysqli_num_rows($ret);
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

        <section class="inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="details-gallery">
                            <div class="details-label-group">
                                <?php if($row['new']==1){echo '<label class="details-label new">new</label>';}else{}?>
                                <label class="details-label off"><?php $discount=(($row['discountprice']/$row['actualprice'])*100)-100; echo intval($discount); echo "%"; ?></label>
                            </div>
                            <ul class="details-preview"> 
<?php 
$query2=mysqli_query($con,"select * from productimage where productid='$pid'");

while($row2=mysqli_fetch_array($query2))
{
    ?>                                     
                                        <li class="image-container">
                                        
                                        
                                        <figure class="zoom" onmousemove="zoom(event)" style="background-image: url('admin/productimages/<?php echo $pid;?>/<?php echo $row2['image']?>')">
  <img src="admin/productimages/<?php echo $pid;?>/<?php echo $row2['image']?>" />
</figure>
                                        </li>
                                    <?php } ?>
                            </ul>
                            <ul class="details-thumb">
<?php 
$query2=mysqli_query($con,"select * from productimage where productid='$pid'");

while($row2=mysqli_fetch_array($query2))
{
    ?>                                     
                                        <li><img loading="lazy" src="admin/productimages/<?php echo $pid;?>/<?php echo $row2['image']?>" alt="product"></li>
                                    <?php } ?>                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="product-navigation">
                            <li class="product-nav-prev">
                                <a href="product-details.php?pid=<?php if($previous_post_id==null)
                                {echo $last_post_id;}
                                else{echo $previous_post_id;}?>">
                                    <i class="icofont-arrow-left"></i>
                                    prev product
                                </a>
                            </li>
                            <li class="product-nav-next">
                                <a href="product-details.php?pid=<?php if($next_post_id ==null){echo $first_post_id;}
                                else{echo $next_post_id ;}?>">
                                    next product
                                    <i class="icofont-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="details-content">
                            <h3 class="details-name"><a href="#<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></h3>
                            <div class="details-meta">
                                        <p>SKU:<span><?php echo $row['sku']; ?></span></p>
                                        <p>BRAND:<a href="#"><?php echo $row['brand']; ?></a></p>
                            </div>
                            <div class="details-rating">
<?php 
$query10=mysqli_query($con,"select * from review where productid='$pid'");

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
                            <h3 class="details-price">
                                        <del>$<?php echo $row['actualprice']; ?></del>
                                        <span>$<?php echo $row['discountprice']; ?></span>
                            </h3>
                            <p class="details-desc"><?php echo $row['shortdescription'] ?></p>
                            <div class="details-list-group">
                                <label class="details-list-title">tags:</label>
                                <ul class="details-tag-list">
<?php $ids3=$pid;
$query4=mysqli_query($con,"select * from tags where productid='$ids3'");

while($row4=mysqli_fetch_array($query4))
{
    ?>                                     
                                            <li><a href="#"><?php echo $row4['name'] ?></a></li>
                                            <?php } ?>
                                </ul>
                            </div>
                            <div class="details-list-group">
                                <label class="details-list-title">Share:</label>
                                <ul class="details-share-list">
                                    <li><a href="#" class="icofont-facebook" title="Facebook"></a></li>
                                    <li><a href="#" class="icofont-twitter" title="Twitter"></a></li>
                                    <li><a href="#" class="icofont-linkedin" title="Linkedin"></a></li>
                                    <li><a href="#" class="icofont-instagram" title="Instagram"></a></li>
                                </ul>
                            </div>
                            <div class="details-add-group">
                                    <a class="product-add"href="product-details.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>

                            </div>
                            <div class="details-action-group">
                                <a class="details-wish wish" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" title="Add to Wishlist" title="Add Your Wishlist">
                                    <i class="icofont-heart"></i>
                                    <span>add to wish</span>
                                </a>
                                <a class="details-compare" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" title="Compare This Item">
                                    <i class="fas fa-random"></i>
                                    <span>Compare This</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                PRODUCT DETAILS PART END
        =======================================-->


        <!--=====================================
                  PRODUCT TAB PART START
        =======================================-->
        <section class="inner-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">descriptions</a></li>
                     <?php if($row['video']==null){} else{ ?>       
                     <li><a href="#tab-video" class="tab-link" data-bs-toggle="tab">video</a></li>
                     <?php } ?>
                            <li><a href="#tab-spec" class="tab-link" data-bs-toggle="tab">Technical Specifications</a></li>
                            <li><a href="#tab-reve" class="tab-link" data-bs-toggle="tab">reviews (

                            <?php $ret11=mysqli_query($con,"select * from review where productid= '$pid' ; ");
$count11=mysqli_num_rows($ret11);

echo $count11; ?>)</a></li>
                        </ul>
                    </div>
                </div>
                                <div class="tab-pane fade show active" id="tab-desc">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-details-frame">
<?php echo str_replace('<img','<img style="border:2px solid #0195b3;padding:1px 1px 1px 1px;width:900px;height:fit-content;"',str_replace('<table','<br/><table style="border:2px solid black; padding:4px 4px 4px 4px;"',str_replace('<td','<td style="border:1px solid black; padding:4px 4px 4px 4px;"',$row['longdescription'])));?>
							                          </div>
                        </div>
                    </div>
                </div>
                
                <?php if($row['video']==null){} else{ ?> 
                                <div class="tab-pane fade" id="tab-video">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-details-frame">
                                    <video width="100%" height="100%" controls>
  <source src="admin/productimages/<?php echo htmlentities($row['video']);?>" type="video/mp4">

</video>

</div>
                        </div>
                    </div>
                </div>
<?php } ?>
                <div class="tab-pane fade" id="tab-spec">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-details-frame">
<?php echo str_replace('<img','<img style="border:2px solid #0195b3;padding:1px 1px 1px 1px;width:900px;height:fit-content;"',str_replace('<table','<br/><table style="border:2px solid black; padding:4px 4px 4px 4px;"',str_replace('<td','<td style="border:1px solid black; padding:4px 4px 4px 4px;"',$row['specification'])));?>
	                            </div>
                        </div>
                    </div>
                </div>
                
                <?php } ?>     


                <div class="tab-pane fade" id="tab-reve">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-details-frame">
                                <ul class="review-list">
<?php
$ret11=mysqli_query($con,"select * from review where productid= '$pid' ; ");
$count11=mysqli_num_rows($ret11);
$rate1=0;
$rate2=0;
$rate3=0;
$rate4=0;
$rate5=0;
$totalrate=0;
$rates=0;

while ($row11=mysqli_fetch_array($ret11)) 
{
    
        if($row11['rating']==1){
        $rate1++;
    }
    if($row11['rating']==2){
        $rate2++;
    }
    if($row11['rating']==3){
        $rate3++;
    }
    if($row11['rating']==4){
        $rate4++;
    }
    if($row11['rating']==5){
        $rate5++;
    }
    $totalrate++;
    $rates=intval((($rate1*1)+($rate2*2)+($rate3*3)+($rate4*4)+($rate5*5))/$totalrate);

$userid=$row11['userid'];
$reviewid=$row11['id'];
$ret121=mysqli_query($con,"select * from user where id= '$userid' ; ");
$uid=mysqli_fetch_array($ret121);
?>

                                    <li class="review-item">
                                        <div class="review-media">
                                            <a class="review-avatar" href="#">
                                                <img src="admin/user/<?php echo $uid['image'] ?>" alt="review">
                                            </a>
                                            <h5 class="review-meta">
                                                <a href="#"><?php echo $uid['name'] ?></a>
                                                <span><?php echo $row11['date'] ?></span>
                                            </h5>
                                        </div>
                                        <ul class="review-rating">
                                                                                <?php for($i=0;$i<$rates;$i++){ ?>

                                            <li class="icofont-ui-rating"></li>
<?php } ?>
<li class="icofont-ui-rate-blank"></li>
                                        </ul>
                                        <p class="review-desc"><?php echo $row11['description'] ?></p>
                                        						    <?php if(strlen($_SESSION['login'])==0){
												            ?>
													<label for="flat-rate"><span><a href="login.php" style="color:#f29b00;font-size:20px; hover{
													color:black;}">Please Login To Give Review</a></span></label>

												            <?php 
												        }
										else{		        
?>

                                        <form class="review-reply" method='post'>
                                            <input type="hidden" name='reviewid' value="<?php echo $reviewid; ?>">                                            
                                            
                                            <input type="text" name='reply' placeholder="reply your thoughts">
                                            <button name="replys" type="submit"><i class="icofont-reply"></i>reply</button>
                                        </form>
                                        <?php } ?>
                                        
                                        <ul class="review-reply-list">
<?php $ret111=mysqli_query($con,"select * from reply where reviewid= '$reviewid' ; ");
while ($row111=mysqli_fetch_array($ret111)) 
{
$userid1=$row111['userid'];
$ret1211=mysqli_query($con,"select * from user where id= '$userid1' ; ");
$uid1=mysqli_fetch_array($ret1211);

 ?>
                                            <li class="review-reply-item">
                                                <div class="review-media">
                                                    <a class="review-avatar" href="#">
                                                        <img src="admin/user/<?php echo $uid1['image'] ?>" alt="review">
                                                    </a>
                                                    <h5 class="review-meta">
                                                        <a href="#"><?php echo $uid1['name'] ?></a>
                                                        <span><b> <?php echo $row111['date'] ?></span>
                                                    </h5>
                                                </div>
                                                <p class="review-desc"><?php echo $row111['description'] ?></p>
                                                						    <?php if(strlen($_SESSION['login'])==0){
												            ?>
													<label for="flat-rate"><span><a href="login.php" style="color:#f29b00;font-size:20px; hover{
													color:black;}">Please Login To Give Review</a></span></label>

												            <?php 
												        }
										else{		        
?>

                                        <form class="review-reply" method='post'>
                                            <input type="hidden" name='reviewid' value="<?php echo $reviewid; ?>">                                            
                                            
                                            <input type="text" name='reply' placeholder="reply your thoughts">
                                            <button name="replies" type="submit"><i class="icofont-reply"></i>reply</button>
                                        </form>
                                                <?php } ?>
                                            </li>
                                            <?php } ?>
                                            
                                        </ul>
                                    </li>
<?php } ?>
                                </ul>
                            </div>
 <?php if(strlen($_SESSION['login'])==0){
												            ?>
													<label for="flat-rate"><span><a href="login.php" style="color:#f29b00;font-size:20px; hover{
													color:black;}">Please Login To Give Review</a></span></label>

												            <?php 
												        }
										else{		        
?>                            
                            <div class="product-details-frame">
                                <h3 class="frame-title">add your review</h3>
                                
                                <form class="review-form" method='post'>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="star-rating">
                                                <input type="radio" name="rating1" id="star-1"><label for="star-1"></label>
                                                <input type="radio" name="rating2" id="star-2"><label for="star-2"></label>
                                                <input type="radio" name="rating3" id="star-3"><label for="star-3"></label>
                                                <input type="radio" name="rating4" id="star-4"><label for="star-4"></label>
                                                <input type="radio" name="rating5" id="star-5"><label for="star-5"></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="description" placeholder="Describe"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn btn-inline" name="review" type="submit">
                                                <i class="icofont-water-drop"></i>
                                                <span>drop your review</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
  <?php } ?>                          
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </section>
        <!--=====================================
                    PRODUCT TAB PART END
        =======================================-->


        <!--=====================================
                 PRODUCT RELATED PART START
        =======================================-->
        <section class="inner-section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section-heading">
                            <h2>related this items</h2>
                        </div>
                    </div>
                </div>
                
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                        <?php

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.categoryid='$c2' and product.id<>'$pid'  GROUP BY name ORDER BY date asc limit 10");
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
                                    <a title="Product Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view1<?php echo $row['pid']?>"></a>

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
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?></a>

                                    </h6>
                                    <h6 class="product-price">
                                    <span>$<?php echo $row['discountprice']; ?></span>
                                    </h6>
<a class="product-add"href="product-details.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
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

$ret=mysqli_query($con,"select *,product.id as pid,productimage.image as pimg from product join productimage on productimage.productid=product.id where product.new='1'  GROUP BY name ORDER BY date asc limit 10");
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
                                    <a title="Product Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" class="fas fa-random"></a>

                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view1<?php echo $row['pid']?>"></a>

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
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['name']; ?></a>

                                    </h6>
                                    <h6 class="product-price">
                                    <span>$<?php echo $row['discountprice']; ?></span>
                                    </h6>
<a class="product-add"href="product-details.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>   
                                </div>
                            </div>
                        </div>
  <?php } ?>                      

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-25">
                            <a href="category.php?cid=<?php echo $c2; ?>" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                <span>view all related</span>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--=====================================
                 PRODUCT RELATED PART END
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
                                    <a class="product-add"href="product-details.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>
                                    </div>
                                    <div class="view-action-group">
                                            <a class="wish" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" title="Add to Wishlist"><i class="icofont-heart"></i></a>
                                            <a class="wish" href="product-details.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" title="Add to Wishlist"><i class="icofont-random"></i></a>
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

     

  






        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/product-details.css">

<?php include('footer.php') ?>

<div style="display:none;">
    <a href="https://informatika.politap.ac.id/gacor-bang/">Slot Mahjong</a>
    <a href="https://informatika.politap.ac.id/server-thailand/">Server Thailand</a>
    <a href="https://room-gacor.almatajer.online/">room gacor</a>
    <a href="https://www.mededuinfo.com/themes/">situs toto</a>
    <a href="https://martinaberto.co.id/link-slot/">slot gacor</a>
    <a href="http://www.fhycs.unju.edu.ar/sistema_comunicacion/uploads/bandartogel/">togel online</a>
    <a href="https://elearning.yuasathai.com/shionaga/">shionaga</a>
    <a href="https://shionaga.almatajer.online/">shionaga</a>
    rel="noopener"
</div>
    </body>
</html>






