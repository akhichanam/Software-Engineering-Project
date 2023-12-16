
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
	$title=$_POST['title'];
	$shortdescription=$_POST['shortdescription'];
	$longdescription=$_POST['longdescription'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update blog set title='$title',shortdescription='$shortdescription',longdescription='$longdescription' where id='$id'");

$_SESSION['msg']="Blog Updated !!";

}

	if(isset($_GET['del1']))
		  {
		          mysqli_query($con,"delete from blogtags where id = '".$_GET['idd']."'");

		  }
		  if(isset($_POST['submit1']))
{
	$name=$_POST['name'];
	$blogid=$_POST['blogid'];
$sql=mysqli_query($con,"insert into blogtags(name,blogid) values('$name','$blogid')");
$_SESSION['msg']="Blog Tag Inserted Successfully !!";




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


						<div class="module">
							<div class="module-head">
								<h3>Edit Blog<button style="float:right;color:red;display:block;" id="open" class="btn" onclick="openForm()"><h3 style="margin-right:2px;color:red;float:right">Add Tag</h3></button>
<button style="float:right;color:green; display:none" id="close" class="btn cancel" onclick="closeForm()"><h3 style="margin-right:2px;color:red;float:right">Close</h3></button></h3>
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


<div class="form-popup" id="myForm">
  <form name="Category" method="post" enctype="multipart/form-data" class="form-container">
									
<div class="control-group">
<label class="control-label" for="basicinput">Tag Name</label>
<div class="controls">
<input type="text" placeholder="Enter Name"  name="name" class="span8 tip" required>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Blog</label>
<div class="controls">
<select name="blogid" class="span8 tip" required>

<?php 

$ids=$_GET['id'];
$query=mysqli_query($con,"select * from blog where id='$ids'");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
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
</script></h3>
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
$query=mysqli_query($con,"select * from blog where id='$id'");
while($row=mysqli_fetch_array($query))

{
	$ids=$row['id'];

?>									
<div class="control-group">
<label class="control-label" for="basicinput">Title</label>
<div class="controls">
<input type="text" placeholder="Enter title"  name="title" value="<?php echo  htmlentities($row['title']);?>" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Short Description</label>
<div class="controls">
    <textarea  name="shortdescription" required placeholder="Enter Description" rows="20" height="20" class="span8 tip"> <?php echo  htmlentities($row['shortdescription']);?></textarea>


</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Image</label>
<div class="controls">
<img src="blog/<?php echo htmlentities($row['image']);?>" width="200" height="100"> <a href="update-blog.php?id=<?php echo $row['id'];?>">Change Image</a>
</div>
</div>

<div class="control-group">
											<label class="control-label" for="basicinput">Description</label>
											<div class="controls">
												<textarea class="span8" name="longdescription" rows="5"><?php echo  htmlentities($row['longdescription']);?></textarea>
											</div>
										</div>

<div class="control-group">
											<label class="control-label" for="basicinput">Tags</label>
											<div class="controls">
										<?php $query1=mysqli_query($con,"select * from blogtags where blogid='$ids'");
$cnt1=1;
while($row1=mysqli_fetch_array($query1))
{
?>									
<?php echo $cnt1; echo '. '; echo $row1['name']; ?>
<a href="edit-blog.php?idd=<?php echo $row1['id']?>&del1=delete&id=<?php echo $id; ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>
											<?php $cnt1++; } ?>

											</div>
										</div>


								<?php } ?>
									

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
    <script src="assets/plugins/ckeditor/ckeditor.js" ></script>
    <script>
        CKEDITOR.replace('shortdescription');
    </script>
    <script>
        CKEDITOR.replace('longdescription');
    </script>


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