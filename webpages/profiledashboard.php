<?php
ob_start();

include 'header.php';

  if(!isset($_SESSION['u_id'])){
    header('location: singlelogin.php?notloggedin');
    exit();
  }else{

  ?>

  <div id="bodyindex">

    <div class="profiledash">

      <div class="profiletitle">
      <h1>Your Profile</h1>
      </div>

      <div class="profileblocks">

      <div class="profileitemsleft">

          <p>First Name: <?php echo $_SESSION['u_first']; ?></p>
          <p>Last Name: <?php echo $_SESSION['u_last']; ?></p>
          <p>Email: <?php echo $_SESSION['u_email']; ?></p>
          <p>Nationality: <?php echo $_SESSION['u_nationality']; ?></p>
          <p>Passport No. : <?php echo $_SESSION['u_passportno']; ?></p>
          <p>Phone Number: <?php echo $_SESSION['u_phonenumber']; ?></p>
          <p>Date of Birth: <?php echo $_SESSION['u_dob']; ?></p>

      </div>

      <div class="profileitemsright">

          <p>Username: <?php echo $_SESSION['u_uid']; ?></p>
          <p>Country of Residence: <?php echo $_SESSION['u_countryresidence']; ?></p>
          <p>Province: <?php echo $_SESSION['u_custprovince']; ?></p>
          <p>City: <?php echo $_SESSION['u_custcity']; ?></p>
          <p>Address Line 1 : <?php echo $_SESSION['u_custaddresslineone']; ?></p>
          <p>Address Line 2: <?php echo $_SESSION['u_custaddresslinetwo']; ?></p>
          <p>Zipcode: <?php echo $_SESSION['u_custzipcode']; ?></p>

      </div>

    </div>

    <div class="profileactions">
      <a href="editprofile.php">Edit Profile</a>
      <a href="changepassword.php">Change Password</a>
      <?php
      if($_SESSION['u_role'] == "0")
      {
      ?>

      <a href="processingforms/deleteprofileprocessing.php" onclick="return deleteconfirm()" >Delete your Account</a>

      <?php
      }
      ?>

    </div>

    <?php
    if($_SESSION['u_role'] == '0' || $_SESSION['u_role'] == '7'){
    ?>

    <div class="profileactions">
      <a href="vieworderhistory.php">View Order History</a>
      <a href="topuphistory.php">Top Up History</a>
    </div>

    <?php
     }
     ?>

    </div>

</div>

<script>
function deleteconfirm(){
  var x = confirm("Delete your profile?");
  if(x){
    return true;
  }else{
    alert("Deletion Cancelled");
    return false;
  }
}
</script>

<?php
}
include 'footer.php';
?>
