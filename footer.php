	<div class="footer">
		<div class="container">
			 
<?php $sql=mysqli_query($con,"select * from copyright");
if($row=mysqli_fetch_array($sql))
{
    ?>

			<b class="copyright"><?php echo $row['text'];?>
		<?php }?>
		</div>
	</div>