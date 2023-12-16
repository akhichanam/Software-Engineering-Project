
<div class="span3">
					<div class="sidebar">

<ul class="widget widget-menu unstyled">
							<li>
										<?php	
	$status='pending';									 
$ret = mysqli_query($con,"SELECT * FROM orders ");
$num = mysqli_num_rows($ret);
{?>
								<a class="collapsed" data-toggle="collapse" href="#togglePages">
									
									
									Order Management<b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										</a>
										<?php } ?>
								<ul id="togglePages" class="collapse unstyled">

									<li>
										<?php	
	$status='pending';									 
$ret = mysqli_query($con,"SELECT * FROM orders where orderStatus='$status' ");
$num = mysqli_num_rows($ret);
{?>
										<a href="pending-orders.php">
											
											Pending Orders <b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										</a>
										<?php } ?>

									</li>
									<li>
										<?php	
	$status='cancel';									 
$ret = mysqli_query($con,"SELECT * FROM orders where orderStatus='$status' ");
$num = mysqli_num_rows($ret);
{?>
										<a href="cancel-orders.php">
											
											Cancel Orders<b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										</a>
										<?php } ?>
									</li>
																		<li>
										<?php	
	$status='in Process';									 
$ret = mysqli_query($con,"SELECT * FROM orders where orderStatus='$status' ");
$num = mysqli_num_rows($ret);
{?>
										<a href="processorder.php">
											
											Process Orders<b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										</a>
										<?php } ?>
									</li>
									
																	<li>
										<?php	
	$status='shipped';									 
$ret = mysqli_query($con,"SELECT * FROM orders where orderStatus='$status' ");
$num = mysqli_num_rows($ret);
{?>
										<a href="shipped.php">
											
											Shipping Orders<b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										</a>
										<?php } ?>
									</li>
									<li>
										<?php	
	$status='Delivered';									 
$ret = mysqli_query($con,"SELECT * FROM orders where orderStatus='$status' ");
$num = mysqli_num_rows($ret);
{?>
										<a href="delivered-orders.php">
											
											Delivered Orders<b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
										</a>
										<?php } ?>
									</li>
								</ul>
							</li>
														

						</ul>


						<ul class="widget widget-menu unstyled">
							<li>
								<a href="coupon.php">
									
									Coupon
								</a>

							</li>
							<li>
								<a href="category.php">Category</a>
							</li>
							<li>
								<a href="subcategory.php">Sub Category</a>
							</li>
							<li>
								<a href="brand.php">Brand</a>
							</li>
							<li>
								<a href="insertproduct.php">Insert Products</a>
							</li>
							<li>
								<a href="manage-products.php">Manage Products</a>
							</li>
							<li>
								<a href="review.php">Product Review</a>
							</li>
							<li>
								<a href="replies.php">Product Replies</a>
							</li>
						</ul>

						<ul class="widget widget-menu unstyled">
							<li>
								<a href="blog.php">Blog</a>
							</li>
							<li>
								<a href="blogreview.php">Blog Review</a>
							</li>

							<li>
								<a href="blograting.php">Blog Reply</a>
							</li>
						</ul>

						<ul class="widget widget-menu unstyled">
							<li>
								<a href="editsitedetails.php">
									Site Details, Payment Details, Social Links, Contact Details, Copyright, Home Page Posters,  Download, Breadcrum Banner
								</a>
							</li>
							<li>
								<a href="homeslider.php">Home Slider</a>
							</li>
							<li>
								<a href="dealtimer.php">Deal Timer</a>
							</li>
														<li>
								<a href="iconbox.php">
									
									Icon Box
								</a>
							</li>
							<li><a href="aboutus.php">About Us</a></li>
							<li><a href="privacy.php">Privacy</a></li>
							<li><a href="faq.php">FAQs</a></li>

						</ul>
						<ul class="widget widget-menu unstyled">
							<li>
								<a href="contactus.php">Contact Us</a>
							</li>
							<li>
								<a href="newsletter.php">Newsletter</a>
							</li>																

	                                <li><a href="pincode.php">State City Pincode Price Shipping</a></li>

							<li>
								<a href="users.php">Users</a>
							</li>
</ul>

						<ul class="widget widget-menu unstyled">
							<li>
								<a href="menumain.php">
									
									Main Menu
								</a>
							</li>
							<li>
								<a href="menu1.php">
									
									Footer Menu 1 List
								</a>
							</li>
							<li>
								<a href="menu2.php">
									
									Footer Menu 2 List
								</a>
							</li>														<li><a href="custompage.php">Custom Pages</a> </li>

						</ul>


						<ul class="widget widget-menu unstyled">
							<li>
								<a href="change-password.php">
									
									Change Password
								</a>
								<a href="logout.php">
									
									Logout
								</a>
							</li>
							
</ul>





					</div><!--/.sidebar-->
				</div><!--/.span3-->
