<footer class="footer">

  <div class="footerobjects">
  <ul class="footerlink">
    <?php if(isset($_SESSION['u_uid']) && $_SESSION['u_role'] == '0'){ //For Users who wish to register as a retailer
    ?>
    <li><a href="retailersignup.php">Register as a Retailer</a></li>
    <?php
      }
    ?>
    <li><a href="ourteam.php">Our Team</a></li>
    <li><a href="faq.php">FAQ</a></li>
    <li><a href="termsandconditions.php">Terms &amp; Conditions</a></li>
  </ul>
  </div>

  <div class="footerobjects">
    <div class="storeicon">
    <a href="https://www.apple.com/my/itunes/"><img src="./Resources/Logos/appstore128.png"/></a>
    <a href="https://play.google.com/store?hl=en"><img src="./Resources/Logos/playstore128.png"/></a>
    </div>
  </div>

  <div class="footerobjects">
    <div class="footersocialmedia">
      <p>Find Us At</p>
      <a href="https://www.twitter.com"><img alt="twitterlogo" src="./Resources/Logos/twitter32.png"/></a>
      <a href="https://www.facebook.com"><img alt="facebooklogo" src="./Resources/Logos/facebook32.png"/></a>
      <a href="https://www.instagram.com"><img alt="instagramlogo" src="./Resources/Logos/instagram32.png"/></a>
    </div>
  </div>

</footer>

</body>
</html>
