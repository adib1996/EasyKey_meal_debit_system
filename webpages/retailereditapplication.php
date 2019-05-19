<?php

ob_start();

include 'header.php';

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: index.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if($_SESSION['u_role'] !== '2'){
    header("location: index.php?feature=pendinguseronly");
    exit();
  }
  // else if(!isset($_GET['editrequestid'])){
  //
  //     header('location: index.php?test2');
  //     exit();
  //
  //   }
    else{

    $requestid = $_SESSION['requestid'];

    include 'processingforms/dbconnection.php';

      //SQL Query
      $query = "SELECT * FROM retailer_request WHERE req_id = '$requestid' AND req_status = 'PENDING'";
      $result = mysqli_query($conn, $query);
      $rescheck = mysqli_num_rows($result);

      if($rescheck < 0){
        header('location: index.php?noreqfound');
        exit();
      }else{

            if($row = mysqli_fetch_array($result)){

              $retailername = $row['retailer_name'];
              $retailerdesc = $row['req_description'];
              $retaileremail = $row['retailer_email'];
              $retailerphoneno = $row['retailer_phoneno'];
              $retaileraddressone = $row['retailer_address1'];
              $retaileraddresstwo = $row['retailer_address2'];
              $retailerzipcode = $row['retailer_zipcode'];
              $retailerbid = $row['req_BID'];

            }else{
              header('location: index.php?dataerror');
              exit();
            }
?>

<div id="bodyindex">

<form class="editapplicationretailer" action="processingforms/editretailrequestprocessing.php" method="post" enctype="multipart/form-data">

  <div class="editapplicationtitle">
    <h1>Edit Application</h1>
  </div>

  <input type="hidden" name ="requestid" value="<?php echo $requestid;?>"/>

  <div class="editretailername">
  <label>Retailer Name</label>
    <input type="text" name="vendorname" placeholder="Retailer Name" value="<?php echo $retailername ;?>" required/>
  </div>

  <div class="editretailername">
  <label>Retailer Business ID</label>
    <input type="text" name="bid" placeholder="Registration ID" value="<?php echo $retailerbid ;?>" required/>
  </div>

  <div class="editretaileremail">
  <label>Retailer Email</label>
    <input type="text" name="retaileremail" placeholder="Retailer Email" value="<?php echo $retaileremail ;?>" required/>
  </div>

  <div class="editretailerphone">
  <label>Retailer Phone Number</label>
    <input type="text" name="retailerphone" placeholder="Retailer Phone Number" value="<?php echo $retailerphoneno ;?>" required/>
  </div>

  <div class=editretailerdesc>
  <label>Retailer Description</label>
    <textarea name="vendordesc" placeholder="Retailer Description"/><?php echo $retailerdesc; ?></textarea>
  </div>

  <div class="editretailerlogo">
  <label>Retailer Logo</label>
    <input type="file" name="image"/>
  </div>

  <div class=editretaileraddress1>
  <label>Retailer Address Line 1</label>
  <input type="text" name="retaileraddressline1" placeholder="Retailer Address Line One" value="<?php echo $retaileraddressone ;?>" required/>
  </div>

  <div class=editretaileraddress2>
  <label>Retailer Address Line 2</label>
  <input type="text" name="retaileraddressline2" placeholder="Retailer Address Line Two" value="<?php echo $retaileraddresstwo ;?>" />
  </div>

  <div class="editapplicationsubmit">
  <button type="submit" name="editrequest">Edit Request</button>
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
