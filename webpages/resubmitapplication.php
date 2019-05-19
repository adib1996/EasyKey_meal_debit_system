<?php

ob_start();

include 'header.php';

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: singlelogin.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if($_SESSION['u_role'] !== '4'){
    header("location: index.php?feature=rejecteduseronly");
    exit();
  }else{

          $userid = $_SESSION['u_id'];

          include 'processingforms/dbconnection.php'; //Includes database connection
          $sql = "SELECT retailer_request.*, users.user_id FROM retailer_request INNER JOIN users ON
          retailer_request.user_id=users.user_id WHERE users.user_id = '$userid' AND req_status = 'REJECTED'";

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
              $retailername = $rows['retailer_name'];
              $retaileraddress1 = $rows['retailer_address1'];
              $retaileraddress2 = $rows['retailer_address2'];
              $retailerzipcode = $rows['retailer_zipcode'];
              $requestdesc = $rows['req_description'];
              $retailerlogo = $rows['retailer_logo'];
              $retailerphoneno = $rows['retailer_phoneno'];
              $retaileremail = $rows['retailer_email'];
              //End of SQL Query
            }
            }

?>
<div id="bodyindex">

<form class="resubmitapplicationform" action="processingforms/resubmitapplicationprocessing.php" method="post" enctype="multipart/form-data">

<label>

  <div class="viewsingleapplicationtitle">
    <h1>Resubmit Application</h1>
  </div>

  <div class="viewretailerlogo">
    <img name="image" height='180' width='180' src="Resources/PendingLogos/<?php echo $retailerlogo; ?>" />
  </div>

  <div class="viewretailername">
    <label>Retailer Name</label>
    <input type="text" name="resubmitretailername" value="<?php echo $retailername; ?>" required/>
  </div>

  <div class="viewretaileremail">
    <label>Retailer Email</label>
    <input type="text" name="resubmitretaileremail" value="<?php echo $retaileremail; ?>" required/>
  </div>

  <div class="viewretailernewlogo">
    <label>Retailer Logo</label>
      <input type="file" name="image"/>
  </div>

  <div class="viewretailerphoneno">
    <label>Retailer Phone Number</label>
    <input type="text" name="resubmitretailerphoneno" value="<?php echo $retailerphoneno; ?>" required/>
  </div>

  <div class="viewretaileraddress1">
    <label>Retailer Address Line 1</label>
    <input type="text" name="resubmitretaileraddress1" value="<?php echo $retaileraddress1; ?>" required/>
  </div>

  <div class="viewretaileraddress2">
    <label>Retailer Address Line 2</label>
    <input type="text" name="resubmitretaileraddress2" value="<?php echo $retaileraddress2; ?>"/>
  </div>

  <div class="viewretailerzipcode">
    <label>Retailer Zip Code</label>
    <input type="text" name="resubmitretailerzipcode" value="<?php echo $retailerzipcode; ?>" required />
  </div>

  <div class="viewretailerreqdesc">
    <label>Request Description</label>
    <textarea name="resubmitretailerdesc"><?php echo $requestdesc;?></textarea>
  </div>

  <div class="signupbutton">
      <button type="submit" name="resubmit">Sign Up</button>
  </div>


</form>
</div>

<?php
//End Braces
  }
}
include 'footer.php';
?>
