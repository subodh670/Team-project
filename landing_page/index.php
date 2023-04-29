<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleckHFmart homepage</title>
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="landing_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Inter&family=Questrial&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="backdrop">

    </div>
    <header>
        <div class="logo">
            <a href="">
<img src="image1.png" alt="logo">

            </a>
        </div>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="../traders_login_page/index.php">Sale a product</a></li>
            <li><a href="">Customer Services</a></li>
            <li><a href="../contact_us/index.php">Contact Us</a></li>
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
                    <input type="text" name="search" class="search-item">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <button class="search-result"><i class="fa fa-search"></i></button>
                 </form>
            
        </div>
    </header>
    <?php
    if(!isset($_SESSION['guest'])){
        ?>
    <div class="flashlogin">
        <p>Welcome to cleckhfmart Group Ecommerse Website!!</p>
    </div>

        <?php
        $_SESSION['guest'] = 'set';
    }
    else if(!isset($_SESSION['username']) && !isset($_SESSION['password']) && $_SESSION['guest']==false){
        ?>
    <div class="flashlogin">
        <p style="background-color: var(--primary-color);" >You are logged out, please sign in !! </p>
    </div>
        
    <?php
    $_SESSION['guest'] = true;

    }
    else if(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['guest'] == true){
        ?>

        <div class="flashlogin">
        <p>Yay! you are logged in as <?php echo $_SESSION['username']; ?></p>
    </div> 
        
        <?php
        $_SESSION['guest'] = false;
    }
    

    ?>
    <section class="contact show-contact">
        <div class="bars show-bars">
            <i class="fa fa-bars" aria-hidden="true"></i>
            
        </div>
    </section>

    <section class="hero-section">
<div class="container">
            <div class="categories show-cat">
                <?php
                include("../connectionPHP/connect.php");
                $sql = "SELECT * FROM PRODUCT";
                $array = oci_parse($conn, $sql);
                oci_execute($array);
                while($row = oci_fetch_array($array)){
                    $category = $row[5];
                    ?>
                        <a href="<?php  echo "../category_page/index.php?cat=$category" ?>"><p><?php echo $category ?></p></a>
                    <?php
                }

                ?>
                <div class="close-cat">&times;</div>
            </div>
            <div class="slider">
                <div>
                    <img src="../productsimage/cheesecake1.jpg" alt="">
                    <div class="info-img show-info-img">
                        <h1>Cheesecake</h1>
                        <p><a href="../item_page/index.php">View more</a></p>
                    </div>
                </div>
                <div>
                    <img src="../productsimage/mutton1.jpg" alt="">
                    <div class="info-img show-info-img">
                        <h1>mutton</h1>
                        <p><a href="">View more</a></p>
                    </div>
                </div>
                <div>
                    <img src="../productsimage/rockscookies1.jpg" alt=""> 
                    <div class="info-img show-info-img">
                        <h1>rockscookies</h1>
                        <p><a href="">View more</a></p>
                    </div>
                </div>
                <aside class="navslide">
                    <div class="circle circle1"></div>
                    <div class="circle circle2"></div>
                    <div class="circle circle3"></div>
                </aside>
            </div>
            
 </div>
    </section>


    <section class="mart-services">
        <div class="mart-container">

        <div class="service-1">
            <div class="ser-img1">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </div>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, odio!</p>
        </div>
        <div class="service-2">
            <div class="ser-img2">
                <i class="fa-regular fa-clock"></i>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias, odio!</p>

        </div>
    </div>

    </section>
    <section class="filters-items">
        <div class="filters">
            <div class="filter-icon">
                <i class="fa-solid fa-filter"></i>
                <p>filter</p>
            </div>
            <hr>
            <h1>Shops</h1>
            <form class="radio-select" method="POST" action="">
                <?php
        $sql = "SELECT * FROM SHOP";
        $array = oci_parse($conn, $sql);
        oci_execute($array);
        while($row = oci_fetch_array($array)){
            $S_ID = $row[0];
            $S_Cat = $row[1];
            $S_Name = $row[2];
            $Trader_ID = $row[3];
            ?>
                <div>
                    <input type="radio" id="label1" value="<?php echo $S_Name; ?>" name="brand">
                    <label for="label1"><?php echo $S_Name; ?></label>
                </div>


            <?php
        }
                ?>
                
            <h1>Date</h1>
                <p>From</p>
                <input type="date" class="datefrom">
                <p>To</p>
                <input type="date" class="dateto">
                <button name='radiosubmit'>Submit</button>
            </form>
        </div>
        <div class="addfilter">

            <div class="morefilters">
                    <div class="pricefilter">
                        <div class="pricerange">
                            <label for="pricerange">Price Range</label>
                            <input type="text" placeholder="min">
                            <input type="text" placeholder="max">
                            <button class="apply">Apply</button>
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
                            <option value="1">Price: low to high</option>
                            <option value="1">Price: high to low</option>
                            <option value="1">Newest first</option>
                        </select>
                    </div>
            </div>


        <div class="items">
            <h1>Flash Sale </h1>
            <div class="items-container">
                <?php
        $sql = "SELECT * FROM PRODUCT WHERE ROWNUM <= 9";
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
            ?>
            <div class="item">
                    <img src="<?php echo "../productsImage/".$pImage2; ?>" alt="productImage">
                    <div>
                        <h1><?php echo $pName; ?></h1>
                        <p><?php echo substr($pDesc,0,50)."..."; ?></p>
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
</body>
</html>
