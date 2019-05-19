<?php

ob_start();

include 'header.php';

if($_SESSION['u_role'] == '0' || $_SESSION['u_role'] == '7'){
?>

<div id="bodyindex">

<div class="orderhistorytable" style="width:40%; margin-left:350px;">


<!--Populates Table from Database-->
<?php
include 'processingforms/dbconnection.php'; //Includes database connection

$userid = $_SESSION['u_id'];

//SQL to get Products
$sql = "SELECT * FROM orders 
WHERE user_id = '$userid' AND order_status = '1' 
ORDER BY order_date DESC";

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
        <th width="25%">Order ID</th>
        <th width="25%">Date</th>
        <th width="25%">Grand Total</th>
        <th width="25%">Action</th>
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
      echo"<td><a href='vieworderdetail.php?orderid=$orderid'>View More</a></td>";
      echo"</tr>";
      //End of SQL Query
    }
}
?>


<?php
echo '</table>';
}else{
  header('location: index.php?customeronly');
  exit();
}
?>

</div>

</div>

<?php

include 'footer.php';
?>
