<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trader Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"></link>
</head>
<body>
<?php
  include("../connectionPHP/inc_session_trader.php");
  // echo "HELLO";
  include("../connectionPHP/connect.php");
  $username = $_SESSION['traderusername'];
  $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
  $arr = oci_parse($conn, $sql);
  oci_execute($arr);
  $trader_id = oci_fetch_array($arr)[0];
?>

<input type="hidden" class='hiddentraderid' value="<?php echo "$trader_id" ?>">

  <div class="backdrop hidebackdrop">
    
  </div>
  

  <?php
if(isset($_POST['disablepro'])){
  $id = $_POST['hiddendisablepro'];
  $sql = "UPDATE PRODUCT SET STATUS = 0 WHERE PRODUCT_ID = '$id'";
  $arr = oci_parse($conn, $sql);
  oci_execute($arr);
}


  ?>
    <?php
if(isset($_POST['enablepro'])){
  $id = $_POST['hiddenenablepro'];
  $sql = "UPDATE PRODUCT SET STATUS = 1 WHERE PRODUCT_ID = '$id'";
  $arr = oci_parse($conn, $sql);
  oci_execute($arr);
}
if(isset($_POST['deletepro'])){
  $id = $_POST['hiddenenablepro'];
  $sql = "UPDATE PRODUCT SET STATUS = 1 WHERE PRODUCT_ID = '$id'";
  $arr = oci_parse($conn, $sql);
  oci_execute($arr);
}


  ?>
  <?php

  if(isset($_POST['logouttrader'])){
    unset($_SESSION['traderusername']);
    unset($_SESSION['traderusername']);
    header("location: ../traders_login_page/index.php");
  }
  $errornewPass = "";
  $errorconfirmpass = "";
  $flashvalidated = "";
  $errornotmatch = "";
  function validatePass($pass){
      $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
      if(preg_match($password_regex, $pass)){
          return true;
      }
      else{
          return false;   
      }
  } 
  if(isset($_POST['updatepassbtn'])){
      include("../connectionPHP/connect.php");
      $username = $_SESSION['username'];
      // $username = 'ADMIN';
      $sql = "SELECT PASSWORD FROM MART_USER WHERE USERNAME = '$username'";
      $arr = oci_parse($conn, $sql);
      oci_execute($arr);
      $pass = oci_fetch_array($arr)[0];
      $oldpass = sha1($_POST['oldpass']);
      $newpass = $_POST['newpass'];
      $cpass = $_POST['cpass'];
      if($pass == $oldpass){
          if(validatePass($newpass) == true){
              if($newpass == $cpass){
                  $newpass1 = sha1($newpass);
                  $sql = "UPDATE MART_USER SET PASSWORD = '$newpass1' WHERE USERNAME = '$username'";
                  $array = oci_parse($conn, $sql);
                  oci_execute($array);
                  $_SESSION['traderpassword'] = $newpass1;
                  $flashvalidated = "<p>Password updated!!</p>";
              }
              else{
                  // $_SESSION['errorconfirm'] = true;
                  $errorconfirmpass = "<p>Error: Passwords do not match</p>";

              }
          }
          else{
              // $_SESSION['errorvalidpass'] = true;
              $errornewPass = "<p>Error: Password must be 8 characters, one uppercase, one lowercase, one digit and one special character!!</p>";


          }
      }   
      else{
          // $_SESSION['matchpass'] = true;
          $errornotmatch = "<p>Passwords do not match with database!!</p>";
          
      }

  }
  ?>
    <div class="updatepass hidepass" >
        <form action="" method="POST">
            <div class="xmark1">
                <i class="fa-solid fa-xmark"></i>
            </div>
            
            <h3>Update password</h3>
            <div class="oldpassword">
                <i class="fa-solid fa-envelope"></i>
                <input type="password" name="oldpass" placeholder="old password">
                <p class='errorpass'></p>
            </div>
            <div class="newpassword">
                <i class="fa-solid fa-envelope"></i>
                <input type="password" name="newpass" placeholder="new password">
                <p class='errorpass'></p>
            </div>
            <div class="confirmpass">
                <i class="fa-solid fa-envelope"></i>
                <input type="password" name="cpass" placeholder="confirm password">
                <p class='errorpass'></p>
            </div>
            <div class="updatebtn">
                <button type="submit" name="updatepassbtn">Update</button>
            </div>

        </form>
    </div>
  <div class="editprofile hideEditprofile">
        <form method="POST" action="">
        <div class="xmark">
            <i class="fa-solid fa-xmark"></i>
        </div>
            <h3>Update Profile</h3>
            <?php 
            $username = $_SESSION['traderusername'];
            include("../connectionPHP/connect.php");
            $sql = "SELECT * FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            while($rows = oci_fetch_array($arr)){
                $username = $rows[3];
                $firstname = $rows[1];
                $lastname = $rows[2];
                $mobile = $rows[6];
                $email = $rows[4];
                $gender = $rows[8];
                $address = $rows[7];
                $tid = $rows[0];

                ?>
            <div class="editusername">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="username" placeholder="username" value="<?php echo $username ?>">
                <p class='errorusername'></p>

            </div>
            <input type="hidden" class='chidden' value="<?php echo $tid; ?>">
            <div class="editemail">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="useremail" placeholder="email"  value="<?php echo $email ?>">
                <p class='erroremail'></p>

            </div>
            <div class="editfirstname">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="firstname" placeholder="firstname"  value="<?php echo $firstname ?>">
            </div>
            <div class="editlastname">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="lastname" placeholder="lastname"  value="<?php echo $lastname ?>">
            </div>
            <div class="editmobile">
                <i class="fa-solid fa-phone"></i>
                <input type="number" name="mobile" placeholder="mobile number"  value="<?php echo $mobile ?>">
                <p class='errormobile'></p>

            </div>
            <div class="editgender">
                <i class="fa-regular fa-user"></i>
                <select name="gender" id="gender">
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
            </div>
            <div class="editaddress">
                <i class="fa-solid fa-house"></i>
                <input type="text" name="address" placeholder="address"  value="<?php echo $address ?>">
            </div>
            <div class="updatebtn2">
                <button type="button" name="update">Update Details</button>
            </div>

                <?php
            }

            ?>
        </form>
    </div>
