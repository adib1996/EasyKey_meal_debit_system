<?php

ob_start();

include 'header.php';

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: singlelogin.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if($_SESSION['u_role'] !== '3'){
    header("location: index.php?feature=retaileronly");
    exit();
  }else{

    $userid = $_SESSION['u_id'];

          include 'processingforms/dbconnection.php'; //Includes database connection
          $sql = "SELECT * FROM retailer_info WHERE user_id = '$userid'";

          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result) <= 0) //No result gathered
          {
            echo "<p>No Result Gathered</p>";
            // exit();
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
              $retailerlogo = $rows['retailer_logo'];
              $retailerphoneno = $rows['retailer_phoneno'];
              $retaileremail = $rows['retailer_email'];
              //End of SQL Query
            }
            }

?>
<div id="bodyindex">

<div class="errorsuccesspanel">

    <?php
    //These message display whenever the URL detects a certain string.
    //Signup Page
    if(strpos($fullURL, "upload=empty") == TRUE) {
        echo "<p class='error'>Enter all fields</p>";
    }    
    
    else if(strpos($fullURL, "upload=notanimage") == TRUE){
      echo "<p class='error'>Upload an image!</p>";
    }

    else if(strpos($fullURL, "upload=invalidfiletype") == TRUE){
      echo "<p class='error'>Invalid image type!</p>";
    }

    else if(strpos($fullURL, "upload=filetoolarge") == TRUE){
      echo "<p class='error'>Logo must not be larger than 500 KB!</p>";
    }

    else if(strpos($fullURL, "resubmit=invalidemail") == TRUE){
      echo "<p class='error'>Please enter a valid email!</p>";
    }

    else if(strpos($fullURL, "resubmit=invalidphonenumber") == TRUE){
      echo "<p class='error'>Please enter a valid phone number</p>";
    }

    else if(strpos($fullURL, "retailereditinfo=error") == TRUE){
      echo "<p class='error'>Something went wrong, try again</p>";
    }
    
    ?>

</div>

<form class="resubmitapplicationform" action="processingforms/retailereditprofileprocessing.php" method="post" enctype="multipart/form-data">

  <div class="viewsingleapplicationtitle">
    <h1>Edit Your Retailer Information</h1>
  </div>

  <div class="viewretailerlogo">
    <img name="image" height='180' width='180' src="Resources/PendingLogos/<?php echo $retailerlogo; ?>" />
  </div>

  <div class="viewretailername">
    <label>Retailer Name</label>
    <input type="text" name="editretailername" value="<?php echo $retailername; ?>" maxlength="20" required/>
  </div>

  <div class="viewretaileremail">
    <label>Retailer Email</label>
    <input type="text" name="editretaileremail" value="<?php echo $retaileremail; ?>" maxlength="40" required/>
  </div>

  <div class="viewretailernewlogo">
    <label>Retailer Logo</label>
      <input type="file" name="image"/>
  </div>

  <div class="viewretailerphoneno">
    <label>Retailer Phone Number</label>
    <input type="text" name="editretailerphoneno" value="<?php echo $retailerphoneno; ?>" maxlength="10" required/>
  </div>

  <div class="viewretaileraddress1">
    <label>Retailer Address Line 1</label>
    <input type="text" name="editretaileraddress1" value="<?php echo $retaileraddress1; ?>" maxlength="50" required/>
  </div>

  <div class="viewretaileraddress2">
    <label>Retailer Address Line 2</label>
    <input type="text" name="editretaileraddress2" value="<?php echo $retaileraddress2; ?>"/>
  </div>

  <div class="viewretailerzipcode">
    <label>Retailer Zip Code</label>
    <input type="text" name="editretailerzipcode" value="<?php echo $retailerzipcode; ?>" maxlength="10" required />
  </div>

  <div class="signupbutton">
      <button type="submit" name="editinfo">Save Changes</button>
  </div>


</form>
</div>

<?php
//End Braces
  }
}
include 'footer.php';
?>
