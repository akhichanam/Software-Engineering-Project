
       <?php 





if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
    $str=  preg_replace("/&&/", '', preg_replace("/pid=/", '', preg_replace("/action=/*", '', $url)));
    echo $str;  
    
    if(isset($_GET['removecontact']))
{


mysqli_query($con,"delete from usercontacts  where userid = '".$_SESSION['id']."' and id='".$_GET['id']."' ");
}
    if(isset($_GET['removeaddress']))
{


mysqli_query($con,"delete from useaddress  where userid = '".$_SESSION['id']."' and id='".$_GET['id']."' ");
}


    
    
    if(isset($_POST['phone']))
{
        if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	$category=$_POST['number'];
	$id=$_POST['id'];
	$type=$_POST['type'];
    $sql=mysqli_query($con,"update usercontacts set type='$type',number='$category' where userid='".$_SESSION['id']."' and id='$id'");




}

    
}

    if(isset($_POST['address']))
{
        if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
    
	$id=$_POST['id'];
	$type=$_POST['type'];
    $pincode=$_POST['pincode'];
	$category=$_POST['addresss1'];

    $sql=mysqli_query($con,"update useaddress set type='$type',address='$category',picode='$pincode' where userid='".$_SESSION['id']."' and id='$id'");



}

    
}

    if(isset($_POST['personal']))
{
        if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
    $pincode=$_POST['name'];
	$category=$_POST['email'];
	$image=$_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],"admin/user/".$_FILES["image"]["name"]);
	
	if($image==null){
$sql=mysqli_query($con,"update user set name='$pincode',email='$category' where id='".$_SESSION['id']."'");
	    
	}
else{
    $sql=mysqli_query($con,"update user set image='$image',name='$pincode',email='$category' where id='".$_SESSION['id']."'");

}

header('location:profile.php');
}

    
}

    
if(isset($_POST['coupon']))
{
    $coupon=$_POST['coupon1'];

$q=mysqli_query($con,"select * from codeused where code='$coupon' and userid='".$_SESSION['id']."' ");
$code=mysqli_num_rows($q);

if($code>0){
    echo "<script>alert('Code is used by you');</script>";
}

else{

$query=mysqli_query($con,"select * from coupon where code='$coupon' ");
$results=mysqli_fetch_array($query);

$percentage=$results['percentage'];
$result1=mysqli_num_rows($query);

if($result1>0){


mysqli_query($con,"insert into codeused(userid,code) values('".$_SESSION['id']."','$coupon')");


mysqli_query($con,"update checkout set coupon='$coupon',percentage='$percentage' where userid='".$_SESSION['id']."'");

}





}
}


if(isset($_POST['contact']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];


mysqli_query($con,"insert into contact(name,email,subject,message) values('$name','$email','$subject','$message')");




}








if(isset($_POST['removecode']))
{


mysqli_query($con,"update checkout set coupon='' where userid='".$_SESSION['id']."'");
mysqli_query($con,"delete from codeused where userid = '".$_SESSION['id']."' ");
}


$pid= $_GET['pid'];
if(isset($_GET['pid']) && $_GET['action']=="compare" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{

mysqli_query($con,"insert into compare(userid,productid) values('".$_SESSION['id']."','$pid')");

}
}

if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{

mysqli_query($con,"insert into wishlist(userid,productid) values('".$_SESSION['id']."','$pid')");

}
}






