<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"></link>
</head>
<body>
  <?php
include("../connectionPHP/inc_session_admin.php");
  if(isset($_POST['logoutadmin'])){
    unset($_SESSION['adusername']);
    unset($_SESSION['adpassword']);
    header("location: ../admin_login_page/index.php");
  }
?>
  <div class="backdrop hidebackdrop">
    
  </div>

  <?php
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
      // $username = $_SESSION['username'];
      $username = 'ADMIN';
      $sql = "SELECT PASSWORD FROM MART_USER WHERE USERNAME = '$username'";
      $arr = oci_parse($conn, $sql);
      oci_execute($arr);
      $pass = oci_fetch_array($arr)[0];
      $oldpass = $_POST['oldpass'];
      $newpass = $_POST['newpass'];
      $cpass = $_POST['cpass'];
      if($pass == $oldpass){
          if(validatePass($newpass) == true){
              if($newpass == $cpass){
                  $newpass1 = $newpass;
                  $sql = "UPDATE MART_USER SET PASSWORD = '$newpass1' WHERE USERNAME = '$username'";
                  $array = oci_parse($conn, $sql);
                  oci_execute($array);
                  $_SESSION['password'] = $newpass1;
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
          $errornotmatch = "<p>Passwords do not match with the database!!</p>";
          
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
            // $username = $_SESSION['username'];
            include("../connectionPHP/connect.php");
            $sql = "SELECT * FROM MART_USER WHERE USER_ID = '7' AND ROLE = 'admin'";
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
                $aid = $rows[0];

                ?>
            <div class="editusername">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="username" placeholder="username" value="<?php echo $username ?>">
                <p class='errorusername'></p>

            </div>
            <input type="hidden" class='chidden' value="<?php echo $aid; ?>">
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
  <li class="list-group-item" data-type="overall"> Admin Dashboard</li>
  <!-- <li class="list-group-item" data-type="shops">Manage Shops</li> -->
  <li class="list-group-item" data-type="trader">Manage Trader</li>
  <li class="list-group-item" data-type="customer">Manage Customer</li>
  <li class="list-group-item" data-type="product">Manage Products</li>
  <li class="list-group-item" data-type="review">Manage reviews</li>


  <li class="list-group-item" data-type="profile">Manage Profile</li>
</ul>
    </div>
    <div class='col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10' id='overall'>
        <section class="overall-manage">
    <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink" href="#onelink">Welcome Admin</a>
        </li>
      </ul>
      
    </div>
    <a class="navbar-brand" href="#">Statistics</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
  </div>    
</nav>
<!-- pages -->


<div id="onelink" class="welcome">




<?php
  include("../connectionPHP/connect.php");
    if(isset($_POST['uploadpic'])){
      if(!empty($_FILES['adminpic1']['name'])){
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["adminpic1"]["name"]);
        $image = basename($_FILES["adminpic1"]["name"]);
        if (move_uploaded_file($_FILES["adminpic1"]["tmp_name"], $target_file)) {
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
  include("../connectionPHP/connect.php");
    if(isset($_POST['activatetrader'])){
      $id = $_POST['hidactivtrader'];
      // echo $id;
      $sql = "UPDATE MART_USER SET  STATUS = '1' WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deactivatetrader'])){
      $id = $_POST['hiddeactivtrader'];
      // echo $id;
      $sql = "UPDATE MART_USER SET STATUS = '0' WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['approvetrader'])){
      $id = $_POST['hidapprovetrader'];
      // echo $id;
      $sql = "UPDATE MART_USER SET STATUS = '1' WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deletetrader'])){
      $id = $_POST['hiddeletetrader'];
      // echo $id;
      $sql = "DELETE FROM MART_USER WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['activatecust'])){
      $id = $_POST['hidactivatecust'];
      // echo $id;
      $sql = "UPDATE MART_USER SET  STATUS = '1' WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deactivatecust'])){
      $id = $_POST['hiddeactivatecust'];
      // echo $id;
      $sql = "UPDATE MART_USER SET  STATUS = '0' WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deletecust'])){
      $id = $_POST['hidedeletecust'];
      // echo $id;
      $sql = "DELETE FROM MART_USER WHERE USER_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deactivatepro'])){
      $id = $_POST['hidedeactivateproduct'];
      // echo $id;
      $sql = "UPDATE PRODUCT SET  STATUS = '0' WHERE PRODUCT_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['activatepro'])){
      $id = $_POST['hideactivateproduct'];
      // echo $id;
      $sql = "UPDATE PRODUCT SET  STATUS = '1' WHERE PRODUCT_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deletepro'])){
      $id = $_POST['hidedeleteproduct'];
      // echo $id;
      $sql = "DELETE FROM PRODUCT WHERE PRODUCT_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['activatereview'])){
      $id = $_POST['hidactivatereview'];
      $sql = "UPDATE REVIEW SET STATUS = '1' WHERE REVIEW_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deactivatereview'])){
      $id = $_POST['hiddeactivatereview'];
      $sql = "UPDATE REVIEW SET STATUS = '0' WHERE REVIEW_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }
    if(isset($_POST['deletereview'])){
      $id = $_POST['hidedeletereview'];
      $sql = "DELETE FROM REVIEW  WHERE REVIEW_ID = '$id'";
      $arr = oci_parse($conn,$sql);
      oci_execute($arr);
    }


  ?>
  <h2>Welcome Admin in CleckHFmart Admin Panel!!</h2>
  <div class='unity'>
  <i class="fa-solid fa-hand-fist"></i>
  </div>
  <div class="welcomeadmin">
      An admin dashboard is a centralized web-based interface that provides administrators with a comprehensive overview and control of an application, system, or website. It serves as a control panel where administrators can access and manage various functionalities and data to effectively monitor and maintain the platform.
  </div>
  <div class="supportedadmin">
    <h1>Our Admins</h1>
    <p>Subodh Acharya<span><i class="fa-brands fa-square-twitter"></i></span><span><i class="fa-brands fa-square-facebook"></i></span><span><i class="fa-brands fa-linkedin"></i></span></p>
    <p>Nitesh Kumar Chaudhary<span><i class="fa-brands fa-square-twitter"></i></span><span><i class="fa-brands fa-square-facebook"></i></span><span><i class="fa-brands fa-linkedin"></i></span></p>
    <p>Ravi Prakash Yadav<span><i class="fa-brands fa-square-twitter"></i></span><span><i class="fa-brands fa-square-facebook"></i></span><span><i class="fa-brands fa-linkedin"></i></span></p>
    <p>Nisha Sunuwar<span><i class="fa-brands fa-square-twitter"></i></span><span><i class="fa-brands fa-square-facebook"></i></span><span><i class="fa-brands fa-linkedin"></i></span></p>
    <p>Rabindra Prasad Singh<span><i class="fa-brands fa-square-twitter"></i></span><span><i class="fa-brands fa-square-facebook"></i></span><span><i class="fa-brands fa-linkedin"></i></span></p>

  </div>
</div>
<div id="twolink">sales items</div>


</section>

    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id='trader'>
        <!-- section manage shops -->
      <section class="traders-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink1" href="#onelink1">Approve Trader</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink1" href="#twolink1">Deactivate/Activate Trader</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink1" href="#threelink1"> Delete Trader</a>
        </li>
        
      </ul>
    </div>
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink1">
<h3 style="color: var(--secondary-color); margin-top: 2em;">Approve Trader</h3>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '2'";
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $traderid = $rows[9];
      ?>
      <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $traderid; ?>" name="hidapprovetrader">
                <button type="submit" name="approvetrader" class="approvetrader">Activate</button>
            </form>
            </div>
      

      <?php
    }

    ?>
</div>
<!-- finished first page add product -->
<div id="twolink1" class="disableshopMain">
<h3 style="color: var(--secondary-color); margin-top: 2em;">Activate Trader</h3>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '0'";
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count = 0;
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $traderid = $rows[9];
      $count++;
      ?>
      <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $traderid; ?>" name="hidactivtrader">
                <button type="submit" name="activatetrader" class="activatetrader">Activate</button>
            </form>
            </div>
            
      

      <?php
    }
    if($count == 0){
      echo "<p>No traders to activate</p>";
    }

    ?>
    <h3 style="color: var(--secondary-color); margin-top: 2em;">Deactivate Trader</h3>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1'";
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count1 = 0;
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $traderid = $rows[9];
      $count1++;
      ?>
      <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action=""> <input type="hidden" value="<?php echo $traderid; ?>" name="hiddeactivtrader">
                <button type="submit" name="deactivatetrader" class="deactivatetrader">Deactivate</button></form>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No traders to deactivate</p>";
    }
    ?>
</div>
<div id="threelink1">
  
<h3 style="color: var(--secondary-color); margin-top: 2em;">Delete Trader</h3>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1' OR STATUS = '2' OR STATUS = '3'";
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count1 = 0;
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $traderid = $rows[9];
      $count1++;
      ?>
      <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $traderid; ?>" name="hiddeletetrader">
                <button type="submit" name="deletetrader" class="deletetrader">Delete</button>
            </form>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No traders to delete</p>";
    }
    ?>
</div>


      </section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="customer">
        <!-- section manage products -->
      <section class="customers-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink2" href="#onelink2">Deactivate/activate Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink2" href="#twolink2">Delete Customer</a>
        </li>
        
      </ul>
    </div>
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
<!-- pages -->


<div id="onelink2" class="addproduct">
<h3 style="color: var(--secondary-color); margin-top: 2em; margin-bottom: 2em;">Activate Customer</h3>

    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='customer' AND REGISTERED_EMAIL = 'yes' AND STATUS = '0'";
    
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count = 0;
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $custId = $rows[9];
      $count++;
      ?>
     <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $custId; ?>" name="hidactivatecust">
                <button type="submit" name="activatecust" class="activatecust">Activate</button>
            </form>
            </div>  
      

      <?php
    }
    if($count == 0){
      echo "<p>No customers to activate</p>";
    }

    ?>

    <?php  
    
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='customer' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1'";
    
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count1 = 0;
    echo "<h3 style='color: var(--secondary-color); margin-top: 2em; margin-bottom: 2em;'>Deactivate Customer</h3>";
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $custId = $rows[9];

      $count1++;
      ?>
       <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $custId; ?>" name="hiddeactivatecust">
                <button type="submit" name="deactivatecust" class="deactivatecust">Deactivate</button>
            </form>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No customers to deactivate</p>";
    }
    ?>

