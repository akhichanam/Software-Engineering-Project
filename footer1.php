<?php 

if(isset($_POST['submit']))
{
    

    $email=$_POST['email'];
$sql=mysqli_query($con,"insert into newsletter(email) values('$email')");


}




?>
        <!--=====================================
                    NEWSLETTER PART START
        =======================================-->
                                        <?php
$ret=mysqli_query($con,"select * from newslettertitle ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

        <section class="news-part" style="background: url(admin/homeposter/<?php echo htmlentities($row['image']) ?>) no-repeat center;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5 col-lg-6 col-xl-7">
                        <div class="news-text">

                            <h2><?php echo htmlentities($row['title']) ?></h2>
                            <p><?php echo htmlentities($row['shorttitle']) ?></p>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6 col-xl-5">
                        <form class="news-form" method="post">
                            <input type="text" name="email" placeholder="Enter Your Email Address">
                            <button type="submit" name="submit"><span><i class="icofont-ui-email"></i>Subscribe</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
        <!--=====================================
                    NEWSLETTER PART END
        =======================================-->


        <!--=====================================
                     FOOTER PART START
        =======================================-->
        <footer class="footer-part">
            <div class="container">
                <div class="row">

                    <div class="col-sm-6 col-xl-3">
                        <div class="footer-widget">
                            <?php
$ret=mysqli_query($con,"select * from logo ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <a class="footer-logo" href="#">
                                <img src="admin/logo/<?php echo htmlentities($row['logo']) ?>" alt="logo">
                            </a>
                            <p class="footer-desc"><?php echo htmlentities($row['description']) ?></p>
                        <?php } ?>
                            <?php
$ret=mysqli_query($con,"select * from social ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                            <ul class="footer-social">
                                <li><a class="icofont-facebook" href="<?php echo htmlentities($row['facebook']) ?>"></a></li>
                                <li><a class="icofont-twitter" href="<?php echo htmlentities($row['twitter']) ?>"></a></li>
                                <li><a class="icofont-linkedin" href="<?php echo htmlentities($row['linkedin']) ?>"></a></li>
                                <li><a class="icofont-instagram" href="<?php echo htmlentities($row['instagram']) ?>"></a></li>
                                <li><a class="icofont-pinterest" href="<?php echo htmlentities($row['pinterest']) ?>"></a></li>
                            </ul>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="footer-widget contact">
                            <h3 class="footer-title">contact us</h3>

                            <?php
$ret=mysqli_query($con,"select * from contactadmin ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                            <ul class="footer-contact">
                                <li>
                                    <i class="icofont-ui-email"></i>
                                    <p>
                                        <span><a style='color:black;' href="mailto:<?php echo htmlentities($row['email']) ?>"><?php echo htmlentities($row['email']) ?></a></span>
                                    </p>
                                </li>
                                <li>
                                    <i class="icofont-ui-touch-phone"></i>
                                    <p>
                                        <span><a style='color:black;' href="mailto:<?php echo htmlentities($row['phone']) ?>"><?php echo htmlentities($row['phone']) ?></a></span>
                                    </p>
                                </li>
                                <li>
                                    <i class="icofont-location-pin"></i>
                                    <p><?php echo htmlentities($row['address']) ?></p>
                                </li>
                            </ul>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="footer-widget">
                            <h3 class="footer-title">quick Links</h3>
                            <div class="footer-links">
                                <ul>
                                                                <?php
$ret=mysqli_query($con,"select * from menu1 ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                                    <li><a href="<?php echo htmlentities($row['link']) ?>"><?php echo htmlentities($row['name']) ?></a></li>
                                <?php } ?>
                                </ul>
                                <ul>
                                                                <?php
$ret=mysqli_query($con,"select * from menu2 ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                                    <li><a href="<?php echo htmlentities($row['link']) ?>"><?php echo htmlentities($row['name']) ?></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="footer-widget">
                            <h3 class="footer-title">Download App</h3>
                                                        <?php
$ret=mysqli_query($con,"select * from download ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                            <p class="footer-desc"><?php echo htmlentities($row['description']) ?></p>
                            <div class="footer-app">
                                <a href="<?php echo htmlentities($row['google']) ?>"><img src="google-store.png" alt="google"></a>
                                <a href="<?php echo htmlentities($row['appstore']) ?>"><img src="app-store.png" alt="app"></a>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom">
                                  <?php
$ret=mysqli_query($con,"select * from copyright ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

                            <p class="footer-copytext"><?php echo htmlentities($row['text']) ?></a></p>
                        <?php } ?>
                            <div class="footer-card">
                                <a style='color:black;' href="#">QR Code</a>
                                <a style='color:black;' href="#">Bank Transfer</a>
                                <a style='color:black;' href="#">Online</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--=====================================
                      FOOTER PART END
        =======================================-->
        

        <!--=====================================
                    JS LINK PART START
        =======================================-->
        <!-- VENDOR -->
        <script  src="vendor/bootstrap/jquery-1.12.4.min.js"></script>
        <script  src="vendor/bootstrap/popper.min.js"></script>
        <script  src="vendor/bootstrap/bootstrap.min.js"></script>
        <script  src="vendor/countdown/countdown.min.js"></script>
        <script  src="vendor/niceselect/nice-select.min.js"></script>
        <script  src="vendor/slickslider/slick.min.js"></script>
        <script  src="vendor/venobox/venobox.min.js"></script>

        <!-- CUSTOM -->
        <script src="js/nice-select.js"></script>
<?php include('js/countdown.php');
?>        <script src="js/accordion.js"></script>
        <script src="js/venobox.js"></script>
        <script src="js/slick.js"></script>
        <script src="js/main.js"></script> 
        <!--=====================================
                    JS LINK PART END
        =======================================-->
