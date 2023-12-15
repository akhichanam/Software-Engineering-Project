<?php
session_start();
error_reporting(0);
include('config.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/about.css">

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
                <h2>About Us</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->


         <?php 
$query=mysqli_query($con,"select * from aboutus where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

        <!--=====================================
                     ABOUT PART START
        =======================================-->
        <section class="inner-section about-company">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h2><?php echo htmlentities
        ($row['title1']) ?></h2>
                            <p><?php echo htmlentities
        ($row['description1']) ?></p>
                        </div>
                        <?php } ?>

                        <ul class="about-list">
                            <li>
                                <h3>         <?php 
$query1=mysqli_query($con,"select * from user");
echo mysqli_num_rows($query1);
?>
</h3>
                                <h6>registered users</h6>
                            </li>
                            <li>
                                <h3><?php 
$query1=mysqli_query($con,"select * from visitor");
echo mysqli_num_rows($query1);
?></h3>
                                <h6>Total visitors</h6>
                            </li>
                            <li>
                                <h3><?php 
$query1=mysqli_query($con,"select * from product");
echo mysqli_num_rows($query1);
?></h3>
                                <h6>total products</h6>
                            </li>
                        </ul>
                    </div>
         <?php 
$query=mysqli_query($con,"select * from aboutus where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="admin/aboutus/<?php echo htmlentities
        ($row['image1']) ?>" alt="about">
                            <img src="admin/aboutus/<?php echo htmlentities
        ($row['image2']) ?>" alt="about">
                            <img src="admin/aboutus/<?php echo htmlentities
        ($row['image3']) ?>" alt="about">
                            <img src="admin/aboutus/<?php echo htmlentities
        ($row['image4']) ?>" alt="about">
                        </div>
                    </div>
                                            <?php } ?>

                </div>
            </div>
        </section>
        <!--=====================================
                    ABOUT PART END
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






