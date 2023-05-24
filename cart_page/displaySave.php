<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include("../connectionPHP/connect.php");
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        // echo $username;
        $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $c_id = oci_fetch_array($arr)[0];
        // $query = "SELECT PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.SHOP_ID, SHOP.SHOP_NAME,PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.PRODUCT_ID, SUM(P_QUANTITY) FROM PRODUCT, CART, SHOP WHERE CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.SHOP_ID = SHOP.SHOP_ID AND C_ID = $c_id GROUP BY PRODUCT.PRODUCT_ID, PRODUCT.PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.SHOP_ID, SHOP.SHOP_NAME, PRODUCT.PRODUCT_ID";
        // $query = 
        // echo $c_id;
        $query = "SELECT DISTINCT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.FK_SHOP_ID, SHOP.NAME,PRODUCT.STOCK_AVAILABLE, CATEGORY.CATEGORY_NAME, PRODUCT.IMAGE2, PRODUCT.PRODUCT_ID,PRODUCT_CART.TOTAL_ITEMS FROM PRODUCT, PRODUCT_CART, SHOP, CATEGORY, CART WHERE CART.CART_ID = PRODUCT_CART.CART_ID AND PRODUCT_CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND CATEGORY.CATEGORY_ID = PRODUCT.FK_CATEGORY_ID AND CART.FK_USER_ID = '$c_id'";

        $arr = oci_parse($conn, $query);
        oci_execute($arr);
        $items = array();
        while($rows = oci_fetch_array($arr)){
            $items[] = $rows;
        }
        echo json_encode($items);
    }
    else{
        $id_cookie = $_COOKIE['product'];
        $quantity_cookie = $_COOKIE['quantity'];
        $arrid = explode(" ", $id_cookie);
        $quantarr = explode(" ", $quantity_cookie);
        $arr = array();
        // print_r($arrid);
        for($i = 0; $i<count($arrid); $i++){
            $id = $arrid[$i];
            // $sql = "SELECT PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.SHOP_ID, SHOP.SHOP_NAME,PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.PRODUCT_ID FROM PRODUCT, SHOP WHERE PRODUCT.SHOP_ID = SHOP.SHOP_ID AND PRODUCT_ID = '$id' ";
            // $sql = "SELECT DISTINCT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.FK_SHOP_ID, SHOP.NAME,PRODUCT.STOCK_AVAILABLE, CATEGORY.CATEGORY_NAME, PRODUCT.IMAGE2, PRODUCT.PRODUCT_ID,CART.TOTAL_ITEMS FROM PRODUCT, PRODUCT_CART, SHOP, CATEGORY, CART WHERE CART.CART_ID = PRODUCT_CART.CART_ID AND PRODUCT_CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND CATEGORY.CATEGORY_ID = PRODUCT.FK_CATEGORY_ID AND CART.FK_USER_ID = '$c_id'";  
            $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.FK_SHOP_ID, SHOP.NAME,PRODUCT.STOCK_AVAILABLE, CATEGORY.CATEGORY_NAME, PRODUCT.IMAGE2, PRODUCT.PRODUCT_ID FROM PRODUCT, SHOP, CATEGORY WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND CATEGORY.CATEGORY_ID = PRODUCT.FK_CATEGORY_ID AND PRODUCT_ID = '$id'";

            $array = oci_parse($conn, $sql);
            oci_execute($array);
            while($rows = oci_fetch_array($array)){
                $arr[$i] = $rows;
            }
        }
        // var_dump($arr);
        echo json_encode($arr);
        // $query = "SELECT PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.SHOP_ID, SHOP.SHOP_NAME,PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.PRODUCT_ID, SUM(P_QUANTITY) FROM PRODUCT, CART, SHOP WHERE CART.PRODUCT_ID = PRODUCT.PRODUCT_ID AND PRODUCT.SHOP_ID = SHOP.SHOP_ID AND C_ID = $c_id GROUP BY PRODUCT.PRODUCT_ID, PRODUCT.PRODUCT_NAME, PRODUCT.PRODUCT_PRICE, PRODUCT.PRODUCT_QUANTITY, PRODUCT.PRODUCT_CATEGORY, PRODUCT.PRODUCT_IMAGE2, PRODUCT.SHOP_ID, SHOP.SHOP_NAME, PRODUCT.PRODUCT_ID";
        // $arr = oci_parse($conn, $query);
        // oci_execute($arr);
        // $items = array();
        // while($rows = oci_fetch_array($arr)){
        //     $items[] = $rows;
        // }
        // echo json_encode($items);
    }
    
}



?>