<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_POST['submit'])) {
        $nid = $_POST['nid'];
        $did = $_POST['did'];
        date_default_timezone_set('Asia/Kolkata');
        $datetimelocal = date('Y-m-d h:i:s'); 
        $sel = "UPDATE notify SET dend=1, endt='$datetimelocal' WHERE nid=$nid;";
        $res = mysqli_query($conn, $sel);
        $sel1="UPDATE vacancy SET available=available+1 where available<=vacancy and did=$did;";
        $res1=mysqli_query($conn, $sel1);
        header('location:./ong.php');
    }else {
        echo "<script>alert('Something went wrong')</script>";
    }
?>