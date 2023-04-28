<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="styles.css">
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

<section class="contact-us-wrapper">
    <div class="container-form">
        <div class="contact-desc">
            <h1>Contact Us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi eos aperiam exercitationem distinctio soluta cumque voluptatem maiores repellendus corrupti id.</p>
        </div>
        <div class="contact-form">
            <div class="our-info">
                <div class="info">
                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                    <div class="info-item">
                        <h1>Address</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, aliquid!</p>
                    </div>
                </div>
                <div class="info">
                    <i class="fa-solid fa-phone"></i>
                    <div class="info-item">
                        <h1>Phone</h1>
                            <p>+9779841240401</p>
                    </div>
                </div>
                <div class="info">
                    <i class="fa-solid fa-envelope"></i>
                    <div class="info-item">
                        <h1>Email</h1>
                        <p>asubodh21@tbc.edu.np</p>
                    </div>
                </div>
            </div>
            <div class="your-message-form">
                <h1 style="color: var(--secondary-color);">Send message</h1>
                <form action="" method="POST">
                    <div class="form-fullname">
                        <label for="fullname">Full name</label>
                        <input type="text" id="fulname" name="fullname">
                    </div>
                    <div class="form-email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="your-message">
                        <label for="message">Your message</label>
                        <input type="text" id="message" name="message">
                    </div>
                    <div class="submit-btn">
                        <button type="submit" class="sub-btn">Submit</button>
                    </div>
                </form>
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