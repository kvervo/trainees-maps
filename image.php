<?php
/*
	eXchange World Map
	URL: http://www.aiesec.spb.ru
	Author: Mijail Cisneros
	e-mail: mijail.cisneros@aiesec.net
	Browsers: Firefox, Opera, Safari, Seamonkey
	License: GPL v3
*/


include "db.php" ;

$query = "SELECT id_photo, filetype FROM aiesec_trainees where id=".$_GET['id'];
$result = mysql_query($query);
//$foto = mysql_fetch_assoc($result);

$foto = mysql_result($result,0,"id_photo");
$type = mysql_result($result,0,"filetype");

header( "Content-type: $type");
echo $foto;

?>