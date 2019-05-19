<?php

ob_start();

include 'header.php';
//Includes Database Connection
include 'processingforms/dbconnection.php';

//Fetches Variables
$retailerid = $_GET['retailerid'];
$retailercategory = $_GET['category'];
?>

<!--Navigation -->

<div id="bodyretailermenu">

<?php
//SQL Statement to get Products Specified
$sql = "SELECT products.*, retailer_info.retailer_logo, retailer_info.retailer_name
        FROM products
        JOIN retailer_info ON products.retailer_id = retailer_info.retailer_id
        WHERE products.retailer_id = $retailerid AND products.product_category = '$retailercategory' AND products.product_status = '0' ";

$result = mysqli_query($conn, $sql);
$rescheck = mysqli_num_rows($result);

//Conditional statement if no result is found
if($rescheck<=0){
  header("Location: index.php?retailer=noproducts");
  exit();
}else{

  $row = mysqli_fetch_array($result)

  ?>

  <div class="retailermenupanel">

  <div class="restaurantheader">
    <div class="restaurantlogoname">
      <img name="productimage" height='180' width='180' src="Resources/PendingLogos/<?php echo $row['retailer_logo'];?>" />
      <h1 class="restauranttitle"><?php echo $row['retailer_name'];?></h1>
    </div>

  <ul>

    <li><a class="category" href="retailermenu.php?retailerid=<?php echo $retailerid; ?>">All</a></li>

  <?php

  //Displaying Restaurant Food Subclasses
  $sqldisplaycat = "SELECT DISTINCT product_category FROM products WHERE retailer_id = '$retailerid' AND product_category != '' ORDER BY product_category ";
  $catsgathered = mysqli_query($conn, $sqldisplaycat);

  while($row4 = mysqli_fetch_array($catsgathered)){
  ?>
      <li><a class="category" href="retailercategory.php?retailerid=<?php echo $retailerid; ?>&category=<?php echo $row4['product_category']; ?>"><?php echo $row4['product_category']; ?></a></li>

  <?php
  }
  ?>

  </ul>


  </div>

  <!--Focus Here-->

  <div class="restaurantproduct">

  <form method="POST" action="viewcart.php?action=add&id=<?php echo $row['product_id']; ?>&retailerid=<?php echo $row['retailer_id'];?>">

  <div class="productnameinfo">

  <img name="productimage" height='180' width='180' src="Resources/RetailerProducts/<?php echo $row['product_img'];?>" /></a>

  </div>

  <div class="nameinfo">

  <a><?php echo $row['product_name'];?></a>
  <p><?php echo $row['product_desc']; ?></p>

  </div>

  <input type="hidden" name="quantity" value="1"/>

  <input type="hidden" name="productimageurl" value="<?php echo $row['product_img']; ?>"/>

  <input type="hidden" name="hiddenname" value="<?php echo $row['product_name']; ?>" />

  <input type="hidden" name="hiddenprice" value="<?php echo $row['product_price']; ?>" />

  <div class="pricecart">
  <p name="productprice">RM <?php echo $row['product_price'];?></p>

  <div class="quantityselector">
    <input type="number" name="quantity" class="quan" value="1" max ="9" min ="1" id="count"/>
  </div>

  <div class="addbutton">
  <button type="submit" name="add">Add</button>
  </div>

  </div>

  </form>

  </div>
  <?php
  while($row = mysqli_fetch_array($result))
  {
?>

<div class="restaurantproduct">

<form method="POST" action="viewcart.php?action=add&id=<?php echo $row['product_id']; ?>&retailerid=<?php echo $row['retailer_id'];?>">

<div class="productnameinfo">

<img name="productimage" height='180' width='180' src="Resources/RetailerProducts/<?php echo $row['product_img'];?>" /></a>

</div>

<div class="nameinfo">

<a class="productname"><?php echo $row['product_name'];?></a>
<p><?php echo $row['product_desc']; ?></p>

</div>

<input type="hidden" name="quantity" value="1"/>

<input type="hidden" name="productimageurl" value="<?php echo $row['product_img']; ?>"/>

<input type="hidden" name="hiddenname" value="<?php echo $row['product_name']; ?>" />

<input type="hidden" name="hiddenprice" value="<?php echo $row['product_price']; ?>" />

<div class="pricecart">
<p name="productprice">RM <?php echo $row['product_price'];?></p>

<div class="quantityselector">
  <input type="number" name="quantity" class="quan" value="1" max ="9" min ="1" id="count" />
</div>

<div class="addbutton">
<button type="submit" name="add">Add</button>
</div>

</div>

</form>

</div>



<?php
//End Braces
}
}
?>

</div>

</div>

<script>


    var count = 1;
    var countEl = document.getElementById("count");
    function plus(){
        count++;
        countEl.value = count;
    }
    function minus(){
      if (count > 1) {
        count--;
        countEl.value = count;
      }
    }

</script>

<?php
include 'footer.php';
?>
