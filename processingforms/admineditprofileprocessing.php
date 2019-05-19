<?php

SESSION_START();

if(isset($_POST['adminconfirmedit'])){ //If Confirm Edit button on the form is clicked.

include 'dbconnection.php'; //Includes database connection

//Gets variables from the Edit Profile Form
$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$firstn = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastn = mysqli_real_escape_string($conn, $_POST['lastname']);
$mail = mysqli_real_escape_string($conn, $_POST['email']);
$phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
$countryofresidence = mysqli_real_escape_string($conn, $_POST['countryres']);
$userprovince = mysqli_real_escape_string($conn, $_POST['province']);
$usercity = mysqli_real_escape_string($conn, $_POST['city']);
$useraddressline1 = mysqli_real_escape_string($conn, $_POST['addresslineone']);
$useraddressline2 = mysqli_real_escape_string($conn, $_POST['addresslinetwo']);
$userzipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

if(empty($userid) || empty($firstn) || empty($lastn) || empty($mail) || empty($phoneno) || empty($countryofresidence) || empty($userprovince) ||
empty($usercity) || empty($useraddressline1) || empty($userzipcode)){

  header("location: ../admineditprofile.php?userid=$userid&edit=empty");
  exit();
}else{

  //First name and last name validation
  if(!preg_match("/^[a-zA-Z]*$/", $firstn) ||
  !preg_match("/^[a-zA-Z]*$/", $lastn)){
    header("Location: ../admineditprofile.php?userid=$userid&edit=invalidname");
    exit();
}else{

  //Email Validation
  if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    header("Location: ../admineditprofile.php?userid=$userid&edit=invalidemail");
    exit();
  }else{

    //Validating phone number
    if(!preg_match('/^\+?\d+$/', $phoneno)){
      header("Location: ../admineditprofile.php?userid=$userid&edit=invalidphonenumber");
      exit();
    }else{

        //Zipcode Validation
        if(!is_numeric($userzipcode)){
          header("Location: ../admineditprofile.php?userid=$userid&edit=invalidzipcode");
          exit();
        }else{

          //SQL Query
          $sql = "UPDATE users
          SET user_firstname = '$firstn', user_lastname = '$lastn', user_email = '$mail', user_phonenumber = '$phoneno',
           user_countryresidence ='$countryofresidence', user_province = '$userprovince',
           user_city = '$usercity', user_addressline1 = '$useraddressline1', user_addressline2 = '$useraddressline2', user_zipcode = '$userzipcode'
           WHERE user_id = '$userid'";

           mysqli_query($conn, $sql);


           if(mysqli_affected_rows($conn)<=0) //If no record is updated
           {
           echo '<script>alert("Unable to Edit Information! \\nPlease Try Again!");
          window.location.href = "../adminviewcustomers.php?edit=unsuccessful";
          </script>';
           exit();
          }else{
                //Record Successfully Updated
                echo '<script>alert("Edit Successful! \\nClick to Return to Homepage");
                window.location.href = "../adminviewcustomers.php?adminedit=success";
                </script>';
                exit();
}
}
}
}
}
}
}else{
    header("Location: ../index.php?edit=unknownerror");
    exit();
}
 ?>
