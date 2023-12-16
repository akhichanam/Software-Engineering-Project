

<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$id=1;
if(isset($_POST['submit']))
{
	$title1=$_POST['title1'];
	$description1=$_POST['description1'];
	$title2=$_POST['title2'];
	$image1=$_FILES["image1"]["name"];
	$title3=$_POST['title3'];
	$description2=$_POST['description2'];
	$image2=$_FILES["image2"]["name"];
	$title4=$_POST['title4'];
	$description3=$_POST['description3'];
	$image3=$_FILES["image3"]["name"];
	$title5=$_POST['title5'];
	$description4=$_POST['description4'];
	$image4=$_FILES["image4"]["name"];
	$title6=$_POST['title6'];
	$description5=$_POST['description5'];
move_uploaded_file($_FILES["image1"]["tmp_name"],"aboutus/".$_FILES["image1"]["name"]);
move_uploaded_file($_FILES["image2"]["tmp_name"],"aboutus/".$_FILES["image2"]["name"]);
move_uploaded_file($_FILES["image3"]["tmp_name"],"aboutus/".$_FILES["image3"]["name"]);
move_uploaded_file($_FILES["image4"]["tmp_name"],"aboutus/".$_FILES["image4"]["name"]);

	if($image1==null){
$sql=mysqli_query($con,"update aboutus set title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',title6='$title6',description1='$description1',description2='$description2',description3='$description3',description4='$description4',description5='$description5' where id='$id' ");
	}
	else{

	$sql=mysqli_query($con,"update aboutus set title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',description1='$description1',description2='$description2',description3='$description3',description4='$description4',description5='$description5',image1='$image1',image2='$image2',image3='$image3',image4='$image4' where id='$id' ");
		
	}

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
								<h3>Update Image</h3>
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

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select * from aboutus where id='$id' ");
$cnt=1;
if($row=mysqli_fetch_array($query))
{
  


?>


<div class="control-group">
<label class="control-label" for="basicinput">Title 1</label>
<div class="controls">
<input type="text"    name="title1"   value="<?php echo htmlentities($row['title1']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Description 1</label>
<div class="controls">
<input type="text"    name="description1"   value="<?php echo htmlentities($row['description1']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Title 2</label>
<div class="controls">
<input type="text"    name="title2"   value="<?php echo htmlentities($row['title2']);?>" class="span8 tip" >
</div>
</div>



<div class="control-group" >
<label class="control-label" for="basicinput">Current Image 1</label>
<div class="controls">
<img src="aboutus/<?php echo htmlentities($row['image1']);?>" width="200" height="100"> 
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">New Image</label>
<div class="controls">
<input type="file" name="image1" id="image1" value="" class="span8 tip" onchange="readURL(this);" >
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

<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Title 3</label>
<div class="controls">
<input type="text"    name="title3"   value="<?php echo htmlentities($row['title3']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Description 2</label>
<div class="controls">
<input type="text"    name="description2"   value="<?php echo htmlentities($row['description2']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Current Image 2</label>
<div class="controls">
<img src="aboutus/<?php echo htmlentities($row['image2']);?>" width="200" height="100"> 
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">New Image</label>
<div class="controls">
<input type="file" name="image2" id="image2" value="" class="span8 tip" onchange="readURL1(this);" >
<img id="blah1" src="#" alt="your image" />
<script>
    function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah1').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</div>
</div>










<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Title 4</label>
<div class="controls">
<input type="text"    name="title4"   value="<?php echo htmlentities($row['title4']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Description 3</label>
<div class="controls">
<input type="text"    name="description3"   value="<?php echo htmlentities($row['description3']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Current Image 3</label>
<div class="controls">
<img src="aboutus/<?php echo htmlentities($row['image3']);?>" width="200" height="100"> 
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">New Image</label>
<div class="controls">
<input type="file" name="image3" id="image3" value="" class="span8 tip" onchange="readURL2(this);" >
<img id="blah2" src="#" alt="your image" />
<script>
    function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah2').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</div>
</div>

<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Title 5</label>
<div class="controls">
<input type="text"    name="title5"   value="<?php echo htmlentities($row['title5']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Description 4</label>
<div class="controls">
<input type="text"    name="description4"   value="<?php echo htmlentities($row['description4']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Current Image 4</label>
<div class="controls">
<img src="aboutus/<?php echo htmlentities($row['image4']);?>" width="200" height="100"> 
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">New Image</label>
<div class="controls">
<input type="file" name="image4" id="image4" value="" class="span8 tip" onchange="readURL3(this);" >
<img id="blah3" src="#" alt="your image" />
<script>
    function readURL3(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah3').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</div>
</div>


<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Title 6</label>
<div class="controls">
<input type="text"    name="title6"   value="<?php echo htmlentities($row['title6']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group" style="display:none;">
<label class="control-label" for="basicinput">Description 5</label>
<div class="controls">
<input type="text"    name="description5"   value="<?php echo htmlentities($row['description5']);?>" class="span8 tip" >
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