if(isset($_GET['pid']) && $_GET['action']=="add" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
$pidd=$_GET['pid'];
$userid=$_SESSION['id'];

$query=mysqli_query($con,"select * from cart where userid='$userid' and productid='$pidd' ");

$results=mysqli_fetch_array($query);
$result1=mysqli_num_rows($query);
if($result1==0){

$price=$results['productid'];

$query1=mysqli_query($con,"select * from product where id='$pidd' ");

$price1=mysqli_fetch_array($query1);

$discountprice=$price1['discountprice'];

mysqli_query($con,"insert into cart(productid,userid,quantity,price) values('$pidd','".$_SESSION['id']."','1','$discountprice')");

$query3=mysqli_query($con,"select * from checkout where userid='$userid'");

$userpresent=mysqli_num_rows($query3);
$userpresents=mysqli_fetch_array($query3);

$coupon1=$userpresents['coupon'];

$query4=mysqli_query($con,"select * from coupon where code='$coupon1'");

$userpresents1=mysqli_fetch_array($query4);

$userpresent1=mysqli_num_rows($query4);

$percentdec=0;

if($userpresent1>0){

$percentdec=$userpresents1['percentage'];

}
if($userpresent==0){
mysqli_query($con,"insert into checkout(userid,total) values('".$_SESSION['id']."','$discountprice')");


}
else{

$total=$userpresents['total']+$discountprice;
$total1=(($percentdec/100)*$total);
$total2=$total-$total1;
mysqli_query($con,"update checkout set total='$total' where userid='".$_SESSION['id']."'");


}





}

else{
$price=$results['productid'];

$query1=mysqli_query($con,"select * from product where id='$price' ");

$price1=mysqli_fetch_array($query1);

$discountprice=$price1['discountprice'];

$quantity=$results['quantity']+1;

$pricetotal=$quantity*$discountprice;

    mysqli_query($con,"update cart set quantity='$quantity',price='$pricetotal' where userid='".$_SESSION['id']."' and productid='$price'");


$query2=mysqli_query($con,"select * from cart where userid='$userid' ");

$total=0;
while($checkout=mysqli_fetch_array($query2)){

$total+=$checkout['price'];

mysqli_query($con,"update checkout set total='$total' where userid='".$_SESSION['id']."'");


}



}
}
}






if(isset($_GET['pid']) && $_GET['action']=="removee" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
$pidd=$_GET['pid'];
$userid=$_SESSION['id'];

$query=mysqli_query($con,"select * from cart where userid='$userid' and productid='$pidd' ");

$results=mysqli_fetch_array($query);
$result1=mysqli_num_rows($query);
if($result1==0){




}

else{
$price=$results['productid'];

$query1=mysqli_query($con,"select * from product where id='$price' ");

$price1=mysqli_fetch_array($query1);

$discountprice=$price1['discountprice'];

$quantity=$results['quantity']-1;

$pricetotal=$quantity*$discountprice;

$ca=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."' and productid='$price' ");
$cc=mysqli_fetch_array($ca);
$c=$cc['quantity'];
if($c==1){
    mysqli_query($con,"delete from cart where  userid='".$_SESSION['id']."' and productid='$price'");
$query2=mysqli_query($con,"select * from cart where userid='$userid' ");
$q2=mysqli_query($con,"select * from checkout where userid='$userid' ");
$tt=mysqli_fetch_array($q2);
$total=$tt['total']-$discountprice;

mysqli_query($con,"update checkout set total='$total' where userid='".$_SESSION['id']."'");


}

else{
    mysqli_query($con,"update cart set quantity='$quantity',price='$pricetotal' where userid='".$_SESSION['id']."' and productid='$price'");


$query2=mysqli_query($con,"select * from cart where userid='$userid' ");
$q2=mysqli_query($con,"select * from checkout where userid='$userid' ");
$tt=mysqli_fetch_array($q2);
$total=$tt['total']-$discountprice;

mysqli_query($con,"update checkout set total='$total' where userid='".$_SESSION['id']."'");





}
}
}
}





if(isset($_GET['pid']) && $_GET['action']=="removecart" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
$pidd=$_GET['pid'];
$userid=$_SESSION['id'];

mysqli_query($con,"delete from cart where  productid='$pidd' and userid='$userid'");

$query2=mysqli_query($con,"select * from cart where userid='$userid' ");

$query=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."' ");
$total=0;
while($results=mysqli_fetch_array($query)){

$total+=$results['price'];    
}
mysqli_query($con,"update checkout set total='$total' where userid='".$_SESSION['id']."'");



}
}


























       ?>


        <div class="backdrop"></div>
        <a class="backtop fas fa-arrow-up" href="#"></a>

  <?php
$ret=mysqli_query($con,"select * from coupon order by id asc ");
if ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

        <div class="header-top alert fade show">
            <p><?php echo htmlentities($row['percentage']) ?>% <?php } ?>
