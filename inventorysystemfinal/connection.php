<?php
$servername = "localhost";
$username = "root";
$password="";
$database="inventorysystem";
$connection = mysqli_connect($servername,$username,$password,$database);
if(!$connection){
	echo "ERROR! Unable to connect with DB";
}


?>