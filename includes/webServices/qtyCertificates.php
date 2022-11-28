<?php
error_reporting(0);
require("../conn.php");
$sql = "SELECT count(certId) as total FROM certificates";
$res = mysqli_query($conn, $sql);
$dat = mysqli_fetch_array($res);
echo $dat['total'];