<?php
$conn=mysqli_connect('localhost', 'root','','crew');
session_start();
if(isset($_SESSION['did']) && isset($_SESSION['uid'])) {
    $uid=$_SESSION['uid'] ;
    $did=$_SESSION['did'] ;
    if(isset($_POST['submit'])) {
        $rating=$_POST['rating'];
        $text = $_POST['textarea'];
        $sql1="INSERT INTO review(did,`uid`, star, comment) VALUES($did, $uid, $rating, '$text');";
        $a=mysqli_query($conn, $sql1);
        header('location: ../phpfiles/ong.php');
    }}
    else {
        header('location: ./reviewpass.php');
    }
    
?>