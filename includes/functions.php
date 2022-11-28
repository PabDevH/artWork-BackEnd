<?php
$IMAGES_PATH = "/var/www/html/web3/artWork/repository/certificates/images/"; // CAMBIAR ESTA HUEVADA EN PRODUCCION!
$NFT_PATH = "/var/www/html/web3/artWork/NFT/images/";
$EXTRA_DATA_IMAGES = $NFT_PATH."extraData/";

function object_to_array($obj) {
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val) {
            $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
            $arr[$key] = $val;
    }
    return $arr;
}