<div class="container-fluid text-center menu-dash">
  <div class="row">
    <div class="col-2 col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xl-2">
      <!-- menu -->
      <a href="../landing_page/index.php"><img src="../landing_page/image1.png" alt=""></a>
      <ul class="list-group list-group-flush1">
  <li class="list-group-item" data-type="overall">Trader Dashboard</li>
  <li class="list-group-item" data-type="shops">Manage Shops</li>
  <li class="list-group-item" data-type="products">Manage Products</li>
  <li class="list-group-item" data-type="offers">Manage offers</li>
  <li class="list-group-item" data-type="profile">Manage profile</li>
</ul>
    </div>
    <div class='col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10' id='overall'>
        <section class="overall-manage">
    <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink" href="#onelink">Statistics</a>
        </li>
      </ul>
    </div>
    <!-- <a class="navbar-brand" href="#profilemanage">Trader profile</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button> -->
       
  </div>
</nav>
<!-- pages -->



<div id="onelink" class="reports">
        
<div class="reportlink">
  <a href="#">Trader report</a>
</div>



<?php
  if(isset($_POST['addofferbtn'])){
    // echo $_POST['offername1'];
    // echo  $_POST['offeradd1'];
    // echo $_POST['offerdate1'];
    // echo $_POST['protooffer'];

    if(!empty($_POST['offername1']) && !empty($_POST['offeradd1']) && !empty($_POST['offerdate1']) &&!empty($_POST['protooffer']))
    {
        $offername = $_POST['offername1'];
        $offerpercent = $_POST['offeradd1'];
        $offerdate = $_POST['offerdate1'];
        $offerproduct = $_POST['protooffer'];
        $sql =  "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$offerproduct'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $pname = oci_fetch_array($arr)[0];
        // echo $pname;
        $sql = "SELECT OFFER_PRODUCT.OFFER_ID FROM OFFER_PRODUCT WHERE OFFER_PRODUCT.PRODUCT_ID = '$offerproduct'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $offerexist = oci_fetch_array($arr);
        if(isset($offerexist[0])){
          echo "Offer already exists for this product";
        }
        else{
          $username = $_SESSION['traderusername'];
          $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
          $arr = oci_parse($conn, $sql);
          oci_execute($arr);
          $trader_id = oci_fetch_array($arr)[0];  
          $query = "INSERT INTO OFFER(OFFER_NAME, OFFER_PERCENTAGE, OFFER_VALID_DATE, ITEMS ,FK_USER_ID) VALUES('$offername',$offerpercent, '$offerdate', '$pname', $trader_id )";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          $sql2 = "SELECT OFFER_ID FROM OFFER WHERE ITEMS= '$pname' AND FK_USER_ID = '$trader_id'";
          $arr2 = oci_parse($conn, $sql2);
          oci_execute($arr2);
          $offer_id = oci_fetch_array($arr2)[0];
          $query = "INSERT INTO OFFER_PRODUCT(PRODUCT_ID, OFFER_ID) VALUES($offerproduct, $offer_id)";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          echo "OFFER SUCCESSFULLY ADDED";
        }
    }
    else{
      echo "cannot have empty fields!!";
    }
  }


?>


<?php
if(isset($_POST['updateofferbtn'])){
  if(!empty($_POST['offername2']) && !empty($_POST['offeradd2']) && !empty($_POST['offerdate2']) && !empty($_POST['protooffer']) && !empty($_POST['hideofferupdate'])){
    $offername = $_POST['offername2'];
    $offerpercent = $_POST['offeradd2'];
    $offerdate = $_POST['offerdate2'];
    $offerproduct = $_POST['protooffer'];
    $offerid = $_POST['hideofferupdate'];
    $username = $_SESSION['traderusername'];
    echo $_POST['offername2'];
    echo  $_POST['offeradd2'];
    echo $_POST['offerdate2'];
    echo $_POST['protooffer'];


    $sql =  "SELECT NAME FROM PRODUCT WHERE PRODUCT_ID = '$offerproduct'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $pname = oci_fetch_array($arr)[0];
          $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
          $arr = oci_parse($conn, $sql);
          oci_execute($arr);
          $trader_id = oci_fetch_array($arr)[0];  
          $query = "UPDATE OFFER SET OFFER_NAME = '$offername', OFFER_PERCENTAGE = $offerpercent, OFFER_VALID_DATE = '$offerdate' , ITEMS = '$pname' ,FK_USER_ID = $trader_id WHERE OFFER_ID = '$offer_id'";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          // $sql2 = "SELECT OFFER_ID FROM OFFER WHERE ITEMS= '$pname' AND FK_USER_ID = '$trader_id'";
          // $arr2 = oci_parse($conn, $sql2);
          // oci_execute($arr2);
          // $offer_id = oci_fetch_array($arr2)[0];
          $query = "UPDATE OFFER_PRODUCT SET PRODUCT_ID = '$offerproduct' WHERE OFFER_ID = '$offerid'";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          echo "OFFER SUCCESSFULLY Updated";
  }
  else{
    echo "cannot have empty fields!!";
  }
}



?>
  <?php
  include("../connectionPHP/connect.php");
    if(isset($_POST['uploadpic'])){
      if(!empty($_FILES['traderpic1']['name'])){
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["traderpic1"]["name"]);
        $image = basename($_FILES["traderpic1"]["name"]);
        if (move_uploaded_file($_FILES["traderpic1"]["tmp_name"], $target_file)) {
          echo "<p>The file ". htmlspecialchars( basename( $_FILES["adminpic1"]["name"])). " has been uploaded.</p>";
      } else {
          echo "<p>Error: Sorry, there was an error uploading your file.</p>";
          $image = null;
      }
      $sql = "UPDATE MART_USER SET IMAGE = '$image' WHERE USER_ID = 7";
      $arr = oci_parse($conn, $sql);
      oci_execute($arr);
      }
      else{
        echo "<p>Please specify the image path</p>";
      }
    }
    

?>
<section class="errorsflash">
    <?php
        if($errornewPass != "" || $errorconfirmpass != "" || $flashvalidated!= "" || $errornotmatch != "" ){
            echo $errornewPass;
            echo $errorconfirmpass;
            echo $flashvalidated;
            echo $errornotmatch;
        }

