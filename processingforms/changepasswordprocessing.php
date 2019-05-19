<?php
SESSION_START();
?>
<?php

if(isset($_POST['submit'])) {

  $userid = $_SESSION['u_id'];

  include 'dbconnection.php';

  $ucurrentpass = mysqli_real_escape_string($conn, $_POST['currentpassword']);
  $unewpass =  mysqli_real_escape_string($conn, $_POST['newpassword']);
  $unewrepeatpass =  mysqli_real_escape_string($conn, $_POST['repeatpassword']);

  //Catching Errors
  //Empty Fields Checking

  if(empty($ucurrentpass) || empty($unewpass) || empty($unewrepeatpass)){
    header("Location:../changepassword.php?pass=empty");
    exit();
  }else{
    //New Conditions Starts Here.
    $sql = "SELECT * FROM users WHERE user_id = '$userid'";
    $result = mysqli_query($conn, $sql);
    $rescheck = mysqli_num_rows($result);

    if($rescheck == 0){
      header("Location: ../changepassword.php?pass=idnonexistent");
      exit();
    }else{
      if($row = mysqli_fetch_assoc($result)){

        //De-hashing Current password
        $hashedpasscheck = password_verify($ucurrentpass, $row['user_password']); //Verifying Password Given

        if($hashedpasscheck == false){
          header("Location:../changepassword.php?pass=currpasserror");
          exit();
        } elseif($hashedpasscheck == true){

          //Verifying whether new password matches criteria
          if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,12}$/', $unewpass)){
            // Password must be at least 4-12 characters and must contain at least one lower case
            // letter, one upper case letter and one digit
            header("Location: ../changepassword.php?pass=invalidpassword");
            exit();
          }else{

            //Verifying if re-typed password matches
            if(!($unewpass == $unewrepeatpass)){
              header("Location: ../changepassword.php?pass=passwordmismatch");
              exit();
            }else{

              if($ucurrentpass == $unewpass){
                header("Location: ../changepassword.php?pass=passwordsame");
                exit();
              }else{

              //Hashing new password
              $hashedpass = password_hash($unewpass, PASSWORD_DEFAULT);

              //Inserts New Password into Database
              $sql = "UPDATE users SET user_password = '$hashedpass' WHERE user_id = '$userid'";
              mysqli_query($conn, $sql);

              //If any changes are done.
              if(mysqli_affected_rows($conn)<=0)
              {
              echo '<script>alert("Unable to change password ! \\nPlease Try Again!");
             window.location.href = "../changepassword.php?pass=error";
             </script>';
              exit();
              }else{
              echo '<script>alert("Password successfully changed! \\nClick to Return to Homepage");
              window.location.href = "../index.php?changepass=success";
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
}else{
  echo "Test";
  exit();
}
?>
