<?php
$dbServername="localhost";
$dbUserName="root";
$dbPassword="root";
$dbName="sdpdatabase";

$conn = mysqli_connect($dbServername,$dbUserName,$dbPassword,$dbName);

//Checks Connection
if (!$conn){
  die("Connection Failed: " . mysqli_connect_error());
}
?>
