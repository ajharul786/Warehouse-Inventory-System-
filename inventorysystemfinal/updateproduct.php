<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update product</title>
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

<br>




<div class="container">    

<?php
//update delete process
include("connection.php");
if(isset($_GET['id'])){
$id2=$_GET['id'];
	$query = "DELETE FROM products WHERE id='$id2'";
	$result = mysqli_query($connection, $query);
	if($result)
	 echo '<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Product Deleted.
  </div>';
}

if(isset($_GET['idd'])){
$id3=$_GET['idd'];
include("connection.php");
$query1="select * from products where id='$id3'";
$update=mysqli_query($connection,$query1);
$row=mysqli_fetch_array($update);
$pid=$row['id'];
$uppname=$row['pname'];
$uppprice=$row['pprice'];
echo "<br><div class='container'>
<div class='col-sm-3'>
</div>

<div class='col-sm-6'>

<form action='updateproduct.php' method='post' class='form-horizontal'>
<input type='hidden' name='pid' value='".$pid."'> 

<div class='form-group'>
<label class='col-sm-2'> Product Name: </label>
<div class='col-sm-10'>
<input type='text' class='form-control' name='updatename' value='".$uppname."'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-2'> Product Price: </label>
<div class='col-sm-10'>
<input type='text' class='form-control' name='updateprice' value='".$uppprice."'>
</div>
</div>

 <div class='form-group'>
<label class='col-sm-2'></label>
<div class='col-sm-5'>
<input type='submit' name='update' value='Update' class='btn btn-primary'>
</div>
</div>
</form>
</div>
<div class='col-sm-3'>
</div>
</div>
<br>
";
}
if(isset($_POST['update'])){
$ppid=$_POST['pid'];
$updatename=$_POST['updatename'];
$updateprice=$_POST['updateprice'];

if($updatename==null || $updateprice==null){echo '<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Fill All the Form!
  </div>';}
   else if($updateprice==0){echo '<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Enter Amount Above 0!
  </div>';}
else if($updateprice<=0){echo '<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Enter Positive Number!
  </div>';}
else{

include("connection.php");
$query2="update products set pname='$updatename',pprice='$updateprice' where id='$ppid'";
$save=mysqli_query($connection,$query2);
if($save)
echo '<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Product Updated.
  </div>';
}
}





//show products
if (isset($_SESSION["username"])){
include("connection.php");
$query="select * from products order by id desc";
echo"<div class='table-responsive'><table class='table table-bordered' border='2px'> <thead> <tr> <th> Product Name</th><th> Product Price(??)</th><th>Catagory</th><th> Product Discription</th><th> Product Image</th><th> Update/Delete</th></tr> </thead>";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$id1=$rows['id'];
$pname=$rows['pname'];
$pprice=$rows['pprice'];
$tag=$rows['tag'];
$pdiscription=$rows['pdiscription'];
$picpath=$rows['picpath'];

echo"
<tbody>
<tr>
<th>". $pname."</th>
<th>".$pprice."  </th>
<th>".$tag."</th>
<th>".$pdiscription." </th>
<th><img src='$picpath' width='200px' height='200px'> </th>
<th><a href='updateproduct.php?id=$id1' class='btn btn-danger'>Delete</a><br><br><br><a href='updateproduct.php?idd=$id1' class='btn btn-primary'>Update</a></th>

</tr>";
} 
echo " </tbody></table></div>";

}
else echo "<h2> Login First</h2>";
?> 
 
 
 
</div><br><br>


</body>
</html>
