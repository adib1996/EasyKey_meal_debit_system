<?php

ob_start();

include 'header.php';

if($_SESSION['u_role'] !== '3'){
  header('location: index.php?retaileronly');
  exit();
}else{
?>

<div id="bodyindex">

<div class="errorsuccesspanel">
  <?php

  //Retailer Edit Product Processing Form
  if(strpos($fullURL, "editproduct=editsuccess") == TRUE){
    echo "<p class='success'>Product Info Edited!</p>";
  }

  //Retailer Edit Product Processing Form
  else if(strpos($fullURL, "deleteproduct=success") == TRUE){
    echo "<p class='success'>Product Deleted!</p>";
  }

  //Retailer Edit Product Processing Form
  else if(strpos($fullURL, "editproduct=unsuccessful") == TRUE){
    echo "<p class='error'>Unable to edit product information</p>";
  }

  //Retailer Edit Product Processing Form
  else if(strpos($fullURL, "editproduct=restricteditem") == TRUE){
    echo "<p class='error'>Item Restricted!</p>";
  }

  ?>
</div>

<div class="viewproducttable">

<div class="viewproducttitle">
<h1>Your Products</h1>
</div>

  <!--Populates Table with Products from Database-->
  <?php
  include 'processingforms/dbconnection.php'; //Includes database connection

  $userid = $_SESSION['u_id'];

  //SQL to get Products
  $sql = "SELECT products.*, retailer_info.user_id FROM products JOIN retailer_info
  ON products.retailer_id = retailer_info.retailer_id WHERE retailer_info.user_id = '$userid'";
  
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) <= 0) //No result gathered
  {
    echo "<p>No products available for show.</p>";
    echo "<a href='retaileraddproduct.php'>Add a product here</a>";

  }else{
      ?>

      <!--Constructs table in table format-->

      <table class="displaytable" border="0">
        <tr class="displayrow">
          <th>Product Name</th>
          <th>Product Price</th>
          <th>Product Image</th>
          <th>Product Desc</th>
          <th>Added Date</th>
          <th colspan="2">Actions</th>
        </tr>

      <?php

      while($rows = mysqli_fetch_array($result))
      {
      ?>

      <!--Displays product information in table format-->

        <?php
        echo"<tr>";
        echo"<td>" . $rows['product_name'] . "</td>";
        echo"<td>" . "RM" . $rows['product_price'] . "</td>";
        echo"<td>";
        echo"<img height='180' width = '180'";
        echo"src = Resources/RetailerProducts/";
        echo $rows['product_img'];
        echo ">";
        echo"</td>";
        echo"<td>" . $rows['product_desc'] . "</td>";
        echo"<td>" . $rows['product_AddDate'] . "</td>";
        //2 Buttons (Edit, Delete in Each Product Row)
        echo"<td><a href='retailereditproduct.php?productid=".$rows['product_id'] ."'><button>Edit</button></a></td>";
        echo"<td><a href='processingforms/retailerdeleteproductprocessing.php?productimg=".$rows['product_img'] ."'><button>Delete</button></a></td>";
        echo"</tr>";
        //End of SQL Query
      }
  }
  ?>

</table>
</div>
</div>

<?php
}
include 'footer.php';
?>
