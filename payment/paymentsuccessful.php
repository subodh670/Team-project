<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    include("../connectionPHP/connect.php");  
    include("../connectionPHP/inc_session.php");  
    // session_start();
     $username = $_SESSION['username'];
     // echo $username;
     $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
     $arr = oci_parse($conn, $sql);
     oci_execute($arr);
     $c_id = oci_fetch_array($arr)[0];
     $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
     $arr = oci_parse($conn, $sql);
     oci_execute($arr);
     $cartId = oci_fetch_array($arr)[0];
    $query = "SELECT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.TOTAL_COST, ORDERED_PRODUCT.QUANTITY
    FROM ORDERED_PRODUCT
    INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID = PRODUCT_ORDER.ORDER_ID
    INNER JOIN COLLECTION_SLOT ON COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID
    WHERE PRODUCT_ORDER.FK_CART_ID = $cartId AND COLLECTION_SLOT.STATUS = 1 AND PRODUCT_ORDER.STATUS = 1";
    $arr2 = oci_parse($conn, $query);

    oci_execute($arr2);
    $sum = 0;
    $totalQuant = 0;
    $order_id = null;
    while($rows = oci_fetch_array($arr2)){
        $sum += $rows[1];
        $totalQuant += $rows[2];
        $order_id = $rows[0];
    }

    $sql = "SELECT FK_SLOT_ID FROM PRODUCT_ORDER WHERE ORDER_ID = '$order_id' AND STATUS = 1";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $slot_id = oci_fetch_array($arr)[0];
    $sql = "UPDATE COLLECTION_SLOT SET STATUS = 2 WHERE SLOT_ID = '$slot_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $sql = "UPDATE PRODUCT_ORDER SET STATUS = 2 WHERE ORDER_ID = '$order_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $sql = "INSERT INTO PAYMENT(PAYMENT_AMOUNT, CURRENCY, PAYMENT_STATUS, FK_USER_ID, FK_ORDER_ID) VALUES('$sum', 'GBP', '1', '$c_id', '$order_id')";
    $arr = oci_parse($conn, $sql);
    $g = oci_execute($arr);
    if($g){
        echo "<h1 style='width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;'>Payment of money $$sum is Successfull!!</h1>";
        echo "<a href='../landing_page/index.php'>Redirect</a>";
    }
    ?>
</body>
</html>