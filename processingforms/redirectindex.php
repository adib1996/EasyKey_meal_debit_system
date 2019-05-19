<?php

SESSION_START();
 
include 'dbconnection.php';

if(isset($_SESSION['u_role']) && ($_SESSION['u_role'] == "8")){

    //Sets Session Role Back to Customer
    $userid = $_SESSION['u_id'];
    $customerrole = 0;
    $updatecustrole = "UPDATE users SET user_role = '$customerrole' WHERE user_id = '$userid'";

    mysqli_query($conn, $updatecustrole);

    if(mysqli_affected_rows($conn)<=0){
        echo '<script>alert("Unable to Redirect!");
        window.location.href = "../index.php?redirect=error";
        </script>';
        exit();
    }else{

    $_SESSION['u_role'] = $customerrole;

    header('Location: ../index.php');

    }

}else{
    header('Location: index.php?restricted');
    exit();
}