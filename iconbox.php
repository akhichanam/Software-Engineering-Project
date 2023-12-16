
<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$title1=$_POST['title1'];
	$tag1=$_POST['tag1'];
	$title2=$_POST['title2'];
	$tag2=$_POST['tag2'];
	$title3=$_POST['title3'];
	$tag3=$_POST['tag3'];
	$title4=$_POST['title4'];
	$tag4=$_POST['tag4'];
	
	
	
	
$sq1=mysqli_query($con,"update  iconbox set title='$title1',description='$tag1' where id='1' ");
$sql2=mysqli_query($con,"update  iconbox set title='$title2',description='$tag2' where id='2' ");
$sql3=mysqli_query($con,"update  iconbox set title='$title3',description='$tag3' where id='3' ");
$sql4=mysqli_query($con,"update  iconbox set title='$title4',description='$tag4' where id='4' ");
$_SESSION['msg']="Product Updated Successfully !!";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include('sitefavicon.php'); ?>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>About Us</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from iconbox where id='1'");
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Title 1</label>
<div class="controls">
<input type="text"    name="title1"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['title']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Tag 1</label>
<div class="controls">
<input type="text"    name="tag1"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['description']);?>" class="span8 tip" >
</div>
</div>



<?php }?>

<?php 
$query=mysqli_query($con,"select * from iconbox where id='2'");
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Title 2</label>
<div class="controls">
<input type="text"    name="title2"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['title']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Tag 2</label>
<div class="controls">
<input type="text"    name="tag2"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['description']);?>" class="span8 tip" >
</div>
</div>




<?php }?>


<?php 
$query=mysqli_query($con,"select * from iconbox where id='3'");
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Title 3</label>
<div class="controls">
<input type="text"    name="title3"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['title']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Tag 3</label>
<div class="controls">
<input type="text"    name="tag3"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['description']);?>" class="span8 tip" >
</div>
</div>



<?php }?>
<?php 
$query=mysqli_query($con,"select * from iconbox where id='4'");
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Title 4</label>
<div class="controls">
<input type="text"    name="title4"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['title']);?>" class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Tag 4</label>
<div class="controls">
<input type="text"    name="tag4"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['description']);?>" class="span8 tip" >
</div>
</div>





<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
			











							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>