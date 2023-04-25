<?php 
@include('../login/config.php');
    // if(isset($_SESSION['tripid'])&&isset($_SESSION['uid'])) {
    if(isset($_POST['submit'])) {
        $tripid = $_POST['tripid'];
        $uid = $_POST['uid'];
        $a1 = "SELECT * FROM trip WHERE tripid=$tripid;";
        $b1= mysqli_query($conn,$a1);
        $c1 = $b1->fetch_assoc();
        $did = $c1['did'];
        $strt = $c1['strt'];
        $a2 = "INSERT INTO notify(tripid,`uid`,did,strt,usrad) Values($tripid,$uid,$did,'$strt',1);";
        $b2 = mysqli_query($conn,$a2);
        header('location: ./request.php');
    } else {
        echo 'err';
    }
?>