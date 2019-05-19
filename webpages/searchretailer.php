<?php
ob_start();

include 'header.php';
?>

<div id="bodyindex">

<?php

//If the button is pressed
if(isset($_POST['searchretailer'])){
include 'processingforms/dbconnection.php';

//Sets search query in a variable
$retailersearch = mysqli_real_escape_string($conn, $_POST['squery']);

if(empty($retailersearch)){ //If the search variable is empty

    //Redirects person back to index page with error
    echo '<script>alert("Enter Search Field!");
    window.location.href = "index.php?searchfield=empty";
    </script>';
    exit();

}else{

    //Prepares SQL Query to Search for Retailer from Database
    
    $sql = "SELECT * FROM retailer_info WHERE retailer_name LIKE '%$retailersearch%'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) <= 0){

        echo '<div class="errorsuccesspanel">';
        echo '<p class="error">No retailers found! </br>Click <a style="color:inherit; text-decoration:none;" href="index.php">here</a> to go back</p>';
        echo '</div>';

    }else{
        while($row = mysqli_fetch_array($result))
        {
?>

<div class="col-sm-4">
<form class="retailertable" method="POST">
  <div class="retailerrestos">
    <a href="retailermenu.php?retailerid=<?php echo $row['retailer_id'];?>"><img name="retailerlogo" height='180' width='180' src="Resources/PendingLogos/<?php echo $row['retailer_logo'];?>" /></a>
    <a href="retailermenu.php?retailerid=<?php echo $row['retailer_id'];?>"><?php echo $row['retailer_name'];?></a>
  </div>
</form>
</div>

<?php
}
}
}
}else{
      header("Location: index.php?invalid");
      exit();
    }

?>


</div>

<?php

include 'footer.php';

?>