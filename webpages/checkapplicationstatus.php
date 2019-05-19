<?php
SESSION_START();
?>

<?php

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: index.php?notloggedin");
  exit();
}else{
//Checking for Pending/Rejected status

$userrole = $_SESSION['u_role'];

if($userrole == '2'){ //Retailer's request is pending

?>

<a href="index.php">Go Back</a>

<h1>Pending ma brudda</h1>
<a href="retailereditapplication.php">Edit your application here</a>
<a href="processingforms/retailerdeleteapplication.php">Delete your application</a>

<?php
}
else if($userrole == '4'){ //Retailer's request is rejected
?>

<h1>Rejected Brudda</h1>
<a href="resubmitapplication.php">Resubmit Application?</a>

<?php
}
//End Braces
}
?>
