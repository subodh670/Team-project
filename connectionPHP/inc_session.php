<?php


session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location: ../landing_page/index.php");
}


?>