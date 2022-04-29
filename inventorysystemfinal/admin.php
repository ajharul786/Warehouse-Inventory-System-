<?php
session_start();
include_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home | Admin</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
 <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>
<body>

<?php

//menu and logo
include_once("menu-main-admin.php");

?>
<br><br>
<?php

$totalproducts=0;
$query="select * from products";
$run=mysqli_query($connection, $query);
while($row=mysqli_fetch_array($run)){
$pname=$row['pname'];
$totalproducts++;
}

echo'
<div class="container">    
  <div class="row">
  <a href="productsale.php">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Total Products</div>
        <div class="panel-body"><center> <font class="total-font" >'.$totalproducts.' </font></center>   </div>
        
      </div>
	  </a>
    </div>';
	
///	
//out of stock products
$outofstock=0;
$query="select * from products where stock='$outofstock'";
$run=mysqli_query($connection, $query);
while($row=mysqli_fetch_array($run)){
$ofs=$row['stock'];
$outofstock++;
}
	echo'
	<a href="addstock.php">
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">Out of Stock Products</div>
        <div class="panel-body"><center> <font class="total-font text-danger" >'.$outofstock.' </font></center></div>
       
      </div> </a>
    </div>';
		



//contact us form
$totalfeedback=0;
$pad=1;
$query2="select * from request_stock where status='$pad'";
$run2=mysqli_query($connection, $query2);
while($row=mysqli_fetch_array($run2)){
$idfee=$row['id'];
$totalfeedback++;
}
echo'
<div class="container">    
  <div class="row">
  <a href="request-stock.php">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Pending Stock Requests</div>
        <div class="panel-body"><center> <font class="total-font" > '.$totalfeedback.' </font></center></div>
      
      </div> </a>
    </div>';
	
	
//total members
$totalsuppliers=0;
$query3="select * from suppliers";
$run3=mysqli_query($connection, $query3);
while($row=mysqli_fetch_array($run3)){
$usern=$row['id'];
$totalsuppliers++;
}
	echo'
	<a href="suppliers.php">
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Total Suppliers</div>
        <div class="panel-body"><center> <font class="total-font" > '.$totalsuppliers.'  </font></center></div>
      </div>
	  </a>
    </div>';
	

	echo'
	
    
  </div>
</div><br>';


$instock=1;
$query5="select * from products where stock>='$instock'";
$run5=mysqli_query($connection, $query5);
while($row=mysqli_fetch_array($run5)){
$st=$row['stock'];
$instock++;
}
$ratioin=($instock/$totalproducts)*100;
$ratioout=($outofstock/$totalproducts)*100;
$a=intval($ratioout);
$b=intval($ratioin);


echo '<div class="container"> 
<h1 class="text-center text-primary">Statistics</h1>
<h2> Ratio of Products </h2>
<h4> In Stock </h2>
<div class="progress">
    <div class=" progress-bar progress-bar-striped" role="" aria-valuenow="50" aria-valuemin="10" aria-valuemax="0" style="width:'.$ratioin.'%">
      '.$b.'% </div>
  </div> 
<h4> Out of Stock </h2>
<div class="progress">
    <div class=" progress-bar progress-bar-danger progress-bar-striped" role="" aria-valuenow="50" aria-valuemin="10" aria-valuemax="0" style="width:'.$ratioout.'%">
      '.$a.'% </div>
  </div>';

echo'</div>';




?>

<br><br>


</body>
</html>
