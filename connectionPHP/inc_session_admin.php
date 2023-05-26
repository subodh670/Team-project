<?php


session_start();
if(!isset($_SESSION['adusername']) || !isset($_SESSION['adpassword'])){
    header("location: ../admin_login_page/index.php");
}


?>