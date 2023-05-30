<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successfull</title>
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
    $sql = "SELECT ORDERED_PRODUCT.TOTAL_COST, ORDERED_PRODUCT.QUANTITY, MART_USER.EMAIL, MART_USER.USERNAME, PRODUCT.NAME, PRODUCT.PRICE, SUM(ORDERED_PRODUCT.TOTAL_COST), SUM(ORDERED_PRODUCT.QUANTITY) FROM ORDERED_PRODUCT, PRODUCT, SHOP, MART_USER WHERE ORDERED_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND SHOP.FK_USER_ID = MART_USER.USER_ID AND ORDERED_PRODUCT.ORDER_ID = $order_id GROUP BY ORDERED_PRODUCT.TOTAL_COST, ORDERED_PRODUCT.QUANTITY, MART_USER.EMAIL, MART_USER.USERNAME, PRODUCT.NAME, PRODUCT.PRICE";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($row = oci_fetch_array($arr)){
        $email = $row[2];
        $total = $row[0];
        $quant = $row[1];
        $username = $row[3];
        $pname = $row[4];
        $pprice = $row[5];
        $htmlContent = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Invoice</title>
        <style>
            * {
                box-sizing: border-box;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            h1 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ccc;
                padding: 10px;
                text-align: left;
            }
            thead th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            tfoot td {
                font-weight: bold;
            }
            tfoot tr:last-child td {
                border-top: 2px solid #000;
            }
        </style>
    </head>
    <body>
    <h3> Name: '.$username.'</h3>
        <h1>Invoice</h1>
        <table>
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
            ';
            $htmlContent .= ' <tr>
        <td>' .$pname.'</td>
        <td>' . $quant . '</td>
        <td>£' . $pprice . '</td>
        <td>£' . $total . '</td>
    </tr>';
    $htmlContent .= '
    <!-- Add more items here if needed -->
</tbody>
<tfoot>';
$htmlContent .= '<tr>
                    <td colspan="3">Subtotal:</td>
                    <td>£'.$total.'</td>
                </tr>
                <tr>
                    <td colspan="3">Total:</td>
                    <td>£'.$total.'</td>
                </tr>
            </tfoot>
        </table>
        </body>
        </html>
    ';
    $to = $email;
    // echo $htmlContent;
    // Email subject
    $subject = 'Invoice for trader';

    // Set the email headers to specify HTML content
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers if needed
    // $headers .= "From: Your Name <your_email@example.com>" . "\r\n";
    // $headers .= "Cc: additional_recipient@example.com" . "\r\n";

    // Send the email
            // echo $htmlContent;
            $mailSent = mail($to, $subject, $htmlContent, $headers);
    // Check if the email was sent successfully
    if ($mailSent) {
        // include("../payment/testpaypal.php");
        header("location: landing_page/index.php");
    } else {
        echo "Failed to send the invoice.";
    }    
    }
    if($g){
        echo "<div style='width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;'><h1 '>Payment of money $$sum is Successfull!!</h1><a href='../landing_page/index.php'>Redirecting</a></div>";
    }
    ?>
</body>
</html>