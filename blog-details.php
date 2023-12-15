<?php
session_start();
error_reporting(0);
include('config.php');
include('conn.php');

$pid= $_GET['blogid'];

if(isset($_POST['replys']))
{
	$reply=$_POST['reply'];
	$reviewid=$_POST['reviewid'];
	mysqli_query($con,"insert into blogreply(reviewid,userid,description) values('$reviewid','".$_SESSION['id']."','$reply')");
}

if(isset($_POST['replies']))
{
	$reply=$_POST['reply'];
	$reviewid=$_POST['reviewid'];
	mysqli_query($con,"insert into blogreply(reviewid,userid,description) values('$reviewid','".$_SESSION['id']."','$reply')");
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
	$sql=mysqli_query($con,"insert into blogreview(userid,productid,rating,description) values('".$_SESSION['id']."','$pid','$countttt','$reply')");
	if(!$sql){
	    echo "<script>alert('problem')</script>";
	}
	else{
	header("location:blog-details.php?blogid=".$pid);
	    
	}
}




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/blog-details.css">
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
                <h2>Blog</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="product-details.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->

<style>
    

.image-container:hover img {
  transform: scale(1.5);
}

.zoom-area {
  position: absolute;
  width: 100px;
  height: 100px;
  opacity: 0;
  pointer-events: none;
  background-repeat: no-repeat;
  background-size: 400% 300%;
  background-position: 0 0;
}


</style>

<script>
    const container = document.querySelector('.image-container');
const zoomArea = document.querySelector('.zoom-area');

