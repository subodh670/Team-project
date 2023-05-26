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
        <li><a href="../contact_us/index.php">Contact Us</a></li>
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
                      $sql = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
                      $array = oci_parse($conn, $sql);
                      oci_execute($array);
                      $cid = oci_fetch_array($array)[0];
                      $sql = "SELECT PRODUCT_CART.CART_ID, PRODUCT_CART.TOTAL_ITEMS FROM PRODUCT_CART INNER JOIN CART ON PRODUCT_CART.CART_ID=CART.CART_ID AND FK_USER_ID = $cid";
                      $array = oci_parse($conn, $sql);
                      oci_execute($array);
                      $totalnum = 0;
                      while($numbers = oci_fetch_array($array)){
                          $totalnum += $numbers[1];
                      }
                      // echo $totalnum;
                    
                    }
                    else{
                      include("../connectionPHP/connect.php");
                        if(isset($_COOKIE['product'])){
                            $id_cookie = $_COOKIE['product'];
                            $quantity_cookie = $_COOKIE['quantity'];
                            $arrid = explode(" ", $id_cookie);
                            $quantarr = explode(" ", $quantity_cookie);
                            $totalnum = 0;
                            for($i = 0; $i<count($arrid); $i++){
                                $totalnum += intval($quantarr[$i]);
                            }
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
       function productIncart(){
        if($_SESSION['username']){
          include("../connectionPHP/connect.php");
          $username = $_SESSION['username'];
          $pid = $_GET['id'];
          // $cid = $_SESSION['cid'];
          // $quantity = $_POST['quantity'];
          $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
          $arr = oci_parse($conn, $query);
          oci_execute($arr);
          $cid = oci_fetch_array($arr)[0];
          // $query1 = "SELECT CART_ID FROM PRODUCT_CART WHERE PRODUCT_CART"
          $query1 = "SELECT PRODUCT_CART.TOTAL_ITEMS, PRODUCT_CART.CART_ID FROM PRODUCT_CART INNER JOIN CART ON PRODUCT_CART.CART_ID=CART.CART_ID AND FK_USER_ID = $cid AND PRODUCT_CART.PRODUCT_ID = '$pid'";
          // $query1 = "SELECT P_QUANTITY FROM CART WHERE PRODUCT_ID = '$pid' AND C_ID = '$cid'";
          $arr2 = oci_parse($conn, $query1);
          oci_execute($arr2);
          $finalArr = oci_fetch_array($arr2);
          if(isset($finalArr[0])){
            return $finalArr;
          }
          else{
            return [0];
          }
        }
       
      }
      $id = $_GET['id'];
      include("../connectionPHP/connect.php");
      $sql1 = "SELECT PRODUCT_ID, PRODUCT.NAME, PRODUCT.DESCRIPTION, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE1, PRODUCT.IMAGE2, PRODUCT.IMAGE3, CATEGORY.CATEGORY_NAME, SHOP.SHOP_ID, MART_USER.USER_ID FROM PRODUCT,CATEGORY, SHOP, MART_USER WHERE PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND PRODUCT.FK_SHOP_ID = SHOP.SHOP_ID AND SHOP.FK_USER_ID = MART_USER.USER_ID AND PRODUCT_ID = $id";
      $array1 = oci_parse($conn, $sql1);
      oci_execute($array1);
      while($row = oci_fetch_array($array1)){
          $pId = $row[0];
          $pName = $row[1];
          $pPrice = $row[3];
          $pQuantity = $row[4];
          $pDesc = $row[2];
          $pCategory = $row[9];
          $pDiscount = 8;
          $pAllergy = $row[5];
          $pImage1 = $row[6];
          $pImage2 = $row[7];
          $pImage3 = $row[8];
          $pShop = $row[10];
          $pTrader = $row[11];
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
            $quantity = productIncart()[0];

            // if(intval($_POST['quantity'])>0 && intval($_POST['quantity'])<=$pQuantity && $_POST['quantity'] <= ($pQuantity-$quantity)){
              if($_POST['quantity']>0){
                echo "1";
              $pid = $_GET['id'];
              $quantity = $_POST['quantity'];
              $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
              $arr = oci_parse($conn, $query);
              oci_execute($arr);
              $cid = oci_fetch_array($arr)[0];
              $query1 = "SELECT PRODUCT_CART.CART_ID, PRODUCT_CART.TOTAL_ITEMS FROM PRODUCT_CART INNER JOIN CART ON PRODUCT_CART.CART_ID=CART.CART_ID AND FK_USER_ID = $cid";
              $arr2 = oci_parse($conn, $query1);
              oci_execute($arr2);
              $finalArr = oci_fetch_array($arr2);
              $exist = $finalArr; 
              // $productExist[] = null;
              $totalQ = $quantity;
              if(isset($exist[0])){
                echo "2";
                $cart_id = $exist[0];
                $query2 = "SELECT CART_ID, TOTAL_ITEMS FROM PRODUCT_CART WHERE PRODUCT_ID = '$pid' AND CART_ID = '$cart_id'";
                $arr2 = oci_parse($conn, $query2);
                oci_execute($arr2);
                $productExist = oci_fetch_array($arr2);
                if(isset($productExist[0])){
                  echo "3";
                  // $quantity = $productExist[1];
                  $oldquantity = $exist[1];
                  $totalQ = $oldquantity + $quantity;
                  // $cartid = $exist[0];
                  echo "4";
                  $sql = "UPDATE PRODUCT_CART SET  TOTAL_ITEMS = '$totalQ' WHERE CART_ID = '$cart_id' AND PRODUCT_ID = '$pid'";
                  $array = oci_parse($conn, $sql);
                  oci_execute($array);
  
                  // echo $totalQ;
                  // $sql = "UPDATE CART SET ITEMS = $totalQ WHERE PRODUCT_ID = '$pid' AND C_ID = '$cid' ";
                  // $sql = "MERGE INTO CART
                  // USING (
                  //     SELECT PRODUCT_CART.CART_ID
                  //     FROM CART
                  //     INNER JOIN PRODUCT_CART ON CART.CART_ID = PRODUCT_CART.CART_ID
                  //     WHERE CART.CART_ID = '$cartid'
                  //       AND CART.FK_USER_ID = '$cid'
                  //       AND PRODUCT_CART.PRODUCT_ID = '$pid'
                  // ) src
                  // ON (CART.CART_ID = src.CART_ID)
                  // WHEN MATCHED THEN
                  //     UPDATE SET CART.TOTAL_ITEMS = '$totalQ'";
                  // $sql = "UPDATE CART SET QUANTITY = '$totalQ' "
                  // $sql = "UPDATE CART SET TOTAL_ITEMS = '$totalQ' WHERE CART_ID = '$cartid'";
                  // $array = oci_parse($conn, $sql);
                  // oci_execute($array);
                  // echo "HELLO";
                

               
                }
                else if(!isset($productExist[0])){
                   $cart_id = $exist[0];
                  $sql = "INSERT INTO PRODUCT_CART(CART_ID, PRODUCT_ID, TOTAL_ITEMS)  VALUES ('$cart_id','$pid', '$totalQ')";
                  $array = oci_parse($conn, $sql);
                  oci_execute($array);
                }
                
              // echo $exist[0];
              // echo $cartid;
              // echo $productExist[0];
              
                // $sql = "INSERT CA"
              }
              else{ 
                echo "ready";
                // $sql = "SELECT CART_ID, TOTAL_ITEMS FROM CART WHERE FK_USER_ID = '$cid' AND ITEMS = '$pName'";
                // $array = oci_parse($conn, $sql);
                // oci_execute($array);
                // $ = oci_fetch_array($array)[0];
                // $pQuantity2 = oci_fetch_array($array)[1];
                // $sql = "INSERT INTO CART(PRODUCT_ID, C_ID, P_QUANTITY) VALUES('$pid','$cid',$quantity)";
                $sql = "INSERT INTO CART(FK_USER_ID) VALUES('$cid')";
                $array = oci_parse($conn, $sql);
                oci_execute($array);
                $sql = "SELECT CART_ID FROM CART WHERE FK_USER_ID = '$cid'";
                $array = oci_parse($conn, $sql);
                oci_execute($array);
                $cart_id = oci_fetch_array($array)[0];
                $sql = "INSERT INTO PRODUCT_CART(PRODUCT_ID, CART_ID, TOTAL_ITEMS) VALUES('$pId', '$cart_id', '$quantity')";
                $array = oci_parse($conn, $sql);
                oci_execute($array);
              }
              // $remainingQuant = $pQuantity - intval($_POST['quantity']);
              // // echo $remainingQuant;
              // $sql1 = "UPDATE PRODUCT SET PRODUCT_QUANTITY = $remainingQuant WHERE PRODUCT_ID = $pid";
              // $array2 = oci_parse($conn, $sql1);
              // oci_execute($array2);
              // oci_close($conn);
              header("location: ../cart_page/index.php");
            }
            else if($pQuantity == 0){
              $quant_Error = "Item out of stock";
            }
            else{
              $pQ = $pQuantity-productIncart()[0];
              if($pQ == 0){
                $quant_Error = "You have put all items in cart";
              }
              else{
                $quant_Error = "Quantity should be between 1 and $pQ";
              }
            }
            $quant_Error = $quant_Error;
          }
          else if(isset($_POST['addtocart']) && !isset($_SESSION['username'])){
            // $username = $_SESSION['username'];
            // $quantity = productIncart()[0];
            $pid = $_GET['id'];
            $quantNow = $_POST['quantity'];
            if(isset($_COOKIE['product'])){
              $id_cookie = $_COOKIE['product'];
                $quantity_cookie = $_COOKIE['quantity'];
                $arrid = explode(" ", $id_cookie);
                $quantarr = explode(" ", $quantity_cookie);
                // print_r($quantarr);
              if(in_array("$pid", $arrid)){
                $index = array_search("$pid", $arrid);
                $prevQuant = intval($quantarr[$index]);
                if(($prevQuant+$_POST['quantity'])<$pQuantity){
                  $totalQuant = $prevQuant+$quantNow;
                  $cookie_name = "product";
                  $base = $quantarr;
                  $replace = array($index => $totalQuant);
                  $finalarr = array_replace($base, $replace);
                  $strfinal = implode(" ", $finalarr);
                  setcookie("quantity", $strfinal, time() + (86400 * 30), "/");
                  header("location: ../cart_page/index.php");
                }
                else{
                  
                  $quant_Error = "Quantity cannot exceed the stock!";
                }
                
              }
              else{
                // $arr = array_push($id_cookie_arr, $pid);
                // $quantArr = array_push($quantity_cookie_arr,$quantNow);

                setcookie("quantity", $quantity_cookie." $quantNow", time() + (86400 * 30), "/");
                setcookie("product", $id_cookie." $pid" , time() + (86400 * 30), "/");
                header("location: ../cart_page/index.php");
              
              }
            }
            else{
              setcookie("product", "$pid", time() + (86400 * 30), "/");
              setcookie("quantity", "$quantNow", time() + (86400 * 30), "/");
              header("location: ../cart_page/index.php");

            }

          }
          ?>
          <?php

//for tomorrow

          ?>
            <h1><?php echo $pName.", ".$pQuantity." counts";  ?></h1>
            <div class="ratings-sec">
                <div class="ratings">
                  <?php
                  $pid = $_GET['id'];
                  $sql = "SELECT RATE FROM REVIEW WHERE FK_PRODUCT_ID = $pid";
                  $arr = oci_parse($conn, $sql);
                  oci_execute($arr);
                  $count = 0;
                  $rate = 0;
                  while($rows = oci_fetch_array($arr)){
                    $rate += $rows[0];
                    $count++;
                  }
                  if($count!=0){
                    $avgrate = round($rate/$count);
                  }
                  else{
                    $avgrate = 0;
                  }
                  for($i=0; $i<$avgrate; $i++){
                  ?>
                  <p><i class="fa-solid fa-star"></i></p>

                  <?php
                  }
                  for($i=$avgrate; $i<=4; $i++){
                    ?>
                    <p><i class="fa-regular fa-star"></i></p>
                    <?php
                  }

                  ?>
                    <!-- <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-regular fa-star"></i></p> -->
                </div>
                <p style="margin-right:  2em;">77 ratings</p>
                <?php
                include("../connectionPHP/connect.php");
                $proid = $_GET['id'];
                if(isset($_SESSION['username'])){
                  $username = $_SESSION['username'];
                  $query = "SELECT USER_ID FROM MART_USER WHERE USERNAME = '$username'";
                  $arr = oci_parse($conn, $query);
                  oci_execute($arr);
                  $custId = oci_fetch_array($arr)[0];
                  // echo $proid;
                  $sql = "SELECT WISHLIST_PRODUCT.PRODUCT_ID FROM WISHLIST, WISHLIST_PRODUCT WHERE WISHLIST.WISHLIST_ID = WISHLIST_PRODUCT.WISHLIST_ID AND WISHLIST_PRODUCT.PRODUCT_ID = $proid AND WISHLIST.FK_USER_ID = $custId";
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
                 
                  <?php
                  $sql =  "SELECT DISTINCT OFFER_PERCENTAGE, OFFER_PRODUCT.PRODUCT_ID FROM OFFER INNER JOIN OFFER_PRODUCT ON OFFER_PRODUCT.OFFER_ID = OFFER.OFFER_ID WHERE ITEMS = '$pName'";
                  $arr = oci_parse($conn, $sql);
                  oci_execute($arr);
                  $x = false;
                  while($row = oci_fetch_array($arr)){
                    $offer = $row[0];
                    $pid = $row[1];
                    if($pid == $proid){
                      ?>
                      <?php $afterprice = number_format(((float)$pPrice - ((float)$pPrice*(float)$offer)/100),2);?>

                      <p>Price <?php echo "  £".$afterprice ;  ?></p>
                      <div>
                        <p><?php echo "£".$pPrice;  ?></p>
                      <p>offer: <?php echo $pDiscount."%";  ?></p>
                      <?php
                      $x = true;
                    }
                    
                    
                  }
                  if($x == false){

                    ?>
                    <?php //$prevPrice = number_format(((float)$pPrice - ((float)$pPrice*(float)$offer)/100),2);?>

                    <p>Price <?php echo "  £".$pPrice;  ?></p>
                    <div>
                      <p><?php echo "£".$pPrice;  ?></p>
                    <p>offer: <?php echo "No offer";  ?></p>
                    <?php
                  }
                  
                  ?>
                    
                 </div>
            </div>
            <h1>Quantity</h1>
            <div class="quantity">
              <button type="button" name="inc">-</button>
              <input type="text" name="quantity" placeholder="1" value="1" >
              <button type="button" name="inc">+</button>
              <?php
             
              if(isset($_SESSION['username'])){
                $finalArr = productIncart();
                if(isset($finalArr[0])){
                  $quant = $finalArr[0];
                  echo "<p style='font-size: 0.8rem; margin-top: 1em; color: var(--secondary-color);'>$quant item(s) are already in cart</p>";
                }
                else{
                  echo "<p style='font-size: 0.8rem; margin-top: 1em;'>0 item is in cart</p>";
                }
              }
              
              ?>
              <p class="quantity_error" style="color: red; font-size: 0.8rem; font-weight: bold; margin-top: 1em;"><?php  if(isset($quant_Error)) echo $quant_Error;  ?></p>
            </div>
            <div class="place-order">
              <!-- <button name='buynow'>Buy Now</button> -->
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
                $name = oci_fetch_array($res)[1];
                ?>
                <p class="cat-type">Shop</p>
                <p class="cat-info"><?php echo $name;  ?></p>
                <?php
            ?>
           
          </div>
          <div class="trader">
          <?php
                $sql = "SELECT * FROM MART_USER WHERE USER_ID = $pTrader";
                $res = oci_parse($conn, $sql);
                oci_execute($res);
                $name1 = oci_fetch_array($res)[3];
                ?>
                <p class="trader-type">Trader</p>
                <p class="trader-intro"><?php echo $name1;  ?></p>
                <?php
            ?>
          </div>
        </div>
        <div class="onlyrating">
        <h1>Rate this product</h1>
            <div class="rate_product">
          <?php 
          include("../connectionPHP/connect.php");
          $pid = $_GET['id'];
          $cname = null;
          if(isset($_SESSION['username'])){
            $cname=  $_SESSION['username'];
          }
          // $sql = "SELECT RATING_STAR FROM RATING,CUSTOMER WHERE CUSTOMER.C_ID = RATING.C_ID AND PRODUCT_ID = $pid AND CUSTOMER.C_USERNAME = '$cname'";
          $sql = "SELECT RATE FROM REVIEW, MART_USER WHERE REVIEW.FK_USER_ID = MART_USER.USER_ID AND MART_USER.USERNAME = '$cname' AND FK_PRODUCT_ID = '$pid'";
          $arr = oci_parse($conn, $sql);
          oci_execute($arr);
          $row = oci_fetch_array($arr);
          if(isset($row[0])){
            $rating = $row[0];
            for($i=0; $i<$rating; $i++){
            ?>
            <p><i class="fa-solid fa-star"></i></p>

            <?php
            }
            for($i=$rating; $i<=4; $i++){
              ?>
              <p><i class="fa-regular fa-star"></i></p>
              <?php
            }
           
          }
          else{
            ?>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>


          <?php
          }
            
          

          ?>
              
            </div>
        </div>
      </div>
      
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
          $pDesc = $row[2];
          ?>
          <p><?php echo $pDesc; ?></p>
          <?php
      }
        ?>

    </section>
      
    <section class="ratingsreviews">
      <h1>Ratings and Reviews</h1>
      <div class="personandrating">
        <div class="person">
          <i class="fa-sharp fa-solid fa-circle-user"></i>
          <p class="username">Subodh21</p>
          <div class="rate_product">
          <?php 
          include("../connectionPHP/connect.php");
          $pid = $_GET['id'];
          $cname = null;
          if(isset($_SESSION['username'])){
            $cname=  $_SESSION['username'];
          }
          // $sql = "SELECT RATING_STAR FROM RATING,CUSTOMER WHERE CUSTOMER.C_ID = RATING.C_ID AND PRODUCT_ID = $pid AND CUSTOMER.C_USERNAME = '$cname'";
          $sql = "SELECT RATE FROM REVIEW, MART_USER WHERE REVIEW.FK_USER_ID = MART_USER.USER_ID AND MART_USER.USERNAME = '$cname' AND FK_PRODUCT_ID = '$pid'";
          $arr = oci_parse($conn, $sql);
          oci_execute($arr);
          $row = oci_fetch_array($arr);
          echo $row[0];
          if(isset($row[0])){
            $rating = $row[0];
            for($i=0; $i<$rating; $i++){
            ?>
            <p><i class="fa-solid fa-star"></i></p>

            <?php
            }
            for($i=$rating; $i<=4; $i++){
              ?>
              <p><i class="fa-regular fa-star"></i></p>
              <?php
            }
           
          }
          else{
            ?>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>
            <p><i class="fa-regular fa-star"></i></p>


          <?php
          }
            
          

          ?>
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
            <textarea name="product_review" cols="30" rows="10"></textarea>
            <p class="emptytextarea"></p>
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
