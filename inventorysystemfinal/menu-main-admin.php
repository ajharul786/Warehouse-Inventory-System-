<?php
//session_start();
?>

<html>
<head>
<style>

</style>
</head>
<body>

<div class="container-fluid top-menu-div">
<div class="container">
<div class="row">

<div class="container">
<div class="col-sm-12">
<nav class="navbar menu-style">
  <div class="container-fluid"> 
    <div class="navbar-header header-menu">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar bar-color"></span>
        <span class="icon-bar bar-color"></span>
        <span class="icon-bar bar-color"></span>                      
      </button>
      <!--<a class="navbar-brand" href="#">Logo</a>-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="menu-underlign"><a href="admin.php" class="menu-font-color">Home</a></li>
		<li class="dropdown menu-underlign">
        <a class="dropdown-toggle menu-font-color" data-toggle="dropdown" href="#">Add/Update
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="addproducts.php">Add Product</a></li>
          <li><a href="updateproduct.php">Update or Delete Product</a></li>
		  <li><a href="addstock.php">Low Stock Products</a></li>
		  <li><a href="updatestock.php">Update Stock</a></li>
        </ul>
      </li>
        <li class="menu-underlign"><a href="productsale.php" class="menu-font-color">Products</a></li>
		
		<li class="dropdown menu-underlign">
        <a class="dropdown-toggle menu-font-color" data-toggle="dropdown" href="#">Categories
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
		<?php
		$query="select * from categories";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$catid=$rows['id'];
$category=$rows['category'];		
		?>
		
		
		<li><a href="productsale.php?tag=<?php echo $catid; ?>"><?php echo $category; ?></a></li>
		  
		 <?php  } ?>
		  
        </ul>
      </li>
		
		
        <li class="menu-underlign"><a href="suppliers.php" class="menu-font-color">Suppliers</a></li>
        <li class="menu-underlign"><a href="request-stock.php" class="menu-font-color">Request Stock</a></li>
		
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <?php 
	  if(isset($_SESSION["username"])){
	  echo '
        <li class="menu-underlign"><a href="account-admin.php" class="menu-font-color"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
		<li class="menu-underlign"><a href="logout.php" class="menu-font-color"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
		';
	  
	  }
	  else 
	  header("location: index.php");
		
		?>
  
      </ul>
    </div>
  </div>
</nav>


</div>

</div>
</div>
</div>
</div>




</body>

</html>




<?php



?>