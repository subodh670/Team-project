<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../payment/styles.css">
</head>
<body>


<div style = "width: 100%; height: 100%; display: flex; justify-content: center; align-items: center">
    Redircting to payment gateway paypal...
</div>
<?php
session_start();
$username = $_SESSION['username'];
    // Set the HTML content for the invoice
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
            include("../connectionPHP/connect.php");
            // session_start();
            $slotcollectiondate = $_SESSION['date'];
            $timeslot = $_SESSION['timeslot'];
            $slotsday = $_SESSION['day'];
            $sql = "INSERT INTO COLLECTION_SLOT (DAY, COLLECTION_DATE, MAXIMUM_ORDER, MINIMUM_ORDER, STATUS, TIMESLOT)
            VALUES (:value1, :value2, :value3, :value4, :value5, :value6)
            RETURNING SLOT_ID INTO :inserted_id";
            $stmt = oci_parse($conn, $sql);
            // Bind the values
            $maxorder = 20;
            $totalQ = 1;
            $status = 1;
            oci_bind_by_name($stmt, ":value1", $slotsday);
            oci_bind_by_name($stmt, ":value2", $slotcollectiondate);
            oci_bind_by_name($stmt, ":value3", $maxorder);
            oci_bind_by_name($stmt, ":value4", $totalQ);
            oci_bind_by_name($stmt, ":value5", $status);
            oci_bind_by_name($stmt, ":value6", $timeslot);

            $insertedId = null;
            oci_bind_by_name($stmt, ":inserted_id", $insertedId, 6);
            oci_execute($stmt);
            // unset($_SESSION['date']);
            // unset($_SESSION['timeslot']);
            // unset($_SESSION['day']);


            // echo "Inserted ID: " . $insertedId;

            // $orderid = $arr[0];
            $collection_id = $insertedId;
    $username = $_SESSION['username'];
    $sql = "SELECT USER_ID, EMAIL FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $result = oci_fetch_array($arr);
    $c_id = $result[0];
    $useremail = $result[1];
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cartId' AND STATUS = 1";
    $arr5 = oci_parse($conn, $sql);
    oci_execute($arr5);
    
    // $order_id= oci_fetch_array($arr5);
    while($row = oci_fetch_array($arr5)){
        $oid = $row[0];
        echo $oid;
        $sql  = "SELECT FK_SLOT_ID FROM PRODUCT_ORDER WHERE ORDER_ID = $oid AND STATUS = 1";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $slotid = oci_fetch_array($arr)[0];
        $sql = "DELETE FROM COLLECTION_SLOT WHERE SLOT_ID = $slotid AND STATUS = 1";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $sql = "DELETE FROM ORDERED_PRODUCT WHERE ORDER_ID = $oid";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $sql = "DELETE FROM PRODUCT_ORDER WHERE ORDER_ID = $oid AND STATUS = 1";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        
       
    }
    $sql4 = "INSERT INTO PRODUCT_ORDER( FK_CART_ID, STATUS, FK_SLOT_ID) VALUES( '$cartId', 1, '$collection_id' )"; 
    $arr5 = oci_parse($conn, $sql4);
    oci_execute($arr5);

    $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cartId' AND STATUS = 1";
    $arr5 = oci_parse($conn, $sql);
    oci_execute($arr5);
    $order_id= oci_fetch_array($arr5)[0];
    $sql = "SELECT PRODUCT_CART.TOTAL_ITEMS, PRODUCT.PRODUCT_ID, PRODUCT.PRICE FROM PRODUCT_CART, PRODUCT WHERE PRODUCT_CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND CART_ID = '$cartId'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($row = oci_fetch_array($arr)){
        $pid = $row[1];
        $items = $row[0];
        $price = $row[2]*$items;
        // echo "<br>";

        // echo $pid;
        // echo "<br>";
        // echo $items;
        // echo "<br>";


        // echo $price;    
            $sql3 = "INSERT INTO ORDERED_PRODUCT( QUANTITY, TOTAL_COST, PRODUCT_ID, ORDER_ID) VALUES('$items', '$price', '$pid', '$order_id') ";
        $arr3 = oci_parse($conn, $sql3);
        oci_execute($arr3);
    }
    $query = "SELECT DISTINCT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.TOTAL_COST, ORDERED_PRODUCT.QUANTITY, ORDERED_PRODUCT.PRODUCT_ID FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId AND PRODUCT_ORDER.STATUS = 1";
    $arr2 = oci_parse($conn, $query);
    oci_execute($arr2);
    $count = 1;
    while($rows = oci_fetch_array($arr2)){
        $pid = $rows[3];
        $sql2 = "SELECT NAME, PRICE FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
        $arr3 = oci_parse($conn, $sql2);
        oci_execute($arr3);
        $result = oci_fetch_array($arr3);
        $htmlContent .= ' <tr>
        <td>' .'item'.$result[0].'</td>
        <td>' . $rows[2] . '</td>
        <td>£' . $result[1] . '</td>
        <td>£' . $rows[1] . '</td>
    </tr>';
    $count++;
    }
                $htmlContent .= '
                <!-- Add more items here if needed -->
            </tbody>
            <tfoot>';
            $query = "SELECT DISTINCT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.TOTAL_COST FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId AND PRODUCT_ORDER.STATUS = 1";
            $arr2 = oci_parse($conn, $query);
            oci_execute($arr2);
            $sum = 0;
            while($row = oci_fetch_array($arr2)){
                $sum += $row[1];
            } 
            
             $htmlContent .= '<tr>
                    <td colspan="3">Subtotal:</td>
                    <td>£'.$sum.'</td>
                </tr>
                <tr>
                    <td colspan="3">Total:</td>
                    <td>£'.$sum.'</td>
                </tr>
            </tfoot>
        </table>
        </body>
        </html>
    ';
    // Recipient email address
    $to = $useremail;
    // echo $htmlContent;
    // Email subject
    $subject = 'Invoice';

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
        $_SESSION['payment'] = 'true';
        include("../payment/testpaypal.php");
    } else {
        echo "Failed to send the invoice.";
    }    
    // include('../payment/testpaypal.php');
?> 
<script src="../payment/app.js"></script>


    
</body>
</html>