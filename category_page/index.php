<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Category Page</title>
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="backdrop">

    </div>
    <header>
        <div class="logo">
            <a href="../landing_page/index.php">
<img src="../landing_page/image1.png" alt="logo">
            </a>
        </div>
        <ul>
            <li><a href="../landing_page/index.php">Home</a></li>
            <li><a href="../traders_login_page/index.php">Sell a product</a></li>
            <li><a href="../about_us/index.php">About us</a></li>
            <li><a href="#contact_us">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
        <?php
        session_start();
        
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
                    <a href="../cart_page/index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a><span class='cart-quantity'><?php if(isset($totalnum)) echo $totalnum; else echo "0"; ?></span>
                    <?php
                ?>      
             </div>
             <div class="search">
                <a href="#search-me"><i class="fa fa-search"></i></a>
             </div>
            
        </div>
    </header>
    <section class="breadcrumb">
            <div> <a href="../landing_page/index.php">Home</a> </div>
            <i class="fa-solid fa-angle-right"></i>
            <div> <a href="#"><?php echo $_GET['cat']; ?></a> </div>
    </section>
    <section class="filters-items">
        <div class="filters">
            <div class="filter-icon">
                <i class="fa-solid fa-filter"></i>
                <p>filter</p>
            </div>
            <hr>
            <h1>Shops</h1>
            <form class="radio-select">
                <?php
        $sql = "SELECT * FROM SHOP";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        while($row = oci_fetch_array($array)){
            $S_ID = $row[0];
            // $S_Cat = $row[1];
            $S_Name = $row[1];
            // $Trader_ID = $row[3];
            ?>
                <div>
                    <input type="radio" id="label1" value="<?php echo $S_Name; ?>" name="brand">
                    <label for="label1"><?php echo $S_Name; ?></label>
                </div>


            <?php
        }
                ?>
                
            <!-- <h1>Expiry date</h1>
                <p>From</p>
                <input type="date" class="datefrom">
                <p>To</p>
                <input type="date" class="dateto"> -->
                <button type="button" name='radiosubmit'>Submit</button>
            </form>
        </div>
        <div class="addfilter">

            <div class="morefilters">
                    <div class="pricefilter">
                        <div class="pricerange">
                            <label for="pricerange">Price Range</label>
                            <input type="number" placeholder="min" class="minrange">
                            <input type="number" placeholder="max" class="maxrange">
                            <button class="applyrange">Apply</button>

                            
                        </div>
                        <div class="view-range">
                            <label for="" class="view">View</label>
                            <i class="fa fa-th" aria-hidden="true"></i>
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="sort">
                        <label for="sortby">SortBy</label>
                        <select name="sortby" id="sortby">
                            <option value="1" selected>Popularity</option>
                            <option value="2">Price: low to high</option>
                            <option value="3">Price: high to low</option>
                            <option value="4">Newest first</option>
                        </select>
                        <button class="apply">Apply</button>
                    </div>
            </div>

        <input type="hidden" class="catname" value="<?php echo $_GET['cat']; ?>">
        <div class="items">
            <div class="main-item-sale" id='search-me'>
                <h1>Flash Sale </h1>
                <div class="item-search" >
                    <input type="text" name="search" class="search-item" placeholder="search anything">
                    <!-- <i class="fa fa-times" aria-hidden="true"></i> -->
                    <button class="search-result"><i class="fa fa-search"></i></button>
                 </div>
            </div>
            <div class="items-container">
                <?php
                $cat = $_GET['cat'];
        $sql = "SELECT PRODUCT_ID, PRODUCT.NAME, PRODUCT.DESCRIPTION, PRODUCT.PRICE, PRODUCT.STOCK_AVAILABLE, PRODUCT.ALLERGY_INFORMATION, PRODUCT.IMAGE1, PRODUCT.IMAGE2, PRODUCT.IMAGE3, CATEGORY.CATEGORY_NAME FROM PRODUCT,CATEGORY WHERE PRODUCT.FK_CATEGORY_ID = CATEGORY.CATEGORY_ID AND CATEGORY.CATEGORY_NAME = '$cat' AND ROWNUM <= 9";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        while($row = oci_fetch_array($array)){
            $pId = $row[0];
            $pName = $row[1];
            $pPrice = $row[3];
            $pQuantity = $row[4];
            $pDesc = $row[2];
            $pCategory = $row[9];
            $pDiscount = $row[6];
            $pAllergy = $row[5];
            $pImage1 = $row[6];
            $pImage2 = $row[7];
            $pImage3 = $row[8];
            ?>
            <div class="item">
                    <img src="<?php echo "../productsImage/".$pImage2; ?>" alt="productImage">
                    <div>
                        <h1><?php echo $pName; ?></h1>
                        <p><?php echo substr($pDesc,0,60)."..."; ?></p>
                        <div class="btn_rate">
                            <div class="btn"><a href="<?php echo "../item_page/index.php?id=$pId"; ?>">View More</a></div>
                            <p class="price"><?php echo "£".$pPrice; ?></p>
                        </div>
                    </div>
                </div>
            <?php
            
        }



?>
                <!-- <div class="item"> 
                    <img src="https://images.unsplash.com/photo-1577401239170-897942555fb3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1828&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>


                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>


                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>


                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a>e</div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1562770584-eaf50b017307?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1902&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.html">View More</a></div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                -->
 
            </div>
            <div class="loader">
                <h1 style="border: 1px solid black; padding: 0.3em 0.8em; background-color: var(--tertiary-color); color: white; cursor: pointer;">See More</h1>
                <span style="font-size: 1.5rem;">0 Items remaining</span>
            </div>
        </div>
    </div>

    </section>
    <footer>
        <div class="container-footer">
            <div class="footer-item1">
                <h1>CleckHF mart</h1>
                <p>Categories</p>
                <p>Products</p>
                <p>About us</p>
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
</body>
</html>
