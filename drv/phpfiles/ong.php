<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_SESSION['did'])) {
        $did = $_SESSION['did'];
        // echo $did;
        date_default_timezone_set('Asia/Kolkata');
        $datetime_1 = date('Y-m-d h:i:s'); 
        $sel = "SELECT * FROM notify WHERE did=$did and dend=0 and drvad=1;";
        $res=mysqli_query($conn, $sel);
        $sel1 = "SELECT * FROM trip WHERE did=$did;";
        $res1=mysqli_query($conn, $sel1);

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
                            <a class="nav-link active bold" aria-current="page" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active bold" aria-current="page" href="./maps.php">Start a Ride</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active bold" aria-current="page" href="./requests.php">Requested Ride</a>
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
                    <th scope="col">Passenger</th>
                    <th scope="col">End Ride</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($row=$res->fetch_object()) { 
                        $tripid = $row->tripid;
                        $nid = $row->nid;
                        $uid = $row->uid;
                        $a2="SELECT * FROM trip WHERE tripid=$tripid;";
                        $b2=mysqli_query($conn,$a2);
                        $roww=$b2->fetch_assoc();
                        $a3="SELECT uname FROM user WHERE uid=$uid;";
                        $b3=mysqli_query($conn,$a3);
                        $c3=$b3->fetch_assoc();
                        $uname=$c3['uname'];
                        $src = $roww['src'];
                        $dest = $roww['dest'];
                        $km = $roww['km'];
                        $date = $roww['strt'];
                        if($date > $datetime_1) {
                        ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $src; ?></td>
                        <td><?php echo $dest; ?></td>
                        <td><?php echo $km; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $uname; ?></td>
                        <td class="accept">
                            <form action="./endtour.php" method="POST">
                                <input type="hidden" name="nid" value="<?php echo $nid;?>">
                                <input type="hidden" name="did" value="<?php echo $did;?>">
                                <input type="submit" id="accept" name="submit" value="End tour" class="btn-sm btn-danger btn">
                            </form>
                        </td>
                    </tr>
                    <?php $i++; }};  ?>
                </tbody>
            </table>
            <h3 style="text-align: center;">My Trips</h3>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Trip Source</th>
                    <th scope="col">Trip Destination</th>
                    <th scope="col">Km</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Ride</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; while($row=$res1->fetch_object()) { 
                        $tripid = $row->tripid;
                        $a2="SELECT * FROM trip WHERE tripid=$tripid order by strt desc;";
                        $b2=mysqli_query($conn,$a2);
                        $roww=$b2->fetch_assoc();
                        $src = $roww['src'];
                        $dest = $roww['dest'];
                        $km = $roww['km'];
                        $date = $roww['strt'];
                        ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $src; ?></td>
                        <td><?php echo $dest; ?></td>
                        <td><?php echo $km; ?></td>
                        <td><?php echo $date; ?></td>
                        <td>
                            <?php 
                                if($date > $datetime_1) echo 'Ongoing';
                                else echo 'Ended';
                            ?>
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