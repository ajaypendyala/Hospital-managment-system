<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'ajay';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'hms');
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = 'SELECT * from patients';

//mysql_select_db('hms');
$retval = mysqli_query( $conn, $sql );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
{
    echo "PATIENT ID :{$row['id']}  <br> ".
         "NAME 		 : {$row['name']} <br> ".
         "AGE		 : {$row['age']} <br> ".
         "GENDER	 : {$row['gender']} <br> ".
         "OCCUPATION : {$row['occupation']} <br> ".
         "MOBILE	 : {$row['mobile']} <br> ".
         "ADDRESS	 : {$row['address']} <br> ".
         "--------------------------------<br>";
} 

mysqli_close($conn);
?>
