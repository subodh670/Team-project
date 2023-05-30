<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_GET['timeslot']) && !empty($_GET['slotsday']) && !empty($_GET['cslot'])){
            $slotcollectiondate = $_GET['cslot'];
            session_start();
            include("../connectionPHP/connect.php");
            $timeslot = $_GET['timeslot'];
            $slotsday = $_GET['slotsday'];
            $username = $_SESSION['username'];
            $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $c_id = oci_fetch_array($arr)[0];
            $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$c_id'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $cartId = oci_fetch_array($arr)[0];
            $sql = "SELECT COLLECTION_SLOT.COLLECTION_DATE FROM COLLECTION_SLOT, PRODUCT_ORDER WHERE COLLECTION_SLOT.SLOT_ID = PRODUCT_ORDER.FK_SLOT_ID AND PRODUCT_ORDER.FK_CART_ID = $cartId AND PRODUCT_ORDER.STATUS = 1 AND COLLECTION_SLOT.STATUS = 1";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            $prevslot = oci_fetch_array($arr);
            // $sql = "SELECT COLLECTION_SLOT.COLLECTION_DATE FROM COLLECTION_SLOT WHERE COLLECTION_SLOT.STATUS = 1 AND COLLECTION_SLOT.COLLECTION_DATE = '$slotcollectiondate'";
            // $arr = oci_parse($conn, $sql);
            // oci_execute($arr);
            // $prevslot2 = oci_fetch_array($arr);
            // var_dump($prevslot2);
            // var_dump($prevslot);
            // if(isset($prevslot[0])){
            //     echo json_encode(["<p>You have already fixed the time slot and date before!!</p>"]);

            // }
            if($slotsday <4 || $slotsday >6){
                echo json_encode(["<p>The shops are closed on this day1!</p>"]);
            }
            else{
                
                // if($g){
                    echo json_encode(["<p>collection slot is fixed</p>",$slotsday, $slotcollectiondate, $timeslot]);
                // }
            }
        }
}
    ?>