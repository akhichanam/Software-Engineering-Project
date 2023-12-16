
<?php
session_start();
include('../config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$pid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$actualprice = $_POST['actualprice'];
	$discountprice = $_POST['discountprice'];
	$shortdescription = $_POST['shortdescription'];
	$sku=$_POST['discountprice'];
	$longdescription = $_POST['productDescription'];
	$specification = $_POST['technicalspecs'];
	$categoryid = $_POST['categoryid'];
	$subcategoryid = $_POST['subcategoryid'];
	$brand = $_POST['brand'];
	$stock = $_POST['stock'];
	$featured = $_POST['featured'];
	$bestselling = $_POST['bestselling'];
	$new = $_POST['new'];






	
$sql=mysqli_query($con,"update  product set 
	name='$name', actualprice='$actualprice', discountprice='$discountprice',sku='$sku', shortdescription='$shortdescription', longdescription='$longdescription', specification='$specification',  categoryid='$categoryid', subcategoryid='$subcategoryid', brand='$brand', stock='$stock', featured='$featured', bestselling='$bestselling', new='$new'


	where id='$pid' ");
$_SESSION['msg']="Product Updated Successfully !!";

}



	if(isset($_GET['del1']))
		  {
		          mysqli_query($con,"delete from tags where id = '".$_GET['idd']."'");

		  }
	if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from productimage where id = '".$_GET['idi']."'");

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
	
	$dir="productimages/$productid";
if(!is_dir($dir)){
		mkdir("productimages/".$productid);
	}

	move_uploaded_file($_FILES["productimage"]["tmp_name"],"productimages/$productid/".$_FILES["productimage"]["name"]);

	$blogid=$_FILES["productimage"]["name"];
$sql=mysqli_query($con,"insert into productimage(image,productid) values('$blogid','$productid')");
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
function getSubcat1(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat1.php",
	data:'subcat_id='+val,
	success: function(data){
		$("#subcategory1").html(data);
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
								<h3>Insert Product<h3><a style="margin-right:2px;color:green;float:right;border" href="insertproduct.php">Insert Product</a><button style="float:right;color:red;display:block;" id="open" class="btn" onclick="openForm()"><h3 style="margin-right:2px;color:red;float:right">Add Tag</h3></button>
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
<?php

$ids=$_GET['id'];
 $query=mysqli_query($con,"select * from product where id='$ids'");
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
<?php 

$ids=$_GET['id'];
 
$query=mysqli_query($con,"select * from product where id='$ids'");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } ?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Image</label>
<div class="controls">
<input type="file" name="productimage" required id="productimage" value="" class="span8 tip" onchange="readURL1(this);" >
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
									<strong>Oh snap!</strong> 	</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select product.* from product  where product.id='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  

$ids=$row['id'];




?>



<div class="control-group">
		<label class="control-label" for="basicinput">Product Images</label>
		<div class="controls">
			
		<?php $query2=mysqli_query($con,"select * from productimage where productid='$ids'");
$cnt2=1;
while($row2=mysqli_fetch_array($query2))
{
?>									
<img src="productimages/<?php echo $ids; ?>/<?php echo $row2['image']?>" width="50" height="50">
<?php echo $row2['image']; echo ':-'; echo $cnt2;  ?>


<a href="update-productimage.php?idd=<?php echo $row2['id']?>&ids=<?php echo $ids; ?>" target="_blank">Change Image <?php  echo $cnt2;?></a>
<a href="edit-products.php?idi=<?php echo $row2['id']?>&id=<?php echo $ids; ?>&del=delete">Delete Image <?php  echo $cnt2;?></a>
<br/>
		<?php $cnt2++; } ?>

											</div>
										</div>








<div class="control-group">
		<label class="control-label" for="basicinput">Tags</label>
		<div class="controls">

		<?php $query1=mysqli_query($con,"select * from tags where productid='$ids'");
$cnt1=1;
while($row1=mysqli_fetch_array($query1))
{
?>									
<?php echo $cnt1; echo '. '; echo $row1['name']; ?>
<a href="edit-products.php?idd=<?php echo $row1['id']?>&del1=delete&id=<?php echo $ids; ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>
		<?php $cnt1++; } ?>

											</div>
										</div>




<div class="control-group">
<label class="control-label" for="basicinput">Product Name</label>
<div class="controls">
<input type="text"    name="name"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['name']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Product Price Before Discount</label>
<div class="controls">
<input type="number"    name="actualprice"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['actualprice']);?>"  class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Price</label>
<div class="controls">
<input type="number"    name="discountprice"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['discountprice']);?>" class="span8 tip" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Product Short Description (Max:200 Characters)</label>
<div class="controls">
<input type="text"    name="shortdescription" maxlength="200"  placeholder="Enter Product Desc" value="<?php echo htmlentities($row['shortdescription']);?>" class="span8 tip" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Description</label>
<div class="controls">
<textarea name="productDescription"  rows="20" cols="20" class="span8 tip" ><?php echo htmlentities($row['longdescription']);?>
</textarea>
  
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Specification</label>
<div class="controls">
    <textarea  name="technicalspecs" rows="20" cols="20" class="span8 tip"  ><?php echo htmlentities($row['specification']);?></textarea></div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">Video</label>
