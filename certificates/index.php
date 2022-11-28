<?php
error_reporting(0);
require("includes/conn.php");
if (!$_REQUEST['hash']) {
	echo "Invalid hash";
	exit;
}
$sql = "SELECT * FROM certificates WHERE hash='".$_GET['hash']."'";
$res = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($res);
if ($rows < 1) {
	echo "Invalid hash";
	exit;
}
$dat = mysqli_fetch_array($res);

$sql2 = "SELECT name,lastName,email FROM authors WHERE authorId='".$dat['authorId']."'";
$res2 = mysqli_query($conn, $sql2);
$dat2 = mysqli_fetch_array($res2);

$imgPath = "http://45.55.243.107/web3/vertical/repository/certificates/images/";
?>
<html>


<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Vertical :: Certificado de Arte ::</title>
</head>

<body>
<span style="color: rgb(0, 0, 0); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 700; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none; background-color: rgb(255, 255, 255)">
<table border="0" width="65%" height="25" align=center>
	<tr>
		<td height="25" width="17%" valign="middle">
		
		<font size="2"><strong>C&oacute;digo / Numeraci&oacute;n</strong></font></td>
		<td height="25" width="82%" valign="middle"><font size="2"><strong><?php echo $dat['code_numeration'] ?></strong></font></td>
	</tr>
	<tr>
		<td height="25" width="17%" valign="middle"><font size="2"><strong>Ref. VERTICAL</strong></font></td>
		<td height="25" width="82%" valign="middle"><font size="2"><strong><?php echo $dat['referenceVertical'] ?></strong></font></td>
	</tr>
	<tr>
		<td height="25" width="99%" valign="middle" colspan="2">
		<p align="right">Sociedad de Arte<br>
		<b><font size="8">Vertical</font></b></td>
	</tr>
</table>

<table border="0" width="65%" height="25" align=center>
	<tr>
		<td height="25" width="99%" valign="middle">
		<p align="center"><b>CERTIFICADO DE AUTENTICIDAD DE OBRA DE ARTE</b></td>
	</tr>
</table>
<table border="0" width="65%" height="25" align=center>
	<tr>
		<td height="25" width="99%" valign="middle">
		<font size="2"><p align="center">El presente documento CERTIFICA que la obra titulada <?php echo $dat['title'] ?>
		de autoria de <?php echo $dat2['name']?>&nbsp;<?php echo $dat2['lastName']; ?> (<?php echo $dat['year'] ?>)<br> constituye una pieza &uacute;nica, 
		original y aut&eacute;ntica, la misma se describe seg&uacute;n el siguiente detalle t&eacute;cnico:</p></font>
&nbsp;</td>
	</tr>
</table>
<div align="center">
<table border="1" width="65%" height="25" bordercolor="#000000" style="border-collapse: collapse">
	<tr>
		<td height="300" width="34%" valign="middle" rowspan="10">
		<?php
			if ($dat['frontImage']) {
				?>
					<img src="<?php echo $imgPath.$dat['frontImage'] ?>" width=300 height="300">
				<?php
			}
		?>
		</td>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Autor</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat2['name']?>&nbsp;<?php echo $dat2['lastName']; ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Titulo</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['title'] ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Lugar y A&ntilde;o</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['place'].", ".$dat['year']; ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Colecci&oacute;n / Serie</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['collection'] ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Categoria</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['category'] ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Dimensi&oacute;n</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['width']." x ".$dat['heigth']." ".$dat['units']; ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Inscripci&oacute;n</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['inscription'] ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">T&eacute;cnica y Soporte</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['technique'] ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Estado de Conservaci&oacute;n</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['conservation'] ?></font></td>
	</tr>
	<tr>
		<td height="30" width="18%" valign="middle">
		<p style="margin-left: 4px"><font size="2">Notas</font></td>
		<td height="30" width="48%" valign="middle">
		<p style="margin-left: 4px"><font size="2"><?php echo $dat['additionalNotes'] ?></font></td>
	</tr>
</table>
</div>
<br>
<div align="center">
<table border="1" width="65%" height="382" style="border-collapse: collapse" bordercolor="#000000">
	<tr>
		<td height="282" width="50%" valign="middle">
		<p align="center">
		<?php
			if ($dat['reverseImage']) {
				?>
					<img src="<?php echo $imgPath.$dat['reverseImage'] ?>" width=300 height="300">
				<?php
			}
		?>
		</p>
		</td>
		<td height="282" width="50%" valign="middle">
		<p align="center">
			<?php
			if ($dat['inscriptionImage']) {
				?>
					<img src="<?php echo $imgPath.$dat['inscriptionImage'] ?>" width=300 height="300">
				<?php
			}
			?>
		</p>
		</td>
	</tr>
