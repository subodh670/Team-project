<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paypal payment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <?php
  // session_start();
  include("../connectionPHP/connect.php"); 
  $username = $_SESSION['username'];
  $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
  $arr = oci_parse($conn, $sql);
  oci_execute($arr);
  $c_id = oci_fetch_array($arr)[0];
  $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
  $arr = oci_parse($conn, $sql);
  oci_execute($arr);
  $cartId = oci_fetch_array($arr)[0];
  // $query = "SELECT PRODUCT_ORDER.QUANTITY, PRODUCT.NAME, PRODUCT.PRICE FROM PRODUCT_ORDER,PRODUCT,CATEGORY,CART WHERE PRODUCT_ORDER.FK_CART_ID = CART.CART_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT.NAME = CART.ITEMS AND CART.FK_USER_ID = '$c_id'";
  $query = "SELECT DISTINCT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.TOTAL_COST, ORDERED_PRODUCT.QUANTITY FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId AND PRODUCT_ORDER.STATUS = 1";

    $arr2 = oci_parse($conn, $query);
    oci_execute($arr2);
    $sum = 0;
    $quant = 0;
    while($row = oci_fetch_array($arr2)){
        $sum += $row[1];
        $quant += $row[2];
    }

  ?>
<!-- <h1>https://www.sandbox.paypal.com/cgi-bin/webscr</h1> -->
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" id="by" name="by">
  <input type="hidden" name="business" value="sb-xuwu625717748@business.example.com">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="currency_code" value="GBP">
  <input type="hidden" name="return" value="http://localhost/team%20project-oracle/team-project/payment/paymentsuccessful.php?id=">
    <input type="hidden" name="amount" value="<?php echo $sum; ?>">
  <button style="visibility: none;" type="submit" value="Buy" class='pay'>Buy</button>
</form>
<script src="app.js"></script>
</body>
</html>