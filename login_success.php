<?php
session_start();
//session_is_registered($x) 
//{return isset($_SESSION[$x]);
if(!isset($_SESSION["username"])){
	
if($_SESSION["username"]="doctor")
{header("location:doctor.html");
unset($_SESSION["username"]);
}
else
header("location:home.html");
unset($_SESSION["username"]);
}
?>

<html>
<body>
Login Successful
</body>
</html>
