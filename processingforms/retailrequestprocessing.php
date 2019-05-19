<?php

SESSION_START();

if(isset($_POST["submit"])){

    include_once 'dbconnection.php';

    //Product image target path
    $target = "../Resources/PendingLogos/" . basename($_FILES["image"]['name']);
    $imagefiletype = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    //Getting Variables from Upload Form
    $retailername = mysqli_real_escape_string($conn, $_POST['vendorname']);
    $requestdesc = mysqli_real_escape_string($conn, $_POST['vendordesc']);
    $retaileraddress1 = mysqli_real_escape_string($conn, $_POST['retaileraddressline1']);
    $retaileraddress2 = mysqli_real_escape_string($conn, $_POST['retaileraddressline2']);
    $retailerzipcode = mysqli_real_escape_string($conn, $_POST['retailzipcode']);
    $retaileremail = mysqli_real_escape_string($conn, $_POST['retaileremail']);
    $retailerphoneno = mysqli_real_escape_string($conn, $_POST['retailerphoneno']);
    $retailerlogo = $_FILES['image']['name'];

    $bid = mysqli_real_escape_string($conn, $_POST['bid']);


    //Empty Fields check
    if(empty($retailername) || empty($retailerlogo) || empty($retaileraddress1)
     || empty($retailerzipcode) || empty($retailerphoneno) || empty($retaileremail) || empty($bid)){
       header("Location: ../retailersignup.php?upload=empty");
       exit();
     }
      else{

       //Checks if Image is an actual image or a fake image
       $imagecheck = getimagesize($_FILES['image']['tmp_name']);
       if($imagecheck == false){
        header("Location: ../retailersignup.php?upload=notanimage");
        exit();
      }
      else{

        //Allows certain image type formats - Only allows jpg, png, and jpeg
        if($imagefiletype != "jpg" && $imagefiletype != "jpeg" && $imagefiletype != "png"){
            header("Location:../retailersignup.php?upload=invalidfiletype");
            exit();
      }
      else{

          //Checks for Image size. Images above 500KB are not allowed
          if ($_FILES["image"]["size"] > 500000){
              header("Location: ../retailersignup.php?upload=filetoolarge");
              exit();
      }
        else{

          //Checks if product image already exists in Logos folder
          if(file_exists($target)){
          header("Location: ../retailersignup.php?upload=filealreadyexists");
          exit();
          }
        else{

          //New Validations begin here
          //Email Validation
          if(!filter_var($retaileremail, FILTER_VALIDATE_EMAIL)){
            header("Location: ../retailersignup.php?signup=invalidemail");
            exit();
            }
            else{
              //Validating phone number
              if(!preg_match('/^\+?\d+$/', $retailerphoneno)){
                header("Location: ../retailersignup.php?signup=invalidphonenumber");
                exit();
              }else{

        //Checking for the image and date added ONLY.
        $addedDate = date("Y-m-d");
        $userid = $_SESSION['u_id'];
        $statusmessage = "PENDING";
        $pendingstatus = '2';

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

        //Insert image content into database

        $sql = "INSERT INTO retailer_request (user_id, retailer_name, retailer_email, retailer_phoneno, retailer_logo, retailer_address1,
          retailer_address2, retailer_zipcode, req_date, req_status, req_description, req_BID)
        VALUES ('$userid', '$retailername', '$retaileremail', '$retailerphoneno', '$retailerlogo', '$retaileraddress1',
           '$retaileraddress2', '$retailerzipcode', '$addedDate', '$statusmessage', '$requestdesc', '$bid');";

        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)<=0){ //If values fail to be moved into Database
        echo '<script>alert("Error in submitting request");
        window.location.href = "../retailersignup.php?requestsubmit=error";
        </script>';
        exit();
        }
        else{

        //Updates user role to show that the retailer had sent a request
        $sql2 = "UPDATE users SET user_role = '2' WHERE user_id = '$userid'";

        mysqli_query($conn, $sql2);

        if(mysqli_affected_rows($conn)<=0){ //Update Fails
          echo '<script>alert("Error");
          window.location.href = "../retailersignup.php?requestsubmit=error";
          </script>';
          exit();
        }
        else{
        //Sets Request Status to Pending
        $_SESSION['u_role'] = $pendingstatus;

        echo '<script>alert("Request Successfully Sent");
        window.location.href = "../index.php?requestsubmit=success";
        </script>';
          exit();
        }
        }
        }
        else{
        //Error moving image into target directory path
          echo '<script>alert("Error in moving retailer logo into Resource Folder!");
        window.location.href = "../retailersignup.php?requestsubmit=moveerror";
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
//End of General Isset Check
}
else{
  header("Location: ../index?=nouploadbuttonclicked.php");
  exit();
}
?>