?>
    </section>
  <?php
  $pquanterror = false;
  $ppriceError = false;
  $pdescerror = false;
  
  if(isset($_POST['updateproduct'])){
  //   echo $_POST['pname1'];
  // echo $_POST['pprice1'];
  // echo $_POST['pquant1'];
  // echo $_POST['prodesc1'];
  // echo $_POST['pallergy1'];
  // echo $_POST['shopname1'];
  // echo  $_POST['pmanudate1'];
  // echo  $_POST['pexpiredate1'];
    if(!empty($_POST['pname1']) && !empty($_POST['pprice1']) && !empty($_POST['pquant1']) && !empty($_POST['prodesc1']) && !empty($_POST['pallergy1']) && !empty($_POST['shopname1']) && !empty($_POST['pmanudate1']) && !empty($_POST['pexpiredate1'])){
      $pname = $_POST['pname1'];
      $pprice = $_POST['pprice1'];
      $pquant = $_POST['pquant1'];
      $pdesc = $_POST['prodesc1'];
      $pallergy = $_POST['pallergy1'];
      $pshop = $_POST['shopname1'];
      $pmanudate = $_POST['pmanudate1'];
      $pexpiredate = $_POST['pexpiredate1'];
      $pid = $_POST['pidupdate'];
      echo $pid;
      if(is_numeric($pquant)){
        $pquanterror = false;
      }
      else{
        $pquanterror = true;
      }
      if(is_numeric($pprice)){
        $ppriceError = false;
      }
      else{
        $ppriceError = true;
      }
      $splittedDesc = explode(" ", $pdesc);
      $count = count($splittedDesc);
      echo $count;
      if($count >= 20 && $count <= 100){
        $pdescerror = false;
      }
      else{
        $pdescerror = true;
      }
    if($pquanterror == false && $pdescerror == false && $ppriceError == false){
      $sql = "UPDATE PRODUCT SET NAME = '$pname', PRICE = '$pprice', STOCK_AVAILABLE ='$pquant', DESCRIPTION = '$pdesc', MINIMUM_ORDER = '20', ALLERGY_INFORMATION = '$pallergy', FK_SHOP_ID = '$pshop', STATUS = '1',PRODUCT_REGISTERED = 'no', MANUFACTURE_DATE = TO_DATE(:pmanudate, 'YYYY-MM-DD'), EXPIRY_DATE = TO_DATE(:pexpiredate, 'YYYY-MM-DD')  WHERE PRODUCT_ID = '$pid'";   
      $arr = oci_parse($conn, $sql);
      oci_bind_by_name($arr, ':pmanudate', $pmanudate);
      oci_bind_by_name($arr, ':pexpiredate', $pexpiredate);
      oci_execute($arr);
    }
    else{
      if($pquanterror == true){
        echo "<p>Quantity must be in number</p>";
      }
      if($ppriceError == true){
        echo "<p>Price must be in number</p>";
      }
      if($pdescerror == true){
        echo "<p>Description should be between 20 and 100 words!!</p>";
      }
    }
  }
  else{
    echo "<p>No fields can be empty</p>";
  }
  }
// }
  ?>
