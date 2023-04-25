<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        // date_default_timezone_set('Asia/Kolkata');
        // $datetime_1 = date('Y-m-d h:i:s'); 
        $sel = "SELECT * FROM notify WHERE `uid`=$uid and usrad=1 and drvad=1 and uend=0; ";
        $res=mysqli_query($conn, $sel);
        $_SESSION['uid']=$uid;
    } else {
        header('location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing trips</title>
    <link rel="stylesheet" href="../css/ong.css"> 
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">   
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
                    <a class="nav-link active bold" aria-current="page" href="../profile/index.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bold" aria-current="page" href="./maps.php">Start a Ride</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bold" aria-current="page" href="./request.php">Requested Rides</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bold" aria-current="page" href="../login/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
  </nav>
<div class="container">
  <div class="inner box">
    <h3 style="text-align: center;">Ongoing Trips</h3>
    <table class="table">
    <thead class="table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Trip Source</th>
        <th scope="col">Trip Destination</th>
        <th scope="col">Km</th>
        <th scope="col">Start Date</th>
        <th scope="col">Driver</th>
        <th scope="col">End Tour</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; while($row=$res->fetch_object()) { 
            $tripid = $row->tripid;
            $nid=$row->nid;
            $did=$row->did;
            $a1 = "SELECT * FROM trip WHERE tripid=$tripid;";
            $b1=mysqli_query($conn, $a1);
            $c1=$b1->fetch_assoc();
            $src = $c1['src'];
            $dest = $c1['dest'];
            $km = $c1['km'];
            $date = $row->strt;
            $a2="SELECT dname FROM driver WHERE did=$did;";
            $b2=mysqli_query($conn,$a2);
            $c2=$b2->fetch_assoc();
            $dname=$c2['dname'];
            // if($date > $datetime_1) {
            ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $src; ?></td>
            <td><?php echo $dest; ?></td>
            <td><?php echo $km; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $dname; ?></td>
            <td class="accept">
                <form action="./endtour.php" method="POST">
                    <input type="hidden" name="nid" value="<?php echo $nid;?>">
                    <input type="hidden" name="uid" value="<?php echo $uid;?>">
                    <input type="submit" id="accept" name="submit" value="End tour" class="btn-sm btn-danger btn">
                </form>
            </td>
        </tr>
        <?php $i++; };  ?>
    </tbody>
    </table>
  </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>