</div>
<!-- add product page finished -->



<div id="twolink2" class="disableproduct">
<?php  
    
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE, USER_ID FROM MART_USER WHERE ROLE='customer' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1' OR STATUS = '0'";
    
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count1 = 0;
    echo "<h3 style='color: var(--secondary-color); margin-top: 2em; margin-bottom: 2em;'>Delete Customer</h3>";
    echo "<div class='title-items'>
    <p>Profile image</p>
      <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Address</p><p>Gender</p><p>Date created</p><p></p>
    </div>";
    while($rows = oci_fetch_array($arr)){
      $address = $rows[5];
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $traderimage = $rows[8];
      $gender = $rows[6];
      $datecreated = $rows[7];
      $lastname = $rows[2];
      $custId = $rows[9];
      $count1++;
      ?>
            <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$address"; ?></p>
              <p><?php echo "$gender"; ?></p>
              <p><?php echo "$datecreated"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $custId; ?>" name="hidedeletecust">
                <button type="submit" name="deletecust" class="deletecust">Delete</button>
            </form>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No customers to delete</p>";
    }
    ?>

</div>

</section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="product">
        <!-- section manage offers -->
      <section class="products-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink3" href="#">Activate/Deactivate Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink3" href="#">Delete Product</a>
        </li>
      </ul>
    </div>
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink3">
<div class="disableproduct">
     <h1>Deactivate Products</h1>
    <?php  
    include("../connectionPHP/connect.php");
    // $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND PRODUCT.STATUS = 1";
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader' AND PRODUCT.STATUS = 1";
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
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php echo $productRegistered; ?></p>

                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <form method="POST" action="">
                        <input type="hidden" value="<?php echo $productId; ?>" name="hidedeactivateproduct">
                        <button type="submit" name="deactivatepro" class="deactivatepro">Deactivate</button>
                    </form>
                </div>
            </div>
      

      <?php
    }

    ?>
    </div>
    <div class="disableproduct">
     <h1>Activate Product</h1>
    <?php  
    include("../connectionPHP/connect.php");
    // $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND PRODUCT.STATUS = 0";
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader' AND PRODUCT.STATUS = 0";

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
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php echo $productRegistered; ?></p>

                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <form method="POST" action="">
                        <input type="hidden" value="<?php echo $productId; ?>" name="hideactivateproduct">
                        <button type="submit" name="activatepro" class="activatepro">Activate</button>
                    </form>
                </div>
            </div>
      

      <?php
    }

    ?>
    </div>
