<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_POST['submit'])) {
        $nid = $_POST['nid'];
        $sel = "UPDATE notify SET drvad=2 WHERE nid=$nid;";
        $res = mysqli_query($conn, $sel);
        header('location:./ong.php');
    }
?>