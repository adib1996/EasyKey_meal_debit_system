<?php
ob_start();
include 'header.php';
?>

<?php
  if(!isset($_SESSION['u_uid'])){
    echo "No user signed in";
    header("Location: singlelogin.php?notloggedin");
    exit();
  }
?>

<script>

//JavaScript to Show Password

function showPassword() {
    var x = document.getElementById("currpass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function showNewPassword() {
    var y = document.getElementById("newpass");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

function showRepeatPassword() {
    var z = document.getElementById("repeatnewpass");
    if (z.type === "password") {
        z.type = "text";
    } else {
        z.type = "password";
    }
}

function validateChangePassword(){
  var currentpass = document.forms["changepassform"]["currentpassword"].value;
  var newpassword = document.forms["changepassform"]["newpassword"].value;
  var newpasswordrepeat = document.forms["changepassform"]["repeatpassword"].value;

  if (currentpass == "" || newpassword == "" || newpasswordrepeat == ""){
    alert("Please fill in all fields!");
    return false;
  }else{
    if(newpassword !== newpasswordrepeat){
      alert("Your passwords do not match!");
      return false;
    }else{
      return confirm("Change your password?");
    }
  }
//End of Function
}

</script>

<div id="bodyindex">

<div class="errorsuccesspanel">

<?php
//These message display whenever the URL detects a certain string.
//Signup Page
if(strpos($fullURL, "pass=empty") == TRUE) {
    echo "<p class='error'>Enter all fields</p>";
}

//Retailer Menu Page - No Products
else if(strpos($fullURL, "pass=idnonexistent") == TRUE){
  echo "<p class='error'>Something went wrong, please try again</p>";
}

else if(strpos($fullURL, "pass=currpasserror") == TRUE){
  echo "<p class='error'>Incorrect Password!</p>";
}

else if(strpos($fullURL, "pass=invalidpassword") == TRUE){
  echo "<p class='error'>Password should only be alphanumeric</p>";
}

else if(strpos($fullURL, "pass=passwordmismatch") == TRUE){
  echo "<p class='error'>New password does not match retyped password!</p>";
}

else if(strpos($fullURL, "pass=passwordsame") == TRUE){
  echo "<p class='error'>New password cannot be the same as your old password!</p>";
}

else if(strpos($fullURL, "pass=error") == TRUE){
  echo "<p class='error'>Something went wrong, please try again.</p>";
}

?>

</div>

  <form class="changepass-form" name="changepassform" action="processingforms/changepasswordprocessing.php" method="post">

  <div class="changepasstext">
  <h1>Change Password</h1>
  </div>

  <div>
    <div class="changepasswords">
      <label>Current Password</label>
        <input type="password" name="currentpassword" id="currpass" pattern=".{4,12}" placeholder="Password" maxlength = "12" required/>
    </div>

    <div class="checkboxeschangepassword">
      <input type="checkbox" onclick="showPassword()">Show Password
    </div>

    <div class="changepasswords">
      <label>New Password</label>
        <input type="password" name="newpassword" id="newpass" pattern=".{4,12}" placeholder="New Password" maxlength = "12" required/>
    </div>

    <div class="checkboxeschangepassword">
      <input type="checkbox" onclick="showNewPassword()">Show Password
    </div>

    <div class="changepasswords">
      <label>Re-Enter New Password</label>
        <input type="password" name="repeatpassword" id="repeatnewpass" pattern=".{4,12}" placeholder="Re-enter Password" maxlength = "12" required/>
    </div>

    <div class="checkboxeschangepassword">
      <input type="checkbox" onclick="showRepeatPassword()">Show Password
    </div>

  </div>

  <div class="changepassbutton">
  <button type="submit" onclick="return validateChangePassword()" name="submit">Change Password</button>
  </div>

  </form>



</div>


<?php
include_once 'footer.php';
?>
