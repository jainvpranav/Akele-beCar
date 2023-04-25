<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_POST['submit'])) {
        $nid = $_POST['nid'];
        $did = $_POST['did'];
        $sel = "UPDATE notify SET drvad=1 WHERE nid=$nid";
        $res = mysqli_query($conn, $sel);
        $sel1="UPDATE vacancy SET available=available-1 where available>0 and did=$did;";
        $res1=mysqli_query($conn, $sel1);
        header('location:./ong.php');
    }
?>