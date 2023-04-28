<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Item Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">

  </head>
  <body>
    <?php
    session_start();
    if(!isset($_SESSION['username'])){
      ?>
      <form class='modal-login' action="" method="POST">
        <?php
          if(isset($_POST['login-redirect'])){
            header("location: ../sign_in_page/index.php");
          }
          // else if(isset($_POST['register-redirect'])){
          //   header("location: ../sign_up_page/index.php");
          // }
        ?>
        <div>
          <p class="close-signin">&times;</p>
          <img src="../landing_page/image1.png" alt="">
          <div>
            <p>Please</p>
            <button style="text-decoration: underline;" name="login-redirect">Login</button>
            <p>to add products to cart.</p>
          </div>
        </div>
      </form>
    <div class="backdrop" style="display: block"></div>
    <?php
    }
    ?>
    <header>
      <div class="logo">
        <a href="../landing_page/index.php">
          <img src="../landing_page/image1.png" alt="logo" />
        </a>
      </div>
      <ul>
        <li><a href="../landing_page/index.php">Home</a></li>
        <li><a href="../traders_login_page/index.php">Sale a product</a></li>
        <li><a href="#customer_services">Customer Services</a></li>
        <li><a href="#contact_us">Contact Us</a></li>
      </ul>
      <div class="login_cart_search">
      <?php
        // session_start();
        
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
            ?>
            <div class="login custprofile">
                <a href="../user_profile_page/index.php">
                    <img src="<?php echo '../images/'.$_SESSION['image']; ?>" alt="customer">
                </a> 
            </div>
            <?php
        }
        else{
            ?>
            <div class="login">
                <a href="../sign_in_page/index.php">Sign In</a>
             </div>
            <?php
        }


            ?>
             
        <div class="cart">
        <?php
                    include("../connectionPHP/connect.php");
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                        $sql = "SELECT P_QUANTITY FROM CART,CUSTOMER WHERE CART.C_ID= CUSTOMER.C_ID AND C_USERNAME = '$username'";
                        $array = oci_parse($conn, $sql);
                        oci_execute($array);
                        $totalnum = 0;
                        while($numbers = oci_fetch_array($array)){
                            $totalnum += $numbers[0];
                        }
                    
                    }
                    ?>
                    <a href="../cart_page/index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a><span><?php if(isset($totalnum)) echo $totalnum; else echo "0"; ?></span>
                    <?php
                    
                    
                    

                ?>
            
        </div>
        <div class="search">
          <i class="fa fa-search"></i>
        </div>
        <form method="POST" action="" class="search-bar show-searchbar">
          <input type="text" name="search" class="search-item" />
          <i class="fa fa-times" aria-hidden="true"></i>
          <button class="search-result"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </header>

    
      <?php
      $id = $_GET['id'];
      include("../connectionPHP/connect.php");
      $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $id";
      $array = oci_parse($conn, $sql);
      oci_execute($array);
      while($row = oci_fetch_array($array)){
          $pId = $row[0];
          $pName = $row[1];
          $pPrice = $row[2];
          $pQuantity = $row[3];
          $pDesc = $row[4];
          $pCategory = $row[5];
          $pDiscount = $row[6];
          $pAllergy = $row[7];
          $pImage1 = $row[8];
          $pImage2 = $row[9];
          $pImage3 = $row[10];
          $pShop = $row[11];
          $pTrader = $row[12];
          ?>
          <section class="breadcrumb">
            <div> <a href="../landing_page/index.php">Home</a> </div>
            <i class="fa-solid fa-angle-right"></i>
            <div> <a href=" <?php echo "../category_page/index.php?cat=$pCategory"; ?>" ><?php echo $pCategory; ?></a> </div>
            <i class="fa-solid fa-angle-right"></i>
            <div> <?php echo $pName; ?></div>
    </section>

    <section class="main-item">
<div class="item-photo">
            <div class="main-img">
                <img src="<?php echo "../productsImage/".$pImage2;  ?>" alt="">
            </div>
            <div class="sub-img">
                <img src="<?php echo "../productsImage/".$pImage1;  ?>" alt="">

                <img src="<?php echo "../productsImage/".$pImage2;  ?>" alt="">

                <img src="<?php echo "../productsImage/".$pImage3;  ?>" alt="">

            </div>
        </div>
        <input type="hidden" class="hiddenQ" value="<?php echo "$pQuantity"; ?>">

        <form class="item-cart" method="POST" action="">
          <?php
          $quant_Error = "";
          if(isset($_POST['addtocart']) && isset($_SESSION['username'])){
            // include("../connectionPHP/connect.php");
            $username = $_SESSION['username'];
            if(intval($_POST['quantity'])>0 && intval($_POST['quantity'])<=$pQuantity){
              $pid = $_GET['id'];
              // $cid = $_SESSION['cid'];
              $quantity = $_POST['quantity'];
              $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
              $arr = oci_parse($conn, $query);
              oci_execute($arr);
              $cid = oci_fetch_array($arr)[0];
              $sql = "INSERT INTO CART(PRODUCT_ID, C_ID, P_QUANTITY) VALUES('$pid','$cid','$quantity')";
              $array = oci_parse($conn, $sql);
              oci_execute($array);
              $remainingQuant = $pQuantity - intval($_POST['quantity']);
              echo $remainingQuant;
              $sql1 = "UPDATE PRODUCT SET PRODUCT_QUANTITY = $remainingQuant WHERE PRODUCT_ID = $pid";
              $array2 = oci_parse($conn, $sql1);
              oci_execute($array2);
              oci_close($conn);
              header("location: ../cart_page/index.php");
            }
            else if($pQuantity == 0){
              $quant_Error = "Item is not in stock";
            }
            else{
              $quant_Error = "Quantity should be between 1 and $pQuantity";
            }
            $quant_Error = $quant_Error;
          }
          ?>
          <?php

//for tomorrow

          ?>
            <h1><?php echo $pName.", ".$pQuantity." counts";  ?></h1>
            <div class="ratings-sec">
                <div class="ratings">
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-regular fa-star"></i></p>
                </div>
                <p style="margin-right: 2em;">77 ratings</p>
                <?php
                include("../connectionPHP/connect.php");
                $proid = $_GET['id'];
                if(isset($_SESSION['username'])){
                  $username = $_SESSION['username'];
                  $query = "SELECT C_ID FROM CUSTOMER WHERE C_USERNAME = '$username'";
                  $arr = oci_parse($conn, $query);
                  oci_execute($arr);
                  $custId = oci_fetch_array($arr)[0];
                  // echo $proid;
                  $sql = "SELECT PRODUCT_ID FROM WISHLIST WHERE PRODUCT_ID = $proid AND C_ID = $custId";
                  $arr = oci_parse($conn, $sql);
                  oci_execute($arr);
                  $react = oci_fetch_array($arr);
                  if(!isset($react[0])){
                    ?>
                  <i data-love="0" style="font-size: 1.5rem;" class="fa-regular fa-heart"></i>

                    <?php
                    }
                    else{
                      ?>
                    <i data-love="1" style="font-size: 1.5rem;" class="fa-solid fa-heart"></i>


                    <?php
                    }

                      }
                      else{
                        ?>
                    <i data-love="0" style="font-size: 1.5rem;" class="fa-regular fa-heart"></i>

                      <?php
                      }
                
                
                ?>
                
            </div>
            <div class="category">
                <p>Category</p>
                <p><?php echo $pCategory;  ?></p>
            </div>
            <hr>
            <div class="cost">
                 <p>Price <?php echo "  £".$pPrice;  ?></p>
                 <div>
                    <p><?php $prevPrice = number_format(((float)$pPrice + ((float)$pPrice*(float)$pDiscount)/100),2); echo "£".$prevPrice; ?></p>
                    <p>offer: <?php echo $pDiscount."%";  ?></p>
                 </div>
            </div>
            <h1>Quantity</h1>
            <div class="quantity">
              <button type="button" name="inc">-</button>
              <input type="text" name="quantity" placeholder="1" value="1" >
              <button type="button" name="inc">+</button>
              <p class="quantity_error" style="color: red; font-size: 0.8rem; font-weight: bold; margin-top: 1em;"><?php  if(isset($quant_Error)) echo $quant_Error;  ?></p>
            </div>
            <div class="place-order">
              <button name='buynow'>Buy Now</button>
              <button name="addtocart">Add to Cart</button>
            </div>
        </form>
        <div class="item-place">
            <h1>Location</h1>
            <div>
              <i class="fa-solid fa-location-dot"></i>
              <p>Hudderfields, UK</p>
            </div>
        </div>
          <?php
            
      }
  