<div class="controls">
    <video width="320" height="240" controls>
  <source src="productimages/<?php echo htmlentities($row['video']);?>" width="200" height="100" type="video/mp4">

</video>
<a href="update-video.php?id=<?php echo $row['id'];?>">Change Video</a>
</div>
</div>














<div class="control-group">
<label class="control-label" for="basicinput">Category</label>
<div class="controls">
<select name="categoryid" class="span8 tip"  onChange="getSubcat(this.value);"  >
<option value="<?php echo htmlentities($row['categoryid']);?>"><?php echo htmlentities($row['categoryid']);?></option> 
<?php $query=mysqli_query($con,"select * from category");
while($rw=mysqli_fetch_array($query))
{
	?>

<option value="<?php echo $rw['name'];?>"><?php echo $rw['name'];?></option>
<?php } ?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Sub Main Category</label>
<div class="controls">
<select name="subcategoryid" class="span8 tip"  onChange="getSubcat(this.value);"  >
<option value="<?php echo htmlentities($row['subcategoryid']);?>"><?php echo htmlentities($row['subcategoryid']);?></option> 
<?php $query=mysqli_query($con,"select * from subcategory");
while($rw=mysqli_fetch_array($query))
{
	?>

<option value="<?php echo $rw['name'];?>"><?php echo $rw['name'];?></option>
<?php } ?>
</select>
</div>
</div>

									



<div class="control-group">
<label class="control-label" for="basicinput">Product Brand/Company</label>
<div class="controls">

<select name = 'brand' >
                    <option value = '<?php echo htmlentities($row['brand']);?>'><?php echo htmlentities($row['brand']);?></option> 
    <?php $query11=mysqli_query($con,"select * from brand");
while($row11=mysqli_fetch_array($query11))
{
?>									

                <option value = '<?php echo htmlentities($row11['name']);?>'><?php echo htmlentities($row11['name']);?></option>
										<?php  } ?>

</select>

</select>
</div>
</div>




<div class="control-group">
<label class="control-label" for="basicinput">Product Stock</label>
<div class="controls">
<select   name="stock"   id="stock" class="span8 tip" >
<option value="<?php echo htmlentities($row['stock']);?>"><?php echo htmlentities($row['stock']);?></option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div>
</div>




<div class="control-group">
<label class="control-label" for="basicinput">Product Best Selling</label>
<div class="controls">
<select   name="bestselling"  id="bestselling" class="span8 tip" >
<option value="<?php echo htmlentities($row['bestselling']);?>"><?php if(htmlentities($row['bestselling'])=='1') echo 'Yes';
else echo 'No';?></option>
<?php if(htmlentities($row['bestselling']!='1'))
{
echo '<option value="1">Yes</option>';
}
else
{
	echo '<option value="0">No</option>';
}
?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product New</label>
<div class="controls">
<select   name="new"  id="new" class="span8 tip" >
<option value="<?php echo htmlentities($row['new']);?>"><?php if(htmlentities($row['new'])=='1') echo 'Yes';
else echo 'No';?></option>
<?php if(htmlentities($row['new']!='1'))
{
echo '<option value="1">Yes</option>';
}
else
{
	echo '<option value="0">No</option>';
}
?>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Featured</label>
<div class="controls">
<select   name="featured"  id="featured" class="span8 tip" >
<option value="<?php echo htmlentities($row['featured']);?>"><?php if(htmlentities($row['featured'])=='1') echo 'Yes';
else echo 'No';?></option>
<?php if(htmlentities($row['featured']!='1'))
{
echo '<option value="1">Yes</option>';
}
else
{
	echo '<option value="0">No</option>';
}
?>
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
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('footer.php');?>
    <script src="js1/jquery-1.11.1.min.js"></script>
    <script src="js1/bootstrap.min.js"></script>

    <script src="js1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {

            filter_data();

            function filter_data() {
                $('.filter_data');
                var action = 'fetch_data';
                var minimum_price = $('#min_price_hide').val();
                var maximum_price = $('#max_price_hide').val();
                var brand = get_filter('brand');
                var color = get_filter('color');
                var gender = get_filter('gender');
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        color: color,
                        gender: gender
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.filter_all').click(function() {
                filter_data();
            });

            $('#price_range').slider({
                range: true,
                min: 10,
                max: 300,
                values: [10, 300],
                step: 10,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#min_price_hide').val(ui.values[0]);
                    $('#max_price_hide').val(ui.values[1]);
                    filter_data();
                }
            });

        });
    </script>
    <script src="assets/plugins/ckeditor/ckeditor.js" ></script>
    <script>
        CKEDITOR.replace('productDescription');
    </script>
    <script>
        CKEDITOR.replace('technicalspecs');
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