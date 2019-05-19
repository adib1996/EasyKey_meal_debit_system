<?php

if(!isset($_POST['agree'])){
  header("Location: ../signup.php?checkbox=notchecked");
  exit();
}
else{

if(isset($_POST['submit'])) {

  include_once 'dbconnection.php';
  //Get variables from HTML Name
  $firstn = mysqli_real_escape_string($conn, $_POST['firstname']);
  $lastn = mysqli_real_escape_string($conn, $_POST['lastname']);
  $mail = mysqli_real_escape_string($conn, $_POST['email']);
  $userid = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);
  $secondpass = mysqli_real_escape_string($conn, $_POST['secpassword']);
  $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
  $passportnumber = mysqli_real_escape_string($conn, $_POST['passportno']);
  $phonenumber = mysqli_real_escape_string($conn, $_POST['phoneno']);
  $usergender = mysqli_real_escape_string($conn, $_POST['gender']);
  $userdob = mysqli_real_escape_string($conn, $_POST['dob']);
  $usercountryresidence = mysqli_real_escape_string($conn, $_POST['countryres']);
  $userprovince = mysqli_real_escape_string($conn, $_POST['province']);
  $usercity = mysqli_real_escape_string($conn, $_POST['city']);
  $useraddressline1 = mysqli_real_escape_string($conn, $_POST['addresslineone']);
  $useraddressline2 = mysqli_real_escape_string($conn, $_POST['addresslinetwo']);
  $userzipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

  //Catching Errors
  //Empty Fields Check
  if(empty($firstn) || empty($lastn) || empty($mail) || empty($userid) ||
  empty($pass) || empty($nationality) || empty($passportnumber) || empty($phonenumber)
  || empty($usergender) || empty($usercountryresidence) || empty($userprovince) || empty($usercity)
  || empty($useraddressline1) || empty($userzipcode)){
    header("Location: ../signup.php?signup=empty");
    exit();
  } else{
    //New Conditions can Start here.

    //Checks if input characters are valid for names
    //Checks if Names contain Numbers or not
    if(!preg_match("/^[a-zA-Z]*$/", $firstn) ||
    !preg_match("/^[a-zA-Z]*$/", $lastn)){
      header("Location: ../signup.php?signup=invalidname");
      exit();
    } else {

        //Email Validation
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
          header("Location: ../signup.php?signup=invalidemail");
          exit();
        } else {

          //Validating UserID, only letters and numbers allowed, must be 4-30 characters long
          if(!preg_match("/^[a-zA-Z0-9]*$/", $userid)){
            header("Location: ../signup.php?signup=invaliduserid");
            exit();
          } else{

            //Validating phone number
            if(!preg_match('/^\+?\d+$/', $phonenumber)){
              header("Location: ../signup.php?signup=invalidphonenumber");
              exit();
            }else{

              //Age Validation. Must be more than 18 years old to use

              $today = new DateTime(date("Y-m-d")); //Gets today's date time
              $age = new DateTime(date($userdob)); //Gets user's date of birth

              $agediff = $age->diff($today); //Subtracts today's year from user's birth year
              if(($agediff->y)<18){   //If user's age is less than 18
                header("Location:../signup.php?signup=invalidage");
                exit();
              }else{

              if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,12}$/', $pass)){

                // Password must be at least 4-12 characters and must contain at least one lower case
                // letter, one upper case letter and one digit

                header("Location: ../signup.php?signup=invalidpassword");
                exit();
              }else{

                if(!is_numeric($userzipcode)){
                  header("Location: ../signup.php?signup=invalidzipcode");
                  exit();
                }else{

            //Checks for existing user inside Database

            //Add for Email Later pls

            $sql = "SELECT * FROM users WHERE user_username = '$userid'";
            $result = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($result);

            if($rescheck > 0){
              header("Location: ../signup.php?signup=usernametaken");
              exit();
            } else{

                //Validating Password
                if(!($pass == $secondpass)){ //Checks if password is same as re-typed password
                  header("Location: ../signup.php?signup=passwordmismatch");
                  exit();
                }

                else{
                //Hashing Password
                $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

                //Sets User Role and Account Balance
                $userrole = 0;
                $balance = 0;
                //Inserts User into Database
                $sql = "INSERT INTO users (user_firstname, user_lastname,
                   user_email, user_username, user_password, user_nationality,
                    user_passportno, user_gender, user_phonenumber, user_dob, user_countryresidence, user_province, user_city
                    , user_addressline1, user_addressline2, user_zipcode, user_role, user_balance)
                    VALUES('$firstn', '$lastn', '$mail', '$userid', '$hashedpass' , '$nationality' ,
                       '$passportnumber', '$usergender', '$phonenumber' , '$userdob', '$usercountryresidence', '$userprovince'
                     , '$usercity', '$useraddressline1', '$useraddressline2', '$userzipcode', '$userrole', '$balance');";

                       mysqli_query($conn, $sql); //Executes Query

                       if(mysqli_affected_rows($conn)<=0) //Checks if Record is Inserted
                       {
                       echo '<script>alert("Unable to register! \\nPlease Try Again!");
                      window.location.href = "../signup.php?signup=error";
                      </script>';
                       exit();
                        } else{

                       //Signup Successful Javascript Alert
                       echo '<script>alert("Sign-up Successful! \\nClick OK Return to Homepage and Login");
                     window.location.href = "../index.php?signup=success";
                     </script>';
                       exit();
                     }
}
}
}
}
}
}
}
}
}
}
} else{
  header("Location: ../signup.php");
  exit();
}
} // Checkbox Brace

?>
