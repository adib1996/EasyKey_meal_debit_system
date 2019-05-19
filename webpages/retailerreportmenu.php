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

    if($_SESSION['u_role'] !== '3'){
    header("location: index.php?feature=retaileronly"); //Sends customer/retailer back to homepage
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
        <a href="retailergeneratetodaysalesreport.php" target="_blank">View today's sales report</a>
        <a href="retailerviewtotalsalesreport.php">View total sales for a certain time</a>
        <a href="retailergeneratemonthlysalesreport.php" target="_blank">View monthly sales report</a>
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
