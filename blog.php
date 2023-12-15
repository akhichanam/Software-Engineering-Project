<?php
session_start();
error_reporting(0);
include('config.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/contact.css">

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
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->

        <!--=====================================
                    BLOG GRID PART START
        =======================================-->
        <section class="inner-section blog-grid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        

                        <div class="row">
<?php
$ret=mysqli_query($con,"select * from blog order by id asc ");
while ($row=mysqli_fetch_array($ret)) 
{


?>
                            <div class="col-md-6 col-lg-6">
                                <div class="blog-card">
                                    <div class="blog-media">
                                        <a class="blog-img" href="#">
                                        <img loading="lazy" src="admin/blog/<?php echo $row['image'] ?>"  alt="blog">
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
                                    <a class="blog-btn" href="blog-details.php?blogid=<?php echo $row['id'] ?>">
                                        <span>read more</span>
                                        <i class="icofont-arrow-right"></i>
                                    </a>

                                    </div>
                                </div>
                            </div>
<?php } ?>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    BLOG GRID PART END
        =======================================-->








<?php include('footer.php') ?>


    </body>
</html>






