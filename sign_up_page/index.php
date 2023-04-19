<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../fontawesome-free-6.3.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Questrial&family=Roboto&display=swap" rel="stylesheet">
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
            <li><a href="../traders_login_page/index.html">Sale a product</a></li>
            <li><a href="#customer_services">Customer Services</a></li>
            <li><a href="#contact_us">Contact Us</a></li>
        </ul>
        <div class="login_cart_search">
             <div class="login">
                <a href="../sign_in_page/index.html">Sign In</a>
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



    <section class="wrapper">
        <div class="container-sign">
            <div class="signup-img">
                <i class="fa-solid fa-circle-user"></i>
                <h1>Sign Up</h1>
            </div>
            <form action="" class="signup" method="POST">
                <?php

            function validatePass($pass){
                $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
                if(preg_match($password_regex, $pass)){
                    return true;
                }
                else{
                    return false;   
                }
            }
            if(isset($_POST['signup'])){
                if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['rpassword'])){
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $rpassword = $_POST['rpassword'];
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $email = $_POST['email'];
                    }
                    else{
                        echo("<p>Email is not a valid email address!!</p>");
                    }
                    if(validatePass($password)){
                        $password = $_POST['password'];
                    }
                    else{
                        echo("<p>Password must be 8 characters, one uppercase, one lowercase, one digit and one special character!!</p>");
                    }
                    if($password == $rpassword){
                        $rpassword = $_POST['rpassword'];
                    }
                    else{
                        echo "<p>Passwords do not match!!</p>";
                    }
                    

                }
                else{
                    echo "<p>Empty fields!!</p>";
                }
            }


                ?>
<div class="fullname">
    <label for="fullname"><i class="fa-regular fa-user"></i></label>
    <input type="text" id="fullname" placeholder="Full Name" name="fullname">
    <i class="fa-regular fa-user"></i>
</div>
<div class="email">
    <label for="email"><i class="fa-solid fa-envelope"></i></label>
    <input type="email" id="email" placeholder="Email" name="email">
    <i class="fa-solid fa-envelope"></i>
</div>
<div class="password">
    <label for="password"><i class="fa-sharp fa-solid fa-key"></i></label>
    <input type="password" id="password" placeholder="Password" name="password">
    <i class="fa-sharp fa-solid fa-key"></i>
</div>
<div class="repeatpassword">
    <label for="rpassword"><i class="fa-sharp fa-solid fa-key"></i></label>
    <input type="password" id="rpassword" placeholder="Repeat your password" name="rpassword">
    <i class="fa-sharp fa-solid fa-key"></i>
</div>

<div class="terms">
    <input type="radio" id="terms" name="terms" checked="unchecked">
    <label for="terms" style="color: var(--secondary-color);">I agree all statements in terms and conditions</label>
</div>
<div class="member">
    <label for="" style="color: var(--secondary-color)">Already a member <a href="../sign_in_page/index.html" style="color: var(--primary-color);">Login</a></label>
</div>
<div class="btn">
    <input type="submit" name="signup" value="Register">
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
    <script src="script.js"></script>
</body>
</html>