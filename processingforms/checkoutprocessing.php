<?php
SESSION_START();
?>
<?php

if(!isset($_POST['checkout'])){
  header("Location: ../index.php?invalid");
  exit();
}else{

include 'dbconnection.php';

//Gathers Variables
$custcountryresidence = mysqli_real_escape_string($conn, $_POST['shipcountry']);
$custprovince = mysqli_real_escape_string($conn, $_POST['shipprovince']);
$custcity = mysqli_real_escape_string($conn, $_POST['shipcity']);
$custaddressline1 = mysqli_real_escape_string($conn, $_POST['shipaddresslineone']);
$custaddressline2 = mysqli_real_escape_string($conn, $_POST['shipaddresslinetwo']);
$custzipcode = mysqli_real_escape_string($conn, $_POST['shipzipcode']);
$grandtotal = mysqli_real_escape_string($conn, $_POST['totalprice']);

if($_SESSION['u_balance'] < $grandtotal){
  echo '<script>alert("Insufficient Balance!\\nPlease top up your wallet");
        window.location.href = "../index.php?checkout=insufficientbalance";
        </script>';
  exit();
}else{

//Empty Field Check
if(empty($custcountryresidence) || empty($custprovince) || empty($custcity) || empty($custaddressline1)
|| empty($custzipcode)){

  header("Location: ../checkout.php?checkout=empty");
  exit();
}else{
  //Invalid Zipcode Check
  if(!is_numeric($custzipcode)){
    header("Location: ../checkout.php?checkout=invalidzipcode");
    exit();
  }else{

    //Generates 6-Digit Random Order ID for Customer
    $orderID = mt_rand(100000, 999999);

    //Generates Today's Date
    $orderDate = date("Y-m-d");

    //Prepares customer ID for insertion
    $custID = $_SESSION['u_id'];
    $retailerid = $_SESSION['currentstore'];
    $custbalance = $_SESSION['u_balance'];
    $newbalance = $custbalance - $grandtotal;

    //Test Zone
    $orderpendingstatus = 0;

    //Checks if Generated Order number already exists by chance.
    $sql = "SELECT * FROM orders WHERE order_id = '$orderID'";
    $result = mysqli_query($conn, $sql);
    $rescheck = mysqli_num_rows($result);

    if($rescheck > 0){
      header("Location: ../checkout.php?checkout=pleasetryagain");
      exit();
    }else{

    //Inserts order information into orders table inside Database.
    $sql = "INSERT INTO orders VALUES('$orderID', '$custID', '$orderDate', '$grandtotal', '$custcountryresidence',
    '$custprovince', '$custcity', '$custaddressline1', '$custaddressline2', '$custzipcode', '$retailerid', '$orderpendingstatus');";

    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)<=0){
      echo '<script>alert("Unable to process order! \\nPlease Try Again!");
     window.location.href = "../checkout.php?checkout=processerror";
     </script>';
      exit();
    }else{

    //Loop for inserting multiple items in the the "orderdetails" table

    //Converts Cart Array Data into String
    $cart = unserialize(serialize($_SESSION['cart']));

    for($i = 0; $i<count($cart); $i++){

      $productID = mysqli_real_escape_string($conn, $cart[$i]['product_id']);
      $productName = mysqli_real_escape_string($conn, $cart[$i]['item_name']);
      $productQuantity = mysqli_real_escape_string($conn, $cart[$i]['item_quantity']);
      $productPrice = mysqli_real_escape_string($conn, $cart[$i]['product_price']);
      $totalProdPrice = $productQuantity * $productPrice;

      $sql = "INSERT INTO order_details (order_id, product_id, product_quantity)
      VALUES('$orderID', '$productID', '$productQuantity');";
      mysqli_query($conn, $sql);

    }

    if(mysqli_affected_rows($conn) <= 0){
      echo '<script>alert("Unable to complete transaction! \\nPlease Try Again!");
            window.location.href = "../checkout.php?checkout=ordererror";
            </script>';
      exit();
    }else{

      $userordered = 7;

      //Deducts User's Balance from Grand Total
      $sql = "UPDATE users SET user_balance = '$newbalance' , user_role = '$userordered' WHERE user_id = '$custID'";
      mysqli_query($conn, $sql);
      if(mysqli_affected_rows($conn) <= 0){
        echo '<script>alert("Unable to update balance! \\nPlease Try Again!");
              window.location.href = "../checkout.php?checkout=balanceerror";
              </script>';
        exit();
      }else{

      //Displays success message, updates user balance and unsets cart session
      $_SESSION['u_balance'] = $newbalance;
      $_SESSION['u_role'] = '7';

      echo '<script>alert("Order Successful! \\nThank you for your patronage");
            window.location.href = "../index.php?checkout=ordersuccess";
            </script>';
            
      unset($_SESSION['cart']);
      exit();
    }
    }
}
}
}
}
}
}
 ?>
