<?php
SESSION_START();

include 'dbconnection.php'; //Includes database connection

if(!isset($_SESSION['u_id'])){
  header("Location: ../index.php?notloggedin");
  exit();
}else{

    if($_SESSION['u_role'] !== '1'){
      header("Location: ../index.php?feature=restricted");
      exit();
    }else{

        if(!isset($_GET['retailerid'])){
          header("Location: ../index.php?feature=noretailerid");
          exit();
        }else{

          $retailerid = $_GET['retailerid'];

          //SQL to get Image Path
          $sqlget = "SELECT retailer_logo FROM retailer_info WHERE retailer_id = '$retailerid'";
          $resultget = mysqli_query($conn,$sqlget);

          $row = mysqli_fetch_array($resultget);
          $retailerlogo = $row['retailer_logo'];

//SQL Query to first Delete all products from Retailers.
$sql = "DELETE FROM products WHERE retailer_id = '$retailerid'";
$result = mysqli_query($conn, $sql);

  //Query to Change Deleted Retailer back to Customer
  $sql3 = "UPDATE users JOIN retailer_info ON users.user_id = retailer_info.user_id SET user_role = '0' WHERE retailer_info.retailer_id = '$retailerid'";
  $result3 = mysqli_query($conn, $sql3);

  if(mysqli_affected_rows($conn) <= 0)
  {
    echo '<script>';
    echo 'alert("Unable to Expel Retailer");
    window.location.href = "../adminviewallretailers.php?expel=error";
    </script>';
    exit();
  }
    else{

    //Query to finally delete retailer
    $sql2 = "DELETE FROM retailer_info WHERE retailer_id = '$retailerid'";
    $result2 = mysqli_query($conn, $sql2);


    if(mysqli_affected_rows($conn) <= 0)
    {
      echo '<script>';
      echo 'alert("Unable to Expel Retailer");
      window.location.href = "../adminviewallretailers.php?expel=error";
      </script>';
      exit();
    }
    
    else{
    unlink('../Resources/PendingLogos/'.$retailerlogo);
    echo '<script>';
    echo 'alert("Expulsion Successful \\nClick OK to return to Homepage");
    window.location.href = "../index.php?expelretailer=success";
    </script>';
    exit();

}
}
}
}
}
 ?>
