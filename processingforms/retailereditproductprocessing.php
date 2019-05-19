<?php
SESSION_START();
?>
<?php

if(isset($_POST['editproduct'])){

  include_once 'dbconnection.php';

  if(isset($_POST['productcategorybar'])){
    $prodcategorybar = mysqli_real_escape_string($conn, $_POST['productcategorybar']);
  }

  $productid = mysqli_real_escape_string($conn, $_POST['productid']);
  $newprodname = mysqli_real_escape_string($conn, $_POST['productname']);
  $newproductdesc = mysqli_real_escape_string($conn, $_POST['productdesc']);
  $newproductprice = mysqli_real_escape_string($conn, $_POST['productprice']);
  $prodcategoryinput = mysqli_real_escape_string($conn, $_POST['productcategoryinput']);
  $productstatus = 0; //Product Enabled

  if(isset($_POST['disablecheckbox'])){ //If Product is Disabled, sets value to 1
    $productstatus = 1;
  }

  //Empty Fields check
  if(empty($newprodname) || empty($newproductprice)){
     header("Location: ../retailereditproduct.php?productid=$productid&editproduct=empty");
     exit();
   }
   else{
    //Checks for product price. Has to be numbers only
     if(!is_numeric($newproductprice)){
       header("Location: ../retailereditproduct.php?productid=$productid&editproduct=invalidprice");
       exit();
   }
   else{

     if(empty($prodcategorybar) && empty($prodcategoryinput)){
       header("Location: ../retailereditproduct.php?productid=$productid&editproduct=invalidcategory");
       exit();
     }

     else{

       if(!empty($prodcategorybar) && empty($prodcategoryinput)){
         $productcategory = $prodcategorybar;
       }

       else if(empty($prodcategorybar) && !empty($prodcategoryinput)){
         $productcategory = $prodcategoryinput;
       }

     //Notes down edited date
     $EditedDate = date("Y-m-d");

     //Updates Database
     $sql = "UPDATE products SET product_name = '$newprodname', product_desc = '$newproductdesc', product_category = '$productcategory',
      product_price = '$newproductprice', product_AddDate = '$EditedDate' , product_status = '$productstatus' WHERE product_id = '$productid'";

      mysqli_query($conn, $sql);

      //Checks if Any Row is Updated or not.
      if(mysqli_affected_rows($conn) <=0)
      {
       echo '<script>alert("Unable to Edit Product Information! \\nPlease Try Again!");
       window.location.href = "../retailerviewproduct.php?editproduct=unsuccessful";
       </script>';
        exit();
      }else{
        echo '<script>alert("Edit Successful! \\nClick to Return to Homepage");
        window.location.href = "../retailerviewproduct.php?editproduct=editsuccess";
        </script>';
        exit();
      }
}
}
}
//End of General If Function
}
else{
  header("Location: ../index.php?edit=noeditproductbutton");
  exit();
}

?>
