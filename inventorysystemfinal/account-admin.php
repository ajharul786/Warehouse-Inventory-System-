<?php
session_start();
include("connection.php");
?>
<html>
<head>
  <title>Profile</title>
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
if(!isset($_SESSION["username"])){
  header("location: admin.php");
  }
  else{

//menu and logo
include_once("menu-main-admin.php");
}
?>


<div class="jumbotron" style="background-image:url(images/register.jpg); background-repeat:no-repeat; background-size:cover;">
<div class="container">
<div class="col-sm-3">
</div>

<div class="col-sm-6" style="background-image:url(images/3.png)">
<center>
<h3> Profile</h3>
<?php
include("connection.php");
if(isset($_POST['newpass'])){
echo"<form action='account-admin.php' method='post' class='form-horizontal'>
<div class='form-group'>
<label class='col-sm-2'> Enter Current Password: </label>
<div class='col-sm-10'>
<input type='password' class='form-control' name='curantpass' id='cupass'>
</div>
</div>
<div class='form-group'>
<label class='col-sm-2'> New Password:</label>
<div class='col-sm-10'>
<input type='password' class='form-control' name='uppass' id='newpass>
</div>
</div> <br>
<div class='form-group'>
<label class='col-sm-2'></label>
<div class='col-sm-5'>
<input type='submit' class='btn btn-primary' name='updatepass' value='Update' onClick='return checkchangepass();'>
<input type='reset' value='Clear' class='btn btn-danger'>
</div>
</div>
</form>
";
}



if(isset($_POST['updatepass'])){
$up=$_SESSION["username"];
$loginpass=$_SESSION["password"];
$pps=$_POST['uppass'];
$formcurent=$_POST['curantpass'];
if($pps==null || $formcurent==null){ echo'<center><div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please enter both password.
  </div></center>';}
else {
$newpas=md5($pps);
$formpass=md5($formcurent);  
if($loginpass==$formpass){
$query1="update managers set password='$newpas' where email='$up'";
$update=mysqli_query($connection,$query1);
if($update) echo '<center> <div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Your Password Updated.
  </div></center>';
}
else echo'<center><div class="alert alert-warning alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Please Enter Currect Recent Password.
  </div></center>';
}
}



$pf=$_SESSION["username"];  
$query="select * from managers where email='$pf'";
$run=mysqli_query($connection,$query);
$rows=mysqli_fetch_array($run);
$pname=$rows['name'];
$plastname=$rows['lastname'];
$email=$rows['email'];
echo"
<div class='table-responsive'>
<table class='table'></tr>
<tr><th>Name: </th><th>".$pname."<th></tr>
<tr><th>Last Name: </th><th>".$plastname."<th></tr>
<tr><th>Email: </th><th>".$email."<th></tr>
</table>";

echo"<form action='account-admin.php' method='post'>
<input type='submit' name='newpass' value='Click For Change Password' class='btn btn-primary'>
</form> <br>
";






?>



<!--Form Start-->
</center>


</div>
</div><br><br>

</div>

</body>
</html>