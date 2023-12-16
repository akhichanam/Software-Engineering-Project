
<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

	$id=intval($_GET['id']);

if(isset($_POST['submit']))
{
    
    $query1=mysqli_query($con,"select * from subcategory where id='$id' ");
	
	$q=mysqli_fetch_array($query1);
	$q1=$q['catid'];
    $query2=mysqli_query($con,"select * from category where id='$q1' ");
	$q2=mysqli_fetch_array($query2);
	$q3=$q2['subcatcount'];
	$q4=$q3-1;
	
	
	
$sql1=mysqli_query($con,"update category set subcatcount='$q4' where id='$q1'");


    
	$category=$_POST['category'];
	$id=intval($_GET['id']);
	
		$query3=mysqli_query($con,"select * from subcategory where catid='$category' ");
	
	$q5=mysqli_num_rows($query3);
	$q5+=1;
$sql1=mysqli_query($con,"update category set subcatcount='$q5' where id='$category'");


	
$sql=mysqli_query($con,"update subcategory set catid='$category' where id='$id'");
$_SESSION['msg']="Sub-Category Updated !!";

}
if(isset($_POST['submit1']))
{
	$subcat=$_POST['subcategory1'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update subcategory set name='$subcat' where id='$id'");
$_SESSION['msg']="Sub-Category Updated !!";

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
								<h3>Edit SubCategory</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<br />
									
												<form class="form-horizontal row-fluid" name="Category" method="post" >
<?php
$id=intval($_GET['id']);
$query=mysqli_query($con,"select * from subcategory where subcategory.id='$id'");
while($row=mysqli_fetch_array($query))
{
?>		




<div class="control-group">
<label class="control-label" for="basicinput">SubCategory Name</label>
<div class="controls">
<input type="text" placeholder="Enter category Name"  name="subcategory1" value="<?php echo  htmlentities($row['name']);?>" class="span8 tip" required>
</div>
</div>

									<?php } ?>	

	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit1" class="btn">Update</button>
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