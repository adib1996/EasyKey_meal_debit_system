<?php include 'headerwithoutlogin.php';?>

      <?php
      //Gets retailer ID
      if(isset($_GET['retailerid'])){
      $retailerid = $_GET['retailerid'];
      }
      ?>

      <?php
      //User is logged in
      if(!isset($_SESSION['u_id'])){
      ?>
      <div id="body">

      <div class="errorsuccesspanel">
        <?php

        //Signup Page
        if(strpos($fullURL, "notloggedin") == TRUE) {
            echo "<p class='error'>Login to Proceed</p>";
        }

        else if(strpos($fullURL, "login=notloggedin") == TRUE){
          echo "<p class='error'>Login to Proceed</p>";
        }

        else if(strpos($fullURL, "login=error") == TRUE){
          echo "<p class='error'>Credentials Incorrect</p>";
        }        
        
        else if(strpos($fullURL, "login=empty") == TRUE){
          echo "<p class='error'>Login to Proceed</p>";
        }
        ?>
      </div>

      <!-- Login Form -->
      <div class="singlelogin-form">
        <form action="processingforms/loginprocessing.php" method = "POST">

          <h1 style="text-align:center;">Login</h1>

        <div class="box">

          <div>
            <div>
              <label>Username/E-Mail</label>
                <input type="text" name="custid" placeholder="Username/E-mail" required>
            </div>
          </div>

          <div>
            <div>
              <label>Password</label>
                <input type="password" name="custpass"  id="thepassword" placeholder="Password"/ required>
            </div>
          </div>

          <div class="checkboxespasswordlogin">
            <input type="checkbox" onclick="showPassword()">Show Password
          </div>

          <div class="notmember">
            <p>Not a member yet? <a href="signup.php">Sign up here</a></p>
          </div>

          <div class="singleloginbutton">
          <button type="submit" name="submit">Login</button>
          </div>

        </div>

        </form>
      </div>

      </div>

      <script type="text/javascript">
      function showPassword() {
          var x = document.getElementById("thepassword");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }
      }
      </script>

      <?php
      }
      else{
        header("location: index.php?alreadyloggedin");
        exit();
      }
      ?>

      <?php
        include 'footer.php';
      ?>
