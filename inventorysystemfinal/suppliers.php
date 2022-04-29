<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Supplier List</title>
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
<h2 class="text-center">Add Suppilers </h2>
 <?php 
		if(isset($_POST['register'])){
		include("connection.php");
		$dbemail='';
		$name=$_POST['name'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password1=$_POST['password1'];
		$qury1="select * from suppliers where email='$email'";
		$check=mysqli_query($connection, $qury1);
		$rowcount1=mysqli_num_rows($check);
if($rowcount1>0){
$rows=mysqli_fetch_array($check);
		$dbemail=$rows['email'];
}
		
		if($name==null || $lastname==null || $email==null || $password==null || $password1==null) echo "<h3 class='text-center'>Please Fill Full Form</h3>";
		else{
		if($dbemail==$email){echo"<h3 class='text-center'>This Email $email Already Registerd</h3>";}
		else {
		if($password1==$password){
		$fullpass=md5($password);
		$qury="insert into suppliers (name,lastname,email,password) values ('$name','$lastname','$email','$fullpass')";
		$reg=mysqli_query($connection, $qury);
		if($reg) echo "<h3 class='text-center'>Creat suppliers Successfully</h3>";
		
		}else echo "<h3 class='text-center'>You Both Password is not matched</h3>";
		}
		
		}
		}
		?>

  <form class="form-horizontal" action="suppliers.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="name">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="lastname">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" name="password">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Re-Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" name="password1">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="register">Add Suppliers</button>
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
$query2="delete from suppliers where id='$deleteid'";
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
$query="select * from suppliers";
echo"<div class='table-responsive'><table class='table table-bordered' border='2px'><thead> <tr><th>Name</th><th>Last Name</th><th>Email</th><th>Delete</th></tr> </thead>";
$run=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($run)){
$id=$rows['id'];
$name=$rows['name'];
$lastname=$rows['lastname'];
$email=$rows['email'];
echo"
<tbody>
<tr>
<th>".$name."  </th>
<th>".$lastname."</th>
<th>".$email."</th>

<th><a href='suppliers.php?delete=$id' class='btn btn-danger'>Delete</a></tr>";

} 
echo "</tbody></table></div>";
}
else echo "<center><h1>Login First</h1></center>";
?>
 
 
 
</div><br><br>


</body>
</html>
