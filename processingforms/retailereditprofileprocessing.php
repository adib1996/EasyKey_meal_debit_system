<?php

SESSION_START();

if(isset($_POST["editinfo"])){

    include_once 'dbconnection.php';

    $userid = $_SESSION['u_id'];

    //Product image target path
    $target = "../Resources/PendingLogos/" . basename($_FILES["image"]['name']);
    $imagefiletype = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    $retailername = mysqli_real_escape_string($conn, $_POST['editretailername']);
    $retaileremail = mysqli_real_escape_string($conn, $_POST['editretaileremail']);
    $retailerphoneno = mysqli_real_escape_string($conn, $_POST['editretailerphoneno']);
    $retaileraddress1 = mysqli_real_escape_string($conn, $_POST['editretaileraddress1']);
    $retaileraddress2 = mysqli_real_escape_string($conn, $_POST['editretaileraddress2']);
    $retailerzipcode = mysqli_real_escape_string($conn, $_POST['editretailerzipcode']);
    $retailerlogo = $_FILES['image']['name'];

    //Empty Fields check
    if(empty($retailername) || empty($retailerlogo) || empty($retaileraddress1) || empty($retaileremail)
     || empty($retailerzipcode)){
       header("Location: ../retailereditprofile.php?upload=empty");
       exit();
     }
      else{
       //Checks if Image is an actual image or a fake image
       $imagecheck = getimagesize($_FILES['image']['tmp_name']);
       if($imagecheck == false){
        header("Location: ../retailereditprofile.php?upload=notanimage");
        exit();
      }
      else{
        //Allows certain image type formats - Only allows jpg, png, and jpeg
        if($imagefiletype != "jpg" && $imagefiletype != "jpeg" && $imagefiletype != "png"){
            header("Location:../retailereditprofile.php?upload=invalidfiletype");
            exit();
      }
      else{
          //Checks for Image size. Images above 500KB are not allowed
        if ($_FILES["image"]["size"] > 500000){
        header("Location: ../retailereditprofile.php?upload=filetoolarge");
        exit();
        }
        else{

          //Email Validation
          if(!filter_var($retaileremail, FILTER_VALIDATE_EMAIL)){
            header("Location: ../retailereditprofile.php?resubmit=invalidemail");
            exit();
          } else {

            //Validating phone number
            if(!preg_match('/^\+?\d+$/', $retailerphoneno)){
              header("Location: ../retailereditprofile.php?resubmit=invalidphonenumber");
              exit();
            }else{

        //SQL Statement to Get Old Photo File
        $sqltest = "SELECT * FROM retailer_info WHERE user_id = '$userid'";
        $result = mysqli_query($conn, $sqltest);
        $rescheck = mysqli_num_rows($result);
        if($rescheck < 1){
        header("Location:../index.php?retailereditprofile=reqnotfound"); //Username Not Found Validation Check
        exit();
        }else{
        //Gathers Image File from Row Found
        if($row = mysqli_fetch_array($result)){

        $deletelogo = $row['retailer_logo'];

        //Deletes Old Logo
        if(!unlink('../Resources/PendingLogos/'. $deletelogo)){
          echo '<script>alert("Error: Previous Logo cannot be Deleted");
          window.location.href = "../retailereditprofile.php?prevlogodelete=error";
          </script>';
          exit();
        }else{

        //Checks if Image is Successfully Moved into Database
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

        //Insert image content into database

        $sql = "UPDATE retailer_info SET retailer_name = '$retailername',
        retailer_address1 = '$retaileraddress1', retailer_address2 = '$retaileraddress2', retailer_email = '$retaileremail', retailer_phoneno = '$retailerphoneno' , retailer_zipcode = '$retailerzipcode' ,
        retailer_logo = '$retailerlogo' WHERE user_id = '$userid'";

        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)<=0){ //If values fail to be moved into Database
        echo '<script>alert("Error in submitting reapplication");
        window.location.href = "../retailereditprofile.php?retailereditinfo=error";
        </script>';
        exit();
        }else{

        echo '<script>alert("Retailer Information Edited");
        window.location.href = "../index.php?retailereditinfo=success";
        </script>';
        exit();
        }
        }
        else{
        //Error moving image into target directory path
          echo '<script>alert("Error in moving retailer logo into Resource Folder!");
        window.location.href = "../retailereditprofile.php?retailereditinfo=moveerror";
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
//End of General Isset Check
}
else{
  header("Location: ../index?=noresubmitbuttonclicked.php");
  exit();
}
?>
