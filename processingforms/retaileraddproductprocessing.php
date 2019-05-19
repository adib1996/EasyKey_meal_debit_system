<?php

SESSION_START();

if(isset($_POST["uploadproduct"])){

    include 'dbconnection.php';

    if(isset($_POST['productcategorybar'])){
      $prodcategorybar = mysqli_real_escape_string($conn, $_POST['productcategorybar']);
    }

    //Product image target path
    $targetpath = "../Resources/RetailerProducts/" . basename($_FILES["image"]['name']);
    $imagefiletype = strtolower(pathinfo($targetpath, PATHINFO_EXTENSION));

    //Getting Variables from Upload Form
    $prodname = mysqli_real_escape_string($conn, $_POST['productname']);
    $productdesc = mysqli_real_escape_string($conn, $_POST['productdesc']);
    $productprice = mysqli_real_escape_string($conn, $_POST['productprice']);
    $productimage = $_FILES['image']['name'];
    $prodcategoryinput = mysqli_real_escape_string($conn, $_POST['productcategoryinput']);
    $productstatus = 0; //Sets Product to Available by Default

    //Empty Fields check
    if(empty($prodname) || empty($productprice) || empty($productimage)){
       header("Location: ../retaileraddproduct.php?upload=empty");
       exit();
     }
     else{
      //Checks for product price. Has to be numbers only
       if(!is_numeric($productprice)){
         header("Location: ../retaileraddproduct.php?upload=invalidprice");
         exit();
     }
      else{
       //Checks if Image is an actual image or a fake image
       $imagecheck = getimagesize($_FILES['image']['tmp_name']);
       if($imagecheck == false){
        header("Location: ../retaileraddproduct.php?upload=notanimage");
        exit();
      }
      else{
        //Allows certain image type formats - Only allows jpg, png, and jpeg
        if($imagefiletype != "jpg" && $imagefiletype != "jpeg" && $imagefiletype != "png"){
            header("Location:../retaileraddproduct.php?upload=invalidfiletype");
            exit();
      }
      else{
          //Checks for Image size. Images above 500KB are not allowed
          if ($_FILES["image"]["size"] > 500000){
              header("Location: ../retaileraddproduct.php?upload=filetoolarge");
              exit();
      }
        else{
          //Checks if product image already exists in folder
          if(file_exists($targetpath)){
          header("Location: ../retaileraddproduct.php?upload=filealreadyexists");
          exit();
          }
        else{

          if(empty($prodcategorybar) && empty($prodcategoryinput)){
            header("Location: ../retaileraddproduct.php?upload=invalidcategory");
            exit();
          }

          else{

          // if($prodcategorybar!== "" && $prodcategoryinput == ""){
          //   $productcategory = $prodcategorybar;
          // }

          // else if($prodcategorybar == "" && $prodcategoryinput !== ""){
          //   $productcategory = $prodcategoryinput;
          // }

          if(!empty($prodcategorybar) && empty($prodcategoryinput)){
            $productcategory = $prodcategorybar;
          }
   
          else if(empty($prodcategorybar) && !empty($prodcategoryinput)){
            $productcategory = $prodcategoryinput;
          }
          
        //Checking for the image and date added ONLY.
        $addedDate = date("Y-m-d");

        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetpath)){

        //Gets Variable from User ID via Session
        $userid = $_SESSION['u_id'];

        //SQL Statement to get Retailer ID Variable
        $sql = "SELECT * FROM retailer_info WHERE user_id = '$userid'";
        $result = mysqli_query($conn, $sql);
        $rescheck = mysqli_num_rows($result);
        //No Result Found
        if($rescheck < 1){
          header("Location:../retaileraddproduct.php?upload=fatalerror"); //Username Not Found Validation Check
          exit();
        }else{
        //Places retailer ID in variable
        $row = mysqli_fetch_assoc($result);
        $retailerid = $row['retailer_id'];

        //Insert image content into database
        $sql = "INSERT into products (product_name, product_price, product_desc, product_img, product_category, product_AddDate, retailer_id, product_status)
        VALUES ('$prodname', '$productprice', '$productdesc', '$productimage', '$productcategory', '$addedDate', '$retailerid', '$productstatus');";
        mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)<=0){
        //Error in adding product
          echo '<script>alert("Error in adding product!");
        window.location.href = "../retaileraddproduct.php?upload=error";
        </script>';
        exit();
        }
        else{
        //Product Successfully added into Database and Displayed in Gallery
          echo '<script>alert("Product Successfully Added!");
        window.location.href = "../index.php?uploadproduct=success";
        </script>';
          exit();
        }
        }
        }
        else{
        //Error moving image into target directory path
          echo '<script>alert("Error in moving product image into Resource Folder!");
        window.location.href = "../retaileraddproduct.php?upload=moveerror";
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
