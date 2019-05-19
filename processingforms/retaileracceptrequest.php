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

          //Request ID Variable
          $reqid = $_GET['reqid'];
          $userid = $_GET['userid'];
          $acceptedmessage = 'ACCEPTED';
          $acceptedrole = '3';

          //SQL Statement to find row information

          $sql = "SELECT * FROM retailer_request WHERE req_id = '$reqid'";
          $result = mysqli_query($conn, $sql);
          $rescheck = mysqli_num_rows($result);

          if($rescheck < 1){
            header("Location: index.php?norecordfound");
          }else{

          //Gathers Variables from retailer_request table
          while($rows = mysqli_fetch_array($result)){

          $retailername = $rows['retailer_name'];
          $retailerlogo = $rows['retailer_logo'];
          $retaileremail = $rows['retailer_email'];
          $retailerphoneno = $rows['retailer_phoneno'];
          $retaileraddress1 = $rows['retailer_address1'];
          $retaileraddress2 = $rows['retailer_address2'];
          $retailerzipcode = $rows['retailer_zipcode'];

          
          $bid = $rows['req_BID'];

          }

          //SQL Statement to update user role (3 = Accepted)

          $sql = "UPDATE users SET user_role = '$acceptedrole' WHERE user_id = '$userid'";
          $result = mysqli_query($conn, $sql);

          if(mysqli_affected_rows($conn)<=0) //Updates users table and sets user's role to 3
          {
            echo '<script>alert("Unable to accept retailer \\nPlease Try Again!");
           window.location.href = "../retailrequestcheck.php?accepterror";
           </script>';
            exit();
          }else{

          //Updates Retailer Request Table to show that retailer is accepted

          $sql = "UPDATE retailer_request SET req_status = '$acceptedmessage' WHERE req_id = '$reqid'";
          $result = mysqli_query($conn, $sql);

          //If Statement to Check whether any row is updated or not

          if(mysqli_affected_rows($conn)<=0) //No rows changed
          {
            echo '<script>alert("Unable to change retailer details \\nPlease Try Again!");
           window.location.href = "../retailrequestcheck.php?infoerror";
           </script>';
            exit();
          }else{

          //Brings Retailer information into retailer_info table

          $registerdate = date("Y-m-d");

          $sql = "INSERT INTO retailer_info(retailer_name, retailer_email, retailer_phoneno, retailer_logo,
            retailer_address1, retailer_address2, retailer_zipcode,
            retailer_registerdate, user_id, retailer_BID) VALUES('$retailername', '$retaileremail', '$retailerphoneno', '$retailerlogo', '$retaileraddress1',
            '$retaileraddress2', '$retailerzipcode', '$registerdate', '$userid', '$bid');";

          $result = mysqli_query($conn, $sql);

          if(mysqli_affected_rows($conn)<=0)
          {
            echo '<script>alert("Unable to transfer information over to retailer table \\nPlease Try Again!");
           window.location.href = "../retailrequestcheck.php?transfererror";
           </script>';
            exit();
          }else{
             //Row change detected
            echo '<script>alert("Retailer Accepted \\nClick OK to close window");
          window.location.href = "../retailrequestcheck.php?retailaccept=success";
          </script>';
            exit();
          }
          }
          }
          }


//End Braces
        }
      }
    }
?>
