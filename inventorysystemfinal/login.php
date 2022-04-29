<?php
session_start();
ob_start();
?>
<html>
<head>
  <title>Login</title>
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
//top header
  if(isset($_SESSION["username"])){
  header("location: admin.php");
  }

?>


<div class="jumbotron" style="background-image:url(images/login.jpg); background-repeat:no-repeat; background-size:cover; height:100%;">
<div class="container">
<div class="col-sm-3">
</div>
<div class="col-sm-6" style="margin-top:8%;">
<center>
<h2>Manager Account</h2>
<h3> Login </h3>
</center>

<?php 
		if(isset($_POST['login'])){
		include("connection.php");
		$email=$_POST['email'];
		$password=$_POST['password'];
		if($email==null || $password==null) echo "<h3 class='text-center'>Please Enter Password And Username</h3>";
		else{
		$qury="select * from managers where email='$email'";
		$reg=mysqli_query($connection, $qury);
		$row=mysqli_fetch_array($reg);
		$uname=$row['name'];
		$dbemail=$row['email'];
		$dbpassword=$row['password'];
		$fullpass=md5($password);
		if($fullpass==$dbpassword && $email==$dbemail){
		echo "<h1> You Are Login </h1>";
		$_SESSION["email"]=$email;
		$_SESSION["name"]=$uname;
		$_SESSION["username"]=$email;
		$_SESSION["password"]=$dbpassword;
		$_SESSION["rank"]="manager";
		header("location: admin.php");
		
		
		}else echo "<h3 class='text-center'>You EMail And Password Invalid</h3>";
		
		
		}
		}
		?>


<!--Form Start-->

<form action="login.php" method="post">
<div class="col-sm-2"> </div>
<div class="col-sm-9">
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input type="email" class="form-control" placeholder="Email" name="email">
  </div>  <br>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input type="password" class="form-control" placeholder="Password" name="password" id="loginpassword">
  </div><br>
  <div class="input-group">
  <input type="submit" value="Login" class="btn btn-primary" name="login"">
  </div>
  </form>
  <br><br>
  
  <a href="loginsuppliers.php" class="text-wite"> Suppliers Login</a>
</div>
</div>


</div><br><br>
</div>

</body>
</html>
