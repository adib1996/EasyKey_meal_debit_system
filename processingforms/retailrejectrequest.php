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

  if($_SESSION['u_role'] !== '1'){
    header("location: index.php?feature=adminonly");
    exit();
  }else{

    //Fetches Request ID from previous page

    if(!isset($_GET['reqid'])){
      header("Location: index.php?noreqid");
      exit();
    }else{

      include 'dbconnection.php';

      //Getting Variables

      $reqid = $_GET['reqid'];
      $userid = $_GET['userid'];
      $rejectedmessage = 'REJECTED';
      $rejectedrole = '4';

      //SQL Statement to find row information

      $sql = "SELECT * FROM retailer_request WHERE req_id = '$reqid'";
      $result = mysqli_query($conn, $sql);
      $rescheck = mysqli_num_rows($result);

      if($rescheck < 1){
        header("Location: index.php?norecordfound");
      }else{

      //SQL Statement to update user role (4 = Rejected)

      $sql = "UPDATE users SET user_role = '$rejectedrole' WHERE user_id = '$userid'";
      $result = mysqli_query($conn, $sql);

      if(mysqli_affected_rows($conn)<=0) //Updates users table and sets user's role to 4
      {
        echo '<script>alert("Unable to reject retailer \\nPlease Try Again!");
       window.location.href = "../retailrequestcheck.php?rejecterror";
       </script>';
        exit();
      }else{

      //Updates Retailer Request Table to show that retailer is accepted

      $sql = "UPDATE retailer_request SET req_status = '$rejectedmessage' WHERE req_id = '$reqid'";
      $result = mysqli_query($conn, $sql);

      //If Statement to Check whether any row is updated or not

      if(mysqli_affected_rows($conn)<=0) //No rows changed
      {
        echo '<script>alert("Unable to change retailer details \\nPlease Try Again!");
       window.location.href = "../retailrequestcheck.php?infoerror";
       </script>';
        exit();
      }else{ //Row change detected
        echo '<script>alert("Retailer Rejected \\nClick OK to close window");
      window.location.href = "../retailrequestcheck.php?retailreject=success";
      </script>';
        exit();
      }
      }
      }



      //End Braces
    }
  }
}
