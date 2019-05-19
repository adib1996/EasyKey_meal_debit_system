<?php

ob_start();

include 'header.php';

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: singlelogin.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if(!isset($_SESSION['u_role'])){
    header("location: index.php?feature=useronly");
    exit();
  }else{

?>
<div id="bodyindex">

  <div class="topuppanel">

    <form action="processingforms/topupbalanceprocessing.php" method="post">

      <div>

        <?php
        if(strpos($fullURL, "topup=empty") == TRUE) {
            echo "<p class='error'>Please fill in all fields</p>";
        }else if(strpos($fullURL, "topup=notnumeric") == TRUE){
          echo "<p class='error'>Enter a valid value</p>";
        }else if(strpos($fullURL, "topup=nominimalamount") == TRUE){
          echo "<p class='error'>A minimum of RM 10 is required</p>";
        }else if(strpos($fullURL, "topup=tryagain") == TRUE){
          echo "<p class='error'>An error has occured, please try again</p>";
        }else if(strpos($fullURL, "topup=failed") == TRUE){
          echo "<p class='error'>An error has occured, please try again</p>";
        }else if(strpos($fullURL, "topup=maxamount") == TRUE){
          echo "<p class='error'>You can only top up a maximum of RM 100</p>";
        }else if(strpos($fullURL, "topup=overbalance") == TRUE){
          echo "<p class='error'>Maximum wallet balance is RM 500</p>";
        }
        ?>

      </div>

    <h1>Top Up</h1>

    <div class="topupinputfield">
      <label>Top Up Amount</label>
        <input type="text" name="topupamount" placeholder= "Amount" required/>
    </div>

    <div class="topupinputfield">
      <label>Top Up Method</label>
        <select name="method" onchange='show(this);'>
          <option value="store">Convenience Store</option>
          <option value="onlinebanking">Online Banking</option>
          <option value="creditcard">Credit Card</option>
        </select>
    </div>

    <div id = "ccinput" class="topupinputfield" style="display:none;">
      <label>Credit Card Number</label>
        <input type="text" id="ccbox" pattern=".{16,16}" placeholder="CC Number" maxlength="16">
    </div>

    <div id = "obinput" class="topupinputfield" style="display:none;">
      <label>Select Online Service</label>
        <select>
          <option>Maybank2U</option>
          <option>CIMBClicks</option>
          <option>RHBanking</option>
       </select>
    </div>

    <div id = "ccinputdate" class="topupinputfield" style="display:none;">
      <label>Expiry Date</label>
        <input id="ccdate" type="date"/>
    </div>

    <div id = "cccvc" class="topupinputfield" style="display:none;">
      <label>CVC</label>
        <input id="cccode" pattern=".{3,3}" maxlength="3" type="password"/>
    </div>

    <div>
      <button type="submit" name="topup" onclick="return topupconfirm()">Top Up Balance</button>
    </div>

    </form>

  </div>

</div>

<?php
//End Braces
  }
}

include 'footer.php';

 ?>

<script>

function topupconfirm(){
  var x = confirm("Top up?");
  if(x){
    return true;
  }else{
    alert("Top up cancelled");
    return false;
  }
}

function show(that){
  if(that.value == "creditcard"){
    document.getElementById("ccinput").style.display = "block";
    document.getElementById("ccinputdate").style.display = "block";
    document.getElementById("cccvc").style.display = "block";

    $('#ccbox').attr('required', '');
    $('#cccode').attr('required', '');
  }else{
    document.getElementById("ccinput").style.display = "none";
    document.getElementById("ccinputdate").style.display = "none";
    document.getElementById("cccvc").style.display = "none";

    $('#ccbox').removeAttr('required');
    $('#cccode').attr('required', '');
  }

  if(that.value == "onlinebanking"){
    document.getElementById("obinput").style.display = "block";

  }else{
    document.getElementById("obinput").style.display = "none";

  }

  if(that.value == "store"){
    $('#ccbox').removeAttr('required');
    $('#cccode').removeAttr('required');
  }

}

</script>
