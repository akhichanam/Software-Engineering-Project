
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


if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update subcategory1 set catid='$category' where id='$id'");
$_SESSION['msg']="Sub-Category Updated !!";

}
if(isset($_POST['submit2']))
{
	$subcategory1=$_POST['subcategory1'];
	$id=intval($_GET['id']);
$sql1=mysqli_query($con,"update subcategory1 set subcatid='$subcategory1' where id='$id'");
$_SESSION['msg']="Sub-Category Updated !!";

}
if(isset($_POST['submit1']))
{
	$subcat=$_POST['subcategory11'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update subcategory1 set name='$subcat' where id='$id'");
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
								<h3>Edit subcategory1</h3>
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
$query=mysqli_query($con,"select subcategory1.id,category.name as catname,subcategory1.name from subcategory1 join category on category.id=subcategory1.catid where subcategory1.id='$id'");
while($row=mysqli_fetch_array($query))
{
?>		

<div class="control-group">
<label class="control-label" for="basicinput">Category</label>
<div class="controls">
<select name="category" class="span8 tip" required>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($catname=$row['catname']);?></option>
<?php $ret=mysqli_query($con,"select * from category");
while($result=mysqli_fetch_array($ret))
{
echo $cat=$result['name'];
if($catname==$cat)
{
	continue;
}
else{
?>
<option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>
<?php } }?>
</select>
</div>
</div>







									<?php } ?>	

	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>


			<form class="form-horizontal row-fluid" name="subCategory" method="post" >
<?php
$id1=intval($_GET['id']);
$query1=mysqli_query($con,"select subcategory1.id,subcategory.name as catname,subcategory1.name from subcategory1 join subcategory on subcategory.id=subcategory1.subcatid where subcategory1.id='$id1'");
while($row1=mysqli_fetch_array($query1))
{
?>		

<div class="control-group">
<label class="control-label" for="basicinput">Sub Main Category</label>
<div class="controls">
<select name="subcategory1" class="span8 tip" required>
<option value="<?php echo htmlentities($row1['id']);?>"><?php echo htmlentities($catname1=$row1['catname']);?></option>
<?php $ret1=mysqli_query($con,"select * from subcategory");
while($result1=mysqli_fetch_array($ret1))
{
echo $cat1=$result1['name'];
if($catname1==$cat1)
{
	continue;
}
else{
?>
<option value="<?php echo $result1['id'];?>"><?php echo $result1['name'];?></option>
<?php } }?>
</select>
</div>
</div>







									<?php } ?>	

	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit2" class="btn">Update</button>
											</div>
										</div>
									</form>
									
									
												<form class="form-horizontal row-fluid" name="Category" method="post" >
<?php
$id=intval($_GET['id']);
$query=mysqli_query($con,"select * from subcategory1 where subcategory1.id='$id'");
while($row=mysqli_fetch_array($query))
{
?>		




<div class="control-group">
<label class="control-label" for="basicinput">subcategory1 Name</label>
<div class="controls">
<input type="text" placeholder="Enter category Name"  name="subcategory11" value="<?php echo  htmlentities($row['name']);?>" class="span8 tip" required>
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