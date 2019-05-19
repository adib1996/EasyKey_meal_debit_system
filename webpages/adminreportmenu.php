<?php
ob_start();
include 'header.php';
?>

    <?php

    //Checks if there is a user logged in

    if(!isset($_SESSION['u_id'])){
    header("location: index.php?notloggedin"); //Sends unauthorized user back to homepage
    exit();
    }else{

    //Only authorizes admins to view this page

    if($_SESSION['u_role'] !== '1'){
    header("location: index.php?feature=adminonly"); //Sends customer/retailer back to homepage
    exit();
    }else{
?>

  <!--Content Menu -->

  <div id="bodyindex">

    <div class="reportmenu">

      <div class="reportmenutitle">
      <h1>Reports Menu</h1>
      </div>

    <div class="reportmenuitems">
      <a href="generatetodaysalesreport.php" target="_blank">View today's sales report</a>
      <a href="viewtotalsalesreport.php">View total sales for a certain time</a>
    </div>

    <div class="reportmenuitems">
      <a href="generatemonthlysalesreport.php" target="_blank">View monthly sales report</a>
      <a href="viewretailersalesreport.php">View a retailer's sales reports</a>
    </div>


    </div>

<?php
//End Braces
    }
  }
?>

</div>

<?php
include 'footer.php';
?>
