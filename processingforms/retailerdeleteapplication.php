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

  if($_SESSION['u_role'] == '2' || $_SESSION['u_role'] == '4'){


      include 'dbconnection.php';

      //Getting Variables
      $userid = $_SESSION['u_id'];
      $userrole = '0';

      $sql = "SELECT * FROM retailer_request WHERE user_id = '$userid' AND (req_status = 'PENDING' OR req_status = 'REJECTED') ";
      $result = mysqli_query($conn, $sql);
      $rescheck = mysqli_num_rows($result);
      if($rescheck < 1){
      header("Location:../index.php?deleteapplication=reqnotfound"); //Username Not Found Validation Check
      exit();
      }else{
      //Gathers Image File from Row Found
      if($row = mysqli_fetch_array($result)){

      $deletelogo = $row['retailer_logo'];

      //Deletes Old Logo
      if(!unlink('../Resources/PendingLogos/'. $deletelogo)){
        echo '<script>alert("Error: Previous Logo cannot be Deleted");
        window.location.href = "../deleteapplication.php?logodelete=error";
        </script>';
        exit();
      }else{
      //Until Here.

      //SQL Statement to find row information

      $sql = "DELETE FROM retailer_request WHERE user_id = '$userid' AND (req_status = 'PENDING' OR req_status = 'REJECTED') ";
      $result = mysqli_query($conn, $sql);
      if(mysqli_affected_rows($conn)<=0) //Updates users table and sets user's role to 4
      {
        echo '<script>alert("Unable to Delete Application\\nPlease Try Again!");
       window.location.href = "../checkapplicationstatus.php?delete=error";
       </script>';
        exit();
      }else{

      //Updates Retailer Request Table to show that retailer is accepted

      $sql = "UPDATE users SET user_role = '$userrole' WHERE user_id = '$userid'";
      $result = mysqli_query($conn, $sql);

      //If Statement to Check whether any row is updated or not

      if(mysqli_affected_rows($conn)<=0) //No rows changed
      {
        echo '<script>alert("Unable to change user details \\nPlease Try Again!");
       window.location.href = "../checkapplicationstatus.php?delete=detailerror";
       </script>';
        exit();
      }else{ //Row change detected

        $_SESSION['u_role'] = $userrole;

        echo '<script>alert("Application Successfully Deleted \\nClick OK to close window");
      window.location.href = "../index.php?deleteapplication=success";
      </script>';
        exit();
      }
      }
      }
      }
      }




      //End Braces
  }else{
    header("location: ../index.php?feature=applieduseronly");
    exit();
}
}