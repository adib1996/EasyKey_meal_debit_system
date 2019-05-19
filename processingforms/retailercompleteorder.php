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
          $completeorder = 1;
          $customerrole = 0;

          //Runs SQL Query to Complete Order
          $sql = "UPDATE orders SET order_status = '$completeorder' WHERE order_id = '$orderid'";

          mysqli_query($conn, $sql);

          
        if(mysqli_affected_rows($conn)<=0){ //Update Fails
            echo '<script>alert("Unable to Complete Order");
            window.location.href = "../index.php?completeorder=error";
            </script>';
            exit();
          }else{

            //Runs SQL Query to Update User Role back to Customer
            $sql2 = "UPDATE users 
            JOIN orders ON users.user_id = orders.user_id 
            SET users.user_role = '$customerrole' 
            WHERE orders.order_id = '$orderid'";

             mysqli_query($conn, $sql2);


            if(mysqli_affected_rows($conn)<=0){ //Update Fails
                    echo '<script>alert("Unable to Complete Order");
                    window.location.href = "../index.php?completeorder=error";
                    </script>';
                    exit();

            }else{
                    echo '<script>alert("Order Completed! \\nClick OK to return to Homepage");
                    window.location.href = "../index.php?completeorder=success";
                    </script>';
                    exit();
            }

          }

    

}
}
}