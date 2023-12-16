

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
	$title2=$_POST['title2'];
	$link=$_POST['link'];
	$image1=$_FILES["image1"]["name"];

	if($image1==null){
$sql=mysqli_query($con,"update homeposter1 set title1='$title1',title2='$title2',link='$link' where id='$id' ");
	}
	else{
move_uploaded_file($_FILES["image1"]["tmp_name"],"homeposter/".$_FILES["image1"]["name"]);	$sql=mysqli_query($con,"update homeposter2 set title1='$title1',title2='$title2',link='$link',image='$image1' where id='$id' ");
		
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

$query=mysqli_query($con,"select * from homeposter2 where id='$id' ");
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
<label class="control-label" for="basicinput">Title 2</label>
<div class="controls">
<input type="text"    name="title2"   value="<?php echo htmlentities($row['title2']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Link</label>
<div class="controls">
<input type="text"    name="link"   value="<?php echo htmlentities($row['link']);?>" class="span8 tip" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Current Image</label>
<div class="controls">
<img src="homeposter/<?php echo htmlentities($row['image']);?>" width="200" height="100"> 
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