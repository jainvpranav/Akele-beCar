<?php 
  @include('../login/config.php');
  session_start();
  if(isset($_SESSION['uid'])) {
    // $uid = $_GET['id'];
    $uid=$_SESSION['uid'];
    $a1="SELECT * FROM user WHERE `uid`=$uid;";
    $b1=mysqli_query($conn, $a1);
    $c1=$b1->fetch_assoc();
    $uname=$c1['uname'];
    $uemail = $c1['uemail'];
    $uphone=$c1['uphone'];
    $ugender=$c1['ugender'];  
  }
   else {
    echo 'error';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="./css/demo.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="./style.css"> -->
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
      <a class="navbar-brand bold" href="#">Akele beCar</a>
      <div class="nav-logo">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
      </div>  
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a class="nav-link active bold" aria-current="page" href="#">Profile</a>
              </li>
              <!-- <li class="nav-item">
                  <a class="nav-link active bold" aria-current="page" href="./ong.php">Ongoing</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active bold" aria-current="page" href="./request.php">Requests</a>
              </li> -->
              <li class="nav-item">
                  <a class="nav-link active bold" aria-current="page" href="../login/logout.php">Logout</a>
              </li>
          </ul>
      </div>
  </div>
</nav>
<div style="height: 26px"></div>
<div style="height: 26px"></div>
<div style="height: 26px"></div>
<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="./digital-image.png" alt="user">
            <h3><?php echo $uname; ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">Phone : </strong><?php echo $uphone; ?></p>
            <p class="mb-0"><strong class="pr-1">Email : </strong><?php echo $uemail; ?></p>
            <p class="mb-0"><strong class="pr-1">Gender : </strong><?php echo $ugender; ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0">Ride Stats</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Total Rides </th>
                <td><?php echo $rides; ?></td>
              </tr>
              <tr>
                <th width="30%">Kms Travlled </th>
                <td><?php echo $km; ?></td>
              </tr>
              <tr>
                <th width="30%">Carbon Saved </th>
                <td><?php echo $carbon; ?></td>
              </tr>
              <tr>
                <th width="30%">Trees Planted</th>
                <td><?php echo $trees; ?></td>
              </tr>
            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
           
    		</div>
		</div>
    </div>
</section>
     
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- Analytics -->

	</body>
</html>