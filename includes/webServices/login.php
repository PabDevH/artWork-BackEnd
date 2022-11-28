<?php
error_reporting(0);
session_start();
require("../conn.php");
$sql = "SELECT name,lastname,userId FROM login WHERE ( username='".$_POST['username']."' AND password=MD5('".$_POST['password']."') )";
$res = mysqli_query($conn, $sql);
$dat = mysqli_fetch_array($res);
if ($dat['userId']>0) {
    $_SESSION['name']=$dat['name'];
    $_SESSION['lastname']=$dat['lastname'];
    $_SESSION['userId']=$dat['userId'];
    echo "1";
}else{
    echo "0";
}
exit;