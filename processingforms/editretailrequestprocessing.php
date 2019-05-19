<?php

SESSION_START();

if(isset($_POST["editrequest"])){

    include 'dbconnection.php';

    //Product image target path
    $target = "../Resources/PendingLogos/" . basename($_FILES["image"]['name']);
    $imagefiletype = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    //Getting Variables from Upload Form
    $requestid = mysqli_real_escape_string($conn, $_POST['requestid']);
    $retailername = mysqli_real_escape_string($conn, $_POST['vendorname']);
    $retailerlogo = $_FILES['image']['name'];
    $requestdesc = mysqli_real_escape_string($conn, $_POST['vendordesc']);
    $retailerphoneno = mysqli_real_escape_string($conn, $_POST['retailerphone']);
    $retaileremail = mysqli_real_escape_string($conn, $_POST['retaileremail']);
    $retaileraddress1 = mysqli_real_escape_string($conn, $_POST['retaileraddressline1']);
    $retaileraddress2 = mysqli_real_escape_string($conn, $_POST['retaileraddressline2']);
    $bid = mysqli_real_escape_string($conn, $_POST['bid']);


    //Empty Fields check
    if(empty($retailername) || empty($retailerlogo) || empty($retaileremail) || empty($retailerphoneno) || empty($retaileraddress1) || empty($bid)){
       header("Location: ../retailereditapplication.php?upload=empty");
       exit();
     }
      else{
       //Checks if Image is an actual image or a fake image
       $imagecheck = getimagesize($_FILES['image']['tmp_name']);
       if($imagecheck == false){
        header("Location: ../retailereditapplication.php?upload=notanimage");
        exit();
      }
      else{
        //Allows certain image type formats - Only allows jpg, png, and jpeg
        if($imagefiletype != "jpg" && $imagefiletype != "jpeg" && $imagefiletype != "png"){
            header("Location:../retailereditapplication.php?upload=invalidfiletype");
            exit();
      }
      else{
          //Checks for Image size. Images above 500KB are not allowed
        if ($_FILES["image"]["size"] > 500000){
        header("Location: ../retailereditapplication.php?upload=filetoolarge");
        exit();
        }
        else{

          //Email Validation
          if(!filter_var($retaileremail, FILTER_VALIDATE_EMAIL)){
            header("Location: ../retailereditapplication.php?signup=invalidemail");
            exit();
          } else {

            //Validating phone number
            if(!preg_match('/^\+?\d+$/', $retailerphoneno)){
              header("Location: ../retailereditapplication.php?signup=invalidphonenumber");
              exit();
            }else{

        //Checking for the image and date added ONLY.
        $editDate = date("Y-m-d");

        //SQL Statement to Get Old Photo File
        $sqltest = "SELECT * FROM retailer_request WHERE req_id = '$requestid'";
        $result = mysqli_query($conn, $sqltest);
        $rescheck = mysqli_num_rows($result);
        if($rescheck <1){
        header("Location:../index.php?retailereditapplication=reqnotfound"); //Username Not Found Validation Check
        exit();
        }else{
        //Gathers Image File from Row Found
        if($row = mysqli_fetch_array($result)){

        $deletelogo = $row['retailer_logo'];

        //Deletes Old Logo
        if(!unlink('../Resources/PendingLogos/'. $deletelogo)){
          echo '<script>alert("Error: Previous Logo cannot be Deleted");
          window.location.href = "../retailereditapplication.php?prevlogodelete=error";
          </script>';
          exit();
        }else{

        //Checks if Image is Successfully Moved into Database
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

        //Insert image content into database

        $sql = "UPDATE retailer_request SET retailer_name = '$retailername', req_description = '$requestdesc' ,
        retailer_logo = '$retailerlogo', retailer_email = '$retaileremail' , retailer_phoneno = '$retailerphoneno', req_date = '$editDate',
        retailer_address1 = '$retaileraddress1', retailer_address2 = '$retaileraddress2', req_BID = '$bid'
        WHERE req_id = '$requestid'";

        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)<=0){ //If values fail to be moved into Database
        echo '<script>alert("Error in submitting request");
        window.location.href = "../retailereditapplication.php?requestsubmit=error";
        </script>';
        exit();
        }else{
        echo '<script>alert("Request Successfully Edited");
        window.location.href = "../index.php?editsubmit=success";
        </script>';
        exit();
        }
        }
        else{
        //Error moving image into target directory path
          echo '<script>alert("Error in moving retailer logo into Resource Folder!");
        window.location.href = "../retailereditapplication.php?requestsubmit=moveerror";
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
  header("Location: ../index?=nouploadbuttonclicked.php");
  exit();
}
?>
