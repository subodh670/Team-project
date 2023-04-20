<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Questrial&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
            <li><a href="">Customer Services</a></li>
            <li><a href="../contact_us/index.html">Contact Us</a></li>
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


<section class="selectall">
        <div class="all">
            <input type="checkbox" name="selectallpro">
            <p>Select all items(0 items)</p>
        </div>
        <div class="delete">
            <i class="fa-solid fa-trash-can"></i>
            <span>Delete</span>
        </div>
</section>

<section class="oneitemselect">
    <div class="selectone">
        <div class="onlyone">
            <input type="checkbox" name="mainselectall">
            <p>Uk bakery shop</p>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://images.pexels.com/photos/699122/pexels-photo-699122.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
              <input type="text" value="1">
              <button class="increase">+</button>
            </div>
        </div>
    </div>
</section>


<section class="oneitemselect">
    <div class="selectone">
        <div class="onlyone">
            <input type="checkbox" name="mainselectall" >
            <p>Uk Butcher shop</p>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
                <input type="text" value="1">
                <button class="increase">+</button>
            </div>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
              <input type="text" value="1">
              <button class="increase">+</button>
            </div>
        </div>
    </div>
</section>


<section class="oneitemselect">
    <div class="selectone">
        <div class="onlyone">
            <input type="checkbox" name="mainselectall" >
            <p>Uk Butcher shop</p>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
                <input type="text" value="1">
                <button class="increase">+</button>
            </div>
        </div>
    </div>
    <div class="productselect">
        <div class="onlyone">
            <input type="checkbox" name="secselect" class="orderitem">
            <div class="product-desc">
                <img src="https://plus.unsplash.com/premium_photo-1674389878114-6a5479a7b86c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                <div class="desc">
                    <p>Donuts</p>
                    <p>no brand</p>
                    <p>only 10 items remaining</p>
                </div>
            </div>
        </div>
        <div class="price--qty">
            <div class="wish_price_del">
                <p>Rs: £20</p>
                <div>
                    <i class="fa-regular fa-heart show-heart"></i>
                    <i class="fa-solid fa-heart show-heart-solid"></i>
                    <i class="fa-solid fa-trash-can"></i>

                    <i></i>
                </div>
            </div>
            <div class="countitem">
                <button class="decrease">-</button>
              <input type="text" value="1">
              <button class="increase">+</button>
            </div>
        </div>
    </div>
</section>



<section class="ordersummary">
    <div class="container-order">

        <p class="summary-head">Order summary</p>
        <div class="total">
            <p>Total</p>
            <p>£35</p>
        </div>
        <div class="order-checkout">
            <button type="submit" class="checkout">Proceed to checkout</button>
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