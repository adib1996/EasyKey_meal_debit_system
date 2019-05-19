<?php

ob_start();

include 'header.php';

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: index.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if($_SESSION['u_role'] !== '1'){
    header("location: index.php?feature=adminonly");
    exit();
  }else{

    //Fetches Request ID from previous page

    if(!isset($_GET['reqid'])){
      header("Location: index.php?noreqid");
      exit();
    }else{

      //Fetches User ID from previous page

      if(!isset($_GET['userid'])){
        header("Location: index.php?noreqid");
        exit();
      }else{

      $userid = $_GET['userid'];
      $reqid = $_GET['reqid'];

      include 'processingforms/dbconnection.php'; //Includes database connection
      $sql = "SELECT retailer_request.*, users.user_username FROM retailer_request INNER JOIN users ON
      retailer_request.user_id=users.user_id WHERE req_id = '$reqid'"; //SQL Query to Fetch all products

      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) <= 0) //No result gathered
      {
        echo "<p>No Result Gathered</p>";
      }else{
      ?>

      <?php

        //Displays Data Found

        while($rows = mysqli_fetch_array($result))
        {
          $username = $rows['user_username'];
          $retailername = $rows['retailer_name'];
          $retaileraddress1 = $rows['retailer_address1'];
          $retaileraddress2 = $rows['retailer_address2'];
          $retailerzipcode = $rows['retailer_zipcode'];
          $requestdate = $rows['req_date'];
          $requeststatus = $rows['req_status'];
          $requestdesc = $rows['req_description'];
          $retailerlogo = $rows['retailer_logo'];
          $retailerphoneno = $rows['retailer_phoneno'];
          $retaileremail = $rows['retailer_email'];

          $bid = $rows['req_BID'];
          //End of SQL Query
        }
        }
      ?>

    <div id="bodyindex">
    <div class="viewsingleapplicationpanel">

    <div class="viewsingleapplicationtitle">
      <h1>View Retailer Application</h1>
    </div>

    <div class="viewretailerlogo">
      <img name="retailerlogo" height='180' width='180' src="Resources/PendingLogos/<?php echo $retailerlogo; ?>" />
    </div>

    <div class="viewretailername">
      <label>Retailer Name</label>
      <input type="text" name="productid" value="<?php echo $retailername; ?>" readonly/>
    </div>

    <div class="viewretailername">
      <label>Retailer Registration ID</label>
      <input type="text" name="productid" value="<?php echo $bid; ?>" readonly/>
    </div>

    <div class="viewretaileremail">
      <label>Retailer Email</label>
      <input type="text" name="productid" value="<?php echo $retaileremail; ?>" readonly/>
    </div>

    <div class="viewretailerphoneno">
      <label>Retailer Phone Number</label>
      <input type="text" name="productid" value="<?php echo $retailerphoneno; ?>" readonly/>
    </div>

    <div class="viewretaileraddress1">
      <label>Retailer Address Line 1</label>
      <input type="text" name="productid" value="<?php echo $retaileraddress1; ?>" readonly/>
    </div>

    <div class="viewretaileraddress2">
      <label>Retailer Address Line 2</label>
      <input type="text" name="productid" value="<?php echo $retaileraddress2; ?>" readonly/>
    </div>

    <div class="viewretailerzipcode">
      <label>Retailer Zip Code</label>
      <input type="text" name="productid" value="<?php echo $retailerzipcode; ?>" readonly/>
    </div>

    <div class="viewretailerreqdate">
      <label>Request Date</label>
      <input type="text" name="productid" value="<?php echo $requestdate; ?>" readonly/>
    </div>

    <div class="viewretailerreqstatus">
      <label>Request Status</label>
      <input type="text" name="productid" value="<?php echo $requeststatus; ?>" readonly/>
    </div>

    <div class="viewretailerreqdesc">
      <label>Request Description</label>
      <textarea readonly><?php echo $requestdesc;?></textarea>
    </div>

    <div class="viewretailerusername">
      <label>Retailer's Username</label>
      <input type="text" name="productid" value="<?php echo $username?>" readonly/>
    </div>

    <div class="acceptrejectbuttons">
      <?php
      echo"<a href='processingforms/retaileracceptrequest.php?reqid=". $reqid ."&userid=". $userid . "'><button>Accept</button></a>";
      echo"<a href='processingforms/retailrejectrequest.php?reqid=". $reqid ."&userid=". $userid . "'><button>Reject</button></a>";
      ?>
    </div>

    </div>
    </div>


<?php
//End Braces
      }
    }
  }
}
include 'footer.php';
?>
