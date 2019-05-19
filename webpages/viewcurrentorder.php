<?php

ob_start();

include 'header.php';

if(!isset($_SESSION['u_id'])){

  header('location: singlelogin.php?notloggedin');
  exit();

}else if($_SESSION['u_role'] != "7"){

  header('location: index.php?restricted');
  exit();

}

else{

  include 'processingforms/dbconnection.php'; //Includes database connection

  $userid = $_SESSION['u_id'];

  //SQL to get Current Order - only one order

  $sql = "SELECT products.product_name, products.product_price, products.product_desc, products.product_img, order_details.product_quantity 
  FROM products JOIN order_details ON products.product_id = order_details.product_id 
  JOIN orders ON order_details.order_id = orders.order_id
  WHERE orders.order_status = '0' AND user_id = '$userid'";


  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) <= 0) //No result gathered
  {
    header('location: index.php?ordernotfound');
    exit();
  }else{
    ?>

    <div id="bodyindex">
    <div class="orderdetailtable">

    <!--Constructs table in table format-->
    <div class="detailtitle">
    <h1>Your Order</h1>
    </div>

    <table class="detailtable" border="0">
      <tr class="orderdetailtablerow">
        <th></th>
        <th>Product Name</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Product Quantity</th>
      </tr>

    <?php

    while($rows = mysqli_fetch_array($result))
    {
    ?>

    <!--Displays product information in table format-->

      <?php
      echo"<tr>";
      echo"<td>";
      echo"<img height='100' width ='100'";
      echo"src = Resources/RetailerProducts/";
      echo $rows['product_img'];
      echo ">";
      echo"</td>";
      echo"<td>" . $rows['product_name'] . "</td>";
      echo"<td>" . $rows['product_desc'] . "</td>";
      echo"<td>RM " . $rows['product_price'] . "</td>";
      echo"<td>" . $rows['product_quantity'] . "</td>";
      echo"</tr>";
      //End of SQL Query
    }
}
?>

</table>
<a id="gobackbutton" href="index.php">Go Back</a>
</div>
</div>
    
?>

</div>
</div>

<?php
}
include 'footer.php';
?>