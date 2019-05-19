<!DOCTYPE html>
<?php
SESSION_START();
date_default_timezone_set("Asia/Kuala_Lumpur");
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
  <link rel="stylesheet" type="text/css" href="Styles/ourteam.css">
  <link rel="stylesheet" type="text/css" href="Styles/termsandconditions.css">
  <link rel="stylesheet" type="text/css" href="Styles/faq.css">
  <link rel="stylesheet" type="text/css" href="Styles/animation.css">
  <link rel="stylesheet" type="text/css" href="Styles/vieworders.css">


  <!-- Javascript -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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

            <?php if(!isset($_SESSION["u_role"]) || (isset($_SESSION["u_role"]) && ($_SESSION["u_role"] == "0" || $_SESSION["u_role"] == "1")))
            {
              
            ?>
              <!-- Search Bar for Retailers -->
              <li class="searchsection">
                <form class="searchbar" name = "squery" action="searchretailer.php" method="POST">
                    <input class="search-txt" type="text" name="squery" placeholder = "Search in Page"/>
                    <button type="submit" name ="searchretailer" class="search-btn">
                      <i class="fas fa-search"></i>
                    </button>
                </form>
              </li>
            <?php
            }
            ?>

            <?php
            //Only Admins and Customers are allowed to access the cart function.
            if(!isset($_SESSION["u_role"]) || (isset($_SESSION["u_role"]) && ($_SESSION["u_role"] == "0" || $_SESSION["u_role"] == "1"))){

            ?>
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
            <?php
            }else if($_SESSION['u_role'] == '3'){
            ?>

            <li class="shoppingcart">
              <div class="carticon">
              <i class="fas fa-copy"></i>
                <a href="viewOrders.php">Orders
                <?php
                include 'processingforms/dbconnection.php';

                //Counts order available for a retailer
                $userid = $_SESSION['u_id'];
                $sql = "SELECT COUNT(order_id) as TOTAL
                FROM orders 
                JOIN retailer_info ON orders.retailer_id = retailer_info.retailer_id 
                WHERE retailer_info.user_id = '$userid' AND order_status = '0' ";

                $result = mysqli_query($conn, $sql);

                if($row = mysqli_fetch_array($result)){

                  echo '(';
                  echo $row['TOTAL'];
                  echo ')';

                }
                ?>
               </a>
              </div>
            </li>

            <?php
            }
            ?>
            <li class="nav-login">
                <div>
                  <?php
                  if(isset($_SESSION['u_id'])){
                        echo '<p id="loggedinaccount">Welcome back,  ';
                        echo $_SESSION['u_first'];
                        if ($_SESSION['u_role'] == "1"){ //If the User is an Admin
                        echo '<a class ="profilebar" href="adminactions.php">';
                        echo 'Admin Actions';
                        echo '</a>';
                        }
                        else if($_SESSION['u_role'] == "0" || $_SESSION['u_role'] == "7" || $_SESSION['u_role'] == "8"){ //If the user is a customer
                        echo '<a class="profilebar" href="topup.php">';
                        echo 'Top Up';
                        echo '</a>';
                        echo '<a class="accountbalance">Balance: RM';
                        echo $_SESSION['u_balance'];
                        echo '</a>';
                        }
                        echo '<a class="profilebar" href="profiledashboard.php">';
                        echo 'Profile';
                        echo '</a>';
                        echo '</p>' . '
                            <form id="testformid" action="processingforms/logoutprocessing.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                        }else{
                          echo '<form class="loginform" name="loginform" action="processingforms/loginprocessing.php" method = "POST">
                            <input type="text" name="custid" placeholder="Username/E-mail">
                            <input type="password" name="custpass" placeholder="Password">
                            <button type="submit" class="loginbutton" onclick="signinvalidate()" name="submit">Login</button>
                            <a id="signuplink" href="signup.php">Sign Up</a>
                            </form>';  // Links to Login Processing
                }
              ?>
            </div>
          </li>
        </ul>
    </nav>
</header>
</section>
