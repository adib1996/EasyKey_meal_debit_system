<?php
ob_start();
include 'header.php';
?>
<?php

if(!isset($_SESSION['u_id'])){
header("location: index.php?notloggedin"); //Sends unauthorized user back to homepage
exit();
}else{

//Only authorizes admins to view this page

if($_SESSION['u_role'] !== '1'){
header("location: index.php?feature=adminonly"); //Sends customer/retailer back to homepage
exit();
}else{
?>

<div id="bodyindex">
<div class="viewcustomerspanel">

<div class="viewcustomerstitle">
<h1>View Retailers</h1>
</div>

<?php

  include 'processingforms/dbconnection.php';

  //SQL Query to Fetch All Retailers
  $sql = "SELECT retailer_info.*, users.user_username FROM retailer_info JOIN users ON retailer_info.user_id = users.user_id";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) <=0){
    echo 'No retailers found';
    exit();
  }else{
?>

<!-- Displays Customers in Table Form -->

<table class="viewcustomerstable" border="0">
  <tr class="viewcustomersrow">
    <th width="10%">Retailer ID</th>
    <th width="20%">Logo</th>
    <th width="10%">Email</th>
    <th>Register Date</th>
    <th>Username</th>
    <th width="45%" colspan="3">Actions</th>
  </tr>

  <?php

    //Displays Data Found and places them into Variables

    while($rows = mysqli_fetch_array($result)) //Stores database values in variables
    {
      echo"<tr>";
      echo"<td>" . $rows['retailer_id'] . "</td>";
      echo"<td>";
      echo"<img height='150' width = '150'";
      echo"src = Resources/PendingLogos/";
      echo $rows['retailer_logo'];
      echo ">";
      echo"</td>";
      echo"<td>" . $rows['retailer_email'] . "</td>";
      echo"<td>" . $rows['retailer_registerdate'] . "</td>";
      echo"<td>" . $rows['user_username'] . "</td>";

      //3 Buttons
      echo"<td><a href='admineditretailerinfo.php?retailerid=".$rows['retailer_id'] ."'>Details</a></td>";
      echo"<td><a href='adminviewretailerproducts.php?retailerid=".$rows['retailer_id'] ."'>Products</a></td>";
      echo"<td><a href='processingforms/adminremoveretailerprocessing.php?retailerid=".$rows['retailer_id'] ."'>Expel</a></td>";



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
}
include 'footer.php';
?>