</div>
<div id="twolink3">
<div class="disableproduct">
     <h1>Delete Product</h1>
    <?php  
    include("../connectionPHP/connect.php");
    // $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader'";
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, PRODUCT.PRODUCT_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID  AND MART_USER.ROLE = 'trader'";

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
                <div class="desc--discount--status">
                  <p><?php echo substr($productDesc,0,50); ?></p>
                  <p>offer: <?php echo $productDiscount;   ?></p>
                  <p>Registered: <?php echo $productRegistered; ?></p>

                </div>
                <div class="qty--price">
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <form method="POST" action="">
                        <input type="hidden" value="<?php echo $productId; ?>" name="hidedeleteproduct">
                        <button type="submit" name="deletepro" class="deletepro">Delete</button>
                    </form>
                </div>
            </div>
      

      <?php
    }

    ?>
    </div>

</div>

      </section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="review">
        <!-- section manage profile -->
      <section class="review-manage">
      <nav class="navbar navbar-expand-md navbar-light bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-link="onelink4" href="#onelink4">Disable/enable review</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink4" href="#onelink4">Delete reviews</a>
        </li>
      </ul>
    </div>
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink4">
    <!-- <h1>Disable/enable review</h1> -->
    <h3 style="color: var(--secondary-color); margin-top: 2em; margin-bottom: 2em;">Activate Reviews</h3>

    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, IMAGE, REVIEW_ID, REVIEW_DESCRIPTION, REVIEW_DATE FROM REVIEW, MART_USER WHERE REVIEW.FK_USER_ID = MART_USER.USER_ID AND ROLE='customer' AND MART_USER.REGISTERED_EMAIL = 'yes' AND MART_USER.STATUS = '1' AND REVIEW.STATUS = '0'";
    
    echo "<div class='title-items'>