<?php
$ret=mysqli_query($con,"select * from coupontitle ");
if ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
             <?php echo htmlentities($row['texttitle']) ?> <a href="register.php"><?php echo htmlentities($row['buttontext']) ?> <?php } ?></a></p>
            <button data-bs-dismiss="alert"><i class="fas fa-times"></i></button>
        </div>


        <!--=====================================
                    HEADER PART START
        =======================================-->
        <header class="header-part">
            <div class="container">
                <div class="header-content">
                    <div class="header-media-group">

                        <button class="header-user">

<?php
$query=mysqli_query($con,"select * from user where id='".$_SESSION['id']."'");
if($row=mysqli_fetch_array($query))
{
?>

                        <img src="admin/user/user.png" alt="user">
<?php } else{
?>
<img src="admin/user/user.png" alt="user">
<?php
}?>

                     </button>
<?php
$ret=mysqli_query($con,"select * from logo ");
if ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                        <a href="index.php"><img src="admin/logo/<?php echo htmlentities($row['logo']);?>" alt="logo"></a>
                        <button class="header-src"><i class="fas fa-search"></i></button>
                    </div>

                    <a href="index.php" class="header-logo">
                        <img src="admin/logo/<?php echo htmlentities($row['logo']);?>" alt="logo">
                    </a>
                                            <?php } ?>
<?php if(strlen($_SESSION['login'])==0)
    {   ?>
                    <a href="register.php" class="header-widget" title="My Account">
                        <img src="images/user.png" alt="user">
                        <span>join</span>
                    </a>
<?php }
else{ ?>
    
                    <a href="profile.php" class="header-widget" title="My Account">

<?php
$query=mysqli_query($con,"select * from user where id='".$_SESSION['id']."'");
if($row=mysqli_fetch_array($query))
{
?>

                        <img src="admin/user/user.png" alt="user">
                        <span><?php echo htmlentities($row['name']);?></span>
                    </a>
                <?php } } ?>                          
                                                    <style>
    .result{
        position: absolute;        
        z-index: 999;
        background: white;
        height: 448px;
        margin-top: 488px;
        box-sizing: border-box;
        width:611px;
        overflow:scroll;
    }
    /* Formatting result items */
    .result p{
        background: white;
        cursor: pointer;
        height:90px;
        margin-top:-10px;
    }
    .result p:hover{
        background: white;
    }
    .result a{
        padding-top:10px;
    }
</style>
<script  src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.header-form input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
                                        <script>
        function closesearch(){
            document.getElementById("searchh").style.display='none';
        }
        function opensearch(){
            document.getElementById("searchh").style.display='block';
        }
    </script>


                    <form class="header-form" action="search-result.php">
                        <input type="text"
                        onkeyup="opensearch(event)" id="sas"   name="product"  autocomplete="off"
                         placeholder="Search anything...">
                        <button><i class="fas fa-search"></i></button>
<div class="result" id="searchh" style="display:none;"  onmouseleave="closesearch(this)"></div >
                                
                    </form>

                    <div class="header-widget-group">
                        <a href="compare.php" class="header-widget" title="Compare List">
                                                         
                            <i class="fas fa-random"></i>
                            <sup><?php
$ret=mysqli_query($con,"select * from compare where userid='".$_SESSION['id']."' group by productid");
$cnt=mysqli_num_rows($ret);
echo $cnt; ?></sup>
                        </a>
                        <a href="wishlist.php" class="header-widget" title="Wishlist">
                            <i class="fas fa-heart"></i>
                            <sup>
                                <?php
$ret1=mysqli_query($con,"select * from wishlist where userid='".$_SESSION['id']."'  group by productid ");
$cnt1=mysqli_num_rows($ret1);
echo $cnt1; ?></sup>
                        </a>
                        <button class="header-widget header-cart" title="Cartlist">
                            <i class="fas fa-shopping-basket"></i>

                                    
                            <sup><?php
$ret2=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."'  ");
$cnt3=0;
while($count=mysqli_fetch_array($ret2)){
$cnt3+=$count['quantity'];
}
echo $cnt3; ?></sup>
                            <span>total price<small>$<?php
$ret3=mysqli_query($con,"select * from checkout where userid='".$_SESSION['id']."'");
$cnt4=mysqli_fetch_array($ret3);
if($cnt4['total']==0){echo '0';}

