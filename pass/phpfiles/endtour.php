<?php 
    @include('../login/config.php');
    session_start();
    if(isset($_POST['submit'])) {
        $nid = $_POST['nid'];
        $uid = $_POST['uid'];
        date_default_timezone_set('Asia/Kolkata');
        $datetimelocal = date('Y-m-d h:i:s'); 
        $sel = "UPDATE notify SET uend=1, endt='$datetimelocal' WHERE nid=$nid;";
        $res = mysqli_query($conn, $sel);
        $_SESSION['uid'] = $uid;
        $_SESSION['nid'] = $nid;
        header('location:./pay.php');
    }
?>