
<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from blogtags where blogid = '".$_GET['id']."'");

		          mysqli_query($con,"delete from blog where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Category deleted !!";
		  }


if(isset($_POST['submit']))
{
	$title=$_POST['title'];
	$shortdescription=$_POST['shortdescription'];
	$longdescription=$_POST['longdescription'];
	$image=$_FILES["image"]["name"];

	move_uploaded_file($_FILES["image"]["tmp_name"],"blog/".$_FILES["image"]["name"]);
$sql=mysqli_query($con,"insert into blog(image,title,shortdescription,longdescription) values('$image','$title','$shortdescription','$longdescription')");
$_SESSION['msg']="Blog Inserted Successfully !!";




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
								<h3>Add Blog</h3>
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



<div class="control-group">
<label class="control-label" for="basicinput">Title</label>
<div class="controls">
<input type="text"    name="title"  placeholder="Enter Name" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Short Description</label>
<div class="controls">
<textarea  name="shortdescription" required placeholder="Enter Description" rows="20" height="20" class="span8 tip"></textarea>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Long Description</label>
<div class="controls">
<textarea  name="longdescription" required placeholder="Enter Description" rows="20" height="20" class="span8 tip"></textarea>

</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Image</label>
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
												<button type="submit" name="submit" class="btn">Add</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						



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
								<h3>Manage Blog <button style="float:right;color:red;display:block;" id="open" class="btn" onclick="openForm()"><h3 style="margin-right:2px;color:red;float:right">Add Tag</h3></button>
<button style="float:right;color:green; display:none" id="close" class="btn cancel" onclick="closeForm()"><h3 style="margin-right:2px;color:red;float:right">Close</h3></button></h3>

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
<option value="">Select Blog</option> 
<?php $query=mysqli_query($con,"select * from blog");
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
</script>
</h3>

							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Title/Date/Tags</th>
											<th>Short Description</th>
											<th>Long Description</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

<?php $query=mysqli_query($con,"select * from blog");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
	$ids=$row['id'];
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['title']);?><br/><?php echo htmlentities($row['date']);?><br/>
<?php $query1=mysqli_query($con,"select * from blogtags where blogid='$ids'");
$cnt1=1;
while($row1=mysqli_fetch_array($query1))
{
?>									
<?php echo $cnt1; echo '. '; echo $row1['name']; $cnt1++;?>

											<?php } ?>
											</td>
											<td><?php 
							echo str_replace('<img','<img style="border:2px solid #F92400;padding:1px 1px 1px 1px"',str_replace('<table','<br/><table style="border:2px solid black; padding:4px 4px 4px 4px;"',str_replace('<td','<td style="border:1px solid black; padding:4px 4px 4px 4px;"',$row['shortdescription'])));?></td>
											<td> <?php 
							echo str_replace('<img','<img style="border:2px solid #F92400;padding:1px 1px 1px 1px"',str_replace('<table','<br/><table style="border:2px solid black; padding:4px 4px 4px 4px;"',str_replace('<td','<td style="border:1px solid black; padding:4px 4px 4px 4px;"',$row['longdescription'])));?></td>
											<td><img src="blog/<?php echo htmlentities($row['image']);?>" width="50" height="50" ></td>
											<td>
        											<a href="edit-blog.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>

											<a href="blog.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
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