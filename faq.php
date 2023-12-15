<?php
session_start();
error_reporting(0);
include('config.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/faq.css">

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
                <h2>FAQ</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->



        <!--=====================================
                      FAQ PART START
        =======================================-->
        <section class="inner-section faq-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="faq-parent">
  <?php
$ret=mysqli_query($con,"select * from faq order by title asc ");
while ($row=mysqli_fetch_array($ret)) 
{


?>                  

                            <div class="faq-child">
                                <div class="faq-que">
                                    <button><?php echo $row['title']; ?></button>
                                </div>
                                <div class="faq-ans">
                                    <p><?php echo $row['description']; ?></p>
                                </div>
                            </div>
<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                      FAQ PART END
        =======================================-->






<?php include('footer.php') ?>


    </body>
</html>






