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
  <div class="backdrop hidebackdrop">
    
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
    <a class="navbar-brand" href="#">Trader profile</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
  </div>
</nav>
<!-- pages -->


<div id="onelink" class="reports">
<?php
      if(isset($_POST['addproduct'])){
        if(!empty($_POST['pname']) && !empty($_POST['pprice']) && !empty($_POST['pquant']) && !empty($_POST['prodesc']) && !empty($_POST['pallergy']) && !empty($_POST['shopname'])){
          $pname = $_POST['pname'];
          $pprice = $_POST['pprice'];
          $pquant = $_POST["pquant"];
          $pdesc = $_POST['prodesc'];
          $pallergy = $_POST['pallergy'];
          $pshop = $_POST['shopname'];
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
          if($count >= 20 && $count <= 50){
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
          if($pquanterror == false && $pdescerror == false && $ppriceError == false && $image1 != null && $image2 != null && $image3 != null){
              $sql = "INSERT INTO PRODUCT(PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, ) VALUES()";
              echo "hello";
          }
          else{
            if($pquanterror == true){
              echo "<p>Quantity must be in number</p>";
            }
            if($ppriceError == true){
              echo "<p>Price must be in number</p>";
            }
            if($pdescerror == true){
              echo "<p>Description should be between 20 and 50 words!!</p>";
            }
          }
        }
        else{
          echo "<p>Cannot have empty fields</p>";
        }
      }

      ?>

</div>
<div id="twolink">sales items</div>
<div id="threelink">sales items</div>
<div id="fourlink">sales items</div>


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
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink1">
    <div class="addshop">
      <h3>Add Shop</h3>
      <p>According to cleckhfmart rules and regulations only two shops can be allowed per trader.</p>
      <form class="shopnew" method="POST" action="">
        <div class="shop-name">
          <label for="shop--name">Shop Name</label>
          <input type="text" name="shop--name" id="shop--name" placeholder="eg: dairy"> 
        </div>
        <div class="shop-category">
          <label for="shop--category">Shop Category</label>
          <input type="text" name="shop--category" id="shop--category" placeholder="eg: curd">
        </div>
        <div class="addshopbtn">
          <button name="addshop">Add Shop</button>
        </div>
      </form>
    </div>
</div>
<!-- finished first page add product -->
<div id="twolink1" class="disableshop">
    <div class="disableshop">
        <h3>
          Disable Shop
        </h3>
        <div class="shopDetail">
          <p>Shop1</p>
          <p>Category</p>
          <button>Disable</button>
        </div>

    </div>
    <hr>
    <div class="enableshop">
        <h3>Enable Shop</h3>
        <div class="shopDetail">
          <p>Shop1</p>
          <p>Category</p>
          <button>Disable</button>
        </div>
    </div>

</div>
<div id="threelink1">delete shop</div>


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
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
<!-- pages -->


<div id="onelink2" class="addproduct">
<h1>Add Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
      
        <div class="productname">
            <label for="pname">Product Name(*)</label>
            <input type="text" name="pname" id="pname" placeholder= "eg: salmon fish">
        </div>
        <div class="productprice">
            <label for="pprice">Product Price</label>
            <input type="text" name="pprice" id="pprice" placeholder= "eg: £8">
        </div>
        <div class="collection1">
        <div class="productquantity">
            <label for="pquant">Product Quantity(*)</label>
            <input type="text" name="pquant" id="pquant" placeholder="eg: 6">
        </div>
        <div class="proDescription">
            <label for="prodesc">Product Description(*)</label>
            <textarea name="prodesc" id="prodesc" cols="30" rows="10"></textarea>
        </div>
        </div>
        <div class="collection2">
        <div class="productallergy">
            <label for="pallergy">Product Allergy(*)</label>
            <input type="text" name="pallergy" id="pallergy" placeholder="eg: lactose allergy">
        </div>
        <div class="shop">
            <label for="shopname">
                Shop(*)
            </label>
            <select name="shopname[]" id="shopname">
                <option value="">Butchers</option>
            </select>
        </div>
        </div>
        <div class="collection3">
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
    $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productDiscount = $rows[5];
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
                    <p>Qty :<?php echo ""; ?></p>
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <button>Disable</button>
                </div>
            </div>
      

      <?php
    }

    ?>
    </div>
   <div class="enableproduct">
   <h1>Enable Product</h1>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productDiscount = $rows[5];
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
                    <p>Qty :<?php echo ""; ?></p>
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <button>Enable</button>
                </div>
            </div>
      

      <?php
    }

    ?>
   </div>

