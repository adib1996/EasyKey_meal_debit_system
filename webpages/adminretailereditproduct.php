<?php

ob_start();

include 'header.php';

if($_SESSION['u_role'] !== '1'){
  header('location: index.php?adminonly');
  exit();
}else{

  $prodid = $_GET['productid'];
  $retailerid = $_GET['retailerid'];

  include 'processingforms/dbconnection.php'; //Includes database connection

  $sql = "SELECT *  FROM products WHERE product_id = '$prodid'";
  $result = mysqli_query($conn, $sql);

  //Displays in Table
  if($rows=mysqli_fetch_array($result))
  {
  ?>

<div id="bodyindex">

<div class="errorsuccesspanel">

<?php
    //These message display whenever the URL detects a certain string.
    
    // Admin Edit Product Information Page

    if(strpos($fullURL, "editproduct=empty") == TRUE) {
        echo "<p class='error'>Please fill in all fields</p>";
    }

    else if(strpos($fullURL, "editproduct=invalidprice") == TRUE) {
      echo "<p class='error'>Invalid Price</p>";
    }

    else if(strpos($fullURL, "editproduct=invalidcategory") == TRUE) {
      echo "<p class='error'>Invalid Category</p>";
    }

    
?>

</div>

<form class="retailereditproduct" name="editproduct" action="processingforms/adminretailereditproductprocessing.php" method="post" enctype="multipart/form-data">

  <h1>Edit Product</h1>

  <div>
    <img height='180' width='180' src="Resources/RetailerProducts/<?php echo $rows["product_img"];?>"/>
  </div>

  <div class="disableitemcheckbox">
    <div class="disablecheckbox">
    <input type="checkbox" name="disablecheckbox" <?php echo ($rows['product_status']==1 ? 'checked' : '');?> >
    </div>

    <div class="disablelabel">
      <label>Disable Product</label>
    </div>
  </div>

  <div class="productid">
    <label>Product ID</label>
      <input type="text" name="productid" placeholder="Product ID" value="<?php echo $rows['product_id']?>" readonly/>
  </div>

  <div class="editproductname">
    <label>Product Name</label>
    <input type="text" name="productname" placeholder="Product Name" value="<?php echo $rows['product_name'];?>" required/>
  </div>

  <div class="editproductprice">
    <label>Product Price</label>
      <input type="text" name="productprice" placeholder="Product Price" value="<?php echo $rows['product_price'];?>" required/>
  </div>

  <div class="selectcategory">

  <label>Food Category</label>

    <div class="categoryselect">

      <select name="productcategorybar" id="categoryselectbar">

        <label>Select from your Categories below</label>
        <option value="<?php echo $rows['product_category']; ?>"<?php if ($rows['product_category'] == $rows['product_category']) echo "selected = 'selected'";?>><?php echo $rows['product_category']; ?></option>
        <?php

          $categorysql = "SELECT DISTINCT product_category FROM products WHERE retailer_id = '$retailerid' AND product_category != '' ORDER BY product_category ";
          $catsgathered = mysqli_query($conn, $categorysql);

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

  <div class="editproductdesc">
    <label>Product Description</label>
    <textarea name="productdesc" placeholder="Product Description"><?php echo $rows['product_desc'];?></textarea>
  </div>

  <div class="editproductsave">
  <button type="submit" name="admineditproduct">Save Changes</button>
  </div>


</form>
</div>

<script>

      function showHide(){
        if(document.getElementById('catenabler').checked == true){
          document.getElementById('category').style.display='inline-block';
          $('#category').attr('required', '');


          document.getElementById('categoryselectbar').style.display='none';
          document.getElementById('categoryselectbar').value ="";

        }else{
          document.getElementById('category').style.display='none';
          document.getElementById('category').value ="";
          $('#category').removeAttr('required');


          document.getElementById('categoryselectbar').style.display='inline-block';
        }
      }

</script>

<?php
}
else{
  header("Location: adminviewretailerproducts.php?noprodidfound");
  exit();
}
}

include 'footer.php';
?>
