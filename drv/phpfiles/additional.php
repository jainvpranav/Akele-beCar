<?php 
    @include('../login/config.php');
    session_start();
    $error=[''];
    $car_type = ["small"=>4,"mid"=>5,"large"=>6,"smallsuv"=>4,"midsuv"=>5,"largesuv"=>6];
    if(isset($_POST['submit1'])) {
        if(isset($_SESSION['dname'])&&isset($_SESSION['demail'])&&isset($_SESSION['dphone'])&&isset($_SESSION['dgender'])&&isset($_SESSION['dpass'])) {
            $dname = $_SESSION['dname'];
            $demail=$_SESSION['demail'];
            $dgender=$_SESSION['dgender'];
            $dphone=$_SESSION['dphone'];
            $dpass=$_SESSION['dpass'];
        } else {
          array_push($error,'Values not loaded');
        }
        $daadhar = mysqli_real_escape_string($conn, $_POST['daadhar']);
        $dlicense = mysqli_real_escape_string($conn, $_POST['dlicense']);
        $dcar = mysqli_real_escape_string($conn, $_POST['dcar']);
        $dprice = $_POST['dprice'];
        // echo $daadhar, $dlicense, $dcar, $dprice;
        // echo "<meta http-equiv='refresh' content='0'>";
        $select = "INSERT INTO driver(dname,demail,dphone,dgender,dpass,daadhar,dlicense, dcar,dprice) VALUES('$dname','$demail','$dphone','$dgender','$dpass','$daadhar','$dlicense','$dcar',$dprice);";
        $result = mysqli_query($conn, $select);
        $didsel = "SELECT did FROM driver WHERE dname='$dname';";
        $ressel = mysqli_query($conn, $didsel);
        $res1 = $ressel->fetch_assoc();
        $did = $res1['did'];
        $vaca = "INSERT INTO vacancy(did,vacancy,available) VALUES($did,$car_type[$dcar],$car_type[$dcar]);";
        $resultv = mysqli_query($conn, $vaca) ;
        // echo $result;
        if($result){
            // echo'Done';
            header('location: ../index.php');
        } else {
            array_push($error, 'Not unique values');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/drvr_icon_logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/drvr_icon_logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/drvr_icon_logo/favicon-16x16.png">
    <link rel="manifest" href="./assets/drvr_icon_logo/site.webmanifest">
    <title>Additional Info</title>
</head>
<body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" autocomplete="off" class="sign-in-form">
            <h2 class="title">Additional info</h2>
            <p><?php
                if(!empty($error)){
                    echo '<span class="error-msg">'.$error[0].'</span>';
                  }
                array_pop($error);
            ?></p>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Aadhar no." name="daadhar" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-id-card"></i>
              <input type="text" placeholder="License no." name="dlicense" required/>
            </div>
            <select name="dcar" style="text-align: center;" class="input-field" required>
                <option value="#" selected disabled>Select your car</option>
                <option value="small">Small ( estimated price/km : 5 - 7 , vacancy : 4 )</option>
                <option value="mid">Mid-size ( estimated price/km : 6 - 8 , vacancy : 5 )</option>
                <option value="large">Large ( estimated price/km : 7 - 9 , vacancy : 6 )</option>
                <option value="smallsuv">Small SUV ( estimated price/km : 9 - 11 , vacancy : 4 )</option>
                <option value="midsuv">Mid-size SUV ( estimated price/km : 11 - 13 , vacancy : 5     )</option>
                <option value="largesuv">Large SUV ( estimated price/km : 13-18 , vacancy : 6 )</option>
            </select>
            <div class="input-field">
              <i class="fas fa-id-card"></i>
              <input type="number" placeholder="Price per km" name="dprice" required/>
            </div>
            <input type="submit" value="Login" class="btn solid" name="submit1" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Last Text Boxes. Promise</h3>
            <p>
              Some important steps
            </p>
          </div>
          <img src="./assets/svgs/log.svg" class="image" alt="" />
        </div>
        <!-- <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div> -->
      </div>
    </div>
<script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
</body>
</html>