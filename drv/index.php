<?php 
  $error=[''];
  @include('./login/config.php');
  session_start();
  if(isset($_POST['login'])) {
    $dlemail = mysqli_real_escape_string($conn, $_POST['email']);
    $dlpass = md5($_POST['pass']);
    // echo "<meta http-equiv='refresh' content='0'>";
    $select = "SELECT * FROM driver WHERE demail='$dlemail' && dpass='$dlpass';";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
      $row=$result->fetch_assoc();
      $did = $row['did'];
      // echo $did;
      $_SESSION['did'] = $did;
      header('location:./profile/index.php');
    } else{
        array_push($error,'incorrect email or password!');
    }
  };
  if(isset($_POST['signin'])) {
    $dname = mysqli_real_escape_string($conn, $_POST['dname']);
    $dphone = mysqli_real_escape_string($conn, $_POST['dphone']);
    $demail = mysqli_real_escape_string($conn, $_POST['demail']);
    $dgender = mysqli_real_escape_string($conn, $_POST['dgender']);
    $dpass = md5($_POST['dpass']);
    // echo "<meta http-equiv='refresh' content='0'>";
    $select = "SELECT * FROM driver WHERE demail ='$demail' && dpass='$dpass';";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result)>0) {
      // echo "<script type='text/javascript'>toastr.warning('User exists');</script>";
      array_push($error,'user exists');
    }
    else {
      // if(phonevalidator((int)$dphone) && emailvalidator($demail)){
        $_SESSION['dname']=$dname;
        $_SESSION['demail']=$demail;
        $_SESSION['dgender']=$dgender;
        $_SESSION['dphone']=$dphone;
        $_SESSION['dpass']=$dpass;
          header('location:./phpfiles/additional.php');
      // } 
    }
  }
  // function phonevalidator($dphone) {
  //   $ch = curl_init();
  //   // Set the URL that you want to GET by using the CURLOPT_URL option.
  //   curl_setopt($ch, CURLOPT_URL, 'https://phonevalidation.abstractapi.com/v1/?api_key=581bd3e5ff54496a9055c4cccaf916c3&phone=+91'.$dphone);
  //   // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  //   // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
  //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

  //   // Execute the request.
  //   $data = curl_exec($ch);

  //   // Close the cURL handle.
  //   curl_close($ch);
    
  //   // Print the data out onto the page.
  //   // echo $data;
  //   if(strpos($data, "\"valid\":true")) {
  //     return 1;
  //   } else { array_push($error,'Phone num error'); 
  //     // echo "<script type='text/javascript'>toastr.error('Phone Num error');</script>";
  //     return 0;}
  // }
  // function emailvalidator($demail) {
  //   // Initialize cURL.
  //   $ch = curl_init();

  //   // Set the URL that you want to GET by using the CURLOPT_URL option.
  //   curl_setopt($ch, CURLOPT_URL, 'https://emailvalidation.abstractapi.com/v1/?api_key=5b9088679f5743f69f9a92640327bed2&email='.$demail);

  //   // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  //   // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
  //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

  //   // Execute the request.
  //   $data = curl_exec($ch);

  //   // Close the cURL handle.
  //   curl_close($ch);
  //   // Print the data out onto the page.
  //   if(strpos($data, '"is_valid_format":{"value":true')) {
  //     return 1;
  //   } else { array_push($error,'Email id error');
  //     // echo"<script type='text/javascript'>toastr.error('Email Id error');</script>";
  //     return 0;} 
                
  // }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/drvr_icon_logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/drvr_icon_logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/drvr_icon_logo/favicon-16x16.png">
    <link rel="manifest" href="./assets/drvr_icon_logo/site.webmanifest">
    <title>Driver Signin/Signup</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" autocomplete="off" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <p><?php
                if(!empty($error)){
                    echo '<span class="error-msg">'.$error[0].'</span>';
                  }
            ?></p>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="pass" />
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />
          </form>
          <form method="POST" autocomplete="off" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="dname" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="demail" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="tel" placeholder="Phone" name="dphone" required/>
            </div>
            <select name="dgender" style="text-align: center;" class="input-field" required>
              <option value="#" selected disabled>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Prefer not to say</option>
            </select>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="dpass" required/>
            </div>
            <div id="terms">
            <input type="checkbox" value="*Terms and conditions apply" required />
            <label><a href="./phpfiles/terms.php" target="_blank">Terms and conditions</a> apply</label>
            </div>
            <input type="submit" class="btn" value="Sign up" name="signin"/>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
          <h1 style="text-decoration:underline wavy;">Akele beCar</h1>
          <br>
            <h3>New here ?</h3>
            <p>
              Register With Us for a Greener & Eco friendly World
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="./assets/svgs/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
          <h1 style="text-decoration:underline wavy;">Akele beCar</h1>
          <br>
            <h3>One of us ?</h3>
            <p>
              Find your ride & get on with it.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="./assets/svgs/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
