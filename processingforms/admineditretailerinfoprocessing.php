<?php

SESSION_START();

if(isset($_POST["admineditinfo"])){

    include_once 'dbconnection.php';

    //Product image target path
    // $target = "../Resources/PendingLogos/" . basename($_FILES["image"]['name']);
    // $imagefiletype = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    //Gathers Variables
    $retailerid = mysqli_real_escape_string($conn, $_POST['admineditretailerid']);
    $retailername = mysqli_real_escape_string($conn, $_POST['admineditretailername']);
    $retaileremail = mysqli_real_escape_string($conn, $_POST['admineditretaileremail']);
    $retailerphoneno = mysqli_real_escape_string($conn, $_POST['admineditretailerphoneno']);
    $retaileraddress1 = mysqli_real_escape_string($conn, $_POST['admineditretaileraddress1']);
    $retaileraddress2 = mysqli_real_escape_string($conn, $_POST['admineditretaileraddress2']);
    $retailerzipcode = mysqli_real_escape_string($conn, $_POST['admineditretailerzipcode']);
    // $retailerlogo = $_FILES['image']['name'];

    //Empty Fields check
    if(empty($retailername) || empty($retaileraddress1)
     || empty($retailerzipcode)){
       header("Location: ../admineditretailerinfo.php?retailerid=$retailerid&upload=empty");
       exit();
     }
      else{

          //Email Validation
          if(!filter_var($retaileremail, FILTER_VALIDATE_EMAIL)){
            header("Location: ../admineditretailerinfo.php?retailerid=$retailerid&resubmit=invalidemail");
            exit();
          } else {

            //Validating phone number
            if(!preg_match('/^\+?\d+$/', $retailerphoneno)){
              header("Location: ../admineditretailerinfo.php?retailerid=$retailerid&resubmit=invalidphonenumber");
              exit();
            }else{

                  $sql = "UPDATE retailer_info SET retailer_name = '$retailername',
                  retailer_address1 = '$retaileraddress1', retailer_address2 = '$retaileraddress2', retailer_email = '$retaileremail', retailer_phoneno = '$retailerphoneno' , retailer_zipcode = '$retailerzipcode' 
                  WHERE retailer_id = '$retailerid'";

                  mysqli_query($conn, $sql);

                  if(mysqli_affected_rows($conn)<=0){ //If values fail to be moved into Database
                  echo '<script>alert("Error in editing reapplication");
                  window.location.href = "../adminviewallretailers.php?admineditinfo=error";
                  </script>';
                  exit();
                  }
                  
                  else{

                  //Edit Successful
                  echo '<script>alert("Retailer Information Edited");
                  window.location.href = "../adminviewallretailers.php?admineditinfo=success";
                  </script>';
                  exit();
                  }
        
      }
    }
}
//End of General Isset Check
}else{
  header("Location: ../index?=noresubmitbuttonclicked.php");
  exit();
}
?>
