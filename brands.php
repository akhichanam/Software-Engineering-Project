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
                <h2>All Brands</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->



        <!--=====================================
                    BRAND LIST PART START
        =======================================-->
        <section class="inner-section">
            <div class="container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 isotope-items">
  <?php
$ret=mysqli_query($con,"select * from brand order by name asc ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...
    $cd=$row['name'];


?>                  

                    <div class="col all vegetables">
                        <div class="brand-wrap">
                            <div class="brand-media">
                            <img loading="lazy" src="admin/brands/<?php echo $row['image'] ?>"  alt="brand">
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
                    </div>
<?php } ?>
                </div>
            </div>
        </section>
        <!--=====================================
                    BRAND LIST PART END
        =======================================-->











<?php include('footer.php') ?>


    </body>
</html>






