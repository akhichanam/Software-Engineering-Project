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
                <h2>Category</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                    $queryprice = mysqli_query($con,"SELECT discountprice FROM product where categoryid='$cid' ");
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

                    $query = "SELECT Count(*) as discountcount,discountprice,id FROM product where categoryid='$cid' group by discountprice ";
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
  var checkbox = document.getElementById("cat11");
  
  // Simulate a click on the checkbox
  checkbox.click();
  
          document.getElementById('v0').value=18;
        document.getElementById('v0').click();
        document.getElementById('v1').click();

};
</script>
                        
                        <div class="shop-widget" style="">
                            <h6 class="shop-widget-title">Filter by Category<a style="float:right;" onclick="open2()">+</a></h6>
                                <ul id="f2" style="" class="shop-widget-list shop-widget-scroll">
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="cat11" class="common_selector categoryy" value="<?php echo $cid; ?>">
<label for="cat11"> <?php echo $cid; ?></label>                                        </div>
                                        <span class="shop-widget-number">()</span>
                                    </li>

                                </ul>


                        </div>
                        
    
    <?php 

    

                    $queryprice = mysqli_query($con,"SELECT subcategoryid FROM product where categoryid='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['subcategoryid']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>

                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Sub Main Category<a style="float:right;" onclick="open3()">+</a></h6>
                                <ul id="f3"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT * FROM product where categoryid='$cid' group by subcategoryid ORDER BY id ASC ";
                    
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check3<?php echo $cnt;?>" class="common_selector subcategoryy" value="<?php echo $row['subcategoryid']; ?>">
<label for="check3<?php echo $cnt;?>"> <?php echo $row['subcategoryid']; ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php
                                        
                                        $id=$row['subcategoryid'];
$ret=mysqli_query($con,"select * from product where subcategoryid='$id' and categoryid='$cid' ");
$num=mysqli_num_rows($ret);

echo $num;

?>)</span>
                                    </li>
									<?php $cnt+=1;} ?>

                                </ul>


                        </div>
                        
  <?php }                     $queryprice = mysqli_query($con,"SELECT brand FROM product where categoryid='$cid' ");
$pricecount=mysqli_num_rows($queryprice);
$pricec=0;
while($r=mysqli_fetch_array($queryprice)){
    if($r['brand']==null){
        
    }
    else{
        $pricec++;
    }
}
if($pricec>0){
//mysqli_num_rows
?>
                        
                        <div class="shop-widget">
                            <h6 class="shop-widget-title">Filter by Brand<a style="float:right;" onclick="open5()">+</a></h6>
                                <ul id="f5"  class="shop-widget-list shop-widget-scroll">
<?php

                    $query = "SELECT * FROM product where  categoryid='$cid' group by brand ORDER BY id ASC ";
                    
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    $cnt=1;
                    foreach($result as $row)
                    {
                    ?>
                                    <li class="check-box">
                                        <div class="shop-widget-content">
                                            <input type="checkbox" id="check5<?php echo $cnt;?>" class="common_selector brand" value="<?php echo $row['brand']; ?>">
<label for="check5<?php echo $cnt;?>"> <?php echo $row['brand']; ?></label>                                        </div>
                                        <span class="shop-widget-number">(<?php
                                        
                                        $id=$row['brand'];
$ret=mysqli_query($con,"select * from product where brand='$id' and categoryid='$cid' ");
$num=mysqli_num_rows($ret);

echo $num;

?>)</span>
                                    </li>
									<?php $cnt+=1;} ?>

                                </ul>


                        </div>
                        
                        
  <?php }                     $queryprice = mysqli_query($con,"SELECT stock FROM product where categoryid='$cid' ");
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

                    $query = "SELECT Count(*) as discountcount,stock,id from product where categoryid='$cid' group by stock ";
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

  <?php }                      ?>

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
<?php $sql11=mysqli_query($con,"select * from product where categoryid='$cid' ");
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
<?php $sql11=mysqli_query($con,"select * from product where categoryid='$cid'");
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
                                        
<?php $sql11=mysqli_query($con,"select * from product where categoryid='$cid' ");
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






