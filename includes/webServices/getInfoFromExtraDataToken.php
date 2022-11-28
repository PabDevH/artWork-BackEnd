<?php
error_reporting(0);
require("../conn.php");

$sql = "SELECT additionalDataId,authorName,title,place,year,collection,category,width,heigth,units,inscription,technique,
conservation,additionalNotes,frontImage,reverseImage,inscriptionImage,signImage,certificate1,certificate2,certificate3,certificate4
 FROM additionalData WHERE tokenId='".$_REQUEST['tokenId']."'";
$res = mysqli_query($conn, $sql);
$dat = mysqli_fetch_array($res);
if ($dat['additionalDataId']>0) {
    $dataReturn['authorName']=$dat[1];
    $dataReturn['title']=$dat[2];
    $dataReturn['place']=$dat[3];
    $dataReturn['year']=$dat[4];
    $dataReturn['collection']=$dat[5];
    $dataReturn['category']=$dat['category'];
    $dataReturn['width']=$dat[7];
    $dataReturn['heigth']=$dat[8];
    $dataReturn['units']=$dat[9];
    $dataReturn['inscription']=$dat[10];
    $dataReturn['technique']=$dat[11];
    $dataReturn['conservation']=$dat[12];
    $dataReturn['additionalNotes']=$dat['additionalNotes'];
    $dataReturn['frontImage']=$dat[14];
    $dataReturn['reverseImage']=$dat[15];
    $dataReturn['inscriptionImage']=$dat[16];
    $dataReturn['signImage']=$dat[17];
    $dataReturn['certificate1']=$dat[18];
    $dataReturn['certificate2']=$dat[19];
    $dataReturn['certificate3']=$dat[20];
    $dataReturn['certificate4']=$dat[21];
}else{
    $sql2 = "INSERT INTO additionalData(tokenId) values('".$_REQUEST['tokenId']."')";
    $res2 = mysqli_query($conn, $sql2);
    $dataReturn['authorName']="";
    $dataReturn['title']="";
    $dataReturn['place']="";
    $dataReturn['year']="";
    $dataReturn['collection']="";
    $dataReturn['category']="";
    $dataReturn['width']="";
    $dataReturn['heigth']="";
    $dataReturn['units']="";
    $dataReturn['inscription']="";
    $dataReturn['technique']="";
    $dataReturn['conservation']="";
    $dataReturn['additionalNotes']="";
    $dataReturn['frontImage']="";
    $dataReturn['reverseImage']="";
    $dataReturn['inscriptionImage']="";
    $dataReturn['signImage']="";
    $dataReturn['certificate1']="";
    $dataReturn['certificate2']="";
    $dataReturn['certificate3']="";
    $dataReturn['certificate4']="";
} 
echo json_encode($dataReturn,true);