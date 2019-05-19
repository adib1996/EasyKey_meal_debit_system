<?php

ob_start();

include 'header.php';

if($_SESSION['u_role'] !== '1'){
  header('location: index.php?adminonly');
  exit();
}else{

    if(!isset($_GET['userid'])){
      header('location: index.php?nouserid');
      exit();
    }else{

        $userid = $_GET['userid'];
?>

<div id="bodyindex">

<div class="orderhistorytable">

<!--Populates Table with Products from Database-->
<?php
include 'processingforms/dbconnection.php'; //Includes database connection

//SQL to get Products
$sql = "SELECT orders.order_id, orders.order_date, orders.order_grandtotal, users.user_id, users.user_firstname, users.user_lastname, retailer_info.retailer_name
FROM orders JOIN users ON orders.user_id = users.user_id
JOIN retailer_info ON orders.retailer_id = retailer_info.retailer_id
WHERE orders.user_id = '$userid'
ORDER BY orders.order_date DESC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) <= 0) //No result gathered
{
  echo "<p>No order history vailable</p>";
  
}else{
    ?>

    <!--Constructs table in table format-->

    <h1 style="text-align:center;">Order History</h1>
    <table class="historytable" style="text-align:center;" border="0">
      <tr class="orderhistorytablerow">
        <th width="10%">Order ID</th>
        <th width="20%">Retailer Name</th>
        <th width="10%">Date</th>
        <th>User ID</th>
        <th width="10%">First Name</th>
        <th width="10%">Last Name</th>
        <th>Grand Total</th>
        <th>Action</th>
      </tr>

    <?php

    while($rows = mysqli_fetch_array($result))
    {

      $orderid = $rows['order_id'];

    ?>

      <?php
      echo"<tr>";
      echo"<td>" . $rows['order_id'] . "</td>";
      echo"<td>" . $rows['retailer_name'] . "</td>";
      echo"<td>" . $rows['order_date'] . "</td>";
      echo"<td>" . $rows['user_id'] . "</td>";
      echo"<td>" . $rows['user_firstname'] . "</td>";
      echo"<td>" . $rows['user_lastname'] . "</td>";
      echo"<td>RM " . $rows['order_grandtotal'] . "</td>";
      echo"<td><a href='vieworderdetail.php?orderid=$orderid'>View More</a></td>";
      echo"</tr>";
      //End of SQL Query
    }
}
?>


<?php
echo '</table>';
}
}
?>

</div>

</div>

<?php
include 'footer.php';
?>
