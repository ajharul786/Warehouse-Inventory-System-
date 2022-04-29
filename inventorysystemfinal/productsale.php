<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Products</title>
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
<div class="container">
<?php
//connection


if(isset($_GET['add'])){
$addid=$_GET['add'];
$itemamount=$_POST['itamount'];
$usern=$_SESSION["username"];

$query5="select * from products where id='$addid'";
$run5=mysqli_query($connection,$query5);
$rows5=mysqli_fetch_array($run5);
$cstock=$rows5['stock'];

if($itemamount<=0 || $itemamount==null){ echo'<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Enter Positive Number!
  </div>';}
 else if($itemamount>$cstock){ 
 $getquery="select * from products where id='$addid'";
$runpget=mysqli_query($connection,$getquery);
$sst=mysqli_fetch_array($runpget);
$ssto=$sst['stock'];
 
 echo'<div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> We have limited stock! We have only '.$ssto.' Items!
  </div>';}
else{

$newstock=$cstock-$itemamount;
$updatequery="update products set stock='$newstock' where id='$addid'";
$save=mysqli_query($connection, $updatequery);

?>

<script>
			window.alert('Stock Deleted successfully!');
		</script>

<?php

}

}

if(isset($_GET['tag'])){
$tag=$_GET['tag'];
$query="select * from products where tag='$tag' order by id desc";

}
else {
$query="select * from products order by id desc";
$tag="all";
}
$_SESSION["tag"]=$tag;

//start show products
$cartstock='';
$acamount='';
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$pid=$rows['id'];
$pname=$rows['pname'];
$pprice=$rows['pprice'];
$tag=$rows['tag'];
$pdiscription=$rows['pdiscription'];
$picpath=$rows['picpath'];
$stock=$rows['stock'];

   echo"
    <div class='col-sm-4'>
      <div class='panel'>
        <div class='panel-body'><img src='$picpath' class='img-responsive product-img-height' alt='Image'></div>
        <div class='panel-footer'  style='background-color:#FFFFFF;'>";
		
echo ' '.$pname.''; 
if(!isset($acamount)){
if($stock==0 || $cartstock>=$stock) $stockst="<font class='outofstock'>Out Of Stcok!</font>";
else $stockst="<font class='added'>In Stock!</font>";
		echo '<br>'.$stockst.''; }
		else { echo '<br><font class="added">  Stock = '.$stock.' </font>'; }
		
		echo'<br> <form method="post" action="productsale.php?tag='.$tag.'&add='.$pid.'"> <b>£'.$pprice.'</b>';
		if(isset($_SESSION["username"])){
		if($stock==0) {
		echo' <font class="non"> </font>';
		
		}
		else{
		echo'
		 &nbsp <input type="text" size="2" class="cart-input" maxlength="2" value="1" name="itamount" id="vp"><input type="submit" class="btn btn-default cart-button"  value="Delete" name="cart" onClick="return checkp()"> </form>'; } }
		 
		else{
		echo "<font class='loginadd'><a href='login.php'>Login For Add to Cart</a></font>"; 
		}
		echo'
		</div>
      </div>
    </div>'; 
	
	
	}  //end product loop
?>



<!---Close sm-4-->
</div><br><br>

</body>
</html>
