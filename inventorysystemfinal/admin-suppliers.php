<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Supplier Dashboard</title>
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
//top header
include_once("connection.php"); 
//menu and logo
include_once("menu.php");

?>

<br>

<div class="container">    
 <h2 align="center">Stock Requests</h2>
 <?php
$supplier_id=$_SESSION["sid"];
include("connection.php");
if(isset($_GET['yes'])){
$pad=3;
$rid=$_GET['yes'];
$pid=$_GET['pid'];
$stock=$_GET['stock'];
$cstock=$_GET['cstock'];
$newstock=$cstock+$stock;

$query2="update request_stock set status='$pad' where id='$rid'";
$update=mysqli_query($connection, $query2);

$query3="update products set stock='$newstock' where id='$pid'";
$update2=mysqli_query($connection, $query3);



if($update){  ?>

<script>
		window.alert('Request Approved Successfully!');
window.location.href = "admin-suppliers.php";
		</script>

<?php

  
  
   }
  
  
  
}



if(isset($_GET['no'])){
$pad=2;
$rid=$_GET['no'];
$query2="update request_stock set status='$pad' where id='$rid'";
$delete=mysqli_query($connection, $query2);
if($delete){  ?>

<script>
		window.alert('Request Update Successfully!');
window.location.href = "admin-suppliers.php";
		</script>

<?php

  
  
   }
  
  
  
}




?>


<?php 
if(isset($_SESSION["username"])){
include("connection.php");
$query="select * from request_stock where supplier_id='$supplier_id'";
echo"<div class='table-responsive'><table class='table table-bordered' border='2px'><thead> <tr><th>Product Name</th><th>Supplier Name</th><th>Stock</th><th>Status</th><th>Action</th></tr> </thead>";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$rid=$rows['id'];
$pid=$rows['product_id'];
$stock=$rows['stock'];
$sid=$rows['supplier_id'];
$status1=$rows['status'];

$query2="select * from suppliers where id='$sid'";
$run2=mysqli_query($connection,$query2);
$rows2=mysqli_fetch_array($run2);
$sid=$rows2['id'];
$suname=$rows2['name'];

$query3="select * from products where id='$pid'";
$run3=mysqli_query($connection,$query3);
$rows3=mysqli_fetch_array($run3);
$pname=$rows3['pname'];
$cstock=$rows3['stock'];

if($status1==1){
$status="Pending";
}
else if ($status1==2){
$status="Not Approved";
}
else {
$status="Approved - Stock Update";
}

echo"
<tbody>
<tr>
<th>".$pname."  </th>
<th>".$suname."</th>
<th>".$stock."</th>
<th>".$status."</th>
<th>";
?>
<?php
if($status1==1){
?>
<a href='admin-suppliers.php?yes=<?php echo $rid; ?>&pid=<?php echo $pid; ?>&stock=<?php echo $stock; ?>&cstock=<?php echo $cstock; ?>' class='btn btn-primary'>Approve</a>
<a href='admin-suppliers.php?no=<?php echo $rid; ?>' class='btn btn-danger'>Decline</a>

<?php 
}
echo'</tr>';
} 
echo "</tbody></table></div>";
}
else echo "<center><h1>Login First</h1></center>";
?>
 
 
 
</div><br><br>

</body>
</html>
