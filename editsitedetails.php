
<?php
session_start();
include('..//config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$title=$_POST['title'];
	$shorttitle=$_POST['shorttitle'];
	$description=$_POST['description'];
$sql=mysqli_query($con,"update logo set id='1',
	title='$title',
	shorttitle='$shorttitle',
	description='$description'
	where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

}


if(isset($_POST['submit1']))
{
	$bankname=$_POST['bankname'];
	$accountname=$_POST['accountname'];
	$accountnumber=$_POST['accountnumber'];
	$ifsc=$_POST['ifsc'];
	$upiid=$_POST['upiid'];
	$branch=$_POST['branch'];
	$statusqr=$_POST['statusqr'];
	$statusbank=$_POST['statusbank'];
	$key_id=$_POST['key_id'];
	$key_secret=$_POST['key_secret'];
	$status=$_POST['status'];
	$gstnumber=$_POST['gstnumber'];
	$gstrate=$_POST['gstrate'];

	
	
	
$sq1=mysqli_query($con,"update  paymentdetails set bankname='$bankname',accountname='$accountname',accountnumber='$accountnumber',ifsc='$ifsc',upiid='$upiid',branch='$branch',statusqr='$statusqr',statusbank='$statusbank',key_id='$key_id',key_secret='$key_secret',status='$status',gstnumber='$gstnumber',gstrate='$gstrate' where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

}

if(isset($_POST['submit2']))
{
	$facebook=$_POST['facebook'];
	$twitter=$_POST['twitter'];
	$instagram=$_POST['instagram'];
	$pinterest=$_POST['pinterest'];
	$linkedin=$_POST['linkedin'];

$sql=mysqli_query($con,"update social set id='1',
	facebook='$facebook',twitter='$twitter',instagram='$instagram',pinterest='$pinterest',linkedin='$linkedin'
	where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

}

if(isset($_POST['submit3']))
{
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$googlemap=$_POST['googlemap'];

$sql=mysqli_query($con,"update contactadmin set 
	email='$email',phone='$phone',address='$address',googlemap='$googlemap'
	where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

}

if(isset($_POST['submit4']))
{
	$text=$_POST['text'];

$sql=mysqli_query($con,"update copyright set 
	text='$text'
	where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

}
if(isset($_POST['submit5']))
{
	$description=$_POST['description'];
	$google=$_POST['google'];
	$appstore=$_POST['appstore'];

$sql=mysqli_query($con,"update download set 
	description='$description',google='$google',appstore='$appstore'
	where id='1' ");
$_SESSION['msg']="Updated Successfully !!";

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
								<h3>Site Front End</h3>
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
$query=mysqli_query($con,"select * from logo");
if($row=mysqli_fetch_array($query))
{
  


?>


<div class="control-group">
<label class="control-label" for="basicinput">Site Title</label>
<div class="controls">
<input type="text"    name="title"  placeholder="Enter  Name" value="<?php echo htmlentities($row['title']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Site Short Title</label>
<div class="controls">
<input type="text"    name="shorttitle"  placeholder="Enter  Name" value="<?php echo htmlentities($row['shorttitle']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Site Title</label>
<div class="controls">
<input type="text"    name="description"  placeholder="Enter  Name" value="<?php echo htmlentities($row['description']);?>" class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Favicon</label>
<div class="controls">
<img src="logo/<?php echo htmlentities($row['favicon']);?>" width="200" height="100"> <a href="update-favicon.php">Change Image</a>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Logo</label>
<div class="controls">
<img src="logo/<?php echo htmlentities($row['logo']);?>" width="200" height="100"> <a href="update-logo.php">Change Image</a>
</div>
</div>
<br/><br/>








<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
<br/>
<br/>
<br/>
<br/>


<h1>Payment Details</h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from paymentdetails");
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Status For Razor</label>
<div class="controls">
<select   name="status"  id="status" class="span8 tip" >
<option value="<?php echo htmlentities($row['status']);?>"><?php if(htmlentities($row['status'])=='1') echo 'ACTIVE';
else echo 'NOT ACTIVE';?></option>
<?php if(htmlentities($row['status']!='1'))
{
echo '<option value="1">ACTIVE</option>';
}
else
{
	echo '<option value="0">NOT ACTIVE</option>';
}
?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Key ID</label>
<div class="controls">
<input type="text"    name="key_id"  placeholder="Enter Name" value="<?php echo htmlentities($row['key_id']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Key Secret</label>
<div class="controls">
<input type="text"    name="key_secret"  placeholder="Enter Name" value="<?php echo htmlentities($row['key_secret']);?>" class="span8 tip" >
</div>
</div>










<div class="control-group">
<label class="control-label" for="basicinput">Status For QR</label>
<div class="controls">
<select   name="statusqr"  id="statusqr" class="span8 tip" >
<option value="<?php echo htmlentities($row['statusqr']);?>"><?php if(htmlentities($row['statusqr'])=='1') echo 'ACTIVE';
else echo 'NOT ACTIVE';?></option>
<?php if(htmlentities($row['statusqr']!='1'))
{
echo '<option value="1">ACTIVE</option>';
}
else
{
	echo '<option value="0">NOT ACTIVE</option>';
}
?>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">QR</label>
<div class="controls">
<img src="payment/<?php echo htmlentities($row['qrcode']);?>" width="200" height="100"> <a href="update-qr.php">Change QR</a>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Status Bank</label>
<div class="controls">
<select   name="statusbank"  id="statusbank" class="span8 tip" >
<option value="<?php echo htmlentities($row['statusbank']);?>"><?php if(htmlentities($row['statusbank'])=='1') echo 'ACTIVE';
else echo 'NOT ACTIVE';?></option>
<?php if(htmlentities($row['statusbank']!='1'))
{
echo '<option value="1">ACTIVE</option>';
}
else
{
	echo '<option value="0">NOT ACTIVE</option>';
}
?>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Bank Name</label>
<div class="controls">
<input type="text"    name="bankname"  placeholder="Enter Name" value="<?php echo htmlentities($row['bankname']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Bank Account Name</label>
<div class="controls">
<input type="text"    name="accountname"  placeholder="Enter Name" value="<?php echo htmlentities($row['accountname']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Bank Account Number</label>
<div class="controls">
<input type="text"    name="accountnumber"  placeholder="Enter Number" value="<?php echo htmlentities($row['accountnumber']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Bank IFSC</label>
<div class="controls">
<input type="text"    name="ifsc"  placeholder="Enter ifsc" value="<?php echo htmlentities($row['ifsc']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">UPI ID</label>
<div class="controls">
<input type="text"    name="upiid"  placeholder="Enter UPI ID" value="<?php echo htmlentities($row['upiid']);?>" class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Branch</label>
<div class="controls">
<input type="text"    name="branch"  placeholder="Enter Location" value="<?php echo htmlentities($row['branch']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">GST Number</label>
<div class="controls">
<input type="text"    name="gstnumber"  placeholder="Enter Name" value="<?php echo htmlentities($row['gstnumber']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">GST Rate</label>
<div class="controls">
<input type="number"    name="gstrate"  placeholder="Enter Name" value="<?php echo htmlentities($row['gstrate']);?>" class="span8 tip" >
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

<h1>Social Media Links</h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from social");
if($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Facebook</label>
<div class="controls">
<input type="text"    name="facebook"  placeholder="Enter  Name" value="<?php echo htmlentities($row['facebook']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Twitter</label>
<div class="controls">
<input type="text"    name="twitter"  placeholder="Enter  Name" value="<?php echo htmlentities($row['twitter']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Instagram</label>
<div class="controls">
<input type="text"    name="instagram"  placeholder="Enter  Name" value="<?php echo htmlentities($row['instagram']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Pinterest</label>
<div class="controls">
<input type="text"    name="pinterest"  placeholder="Enter  Name" value="<?php echo htmlentities($row['pinterest']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Linkedin</label>
<div class="controls">
<input type="text"    name="linkedin"  placeholder="Enter  Name" value="<?php echo htmlentities($row['linkedin']);?>" class="span8 tip" >
</div>
</div>





<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit2" class="btn">Update</button>
											</div>
										</div>
									</form>
<br/>
<br/>
<br/>
<br/>


<h1>Contact Details</h1>


			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from contactadmin");
if($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Email</label>
<div class="controls">
<input type="text"    name="email"  placeholder="Enter  Name" value="<?php echo htmlentities($row['email']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Phone</label>
<div class="controls">
<input type="text"    name="phone"  placeholder="Enter  Name" value="<?php echo htmlentities($row['phone']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Address</label>
<div class="controls">
<input type="text"    name="address"  placeholder="Enter  Name" value="<?php echo htmlentities($row['address']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Google Map</label>
<div class="controls">
<input type="text"    name="googlemap"  placeholder="Enter  Name" value="<?php echo htmlentities($row['googlemap']);?>" class="span8 tip" >
</div>
</div>





<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit3" class="btn">Update</button>
											</div>
										</div>
									</form>


<br/>
<br/>
<br/>
<br/>


<h1>Copyright</h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from copyright");
if($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Copyright</label>
<div class="controls">
<input type="text"    name="text"  placeholder="Enter  Name" value="<?php echo htmlentities($row['text']);?>" class="span8 tip" >
</div>
</div>





<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit4" class="btn">Update</button>
											</div>
										</div>
									</form>



<br/>
<br/>
<br/>
<br/>



<h1>Home Poster 1 Below Slider</h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from homeposter1");
while($row=mysqli_fetch_array($query))
{
  


?>



<div class="control-group">
<label class="control-label" for="basicinput">Image <?php echo $row['id']?></label>
<div class="controls">
<img src="homeposter/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-homeposter1.php?id=<?php echo $row['id'] ?>">Change Image</a>
</div>
</div>









<?php }?>
									</form>




<br/>
<br/>
<br/>
<br/>



<h1>Home Poster 2</h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from homeposter2");
while($row=mysqli_fetch_array($query))
{
  


?>



<div class="control-group">
<label class="control-label" for="basicinput">Image</label>
<div class="controls">
<img src="homeposter/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-homeposter.php">Change Image</a>
</div>
</div>









<?php }?>
									</form>




<br/>
<br/>
<br/>
<br/>

<h1>Shop Poster </h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from shopposter");
while($row=mysqli_fetch_array($query))
{
  


?>



<div class="control-group">
<label class="control-label" for="basicinput">Image</label>
<div class="controls">
<img src="homeposter/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-shopposter.php">Change Image</a>
</div>
</div>









<?php }?>
									</form>




<br/>
<br/>
<br/>
<br/>


<h1>Breadcrum Banner Image</h1>

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from breadcrumbanner");
while($row=mysqli_fetch_array($query))
{
  


?>



<div class="control-group">
<label class="control-label" for="basicinput">Image</label>
<div class="controls">
<img src="breadcrumbanner/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-breadcrumbanner.php">Change Image</a>
</div>
</div>









<?php }?>
									</form>






<br/>
<br/>
<br/>
<br/>


<h1>Downloads</h1>


			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<?php 
$query=mysqli_query($con,"select * from download");
if($row=mysqli_fetch_array($query))
{
  


?>

<div class="control-group">
<label class="control-label" for="basicinput">Description</label>
<div class="controls">
<input type="text"    name="description"  placeholder="Enter  Name" value="<?php echo htmlentities($row['description']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Google Play Store Link</label>
<div class="controls">
<input type="text"    name="google"  placeholder="Enter  Name" value="<?php echo htmlentities($row['google']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">App Store</label>
<div class="controls">
<input type="text"    name="appstore"  placeholder="Enter  Name" value="<?php echo htmlentities($row['appstore']);?>" class="span8 tip" >
</div>
</div>





<?php }?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit5" class="btn">Update</button>
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