<?php

ob_start();

include 'header.php';

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: index.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if($_SESSION['u_role'] !== '0'){
    header("location: index.php?feature=useronly");
    exit();
  }else{

?>

<div id="body">

<form class="retailersignup-form" action="processingforms/retailrequestprocessing.php" method="post" enctype="multipart/form-data">

  <div>
    <h1>Retailer Sign Up</h1>
    <p>Join EasyKey and start selling your own products!</p>
  </div>

<div class="retailername">
  <label>Retailer Name</label>
    <input type="text" name="vendorname" placeholder="Retailer Name" maxlength="20" required/>
</div>

<div class="retailername">
  <label>Business Registration ID</label>
    <input type="text" name="bid" placeholder="Registration ID" maxlength="20" required/>
</div>

<div class="retailerdesc">
  <label>Retailer Description</label>
    <textarea name="vendordesc" placeholder="Retailer Description" required/></textarea>
</div>

<div class="retailerlogoupload">
  <label>Retailer Logo</label>
    <input type="file" name="image"/>
</div>

<div class="retailerphoneno">
  <label>Retailer Phone Number</label>
    <input type="text" name="retailerphoneno" placeholder="Phone Number" maxlength="10" pattern=".{10,10}" required/>
</div>

<div class="retaileremail">
  <label>Email</label>
    <input type="text" name="retaileremail" placeholder="Email" maxlength="40" required/>
</div>

<div class="retaileraddressone">
  <label>Retailer Address Line 1</label>
    <input type="text" name="retaileraddressline1" placeholder="Address Line 1" maxlength="50" required/>
</div>

<div class="retaileraddresstwo">
  <label>Retailer Address Line 2</label>
    <input type="text" name="retaileraddressline2" placeholder="Address Line 2"/>
</div>

<div class="retailerzipcode">
  <label>Retailer Zipcode</label>
    <input type="text" name="retailzipcode" placeholder="Retailer Zipcode" maxlength="10" required/>
</div>

<div class="reqsubmitbutton">
  <button type="submit" name="submit">Submit Request</button>
</div>


</form>

</div>

<?php
}
}
include 'footer.php';
 ?>
