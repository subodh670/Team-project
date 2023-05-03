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
          <a class="nav-link" data-link="onelink" href="#">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink" href="#">Dashboard Item 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink" href="#">Dashboard Item 2</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="fourlink" href="#">Dashboard Item 3</a>
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
          <a class="nav-link" data-link="onelink" href="#">Add Shops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink" href="#">Disable shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink" href="#"> Delete shop</a>
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


<div id="onelink" class="addshop">
    add shops
</div>
<!-- finished first page add product -->
<div id="twolink" class="disableshop">
    <div class="enableshop">
        enable
    </div>
    <div class="disableshop">
        disable
    </div>

</div>
<div id="threelink">delete shop</div>


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
          <a class="nav-link" data-link="onelink" href="#">Add Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink" href="#">Disable Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink" href="#"> Edit Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="fourlink" href="#"> Delete Products</a>
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


<div id="onelink" class="addproduct">
<h1>Add Product</h1>
    <form action="#" method="POST">
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
            <label for="pprice">Product Quantity</label>
            <input type="text" name="pprice" id="pprice">
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
            <label for="pallergy">Product Price</label>
            <input type="text" name="pallergy" id="pallergy">
        </div>
        <div class="shop">
            <label for="shopname">
                Shop
            </label>
            <select name="shopname" id="shopname">
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
            <button type="submit">Add product</button>
        </div>
        
        
    </form>

</div>
<!-- add product page finished -->



<div id="twolink" class="disableproduct">
   <div class="enableproduct">
    Enable
   </div>
   <div class="disableproduct">
    Disable
   </div>

</div>
<div id="threelink">Edit products</div>
<div id="fourlink">Delete products</div>


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
          <a class="nav-link" data-link="onelink" href="#">Add Offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="twolink" href="#">Update offers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-link="threelink" href="#"> Delete Offers</a>
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
<div id="twolink">sales items</div>
<div id="threelink">sales items</div>



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