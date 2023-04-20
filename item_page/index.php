<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Item Page</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter&family=Questrial&family=Roboto&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="backdrop"></div>
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
          <input type="text" name="search" class="search-item" />
          <i class="fa fa-times" aria-hidden="true"></i>
          <button class="search-result"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </header>

    <section class="breadcrumb">
            <div> <a href="../landing_page/index.html">Home</a> </div>
            <i class="fa-solid fa-angle-right"></i>
            <div> <a href="category">Category</a> </div>
            <i class="fa-solid fa-angle-right"></i>
            <div> Item</div>
    </section>

    <section class="main-item">
        <div class="item-photo">
            <div class="main-img">
                <img src="https://images.pexels.com/photos/699122/pexels-photo-699122.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
            </div>
            <div class="sub-img">
                <img src="https://images.pexels.com/photos/699122/pexels-photo-699122.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">

                <img src="https://images.pexels.com/photos/4909457/pexels-photo-4909457.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="">

                <img src="https://images.pexels.com/photos/8804990/pexels-photo-8804990.jpeg?auto=compress&cs=tinysrgb&w=1200" alt="">

            </div>
        </div>
        <div class="item-cart">
            <h1>Himalaya Total Care Baby Diapers (Xl) - 74 Counts</h1>
            <div class="ratings-sec">
                <div class="ratings">
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-solid fa-star"></i></p>
                    <p><i class="fa-regular fa-star"></i></p>
                </div>
                <p style="margin-right: 2em;">77 ratings</p>
                <i style="font-size: 1.5rem;" class="fa-regular fa-heart"></i>
            </div>
            <div class="brand">
                <p>Brand</p>
                <p>Himalaya</p>
            </div>
            <hr>
            <div class="cost">
                 <p>Price £22</p>
                 <div>
                    <p>£25</p>
                    <p>-34%</p>
                 </div>
            </div>
            <h1>Quantity</h1>
            <div class="quantity">
              <button>-</button>
              <input type="text" placeholder="1">
              <button>+</button>
            </div>
            <div class="place-order">
              <button>Buy Now</button>
              <button>Add to Cart</button>
            </div>
        </div>
        <div class="item-place">
            <h1>Location</h1>
            <div>
              <i class="fa-solid fa-location-dot"></i>
              <p>Hudderfileds, UK</p>
            </div>
        </div>
    </section>
    <section class="productspecification">
      <div class="product_specifyandrating">
        <div class="onlyspecify">
          <h1>Product specification</h1>
          <div class="specification">
            <p class="specify">specification</p>
            <p class="specify-info">Brand, Recommended Weight, SKU</p>
          </div>
          <div class="brand-type">
            <p class="cat-type">Brand</p>
            <p class="cat-info">Himalaya</p>
          </div>
          <div class="trader">
            <p class="trader-type">Trader</p>
            <p class="trader-inro">Butchers</p>
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
    <section class="pro-description">
      <h1>
        Product Description
      </h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus delectus optio ullam nisi quasi animi ipsum quaerat veniam sequi! Dolorem cupiditate possimus hic ipsa eum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, eaque dolor neque, harum consequuntur aliquid fugiat nam in sed quis omnis officiis nostrum repellat ullam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui magni facilis repudiandae aspernatur! Voluptatem ullam odio autem rem ipsum nihil illum, consequatur officia dolor id!</p>
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