<?php

include 'dbconnection.php'; //Includes database connection

if(!isset($_GET['productimg'])){
  header("Location: ../index.php?noimage");
  exit();
}

$prodimg = $_GET['productimg'];

$sql = "DELETE FROM products WHERE product_img = '$prodimg'";
$result = mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn) <= 0)
{
  echo '<script>';
  echo 'alert("Unable to Delete Product!");
  window.location.href = "../retailerviewproduct.php?delete=error";
  </script>';
  exit();
}else{
  unlink('../Resources/RetailerProducts/'.$prodimg);
  echo '<script>';
  echo 'alert("Deletion Successful! \\nClick OK to return to Product View");
  window.location.href = "../retailerviewproduct.php?deleteproduct=success";
  </script>';
  exit();
}

 ?>
