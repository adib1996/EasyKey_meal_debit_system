<?php
ob_start();
include 'header.php';
?>

<div id="bodyindex">

  <?php

  if(isset($_SESSION['u_uid']) && $_SESSION['u_role'] == '1'){ //For Admins only
   ?>
  <div class="adminpanel">
  <h1>Analysis Panel</h1>
  <br/>
  <p>Generate Charts Here</p>

  <div class="adminpanelmenu">
  <a href="generatemonthlyrevenuechart.php" target="_blank">Monthly Revenue Chart</a>
  </div>

  </div>

  <?php
    }else{
      header('location: index.php?adminonly');
      exit();
    }
  ?>

</div>

<?php
include 'footer.php';
?>
