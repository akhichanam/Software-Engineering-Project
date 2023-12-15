<?php
session_start();
error_reporting(0);
include('config.php');

$pid= $_GET['pid'];



if(isset($_GET['pid']) && $_GET['action']=="remove" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
$pid= $_GET['pid'];

mysqli_query($con,"delete from wishlist where  productid='".$_GET['pid']."'");
echo "<script>alert('Product removed from wishlist');</script>";

}
}





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


         <?php 
$query=mysqli_query($con,"select * from breadcrumbanner where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

        <section class="inner-section single-banner" style="background: url(admin/breadcrumbanner/<?php echo htmlentities
        ($row['image']) ?>) no-repeat center;">
        <?php } ?>
            <div class="container">
                <h2>wishlist list</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">wishlist</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->


        <!--=====================================
                    COMPARE PART START
        =======================================-->
        <section class="inner-section wishlist-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-scroll">
                            <table class="table-list">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">status</th>
                                        <th scope="col">shopping</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
$query=mysqli_query($con,"select *,product.id as pid,product.name as pname,product.discountprice as pprice,product.brand as pbrand,product.stock as pstock,product.new as pnew,product.actualprice as pactualprice,product.sku as psku, product.brand as pbrand,product.shortdescription as pshortdescription from wishlist join product on product.id=wishlist.productid where userid='".$_SESSION['id']."' group by productid");
$cnt=1;
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
                                        <td class="table-desc"><p><?php echo mb_strimwidth($row['shortdescription'],0,50,'....');?><a href="product-details.php?pid=<?php echo $row['pid'] ?>">read more</a></p></td>

                                        <td class="table-status"><h6 class="<?php if($row['pstock']=='In Stock'){echo "stock-in";}else{echo "stock-out";} ?>"><?php if($row['pstock']=='In Stock'){echo "stock-in";}else{echo "stock-out";} ?></h6></td>
                                        <td class="table-shop">
                                
                                    
                                    <a class="product-add"href="wishlist.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add to cart</span>
</a>
                                
                                            
                                        </td>
                                        <td class="table-action">
                                            <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view<?php echo $row['pid']?>"><i class="fas fa-eye"></i></a>
                                            <a class="wish" href="wishlist.php?pid=<?php echo htmlentities($row['pid'])?>&&action=remove" title="Remove from Wishlist"><i class="icofont-trash"></i></a>
                                        </td>
                                    </tr>

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
                                    <div class="view-label-group">
                                            <?php if($row['new']==1){echo '<label class="view-label new">new</label>';}else{}?>

                                        <label class="view-label off"><?php $discount=(($row['pprice']/$row['pactualprice'])*100)-100; echo intval($discount); echo "%"; ?></label>
                                    </div>
                                    <ul class="preview-slider slider-arrow"> 

<?php 
$ids1=$row['pid'];
$query2=mysqli_query($con,"select * from productimage where productid='$ids1'");

while($row2=mysqli_fetch_array($query2))
{
    ?>                                     
                                        <li><img src="admin/productimages/<?php echo $ids1?>/<?php echo $row2['image']?>" alt="product"></li>
                                    <?php } ?>
                                    </ul>
                                    <ul class="thumb-slider">
<?php $ids2=$row['pid'];
$query3=mysqli_query($con,"select * from productimage where productid='$ids2'");

while($row3=mysqli_fetch_array($query3))
{
    ?>                                     
                                        <li><img src="admin/productimages/<?php echo $ids?>/<?php echo $row3['image']?>" alt="product"></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="view-details">
                                    <h3 class="view-name">
                                        <a href="product-details.php?pid=<?php echo $row['pid']?>"><?php echo $row['pname']; ?></a>
                                    </h3>
                                    <div class="view-meta">
                                        <p>SKU:<span><?php echo $row['psku']; ?></span></p>
                                        <p>BRAND:<a href="#"><?php echo $row['pbrand']; ?></a></p>
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
                                        <a href="product-details.php?pid=<?php echo $ids;?>">(<?php echo $totalrate;?> reviews)</a>
                                    </div>
                                    <h3 class="view-price">
                                        <del>$<?php echo $row['pactualprice']; ?></del>
                                        <span>$<?php echo $row['pprice']; ?></span>
                                    </h3>
                                    <p class="view-desc"><?php echo $row['pshortdescription']; ?></p>
                                    <div class="view-list-group">
                                        <label class="view-list-title">tags:</label>
                                        <ul class="view-tag-list">
<?php $ids3=$row['pid'];
$query4=mysqli_query($con,"select * from tags where productid='$ids3'");

while($row4=mysqli_fetch_array($query4))
{
    ?>                                     
                                            <li><a href="#"><?php echo $row4['name'] ?></a></li>
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
                                    <a class="product-add"href="wishlist.php?pid=<?php echo $row['pid']; ?>&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>
                                    </div>
                                    <div class="view-action-group">
                                            <a class="wish" href="wishlist.php?pid=<?php echo htmlentities($row['pid'])?>&&action=wishlist" title="Add to Wishlist"><i class="icofont-heart"></i></a>
                                            <a class="wish" href="wishlist.php?pid=<?php echo htmlentities($row['pid'])?>&&action=compare" title="Add to Wishlist"><i class="icofont-random"></i></a>
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

                                <?php $cnt++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!--=====================================
                    COMPARE PART END
        =======================================-->













<?php include('footer.php') ?>


    </body>
</html>






