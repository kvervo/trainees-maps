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
	li{
		display: inline;
	}
	</style>
  </head>
  <body onload="load()" onunload="GUnload()">
    <div style="color:#6666CC;cursor:pointer;font-family:Arial,Sans-serif,Helvetica;font-size:1.2em;padding-left:14px;text-decoration:none;background:none; height: 15px">
		<ul style="float:right;padding: 0; margin: 5px 0;">
		<li>Новости</li>
		<li>Об AIESEC</li>
		<li>Студентам</li>
		<li>Организациям</li>
		<li>Проекты</li>
		<li>Партнеры</li>
		<li>Пресс-центр</li>
		<li>Контакты</li>
		</ul>
	</div>
  
  
	<div id="header">
		<h1>
		Международная программа стажировок
		</h1>
	</div>

	<div id="content_map">
		<!--<div class="top">
			<a href="">Outgoing</a>
			<a href="">Incoming</a>
			<a href="">All</a>
		</div>-->
		<div id="map"></div>
		<div class="bottom">
			<span class="results"></span>
			<span class="map_info">
			<img src="images/user_02.png" alt="Outgoing Traineerships" />Исходящие Стажировки
			<img src="images/user_01.png" alt="Incoming Traineerships" />Входящие Стажировки
			</span>
		</div>
	</div>
	
	<div id="content_trainees">
		<table>
			<tr>
				<th></th>
				<th>Имя</th>
				<th>Страна</th>
				<th>Продолжительность</th>
				<th>Компания</th>
			</tr>
<?
$query  = "SELECT * FROM aiesec_trainees";
$result = mysql_query($query);
$count = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$type = $row['type']=='out' ? 'out' : 'in';
	if($count%2!=0){
	echo "<tr class=\"color\">
			<td><img src=\"images/{$type}_white.png\" alt=\"{$type}\"></td>
			<td><a href=\"http://www.aiesec.spb.ru/students/trainees/tr{$row['id']}\" title=\"{$row['name']}\">{$row['name']}</a></td>" .
	        "<td>{$row['address']} </td>" . 
    	    "<td>{$row['period']}</td>".
			"<td>{$row['company']}</td>".
		 "</tr>";
	}
	else{
	echo "<tr>
			<td><img src=\"images/{$type}.png\" alt=\"{$type}\"></td>
			<td><a href=\"http://www.aiesec.spb.ru/students/trainees/tr{$row['id']}\" title=\"{$row['name']}\">{$row['name']}</a></td>" .
			"<td>{$row['address']} </td>" . 
			"<td>{$row['period']}</td>".
			"<td>{$row['company']}</td>".
		"</tr>";
	}
	if($count == 5) break;
	$count++;
} 

mysql_close($connection);

?>
	
		</table>
	<a href="http://www.aiesec.spb.ru/students/trainees/2" title="Test PAge">Trainee page</a>
	</div>
	<div id="footer"></div>
	<div id="copyright">&copy;2005 - 2009 AIESEC SPUEF</div>
  </body>
</html>
