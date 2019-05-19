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

  <div class="errorsuccesspanel">
    <?php
    //Edit Customer Profile Page
    if(strpos($fullURL, "adminedit=success") == TRUE) {
        echo "<p class='success'>Customer Profile Edited</p>";
    }

    //View Customer Top Up History
    else if(strpos($fullURL, "error=notopupfound") == TRUE){
      echo "<p class='error'>No top up history for this customer</p>";
    }

    //Edit Customer Profile
    else if(strpos($fullURL, "admineditprofile=nouserid") == TRUE){
      echo "<p class='error'>User not found</p>";
    }

    //Edit Customer Profile
    else if(strpos($fullURL, "admineditprofile=nouseridexist") == TRUE){
      echo "<p class='error'>No User Found</p>";
    }


    ?>
  </div>

<div class="viewcustomerspanel">

<div class="viewcustomerstitle">
<h1>View Customers</h1>
</div>

<?php

  include 'processingforms/dbconnection.php';

  //SQL Query to get all customers , Role = 0 means that the user is a customer
  $sql = "SELECT * FROM users WHERE user_role = '0' ";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) <=0){
    echo 'No customers gathered';
    exit();
  }else{
?>

<!-- Displays Customers in Table Form -->

<table class="viewcustomerstable" border="0">
  <tr class="viewcustomersrow">
    <th width="10%">User ID</th>
    <th width="10%">First Name</th>
    <th width="10%">Last Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Balance</th>
    <th width="45%" colspan="3">Actions</th>
  </tr>

  <?php

    //Displays Data Found

    while($rows = mysqli_fetch_array($result)) //Stores database values in variables
    {
      echo"<tr>";
      echo"<td>" . $rows['user_id'] . "</td>";
      echo"<td>" . $rows['user_firstname'] . "</td>";
      echo"<td>" . $rows['user_lastname'] . "</td>";
      echo"<td>" . $rows['user_username'] . "</td>";
      echo"<td>" . $rows['user_email'] . "</td>";
      echo"<td>RM " . $rows['user_balance'] . "</td>";

      //View Details, Top Up History and Order History here
      //$rows['user_id'] gets User ID and displays it in next page
      echo"<td><a href='admineditprofile.php?userid=".$rows['user_id'] ."'>Details</a></td>";
      echo"<td><a href='adminviewtopuphistory.php?userid=".$rows['user_id'] ."'>Top up History</a></td>";
      echo"<td><a href='adminvieworderhistory.php?userid=".$rows['user_id'] ."'>Order History</a></td>";



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
