<?php

ob_start();

include 'header.php';

if($_SESSION['u_role'] == '3'){
?>

<div id="bodyindex">

<div class="activeordertable">


<!--Populates Table with Orders from Database-->
<?php
include 'processingforms/dbconnection.php'; //Includes database connection

$userid = $_SESSION['u_id'];

//SQL to get Active Orders
$sql = "SELECT orders.*, retailer_info.user_id 
FROM orders 
JOIN retailer_info ON orders.retailer_id = retailer_info.retailer_id 
WHERE retailer_info.user_id = '$userid' AND orders.order_status = '0'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) <= 0) //No result gathered
{
  echo "<p>No orders as of yet</p>";
}else{
    ?>

    <!--Constructs table in table format-->

    <h1 style="text-align:center;">Active Orders</h1>
    <table class="activetable" style="text-align:center;" border="0">
      <tr class="activeordertablerow">
        <th>Order ID</th>
        <th>Date</th>
        <th>Grand Total</th>
        <th colspan="3">Action</th>
      </tr>

    <?php

    while($rows = mysqli_fetch_array($result))
    {

      $orderid = $rows['order_id'];

    ?>

    <!--Displays product information in table format-->

      <?php
      echo"<tr>";
      echo"<td>" . $rows['order_id'] . "</td>";
      echo"<td>" . $rows['order_date'] . "</td>";
      echo"<td>RM " . $rows['order_grandtotal'] . "</td>";
      echo"<td><a href='processingforms/retailercompleteorder.php?orderid=$orderid'>Complete Order</a></td>";
      echo"<td><a href='processingforms/retailercancelorder.php?orderid=$orderid'>Cancel Order</a></td>";
      echo"<td><a href='vieworderdetail.php?orderid=$orderid'>View More</a></td>";
      echo"</tr>";
      //End of SQL Query
    }
}
?>


<?php
echo '</table>';
}else{
  header('location: index.php?restricted');
  exit();
}
?>

</div>

</div>

<?php

include 'footer.php';
?>
