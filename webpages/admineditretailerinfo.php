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

          if(!isset($_GET['retailerid'])){
            header("location: index.php?noretailerid");
            exit();
          }else{

          $retailerid = $_GET['retailerid'];

          include 'processingforms/dbconnection.php'; //Includes database connection

          //SQL Query to check if a retailer is present or not
          $sql = "SELECT * FROM retailer_info WHERE retailer_id = '$retailerid'";

          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result) <= 0) //No result gathered
          {
            echo "<p>No Result Gathered</p>";
            // exit();
          }else{
          ?>

          <?php

            //Displays Data Found and stores them into Variables

            while($rows = mysqli_fetch_array($result))
            {
              $retailername = $rows['retailer_name'];
              $retaileraddress1 = $rows['retailer_address1'];
              $retaileraddress2 = $rows['retailer_address2'];
              $retailerzipcode = $rows['retailer_zipcode'];
              $retailerlogo = $rows['retailer_logo'];
              $retailerphoneno = $rows['retailer_phoneno'];
              $retaileremail = $rows['retailer_email'];
              //End of SQL Query
            }
            }

?>
<div id="bodyindex">

<form class="resubmitapplicationform" action="processingforms/admineditretailerinfoprocessing.php" method="post" enctype="multipart/form-data">

<label>

  <div class="viewsingleapplicationtitle">
    <h1>Edit Retailer Info</h1>
  </div>

  <div class="viewretailerlogo">
    <img name="image" height='180' width='180' src="Resources/PendingLogos/<?php echo $retailerlogo; ?>" />
  </div>

  <input type="hidden" name="admineditretailerid" value="<?php echo $retailerid; ?>" />

  <div class="viewretailername">
    <label>Retailer Name</label>
    <input type="text" name="admineditretailername" value="<?php echo $retailername; ?>" required/>
  </div>

  <div class="viewretaileremail">
    <label>Retailer Email</label>
    <input type="text" name="admineditretaileremail" value="<?php echo $retaileremail; ?>" required/>
  </div>

  <!-- <div class="viewretailernewlogo">
    <label>Retailer Logo</label>
      <input type="file" name="image"/>
  </div> -->

  <div class="viewretailerphoneno">
    <label>Retailer Phone Number</label>
    <input type="text" name="admineditretailerphoneno" value="<?php echo $retailerphoneno; ?>" required/>
  </div>

  <div class="viewretaileraddress1">
    <label>Retailer Address Line 1</label>
    <input type="text" name="admineditretaileraddress1" value="<?php echo $retaileraddress1; ?>" required/>
  </div>

  <div class="viewretaileraddress2">
    <label>Retailer Address Line 2</label>
    <input type="text" name="admineditretaileraddress2" value="<?php echo $retaileraddress2; ?>"/>
  </div>

  <div class="viewretailerzipcode">
    <label>Retailer Zip Code</label>
    <input type="text" name="admineditretailerzipcode" value="<?php echo $retailerzipcode; ?>" required/>
  </div>

  <div class="signupbutton">
      <button type="submit" name="admineditinfo">Save Changes</button>
  </div>


</form>
</div>

<?php
//End Braces
}
  }
}
include 'footer.php';
?>
