<?php

ob_start();

include 'header.php';

if(!isset($_SESSION['u_id'])){
  header('location: singlelogin.php?notloggedin');
  exit();
}else{

if($_SESSION['u_role'] == '0' || $_SESSION['u_role'] == '7'){
?>

  <div id="bodyindex">
  <div class="topuphistorytable">

  <?php
  include 'processingforms/dbconnection.php'; //Includes database connection

  $userid = $_SESSION['u_id'];

  //SQL to get Products
  $sql = "SELECT * FROM topup WHERE user_id = '$userid' ORDER BY topup_datetime DESC";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) <= 0) //No result gathered
  {
    echo "<p>No topup history available</p>";

  }else{
      ?>


        <div class="topuphistorytitle">
        <h1>Top Up History</h1>
        </div>

      <!--Constructs table in table format-->

      <table class="topuptable" border="0">
        <tr class="topuphistorytablerow">
          <th with="20%">Top Up ID</th>
          <th width="20%">Date</th>
          <th width="20%">Time</th>
          <th width="20%">Amount</th>
          <th width="20%">Method</th>
        </tr>

      <?php

      while($rows = mysqli_fetch_array($result))
      {
        $datetime = $rows['topup_datetime'];
        list($date, $time) = explode(" ", $datetime);

        $topupmethod;

        if($rows['topup_method'] == "onlinebanking"){
          $topupmethod = "Online Banking";
        }else if($rows['topup_method'] == "store"){
          $topupmethod = "Conv. Store";
        }else if($rows['topup_method'] == "creditcard"){
          $topupmethod = "Credit Card";
        }
      ?>

      <!--Displays information in table format-->

        <?php
        echo"<tr>";
        echo"<td>" . $rows['topup_id'] . "</td>";
        echo"<td>" . $date . "</td>";
        echo"<td>" . $time . "</td>";
        echo"<td>RM " . $rows['topup_amount'] . "</td>";
        echo"<td>" . $topupmethod . "</td>";
        echo"</tr>";
        //End of SQL Query
      }
  }
  ?>

    </table>

  </div>
  </div>


<?php
echo '</table>';
}else{
  header('location: index.php?customeronly');
  exit();
}
}
include 'footer.php';
?>
