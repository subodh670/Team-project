<?php
header("location: landing_page/index.php");
?>
<?php
    session_start();
    if(!isset($_SESSION['username'])){
      ?>
      <form class='modal-login' action="" method="POST">
        <?php
          if(isset($_POST['login-redirect'])){
            header("location: ../sign_in_page/index.php");
          }
          // else if(isset($_POST['register-redirect'])){
          //   header("location: ../sign_up_page/index.php");
          // }
        ?>
        <div>
          <p class="close-signin">&times;</p>
          <img src="../landing_page/image1.png" alt="">
          <div>
            <p>Please</p>
            <button style="text-decoration: underline;" name="login-redirect">Login</button>
            <p>to add products to cart.</p>
          </div>
        </div>
      </form>
    <div class="backdrop" style="display: block"></div>
    <?php
    }
    ?>