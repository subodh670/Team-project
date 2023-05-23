<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include("../connectionPHP/connect.php");
    $pname = $_GET['pname'];
    $pprice = $_GET['pprice'];
    $pquant = $_GET['pquant'];
    $prodesc = $_GET['prodesc'];
    $promanu = $_GET['promanu'];
    $proexpire = $_GET['proexpire'];
    $proallergy = $_GET['proallergy'];
    $shopid = $_GET['shopid'];
    $image1 = $_GET['image1'];
    $image2 = $_GET['image2'];
    $image3 = $_GET['image3'];
    if(!empty($pname) && !empty($pprice) && !empty($pquant) && !empty($prodesc) && !empty($promanu) && !empty($proexpire) && !empty($proallergy) && !empty($shopid) && !empty($image1) && !empty($image2) && !empty($image3)){
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image1);
        $image1 = basename($image1);
        if (move_uploaded_file($_FILES["imagetoupload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename($image1)). " has been uploaded.";
        } else {
            echo "<p>Error: Sorry, there was an error uploading your file.</p>";
            $image = null;
        }
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image2);
        $image1 = basename($image2);
        if (move_uploaded_file($_FILES["imagetoupload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename($image1)). " has been uploaded.";
        } else {
            echo "<p>Error: Sorry, there was an error uploading your file.</p>";
            $image = null;
        }
    }
    
    
}
?>