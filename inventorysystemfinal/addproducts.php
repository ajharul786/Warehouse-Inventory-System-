<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Products</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
 <link rel="stylesheet" type="text/css" href="style/style.css" />
 <script type="text/javascript" src="style/simplejava.js"></script>
</head>
<body>

<?php

//menu and logo
include_once("menu-main-admin.php");

?>

<br>




<div class="container">    
<div class="col-sm-3">
</div>
<div class="col-sm-6" style="background-image:url(images/3.png)">
<center>
<h3> Add New Product </h3>
<?php
include_once("connection.php");
//add process
if(isset($_POST['addp'])){
$pname=$_POST['pname'];
$pprice=$_POST['pprice'];
$stock=$_POST['stock'];
$tag=$_POST['tag'];
$pdiscription=$_POST['pdiscription'];
if(isset($_FILES['pic']['name']))
$picname=$_FILES['pic']['name'];
$tmp=$_FILES['pic']['tmp_name'];
if($pname==null || $pprice==null || $tag==null || $pdiscription==null || $picname==null || $stock==null) {
echo '<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Fill All the Form.
  </div>';}
  if($pprice<=0 ||  $stock<=0) {
echo '<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Enter Positive Number!
  </div>';}
else{
$ext="jpg";
 $picpath="images/products/$pname.$ext";
$query="insert into products (pname,pdiscription,pprice,tag,picpath,stock) values ('$pname','$pdiscription','$pprice','$tag','$picpath','$stock')";
$save=mysqli_query($connection,$query);
if($save){  move_uploaded_file($tmp,$picpath); 
echo '<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Product Add successfully.
  </div>'; }

}
}


?>
<!--show table -->
<form class="form-horizontal" action="addproducts.php" method="post"  enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2"> Name: </label>
<div class="col-sm-10">
<input type="text" class="form-control" name="pname" id="pname" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2"> Price: </label>
<div class="col-sm-10">
<input type="text" class="form-control" name="pprice" id="pprice">
</div>
</div>

<div class="form-group">
<label class="col-sm-2"> Stock: </label>
<div class="col-sm-10">
<input type="text" class="form-control" name="stock" id="pstock">
</div>
</div>

<div class="form-group">
<label class="col-sm-2"> Category: </label>
<div class="col-sm-10">
<select name="tag" class="form-control" id="pc">
<option value="#"> Select Category </option>
		<?php
		$query="select * from categories";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$catid=$rows['id'];
$category=$rows['category'];		
		?>
<option value="<?php echo $catid; ?>"> <?php echo $category; ?> </option>

<?php } ?>

</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2"> Discription:</label>
<div class="col-sm-10">
<textarea cols="30" rows="10" name="pdiscription" class="form-control" id="pdis"> </textarea>
</div>
</div>




<div class="form-group">
<label class="col-sm-2"> Image:</label>
<div class="col-sm-10">
<input type="file" name="pic"  id="propic" />
</div>
</div>

<div class="form-group">
<label class="col-sm-4"></label>
<div class="col-sm-5">
<input type="submit" class="btn btn-primary" name="addp" value="Add Product" onClick="return checkpadd()">
</div>
</div>
</form>

 </center>
 
 </div>
</div><br><br>


</body>
</html>
