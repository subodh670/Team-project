<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    session_start();
    include("../connectionPHP/connect.php");
    $pid = $_GET['pid'];
    $quantity = intval($_GET['quant']);
    $slot = $_GET['slot'];
    $day = $_GET['day'];
    $price = intval($_GET['price']);
    $pName = $_GET['pname'];
    $username = $_GET['username'];
    $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
    $arr = oci_parse($conn, $query);
    oci_execute($arr);
    $cid = oci_fetch_array($arr)[0];
    // echo $price;
    
    // echo $quantity;
    // echo "<br>";
    // echo $price;
    // echo $quantity;
    // echo $price;
    // echo $slot;
    // if($day == "" || $slot = ""){
    //     echo json_encode(['cannot have empty collection slot']);
    //     die("");
    // }
    // echo $day;
    // echo $day;
    // echo $slot;
    // if($)
        // echo $status;
    // $sqlExist = "SELECT ORDER_ID FROM ORDERS WHERE PRODUCT_ID = '$pid' AND C_ID = '$cid'";
    // $sql = "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
    // $arr = oci_parse($conn, $sql);
    // oci_execute($sql);
    // $pName = oci_fetch_array($arr)[0];
    $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$cid'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $cartId = oci_fetch_array($arr)[0];
    // $sqlExist = "SELECT ORDERED_PRODUCT.ORDER_ID
    // FROM ORDERED_PRODUCT
    // INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID = PRODUCT_ORDER.ORDER_ID WHERE ORDERED_PRODUCT.PRODUCT_ID = '$pid' AND PRODUCT_ORDER.FK_CART_ID= '$cartId' ";
    $sqlExist = "SELECT ORDER_ID FROM PRODUCT_ORDER INNER JOIN COLLECTION_SLOT ON PRODUCT_ORDER.FK_SLOT_ID = COLLECTION_SLOT.SLOT_ID WHERE FK_CART_ID = '$cartId' AND COLLECTION_SLOT.STATUS = 1";
    $arr2 = oci_parse($conn, $sqlExist);
    oci_execute($arr2); 
    // echo $orderid;?
    $arr = oci_fetch_array($arr2);
    $slotQ = 0;
    $slotid = null;
    $prevCost = null;
    $prevQ = null;
    // if(isset($arr[0])){
    //     $order_id = $arr[0];
    //     $prevCost = $arr[1];
    //     $prevQ = $arr[2];
    // }
    if(isset($arr[0])){
        $slotArr = oci_parse($conn, "SELECT STOCK_AVAILABLE FROM PRODUCT WHERE PRODUCT_ID = '$pid'");
        oci_execute($slotArr);
        while($rows = oci_fetch_array($slotArr)){
            $slotQ += $rows[0];
            // $slotid = $rows[0];
        }
        
    
    }
    $slotArr = oci_parse($conn, "SELECT SLOT_ID FROM COLLECTION_SLOT, PRODUCT_ORDER WHERE COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID AND PRODUCT_ORDER.FK_CART_ID = '$cartId' AND COLLECTION_SLOT.STATUS=1");
    oci_execute($slotArr);
    $slotid = oci_fetch_array($slotArr);
    // echo $slotid;
    // echo $slotid[0];
    $productOrderExist[] = [null];
    if(isset($arr[0])){
        $order_id = $arr[0];
        $sql4 = "SELECT ORDER_ID FROM ORDERED_PRODUCT WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$pid'";
        $arr5 = oci_parse($conn, $sql4);
        oci_execute($arr5);
        $productOrderExist = oci_fetch_array($arr5);
    }
    $nulldata = false;
    if(!isset($day) || !isset($slot) || $day=="" || $slot == ""){
        $nulldata = true;
    }
    // $sql = "SELECT STOCK_AVAIABLE FROM PRODUCT WHERE PRODUCT"
    // echo $slotQ;
    // echo $slotid;


    // if(!isset($_SESSION['quant']))
    //     $_SESSION['quant'] = array();
    // $grossQ = null;
    // if(count($_SESSION['quant'])>0){
    //     $sQ = null;
    //     for($i =0; $i<count($_SESSION['quant']); $i++){
    //         if($_SESSION['quant'][$i][0]==$pid && $_SESSION['quant'][$i][2]==$cid){
    //             $sQ = $_SESSION['quant'][$i][1];
    //             break;
    //         }
    //     }
    //     if(isset($sQ)){
    //         echo "HELLO BOY";
    //         $grossQ = intval($prevQ) - $sQ + intval($quantity);
    //     }
    // }
    // echo $grossQ;
    $canAdd = false;
    // echo $grossQ;
    // echo "<br>";
    // echo $grossQ<=20;
    // if(!isset($grossQ) && $grossQ<=$slotQ){
    //     $canAdd = true;
    // }
    // else if(intval($grossQ) <= 20){
    //     $canAdd = true;
    // }
    // else if($grossQ > 20){
    //     $canAdd = false;
    // }
    // if(intval($))
    // $canAdd == true = $grossQ<=20 ? true:false;
    // var_dump($_SESSION['quant']);
    // echo $canAdd;
    $grossQ = 0;
    if(isset($productOrderExist[0])){
        $username = $_SESSION['username'];
        $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $cid = oci_fetch_array($array)[0];
        $sql = "SELECT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.QUANTITY FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $totalnum = 0;
        while($numbers = oci_fetch_array($array)){
            $totalnum += $numbers[1];
        }
        echo $totalnum;
        $sql = "SELECT ORDERED_PRODUCT.ORDER_ID, ORDERED_PRODUCT.QUANTITY FROM ORDERED_PRODUCT INNER JOIN PRODUCT_ORDER ON ORDERED_PRODUCT.ORDER_ID=PRODUCT_ORDER.ORDER_ID AND FK_CART_ID = $cartId AND ORDERED_PRODUCT.PRODUCT_ID = '$pid'";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        $nowcount = oci_fetch_array($array);
        if(isset($nowprice[0])){
            $grossQ = $totalnum - $nowcount[1] + $quantity;
        }
        else
            $grossQ = $totalnum + $quantity;
    }
    else{
        $grossQ = $quantity;
    }
    if($grossQ <=20){
        $canAdd = true;
    }
    echo $grossQ;
    // echo $grossQ;
    if(isset($arr[0]) && $canAdd == true){
        if(isset($slotid[0])){
            // echo "MEEEE";
            // $sql = "INSERT INTO COLLECTION_SLOT(SLOT_ID, DAY, COLLECTION_DATE, MAXIMUM_ORDER, MINIMUM_ORDER, STATUS)  VALUES($slotid, '$day','$slot', 20, '$quantity', '1')";
            // $result = oci_parse($conn, $sql);
            // oci_execute($result);    
            // $sql3 = "UPDATE PRODUCT_ORDER SET QUANTITY = '$quantity' WHERE ORDER_ID = '$order_id' AND FK_SLOT_ID = '$slotid'";
            // $arr3 = oci_parse($conn, $sql3);
            // oci_execute($arr3);
            // $sql3 = "UPDATE PRODUCT_ORDER
            // SET PRODUCT_ORDER.QUANTITY = '$quantity'
            // WHERE PRODUCT_ORDER.ORDER_ID IN (
            //     SELECT ORDERED_PRODUCT.ORDER_ID
            //     FROM ORDERED_PRODUCT
            //     WHERE ORDERED_PRODUCT.PRODUCT_ID = '$pid' AND ORDERED_PRODUCT.ORDER_ID = '$order_id'
            // )";
            $totalQ = $prevQ + $quantity;
            $total_cost = $price;
            // $grossQ = 
            // if(!isset($grossQ))
            //     $finalQ = $totalQ;
            // else
            //     $finalQ = $grossQ;
            // echo $grossQ;
            // $sql3 = "UPDATE PRODUCT_ORDER SET TOTAL_COST = '$total_cost', QUANTITY='$finalQ' WHERE FK_CART_ID = '$cartId'";
            // $result2 = oci_parse($conn, $sql3);
            // oci_execute($result2);
            if(!isset($productOrderExist[0])){
                $st = "INSERT INTO ORDERED_PRODUCT (ORDER_ID, PRODUCT_ID, QUANTITY, TOTAL_COST) VALUES('$order_id', '$pid', '$grossQ', '$total_cost') ";
                $arr = oci_parse($conn, $st);
                oci_execute($arr);
            }
            else{
                $st = "UPDATE ORDERED_PRODUCT SET QUANTITY = '$grossQ', TOTAL_COST = '$total_cost' WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$pid'";
                $arr = oci_parse($conn, $st);
                oci_execute($arr);
            }
            // $res = false;
            // for($i =0; $i<count($_SESSION['quant']); $i++){
            //     if($_SESSION['quant'][$i][0]==$pid && $_SESSION['quant'][$i][2]==$cid){
            //         $_SESSION['quant'][$i][1] = $quantity;
            //         $res = true;
            //         break;
            //     }
                
            // }
            // if($res == false)
            //     array_push($_SESSION['quant'],[$pid, $quantity, $cid]);


        }
        else if($nulldata == false){
            $maxorder = 20;
            $status = 1;
            // echo "YOUUU";
            $totalQ = $prevQ + $quantity;
            $total_cost = $price;
            $sql = "INSERT INTO COLLECTION_SLOT (DAY, COLLECTION_DATE, MAXIMUM_ORDER, MINIMUM_ORDER, STATUS)
            VALUES (:value1, :value2, :value3, :value4, :value5)
            RETURNING SLOT_ID INTO :inserted_id";
            $stmt = oci_parse($conn, $sql);
            // Bind the values
            oci_bind_by_name($stmt, ":value1", $day);
            oci_bind_by_name($stmt, ":value2", $slot);
            oci_bind_by_name($stmt, ":value3", $maxorder);
            oci_bind_by_name($stmt, ":value4", $totalQ);
            oci_bind_by_name($stmt, ":value5", $status);
            $insertedId = null;
            oci_bind_by_name($stmt, ":inserted_id", $insertedId, 6);
            oci_execute($stmt);
            

            // echo "Inserted ID: " . $insertedId;

            // $orderid = $arr[0];
            $collection_id = $insertedId;
            // if(!isset($grossQ))
            //     $finalQ = $totalQ;
            // else
            //     $finalQ = $grossQ;
            // echo $orderid;
            $sql3 = "UPDATE PRODUCT_ORDER SET QUANTITY = '$grossQ', TOTAL_COST = '$total_cost', FK_SLOT_ID = '$collection_id' WHERE FK_CART_ID = '$cartId'";
            $arr3 = oci_parse($conn, $sql3);
            oci_execute($arr3);
            if(!isset($productOrderExist[0])){
                $st = "INSERT INTO ORDERED_PRODUCT (ORDER_ID, PRODUCT_ID, QUANTITY, TOTAL_COST) VALUES('$order_id', '$pid', '$totalQ', '$total_cost') ";
                $arr = oci_parse($conn, $st);
                oci_execute($arr);
            }
            else{
                $st = "UPDATE ORDERED_PRODUCT SET QUANTITY = '$totalQ', TOTAL_COST = '$total_cost' WHERE ORDER_ID = '$order_id'";
                $arr = oci_parse($conn, $st);
                oci_execute($arr);
            }
            // $res = false;
            // for($i =0; $i<count($_SESSION['quant']); $i++){
            //     if($_SESSION['quant'][$i][0]==$pid && $_SESSION['quant'][$i][2]==$cid){
            //         $_SESSION['quant'][$i][1] = $quantity;
            //         $res = true;
            //     }
                
            // }
            // if($res == false)
            //     array_push($_SESSION['quant'],[$pid, $quantity, $cid]);

            

            // $sql = "INSERT INTO PRODUCT_ORDER(QUANTITY, STATUS, TOTAL_COST, FK_CART_ID, FK_SLOT_ID) VALUES('$quantity', '1', '')";
        }
        
    }
    else if($canAdd == true && $nulldata == false){
        if(!isset($slotid[0])){
            // echo "THIS";
            // echo "eeeee";
            // $sqlforTraderid = "SELECT TRADER_ID FROM PRODUCT WHERE PRODUCT_ID = '$pid'";
            // $arr4 = oci_parse($conn, $sqlforTraderid);
            // oci_execute($arr4);
            // $traderid = oci_fetch_array($arr4)[0];
            // $sql4 = "INSERT INTO ORDERS(PRODUCT_QUANTITY, PRODUCT_ID, C_ID, TRADER_ID, ORDER_TIME, ORDER_DAY) VALUES ('$quantity', '$pid', '$cid', '$traderid','$slot', 'wed')";
    
    
            $total_cost = $quantity*$price;
            // echo $total_cost;
            $maxorder = 20;
            $status = 1;
            
            // echo $insertedId;
            $sql = "INSERT INTO COLLECTION_SLOT (DAY, COLLECTION_DATE, MAXIMUM_ORDER, MINIMUM_ORDER, STATUS)
                VALUES (:value1, :value2, :value3, :value4, :value5)
                RETURNING SLOT_ID INTO :inserted_id";
                $stmt = oci_parse($conn, $sql);
                // Bind the values
               
                oci_bind_by_name($stmt, ":value1", $day);
                oci_bind_by_name($stmt, ":value2", $slot);
                oci_bind_by_name($stmt, ":value3", $maxorder);
                oci_bind_by_name($stmt, ":value4", $quantity);
                oci_bind_by_name($stmt, ":value5", $status);
                oci_bind_by_name($stmt, ":inserted_id", $insertedId, 6);
                oci_execute($stmt);
                // $orderid = $arr[0];
                $collection_id = $insertedId;
            $sql4 = "INSERT INTO PRODUCT_ORDER( FK_CART_ID, STATUS, FK_SLOT_ID) VALUES( '$cartId', 1, '$collection_id' )"; 
            $arr5 = oci_parse($conn, $sql4);
            oci_execute($arr5);
            $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cartId'";
            $arr5 = oci_parse($conn, $sql);
            oci_execute($arr5);
            $order_id= oci_fetch_array($arr5)[0];
            $sql = "INSERT INTO ORDERED_PRODUCT(ORDER_ID, PRODUCT_ID, QUANTITY, TOTAL_COST) VALUES('$order_id', '$pid','$quantity', '$price')";
            $arr5 = oci_parse($conn, $sql);
            oci_execute($arr5);
            $res = false;
            // for($i =0; $i<count($_SESSION['quant']); $i++){
            //     if($_SESSION['quant'][$i][0]==$pid && $_SESSION['quant'][$i][2]==$cid){
            //         $_SESSION['quant'][$i][1] = $quantity;
            //         $res = true;
            //     }
            // }
            // if($res == false){
            //     array_push($_SESSION['quant'],[$pid, $quantity, $cid]);
            // }
            // if(count($_SESSION['quant']) == 0){
            //     array_push($_SESSION['quant'],[$pid, $quantity, $cid]);
            // }
        }
        else{
            $sql = "SELECT SLOT_ID FROM COLLECTION_SLOT";
            $arr = oci_fetch_array($conn, $sql);
            oci_execute($arr);
            $result = oci_fetch_array($arr)[0];
            $sql4 = "INSERT INTO PRODUCT_ORDER( FK_CART_ID, STATUS, FK_SLOT_ID) VALUES( '$cartId', 1, '$collection_id' )"; 
            $arr5 = oci_parse($conn, $sql4);
            oci_execute($arr5);
            $sql = "SELECT ORDER_ID FROM PRODUCT_ORDER WHERE FK_CART_ID = '$cartId'";
            $arr5 = oci_parse($conn, $sql);
            oci_execute($arr5);
            $order_id= oci_fetch_array($arr5)[0];
            $sql = "INSERT INTO ORDERED_PRODUCT(ORDER_ID, PRODUCT_ID, QUANTITY, TOTAL_COST) VALUES('$order_id', '$pid','$quantity', '$price')";
            $arr5 = oci_parse($conn, $sql);
            oci_execute($arr5);
            $res = false;
        }
    
    }
    
    
    else{
        echo json_encode(['cannot be more than 20']);
    }




}




?>