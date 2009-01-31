<? include "db.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example: Simple Map</title>
	<link rel="stylesheet" type="text/css" href="/assets/templates/aiesec/aiesec.css"/>
	<link rel="stylesheet" type="text/css" href="info.css"/>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA1N0uhIE0lOvk1x-Z98NQ0xS0FirJRzjh69tGiLStguJoPwojcBSvlTazxJaX4WX9-V6yF50Uf5XRCg"
           ></script>
	<script src="http://gmaps-utility-library.googlecode.com/svn/trunk/markermanager/release/src/markermanager.js"></script>
	<script src="http://gmaps-utility-library.googlecode.com/svn/trunk/extinfowindow/release/src/extinfowindow.js"></script>
    <script type="text/javascript" src="maps.js"></script>
	<style>
		
	</style>
  </head>
  <body onload="load()" onunload="GUnload()">
    
	<div id="header">
		<h1>
		Международная программа стажировок
		</h1>
	</div>

	<div id="content_map">
		<div id="map"></div>
	</div>
	
	<div id="content_trainees">
		<table>
			<tr>
				<th>Type</th>
				<th>Name</th>
				<th>Country of origin</th>
				<th>Period of Time</th>
				<th>Company</th>
			</tr>
<?
$query  = "SELECT * FROM aiesec_trainees";
$result = mysql_query($query);
$count = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	echo "<tr>
			<td>{$row['type']}</td>
			<td>{$row['name']} </td>" .
         "<td>{$row['address']} </td>" . 
         "<td></td>".
		 "<td></td>".
		 "</tr>";
	if($count == 5) break;
	$count++;
} 

mysql_close($connection);

?>
	
		</table>
	</div>	
  </body>
</html>