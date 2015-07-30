<?php
$username=$_POST['username'];
$password=$_POST['password'];
$con=@mysqli_connect("localhost","root","ajay",'hms') or die(mysql_error());
//$db=@mysql_select_db("hms",$con)or die(mysql_error());
$str="insert into users values('$username','$password')";
$res=@mysqli_query($con ,$str)or die(mysql_error());
if($res>=0)
{
echo'<br><br><b>Thank you for registration !! <br>';
}

?>
<html>
<br>
<a href="index.html"><b>Click here to return to the main page</b></a>
</html>
