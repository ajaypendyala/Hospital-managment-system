<?php
$username=$_POST['username'];
$password=$_POST['password'];
$con=@mysqli_connect("localhost","root","ajay",'hms') or die(mysql_error());
//$db=@mysql_select_db("hms",$con)or die(mysql_error());

$sql="SELECT * FROM users WHERE username='$username' and password='$password'";

$result=mysqli_query($con ,$sql);

$count=mysqli_num_rows($result);

if($count==1){

$_SESSION["username"]=$username;
$_SESSION["password"]=$password;

if($username=="doctor")
	header("location:doctor.html");
else	
header("location:home.html");
}
else {
echo "Wrong Username or Password";
}
ob_end_flush();
?>
