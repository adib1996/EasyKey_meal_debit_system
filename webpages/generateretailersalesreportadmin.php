<?php
SESSION_START();
?>
<title>Retailer Sales Report</title>
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

if(isset($_POST['submit'])){

  $monthselected = mysqli_real_escape_string($conn, $_POST['monthselected']);
  $dayselected = mysqli_real_escape_string($conn, $_POST['dayselected']);
  $retailerid = mysqli_real_escape_string($conn, $_POST['retailerid']);

  if(empty($monthselected) && empty($dayselected) && empty($retailerid)){ //Not a month nor a day is selected
    echo '<script>alert("Unable to Generate Report! \\nPlease select a month and try again");
    window.location.href = "../viewtotalsalesreport.php?month=notselected";
    </script>';
    exit();
  }else if ($monthselected != "" && $dayselected == ""){

      //Gets Details where only month is selected

      $sql = "SELECT orders.order_id, users.user_id, users.user_firstname, users.user_lastname, orders.order_date, orders.order_grandtotal, retailer_info.retailer_name
      FROM orders
      INNER JOIN retailer_info ON orders.retailer_id = retailer_info.retailer_id
      INNER JOIN users ON orders.user_id = users.user_id
      WHERE MONTH(orders.order_date) = $monthselected 
      AND retailer_info.retailer_id = $retailerid
      AND orders.order_status = '1'
      ORDER BY orders.order_date DESC";

      $result = mysqli_query($conn, $sql);


      //Query is ONLY for Retrieving Restaurant Name
      $query = "SELECT retailer_id, retailer_name from retailer_info WHERE retailer_id = $retailerid";
      $tempquery = mysqli_query($conn, $query);
      $data = mysqli_fetch_array($tempquery);

      if(mysqli_num_rows($result) <= 0) //If no result gathered
      {
        echo "<p>No sales at this month</p>";
      }else{

?>

<title>Sales Report</title>

<div class="dailysalesreport">

  <img width="210" height="100" src="Resources/Logos/logo.png" />

<h1>Retailer Sales Report</h1>
<?php

$monthtext = "";

if($monthselected == '1'){
  $monthtext = "January";
}else if($monthselected == '2'){
  $monthtext = "February";
}else if($monthselected == '3'){
  $monthtext = "March";
}else if($monthselected == '4'){
  $monthtext = "April";
}else if($monthselected == '5'){
  $monthtext = "May";
}else if($monthselected == '6'){
  $monthtext = "June";
}else if($monthselected == '7'){
  $monthtext = "July";
}else if($monthselected == '8'){
  $monthtext = "August";
}else if($monthselected == '9'){
  $monthtext = "September";
}else if($monthselected == '10'){
  $monthtext = "October";
}else if($monthselected == '11'){
  $monthtext = "November";
}else if($monthselected == '12'){
  $monthtext = "December";
}
?>

<div class="infosection">

  <p>Retailer Name: <?php echo $data['retailer_name'];?></p>
  <p>Date: <?php echo date("Y-m-d"); ?></p>
  <p>Month: <?php echo $monthtext; ?></p>

</div>


<table class="displaytable" border="1" width="1200">
  <tr class="displayrow">
    <th>Order ID</th>
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Order Date</th>
    <th>Order Total</th>
  </tr>

<?php

  //Gets Sum of selected Month for Retailer

  $sql2 = "SELECT ROUND(SUM(orders.`order_grandtotal`),2) AS 'Total' 
  FROM orders 
  WHERE MONTH(orders.order_date) = $monthselected
   AND retailer_id = '$retailerid'
   AND orders.order_status = '1'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  $sum = $row2['Total'];

  //Displays Data Found
  while($rows = mysqli_fetch_array($result)) //Stores database values in variables
  {
    echo"<tr>";
    echo"<td>" . $rows['order_id'] . "</td>";
    echo"<td>" . $rows['user_id'] . "</td>";
    echo"<td>" . $rows['user_firstname'] . "</td>";
    echo"<td>" . $rows['user_lastname'] . "</td>";
    echo"<td>" . $rows['order_date'] . "</td>";
    echo"<td>RM " . $rows['order_grandtotal'] . "</td>";
    echo"</tr>";

    //End of SQL Query
  }
    echo"<tr>";
    echo"<td colspan='6' style='height:24px;'> </td>";
    echo"</tr>";
    echo"<td colspan='4'></td>";
    echo"<td>Monthly Total</td>";
    echo"<td>RM " . $sum . "</td>";
  ?>
</table>

</div>











<?php
}
}else if($monthselected != "" && $dayselected !=""){

//BOTH Month and Day Selected

$sql = "SELECT orders.order_id, users.user_id, users.user_firstname, users.user_lastname, orders.order_date, orders.order_grandtotal, retailer_info.retailer_name
FROM orders
INNER JOIN retailer_info ON orders.retailer_id = retailer_info.retailer_id
INNER JOIN users ON orders.user_id = users.user_id
WHERE MONTH(orders.order_date) = $monthselected 
AND DAY(orders.order_date) = $dayselected 
AND retailer_info.retailer_id = $retailerid
AND orders.order_status = '1'";

$result = mysqli_query($conn, $sql);



//Query is ONLY for Retrieving Restaurant Name
$query = "SELECT retailer_id, retailer_name from retailer_info WHERE retailer_id = $retailerid";
$tempquery = mysqli_query($conn, $query);
$data = mysqli_fetch_array($tempquery);


if(mysqli_num_rows($result) <= 0) //If no result gathered
{
echo "<p>No sales at this time</p>";
}else{
?>

<title>Sales Report</title>

<div class="dailysalesreport">

  <img width="210" height="100" src="Resources/Logos/logo.png" />


<h1>Retailer Sales Report</h1>
<?php

$monthtext = "";

if($monthselected == '1'){
  $monthtext = "January";
}else if($monthselected == '2'){
  $monthtext = "February";
}else if($monthselected == '3'){
  $monthtext = "March";
}else if($monthselected == '4'){
  $monthtext = "April";
}else if($monthselected == '5'){
  $monthtext = "May";
}else if($monthselected == '6'){
  $monthtext = "June";
}else if($monthselected == '7'){
  $monthtext = "July";
}else if($monthselected == '8'){
  $monthtext = "August";
}else if($monthselected == '9'){
  $monthtext = "September";
}else if($monthselected == '10'){
  $monthtext = "October";
}else if($monthselected == '11'){
  $monthtext = "November";
}else if($monthselected == '12'){
  $monthtext = "December";
}
?>

<div class="infosection">

<p>Retailer Name: <?php echo $data['retailer_name']; ?></p>
<p>Date: <?php echo date("Y-m-d"); ?></p>
<p>Month: <?php echo $monthtext; ?></p>
<p>Day: <?php echo $dayselected; ?></p>

</div>


<table class="displaytable" border="1" width="1200">
  <tr class="displayrow">
    <th>Order ID</th>
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Order Date</th>
    <th>Order Total</th>
  </tr>

  <?php

    //Gets Sum of selected Month
    $sql2 = "SELECT ROUND(SUM(orders.`order_grandtotal`),2) AS 'Total' 
    FROM orders WHERE MONTH(orders.order_date) = $monthselected 
    AND DAY(orders.order_date) = $dayselected 
    AND retailer_id = $retailerid
    AND orders.order_status = '1'";
    
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $sum = $row2['Total'];

    //Displays Data Found
    while($rows = mysqli_fetch_array($result)) //Stores database values in variables
    {
      echo"<tr>";
      echo"<td>" . $rows['order_id'] . "</td>";
      echo"<td>" . $rows['user_id'] . "</td>";
      echo"<td>" . $rows['user_firstname'] . "</td>";
      echo"<td>" . $rows['user_lastname'] . "</td>";
      echo"<td>" . $rows['order_date'] . "</td>";
      echo"<td>RM " . $rows['order_grandtotal'] . "</td>";
      echo"</tr>";

      //End of SQL Query
    }
      echo"<tr>";
      echo"<td colspan='6' style='height:24px;'> </td>";
      echo"</tr>";
      echo"<td colspan='4'></td>";
      echo"<td>Total</td>";
      echo"<td>RM " . $sum . "</td>";
    ?>
  </table>
</div>

<?php

}
}
}
}
}
?>
