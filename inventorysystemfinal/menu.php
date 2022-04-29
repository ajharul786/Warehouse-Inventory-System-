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
        <li class="menu-underlign"><a href="admin-suppliers.php" class="menu-font-color">Stock Requests</a></li>
		<li class="menu-underlign"><a href="#" class="menu-font-color">Welcome Supplier: <?php 
		echo $_SESSION["name"];
		?></a></li>
		
		
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <?php 
	  if(isset($_SESSION["username"])){
	  if($_SESSION["rank"]=="suppliers"){}
	  else 
	  header("location: logout.php");
	  }
	  
	  
	  if(isset($_SESSION["username"]) ){
	  echo '
        <li class="menu-underlign"><a href="account.php" class="menu-font-color"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
		<li class="menu-underlign"><a href="logout.php" class="menu-font-color"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
		';
	  
	  }
		
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