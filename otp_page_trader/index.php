<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
    <section class='otp'>
        <form action="../trader_signup_page/index.php" method='POST'>
            
            <p>Check an otp from your mail box and type here: </p>
            <div class='inputotp'>
                <label for="otp">OTP</label>
                <input type="text" id='otp' name='otp'>
                <input type="hidden" id="finalotp" value="<?php echo $_SESSION['finalotp']; ?>">
                <input type="hidden" class='validtop' name="validotp" value="<?php echo $_SESSION['traderemail']  ?>">
            </div>
           
            <div class="btn">
                <button type='button' name='verify' class='verify'>Verify</button>
            </div>
            <div class='counter'>
                180 seconds remaining
            </div>
        </form>
    </section>
    <script src='app.js'></script>
</body>
</html>