else{

    if($cnt4['percentage']==null){
echo $cnt4['total'];        
    }

    else{
echo ($cnt4['total']-($cnt4['percentage']/100)*$cnt4['total']); } } ?></small></span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!--=====================================
                    HEADER PART END
        =======================================-->


        <!--=====================================
                    NAVBAR PART START
        =======================================-->
        <nav class="navbar-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-content">
                            <ul class="navbar-list">
                                <?php
$ret=mysqli_query($con,"select * from menumain ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="<?php echo htmlentities($row['link']) ?>"><?php echo htmlentities($row['name']) ?></a>
                        

                                </li>
                        


                            <?php 




                        } ?>
                        
                        
                        
                        <?php if(strlen($_SESSION['login'])==0)
    {   ?>
                                <li class="navbar-item">
                                    <a class="navbar-link" href="login.php">login</a>
                        

                                </li>
<?php }
else{ ?>
    
                                <li class="navbar-item">
                                    <a class="navbar-link" href="logout.php">logout</a>
                        

                                </li>

                <?php  } ?>                          

                            </ul>
                            <?php
$ret=mysqli_query($con,"select * from contactadmin ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <div class="navbar-info-group">
                                <div class="navbar-info">
                                    <i class="icofont-ui-touch-phone"></i>
                                    <p>
                                        <small>call us</small>
                                        <span><?php echo htmlentities($row['phone']) ?></span>
                                    </p>
                                </div>
                                <div class="navbar-info">
                                    <i class="icofont-ui-email"></i>
                                    <p>
                                        <small>email us</small>
                                        <span><?php echo htmlentities($row['email']) ?></span>
                                    </p>
                                </div>
                            </div>
                            
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!--=====================================
                    NAVBAR PART END
        =======================================-->


        <!--=====================================
                CATEGORY SIDEBAR PART START
        =======================================-->
        <aside class="category-sidebar">
            <div class="category-header">
                <h4 class="category-title">
                    <i class="fas fa-align-left"></i>
                    <span>categories</span>
                </h4>
                <button class="category-close"><i class="icofont-close"></i></button>
            </div>
            <ul class="category-list">
<?php
$ret=mysqli_query($con,"select * from category order by subcatcount desc ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...
$ids=$row['id'];

?>            

                <li class="category-item">
                    <a class="category-link dropdown-link" href="#">
                        <img loading="lazy" width="25" height="25" style="margin-right:15px" src='admin/category/<?php echo htmlentities($row['icon']) ?>'>
                        <span><?php echo htmlentities($row['name']) ?></span>
                    </a>
                    <ul class="dropdown-list">
<?php
$ret1=mysqli_query($con,"select * from subcategory where catid='$ids' order by name asc");
while ($row1=mysqli_fetch_array($ret1)) 
{

?>            
                        
                        <li>
                    <a class="category-link dropdown-link" href="subcategory.php?id=<?php echo htmlentities($row1['id']) ?>">
                        <img loading="lazy" width="25" height="25" style="margin-right:15px" src='admin/category/<?php echo htmlentities($row1['icon']) ?>'>
                        <span><?php echo htmlentities($row1['name']) ?></span>
                    </a>
                            </li>
<?php } ?>
                    </ul>
                </li>
<?php } ?>
            </ul>
            <div class="category-footer">
                <p>All Rights Reserved by <a href="unishoppers.com">unishoppers</a></p>
            </div>
        </aside>
        <!--=====================================
                CATEGORY SIDEBAR PART END
        =======================================-->









       
       
       
       

        <!--=====================================
                  CART SIDEBAR PART START
        =======================================-->
        <aside class="cart-sidebar">
            <div class="cart-header">
                <div class="cart-total">
                    <i class="fas fa-shopping-basket"></i>


                    <?php $sql1=mysqli_query($con,"select *,product.id as pid,product.name as pname,product.discountprice as pprice from cart join product on product.id=cart.productid where userid='".$_SESSION['id']."'");


$counter=0;
while($counter1=mysqli_fetch_array($sql1)){
    $counter+=$counter1['quantity'];
}
?>
                    <span>total item (<?php if($counter==null){echo '0';}else{echo $counter;}?>)</span>
                </div>
                <button class="cart-close"><i class="icofont-close"></i></button>
            </div>
            <ul class="cart-list">
<?php $sql=mysqli_query($con,"select *,product.id as pid,product.name as pname,product.discountprice as pprice from cart join product on product.id=cart.productid where userid='".$_SESSION['id']."'");

$counter=mysqli_num_rows($sql);
while($row=mysqli_fetch_array($sql))
{

$ids=$row['productid'];
?>

                <li class="cart-item">
                    <div class="cart-media">

                        <?php $sql1=mysqli_query($con,"select * from productimage where productid='$ids'");
                        $row1=mysqli_fetch_array($sql1) ?>
                        <a href="#"><img src="admin/productimages/<?php echo $row['pid']?>/<?php echo $row1['image']?>" alt="product"></a>

                

                        <button class="cart-delete">                        <a class="cart-delete" href="<?php     
      
    echo $str;   ?>?pid=<?php echo $row['pid']; ?>&&action=removecart"><i class="far fa-trash-alt"></i></a>
</button>


                    </div>
                    <div class="cart-info-group">
                        <div class="cart-info">
                            <h6><a href="product-single.html"><?php echo $row['pname'] ?></a></h6>
                            <p>Unit Price - $<?php echo $row['pprice']; ?></p>
                        </div>
                        <div class="cart-action-group">
                            <div class="product-action">
                                <button class="action-minus" title="Quantity Minus"><a class="" href="<?php    
      
    echo $str;   ?>?pid=<?php echo $row['pid']; ?>&&action=removee"><i class="icofont-minus"></i></a></button>
                                <input class="action-input" title="Quantity Number" value="<?php echo $row['quantity']; ?>" type="text" name="quantity" value="1">
                                <button class="action-plus" title="Quantity Plus"><a class="" href="<?php 
      
    echo $str;   ?>?pid=<?php echo $row['pid']; ?>&&action=add"><i class="icofont-plus"></i></a></button>
                            </div>
                            <h6>$<?php echo $row['pprice']*$row['quantity']; ?></h6>
                        </div>
                    </div>
                </li> 
<?php } ?>

            </ul>
            <div class="cart-footer">
                <button class="coupon-btn">Do you have a coupon code?</button>
             <?php $sql=mysqli_query($con,"select *  from checkout where userid='".$_SESSION['id']."'");
             $results=mysqli_fetch_array($sql);
             $code=$results['coupon'];
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


                <a class="cart-checkout-btn" href="checkout.php">
                    <span class="checkout-label">Proceed to Checkout</span>
                    <span class="checkout-price">$<?php
$ret3=mysqli_query($con,"select * from checkout where userid='".$_SESSION['id']."'");
$cnt4=mysqli_fetch_array($ret3);
if($cnt4['total']==0){echo '0';}

else{

    if($cnt4['percentage']==null){
echo $cnt4['total'];        
    }

    else{
echo ($cnt4['total']-($cnt4['percentage']/100)*$cnt4['total']); } } ?></span>
                </a>
            </div>
        </aside>
        <!--=====================================
                    CART SIDEBAR PART END
        =======================================-->


        <!--=====================================
                  NAV SIDEBAR PART START
        =======================================-->
        <aside class="nav-sidebar">
            <div class="nav-header">
                <a href="index.php"><?php
$ret=mysqli_query($con,"select * from logo ");
if ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                        <img src="admin/logo/<?php echo htmlentities($row['logo']);?>" alt="user">
<?php } ?></a>
                <button class="nav-close"><i class="icofont-close"></i></button>
            </div>
            <div class="nav-content">
                <div class="nav-btn">
