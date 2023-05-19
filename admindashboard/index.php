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
  <div class="backdrop hidebackdrop">
    
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


<div id="onelink" class="reports">
  <h2>Welcome Admin in CleckHFmart Admin Panel!!</h2>
  <div class='unity'>
  <i class="fa-solid fa-hand-fist"></i>
  </div>
  <div class="welcomeadmin">
      An admin dashboard is a centralized web-based interface that provides administrators with a comprehensive overview and control of an application, system, or website. It serves as a control panel where administrators can access and manage various functionalities and data to effectively monitor and maintain the platform.
  </div>
</div>
<div id="twolink">sales items</div>


</section>

    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id='trader'>
        <!-- section manage shops -->
      <section class="shops-manage">
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
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '2'";
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
              <div><button>Approve</button></div>
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
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '0'";
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
              <div><button>Activate</button></div>
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
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1'";
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
              <div><button>Deactivate</button></div>
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
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='trader' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1' OR STATUS = '2' OR STATUS = '3'";
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
              <div><button>Delete</button></div>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No traders to deactivate</p>";
    }
    ?>
</div>


      </section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="customer">
        <!-- section manage products -->
      <section class="products-manage">
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
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='customer' AND REGISTERED_EMAIL = 'yes' AND STATUS = '0'";
    
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
              <div><button>Activate</button></div>
            </div>  
      

      <?php
    }
    if($count == 0){
      echo "<p>No traders to activate</p>";
    }

    ?>

    <?php  
    
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='customer' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1'";
    
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
              <div><button>Deactivate</button></div>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No traders to deactivate</p>";
    }
    ?>

</div>
<!-- add product page finished -->



<div id="twolink2" class="disableproduct">
<?php  
    
    include("../connectionPHP/connect.php");
    $sql = "SELECT USERNAME, FIRST_NAME, LAST_NAME, EMAIL, MOBILE_NO, ADDRESS, GENDER, DATE_CREATED, IMAGE FROM MART_USER WHERE ROLE='customer' AND REGISTERED_EMAIL = 'yes' AND STATUS = '1' OR STATUS = '0'";
    
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
              <div><button>Delete</button></div>
            </div>
      

      <?php
    }
    if($count1 == 0){
      echo "<p>No traders to deactivate</p>";
    }
    ?>

</div>

</section>
    </div>
    <div class="col-10 showdesc col-xs-6 col-sm-8 col-md-9 col-lg-10 col-xl-10" id="product">
        <!-- section manage offers -->
      <section class="offers-manage">
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
     <h1>Deactivate Product</h1>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND PRODUCT.STATUS = 1";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productDiscountID = $rows[5];
      $sql1 = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = '$productDiscountID'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1)[0];
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
                    <button>Deactivate</button>
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
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader' AND PRODUCT.STATUS = 0";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productDiscountID = $rows[5];
      $sql1 = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = '$productDiscountID'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1)[0];
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
                    <button>Activate</button>
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
    $sql = "SELECT PRODUCT.NAME, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.DESCRIPTION, CATEGORY.CATEGORY_NAME, OFFER_PRODUCT.OFFER_ID, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE2, PRODUCT.STATUS, PRODUCT.PRODUCT_REGISTERED FROM PRODUCT, CATEGORY, OFFER_PRODUCT, SHOP, MART_USER WHERE PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND MART_USER.USER_ID = SHOP.FK_USER_ID AND  PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND OFFER_PRODUCT.PRODUCT_ID = PRODUCT.PRODUCT_ID AND MART_USER.ROLE = 'trader'";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productDiscountID = $rows[5];
      $sql1 = "SELECT OFFER_PERCENTAGE FROM OFFER WHERE OFFER_ID = '$productDiscountID'";
      $arr1 = oci_parse($conn, $sql1);
      oci_execute($arr1);
      $productDiscount = oci_fetch_array($arr1)[0];
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
                    <button>Disable</button>
                </div>
            </div>
      

      <?php
    }

    ?>
    </div>

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
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink4">
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