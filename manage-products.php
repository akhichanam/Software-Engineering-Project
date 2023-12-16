
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

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from product where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }
if(isset($_GET['stock']))
		  {

	$stock=$_GET['stocked'];
	$idd=$_GET['idd'];
$sql=mysqli_query($con,"update product set stock='$stock' where id=$idd ");
$_SESSION['msg']="Updated Successfully !!";

		  }
		  
	
		  

if(isset($_POST['submit1']))
{
	$name=$_POST['name'];
	$blogid=$_POST['blogid'];
$sql=mysqli_query($con,"insert into tags(name,productid) values('$name','$blogid')");
$_SESSION['msg']="Blog Tag Inserted Successfully !!";




}

if(isset($_POST['submit2']))
{
	
	$productid=$_POST['productid'];

	$dir="productimages/$productid/";
if(!is_dir($dir)){
		mkdir("productimages/".$productid);
	}

	foreach($_FILES['productimage']['tmp_name'] as $key=>$image){
$imageTmpName = $_FILES['productimage']['tmp_name'][$key];
        $imageName = $_FILES['productimage']['name'][$key];
        $result = move_uploaded_file($imageTmpName,$dir.$imageName);		
$sql=mysqli_query($con,"insert into productimage(image,productid) values('$imageName','$productid')");

	}

//	move_uploaded_file($_FILES["productimage"]["tmp_name"],"productimages/$productid/".$_FILES["productimage"]["name"]);

$_SESSION['msg']="Image Inserted Successfully !!";




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
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: relative;
  bottom: 0;
  right: 15px;
  border: 3px solid black;
  z-index: 0;
}

/* Add styles to the form container */
.form-container {
  max-width: auto;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 33%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  width:auto;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>


	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('sidebar.php');?>				
			<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
							   <h3 style="float:left;">Manage Products</h3>

							   <h3><a style="margin-right:2px;color:green;float:right;border" href="insertproduct.php">Insert Product</a><button style="float:right;color:red;display:block;" id="open" class="btn" onclick="openForm()"><h3 style="margin-right:2px;color:red;float:right">Add Tag</h3></button>
<button style="float:right;color:green; display:none" id="close" class="btn cancel" onclick="closeForm()"><h3 style="margin-right:2px;color:red;float:right">Close</h3></button></h3>

<div class="form-popup" id="myForm">
  <form name="Category" method="post" enctype="multipart/form-data" class="form-container">
									
<div class="control-group">
<label class="control-label" for="basicinput">Tag Name</label>
<div class="controls">
<input type="text" placeholder="Enter Name"  name="name" class="span8 tip" required>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product</label>
<div class="controls">
<select name="blogid" class="span8 tip" required>
<option value="">Select Product</option> 
<?php $query=mysqli_query($con,"select * from product");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } ?>
</select>
</div>
</div>




	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit1" class="btn">Add</button>
												    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
											</div>
										</div>

									</form></div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("close").style.display="block";
    document.getElementById("open").style.display="none";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("close").style.display="none";
  document.getElementById("open").style.display="block";
}
</script>


</h3>	





					</div>
<button style="float:left;color:red;display:block;" id="open1" class="btn" onclick="openForm1()"><h3 style="margin-right:2px;color:red;float:right">Add Image</h3></button>
<button style="float:left;color:green; display:none" id="close1" class="btn cancel" onclick="closeForm1()"><h3 style="margin-right:2px;color:red;float:right">Close</h3></button></h3>

<div class="form-popup" id="myForm1">
  <form name="Category" method="post" enctype="multipart/form-data" class="form-container">
									

<div class="control-group">
<label class="control-label" for="basicinput">Product</label>
<div class="controls">
<select name="productid" class="span8 tip" required>
<?php $query=mysqli_query($con,"select * from product order by id asc");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['id'];?> <?php echo $row['name'];?></option>
<?php } ?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Image</label>
<div class="controls">
<input type="file" name="productimage[]" multiple required id="productimage" value="" class="span8 tip" onchange="readURL1(this);" >
<img id="blah" src="#" alt="your image" />
<script>
    function readURL1(input) {
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
												<button type="submit" name="submit2" class="btn">Add</button>
												    <button type="button" class="btn cancel" onclick="closeForm1()">Close</button>
											</div>
										</div>

									</form></div>

<script>
function openForm1() {
  document.getElementById("myForm1").style.display = "block";
  document.getElementById("close1").style.display="block";
    document.getElementById("open1").style.display="none";
}

function closeForm1() {
  document.getElementById("myForm1").style.display = "none";
  document.getElementById("close1").style.display="none";
  document.getElementById("open1").style.display="block";
}
</script>


							<div class="module-body table">

	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product Name/Tags</th>
											<th>Brand Name</th>
											<th>Product Creation Date</th>
											<th>Stock Click to Change </th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from product");
$cnt=1;
while($row=mysqli_fetch_array($query))

{
	$ids=$row['id'];
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['name']);?><br/>


											
<?php $query1=mysqli_query($con,"select * from tags where productid='$ids'");
$cnt1=1;
while($row1=mysqli_fetch_array($query1))
{
?>									
<?php echo $cnt1; echo '. '; echo $row1['name']; $cnt1++;?>

											<?php } ?>
											
<?php $query1=mysqli_query($con,"select * from productimage where productid='$ids'");
$cnt1=1;
while($row1=mysqli_fetch_array($query1))
{
?>									
<?php echo $cnt1; echo '. '; echo $row1['image']; $cnt1++;?><br/>

											<?php } ?>
										</td>
											<td><?php echo htmlentities($row['brand']);?></td>
											<td><?php echo htmlentities($row['date']);?></td>
											<td>	

<a href="manage-products.php?idd=<?php echo $row['id']?>&stocked=<?php if($row['stock']=="In Stock"){echo "Out of Stock";}else{echo "In Stock"; }?>&stock=stock" onClick="return confirm('Are you sure you want to change stock?')"><?php echo $row['stock']; ?></a>

</td>
											<td>
											<a href="edit-products.php?id=<?php echo $row['id']?>" target="_blank" ><i class="icon-edit"></i></a>
											<a href="manage-products.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
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