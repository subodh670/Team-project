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
            <li><a href="#home">Home</a></li>
            <li><a href="../traders_login_page/index.php">Sale a product</a></li>
            <li><a href="#customer_services">Customer Services</a></li>
            <li><a href="#contact_us">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
             <div class="login">
                <a href="../sign_in_page/index.php">Sign In</a>
             </div>
             <div class="cart">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
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
    <section class="breadcrumb">
            <div> <a href="../landing_page/index.php">Home</a> </div>
            <i class="fa-solid fa-angle-right"></i>
            <div> <a href="category"><?php echo $_GET['cat']; ?></a> </div>
    </section>
    <section class="filters-items">
        <div class="filters">
            <div class="filter-icon">
                <i class="fa-solid fa-filter"></i>
                <p>filter</p>
            </div>
            <hr>
            <h1>Brands</h1>
            <form class="radio-select" method="POST" action="">
            <?php
            include("../connectionPHP/connect.php");
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
                <button name='radio-submit'>Submit</button>
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
            <h1>Flash Sale</h1>
            <div class="items-container">
                   <?php 
                   include("../connectionPHP/connect.php");     
                   $cat = $_GET['cat'];
        $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_CATEGORY = '$cat'";
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
                        <p><?php echo $pDesc; ?></p>
                        <div class="btn_rate">
                            <div class="btn"><a href="<?php echo "../item_page/index.php?id=$pId"; ?>">View More</a></div>
                            <p class="price"><?php echo "£".$pPrice; ?></p>
                        </div>
                    </div>
                </div>
            <?php
            
        }

?>

<!--  
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1577401239170-897942555fb3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1828&q=80" alt="">
                    <div>
                        <h1>Noteworthy flagship phone</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, aperiam!</p>
                        <div class="btn_rate">
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a>e</div>
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
                            <div class="btn"><a href="../item_page/index.php">View More</a></div>
                            <p class="price">£10</p>

                        </div>
                    </div>
                </div>
                
-->
            </div>
            <div class="loader">
                <h1>See More</h1>
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