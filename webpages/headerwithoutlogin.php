<!DOCTYPE html>
<?php
SESSION_START();
?>

<html>
<head>
  <title>EasyKey Solutions</title>
  <link rel ="shortcut icon" type="image/png" href="Resources/Logos/logo.png">
  <link rel="stylesheet" type="text/css" href="Styles/header.css">
  <link rel="stylesheet" type="text/css" href="Styles/mainbody.css">
  <link rel="stylesheet" type="text/css" href="Styles/signup.css">
  <link rel="stylesheet" type="text/css" href="Styles/footer.css">
  <link rel="stylesheet" type="text/css" href="Styles/retailermenu.css">
  <link rel="stylesheet" type="text/css" href="Styles/viewCart.css">
  <link rel="stylesheet" type="text/css" href="Styles/checkout.css">
  <link rel="stylesheet" type="text/css" href="Styles/profile.css">
  <link rel="stylesheet" type="text/css" href="Styles/editprofile.css">
  <link rel="stylesheet" type="text/css" href="Styles/changepassword.css">
  <link rel="stylesheet" type="text/css" href="Styles/singlelogin.css">
  <link rel="stylesheet" type="text/css" href="Styles/retailrequestcheck.css">
  <link rel="stylesheet" type="text/css" href="Styles/adminreportmenu.css">
  <link rel="stylesheet" type="text/css" href="Styles/salesreports.css">
  <link rel="stylesheet" type="text/css" href="Styles/charts.css">
  <link rel="stylesheet" type="text/css" href="Styles/topup.css">
  <link rel="stylesheet" type="text/css" href="Styles/vieworderhistory.css">
  <link rel="stylesheet" type="text/css" href="Styles/vieworderdetail.css">
  <link rel="stylesheet" type="text/css" href="Styles/adminviewcustomers.css">
  <link rel="stylesheet" type="text/css" href="Styles/viewtopuphistory.css">
  <link rel="stylesheet" type="text/css" href="Styles/retailersignup.css">
  <link rel="stylesheet" type="text/css" href="Styles/editapplicationretailer.css">
  <link rel="stylesheet" type="text/css" href="Styles/viewsingleapplication.css">
  <link rel="stylesheet" type="text/css" href="Styles/retaileraddproduct.css">
  <link rel="stylesheet" type="text/css" href="Styles/retailerviewproduct.css">
  <link rel="stylesheet" type="text/css" href="Styles/retailereditproduct.css">
  <link rel="stylesheet" type="text/css" href="Styles/resubmitapplication.css">


  <!-- Javascript -->
  <script src="Scripts/headerlogin.js" type="text/javascript"></script>

  <!--JQuery-->
  <script src="Scripts/jquery-3.3.1.min.js"></script>

  <!-- Icons Pack -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


</head>
<body>

      <?php
      $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      ?>

<section>
<header class="navbar">
  <nav class="wrapper">
        <ul>
          <li><a href="index.php"><img width="160" height="70" src="Resources/Logos/logo.png" /></a>
          </li>

              <!-- Search Bar for Retailers -->
              <li class="searchsection">
                <form class="searchbar" name = "squery" action="searchretailer.php" method="POST">
                    <input class="search-txt" type="text" name="squery" placeholder = "Search in Page"/>
                    <button type="submit" name ="searchretailer" class="search-btn">
                      <i class="fas fa-search"></i>
                    </button>
                </form>
              </li>

            <li class="shoppingcart">
              <div class="carticon">
              <i class="fas fa-shopping-cart"></i>
                <a href="viewCart.php">Cart
                <?php
                if(isset($_SESSION["u_uid"]) && isset($_SESSION["cart"])){
                echo "(";
                echo count($_SESSION["cart"]);
                echo ")";
                }
                 ?>
               </a>
              </div>
            </li>

            <!-- <li>
              <div class="test">
                <p style='color:white; font-family:Montserrat;'>Find your food here</p>
              </div>
            </li> -->
        </ul>
    </nav>
</header>
</section>
