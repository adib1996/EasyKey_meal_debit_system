<?php

SESSION_START();

include 'dbconnection.php';

if(!isset($_SESSION['u_id'])){

    header("Location: ../index.php?restricted");
    exit();

}else{

    $userid = $_SESSION['u_id'];

    $sql = "DELETE FROM users WHERE user_id = '$userid'";

    mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) <=0){

        echo '<script>alert("Unable to Delete Profile\\nPlease Try Again!");
        window.location.href = "../profiledashboard.php?delete=unsuccessful";
        </script>';
         exit();

    }else{

        SESSION_UNSET();
        SESSION_DESTROY();

    echo '<script>alert("Your account has been deleted! \\nWe hope to see you soon again.");
          window.location.href = "../index.php";
          </script>';
          exit();

    }

}