<?php
      if(isset($_POST['addproduct'])){
        if(!empty($_POST['pname']) && !empty($_POST['pprice']) && !empty($_POST['pquant']) && !empty($_POST['prodesc']) && !empty($_POST['pallergy']) && !empty($_POST['shopname']) && !empty($_POST['pmanudate']) && !empty($_POST['pexpiredate']) && !empty($_POST['categorypro'])){
          $pname = $_POST['pname'];
          $pprice = $_POST['pprice'];
          $pquant = $_POST["pquant"];
          $pdesc = $_POST['prodesc'];
          $pallergy = $_POST['pallergy'];
          $pmanudate = $_POST['pmanudate'];
          $pexpiredate = $_POST['pexpiredate'];
          $categoryproduct = $_POST['categorypro'];
          $categoryothers = $_POST['othercategory'];
          // $pmanudate = $_POST['p']
          $pshop = $_POST['shopname'];
          if($categoryproduct == 'others'){
            if(!empty($categoryothers)){
              $cat = $categoryothers;
              $pcaterror = false;
            }
            else{
              $pcaterror = true;
            }
          }
          else{
            $cat = $categoryproduct;
            $pcaterror = false;
          }
          if(is_numeric($pquant)){
            $pquanterror = false;
          }
          else{
            $pquanterror = true;
          }
          if(is_numeric($pprice)){
            $ppriceError = false;
          }
          else{
            $ppriceError = true;
          }
          $splittedDesc = explode(" ", $pdesc);
          $count = count($splittedDesc);
          echo $count;
          if($count >= 20 && $count <= 100){
            $pdescerror = false;
          }
          else{
            $pdescerror = true;
          }
          $target_dir1 = "../productsImage/";
          $target_file1 = $target_dir1 . basename($_FILES["image1"]["name"]);
          $image1 = basename($_FILES["image1"]["name"]);
          if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file1)) {
            echo "";
          } else {
            echo "<p>Error: Sorry, there was an error uploading your first image.</p>";
            $image1 = null;
          }
          $target_dir2 = "../productsImage/";
          $target_file2 = $target_dir2 . basename($_FILES["image2"]["name"]);
          $image2 = basename($_FILES["image2"]["name"]);
          if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2)) {
            echo "";
          } else {
            echo "<p>Error: Sorry, there was an error uploading your second image.</p>";
            $image2 = null;
          }
          $target_dir3 = "../productsImage/";
          $target_file3 = $target_dir3 . basename($_FILES["image3"]["name"]);
          $image3 = basename($_FILES["image3"]["name"]);
          if (move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file3)) {
            echo "";
          } else {
            echo "<p>Error: Sorry, there was an error uploading your third image.</p>";
            $image3 = null;
          }
          if($pquanterror == false && $pdescerror == false && $ppriceError == false && $image1 != null && $image2 != null && $image3 != null && $pcaterror == false){
            if($categoryproduct != 'others'){
              $sql = "INSERT INTO PRODUCT(NAME, PRICE, STOCK_AVAILABLE, DESCRIPTION, MINIMUM_ORDER, ALLERGY_INFORMATION, MANUFACTURE_DATE, EXPIRY_DATE, IMAGE1, IMAGE2, IMAGE3, FK_CATEGORY_ID, FK_SHOP_ID, STATUS,PRODUCT_REGISTERED ) VALUES('$pname', '$pprice', '$pquant', '$pdesc', '20', '$pallergy', TO_DATE(:pmanudate, 'YYYY-MM-DD'), TO_DATE(:pexpiredate, 'YYYY-MM-DD'), '$image1', '$image2', '$image3','$cat','$pshop' , '1', 'yes')";
              $arr = oci_parse($conn, $sql);
              oci_bind_by_name($arr, ':pmanudate', $pmanudate);
              oci_bind_by_name($arr, ':pexpiredate', $pexpiredate);
              oci_execute($arr);
            }
            else{
              $username = $_SESSION['traderusername'];
              $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
              $arr = oci_parse($conn, $sql);
              oci_execute($arr);
              $trader_id = oci_fetch_array($arr)[0];
              $sql = "SELECT CATEGORY_NAME, CATEGORY_ID FROM CATEGORY WHERE CATEGORY_NAME = '$cat' AND FK_USER_ID = '$trader_id'";
              $arr = oci_parse($conn, $sql);
              oci_execute($arr);
              $uniquecat = oci_fetch_array($arr);
              $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
              $arr = oci_parse($conn, $sql);
              oci_execute($arr);
              $trader_id = oci_fetch_array($arr)[0];
              if(isset($uniquecat[0])){
                $cat_id = $uniquecat[1];
                $sql = "INSERT INTO PRODUCT(NAME, PRICE, STOCK_AVAILABLE, DESCRIPTION, MINIMUM_ORDER, ALLERGY_INFORMATION, MANUFACTURE_DATE, EXPIRY_DATE, IMAGE1, IMAGE2, IMAGE3, FK_CATEGORY_ID, FK_SHOP_ID, STATUS,PRODUCT_REGISTERED ) VALUES('$pname', '$pprice', '$pquant', '$pdesc', '20', '$pallergy', TO_DATE(:pmanudate, 'YYYY-MM-DD'), TO_DATE(:pexpiredate, 'YYYY-MM-DD'), '$image1', '$image2', '$image3','$cat_id','$pshop', '1', 'yes')";
                $arr = oci_parse($conn, $sql);
                oci_bind_by_name($arr, ':pmanudate', $pmanudate);
                oci_bind_by_name($arr, ':pexpiredate', $pexpiredate);
                oci_execute($arr);
              }
              else{
                $sql = "INSERT INTO CATEGORY(CATEGORY_NAME, CATEGORY_DESCRIPTION, STATUS, FK_USER_ID) VALUES('$cat', 'Category for trader $trader_id ', 1 , $trader_id)";
                $arr = oci_parse($conn, $sql);
                oci_execute($arr);
                $username = $_SESSION['traderusername'];
                $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
                $arr = oci_parse($conn, $sql);
                oci_execute($arr);
                $trader_id = oci_fetch_array($arr)[0];
                $sql = "SELECT CATEGORY_ID FROM CATEGORY WHERE CATEGORY_NAME = '$cat' AND FK_USER_ID = '$trader_id'";
                $arr = oci_parse($conn, $sql);
                oci_execute($arr);
                $cat_id = oci_fetch_array($arr)[0];
                $sql = "INSERT INTO PRODUCT(NAME, PRICE, STOCK_AVAILABLE, DESCRIPTION, MINIMUM_ORDER, ALLERGY_INFORMATION, MANUFACTURE_DATE, EXPIRY_DATE, IMAGE1, IMAGE2, IMAGE3, FK_CATEGORY_ID, FK_SHOP_ID, STATUS,PRODUCT_REGISTERED ) VALUES('$pname', '$pprice', '$pquant', '$pdesc', '20', '$pallergy', TO_DATE(:pmanudate, 'YYYY-MM-DD'), TO_DATE(:pexpiredate, 'YYYY-MM-DD'), '$image1', '$image2', '$image3','$cat_id','$pshop', '2', 'yes')";
                $arr = oci_parse($conn, $sql);
                oci_bind_by_name($arr, ':pmanudate', $pmanudate);
                oci_bind_by_name($arr, ':pexpiredate', $pexpiredate);
                oci_execute($arr);
              }
              
            }
            // echo "hello";
          }
          else{
            if($pquanterror == true){
              echo "<p>Quantity must be in number</p>";
            }
            if($ppriceError == true){
              echo "<p>Price must be in number</p>";
            }
            if($pdescerror == true){
              echo "<p>Description should be between 20 and 100 words!!</p>";
            }
            if($pcaterror == true){
              echo "<p>product category field is empty!!</p>";
            }
          }
        }
        else{
          echo "<p>Cannot have empty fields</p>";
        }
      }

      ?>
      <h2>Welcome trader <?php $username = $_SESSION['traderusername']; echo $username; ?></h2>
      <div class="welcometrader">
      The trader dashboard provides traders with real-time market data, advanced charting tools, and access to market news and research. Traders can place orders, monitor their portfolio, manage positions, and set risk parameters. The dashboard also offers administrative features, educational resources, and customer support. It is a comprehensive platform that enables traders to make informed decisions, execute trades, and effectively manage their trading activities.
      </div>


      <div class="stats">
        <?php 
        $username = $_SESSION['traderusername'];
        $sql = "SELECT COUNT(*) FROM PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND MART_USER.USERNAME = '$username'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $products = oci_fetch_array($arr)[0];
        // echo $products;
        ?>
        <div class="productstat"> <h4>Products: </h4>
      <h4><?php echo $products; ?></h4></h3></div>
        <?php
        ?>
        <?php
        $sql = "SELECT CART_ID FROM CART, MART_USER WHERE CART.FK_USER_ID = MART_USER.USER_ID AND MART_USER.USERNAME = '$username'";
        $arr = oci_parse($conn, $sql);
         oci_execute($arr);
         $cart_id = oci_fetch_array($arr);
        $sql = "SELECT COUNT(*) FROM PRODUCT INNER JOIN ORDERED_PRODUCT ON ORDERED_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID INNER JOIN PRODUCT_ORDER ON PRODUCT_ORDER.ORDER_ID = ORDERED_PRODUCT.ORDER_ID WHERE PRODUCT_ORDER.FK_CART_ID = '$cart_id' AND PRODUCT_ORDER.STATUS = 2";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        $countPro = oci_fetch_array($arr)[0];
?>
        <div class="orderstat">
      <h4>Orders: </h4>
      <h4><?php echo $countPro; ?></h4>

        </div>

<?php

        ?>
        <?php
    $sql = "SELECT COUNT(*) FROM SHOP, MART_USER WHERE SHOP.FK_USER_ID = MART_USER.USER_ID AND MART_USER.USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
         oci_execute($arr);
         $shopnum = oci_fetch_array($arr)[0];
         ?>
<div class="shopstat">
<h4>Shop Numbers: </h4>
      <h4><?php echo $shopnum; ?></h4>
</div>

         <?php

    $sql = "SELECT COUNT(*) FROM OFFER, MART_USER WHERE OFFER.FK_USER_ID = MART_USER.USER_ID AND MART_USER.USERNAME = '$username'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $offernum = oci_fetch_array($arr)[0];
    ?>
