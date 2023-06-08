<?php
session_start();
$otpvalue = rand(100000,999999);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up page</title>
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
            <li><a href="../traders_login_page/index.php">Sell a product</a></li>
            <li><a href="../about_page/index.php">About us</a></li>
            <li><a href="../contact_us/index.php">Contact Us</a></li>
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


    <form action="" method="POST" enctype="multipart/form-data" class='form-signup'>
    <section class="wrapper">
        <div class="container-sign">
            <div class="signup-img">
                <i class="fa-solid fa-circle-user"></i>
                <h1>Sign Up</h1>
            </div>
            <div class="signup">
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
    if(!empty($_POST['firstname']) && !empty($_POST['secondname']) && !empty($_POST['password']) && !empty($_POST['rpassword']) && !empty($_POST['mobile']) && !empty($_POST['address']) && !empty($_POST['gender']) && !empty($_POST['username']) && !empty($_POST['terms'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['secondname'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];

       
        include("../connectionPHP/connect.php");
        $query = "SELECT MOBILE_NO, USERNAME FROM MART_USER";
        $arr = oci_parse($conn, $query);
        oci_execute($arr);
        while($row = oci_fetch_array($arr)){
            if($row[0] == $mobile){
                echo "<p>An account with the same mobile number is found!!</p>";
                $mobile = null;
            }
            else if($row[1] == $username){
                echo "<p>Your chosen username is not allowed!!</p>";
                $username = null;
            }
        }
        if($password == $rpassword){
            $rpassword = $_POST['rpassword'];
        }
        else{
            echo "<p>Error: Passwords do not match!!</p>";
            $rpassword = null;

        }
        if(validatePass($password)){
            $password = sha1($_POST['password']);
        }
        else{
            echo("<p>Error: Password must be 8 characters, one uppercase, one lowercase, one digit and one special character!!</p>");
            $password = null;
        }
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["imagetoupload"]["name"]);
        $image = basename($_FILES["imagetoupload"]["name"]);
        
        if($password != null && $rpassword != null && $image != null && $mobile != null && $username != null){
           
            if (move_uploaded_file($_FILES["imagetoupload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["imagetoupload"]["name"])). " has been uploaded.";
            } else {
                echo "<p>Error: Sorry, there was an error uploading your file.</p>";
                $image = null;
            }
            $date1 = date("d/m/y");
            // echo $date1;
            $email = $_SESSION['traderemail'];
            $sql = "INSERT INTO MART_USER(USERNAME, MOBILE_NO, GENDER, ADDRESS, FIRST_NAME, LAST_NAME, PASSWORD, IMAGE, REGISTERED_EMAIL,OTP, ROLE, STATUS, EMAIL) VALUES('$username', '$mobile', '$gender', '$address','$firstname', '$lastname', '$password', '$image','yes', '$otpvalue','trader', 2, '$email')";
            $array = oci_parse($conn, $sql);
            $result = oci_execute($array);
            $_SESSION['traderusername'] = $username;
            $_SESSION['traderpassword'] = $password;
            $_SESSION['traderapproval'] = 2;
            if($result){
                header("location: ../approvalpage/index.php");
            }
            }
            }
        else{
            echo "<p>Empty fields are not allowed!!</p>";
        }
    }


                ?>
<div class="firstname">
    <label for="fistname"><i class="fa-regular fa-user"></i></label>
    <input type="text" id="firstname" placeholder="First Name" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
    <i class="fa-regular fa-user"></i>
</div>
<div class="secondname">
    <label for="secondname"><i class="fa-regular fa-user"></i></label>
    <input type="text" id="secondname" placeholder="Last Name" name="secondname" value="<?php if(isset($_POST['secondname'])) echo $_POST['secondname']; ?>">
    <i class="fa-regular fa-user"></i>
</div>

<!-- <div class="email">
    <label for="email"><i class="fa-solid fa-envelope"></i></label>
    <input type="text" id="email" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
    <i class="fa-solid fa-envelope"></i>
</div> -->
<div class="mobile">
    <label for="mobile"><i class="fa-solid fa-phone"></i></label>
    <input type="number" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']; ?>">
    <i class="fa-solid fa-phone"></i>
</div>
<div class="address">
    <label for="address"><i class="fa-solid fa-house"></i></label>
    <input type="text" id="address" placeholder="Address" name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
    <i class="fa-solid fa-house"></i>
</div>
<div class="gender">
    <label for="gender"><i class="fa-regular fa-user"></i></label>
    <select name="gender" id="gender">
        <option value="male">male</option>
        <option value="female">female</option>
    </select>
</div>

<div class="btn">
    <h4 class="nextpage">Next-></h4>
</div>
            </div>
        </div>
    </section>
    <section class="wrapper">
        <div class="container-sign">
            <div class="signup-img">
                <i class="fa-solid fa-circle-user"></i>
                <h1>Sign Up</h1>
            </div>
            <div class="signup">
                
<div class="username">
    <label for="username"><i class="fa-regular fa-user"></i></label>
    <input type="text" id="username" placeholder="Username" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
    <i class="fa-regular fa-user"></i>
</div>
<div class="image1">
    <label for="image"><i class="fa-regular fa-user"></i></label>
    <input type="file" id="image" name="imagetoupload">
    <i class="fa-regular fa-user"></i>
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
    <input type="radio" id="terms" name="terms">
    <label for="terms" style="color: var(--secondary-color);">I agree all statements in terms and conditions</label>
</div>
<div class="member">
    <label for="" style="color: var(--secondary-color)">Already a member <a href="../sign_in_page/index.php" style="color: var(--primary-color);">Login</a></label>
</div>
<div class="btn">
    <h4 class="nextpage"><-Previous</h4>
    <input type="submit" name="signup" value="Register">
</div>
            </div>
        </div>
    </section>
    </form>

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