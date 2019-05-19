
<?php include 'header.php';?>

<div id="bodyindex">

  <div class="errorsuccesspanel">

    <?php
    //These message display whenever the URL detects a certain string.
    //Signup Page
    if(strpos($fullURL, "signup=success") == TRUE) {
        echo "<p class='success'>Successfully signed up</p>";
    }

    //Retailer Menu Page - No Products
    else if(strpos($fullURL, "retailer=noproducts") == TRUE){
      echo "<p class='error'>No products for this retailer yet. Check back soon!</p>";
    }

    //Top Up Page
    else if(strpos($fullURL, "topup=success") == TRUE){
      echo "<p class='success'>Top up successful!</p>";
    }

    //Retailer sign up page
    else if(strpos($fullURL, "requestsubmit=success") == TRUE){
      echo "<p class='success'>Application submitted!</p>";
    }

    //Edit Profile Page
    else if(strpos($fullURL, "editprofile=success") == TRUE){
      echo "<p class='success'>Profile Successfully Edited!</p>";
    }

    //Change Passwords
    else if(strpos($fullURL, "changepass=success") == TRUE){
      echo "<p class='success'>Password Successfully Changed</p>";
    }

    //Check out
    else if(strpos($fullURL, "checkout=ordersuccess") == TRUE){
      echo "<p class='success'>Order Placed";
      echo '</br>';
      echo "Thank you for using EasyKey Solutions</p>";
    }

    //Retailer - Editing Retailer Information
    else if(strpos($fullURL, "retailereditinfo=success") == TRUE){
      echo "<p class='success'>Retailer Information Edited!</p>";
    }

    //Retailer - Deleting Application
    else if(strpos($fullURL, "deleteapplication=success") == TRUE){
      echo "<p class='success'>Application Deleted</p>";
    }

    //Retailer - Resubmitting Application
    else if(strpos($fullURL, "resubmitapp=success") == TRUE){
      echo "<p class='success'>Application Resubmitted</p>";
    }

    //Retailer - Editing Application Info
    else if(strpos($fullURL, "editsubmit=success") == TRUE){
      echo "<p class='success'>Application Edited!</p>";
    }

    //Retailer - Editing Application Info
    else if(strpos($fullURL, "editsubmit=success") == TRUE){
      echo "<p class='success'>Application Edited!</p>";
    }

    //Retailer - Adding Product
    else if(strpos($fullURL, "uploadproduct=success") == TRUE){
      echo "<p class='success'>Product Uploaded</p>";
    }

    //User - Not enough Wallet Balance
    else if(strpos($fullURL, "checkout=insufficientbalance") == TRUE){
      echo "<p class='error'>Insufficient Wallet Balance</p>";
    }

    //Retailer Search - Search field empty
    else if(strpos($fullURL, "searchfield=empty") == TRUE){
      echo "<p class='error'>Search field cannot be empty!</p>";
    }

    ?>

  </div>

      <?php
      //Gets retailer ID
      if(isset($_GET['retailerid'])){
      $retailerid = $_GET['retailerid'];
      }
      ?>

<!--Showing Retailers, This View is only available for CUSTOMERS and ADMINS only-->

<?php

  if(!isset($_SESSION['u_role']) || $_SESSION['u_role'] == '0' || $_SESSION['u_role'] == '1'){ //Checking if a role is present and the one logged in is a customer/admin

  //Shows menu for non-retailers only.

  //Includes Database Connection File
  include 'processingforms/dbconnection.php';

  $sql = "SELECT * FROM retailer_info ORDER BY retailer_registerdate ASC"; //SQL Statement to gather list of retailers available and sorts them by date joined.
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)<=0) //If there is no result
  {
    echo 'No retailers yet, come back soon!';

  }else{ //Results found and places them in HTML cells
        while($row = mysqli_fetch_array($result))
        {
?>

<!--Places Retailers Available in Tables, Edit this Section for Design-->
<div class="col-sm-4">
<form class="retailertable" method="POST">
  <div class="retailerrestos">
    <a href="retailermenu.php?retailerid=<?php echo $row['retailer_id'];?>"><img name="retailerlogo" height='180' width='180' src="Resources/PendingLogos/<?php echo $row['retailer_logo'];?>" /></a>
    <a href="retailermenu.php?retailerid=<?php echo $row['retailer_id'];?>"><?php echo $row['retailer_name'];?></a>
  </div>
</form>
</div>
<!-- End of Table -->

<?php
}
}
}
?>