<div class="offerstat">
<h4>Offers: </h4>
      <h4><?php echo $offernum; ?></h4>
</div>
    <?php

        ?>
      </div>
</div>

</section>

    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id='shops'>
        <!-- section manage shops -->
      <section class="shops-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink1" href="#onelink1">Add Shops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink1" href="#twolink1">Disable shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink1" href="#threelink1"> Delete shop</a>
        </li>
      </ul>
    </div>
    <!-- <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button> -->
  </div>
</nav>

<!-- pages -->


<div id="onelink1">
    <div class="addshop">
      <h3>Add Shop</h3>
      <p>According to cleckhfmart rules and regulations only two shops can be allowed per trader.</p>
      <div class="shopnew" method="POST" action="">
        <div class="shop-name">
          <label for="shop--name">Shop Name</label>
          <input type="text" name="shop--name" id="shop--name" placeholder="eg: dairy"> 
        </div>
        <div class="shop-address">
          <label for="shop--address">Shop Address</label>
          <input type="text" name="shop--address" id="shop--address" placeholder="eg: uk">
        </div>
        <div class="shop-contact">
          <label for="shop--contact">Shop contact Number</label>
          <input type="text" name="shop--contact" id="shop--contact" placeholder="eg: 9841000000">
        </div>
        <div class="addshopbtn">
          <button name="addshop">Add Shop</button>
        </div>
      </div>
    </div>
</div>
<!-- finished first page add product -->
<div id="twolink1" class="disableshopMain">
    <h3>
          Disable Shop
        </h3>
    <div class="disableshop">
        
        <div class="shopDetail">
          <p>Shop1</p>
          <p>Category</p>
          <input type="hidden" class="activeInput">
          <button>Disable</button>
        </div>

    </div>
    <hr>
    <h3>Enable Shop</h3>
    <div class="enableshop">
        
        <div class="shopDetail">
          <p>Shop1</p>
          <p>Category</p>
          <input type="hidden" class="inactiveInput">
          <button>Disable</button>
        </div>
    </div>

</div>
<div id="threelink1">
  <h3>Delete shop</h3>
  <div class="deleteshop">
    <div class="shopDetail">
            <p>Shop1</p>
            <p>Category</p>
            <input type="hidden" class="deleteInput">
            <button>Delete</button>
    </div>
  </div>
  
</div>


      </section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="products">
        <!-- section manage products -->
      <section class="products-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink2" href="#onelink2">Add Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink2" href="#twolink2">Disable Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink2" href="#threelink2"> Edit Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="fourlink2" href="#fourlink2"> Delete Products</a>
        </li>
      </ul>
    </div>
    <!-- <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button> -->
  </div>
</nav>
<!-- pages -->


<div id="onelink2" class="addproduct">
<h1>Add Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
      
        <div class="productname">
            <label for="pname">Product Name(*)</label>
            <input type="text" name="pname" id="pname" placeholder= "eg: salmon fish" value="<?php if(isset($_POST['pname'])) echo $_POST['pname'] ?>">
        </div>
        <div class="productprice">
            <label for="pprice">Product Price</label>
            <input type="text" name="pprice" id="pprice" placeholder= "eg: £8" value="<?php if(isset($_POST['pprice'])) echo $_POST['pprice'] ?>">
        </div>
        <div class="collection1">
        <div class="productquantity">
            <label for="pquant">Product Quantity(*)</label>
            <input type="text" name="pquant" id="pquant" placeholder="eg: 6" value="<?php if(isset($_POST['pquant'])) echo $_POST['pquant'] ?>">
        </div>
        <div class="proDescription">
            <label for="prodesc">Product Description(*)</label>
            <textarea name="prodesc" id="prodesc" cols="30" rows="10"><?php if(isset($_POST['prodesc'])) echo $_POST['prodesc'] ?></textarea>
        </div>
        </div>
        <div class="collection2">
        <div class="productmanudate">
            <label for="pmanudate">Product Manufacture Date</label>
            <input type="date" name="pmanudate" id="pmanudate" placeholder="eg: DD/MM/YYYY" value="<?php if(isset($_POST['pmanudate'])) echo $_POST['pmanudate'] ?>">
        </div>
        <div class="productexpiredate">
            <label for="pexpiredate">
                Product Expiry Date
            </label>
            <input type="date" name="pexpiredate" id="pexpiredate" placeholder="eg: eg: DD/MM/YYYY" value="<?php if(isset($_POST['pexpiredate'])) echo $_POST['pexpiredate'] ?>">
        </div>
        </div>
        <div class="collection3">
        <div class="productallergy">
            <label for="pallergy">Product Allergy(*)</label>
            <input type="text" name="pallergy" id="pallergy" placeholder="eg: lactose allergy" value="<?php if(isset($_POST['pallergy'])) echo $_POST['pallergy'] ?>">
        </div>
        <div class="shop">
            <label for="shopname">
                Shop(*)
            </label>
            <select name="shopname" id="shopname">
                <option value="">Butchers</option>
            </select>
        </div>
        </div>
        <div class="collection4">
        <div class="categoryselect">
            <label for="categoryselect">
                Category(*)
            </label>
            <select name="categorypro" id="category">
                <option value="">category1</option>
            </select>
            <!-- <label for="othercat">Add your own category</label> -->
            <input id='othercat' type="hidden" name="othercategory" placeholder='add your own category'>
        </div>
        </div>
        <div class="collection5">
            <div class="image1">
                <label for="image1">
                First image(*)
            </label>
            <input type="file" name="image1" id="image1">
            </div>
            <div class="image2">
                <label for="image2">
                Second image(*)
            </label>
            <input type="file" name="image2" id="image2">
            </div>
            <div class="image3">
                <label for="image3">
                Third image(*)
           </label>
            <input type="file" name="image3" id="image3">
            </div>
            
        </div>
        <div class="btnaddpro">
            <button type="submit" name="addproduct" class="addproduct">Add product</button>
        </div>
        
        
    </form>

</div>
<!-- add product page finished -->



