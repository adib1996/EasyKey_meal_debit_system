<?php

ob_start();

include 'header.php';

if($_SESSION['u_role'] !== '3'){
  header('location: index.php?retaileronly');
  exit();
}else{

  //Gets Retailer ID
  include 'processingforms/dbconnection.php';

  $userid = $_SESSION['u_id'];

  $getretailerid = "SELECT retailer_id FROM retailer_info WHERE user_id = '$userid'";
  $results = mysqli_query($conn, $getretailerid);

  $retaileridrow = mysqli_fetch_array($results);

  $retailerid = $retaileridrow['retailer_id'];

?>

<div id="bodyindex">

<div class="errorsuccesspanel">
  <?php
  //These message display whenever the URL detects a certain string.
  //Signup Page
  if(strpos($fullURL, "upload=empty") == TRUE) {
      echo "<p class='error'>Fill in all fields correctly</p>";
  }

  else if(strpos($fullURL, "upload=invalidprice") == TRUE){
    echo "<p class='error'>Enter a valid price for your product</p>";
  }

  else if(strpos($fullURL, "upload=notanimage") == TRUE){
    echo "<p class='error'>Uploaded file is not an image</p>";
  }

  else if(strpos($fullURL, "upload=filetoolarge") == TRUE){
    echo "<p class='error'>Image must not exceed 500KB in size</p>";
  }

  else if(strpos($fullURL, "upload=filealreadyexists") == TRUE){
    echo "<p class='error'>Image already exists</p>";
  }

  else if(strpos($fullURL, "upload=invalidcategory") == TRUE){
    echo "<p class='error'>Select an appropriate category</p>";
  }

  else if(strpos($fullURL, "upload=error") == TRUE){
    echo "<p class='error'>An error has occured, please try again</p>";
  }

  else if(strpos($fullURL, "upload=moveerror") == TRUE){
    echo "<p class='error'>Failed moving image to destination folder</p>";
  }
  ?>
</div>

<div class="uploadprodpanel">
<form name="uploadprod" action="processingforms/retaileraddproductprocessing.php" method="post" enctype="multipart/form-data">

  <h1>Add Product</h1>

  <div class="uploadprodname">
    <label>Product Name</label>
    <input type="text" name="productname" placeholder="Product Name" required/>
  </div>

  <div class="uploadprodprice">
    <label>Product Price</label>
      <input type="text" name="productprice" placeholder="Product Price" required/>
  </div>

  <div class="selectcategory">

  <label>Food Category</label>

    <div class="categoryselect">

      <?php

      $categorysql = "SELECT DISTINCT product_category FROM products WHERE retailer_id = '$retailerid' AND product_category != '' ORDER BY product_category ";
      $catsgathered = mysqli_query($conn, $categorysql);

      ?>

      <select name="productcategorybar" id="categoryselectbar">

        <label>Select from your Categories below</label>
        <option value="" disabled selected>Select Category</option>
        <?php


          while($row = mysqli_fetch_array($catsgathered)){

        ?>

        <option value="<?php echo $row['product_category'] ; ?>"><?php echo $row['product_category'] ; ?></option>

        <?php
        }
        ?>

      </select>
    </div>

    <div class="checkboxescategory">

    <div class="test2">
      <input type="checkbox" name="selectcats" onchange = "showHide()" id="catenabler">
    </div>

    <div class="test1">
      <label>Input a New Category</label>
    </div>

    </div>

      <input id="category" style="display:none" type="text" name="productcategoryinput" placeholder="Product Category"/>

  </div>

  <div class="uploadproductdesc">
    <label>Product Description</label>
    <textarea name="productdesc" placeholder="Product Description"></textarea>
  </div>

  <div class="uploadprodimage">
    <label>Select image to upload:</label>
    <input type="file" name="image"/>
  </div>

  <div class="uploadprodbutton">
  <button type="submit" name="uploadproduct">Add Product</button>
  </div>


</form>
</div>
</div>

<script>

      function showHide(){
        if(document.getElementById('catenabler').checked == true){
          document.getElementById('category').style.display='inline-block';

          document.getElementById('categoryselectbar').style.display='none';
          document.getElementById('categoryselectbar').value ="";

        }else{
          document.getElementById('category').style.display='none';
          document.getElementById('category').value ="";

          document.getElementById('categoryselectbar').style.display='inline-block';
        }
      }


// $('#catenabler').change(function() {
//     if($("#catenabler").is(':checked')) {
//         $("#selectcat").val("11");
//     }
// });

</script>

<?php
}
include 'footer.php';
?>
