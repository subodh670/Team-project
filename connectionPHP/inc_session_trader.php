<?php

// echo "HELLO";
session_start();
// echo $_SESSION['traderusername'];
// echo $_SESSION['traderpassword'];
// echo $_SESSION['traderapproval'];

if(!isset($_SESSION['traderusername']) || !isset($_SESSION['traderpassword']) || $_SESSION['traderapproval']==2){
    echo "HELLO";
    header("location: ../traders_login_page/index.php");
}


?>