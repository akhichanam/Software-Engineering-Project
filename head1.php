<?php
session_start();
error_reporting(0);
include('config.php');
$uip=$_SERVER['REMOTE_ADDR'];
$sql=mysqli_query($con,"insert into visitor(visitorip) values('$uip')");
?>

        <!--=====================================
                    META TAG PART START
        =======================================-->
        <!-- REQUIRE META -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- AUTHOR META -->
        <meta name="author" content="unishoppers">
        <meta name="email" content="support@unishoppers.com">

<meta name="description" content="unishoppers">
        <!--=====================================
                    META-TAG PART END
        =======================================-->
                                    <?php
$ret=mysqli_query($con,"select * from logo ");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>

        <!-- TEMPLATE META -->
        <meta name="name" content="<?php echo htmlentities($row['title']) ?>">
        <meta name="title" content="<?php echo htmlentities($row['title']) ?> - <?php echo htmlentities($row['shorttitle']) ?>">
        <meta name="keywords" content="<?php echo htmlentities($row['description']) ?>">


        <!-- WEBPAGE TITLE -->
        <title><?php echo htmlentities($row['title']) ?> - <?php echo htmlentities($row['shorttitle']) ?></title>

        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FAVICON -->
        <link rel="icon" href="admin/logo/<?php echo htmlentities($row['favicon']) ?>">
<?php } ?>

        <!-- FONTS -->
        <link rel="stylesheet" href="fonts/flaticon/flaticon.css">
        <link rel="stylesheet" href="fonts/icofont/icofont.min.css">
        <link rel="stylesheet" href="fonts/fontawesome/fontawesome.min.css">

        <!-- VENDOR -->
        <link rel="stylesheet" href="vendor/venobox/venobox.min.css">
        <link rel="stylesheet" href="vendor/slickslider/slick.min.css">
        <link rel="stylesheet" href="vendor/niceselect/nice-select.min.css">
        <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">

        <!-- CUSTOM -->
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/home-standard.css">
        <!--=====================================
                    CSS LINK PART END
        =======================================-->


