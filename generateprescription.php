<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'ajay';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'hms');
$id=$_POST['id'];
$medicine=$_POST['medicine'];
$diagnosis=$_POST['diagnosis'];
$instructions=$_POST['instructions'];
$doc_name=$_POST['doc_name'];

//mysql_select_db('hms');
$str="insert into prescription values('$id','$medicine','$diagnosis','$instructions','$doc_name')";
$res=@mysqli_query($conn, $str)or die(mysql_error());
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$id = $_POST['id']; 
$sql="SELECT * FROM patients WHERE id='$id'";


$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
{
	echo "<big><b>PRESCRIPTION : </b></big><br><br><br>";
	echo "DOCTOR NAME : $doc_name<br>"; 
	echo "<b>Patient Details : </b><br>";
    echo "PATIENT ID : {$row['id']}  <br><br> ".
         "NAME 		 : {$row['name']} <br><br> ".
         "AGE		 : {$row['age']} <br><br> ".
         "GENDER	 : {$row['gender']} <br><br> ".
         "MOBILE	 : {$row['mobile']} <br><br> ".
        
         "--------------------------------<br>";
} 
echo "MEDICINE : $medicine <br><br>".
	 "DIAGNOSIS : $diagnosis <br><br>".	
	 "ADDITIONAL INSTRUCTIONS : $instructions <br><br>".
	     "--------------------------------<br>";	
mysqli_close($conn);
?>
<html>
<input type="button" onclick="window.print();" value="Print Prescription"/><br><br>
<a href="home.html"><b>HOME</b></a>
</html>
