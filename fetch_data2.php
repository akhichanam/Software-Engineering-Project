
<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT product.*,productimage.image as pimg from product join productimage on productimage.productid=product.id  
	";
		if(isset($_POST["pricee"]))
	{
		$brand_filter = implode("','", $_POST["pricee"]);
		$query .= "
		 AND discountprice IN('".$brand_filter."')
		";


	}
	
	
	if(isset($_POST["categoryy"]))
	{
		$brand_filter = implode("','", $_POST["categoryy"]);
		$query .= "
		 AND categoryid IN('".$brand_filter."')
		";
	}
	if(isset($_POST["subcategoryy"]))
	{
		$brand_filter = implode("','", $_POST["subcategoryy"]);
		$query .= "
		 AND subcategoryid IN('".$brand_filter."')
		";
	}
	if(isset($_POST["subcategoryy1"]))
	{
		$brand_filter = implode("','", $_POST["subcategoryy1"]);
		$query .= "
		 AND subcategoryid1 IN('".$brand_filter."')
		";
	}
	if(isset($_POST["brand"]))
	{
		$color_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND brand IN('".$color_filter."')
		";
	}
		if(isset($_POST["availability"]))
	{
		$brand_filter = implode("','", $_POST["availability"]);
		$query .= "
		 AND stock IN('".$brand_filter."')
		";
	}
		if(isset($_POST["motherboardchipset"]))
	{
		$brand_filter = implode("','", $_POST["motherboardchipset"]);
		$query .= "
		 AND motherboardchipset IN('".$brand_filter."')
		";
	}

		if(isset($_POST["memory"]))
	{
		$brand_filter = implode("','", $_POST["memory"]);
		$query .= "
		 AND memory IN('".$brand_filter."')
		";
	}
		if(isset($_POST["cpucoolertype"]))
	{
		$brand_filter = implode("','", $_POST["cpucoolertype"]);
		$query .= "
		 AND cpucollertype IN('".$brand_filter."')
		";
	}
		if(isset($_POST["watt"]))
	{
		$brand_filter = implode("','", $_POST["watt"]);
		$query .= "
		 AND watt IN('".$brand_filter."')
		";
	}
		if(isset($_POST["cpugeneration"]))
	{
		$brand_filter = implode("','", $_POST["cpugeneration"]);
		$query .= "
		 AND cpugeneration IN('".$brand_filter."')
		";
	}
		if(isset($_POST["cpusocket"]))
	{
		$brand_filter = implode("','", $_POST["cpusocket"]);
		$query .= "
		 AND cpusocket IN('".$brand_filter."')
		";
	}
		if(isset($_POST["ramspeed"]))
	{
		$brand_filter = implode("','", $_POST["ramspeed"]);
		$query .= "
		 AND ramspeed IN('".$brand_filter."')
		";
	}
		if(isset($_POST["cabinetfantype"]))
	{
		$brand_filter = implode("','", $_POST["cabinetfantype"]);
		$query .= "
		 AND cabinetfantype IN('".$brand_filter."')
		";
	}
		if(isset($_POST["motherboardgeneration"]))
	{
		$brand_filter = implode("','", $_POST["motherboardgeneration"]);
		$query .= "
		 AND motherboardgeneration IN('".$brand_filter."')
		";
	}
		if(isset($_POST["ramcapacity"]))
	{
		$brand_filter = implode("','", $_POST["ramcapacity"]);
		$query .= "
		 AND ramcapacity IN('".$brand_filter."')
		";
	}
		if(isset($_POST["hddformfactor"]))
	{
		$brand_filter = implode("','", $_POST["hddformfactor"]);
		$query .= "
		 AND hddformfactor IN('".$brand_filter."')
		";
	}
		if(isset($_POST["graphiccardmemory"]))
	{
		$brand_filter = implode("','", $_POST["graphiccardmemory"]);
		$query .= "
		 AND graphiccardmemory IN('".$brand_filter."')
		";
	}
		if(isset($_POST["cpuseries"]))
	{
		$brand_filter = implode("','", $_POST["cpuseries"]);
		$query .= "
		 AND cpuseries IN('".$brand_filter."')
		";
	}
		if(isset($_POST["externalhddtype"]))
	{
		$brand_filter = implode("','", $_POST["externalhddtype"]);
		$query .= "
		 AND externalhddtypes IN('".$brand_filter."')
		";
	}
		if(isset($_POST["internalhddcapacity"]))
	{
		$brand_filter = implode("','", $_POST["internalhddcapacity"]);
		$query .= "
		 AND internalhddcapacity IN('".$brand_filter."')
		";
	}
		if(isset($_POST["graphiccardcapacity"]))
	{
		$brand_filter = implode("','", $_POST["graphiccardcapacity"]);
		$query .= "
		 AND graphiccardcapacity IN('".$brand_filter."')
		";
	}
		if(isset($_POST["externalhddinterface"]))
	{
		$brand_filter = implode("','", $_POST["externalhddinterface"]);
		$query .= "
		 AND externalhddinterface IN('".$brand_filter."')
		";
	}
		if(isset($_POST["cabinetcasetype"]))
	{
		$brand_filter = implode("','", $_POST["cabinetcasetype"]);
		$query .= "
		 AND cabinetcasetype IN('".$brand_filter."')
		";
	}
		if(isset($_POST["powercapacity"]))
	{
		$brand_filter = implode("','", $_POST["powercapacity"]);
		$query .= "
		 AND powercapacity IN('".$brand_filter."')
		";
	}
		if(isset($_POST["rammemorytype"]))
	{
		$brand_filter = implode("','", $_POST["rammemorytype"]);
		$query .= "
		 AND rammemorytype IN('".$brand_filter."')
		";
	}
		if(isset($_POST["motherboardseries"]))
	{
		$brand_filter = implode("','", $_POST["motherboardseries"]);
		$query .= "
		 AND motherboardseries IN('".$brand_filter."')
		";
	}
		if(isset($_POST["smpswatt"]))
	{
		$brand_filter = implode("','", $_POST["smpswatt"]);
		$query .= "
		 AND smpswatt IN('".$brand_filter."')
		";
	}
		if(isset($_POST["ramtype"]))
	{
		$brand_filter = implode("','", $_POST["ramtype"]);
		$query .= "
		 AND ramtype IN('".$brand_filter."')
		";
	}
		if(isset($_POST["smpscertification"]))
	{
		$brand_filter = implode("','", $_POST["smpscertification"]);
		$query .= "
		 AND smpscertification IN('".$brand_filter."')
		";
	}

		if(isset($_POST["internalhddtype"]))
	{
		$brand_filter = implode("','", $_POST["internalhddtype"]);
		$query .= "
		 AND internalhddtype IN('".$brand_filter."')
		";
	}
		if(isset($_POST["externalhddcapacity"]))
	{
		$brand_filter = implode("','", $_POST["externalhddcapacity"]);
		$query .= "
		 AND externalhddcapacity IN('".$brand_filter."')
		";
	}
		if(isset($_POST["interface"]))
	{
		$brand_filter = implode("','", $_POST["interface"]);
		$query .= "
		 AND interface IN('".$brand_filter."')
		";
	}
		if(isset($_POST["graphiccardseries"]))
	{
		$brand_filter = implode("','", $_POST["graphiccardseries"]);
		$query .= "
		 AND graphiccardseries IN('".$brand_filter."')
		";
	}
		if(isset($_POST["ledlighting"]))
	{
		$brand_filter = implode("','", $_POST["ledlighting"]);
		$query .= "
		 AND ledlighting IN('".$brand_filter."')
		";
	}



		if(isset($_POST["motherboardcompatibility"]))
	{
		$brand_filter = implode("','", $_POST["motherboardcompatibility"]);
		$query .= "
		 AND motherboardcompatibility IN('".$brand_filter."')
		";
	}
	


		if(isset($_POST["thirthyfivedrivebays"]))
	{
		$brand_filter = implode("','", $_POST["thirthyfivedrivebays"]);
		$query .= "
		 AND threedrivebays IN('".$brand_filter."')
		";
	}
		if(isset($_POST["twentyfivedrivebays"]))
	{
		$brand_filter = implode("','", $_POST["twentyfivedrivebays"]);
		$query .= "
		 AND towdrivebays IN('".$brand_filter."')
		";
	}
	


		if(isset($_POST["formfactor"]))
	{
		$brand_filter = implode("','", $_POST["formfactor"]);
		$query .= "
		 AND formfactor IN('".$brand_filter."')
		";
	}
		if(isset($_POST["graphiccompatibility"]))
	{
		$brand_filter = implode("','", $_POST["graphiccompatibility"]);
		$query .= "
		 AND graphiccompatibility IN('".$brand_filter."')
		";
	}


	if(isset($_POST["cpusupport"]))
	{
		$brand_filter = implode("','", $_POST["cpusupport"]);
		$query .= "
		 AND cpusupport IN('".$brand_filter."')
		";
	}
	if(isset($_POST["chipset"]))
	{
		$brand_filter = implode("','", $_POST["chipset"]);
		$query .= "
		 AND chipset IN('".$brand_filter."')
		";
	}
	if(isset($_POST["memorysupporttype"]))
	{
		$brand_filter = implode("','", $_POST["memorysupporttype"]);
		$query .= "
		 AND memorysupporttype IN('".$brand_filter."')
		";
	}
	if(isset($_POST["motherboardplate"]))
	{
		$brand_filter = implode("','", $_POST["motherboardplate"]);
		$query .= "
		 AND motherboardplateform IN('".$brand_filter."')
		";
	}


	


	

	if(isset($_POST["featured"]))
	{
		$color_filter = implode("','", $_POST["featured"]);
		$query .= "
		 AND featured=1
		";
	}
	if(isset($_POST["bestselling"]))
	{
		$color_filter = implode("','", $_POST["bestseller"]);
		$query .= "
		 AND bestselling=1 
		";
	}
		$query .= "
		 group by brand 
		";
	
	if(isset($_POST["lowprice"]))
	{
		$storage_filter = implode("','", $_POST["lowprice"]);
		$query .= "
		 ORDER BY product.discountprice ASC
		";
	}
	if(isset($_POST["highprice"]))
	{
		$storage_filter = implode("','", $_POST["highprice"]);
		$query .= "
		 ORDER BY product.discountprice DESC
		";
	}
	if(isset($_POST["datelow"]))
	{
		$storage_filter = implode("','", $_POST["datelow"]);
		$query .= "
		 ORDER BY product.date ASC
		";
	}
	if(isset($_POST["datehigh"]))
	{
		$storage_filter = implode("','", $_POST["datehigh"]);
		$query .= "
		 ORDER BY product.date DESC
		";
	}
	if(isset($_POST["az"]))
	{
		$storage_filter = implode("','", $_POST["az"]);
		$query .= "
		 ORDER BY product.name ASC
		";
	}
	if(isset($_POST["za"]))
	{
		$storage_filter = implode("','", $_POST["za"]);
		$query .= "
		 ORDER BY product.name DESC
		";
	}
	$storage_filter0 = implode("','", $_POST["v0"]);
	$storage_filter1 = implode("','", $_POST["v1"]);
	$limit1=intval($storage_filter1);
	$limit0=intval($storage_filter0);
	
	$query.="limit $limit1";
	$query.=",$limit0";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row >0)
	{
		foreach($result as $row)
		{
			$output .= '
			
			
			
			
			
			
			
			

      
      
      

                            <div class="col">
                                <div class="product-card ">
                                    <div class="product-media">
                                        <a class="product-image" href="product-details.php?pid='. $row['id'] .'">
                                            <img src="admin/productimages/'. $row['id'] .'/'.$row['pimg'].'"" alt="product">
                                        </a>
                                        <div class="product-widget">
                                    <a title="Product Wishlist" href="index.php?pid='. $row['id'] .'&&action=wishlist" class="fas fa-heart"></a>
                                    <a title="Product Compare" href="index.php?pid='. $row['id'] .'&&action=compare" class="fas fa-random"></a>
                                    <a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view1'. $row['id'] .'"></a>

                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h6 class="product-name">
                                            <a href="product-details.php?pid='. $row['id'] .'">'. mb_strimwidth($row['name'],0,50,'...') .' - '. $row['brand'] .'</a>
                                        </h6>
                                        <h6 class="product-price">
                                            <del>$'. $row['actualprice'] .'</del>
                                            <span>$'. $row['discountprice'] .'</span>
                                        </h6>
<a class="product-add"href="index.php?pid='. $row['id'] .'&&action=add"><i class="fas fa-shopping-basket"></i>                                    <span>add</span>
</a>   

                                    </div>
                                </div>
                            </div>
      
      
      
                    
			
			
			

									<?php }?>
            
            
            
            
            
    
            
            
            
            

';
		}
		
	}
	
	
	else
	{
	    
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>