<?php if(strlen($_SESSION['login'])==0)
    {   ?>
                    <a href="register.php" class="btn btn-inline">
                        <i class="fa fa-unlock-alt"></i>
                        <span>join here</span>
                    </a>

                    <?php }
else{ ?>
                    <a href="myaccount.php" class="btn btn-inline">
<?php
$query=mysqli_query($con,"select * from user where id='".$_SESSION['id']."'");
if($row=mysqli_fetch_array($query))
{
?>

                        <img src="admin/user/user.png" alt="user">
                        <span><?php echo htmlentities($row['name']);?></span>
                    </a>
<?php } } ?>

                </div>
                <!-- This commentable code show when user login or register -->
                <!-- <div class="nav-profile">
                    <a class="nav-user" href="#"><img src="images/user.png" alt="user"></a>
                    <h4 class="nav-name"><a href="profile.html">Miron Mahmud</a></h4>
                </div> -->

                <ul class="nav-list">
                                <?php
$ret=mysqli_query($con,"select * from menumain ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                                <li>
                                    <a class="nav-link" href="<?php echo htmlentities($row['link']) ?>"><?php echo htmlentities($row['name']) ?></a>
                        

                                </li>
                        


                            <?php 




                        } ?>
                        
 <?php if(strlen($_SESSION['login'])==0)
    {   ?>
                                <li >
                                    <a class="nav-link" href="login.php">login</a>
                        

                                </li>
<?php }
else{ ?>
    
                                <li>
                                    <a class="nav-link" href="logout.php">logout</a>
                        

                                </li>

                <?php  } ?>                          
                </ul>
                <div class="nav-info-group">
                    <div class="nav-info">
                        <i class="icofont-ui-touch-phone"></i>
                        <p>
                            <small>call us</small>

