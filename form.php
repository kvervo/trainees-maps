<?php

if(isset($_POST['submit']) && $_FILES['photo']['size'] > 0)
{
$fileName = $_FILES['photo']['name'];
$tmpName  = $_FILES['photo']['tmp_name'];
$fileSize = $_FILES['photo']['size'];
$fileType = $_FILES['photo']['type'];

$name 		= $_POST['name'];
$address 	= $_POST['address'];
$info 		= $_POST['info'];
$type 		= $_POST['type'];
$period 	= $_POST['period'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

include "db.php";

$query = "INSERT INTO aiesec_trainees ( name, address, type, id_photo, info, filetype, period) VALUES ('$name','$address','$type','$content','$info','$fileType', '$period')";


mysql_query($query) or die('Error, query failed '. mysql_error()); 
//include 'library/closedb.php';

echo "<br>File $fileName uploaded<br>";
} 
?>