</div>
<div id="threelink2">
<div class="editproduct">
  <div class="editingpanelpro hidemodal">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
      <h3>Edit Product</h3>
      <div class="cross">
        <i class="fa-solid fa-xmark"></i>
      </div>
        <div class="collect0">
        <div class="productname">
            <label for="pname">Product Name(*)</label>
            <input type="text" name="pname" id="pname" placeholder= "eg: salmon fish">
        </div>
        <div class="productprice">
            <label for="pprice">Product Price(*)(in £) </label>
            <input type="text" name="pprice" id="pprice" placeholder= "eg: 8">
        </div>
        </div>
        <div class="collect2">
        <div class="productquantity">
            <label for="pquant">Product Quantity(*)</label>
            <input type="text" name="pquant" id="pquant" placeholder="eg: 6">
        </div>
        <div class="proDescription">
            <label for="prodesc">Product Description(*)</label>
            <textarea name="prodesc" id="prodesc" cols="20" rows="5"></textarea>
        </div>
        </div>
        <div class="collect3">
        <div class="productallergy">
            <label for="pallergy">Product Allergy(*)</label>
            <input type="text" name="pallergy" id="pallergy" placeholder="eg: lactose allergy">
        </div>
        <div class="shop">
                Shop(*)
            </label>
            <select name="shopname[]" id="shopname">
                <option value="">Butchers</option>
            </select>
        </div>
        </div>
        
        <div class="btnaddpro">
            <button type="submit" name="editproduct" class="editproduct">Add product</button>
        </div>
        
        
    </form>
  </div>
   <h3 style="color: var(--secondary-color); margin-top: 2em;">Edit Product</h3>
    <?php  
    include("../connectionPHP/connect.php");
    $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productDiscount = $rows[5];
      $productAllergy = $rows[6];
      $productImage = $rows[7];
      $productStatus = $rows[8];
      $productRegistered = $rows[9];
      $productId = $rows[10];
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
                  <p>Registered: <?php echo $productRegistered; ?></p>

                </div>
                <div class="qty--price">
                    <p>Qty :<?php echo ""; ?></p>
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
    $sql = "SELECT PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, PRODUCT_CATEGORY, PRODUCT_DISCOUNT, PRODUCT_ALLERGY_INFORMATION, PRODUCT_IMAGE2, PRODUCT_STATUS, PRODUCT_REGISTERED, PRODUCT_ID FROM PRODUCT WHERE TRADER_ID = 3003";
    $arr = oci_parse($conn, $sql);
    oci_execute($arr);
    while($rows = oci_fetch_array($arr)){
      $productName = $rows[0];
      $productPrice = $rows[1];
      $productQuant = $rows[2];
      $productDesc = $rows[3];
      $productCategory = $rows[4];  
      $productDiscount = $rows[5];
      $productAllergy = $rows[6];
      $productImage = $rows[7];
      $productStatus = $rows[8];
      $productRegistered = $rows[9];
      $productId = $rows[10];
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
                  <p>Registered: <?php echo $productRegistered; ?></p>

                </div>
                <div class="qty--price">
                    <p>Qty :<?php echo ""; ?></p>
                    <p>Price: £<?php echo $productPrice; ?></p>
                    <button class="edittriggerpro">Delete product</button>
                </div>
            </div>
      

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
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- pages -->


<div id="onelink3">Reports items</div>
<div id="twolink3">sales items</div>
<div id="threelink3">sales items</div>



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
          <a class="nav-link" href="#">Update profile</a>
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


<div id="onelink">Reports items</div>

      </section>
    </div>
  </div>
  
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>