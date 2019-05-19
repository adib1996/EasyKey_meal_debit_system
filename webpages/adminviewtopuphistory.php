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
}else if(!isset($_GET['userid']))

{

  header('location: index.php?nouserid');
  exit();

}

else{

  $userid = $_GET['userid'];

  include 'processingforms/dbconnection.php';

  //SQL Query to search for customer's Top Up history
  $query = "SELECT * FROM topup WHERE user_id = '$userid' ORDER BY topup_datetime DESC";
  $result = mysqli_query($conn, $query);
  $rescheck = mysqli_num_rows($result);

  if($rescheck <= 0){
      header('location: adminviewcustomers.php?error=notopupfound');
      exit();
  }else{

?>
    <div id="bodyindex">
    <div class="topuphistorytable">

      <div class="topuphistorytitle">
      <h1>Top Up History: User ID <?php echo $userid; ?></h1>
      </div>

      <table class="topuptable" border="0">
        <tr class="topuphistorytablerow">
          <th width="20%">Top Up ID</th>
          <th width="20%">Amount</th>
          <th width="20%">Method</th>
          <th width="20%">Date</th>
          <th width="20%">Time</th>
        </tr>


        <?php
        while($rows = mysqli_fetch_array($result))
        {

          //Gets DateTime variable and splits them into Date and Time individually
          $datetime = $rows['topup_datetime'];
          list($date, $time) = explode(" ", $datetime);

          //Sets top up method into readable format
          $topupmethod;
          if($rows['topup_method'] == "onlinebanking"){
            $topupmethod = "Online Banking";
          }else if($rows['topup_method'] == "store"){
            $topupmethod = "Conv. Store";
          }else if($rows['topup_method'] == "creditcard"){
            $topupmethod = "Credit Card";
          }

        ?>

        <?php
        echo"<tr>";
        echo"<td>" . $rows['topup_id'] . "</td>";
        echo"<td>RM " . $rows['topup_amount'] . "</td>";
        echo"<td>" . $topupmethod . "</td>";
        echo"<td>" . $date . "</td>";
        echo"<td>" . $time . "</td>";
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
