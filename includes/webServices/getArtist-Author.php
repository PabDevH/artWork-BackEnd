<?php
error_reporting(0);
require("../conn.php");
$sql = "SELECT name,lastName,email,birthday,website FROM authors WHERE authorId='".$_POST['authorId']."'";
$res = mysqli_query($conn, $sql);
$dat = mysqli_fetch_array($res);
$data[0]['name']=$dat['name'];
$data[0]['lastName']=$dat['lastName'];
$data[0]['email']=$dat['email'];
$data[0]['birthday']=$dat['birthday'];
$data[0]['website']=$dat['website'];
$data[0]['authorId']=$dat['authorId'];
$data = json_encode($data,TRUE);
echo $data;