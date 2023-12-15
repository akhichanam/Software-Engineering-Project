<?php 

//database_connection.php

include('config.php');
 $host = DB_SERVER;  
 $db_user = DB_USER;  
 $db_pass = DB_PASS;  
 $dbname = DB_NAME;  

 $connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass); 

?>