<div id="twolink2" class="disableproduct">
  <div class="disableproduct">
     <h1>Disable Product</h1>
    <?php  
    include("../connectionPHP/connect.php");
    $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = '$trader_id' AND PRODUCT.STATUS = 1";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productId = $rows[5];
      
      $sql1 = "SELECT OFFER_PERCENTAGE
      FROM OFFER
      INNER JOIN OFFER_PRODUCT ON OFFER.OFFER_ID = OFFER_PRODUCT.OFFER_ID WHERE OFFER_PRODUCT.PRODUCT_ID = '$productId'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1);
      if(isset($productDiscount[0]))
        $productDiscount = $productDiscount[0];
      else
        $productDiscount = "No offer given";
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4]; 
      $productId = $rows[5]; 
      $productAllergy = $rows[6];
      $productImage = $rows[7];
      $productStatus = $rows[8];
      $productRegistered = $rows[9];
      ?>
      <form class="productenabled" method="POST" action="">
                <div class="img--info">
                    <img src="../productsImage/<?php echo $productImage; ?>" alt="">
                    <div class="info">
                        <p><?php echo $productName; ?></p>
                        <p><?php echo $productCategory; ?></p>
                        <p><?php echo $productQuant; ?> items</p>
                    </div>
                </div>
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php echo $productRegistered; ?></p>

                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <input type="hidden" name="hiddendisablepro" value="<?php echo $productId; ?>">
                    <button class="disablepro" type="submit" name="disablepro">Disable Product</button>
                </div>
            </form>
      

      <?php
    }

    ?>
    </div>
   <div class="enableproduct">
   <h1>Enable Product</h1>
    <?php  
    include("../connectionPHP/connect.php");
    // $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = 1029 AND PRODUCT.STATUS = 0";
    $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = '$trader_id' AND PRODUCT.STATUS = 0";

    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productId = $rows[5];
      
      $sql1 = "SELECT OFFER_PERCENTAGE
      FROM OFFER
      INNER JOIN OFFER_PRODUCT ON OFFER.OFFER_ID = OFFER_PRODUCT.OFFER_ID WHERE OFFER_PRODUCT.PRODUCT_ID = '$productId'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1);
      if(isset($productDiscount[0]))
        $productDiscount = $productDiscount[0];
      else
        $productDiscount = "No offer given";
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productAllergy = $rows[6];
      $productImage = $rows[7];
      $productId = $rows[5];
      $productStatus = $rows[8];
      $productRegistered = $rows[9];
      ?>
      <form class="productenabled" method="POST" action="">
                <div class="img--info">
                    <img src="../productsImage/<?php echo $productImage; ?>" alt="">
                    <div class="info">
                        <p><?php echo $productName; ?></p>
                        <p><?php echo $productCategory; ?></p>
                        <p><?php echo $productQuant; ?> items</p>
                    </div>
                </div>
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php if($productStatus == 1) echo "yes"; else echo "no"; ?></p>

                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <input type="hidden" name="hiddenenablepro" value="<?php echo $productId; ?>">
                    <button type="submit" class="enablepro" name="enablepro">Enable Product</button>
                </div>
            </form>
      

      <?php
    }

    ?>
   </div>

</div>
<div id="threelink2">
<div class="editproduct">
  <div class="editingpanelpro hidemodal">
    <form action="" method="POST" enctype="multipart/form-data">
      <h3>Edit Product</h3>
      <div class="cross">
        <i class="fa-solid fa-xmark"></i>
      </div>
        <div class="collect0">
        <div class="productname">
            <label for="pname">Product Name(*)</label>
            <input type="text" name="pname1" id="pname" placeholder= "eg: salmon fish">
        </div>
        <div class="productprice">
            <label for="pprice">Product Price(*)(in £) </label>
            <input type="text" name="pprice1" id="pprice" placeholder= "eg: 8">
        </div>
        </div>
        <div class="collect2">
        <div class="productquantity">
            <label for="pquant">Product Quantity(*)</label>
            <input type="text" name="pquant1" id="pquant" placeholder="eg: 6">
        </div>
        <div class="proDescription">
            <label for="prodesc">Product Description(*)</label>
            <textarea name="prodesc1" id="prodesc" cols="20" rows="5"></textarea>
        </div>
        </div>
        <div class="collect3">
          <div class="productallergy">
              <label for="pallergy">Product Allergy(*)</label>
              <input type="text" name="pallergy1" id="pallergy" placeholder="eg: lactose allergy">
          </div>
        <div class="shop">
          <label for="shopname1">
                Shop(*)
            </label>
            <select name="shopname1" id="shopname1">
                <option value="">Butchers</option>
            </select>
        </div>
        </div>
        <div class="collect4">
          <div class="productmanudate">
            <label for="pmanudate">Product Manufacture Date</label>
            <input type="date" name="pmanudate1" id="pmanudate" placeholder="eg: DD/MM/YYYY">
        </div>
        <div class="productexpiredate">
            <label for="pexpiredate">
                Product Expiry Date
            </label>
            <input type="date" name="pexpiredate1" id="pexpiredate" placeholder="eg: eg: DD/MM/YYYY">
        </div>
        </div>
        
        <div class="btnaddpro">
          <input type="hidden" name="pidupdate" class='pidupdate'>
            <button type="submit" name="updateproduct" class="editproduct">Update</button>
        </div>
        
        
    </form>
  </div>
   <h3 style="color: var(--secondary-color); margin-top: 2em;">Edit Product</h3>
    <?php  
    include("../connectionPHP/connect.php");
    // $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED, PRODUCT.PRODUCT_ID FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = 1029";
    $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = '$trader_id'";

    
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productId = $rows[5];
      $sql1 = "SELECT OFFER_PERCENTAGE
      FROM OFFER
      INNER JOIN OFFER_PRODUCT ON OFFER.OFFER_ID = OFFER_PRODUCT.OFFER_ID WHERE OFFER_PRODUCT.PRODUCT_ID = '$productId'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1);
      if(isset($productDiscount[0]))
        $productDiscount = $productDiscount[0];
      else
        $productDiscount = "No offer given";
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productAllergy = $rows[6];
      $productImage = $rows[7];
      $productStatus = $rows[8];
      $productRegistered = $rows[9];
      // $productId = $rows[10];
      ?>
      <div class="productenabled">
                <div class="img--info">
                    <img src="../productsImage/<?php echo $productImage; ?>" alt="">
                    <div class="info">
                        <p><?php echo $productName; ?></p>
                        <p><?php echo $productCategory; ?></p>
                        <p><?php echo $productQuant; ?> items</p>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $productId; ?>" class="hiddenpid">
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php if($productStatus == 1) echo "yes"; else echo "no"; ?></p>


                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <button class="edittriggerpro">Edit product</button>
                </div>
            </div>
      

      <?php
    }

    ?>
   </div>