<?php
$ret=mysqli_query($con,"select * from contactadmin ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>                            <span><a style='color:black;' href="mailto:<?php echo htmlentities($row['phone']) ?>"><?php echo htmlentities($row['phone']) ?></a></span>
                        </p>
                    </div>
                    <div class="nav-info">
                        <i class="icofont-ui-email"></i>
                        <p>
                            <small>email us</small>
                            <span><a style='color:black;' href="mailto:<?php echo htmlentities($row['email']) ?>"><?php echo htmlentities($row['email']) ?></a></span>
                        </p>
                    <?php } ?>
                    </div>
                </div>
                <div class="nav-footer">
<?php
$ret=mysqli_query($con,"select * from copyright ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                            <p><?php echo htmlentities($row['text']) ?></a></p>
                        <?php } ?>                </div>
            </div>
        </aside>
        <!--=====================================
                  NAV SIDEBAR PART END
        =======================================-->


        <!--=====================================
                    MOBILE-MENU PART START
        =======================================-->
        <div class="mobile-menu">
            <a href="index.php" title="Home Page">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <button class="cate-btn" title="Category List">
                <i class="fas fa-list"></i>
                <span>category</span>
            </button>
            <button class="cart-btn" title="Cartlist">
                <i class="fas fa-shopping-basket"></i>
                <span>cartlist</span>
                <sup><?php
$ret2=mysqli_query($con,"select * from cart where userid='".$_SESSION['id']."'  ");
$cnt3=0;
while($count=mysqli_fetch_array($ret2)){
$cnt3+=$count['quantity'];
}
echo $cnt3; ?></sup>
            </button>
            <a href="wishlist.php" title="Wishlist">
                <i class="fas fa-heart"></i>
                <span>wishlist</span>
                <sup><?php
$ret1=mysqli_query($con,"select * from wishlist where userid='".$_SESSION['id']."'  group by productid ");
$cnt1=mysqli_num_rows($ret1);
echo $cnt1; ?></sup>
            </a>
            <a href="compare.php" title="Compare List">
                <i class="fas fa-random"></i>
                <span>compare</span>
                <sup><?php
$ret1=mysqli_query($con,"select * from compare where userid='".$_SESSION['id']."'  group by productid ");
$cnt1=mysqli_num_rows($ret1);
echo $cnt1; ?></sup>
            </a>
        </div>
        <!--=====================================
                    MOBILE-MENU PART END
        =======================================-->

<style>
    .whatsapp_float{
        position:fixed;
        bottom:100px;
        z-index:2;
        float:left;
        left:20px;
    }
</style>
<div class="whatsapp_float">
    <?php $sql=mysqli_query($con,"select phone from contactadmin");
if($row=mysqli_fetch_array($sql))
{
    ?>
    <a href="https://wa.me/<?php echo mb_strimwidth($row['phone'],1,13);?>" target="_blank">
        <img src="whatsapp.png" width="50px" height="50px" alt="whatsapp" class="whatsapp_float_btn"/>
    </a>
    <?php }?>
</div>


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