<link rel ="shortcut icon" type="image/png" href="Resources/Logos/logo.png">
<title>Monthly Revenue Chart</title>

<?php

include 'processingforms/dbconnection.php';

$query = "SELECT retailer_info.retailer_name AS 'RetailerName' , ROUND(SUM(orders.`order_grandtotal`),2) AS 'TotalRevenue'
FROM retailer_info JOIN orders ON retailer_info.retailer_id = orders.retailer_id
WHERE MONTH(orders.order_date) = MONTH(CURRENT_DATE())
GROUP BY retailer_info.retailer_name";

$result = mysqli_query($conn, $query);

$monthselected = date('m');

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


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Retailer Name', 'Total Revenue'],
                  <?php
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "['".$row["RetailerName"]."', ".$row["TotalRevenue"]."],";
                  }
                  ?>
                ]);

                var options = {
                  title: 'Revenue Share for <?php echo $monthtext; ?>',
                  pieHole: 0.4,

                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
              }
  </script>


  <div id="piechart" style="width: 600px; height: 450px;">
  </div>
