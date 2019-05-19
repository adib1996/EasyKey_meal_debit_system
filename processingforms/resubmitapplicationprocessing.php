<?php

SESSION_START();

if(isset($_POST["resubmit"])){

    include_once 'dbconnection.php';

    //Product image target path
    $target = "../Resources/PendingLogos/" . basename($_FILES["image"]['name']);
    $imagefiletype = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    //Getting Variables from Upload Form
    $retailername = mysqli_real_escape_string($conn, $_POST['resubmitretailername']);
    $requestdesc = mysqli_real_escape_string($conn, $_POST['resubmitretailerdesc']);
    $retaileremail = mysqli_real_escape_string($conn, $_POST['resubmitretaileremail']);
    $retailerphoneno = mysqli_real_escape_string($conn, $_POST['resubmitretailerphoneno']);
    $retaileraddress1 = mysqli_real_escape_string($conn, $_POST['resubmitretaileraddress1']);
    $retaileraddress2 = mysqli_real_escape_string($conn, $_POST['resubmitretaileraddress2']);
    $retailerzipcode = mysqli_real_escape_string($conn, $_POST['resubmitretailerzipcode']);
    $retailerlogo = $_FILES['image']['name'];

    //Empty Fields check
    if(empty($retailername) || empty($retailerlogo) || empty($retaileraddress1)
     || empty($retailerzipcode) || empty($requestdesc)){
       header("Location: ../resubmitapplication.php?upload=empty");
       exit();
     }
      else{
       //Checks if Image is an actual image or a fake image
       $imagecheck = getimagesize($_FILES['image']['tmp_name']);
       if($imagecheck == false){
        header("Location: ../resubmitapplication.php?upload=notanimage");
        exit();
      }
      else{
        //Allows certain image type formats - Only allows jpg, png, and jpeg
        if($imagefiletype != "jpg" && $imagefiletype != "jpeg" && $imagefiletype != "png"){
            header("Location:../resubmitapplication.php?upload=invalidfiletype");
            exit();
      }
      else{
          //Checks for Image size. Images above 500KB are not allowed
        if ($_FILES["image"]["size"] > 500000){
        header("Location: ../resubmitapplication.php?upload=filetoolarge");
        exit();
        }
        else{

          //Email Validation
          if(!filter_var($retaileremail, FILTER_VALIDATE_EMAIL)){
            header("Location: ../resubmitapplication.php?resubmit=invalidemail");
            exit();
          } else {

            //Validating phone number
            if(!preg_match('/^\+?\d+$/', $retailerphoneno)){
              header("Location: ../resubmitapplication.php?resubmit=invalidphonenumber");
              exit();
            }else{

        //Checking for the image and date added ONLY.
        $resubmitDate = date("Y-m-d");
        $userid = $_SESSION['u_id'];
        $resubmitStatus = 'PENDING';

        //SQL Statement to Get Old Photo File
        $sqltest = "SELECT * FROM retailer_request WHERE user_id = '$userid'";
        $result = mysqli_query($conn, $sqltest);
        $rescheck = mysqli_num_rows($result);
        if($rescheck <1){
        header("Location:../index.php?resubmitapplication=reqnotfound"); //Username Not Found Validation Check
        exit();
        }else{
        //Gathers Image File from Row Found
        if($row = mysqli_fetch_array($result)){

        $deletelogo = $row['retailer_logo'];

        //Deletes Old Logo
        if(!unlink('../Resources/PendingLogos/'. $deletelogo)){
          echo '<script>alert("Error: Previous Logo cannot be Deleted");
          window.location.href = "../resubmitapplication.php?prevlogodelete=error";
          </script>';
          exit();
        }else{

        //Checks if Image is Successfully Moved into Database
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){

        //Insert image content into database

        $sql = "UPDATE retailer_request SET retailer_name = '$retailername', req_description = '$requestdesc' ,
        retailer_address1 = '$retaileraddress1', retailer_address2 = '$retaileraddress2', retailer_email = '$retaileremail', retailer_phoneno = '$retailerphoneno' , retailer_zipcode = '$retailerzipcode' ,
        retailer_logo = '$retailerlogo', req_date = '$resubmitDate' , req_status = '$resubmitStatus' WHERE user_id = '$userid'";

        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)<=0){ //If values fail to be moved into Database
        echo '<script>alert("Error in submitting reapplication");
        window.location.href = "../resubmitapplication.php?requestsubmit=error";
        </script>';
        exit();
        }else{

        //Changes User's Role back to Pending

        $pendingRole = '2';

        $sql = "UPDATE users SET user_role = '2' WHERE user_id = '$userid'";

        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)<=0){ //If values fail to be moved into Database
        echo '<script>alert("Error in submitting reapplication");
        window.location.href = "../resubmitapplication.php?rolechange=error";
        </script>';
        exit();
        }else{

        $_SESSION['u_role'] = $pendingRole;

        echo '<script>alert("Reapplication Successfully Sent");
        window.location.href = "../index.php?resubmitapp=success";
        </script>';
        exit();
        }
        }
        }
        else{
        //Error moving image into target directory path
          echo '<script>alert("Error in moving retailer logo into Resource Folder!");
        window.location.href = "../resubmitapplication.php?requestsubmit=moveerror";
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
