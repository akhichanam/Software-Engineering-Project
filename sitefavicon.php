	<?php 
$query=mysqli_query($con,"select * from logo");
if($row=mysqli_fetch_array($query))
{
  


?>

	<title><?php echo htmlentities($row['title']);?> - <?php echo htmlentities($row['shorttitle']);?></title>
	<link rel="icon" type="image/x-icon" href="logo/<?php echo htmlentities($row['favicon']);?>">
<?php } ?>
