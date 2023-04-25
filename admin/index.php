<?php 
  $error=[];
  @include('./login/config.php');
  session_start();
  if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = md5($_POST['pass']);
    // echo "<meta http-equiv='refresh' content='0'>";
    $select = "SELECT * FROM admin WHERE email='$email' && pass='$pass';";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
      header('location:./next.php');
    }
  };
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Admin Login</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" autocomplete="off" class="sign-in-form">
            <h2 class="title">Admin Login</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="name" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="pass" required/>
            </div>
            <input type="submit" name="submit" value="Login" class="btn solid" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h1 style="text-decoration:underline wavy;">Akele beCar</h1>
            <br>
            <h3>Admin </h3>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
