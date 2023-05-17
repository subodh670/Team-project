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
          <a class="nav-link" data-link="onelink" href="#onelink">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink" href="#twolink">Dashboard Item 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink" href="#threelink">Dashboard Item 2</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="fourlink" href="#fourlink">Dashboard Item 3</a>
        </li>
      </ul>
      
    </div>
    <a class="navbar-brand" href="#">Admin profile</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
  </div>    
</nav>
<!-- pages -->


<div id="onelink" class="reports">
  
</div>
<div id="twolink">sales items</div>
<div id="threelink">sales items</div>
<div id="fourlink">sales items</div>


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
      <div class="productenabled">
                <div class="img--info">
                    <img src="../images/<?php echo $traderimage; ?>" alt="">
                    <div class="info">
                        <p><?php echo "Username: ".$username; ?></p>
                        <p><?php echo "Full Name: ".$firstname." ".$lastname; ?></p>
                        <p><?php echo "Email: ".$email; ?></p>
                    </div>
                </div>
                <div class="desc--discount--status">
                  <p>Mobile: <?php echo $mobile; ?></p>
                  <p>Address: <?php echo $address;   ?></p>
                  <p>Gender: <?php echo $gender; ?></p>

                </div>
                <div class="qty--price">
                    <p>Date created:<?php echo "$datecreated"; ?></p>
                    <button class="edittriggerpro">Approve Trader</button>
                    <button class="edittriggerpro">Disapprove Trader</button>

                </div>
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
      <div class="productenabled">
                <div class="img--info">
                    <img src="../images/<?php echo $traderimage; ?>" alt="">
                    <div class="info">
                        <p><?php echo "Username: ".$username; ?></p>
                        <p><?php echo "Full Name: ".$firstname." ".$lastname; ?></p>
                        <p><?php echo "Email: ".$email; ?></p>
                    </div>
                </div>
                <div class="desc--discount--status">
                  <p>Mobile: <?php echo $mobile; ?></p>
                  <p>Address: <?php echo $address;   ?></p>
                  <p>Gender: <?php echo $gender; ?></p>

                </div>
                <div class="qty--price">
                    <p>Date created:<?php echo "$datecreated"; ?></p>
                    <button class="edittriggerpro">Activate Trader</button>
                </div>
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
      <div class="productenabled">
                <div class="img--info">
                    <img src="../images/<?php echo $traderimage; ?>" alt="">
                    <div class="info">
                        <p><?php echo "Username: ".$username; ?></p>
                        <p><?php echo "Full Name: ".$firstname." ".$lastname; ?></p>
                        <p><?php echo "Email: ".$email; ?></p>
                    </div>
                </div>
                <div class="desc--discount--status">
                  <p>Mobile: <?php echo $mobile; ?></p>
                  <p>Address: <?php echo $address;   ?></p>
                  <p>Gender: <?php echo $gender; ?></p>

                </div>
                <div class="qty--price">
                    <p>Date created:<?php echo "$datecreated"; ?></p>
                    <button class="edittriggerpro">Deactivate Trader</button>
                </div>
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
      <div class="productenabled">
                <div class="img--info">
                    <img src="../images/<?php echo $traderimage; ?>" alt="">
                    <div class="info">
                        <p><?php echo "Username: ".$username; ?></p>
                        <p><?php echo "Full Name: ".$firstname." ".$lastname; ?></p>
                        <p><?php echo "Email: ".$email; ?></p>
                    </div>
                </div>
                <div class="desc--discount--status">
                  <p>Mobile: <?php echo $mobile; ?></p>
                  <p>Address: <?php echo $address;   ?></p>
                  <p>Gender: <?php echo $gender; ?></p>

                </div>
                <div class="qty--price">
                    <p>Date created:<?php echo "$datecreated"; ?></p>
                    <button class="edittriggerpro">Deactivate Trader</button>
                </div>
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
<h1>Deactivate/activate Customer</h1>

</div>
<!-- add product page finished -->



<div id="twolink2" class="disableproduct">


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

</div>
<div id="twolink3">


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