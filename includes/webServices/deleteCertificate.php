<?php
error_reporting(0);
require("../conn.php");
require("../functions.php");

$sql = "SELECT hash,frontImage,reverseImage,inscriptionImage,signImage FROM certificates WHERE certId='".$_POST['certId']."'";
$res = mysqli_query($conn, $sql);
$dat = mysqli_fetch_array($res);
$hash = $dat['hash'];
if ($hash!="") {
    @unlink($IMAGES_PATH.$hash.$dat['frontImage']);
    @unlink($IMAGES_PATH.$hash.$dat['reverseImage']);
    @unlink($IMAGES_PATH.$hash.$dat['inscriptionImage']);
    @unlink($IMAGES_PATH.$hash.$dat['signImage']);

    $sql2 = "DELETE FROM certificates WHERE certId='".$_POST['certId']."'";
    $res2 = mysqli_query($conn, $sql2);
}
echo "0";