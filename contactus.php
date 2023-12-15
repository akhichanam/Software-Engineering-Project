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
                <h2>About Us</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->



        <!--=====================================
                    CONTACT PART START
        =======================================-->
        <section class="inner-section contact-part">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="contact-card">
                            <i class="icofont-location-pin"></i>
                            <h4>Shop</h4>
  <?php 
$query=mysqli_query($con,"select * from contactadmin where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>
<p><?php echo htmlentities
        ($row['address']) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="contact-card active">
                            <i class="icofont-phone"></i>
                            <h4>phone number</h4>
                            <p>
                                <a href="tel:<?php echo htmlentities
        ($row['phone']) ?>"><?php echo htmlentities
        ($row['phone']) ?></a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="contact-card">
                            <i class="icofont-email"></i>
                            <h4>Support mail</h4>
                            <p>
                                <a href="<?php echo htmlentities
        ($row['email']) ?>"><?php echo htmlentities
        ($row['email']) ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-map">
                            <iframe src="<?php echo htmlentities
        ($row['googlemap']) ?>" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="col-lg-6">
                        <form class="contact-form" method="post">
                            <h4>Drop Your Thoughts</h4>
                            <div class="form-group">
                                <div class="form-input-group">
                                    <input class="form-control" name="name" type="text" placeholder="Your Name">
                                    <i class="icofont-user-alt-3"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input-group">
                                    <input class="form-control" name="email" type="text" placeholder="Your Email">
                                    <i class="icofont-email"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input-group">
                                    <input class="form-control" name="subject" type="text" placeholder="Your Subject">
                                    <i class="icofont-book-mark"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input-group">
                                    <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                                    <i class="icofont-paragraph"></i>
                                </div>
                            </div>
                            <button type="submit" name="contact" class="form-btn-group">
                                <i class="fas fa-envelope"></i>
                                <span>send message</span>
                            </button>
                        </form>
                    </div>
                </div>
                

            </div>
        </section>
        <!--=====================================
                    CONTACT PART END
        =======================================-->







<?php include('footer.php') ?>


    </body>
</html>