?>
        
    </section>
    <section class="productspecification">
      <div class="product_specifyandrating">
        <div class="onlyspecify">
          <h1>Product specification</h1>
          <div class="specification">
            <p class="specify">Allergy</p>
            <p class="specify-info"><?php echo $pAllergy;  ?></p>
          </div>
          <div class="shop-type">
            <?php
                $sql = "SELECT * FROM SHOP WHERE SHOP_ID = $pShop";
                $res = oci_parse($conn, $sql);
                oci_execute($res);
                $name = oci_fetch_array($res)[2];
                ?>
                <p class="cat-type">Shop</p>
                <p class="cat-info"><?php echo $name;  ?></p>
                <?php
            ?>
           
          </div>
          <div class="trader">
          <?php
                $sql = "SELECT * FROM TRADER WHERE TRADER_ID = $pTrader";
                $res = oci_parse($conn, $sql);
                oci_execute($res);
                $name1 = oci_fetch_array($res)[8];
                ?>
                <p class="trader-type">Trader</p>
                <p class="trader-inro"><?php echo $name1;  ?></p>
                <?php
            ?>
          </div>
        </div>
        <div class="onlyrating">
            <h1>Rate this product</h1>
            <div class="rate_product">
              <p><i class="fa-solid fa-star"></i></p>
              <p><i class="fa-solid fa-star"></i></p>
              <p><i class="fa-solid fa-star"></i></p>
              <p><i class="fa-solid fa-star"></i></p>
              <p><i class="fa-regular fa-star"></i></p>
            </div>
        </div>
      </div>
      
    </section>
      
    <section class="ratingsreviews">
      <h1>Ratings and Reviews</h1>
      <div class="personandrating">
        <div class="person">
          <i class="fa-sharp fa-solid fa-circle-user"></i>
          <p class="username">Subodh21</p>
          <div class="rate_product">
            <p><i class="fa-solid fa-star"></i></p>
            <p><i class="fa-solid fa-star"></i></p>
            <p><i class="fa-solid fa-star"></i></p>
            <p><i class="fa-solid fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
          </div>
        </div>

      </div>  
      <div class="message">
        <p>I like this product so much!!</p>
      </div>
    </section>
    <div class="cust-review">
            <input type="hidden" value="<?php echo $_GET['id'];  ?>">
            <input type="hidden" value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo null; ?>">
      </div>
    <section class="addreview">
      <h1>Add review about this product</h1>
      
      <?php
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
          ?>
          <div class='cust-review'>
            <textarea name="product_review" cols="30" rows="10">Add review</textarea>
            <input type="hidden" value="<?php echo $_GET['id'];  ?>">
            <input type="hidden" value="<?php echo $_SESSION['username']; ?>">
            <button>ADD REVIEW</button>
          </div>

          <?php
        }
        else{
          ?>
          <p>Please <a href="../sign_in_page/index.php">login</a> or <a href="../sign_up_page/index.php">signup</a> if you have not registered yet to add review.</p>
          <?php
        }
      ?>
      
    </section>
      
    <section class="pro-description">
      <h1>
        Product Description
      </h1>
      <?php
      $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $id";
      $array = oci_parse($conn, $sql);
      oci_execute($array);
      while($row = oci_fetch_array($array)){
          $pDesc = $row[4];
          ?>
          <p><?php echo $pDesc; ?></p>
          <?php
      }
        ?>

    </section>
    <footer>
      <div class="container-footer">
          <div class="footer-item1">
              <h1>CleckHF mart</h1>
              <p>Categories</p>
              <p>Products</p>
              <p>Customers Service</p>
              <p>Contact Us</p>
          </div>
          <div class="footer-item2">
              <h1>Privacy Policy</h1>
              <p>Payment</p>
              <p>FAQs</p>
              <p>Map</p>
              <img src="" alt="">
          </div>
          <div class="footer-item3">
              <h1>Social</h1>
              <p>Facebook</p>
              <p>Instagram</p>
              <p>Twitter</p>
          </div>
          <div class="footer-item4">
              <h1>Contact us</h1>
              <p>Location: </p>
              <p>London Uk</p>
              <p>Email: </p>
              <p>cleckhfmart@gmail.com</p>
          </div>

      </div>
  </footer>
    <script src="app.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>
