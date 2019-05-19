<?php
SESSION_START();
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<?php

//Checks if there is a user logged in

if(!isset($_POST['topup'])){
  header("location: index.php?notopupbuttonclick");
  exit();
}
  else{

    if(!isset($_SESSION['u_id'])){
      header("location: index.php?notloggedin");
      exit();
    }else{

      //Only authorizes admins to view this page

      if($_SESSION['u_role'] == '0' || $_SESSION['u_role'] == '7'){


        include 'dbconnection.php';

        //Gathering Variables
        $userid = $_SESSION['u_id'];
        $topupbalance = mysqli_real_escape_string($conn, $_POST['topupamount']);
        $topupmethod = mysqli_real_escape_string($conn, $_POST['method']);

        //Validation Rules

        if(empty($topupbalance)){
          header("location: ../topup.php?topup=empty");
          exit();
        }

          else{
            //Numeric value check
            if(!is_numeric($topupbalance)){
              header('location: ../topup.php?topup=notnumeric');
              exit();
            }

            else{

            if($topupbalance < 10){
              header('location: ../topup.php?topup=nominimalamount');
              exit();
            }

            else{

              if($topupbalance > 100){
                header('location: ../topup.php?topup=maxamount');
                exit();
              }

              else{

            //Initializes Variables
            $topupID = mt_rand(100000, 999999); //Generates Random ID
            $topupdatetime = date('Y-m-d H:i:s'); //Generates Today's Date and Time
            $oldbalance = $_SESSION['u_balance'];
            $newbalance = $topupbalance + $oldbalance;

            $sql = "SELECT * FROM topup WHERE topup_id = '$topupID'";
            $result = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($result);

            if($rescheck > 0){
              header('location: ../topup.php?topup=tryagain');
              exit();
            }

            else{
              //Checks if Wallet Balance Exceeds 500

              $sql2 = "SELECT user_balance FROM users WHERE user_id = '$userid'";
              $result2 = mysqli_query($conn, $sql2);

              $row = mysqli_fetch_array($result2);

              $currentbalance = $row['user_balance'];

              if($newbalance > 500){
                header('location: ../topup.php?topup=overbalance');
                exit();
              }

              else{

              //Inserts Record into Top Up Table
              $sql = "INSERT INTO topup VALUES('$topupID', '$topupbalance', '$topupmethod',
              '$topupdatetime' , '$userid')";

              mysqli_query($conn, $sql);

              if(mysqli_affected_rows($conn) <= 0){
                echo '<script>alert("Unable to add credits \\nPlease Try Again!");
                window.location.href = "../topup.php?adderror";
                </script>';
                exit();
                }

                  else{
                    //Updates user's balance
                    $sql = "UPDATE users SET user_balance = '$newbalance' WHERE user_id = '$userid'";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)<=0)
                    {
                      echo '<script>alert("Top up Failed \\nPlease try again later");
                      window.location.href = "../topup.php?topup=failed";
                      </script>';
                      exit();
                    }
                    else{

                      $_SESSION['u_balance'] = $newbalance;
                      echo '<script>alert("Top up Successful! \\nClick OK Return to Homepage");
                      window.location.href = "../index.php?topup=success";
                      </script>';
                      exit();
                    }

//End Braces
}
}

}
}
}
}
}
}else{
  header("location: index.php?feature=useronly");
  exit();
}
}
}
