<?php
  SESSION_START();
?>

<?php

if($_SESSION['u_role'] !== '3'){
  header('location: index.php?retaileronly');
  exit();
}else{

?>

<a href="index.php">Go Back Brudda</a>
</br></br>
<a href="retaileraddproduct.php">Add a Product</a>
</br></br>
<a href="retailerviewproduct.php">View your Products</a>
</br></br>
<a href="retailereditprofile.php">Change your shop information</a>


<?php
//End Braces
}
?>