container.addEventListener('mousemove', function(event) {
  const x = event.offsetX / container.offsetWidth;
  const y = event.offsetY / container.offsetHeight;

  const zoomLevel = 2;

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

</script>


  
  
          <!--=====================================
                  BLOG DETAILS PART START
        =======================================-->
        <section class="inner-section blog-details-part">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-10">

                            <?php
                            
                            
                            $result1 = mysqli_query($con,"select * from blog where id<'".$_GET['blogid']."'");
$res1=mysqli_fetch_array($result1);
$previous_post_id = $res1['id'];
$previous_post_name = $res1['title'];

$result2 = mysqli_query($con,"select * from blog where id>'".$_GET['blogid']."'");
$res2=mysqli_fetch_array($result2);
$next_post_id = $res2['id'];
$next_post_name = $res2['title'];

$result3 = mysqli_query($con,"select * from blog order by id asc limit 1");
$res3=mysqli_fetch_array($result3);
$first_post_id = $res3['id'];
$first_post_name = $res3['title'];

$result4 = mysqli_query($con,"select * from blog order by id desc limit 1");
$res4=mysqli_fetch_array($result4);
$last_post_id = $res4['id'];
$last_post_name = $res4['title'];

$ret=mysqli_query($con,"select * from blog where id='".$_GET['blogid']."' ");
if ($row=mysqli_fetch_array($ret)) 
{


?>
                        
                        <article class="blog-details">
                            <a class="blog-details-thumb" href="">
                                <img loading="lazy" src="admin/blog/<?php echo $row['image'] ?>" style="width:250; height:250px;" alt="blog">
                            </a>
                            <div class="blog-details-content">
                                <ul class="blog-details-meta">
                                    <li>
                                        <i class="icofont-ui-calendar"></i>
                                        <span><?php echo $row['date'] ?></span>
                                    </li>
                                    <li>
                                        <i class="icofont-user-alt-3"></i>
                                        <span>admin</span>
                                    </li>
                                </ul>
                                <h2 class="blog-details-title"><?php echo $row['title'] ?></h2>
                                <p class="blog-details-desc"><?php 
							echo str_replace('<img','<img style="border:2px solid #F92400;padding:1px 1px 1px 1px"',str_replace('<table','<br/><table style="border:2px solid black; padding:4px 4px 4px 4px;"',str_replace('<td','<td style="border:1px solid black; padding:4px 4px 4px 4px;"',$row['shortdescription'])));?></p>
                                <p class="blog-details-desc"><?php 
							echo str_replace('<img','<img style="border:2px solid #F92400;padding:1px 1px 1px 1px"',str_replace('<table','<br/><table style="border:2px solid black; padding:4px 4px 4px 4px;"',str_replace('<td','<td style="border:1px solid black; padding:4px 4px 4px 4px;"',$row['longdescription'])));?></p>
<?php } ?>                        

                                <div class="blog-details-footer">
                                    <ul class="blog-details-share">
                                        <li><span>share:</span></li>
                                        <li><a href="#" class="icofont-facebook"></a></li>
                                        <li><a href="#" class="icofont-twitter"></a></li>
                                        <li><a href="#" class="icofont-linkedin"></a></li>
                                        <li><a href="#" class="icofont-pinterest"></a></li>
                                        <li><a href="#" class="icofont-instagram"></a></li>
                                    </ul>
                                    <ul class="blog-details-tag">
                                        <li><span>tags:</span></li>
<?php 
$query4=mysqli_query($con,"select * from blogtags where blogid='".$_GET['blogid']."' ");

while($row4=mysqli_fetch_array($query4))
{
    ?>                                     
                                            <li><a href="#"><?php echo $row4['name'] ?></a></li>
                                            <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </article>
                        
                        <div class="blog-details-navigate">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="blog-details-prev">
                                        <h4><a href="<?php if($previous_post_id==null)
                                {echo $last_post_id;}
                                else{echo $previous_post_id;}?>"><?php if($previous_post_id==null)             {echo $last_post_name;}
                                else{echo $previous_post_name;}?></a></h4>
                                        <a class="nav-arrow" href="blog-details.php?blogid=<?php if($previous_post_id==null)
                                {echo $last_post_id;}
                                else{echo $previous_post_id;}?>"><i class="icofont-arrow-left"></i>prev post</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="blog-details-next">
                                        <h4><a href="<?php if($next_post_id ==null){echo $first_post_id;}
                                else{echo $next_post_id ;}?>"><?php if($next_post_id ==null){echo $first_post_name;}
                                else{echo $next_post_name ;}?>
                                </a></h4>
                                        <a class="nav-arrow" href="blog-details.php?blogid=<?php if($next_post_id ==null){echo $first_post_id;}
                                else{echo $next_post_id ;}?>">next post<i class="icofont-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="blog-details-comment">
                            <ul class="comment-list">

<?php
$ret11=mysqli_query($con,"select * from blogreview where blogid= '".$_GET['blogid']."' ");
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
                                        <ul class="review-rating">                                                                                <?php for($i=0;$i<$rates;$i++){ ?>

                                            <li class="icofont-ui-rating"></li>
<?php } ?>
<li class="icofont-ui-rate-blank"></li>
                                        </ul>
                                        <p class="review-desc"><?php echo $row11['description'] ?></p>
                                        						    <?php if(strlen($_SESSION['login'])==0){
												            ?>
													<a href="login.php">Please Login To Give Review</a>

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
<?php $ret111=mysqli_query($con,"select * from blogreply where reviewid= '$reviewid' ; ");
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
													<a href="login.php" style="">Please Login To Give Review</a>

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
                        
                        <?php if(strlen($_SESSION['login'])==0){s
												            ?>
													<a href="login.php"  
													>Please Login To Give Review</a>

												            <?php 
												        }
										else{		        
?>

                        <form class="blog-details-form" method='post'>
                            <h3 class="details-form-title">post comment</h3>
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
                                            <button class="form-btn" name="review" type="submit">
                                                <i class="icofont-water-drop"></i>
                                                <span>Post your review</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                        
                        
<?php } ?>                        
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                  BLOG DETAILS PART END
        =======================================-->








        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/product-details.css">

<?php include('footer.php') ?>


    </body>
</html>






