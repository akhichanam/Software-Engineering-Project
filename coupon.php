
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

if(isset($_POST['submit1']))
{
	$texttitle=$_POST['texttitle'];
	$buttontext=$_POST['buttontext'];
	
$sql=mysqli_query($con,"update  coupontitle set texttitle='$texttitle',buttontext='$buttontext' where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

}


if(isset($_POST['submit']))
{
	$code=$_POST['code'];
	$name=$_POST['name'];
	$percentage=$_POST['percentage'];
	$image=$_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],"coupon/".$_FILES["image"]["name"]);

$sql=mysqli_query($con,"insert into coupon(code,name,percentage,image) values('$code','$name','$percentage','$image')");
$_SESSION['msg']="Coupon Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from coupon where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Coupon deleted !!";
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
								<h3>Coupons</h3>
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
$query=mysqli_query($con,"select * from coupontitle");
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Title </label>
<div class="controls">
<input type="text"    name="texttitle"  placeholder="Enter Title" value="<?php echo htmlentities($row['texttitle']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Button Title</label>
<div class="controls">
<input type="text"    name="buttontext"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['buttontext']);?>" class="span8 tip" >
</div>
</div>



<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit1" class="btn">Update</button>
											</div>
										</div>
									</form>
<br/>
<br/>
<br/>
<br/>




			<form class="form-horizontal row-fluid" name="Category" method="post" enctype="multipart/form-data" >
									
<div class="control-group">
<label class="control-label" for="basicinput">Coupon Code</label>
<div class="controls">
<input type="text" placeholder="Enter Coupon Code Like PRWW1B2L7B"  name="code" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Coupon Name</label>
<div class="controls">
<input type="text" placeholder="Enter Coupon Name Like Register"  name="name" class="span8 tip" required>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Coupon Discount %</label>
<div class="controls">
<input type="number" placeholder=""  name="percentage"  class="span8 tip" required>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Coupon Image</label>
<div class="controls">
<input type="file" name="image" id="image" value="" class="span8 tip" required onchange="readURL(this);" >
<img id="blah" src="#" alt="your image" />
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</div>
</div>




	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Create</button>
											</div>
										</div>

									</form>
							</div>
						</div>


	<div class="module">
							<div class="module-head">
								<h3>Manage Coupons</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Coupon Code</th>
											<th>Coupon Name</th>
											<th>Coupon Image</th>
											<th>Percentage %</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from coupon");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['code']);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['percentage']);?></td>

<td>
	<img src="coupon/<?php echo htmlentities($row['image']);?>">
</td>
											<td>
											<a href="coupon.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>									</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
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