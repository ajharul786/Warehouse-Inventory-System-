
<?php

	
	include_once("connection.php");
session_start();
ob_start();
	session_destroy(); //end session to logout
	session_unset(); 
	header ("location: index.php"); //redirect to login page

?>