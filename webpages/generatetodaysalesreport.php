<?php
SESSION_START();
?>

<link rel="stylesheet" type="text/css" href="Styles/salesreports.css">
<link rel ="shortcut icon" type="image/png" href="Resources/Logos/logo.png">



    <?php

    //Checks if there is a user logged in

    if(!isset($_SESSION['u_id'])){
    header("location: index.php?notloggedin"); //Sends unauthorized user back to homepage
    exit();
    }else{

    //Only authorizes admins to view this page

    if($_SESSION['u_role'] !== '1'){
    header("location: index.php?feature=adminonly"); //Sends customer/retailer back to homepage
    exit();
    }else{

      include 'processingforms/dbconnection.php'; //Includes database connection
?>

<?php

      $sql = "SELECT orders.order_id, users.user_id, users.user_firstname, users.user_lastname, orders.order_date, orders.order_grandtotal, retailer_info.retailer_name
      FROM orders
      INNER JOIN retailer_info ON orders.retailer_id = retailer_info.retailer_id
      INNER JOIN users ON orders.user_id = users.user_id
      WHERE MONTH(orders.order_date) = MONTH(CURRENT_DATE()) AND DAY(orders.order_date) = DAY(CURRENT_DATE()) AND orders.order_status = '1'";

      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) <= 0) //If no result gathered
      {
        echo "<p>No sales made today</p>";
      }else{

?>
<title>Daily Sales Report</title>

<div class="dailysalesreport">

  <img width="210" height="100" src="Resources/Logos/logo.png" />

<h1>Daily Sales Report</h1>

<div class="infosection">

<p>Date: <?php echo date("Y-m-d"); ?></p>

</div>

<table class="displaytable" border="1" width="1200">
  <tr class="displayrow">
    <th>Order ID</th>
    <th>Retailer Name</th>
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Order Date</th>
    <th>Order Total</th>
  </tr>

<?php

  //Gets Sum of selected Month
  $sql2 = "SELECT ROUND(SUM(orders.`order_grandtotal`),2) AS 'Total'
  FROM orders
  WHERE MONTH(orders.order_date) = MONTH(CURRENT_DATE()) 
  AND DAY(orders.order_date) = DAY(CURRENT_DATE()) 
  AND orders.order_status = '1'";
  
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  $sum = $row2['Total'];

  //Displays Data Found
  while($rows = mysqli_fetch_array($result)) //Stores database values in variables
  {
    echo"<tr>";
    echo"<td>" . $rows['order_id'] . "</td>";
    echo"<td>" . $rows['retailer_name'] . "</td>";
    echo"<td>" . $rows['user_id'] . "</td>";
    echo"<td>" . $rows['user_firstname'] . "</td>";
    echo"<td>" . $rows['user_lastname'] . "</td>";
    echo"<td>" . $rows['order_date'] . "</td>";
    echo"<td>RM " . $rows['order_grandtotal'] . "</td>";
    echo"</tr>";

    //End of SQL Query
  }
    echo"<tr>";
    echo"<td colspan='7' style='height:24px;'> </td>";
    echo"</tr>";
    echo"<td colspan='5'></td>";
    echo"<td>Total</td>";
    echo"<td>RM " . $sum . "</td>";
  ?>
</table>
</div>

<?php
}
}
}
?>
