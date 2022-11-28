<?php
error_reporting(0);
require("includes/isLogin.php");
require("includes/functions.php");
require("includes/conn.php");
$location['section']="Home";
$location['subSection']="Certificates";

function imagesTypes($input) {
    $type = explode("/",$input);
    if ($type[0]!="image") {
        return 1;
    }else{
        switch($input) {
            case 'image/webp' :
                $extension = "webp";
            break;
            case 'image/jpeg' :
                $extension = "jpg";
            break;
            case 'image/png' : 
                $extension = "png";
            break;
            case 'image/svg' :
                $extension = "svg";
            break;
            case 'image/gif' :
                $extension = "gif";
            break;
            default: 
                $extension = "jpg";
            break;
        }
        return $extension;
    }

}

if ($_POST['action']=="createCertificate") {
    
    
    $hash = hash('ripemd160',$_POST['title']."-".$_POST['authorId']."-".$_POST['year']."-".date("Y-m-d H:i:S"));
    $timestamp = date("U");
    $timestamp = md5($timestamp)." ".$timestamp;

    if ($_FILES['frontImage']['error']=="0") {
        $extension = imagesTypes($_FILES['frontImage']['type']);
        if ($extension != 1) {
            $frontImage = $hash."-frontImage.".$extension;
            move_uploaded_file($_FILES['frontImage']['tmp_name'],$IMAGES_PATH.$frontImage);
        }
    }
    if ($_FILES['reverseImage']['error']=="0") {
        $extension = imagesTypes($_FILES['reverseImage']['type']);
        if ($extension != 1) {
            $reverseImage = $hash."-reverseImage.".$extension;
            move_uploaded_file($_FILES['reverseImage']['tmp_name'],$IMAGES_PATH.$reverseImage);
        }
    }
    if ($_FILES['inscriptionImage']['error']=="0") {
        $extension = imagesTypes($_FILES['inscriptionImage']['type']);
        if ($extension != 1) {
            $inscriptionImage = $hash."-inscriptionImage.".$extension;
            move_uploaded_file($_FILES['inscriptionImage']['tmp_name'],$IMAGES_PATH.$inscriptionImage);
        }
    }
    if ($_FILES['signImage']['error']=="0") {
        $extension = imagesTypes($_FILES['signImage']['type']);
        if ($extension != 1) {
            $signImage = $hash."-signImage.".$extension;
            move_uploaded_file($_FILES['signImage']['tmp_name'],$IMAGES_PATH.$signImage);
        }
    }
    
    $sql = "INSERT INTO certificates (
        authorId,
        title,
        place,
        year,
        collection,
        category,
        width,
        heigth,
        units,
        inscription,
        technique,
        conservation,
        additionalNotes,
        frontImage,
        reverseImage,
        inscriptionImage,
        signImage,
        hash,
        code_numeration,
        emissionDate,
        emissionDateActualCertificate,
        timestamp,
        othersVertical,
        referenceVertical)
        values(
            '".$_POST['authorId']."',
            '".$_POST['title']."',
            '".$_POST['place']."',
            '".$_POST['year']."',
            '".$_POST['collection']."',
            '".$_POST['category']."',
            '".$_POST['width']."',
            '".$_POST['heigth']."',
            '".$_POST['units']."',
            '".$_POST['inscription']."',
            '".$_POST['technique']."',
            '".$_POST['conservation']."',
            '".$_POST['additionalNotes']."',
            '".$frontImage."',
            '".$reverseImage."',
            '".$inscriptionImage."',
            '".$signImage."',
            '".$hash."',
            '".$_POST['code_numeration']."',
            '".$_POST['emissionDate']."',
            '".$_POST['emissionDateActualCertificate']."',
            '".$timestamp."',
            '".$_POST['othersVertical']."',
            '".$_POST['referenceVertical']."')";
            
    $res = mysqli_query($conn, $sql);
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Vertical - Gallery</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <?php require("includes/sections/navBar.php"); ?>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
            <?php require("includes/sections/navBarMobile.php"); ?>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <?php require("includes/sections/breadCrumb.php"); ?>
            <!-- END BREADCRUMB-->

            
            <!-- STATISTIC-->
            <?php require("includes/sections/statics.php"); ?>
            <!-- END STATISTIC-->

            <!-- LIST-->
            <?php require("includes/sections/certificateList.php"); ?>
            <!-- END LIST-->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2022 Vertical. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/web3/web3.min.js"></script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
    <!-- Web3 JS-->
    <script src="js/ABI/ABI.js"></script>
    <script src="js/contracts.js"></script>
    <script src="js/webSite.js"></script>
    <script src="js/web3.functions.js"></script>

    
</body>

</html>
<!-- end document-->
