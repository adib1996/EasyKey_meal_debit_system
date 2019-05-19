<?php

SESSION_START();

if(isset($_POST['submit'])){ //If Login button on the header is clicked.

  include 'dbconnection.php'; //Includes database connection

  $uid = mysqli_real_escape_string($conn, $_POST['custid']);
  $upass = mysqli_real_escape_string($conn, $_POST['custpass']);

  //Validation
  //Checking for empty inputs

  if(empty($uid) || empty($upass)){
    header("Location:../singlelogin.php?login=empty");
    exit();
  } else{
    //Runs Query to Search for Credentials in Database
    $sql = "SELECT * FROM users WHERE user_username = '$uid' OR user_email = '$uid'";
    $result = mysqli_query($conn, $sql);
    $rescheck = mysqli_num_rows($result);
    if($rescheck < 1){
      header("Location:../singlelogin.php?login=error"); //Username Not Found Validation Check
      exit();
    } else{
      if($row = mysqli_fetch_assoc($result)){

        //De-hashing password

        $hashedpasscheck = password_verify($upass, $row['user_password']); //Verifying Password Given

        if($hashedpasscheck == false){
          header("Location:../singlelogin.php?login=error");
          exit();
        } elseif($hashedpasscheck == true){
          //Logs in user and places all info retrieved in session variables.
          $_SESSION['u_id'] = $row['user_id'];
          $_SESSION['u_first'] = $row['user_firstname'];
          $_SESSION['u_last'] = $row['user_lastname'];
          $_SESSION['u_email'] = $row['user_email'];
          $_SESSION['u_uid'] = $row['user_username'];
          $_SESSION['u_nationality'] = $row['user_nationality'];
          $_SESSION['u_passportno'] = $row['user_passportno'];
          $_SESSION['u_gender'] = $row['user_gender'];
          $_SESSION['u_phonenumber'] = $row['user_phonenumber'];
          $_SESSION['u_dob'] = $row['user_dob'];
          $_SESSION['u_countryresidence'] = $row['user_countryresidence'];
          $_SESSION['u_custprovince'] = $row['user_province'];
          $_SESSION['u_custcity'] = $row['user_city'];
          $_SESSION['u_custaddresslineone'] = $row['user_addressline1'];
          $_SESSION['u_custaddresslinetwo'] = $row['user_addressline2'];
          $_SESSION['u_custzipcode'] = $row['user_zipcode'];
          $_SESSION['u_role'] = $row['user_role'];
          $_SESSION['u_balance'] = $row['user_balance'];

          header("Location:../index.php?login=success");
          exit();
        }
      }
    }

    }
}else{
    header("Location:../singlelogin.php?login=error");
    exit();
  }
?>
