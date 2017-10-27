<?php


$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysql_connect($servername, $username, $password);

// Check connection
if (!$conn)
  {
	die("Failed to connect to MySQL: " . mysql_error());
  }
 //else echo "Db connection successfull"."<br/>" ; // this line should be deleted.  just check korte add korsi
$db = mysql_select_db('cm');
if(!$db)
die("Database selescetion failed" . mysql_errno());
//else echo "database selected succesfully"; // this line should be deleted.  just check korte add korsi
?>