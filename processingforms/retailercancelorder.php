<?php
SESSION_START();
?>

<?php

//Checks if there is a user logged in

if(!isset($_SESSION['u_id'])){
  header("location: index.php?notloggedin");
  exit();
}else{

  //Only authorizes admins to view this page

  if($_SESSION['u_role'] !== '3'){
    header("location: index.php?feature=retaileronly");
    exit();
  }else{

    //Fetches Request ID from previous page

    if(!isset($_GET['orderid'])){
      header("Location: index.php?orderid");
      exit();
    }else{
          include 'dbconnection.php';

          //Setting Variables

          
          $orderid = $_GET['orderid'];
          $cancelcustomerrole = 8;

          $sqlbalance = "SELECT users.user_balance, orders.order_grandtotal
          FROM users 
          JOIN orders
          ON users.user_id = orders.user_id WHERE order_id = '$orderid'";

          $result = mysqli_query($conn, $sqlbalance);
          $rowfirst = mysqli_fetch_array($result);

          $refundamount = $rowfirst['order_grandtotal'];
          $customerbalance = $rowfirst['user_balance'];

          $totalcustomerbalance = $refundamount + $customerbalance;

          //Updates Customer Balance
          $sqlupdatecustbalance = "UPDATE users 
          JOIN orders ON users.user_id = orders.user_id
          SET user_balance = '$totalcustomerbalance', user_role = '$cancelcustomerrole'
          WHERE order_id = '$orderid'";

          $result2 = mysqli_query($conn, $sqlupdatecustbalance);

          if(mysqli_affected_rows($conn)<=0){ //Update Fails
            echo '<script>alert("Unable to Refund Customer");
            window.location.href = "../index.php?cancelorder=error";
            </script>';
            exit();
          }else{


          //Variables to set Cancelled Order
          $cancelledorderstatus = 2;

          //Runs SQL Query to Cancel Order
          $sql = "UPDATE orders SET order_status = '$cancelledorderstatus' WHERE order_id = '$orderid'";

          mysqli_query($conn, $sql);
            
          if(mysqli_affected_rows($conn)<=0){ //Update Fails
              echo '<script>alert("Unable to Cancel Order");
              window.location.href = "../index.php?cancelorder=error";
              </script>';
              exit();
            }else{

              echo '<script>alert("Order Successfully Cancelled. \\nClick OK to return to Homepage");
              window.location.href = "../index.php?cancelorder=success";
              </script>';
              exit();

            // }
          }
          }
}
}
}