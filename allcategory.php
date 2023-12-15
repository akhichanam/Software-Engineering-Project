<?php
session_start();
error_reporting(0);
include('config.php');


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
                <h2>All Categories</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">All Category</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->




        <!--=====================================
                    CATEGORY PART START
        =======================================-->
        <section class="inner-section">
            <div class="container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 justify-content-center">
<?php
$ret=mysqli_query($con,"select * from category order by id asc ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...
    $cd=$row['name'];


?>
                    <div class="col">
                        <div class="category-wrap">
                            <div class="category-media" style="width:150px; height:150px;">
                                    <img loading="lazy" src="admin/category/<?php echo $row['logo'] ?>" alt="category" >
                                    <div class="category-overlay" >
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
                    </div>
<?php } ?>
                </div>
            </div>
        </section>
        <!--=====================================
                    CATEGORY PART END
        =======================================-->








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






