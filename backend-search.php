<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "unishoppers");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT *,product.id as pid,productimage.image as pimg FROM product join productimage on productimage.productid=product.id WHERE name LIKE ? GROUP BY name";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = '%'. $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                    echo "<a style='width:inherit;font-wieght:400px;color:#414141;' href='product-details.php?pid= " . $row["pid"] ."'><p style='width:20%;float:left;'> <img src=admin/productimages/"  . $row["pid"] . "/"  . $row["pimg"] . " width='100' height='100' style='margin-right:15px'></p><p style='width:80%;float:left;'>" . ($row["name"]) . " <br/><font color='#f28b00'> $ " . $row["discountprice"] . "</font></p></a> <br/>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>