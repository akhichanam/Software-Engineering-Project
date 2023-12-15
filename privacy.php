<?php
session_start();
error_reporting(0);
include('config.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/privacy.css">

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
                <h2>Privacy</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Privacy</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->







        <!--=====================================
                    PRIVACY PART START
        =======================================-->
        <section class="inner-section privacy-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <nav class="nav nav-pills flex-column" id="scrollspy">
                              <?php
$ret=mysqli_query($con,"select * from privacy ");
while ($row=mysqli_fetch_array($ret)) 
{

?>

                            <a class="nav-link" href="#item-<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
<?php } ?>
                        </nav>
                    </div>
                    
                    <div class="col-lg-9">
                        <div data-bs-spy="scroll" data-bs-target="#scrollspy" data-bs-offset="0" tabindex="0">
                              <?php
$ret1=mysqli_query($con,"select * from privacy ");
while ($row11=mysqli_fetch_array($ret1)) 
{

?>
<div id="item-<?php echo $row11['id']; ?>"></div>
                            <div class="scrollspy-content" >
                                <h3><?php echo $row11['title']; ?></h3>
                                <p><?php echo $row11['description']; ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    PRIVACY PART END
        =======================================-->






<?php include('footer.php') ?>


    </body>
</html>






