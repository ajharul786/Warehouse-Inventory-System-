<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stock Request List</title>
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
include_once("menu-main-admin.php");

?>

<br>


<div class="container">
<br>
<div class="col-sm-3">
</div>
<div class="col-sm-5">
<h2 class="text-center">Request Stock </h2>
 <?php 
		if(isset($_POST['add'])){
		include("connection.php");
		$pname=$_POST['product'];
		$stock=$_POST['stock'];
		$supplier=$_POST['supplier'];
	$status=1;
		$qury="insert into request_stock (product_id,stock,supplier_id,status) values ('$pname','$stock','$supplier','$status')";
		$reg=mysqli_query($connection, $qury);
		if($reg) echo "<h3 class='text-center'>Creat Request Successfully</h3>";
		
		}
		?>

  <form class="form-horizontal" action="request-stock.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Name:</label>
      <div class="col-sm-10">
        <select name="product" class="form-control" id="pc">
<option value="#"> Select Product </option>
		<?php
		$query="select * from products";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$id=$rows['id'];
$pname=$rows['pname'];		
		?>
<option value="<?php echo $id; ?>"> <?php echo $pname; ?> </option>

<?php } ?>

</select>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Required Stock:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="stock" required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Supplier:</label>
      <div class="col-sm-10">
       <select name="supplier" class="form-control" id="pc">
<option value="#"> Select Supplier </option>
		<?php
		$query="select * from suppliers";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$sid=$rows['id'];
$sname=$rows['name'];		
		?>
<option value="<?php echo $sid; ?>"> <?php echo $sname; ?> </option>

<?php } ?>

</select>
      </div>
    </div>
    
	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="add">Add Request</button>
      </div>
    </div>
  </form>
</div>
</div>  

<div class="container">    
 
 <?php

if(isset($_GET['delete'])){
include("connection.php");
$deleteid=$_GET['delete'];
$query2="delete from request_stock where id='$deleteid'";
$delete=mysqli_query($connection, $query2);
if($delete)
echo '<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Delete successfully.
  </div>';
}

?>


<?php 
if(isset($_SESSION["username"])){
include("connection.php");
$query="select * from request_stock";
echo"<div class='table-responsive'><table class='table table-bordered' border='2px'><thead> <tr><th>Product Name</th><th>Supplier Name</th><th>Stock</th><th>Status</th><th>Delete</th></tr> </thead>";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$rid=$rows['id'];
$pid=$rows['product_id'];
$stock=$rows['stock'];
$sid=$rows['supplier_id'];
$status=$rows['status'];

$query2="select * from suppliers where id='$sid'";
$run2=mysqli_query($connection,$query2);
$rows2=mysqli_fetch_array($run2);
$sid=$rows2['id'];
$suname=$rows2['name'];

$query3="select * from products where id='$pid'";
$run3=mysqli_query($connection,$query3);
$rows3=mysqli_fetch_array($run3);
$pname=$rows3['pname'];

if($status==1){
$status="Pending";
}
else if ($status==2){
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
<th><a href='request-stock.php?delete=$rid' class='btn btn-danger'>Delete</a></tr>";

} 
echo "</tbody></table></div>";
}
else echo "<center><h1>Login First</h1></center>";
?>
 
 
 
</div><br><br>

</body>
</html>