</div>
<div id="fourlink2">
<div class="deleteproduct">
<h3 style="color: var(--secondary-color); margin-top: 2em;">Delete Product</h3>
    <?php  
    include("../connectionPHP/connect.php");
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 1029";
    // $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED, PRODUCT.PRODUCT_ID FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = 1029";
    $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader' AND MART_USER.USER_ID = '$trader_id'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productId = $rows[5];
      
      $sql1 = "SELECT OFFER_PERCENTAGE
      FROM OFFER
      INNER JOIN OFFER_PRODUCT ON OFFER.OFFER_ID = OFFER_PRODUCT.OFFER_ID WHERE OFFER_PRODUCT.PRODUCT_ID = '$productId'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1);
      if(isset($productDiscount[0]))
        $productDiscount = $productDiscount[0];
      else
        $productDiscount = "No offer given";
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productAllergy = $rows[6];
      $productImage = $rows[7];
      $productStatus = $rows[8];
      $productRegistered = $rows[9];
      $productId = $rows[5];
      ?>
      <form class="productenabled" method="POST" action="">
                <div class="img--info">
                    <img src="../productsImage/<?php echo $productImage; ?>" alt="">
                    <div class="info">
                        <p><?php echo $productName; ?></p>
                        <p><?php echo $productCategory; ?></p>
                        <p><?php echo $productQuant; ?> items</p>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $productId; ?>" class="hiddenpid">
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php if($productStatus == 1) echo "yes"; else echo "no"; ?></p>


                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <input type="hidden" name="hidedeletepro" value="<?php echo $productId; ?>">
                    <button class="deletepro" name="deletepro">Delete product</button>
                </div>
            </form>
      

      <?php
    }

    ?>
</div>

</div>
      </section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="offers">
        <!-- section manage offers -->
      <section class="offers-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink3" href="#">Add Offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink3" href="#">Update offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink3" href="#"> Delete Offers</a>
        </li>
      </ul>
    </div>
    <!-- <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button> -->
  </div>
</nav>

<!-- pages -->


<div id="onelink3">
<h4 style="color: var(--secondary-color);">Offers given</h4>
    <div class="totaloffersgiven">
        <?php
        include("../connectionPHP/connect.php");
      // $sql = "SELECT PRODUCT_NAME, OFFER_PER, OFFER_VALID FROM PRODUCT, OFFER WHERE PRODUCT.PRODUCT_ID = OFFER.PRODUCT_ID";
      $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
      $sql = "SELECT PRODUCT.NAME, OFFER.OFFER_ID FROM PRODUCT, OFFER,SHOP, MART_USER WHERE SHOP.SHOP_ID = PRODUCT.FK_SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND MART_USER.USER_ID = OFFER.FK_USER_ID AND MART_USER.USER_ID = '$trader_id'";

      $arr = oci_parse($conn, $sql);
      oci_execute($arr);
      while($rows = oci_fetch_array($arr)){
        $pname = $rows[0];
        $offerId = $rows[1];
        $sql1 = "SELECT OFFER_PERCENTAGE, OFFER_VALID_DATE, OFFER_NAME FROM OFFER WHERE OFFER_ID = '$offerId'";
        $arr1 = oci_parse($conn, $sql1);
        oci_execute($arr1);
        $offer = oci_fetch_array($arr1);
        $offerper = $offer[0];
        $offerexpire = $offer[1];
        $offername = $offer[2];
        // $offerper = $rows[1];
        // $offerexpire = $rows[2];

        ?>
<div class="productsq">
          <?php echo "<p>offer name: ".$offername."</p>" ?>
          <?php echo "<p>offer percentage: ".$offerper."%</p>"; ?>
          <?php echo "<p>offer expires in: ".$offerexpire."</p>"; ?> 
        </div>
<?php
      }
        ?>
        
    </div>
    <button style="margin-top: 5em;" class="addoffer">Add new offer</button>

    <form method="POST" class="addoffers hideaddoffer">
      
        <div>
        <label for="offername">
            New offer Name
          </label>
          <input type="text" name="offername1" id="offername1" class="offername1" placeholder="christmas offer">
          <label for="addinput">
            Offer Percentage(in %  )
          </label>
          <input type="number" id="addinput1" name="offeradd1" class="offeradd1" placeholder="eg: 8%">
          <label for="expiredate">
            Expiry date
          </label>
          <input type="date" id="expiredate1" name="offerdate1" class="offerdate1" placeholder="eg: 02/02/2024">
        </div>
        <div class="selectproduct">
          <div class="pro1">
          <label for="poffer">product(*)</label>
          <select id="poffer1" class="pofferclass1" name="protooffer">
            <!-- <option value=""></option> -->
          </select>
          </div>
          
        </div>
        <div class="offerbtn1">
          <button type="submit" class="addofferbtn" name="addofferbtn">Add offer</button>
        </div>
    </form>


</div>
<div id="twolink3">
  <h1>Update offers</h1>
  <?php
        include("../connectionPHP/connect.php");
        $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
        $sql = "SELECT PRODUCT.NAME, OFFER.OFFER_ID FROM PRODUCT, OFFER,SHOP, MART_USER WHERE SHOP.SHOP_ID = PRODUCT.FK_SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND MART_USER.USER_ID = OFFER.FK_USER_ID AND MART_USER.USER_ID = '$trader_id'";
        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        while($rows = oci_fetch_array($arr)){
          $pname = $rows[0];
          $offerId = $rows[1];
          $sql1 = "SELECT OFFER_NAME, OFFER_PERCENTAGE, OFFER_VALID_DATE FROM OFFER WHERE OFFER_ID = '$offerId'";
          $arr1 = oci_parse($conn, $sql1);
          oci_execute($arr1);
          $offer = oci_fetch_array($arr1);
          $offername = $offer[0];
          $offerper = $offer[1];
          $offerexpire = $offer[2];

        ?>
<div class="productsq">
  <?php echo "<p>offer name: ".$offername."</p>" ?>
  <?php echo "<p>offer percentage: ".$offerper."%</p>"; ?>
  <?php echo "<p>offer expires in: ".$offerexpire."</p>"; ?> 
  <button class="Updateoffer">Update</button>
</div>
<div class="addoffers1 updateoffer"  >
          <input type="hidden" value="<?php echo $offerId; ?>" class="hideofferupdate">
        <div>
          <label for="offername">
            New offer name
          </label>
          <input type="text" class="offername2" name="offername2" value="<?php echo $offername; ?>">
          <label for="addinput">
            Offer Percentage(in %  )
          </label>
          <input type="number" class="offeradd2" name="offeradd2" placeholder="eg: 8%" value="<?php echo $offerper; ?>">
          <label for="expiredate">
            Expiry date
          </label>
          <input type="date" class="offerdate2" name="offerdate2" placeholder="eg: 02/02/2024" value="<?php echo $offerexpire; ?>">
        </div>
        
        <div class="selectproduct">
          <div class="pro1">
          <label for="poffer1">product(*)</label>
          <select name="poffer" class="pofferclass2" name="protooffer">
            <option value=""></option>
          </select>
          </div>
          
        </div>
        <div class="offerbtn2">
          <button type="submit" class="updateofferbtn" name="updateofferbtn">Update offer</button>
        </div>
    </div>
<?php
      }
        ?>


