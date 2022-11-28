<?php
error_reporting(0);
require("../conn.php");
$sql = "SELET count(certId) FROM certificates WHERE authorId='".$_POST['authorId']."'";
$res = mysqli_query($conn, $sql);
$dat = mysqli_fetch_array($res);
$qtyCertificates = $dat[0];
if ($qtyCertificates>0) {
    echo "1";
}else{
    $sql2 = "SELECT count(authorId) FROM authors WHERE authorId='".$_POST['authorId']."'";
    $res2 = mysqli_query($conn, $sql2);
    $dat2 = mysqli_fetch_array($res2);
    $authorExists = $dat2[0];
    if ($authorExists>0) {
        $sql3 = "DELETE FROM authors WHERE authorId='".$_POST['authorId']."'";
        $res3 = mysqli_query($conn, $sql3);
        echo "3";
    }else{
        echo "2";
    }
}