<p>Profile image</p>
  <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Review</p><p>Review Date</p><p></p>
</div>";
    // $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    $count = 0;
    while($rows = oci_fetch_array($arr)){
      $username = $rows[0];
      $email = $rows[3];
      $mobile = $rows[4];
      $firstname = $rows[1];  
      $custImage = $rows[4];
      $gender = $rows[6];
      $lastname = $rows[2];
      $reviewId = $rows[5];
      $reviewDesc = $rows[6];
      $reviewDate = $rows[7];
      $count++;
      ?>
     <div class="items-horizontal">
              <img src="<?php echo "../images/".$traderimage; ?>" alt="">
              <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$reviewDesc"; ?></p>
              <p><?php echo "$reviewDate"; ?></p>
              <form method="POST" action="">
                <input type="hidden" value="<?php echo $reviewId; ?>" name="hidactivatereview">
                <button type="submit" name="activatereview" class="activatereview">Activate</button>
            </form>
            </div>  
      

      <?php
    }
    if($count == 0){
      echo "<p>No reviews to activate</p>";
    }

    ?>
        <h3 style="color: var(--secondary-color); margin-top: 2em; margin-bottom: 2em;">Deactivate Reviews</h3>

<?php  
include("../connectionPHP/connect.php");
$sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, IMAGE, REVIEW_ID, REVIEW_DESCRIPTION, REVIEW_DATE FROM REVIEW, MART_USER WHERE REVIEW.FK_USER_ID = MART_USER.USER_ID AND ROLE='customer' AND MART_USER.REGISTERED_EMAIL = 'yes' AND MART_USER.STATUS = '1' AND REVIEW.STATUS = '1'";

echo "<div class='title-items'>
<p>Profile image</p>
  <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Review</p><p>Review Date</p><p></p>
