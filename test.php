<?

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

include 'db.php';

$query = "INSERT INTO aiesec_trainees_files (name, size, type, content ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

mysql_query($query) or die('Error, query failed'); 
$id = mysql_insert_id();

mysql_close($connection);

echo "<p>File $fileName uploaded</p>ID = $id";

}
else{

echo '
<form method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr> 
	<td>
	Photo:	
	</td>
	<td width="246">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
	<input name="userfile" type="file" id="userfile"> 
	</td>
	
</tr>
<tr>	
	<td>
	Name:	
	</td>
	<td>
	<input type="text" name="Name" />
	</td>
</tr>

<tr>	
	<td>
	Surname:
	</td>
	<td>
	<input type="text" name="Surname" />
	</td>
</tr>


<tr>	
	<td>
	Address:
	</td>
	<td>
	<input type="text" name="Address" />
	</td>
</tr>

<tr>	
	<td>
	Type:
	</td>	
	<td>
	<input type="text" name="Type" />
	</td>
</tr>

<tr>	
	<td>
	Info:
	</td>	
	<td>
	<textarea name="Info"></textarea>
	</td>
</tr>

<tr>
	<td width="80">
	<input name="upload" type="submit" class="box" id="upload" value=" Save ">
	</td>
</tr>
</table>
</form>';



}
?>
