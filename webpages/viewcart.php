<?php

ob_start();

include 'header.php';

include 'processingforms/dbconnection.php'; //Includes database connection

if(isset($_GET['retailerid'])){
$retailerid = $_GET['retailerid'];
}

if(isset($_GET['id'])){
$productid = $_GET['id'];
}

//Checks if a User is logged in
if(isset($_SESSION['u_uid'])){

//Checks if the "Add to cart button is pressed"
    if (isset($_POST["add"])){

//Checks for Item Quantity
      if(!is_numeric($_POST['quantity']) || $_POST['quantity'] < 0 ){
        header("Location: index.php?invalidquantity");
        exit();
      }

//Checks whether there is a shopping cart session present or not
        if (isset($_SESSION["cart"])){


          //Checks whether a customer is ordering from the same store or not
          if($_SESSION['currentstore'] !== $retailerid){

          ?>

          <!--Test Zone-->
          <script language="javascript">
          //Displays alert for user to know that cart is being replaced
          alert("Ordered an item from a different retailer \nYour current items in cart will be discarded")

          </script>

          <?php
          //Deletes current cart session containing old items and replaces them with new ones
          unset($_SESSION['cart']);

          $_SESSION['currentstore'] = $retailerid;

          echo '<script>alert("Product added to cart!")</script>';
          echo '<script>window.location="retailermenu.php?productadded&retailerid=';
          echo $retailerid;
          echo '"</script>';

          $item_array = array(    //Sets Product Details into an Array
              'product_id' => $_GET["id"],
              'item_name' => $_POST["hiddenname"],
              'item_image' => $_POST["productimageurl"],
              'product_price' => $_POST["hiddenprice"],
              'item_quantity' => $_POST["quantity"],
          );
          $_SESSION["cart"][0] = $item_array;
          ?>
          <!--End of TZ-->

          <?php
        }else{

            $item_array_id = array_column($_SESSION["cart"],"product_id");  //Gets the product's ID from the array
            if (!in_array($_GET["id"],$item_array_id)){ //Checks whether the product already exists in the cart or not.

                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hiddenname"],
                    'item_image' => $_POST["productimageurl"],
                    'product_price' => $_POST["hiddenprice"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>alert("Product added to cart!")';
                echo '</script>';
                echo '<script>window.location="retailermenu.php?retailerid=';
                echo $retailerid;
                echo '"</script>';
            }else{

                echo '<script>alert("Product is already Added to Cart")</script>';
                echo '<script>window.location="viewcart.php?productalreadyadded&retailerid=';
                echo $retailerid;
                echo '"</script>';
            }
          }
        }else{


            $_SESSION['currentstore'] = $retailerid;

            echo '<script>alert("Product added to cart!")</script>';
            echo '<script>window.location="retailermenu.php?productadded&retailerid=';
            echo $retailerid;
            echo '"</script>';

            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hiddenname"],
                'item_image' => $_POST["productimageurl"],
                'product_price' => $_POST["hiddenprice"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product removed")</script>';
                    echo '<script>window.location="viewcart.php?productremoved"</script>';
                }
            }
        }
    }
  }else{
    //Change Later.
    echo '<script>window.location="singlelogin.php?login=notloggedin"</script>';
    exit();
  }
?>

<div id="bodyindex">
<div id="bodycart">
  <h1 style="text-align:center;">Your Shopping Cart</h1>
  <div>
      <?php
          if(!empty($_SESSION["cart"])){
              $total = 0;
              ?>
              <table class="carttable" border="0" cellspacing="0" cellpadding="0">
              <form action="checkout.php" method="post">
              <tr class="displayrow">
                  <th width="10%"></th>
                  <th width="20%">Product Name</th>
                  <th width="10%">Quantity</th>
                  <th width="13%">Price Details</th>
                  <th width="10%">Total Price</th>
                  <th width="17%"></th>
              </tr>
              <?php
              foreach ($_SESSION["cart"] as $key => $value) {
                  ?>
                  <tr>
                      <td><img height='90' width = '90' src="Resources/RetailerProducts/<?php echo $value["item_image"]; ?>"/></td>
                      <td><?php echo $value["item_name"]; ?></td>
                      <td><?php echo $value["item_quantity"]; ?></td>
                      <td>RM <?php echo $value["product_price"]; ?></td>
                      <td>RM <?php echo ($value["item_quantity"] * $value["product_price"]); ?></td>
                      <td><a href="viewcart.php?action=delete&id=<?php echo $value["product_id"]; ?>">Remove Item</a></td>
                  </tr>
                  <?php
                  $total = $total + ($value["item_quantity"] * $value["product_price"]);
                  $sst = $total * 0.06;
                  $delivfee = 5.00;
                  $grandtotal = $total + $sst + $delivfee;
              }
                  ?>
                  <tr style="border-bottom: 2px solid black;"></tr>
                  <tr>
                      <td><input type="hidden" name="totalprice" value="<?php echo $grandtotal; ?>"/></td>
                      <td></td>
                      <td></td>
                      <td>Subtotal: </td>
                      <td>RM <?php echo $total; ?></td>
                      <td></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>6% SST:</td>
                    <td>RM <?php echo $sst;?></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Delivery Fee:</td>
                    <td>RM <?php echo $delivfee;?></td>
                    <td></td>
                  </tr>

                  <tr style="background-color:#6d6d6d;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total:</td>
                    <td>RM <?php echo $grandtotal; ?></td>
                    <td><button type="submit" name="submit">Checkout</button></td>
                  </tr>

                  <tr>
                    <td colspan="6">
                  </tr>

                  <tr>
                    <td colspan="6">*Prices are subject to 6% SST (Sales and Service Tax) and Shipping Costs</td>
                  </tr>
                  <?php
              }else{
                echo "<div class='emptycart'>";
                echo "<h3>Your cart is empty!</br>";
                echo "<p><a href='index.php'>Click here</a> to return to homepage</p>";
                echo "</h3>";
                echo "</div>";
              }
          ?>
      </form>
      </table>
  </div>
</div>
</div>

<?php
include 'footer.php';
?>
