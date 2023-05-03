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


<div id="onelink" class="reports">Reports items</div>
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


<div id="onelink1" class="addshop">
    add shops
</div>
<!-- finished first page add product -->
<div id="twolink1" class="disableshop">
    <div class="enableshop">
        enable
    </div>
    <div class="disableshop">
        disable
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
      <?php
      // echo "hello";
      if(isset($_POST['addproduct'])){
        // echo "eeee";
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
          if($count >= 20 && $count <= 50){
            $pdescerror = false;
          }
          else{
            $pdescerror = true;
          }
          if($pquanterror == false && $pdescerror == false && $ppriceError == false){
              $sql = "INSERT INTO PRODUCT(PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_QUANTITY, PRODUCT_DESCRIPTION, ) VALUES()";
          }
          else{
      header("location: /index.php#onelink2");

            // echo "<p class='redirectToAddProduct'>Redirect to same page!!</p>";
          }
        }
      }


      ?>
        <div class="productname">
            <label for="pname">Product Name</label>
            <input type="text" name="pname" id="pname">
        </div>
        <div class="productprice">
            <label for="pprice">Product Price</label>
            <input type="text" name="pprice" id="pprice">
        </div>
        <div class="collection1">
        <div class="productquantity">
            <label for="pquant">Product Quantity</label>
            <input type="text" name="pquant" id="pquant">
        </div>
        <div class="proDescription">
            <label for="prodesc">Product Description</label>
            <textarea name="prodesc" id="prodesc" cols="30" rows="10">
                Add description
            </textarea>
        </div>
        </div>
        <div class="collection2">
        <div class="productallergy">
            <label for="pallergy">Product Allergy</label>
            <input type="text" name="pallergy" id="pallergy">
        </div>
        <div class="shop">
            <label for="shopname">
                Shop
            </label>
            <select name="shopname[]" id="shopname">
                <option value="">Butchers</option>
            </select>
        </div>
        </div>
        <div class="collection3">
            <div class="image1">
                <label for="image1">
                First image
            </label>
            <input type="file" name="image1" id="image1">
            </div>
            <div class="image2">
                <label for="image2">
                Second image
            </label>
            <input type="file" name="image2" id="image2">
            </div>
            <div class="image3">
                <label for="image3">
                Third image
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
   <div class="enableproduct">
    Enable
   </div>
   <div class="disableproduct">
    Disable
   </div>

</div>
<div id="threelink2">Edit products</div>
<div id="fourlink2">Delete products</div>


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