</div>
<div id="threelink3">
<h3>Delete offer</h3>
<?php
        include("../connectionPHP/connect.php");
        $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
      $sql = "SELECT PRODUCT.NAME, OFFER.OFFER_ID FROM PRODUCT, OFFER,SHOP, MART_USER WHERE SHOP.SHOP_ID = PRODUCT.FK_SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND MART_USER.USER_ID = OFFER.FK_USER_ID AND MART_USER.USER_ID = '$trader_id'";

        $arr = oci_parse($conn, $sql);
        oci_execute($arr);
        while($rows = oci_fetch_array($arr)){ 
          $pname = $rows[0];
          $offerId = $rows[1];
          $sql1 = "SELECT OFFER_NAME, OFFER_PERCENTAGE, OFFER_VALID_DATE, OFFER_ID FROM OFFER WHERE OFFER_ID = '$offerId'";
          $arr1 = oci_parse($conn, $sql1);
          oci_execute($arr1);

          $offer = oci_fetch_array($arr1);
          $offername = $offer[0];
          $offerper = $offer[1];
          $offerexpire = $offer[2];
          $offerID = $offer[3];
        if(!isset($rows[0])){
          echo "<h4>No data found!!</h4>";
        }
        ?>
        <form action="#" method="POST">
        <?php
  if(isset($_POST['deleteoffer'])){
    // $offerId = $_POST['deleteofferinput'];
    // echo $offerId;
    $sql1 = "DELETE FROM OFFER WHERE OFFER_ID = '$offerId'";
    $arr1 = oci_parse($conn, $sql1);
    oci_execute($arr1);
    $sql1 = "DELETE FROM OFFER_PRODUCT WHERE OFFER_ID = '$offerId'";
    $arr1 = oci_parse($conn, $sql1);
    oci_execute($arr1);
    $_SESSION['offerdelete'] = true;
     
    // header("location: index.php");
  }


?>
<div class="productsq">
<?php echo "<p>offer name: ".$offername."</p>" ?>
          <?php echo "<p>offer percentage: ".$offerper."%</p>"; ?>
          <?php echo "<p>offer expires in: ".$offerexpire."</p>"; ?> 
          <input type="hidden" name="deleteofferinput" value="<?php echo $offerid; ?>">
          <button type="submit" name="deleteoffer">Delete offer</button>
        </div>
        </form>

<?php
      }
        ?>


</div>



      </section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="profile">
        <!-- section manage profile -->
      <section class="profile-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink4" href="#onelink4">Update profile</a>
        </li>
      </ul>
    </div>
    <!-- <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button> -->
  </div>
</nav>

<!-- pages -->


<div id="onelink4">
<div class='logoutsection'>
<form action="" method="POST">
    <button type="submit" name="logouttrader">sign out</button>
  </form>
</div>
<div class="traderimage">
    <h3 style="color: white;">Our team</h3>
    <?php
      include("../connectionPHP/connect.php");
      $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
      $sql = "SELECT IMAGE FROM MART_USER WHERE USER_ID = $trader_id";
      $arr = oci_parse($conn, $sql);
      oci_execute($arr);
      $imagepath = oci_fetch_array($arr)[0];
    ?>
    <img src="../images/<?php echo $imagepath;?>" alt="trader">
    <form class="uploadpicture" method="POST" action="" enctype="multipart/form-data" >
      <input type="file" class='traderpic' name="traderpic1">
      <button class="uploadpic" name="uploadpic">Upload picture</button>
      <button type="button" class="cancelupload">Cancel</button>
    </form>
    <div class="changetraderpicture">
      <button>Change picture</button>
    </div>
    
  </div>
  <div class="profile-section">
  
  
  <?php 
            // $username = $_SESSION['username'];
            // echo $_SESSION['username'];

            include("../connectionPHP/connect.php");
            $username = $_SESSION['traderusername'];
    $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username' AND ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $trader_id = oci_fetch_array($arr)[0];
            $sql = "SELECT * FROM MART_USER WHERE USER_ID = '$trader_id' AND ROLE= 'trader'";
            $arr = oci_parse($conn, $sql);
            oci_execute($arr);
            while($rows = oci_fetch_array($arr)){
                $username = $rows[3];
                $firstname = $rows[1];
                $lastname = $rows[2];
                $mobile = $rows[6];
                $email = $rows[4];
                $gender = $rows[8];
                $address = $rows[7];
                ?>
            <div class='profile-header'>
                <h3>Trader profile</h3>
                <button class="editbtntrigger">Edit Profile</button>
            </div>
            <div class="showuserdetail">
                <div class="userdetail useremail">
                    <p>Email</p>
                    <p><?php echo $email; ?></p>
                </div>
                <div class="userdetail username">
                    <p>Username</p>
                    <p><?php echo $username; ?></p>
                </div>
                <div class="userdetail firstname">
                    <p>Firstname</p>
                    <p><?php echo $firstname; ?></p>
                </div>
                <div class="userdetail lastname">
                    <p>lastname</p>
                    <p><?php echo $lastname; ?></p>
                </div>
                <div class="userdetail mobile">
                    <p>Mobile</p>
                    <p><?php echo $mobile; ?></p>
                </div>
                <div class="userdetail gender">
                    <p>Gender</p>
                    <p><?php echo $gender; ?></p>
                </div>
                <div class="userdetail address">
                    <p>Address</p>
                    <p><?php echo $address; ?></p>
                </div>
                <div class="userdetail password">
                    <p>Password</p>
                    <div>
                        <p>************</p>
                        <button class="changepassbtn">Change password</button>
                        
                    </div>
                </div>
            </div>

            <?php
            }
            
            ?>
            </div>
</div>

      </section>
    </div>
  </div>
  
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>