</table>
</div>
<br>
<div align="center">
<table border="1" width="65%" height="204" style="border-collapse: collapse" bordercolor="#000000">
	<tr>
		<td height="143" width="43%" valign="top">
		<p style="margin-left: 6px" align="center"><font size="1">El artista abajo firmante acredita mediante este certificado que la obra 
		en menci&oacute;n constituye una obra &uacute;nica, original y aut&eacute;ntica de autor&iacute;a de 
		<?php echo $dat2['name']?>&nbsp;<?php echo $dat2['lastName']; ?>. Todos los derechos de autor y reproducci&oacute;n están 
		reservados por el artista.-</font></p>
		<p align="center">
		<?php
			if ($dat['signImage']) {
				?>
					<img src="<?php echo $imgPath.$dat['signImage'] ?>" width=200 height="100">
				<?php
			}
			?>

		</p>
		</td>
		<td height="204" width="15%" valign="top" rowspan="2">
		<p align="center">
		<img border="0" src="page1.1.jpg"><font size="1"><br>
		<br>
		Mercado del Arte <br>
		Responsable</font></p>
		<p align="center"><font size="1">Sociedad del Arte</font></p>
		<p align="center"><font size="2">VERTICAL</font></td>
		<td height="204" width="42%" valign="middle" rowspan="2">
		<p align="left" style="margin-left: 6px"><font size="1">El presente certificado ha sido 
		emitido formalmente por VERTICAL SOCIEDAD DEL ARTE, de conformidad con 
		los protocolos y procedimientos internos, basados en est&aacute;ndares de 
		calidad y transparencia; la informaci&oacute;n consignada ha sido la 
		proporcionada por el Artista/Experto Certificador. VERTICAL SOCIEDAD DEL 
		ARTE no intervino en los procesos de creaci&oacute;n, revisi&oacute;n ni 
		autentificaci&oacute;n de la obra aqu&iacute; certificada, los cuales fueron de 
		exclusiva autoria del Artista/Experto certificador.</font></td>
	</tr>
	<tr>
		<td height="62" width="40%" valign="middle">
		<p align="center"><?php echo $dat2['name']?>&nbsp;<?php echo $dat2['lastName']; ?></td>
		</tr>
</table>
</div>
<br>
<div align="center">
<table border="1" width="65%" height="39" style="border-collapse: collapse" bordercolor="#000000">
	<tr>
		<td height="41" width="17%" valign="middle">
		<p style="margin-left: 4px"><b><font size="1">C&oacute;digo / Numeraci&oacute;n</font></b></td>
		<td height="41" width="15%" valign="middle">
		<p style="margin-left: 4px"><font size="1"><?php echo $dat['code_numeration'] ?></font></td>
		<td height="41" width="13%" valign="middle">
		<p style="margin-left: 4px"><b><font size="1">Hash</font></b></td>
		<td height="41" width="41%" valign="middle">
		<p style="margin-left: 4px"><font size="1"><?php echo $dat['hash'] ?></font></td>
		<td height="105" width="13%" valign="middle" rowspan="3">
		<p align="center"><img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=http://45.55.243.107/web3/vertical/certificates/?hash=<?php echo $_REQUEST['hash'] ?>&choe=UTF-8"></td>
	</tr>
	<tr>
		<td height="41" width="17%" valign="middle">
		<p style="margin-left: 4px"><b><font size="1">Fecha emisi&oacute;n Original</font></b></td>
		<td height="41" width="15%" valign="middle">
		<p style="margin-left: 4px"><font size="1"><?php echo $dat['emissionDate'] ?></font></td>
		<td height="41" width="13%" valign="middle">
		<p style="margin-left: 4px"><b><font size="1">TimeStamp</font></b></td>
		<td height="41" width="41%" valign="middle">
		<p style="margin-left: 4px"><font size="1"><?php echo $dat['timestamp'] ?></font></td>
	</tr>
	<tr>
		<td height="42" width="17%" valign="middle">
		<p style="margin-left: 4px"><b><font size="1">Fecha emisi&oacute;n de versi&oacute;n 
		actual certificado</font></b></td>
		<td height="42" width="15%" valign="middle">
		<p style="margin-left: 4px"><font size="1"><?php echo $dat['emissionDateActualCertificate'] ?></font></td>
		<td height="42" width="13%" valign="middle">
		<p style="margin-left: 4px"><b><font size="1">Otros Vertical</font></b></td>
		<td height="42" width="41%" valign="middle">
		<p style="margin-left: 4px"><font size="1"><?php echo $dat['othersVertical'] ?></font></td>
	</tr>
</table>
</span>
<font size="1">
<span style="color: rgb(0, 0, 0); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none; background-color: rgb(255, 255, 255)">

<br>

Copyright 2022 - VERTICAL _ SOCIARTE _ S.A.S todos los derechos reservados. VERTICAL _ SOCIEDAD _ DEL _ ARTE _ es una marca registrada.
<br>
&nbsp;</span></font><table border="1" width="65%" height="53" style="border-collapse: collapse" bordercolor="#000000">
	<tr>
		<td height="53" width="33%" valign="middle" align="center">
			<font size="1">
				<span style="color: rgb(0, 0, 0); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none; background-color: rgb(255, 255, 255)">
					<a href="http://www.verticalarte.com">www.verticalarte.com</a> <br>
		info@verticalarte.com
				</span>
			</font>
		</td>
		<td height="53" width="33%" valign="middle" align="center">
			<font size="1">
				<span style="color: rgb(0, 0, 0); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none; background-color: rgb(255, 255, 255)">
					Calle Numa Pompillo Llona No.142 <br>
		Barrio Las Penas - Guayaquil, Ecuador
				</span>
			</font>




		</td>
		<td height="53" width="34%" valign="middle" align="center">




<span style="color: rgb(0, 0, 0); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none; background-color: rgb(255, 255, 255)">
		<font size="1">Powered by VERTICAL</font></span></td>
	</tr>
</table>
</font>
</div>
<p>
</span>




</p>




</body>

</html>