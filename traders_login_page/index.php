<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Traders Login page</title>
</head>
<body>
    <div class="backdrop show-back">

    </div>
    <section class="header-trader">
            <div class="container">
                <a href="../landing_page/index.php"><img src="../landing_page/image1.png" alt=""></a>
                <form class="show-form" method="POST" action="">
                    <h1>Sign In</h1>
                    <div class="mail">
                        <label for="email"><i class="fa-solid fa-envelope"></i></label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="pass">
                        <label for="password"><i class="fa-solid fa-lock"></i></label>
                        <input type="password" id="password" name="password">
                            <p><a href="/forgot">Forgot your password</a> </p>
                    </div>
                    <button class="login-btn" name="login">Login</button>
                </form>
                <div style="z-index: 4;" class="bars show-bars">
                    <button class="bars">Sign in</button>
                </div>
            </div>
    </section>
    <section class="hero-signup">
        <div class="signup-container">
            <div class="our-motto">
                <h1>The best #1 platform to sell
                    goods for traders.</h1>
                <p>create an account in 5 minutes and reach million of customer today</p>
            </div>
            <form class="signup">
                <h1>Create an account</h1>
                <div class="phone">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" >
                </div>
                <div class="otp">
                    <button class="otpbtn" name="otpbtn"    >Send me an otp</button>
                </div>
            </form>
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