<?php

 ?>

<!-- ROLES IN DATABASE - IMPORTANT

0 = User
1 = Admin
2 = Applied Retailer
3 = Accepted Retailer
4 = Rejected Retailer

7 = Customer placed Order
8 = Customer with cancelled Order

-->

<?php
  if(isset($_SESSION['u_uid']) && (($_SESSION['u_role'] == '2') || ($_SESSION['u_role'] == '4'))){ //For Retailers whose requests are pending/rejected

    $userrole = $_SESSION['u_role'];
    $userid = $_SESSION['u_id'];

    //Includes Database Connection File
    include 'processingforms/dbconnection.php';

    $sql = "SELECT * FROM retailer_request WHERE user_id = '$userid' "; //SQL Statement to gather the Request ID
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)<=0) //If there is no result
    {
      echo 'No retailers yet, come back soon!';
    }else{ //Results found and places them in HTML cells
          if($row = mysqli_fetch_array($result))
          {
            $targetid = $row['req_id'];
            $_SESSION['requestid'] = $targetid;

            $editrequestid = $_SESSION['requestid'];
          }
        }

?>

<div class="appliedretailerpanel">
<h1>Application Status</h1>

<div class="appliedretailerpanelmenu">
  <?php

    if($userrole == '2'){ //Shows this screen for retailers that are PENDING

  ?>

  <div class="requeststatustitle">
  <p>Your Request Status:</p>
  </div>

  <div class="pendingtitle">
  <p>PENDING</p>
  </div>

  <a href="retailereditapplication.php">Edit Request</a>
  <a href="processingforms/retailerdeleteapplication.php">Delete Request</a>

  <?php
  }
  else if($userrole == '4'){ //Shows this screen for retailers that are REJECTED

  ?>

  <div>
  <p>Your Request Status:</p>
  </div>

  <div class="rejectedtitle">
  <p>REJECTED</p>
  </div>

  <a href="resubmitapplication.php">Resubmit Application</a>
  <a href="processingforms/retailerdeleteapplication.php">Delete Request</a>

  <?php
  }
  ?>

</div>

</div>


<?php
}
else if(isset($_SESSION['u_uid']) && $_SESSION['u_role'] == '3'){ //For Users whose applications are already accepted
?>

<div class="retailerpanel">
<h1>Retailer Panel</h1>
</br>
<p>Add, edit and view products here as a retailer. You can also change your retailer information and details</p>

<div class="retailerpanelmenu">
<a href="retaileraddproduct.php">Add a Product</a>
<a href="retailerviewproduct.php">View your Products</a>
<a href="retailereditprofile.php">Change Retailer Information</a>
<a href="retailerreportmenu.php">View Reports</a>
</div>

</div>

<?php
}
else if(isset($_SESSION['u_uid']) && $_SESSION['u_role'] == '7'){ //For Custopmers who have placed an order
?>

<div class="orderdonepanel">
<h1>Order on the way</h1>
</br>
<p>Please wait while your food is being delivered to you!</p>
<div class="loader"></div>
<div class="vieworderdone">
  <a href="viewcurrentorder.php">View Current Order</a>
</div>

<!-- <div class="retailerpanelmenu">
<a href="retaileraddproduct.php">Add a Product</a>
<a href="retailerviewproduct.php">View your Products</a>
<a href="retailereditprofile.php">Change Retailer Information</a>
</div> -->

</div>

<?php
}
else if(isset($_SESSION['u_uid']) && $_SESSION['u_role'] == '8'){ //For Customers whose order got cancelled
?>

<div class="ordercancelpanel">
<h1>Order Cancelled</h1>
</br>
<p>We deeply apologize for this matter</p>
<p>Your balance has been refunded to you</p>
<div class="vieworderdone">
  <a href="processingforms/redirectindex.php">Order Here</a>
</div>

</div>

<?php
}
?>

</div>

<?php 
include 'footer.php';
?>
