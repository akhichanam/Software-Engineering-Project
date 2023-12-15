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
                <h2>OFFer</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Offer</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->








        <!--=====================================
                     OFFER PART START
        =======================================-->
        <section class="inner-section offer-part">
            <div class="container">
                <div class="row justify-content-center">
                    <?php
$ret=mysqli_query($con,"select * from coupon order by code asc");
$cnt12=0;
while ($row=mysqli_fetch_array($ret)) 
{


?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="offer-card" >
                            <a href="#"><img src="admin/coupon/<?php echo $row['image']?>" alt="offer"></a>
                            <div class="offer-div">
                                <h5 class="offer-code<?php echo $cnt12 ?>"><?php echo $row['code']?></h5>
                                <button class="offer-select" onclick="copyCode<?php echo $cnt12 ?>();">copy</button>
                                <script type="text/javascript">
		function copyCode<?php echo $cnt12 ?>() {
			/* Get the code element */
			var code = document.querySelector('.offer-div .offer-code<?php echo $cnt12 ?>');

			/* Create a temporary input element */
			var tempInput = document.createElement('input');

			/* Set the value of the input element to the code */
			tempInput.value = code.textContent;

			/* Append the input element to the document */
			document.body.appendChild(tempInput);

			/* Select the text in the input element */
			tempInput.select();

			/* Copy the selected text to the clipboard */
			document.execCommand('copy');

			/* Remove the input element from the document */
			document.body.removeChild(tempInput);

			/* Alert the user that the code has been copied */
			alert('Code copied!');
			
		}
	</script>

                            </div>
                        </div>
                    </div>
                   <?php $cnt12++; } ?> 
                </div>
            </div>
        </section>
        <!--=====================================
                     OFFER PART END
        =======================================-->





<?php include('footer.php') ?>


    </body>
</html>






