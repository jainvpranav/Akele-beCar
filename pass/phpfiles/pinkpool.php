<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_SESSION['uid']) && isset($_SESSION['src']) && isset($_SESSION['dest']) && isset($_SESSION['km']) && isset($_SESSION['date'])) {
        $uid = $_SESSION['uid'];
        $src = $_SESSION['src'];
        $dest = $_SESSION['dest'];
        $km = $_SESSION['km'];
        $datetime = $_SESSION['date'];
        // echo $uid;echo 'a   '; echo $src;echo 'b   ';echo $dest;echo 'c   '; echo $km;echo 'd   '; echo $datetime;
        date_default_timezone_set('Asia/Kolkata');
        $datetimelocal = date('Y-m-d h:i:s'); 
        $sel = "SELECT * FROM trip;";
        $res=mysqli_query($conn, $sel);
        $_SESSION['uid'] = $uid;
        // if($_POST['submit']) {
        //     $tripid = $_POST['tripid'];
        //     $_SESSION['tripid'] = $tripid;
        //     $_SESSION['uid'] = $uid;
        //     header('location:./accept.php');
        // }
    //  else {
        // header('location:../index.php');
        // echo('error');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chooseride</title>
    <link rel="stylesheet" href="../css/chooseride.css"> 
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
<div class="container">
  <div class="inner box">
    <h3 style="text-align: center;">Rides Available</h3>
    <table class="table">
    <thead class="table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Src</th>
        <th scope="col">Dest</th>
        <th scope="col">Km</th>
        <th scope="col">Date</th>
        <th scope="col">Driver</th>
        <th scope="col">Car</th>
        <th scope="col">Cost</th>
        <th scope="col">Accept</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; while($row=$res->fetch_object()) { 
            $tripid = $row->tripid;
            $did = $row->did;
            $a1="SELECT available FROM vacancy WHERE did=$did;";
            $b1=mysqli_query($conn, $a1);
            $c1=$b1->fetch_assoc();
            $avail = $c1['available'];
            $src = $row->src;
            $dest = $row->dest;
            $km = $row->km;
            $date = $row->strt;
            $q1 = "SELECT * FROM driver WHERE did=$did";
            $qres = mysqli_query($conn, $q1);
            $roww = $qres->fetch_assoc();
            $car = $roww['dcar'];
            $costperkm = $roww['dprice'];
            $dname=$roww['dname'];
            $dgender=$roww['dgender'];
            $price = $km * $costperkm;
            if($dgender=='female') {            
            if($date > $datetimelocal && $avail>0) {
            ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $src; ?></td>
            <td><?php echo $dest; ?></td>
            <td><?php echo $km; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $dname; ?></td>
            <td><?php echo $car; ?></td>
            <td><?php echo $price; ?></td>
            <td class="accept">
                <form action="./accept.php" method="POST">
                    <input type="hidden" name="tripid" value="<?php echo $tripid;?>">
                    <input type="hidden" name="uid" value="<?php echo $uid;?>">
                    <input type="submit" id="accept" name="submit" value="Let's goooo" class="btn-sm btn-success btn">
                </form>
            </td>
        </tr>
        <?php $i++; }}};  ?>
    </tbody>
    </table>
  </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>