<?php

ob_start();

include 'header.php';

if(!isset($_GET['orderid'])){
  header('location: index.php?noorderid');
  exit();
}
else if($_SESSION['u_role'] == '0' || $_SESSION['u_role'] == '1' || $_SESSION['u_role'] == '7' || $_SESSION['u_role'] == '3'){

  $orderid = $_GET['orderid'];

?>

<div id="bodyindex">
<div class="orderdetailtable">


<!--Populates Table with Products from Database-->
<?php
include 'processingforms/dbconnection.php'; //Includes database connection

//SQL to get Products
$sql = "SELECT orders.*, products.product_name, products.product_price, products.product_desc,
products.product_img, order_details.product_quantity
FROM products
JOIN order_details ON products.product_id = order_details.product_id 
JOIN orders ON order_details.order_id = orders.order_id
WHERE order_details.order_id = '$orderid'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) <= 0) //No result gathered
{
  echo "<p>Error: Order not found</p>";
  
}else{
    ?>

    <!--Constructs table in table format-->
    <div class="detailtitle">
    <h1>Order #<?php echo $orderid; ?></h1>
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
?>

</table>

<?php
  $sql = "SELECT users.*, orders.*, products.product_name, products.product_price, products.product_desc,
  products.product_img, order_details.product_quantity
  FROM products
  JOIN order_details ON products.product_id = order_details.product_id 
  JOIN orders ON order_details.order_id = orders.order_id
  JOIN users ON orders.user_id = users.user_id
  WHERE order_details.order_id = '$orderid'";

  $result = mysqli_query($conn, $sql);
  $row2 = mysqli_fetch_array($result);

  if($row2['order_status'] == "0"){
    $orderstatus = "ACCEPTED";
  }else if($row2['order_status'] == "1"){
    $orderstatus = "COMPLETED";
  }else if($row2['order_status'] == '2'){
    $orderstatus = "CANCELLED";
  }
?>

<div class="delivaddress">
<h1>Delivery Details</h1>

<div class="addressinfo">

<div class="addressinfoleft">

<p>First Name: <?php echo $row2['user_firstname']; ?> </p>
<p>Last Name: <?php echo $row2['user_lastname']; ?> </p>
<p>Phone Number: <?php echo $row2['user_phonenumber']; ?> </p>
</br>
<h1>Status: <?php echo $orderstatus; ?> </h1>

</div>

<div class="addressinforight">

<p>Country: <?php echo $row2['order_country'];?> </p>
<p>Province: <?php echo $row2['order_province'];?> </p>
<p>City: <?php echo $row2['order_city'];?> </p>
<p>Address Line 1: <?php echo $row2['order_addressline1'];?> </p>
<p>Address Line 2: <?php echo $row2['order_addressline2'];?> </p>
<p>Zipcode: <?php echo $row2['order_zipcode'];?> </p>

</div>

</div>

</div>

<?php
  if($_SESSION['u_role'] == '3'){

echo '<div class="completecancel">';
echo "<a href='processingforms/retailercompleteorder.php?orderid=$orderid'>Complete Order</a>";
echo "<a href='processingforms/retailercancelorder.php?orderid=$orderid'>Cancel Order</a>";
echo '</div>';

  }
?>

</div>
</div>


<?php
}
}  
else{
  header('location: index.php?restricted');
exit();
}
include 'footer.php';
?>
