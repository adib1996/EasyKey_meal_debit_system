<?php

ob_start();

include 'header.php';
?>

<div id="bodyindex">

  <?php
  //Gets retailer ID
  if(isset($_GET['retailerid'])){
  $retailerid = $_GET['retailerid'];
  }
  ?>

  <?php

  if(isset($_SESSION['u_uid']) && $_SESSION['u_role'] == '1'){ //This view is for ADMINS only
   ?>
  <div class="adminpanel">
  <h1>Administrator Panel</h1>
  <p>Actions such as viewing reports and checking for applications can be done through this panel</p>

  <div class="adminpanelmenu">
  <a href="retailrequestcheck.php">Check Retailer Applications</a>
  <a href="adminreportmenu.php">View Reports</a>
  <a href="vieworderhistoryadmin.php">View All Orders</a>
  </div>

  <div class="adminpanelmenu">
  <a href="adminanalysispanel.php">Analysis</a>
  <a href="adminviewcustomers.php">View Customers</a>
  <a href="adminviewallretailers.php">View All Retailers</a>
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