</div>";
// $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
$arr = oci_parse($conn, $sql);
oci_execute($arr);
$count = 0;
while($rows = oci_fetch_array($arr)){
  $username = $rows[0];
  $email = $rows[3];
  $firstname = $rows[1];  
  $custImage = $rows[4];
  $gender = $rows[6];
  $lastname = $rows[2];
  $reviewId = $rows[5];
  $reviewDesc = $rows[6];
  $reviewDate = $rows[7];
  $count++;
  ?>
 <div class="items-horizontal">
          <img src="<?php echo "../images/".$traderimage; ?>" alt="">
          <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$reviewDesc"; ?></p>
              <p><?php echo "$reviewDate"; ?></p>
          <form method="POST" action="">
            <input type="hidden" value="<?php echo $reviewId; ?>" name="hiddeactivatereview">
            <button type="submit" name="deactivatereview" class="deactivatereview">Deactivate</button>
        </form>
        </div>  
  

  <?php
}
if($count == 0){
  echo "<p>No reviews to deactivate</p>";
}

?>
</div>
<div id='twolink4'>
<h3 style="color: var(--secondary-color); margin-top: 2em; margin-bottom: 2em;">Delete Reviews</h3>

<?php  
include("../connectionPHP/connect.php");
$sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, IMAGE, REVIEW_ID, REVIEW_DESCRIPTION, REVIEW_DATE FROM REVIEW, MART_USER WHERE REVIEW.FK_USER_ID = MART_USER.USER_ID AND ROLE='customer' AND MART_USER.REGISTERED_EMAIL = 'yes' AND MART_USER.STATUS = '1'";

echo "<div class='title-items'>
<p>Profile image</p>
  <p>Username</p><p>Full Name</p><p>Email</p><p>Mobile</p><p>Review</p><p>Review Date</p><p></p>
</div>";
// $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
$arr = oci_parse($conn, $sql);
oci_execute($arr);
$count = 0;
while($rows = oci_fetch_array($arr)){
  $username = $rows[0];
  $email = $rows[3];
  $firstname = $rows[1];  
  $custImage = $rows[4];
  $gender = $rows[6];
  $lastname = $rows[2];
  $reviewId = $rows[5];
  $reviewDesc = $rows[6];
  $reviewDate = $rows[7];
  $count++;
  ?>
 <div class="items-horizontal">
          <img src="<?php echo "../images/".$traderimage; ?>" alt="">
          <p><?php echo "$username"; ?></p>
              <p><?php echo "$firstname"." "."$lastname"; ?></p>
              <p><?php echo "$email"; ?></p>
              <p><?php echo "$mobile"; ?></p>
              <p><?php echo "$reviewDesc"; ?></p>
              <p><?php echo "$reviewDate"; ?></p>
          <form method="POST" action="">
            <input type="hidden" value="<?php echo $reviewId; ?>" name="hidedeletereview">
            <button type="submit" name="deletereview" class="deleteereview">Delete</button>
        </form>
        </div>  
  

  <?php
}
if($count == 0){
  echo "<p>No review to delete</p>";
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
          <a class="nav-link" data-link="onelink5" href="#onelink5">Update profile</a>
        </li>
      </ul>
    </div>
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink5">
<div class="logoutsection">
  
    <form action="" method="POST">
      <button type="submit" name="logoutadmin">Logout</button>
    </form>
  </div>
  <div class="adminimage">
    <h3 style="color: white;">Our team</h3>
    <?php
      include("../connectionPHP/connect.php");
      $sql = "SELECT IMAGE FROM MART_USER WHERE USER_ID = 7";
      $arr = oci_parse($conn, $sql);
      oci_execute($arr);
      $imagepath = oci_fetch_array($arr)[0];
    ?>
    <img src="../images/<?php echo $imagepath;?>" alt="admin">
    <form class="uploadpicture" method="POST" action="" enctype="multipart/form-data" >
      <input type="file" class='adminpic' name="adminpic1">
      <button class="uploadpic" name="uploadpic">Upload picture</button>
      <button type="button" class="cancelupload">Cancel</button>
    </form>
    <div class="changeadminpicture">
      <button>Change picture</button>
    </div>
    
  </div>

  
<div class="profile-section">
  <?php 
            // $username = $_SESSION['username'];
            // echo $_SESSION['username'];

            include("../connectionPHP/connect.php");
            $sql = "SELECT * FROM MART_USER WHERE ROLE= 'admin'";
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
                <h3>Admin profile</h3>
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
<script src="app.js"></script>
</body>
</html>