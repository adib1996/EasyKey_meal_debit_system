    <?php

    include 'header.php';
    ob_start();

    //Checks if there is a user logged in

    ?>

    <div id="bodyindex">

    <div class="errorsuccesspanel">
      <?php
      //Accepting Retailer - retailacceptrequest.php
      if(strpos($fullURL, "retailaccept=success") == TRUE) {
          echo "<p class='success'>Retailer Accepted</p>";
      }

      //Rejecting Retailer - retailrejectrequest.php
      else if(strpos($fullURL, "retailreject=success") == TRUE){
        echo "<p class='success'>Retailer Rejected</p>";
      }
      ?>
    </div>

    <div class="activerequesttable">

    <div class="requestchecktitle">
    <h1>Pending Requests</h1>
    </div>

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


    include 'processingforms/dbconnection.php'; //Includes database connection
    $sql = "SELECT retailer_request.*, users.user_username FROM retailer_request INNER JOIN users ON
    retailer_request.user_id=users.user_id WHERE req_status = 'PENDING' ORDER BY req_date DESC"; //SQL Query to Fetch all products from retail_request table
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) <= 0) //If no result gathered
    {
      echo "<p>No pending requests at the moment</p>";

    }else{
    ?>

    <!-- Displays Requests that are Pending -->

    <table class="displaytable" border="0">
      <tr class="displayrow">
        <th>Request ID</th>
        <th>Retailer Name</th>
        <th>Proposed Logo</th>
        <th>Application Date</th>
        <th>Application Description</th>
        <th>Username</th>
        <th>User ID</th>
        <th colspan="3">Actions</th>
      </tr>

    <?php

      //Displays Data Found

      while($rows = mysqli_fetch_array($result)) //Stores database values in variables
      {
        echo"<tr>";
        echo"<td>" . $rows['req_id'] . "</td>";
        echo"<td>" . $rows['retailer_name'] . "</td>";
        echo"<td>";
        echo"<img height='150' width ='150' name='image'"; //Check later.
        echo"src = Resources/PendingLogos/";
        echo $rows['retailer_logo'];
        echo ">";
        echo"</td>";
        echo"<td>" . $rows['req_date'] . "</td>";
        echo"<td>" . $rows['req_description'] . "</td>";
        echo"<td>" . $rows['user_username'] . "</td>";
        echo"<td>" . $rows['user_id'] . "</td>";

        //2 Buttons (Edit, Delete in Each  Row)
        echo"<td><a href='processingforms/retaileracceptrequest.php?reqid=".$rows['req_id'] ."&userid=". $rows['user_id'] . "'><button>Accept</button></a></td>";
        echo"<td><a href='processingforms/retailrejectrequest.php?reqid=".$rows['req_id'] ."&userid=". $rows['user_id'] . "'><button>Reject</button></a></td>";
        echo"<td><a href='viewsingleapplication.php?reqid=".$rows['req_id'] ."&userid=". $rows['user_id'] . "'><button>View Details</button></a></td>";
        echo"</tr>";

        //End of SQL Query
      }
      }
      ?>
    </table>

    </div>

    <div class="requesthistorytable">

    <div class="requestchecktitle">
    <h1>Request History</h1>
    </div>

    <?php
    $sql = "SELECT retailer_request.*, users.user_username FROM retailer_request INNER JOIN users ON retailer_request.user_id=users.user_id
     WHERE req_status = 'ACCEPTED' OR req_status = 'REJECTED' ORDER BY req_date DESC"; //SQL Query to Fetch all products from retailer_request table
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) <= 0) //No result gathered
    {
      echo "<p>Request History is Empty</p>";
    }else{
    ?>

    <!-- Displays Past Requests -->

    <table class="displaytable" border="0">
      <tr class="displayrow">
        <th>Request ID</th>
        <th>Retailer Name</th>
        <th>Proposed Logo</th>
        <th>Application Date</th>
        <th>Application Description</th>
        <th>Username</th>
        <th>User ID</th>
        <th>Status</th>
      </tr>

    <?php
      while($rows = mysqli_fetch_array($result)) //Stores fetched database values into variables
      {
        echo"<tr>";
        echo"<td>" . $rows['req_id'] . "</td>";
        echo"<td>" . $rows['retailer_name'] . "</td>";
        echo"<td>";
        echo"<img height='150' width = '150'";
        echo"src = Resources/PendingLogos/";
        echo $rows['retailer_logo'];
        echo ">";
        echo"</td>";
        echo"<td>" . $rows['req_date'] . "</td>";
        echo"<td>" . $rows['req_description'] . "</td>";
        echo"<td>" . $rows['user_username'] . "</td>";
        echo"<td>" . $rows['user_id'] . "</td>";


        //2 Buttons (Edit, Delete in Each Row)
        echo"<td>" . $rows ['req_status'] . "</td>";
        echo"</tr>";

        //End of SQL Query
      }
      }
      ?>

      <?php
    }
  }
?>
</table>

</div>

</div>

<?php
include 'footer.php';
?>
