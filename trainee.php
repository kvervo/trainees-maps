<? include "db.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example: Simple Map</title>
	<link rel="stylesheet" type="text/css" href="http://www.aiesec.spb.ru/assets/templates/aiesec/aiesec.css"/>
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
		<!--<div id="map"></div>-->
	</div>
	
	<div id="content" style="width: 95%">

	<div class="trainee"> 
<img class="left" src="http://www.aiesec.spb.ru/assets/images/trainees/t6_natarova_b.jpg" alt="Татьяна Натарова" /> 
<?

$maps_key = "ABQIAAAA1N0uhIE0lOvk1x-Z98NQ0xS0FirJRzjh69tGiLStguJoPwojcBSvlTazxJaX4WX9-V6yF50Uf5XRCg";
$url 	= $_SERVER["REQUEST_URI"];

$id = substr($url, -1);

$query  = "SELECT lat,lng,address FROM aiesec_trainees WHERE id=".$id;

$result = mysql_query($query);

$row = mysql_fetch_array($result, MYSQL_ASSOC);

echo "<img src=\"http://maps.google.com/staticmap?center={$row['lat']},{$row['lng']}&markers={$row['lat']},{$row['lng']},blue&zoom=4&size=200x200&maptype=hybrid&key={$maps_key}\" class=\"right\" alt=\"{$row['address']}\" />";

mysql_close($connection);

?>
<dl> 
 <dt>Период:</dt> 
  <dd>Июнь 2008&nbsp;&mdash; Август&nbsp;2008</dd> 
 <dt>Тип&nbsp;стажировки:</dt> 
  <dd>Исходящая развивающая&nbsp;стажировка</dd>
 <dt>Страна Стажировки:</dt>
  <dd>Греция</dd> 
 <dt>Страна&nbsp;стажера:</dt> 
  <dd>Россия</dd> 
 <dt>Принимающая&nbsp;компания:</dt> 
  <dd>Skouras&nbsp;Camp</dd> 
 <dt>Занимаемая&nbsp;позиция:</dt> 
  <dd>Вожатый в&nbsp;детском&nbsp;лагере</dd> 
</dl>

<p style="margin-top: 20px" >Я&nbsp;провела 2&nbsp;месяца в&nbsp;Греции, участвуя в&nbsp;DT&nbsp;проекте в&nbsp;<span class="nobr">спортивно-языковом</span> лагере для детей Skouras Camp. В&nbsp;лагерь мы&nbsp;приехали интернациональной командой айсекеров: США, Китай, Тайвань, Россия и&nbsp;наша задача заключалась в&nbsp;том, чтобы помогать персоналу лагеря делать пребывание детей интересным&nbsp;и&nbsp;запоминающимся.</p> 

<p>С&nbsp;первых дней наша жизнь закрутилась, предлагая свои радости и&nbsp;сложности. Для нас лагерь стал настоящим погружением в&nbsp;греческую культуру. Мы&nbsp;жили вместе с&nbsp;греками, старались понять и&nbsp;принять их&nbsp;образ жизни, отношение ко&nbsp;времени и&nbsp;делу, выучить простые фразы для повседневного&nbsp;общения.</p> 

<p>Наш дом в&nbsp;лагере напоминал собой межкультурную деревню, где говорили на&nbsp;нескольких языках, звучала музыка разных стран, играли в&nbsp;греческие тавли и&nbsp;американский бейсбол, плели русские косички и&nbsp;рисовали китайские иероглифы и&nbsp;учились уважать разные&nbsp;культуры.</p> 
 
<p>Греки, как нация, оказались очень открытыми и&nbsp;добросердечными людьми, напоминающие своей хлебосольностью русское гостеприимство. Я&nbsp;встретила в&nbsp;Греции очень хороших людей, как среди коренного населения, так и&nbsp;среди моей&nbsp;команды.</p> 

<p>После завершения работы в&nbsp;лагере, я&nbsp;провела 2 недели в&nbsp;путешествии по&nbsp;стране в&nbsp;компании греков. Мне удалось проехать всю страну с&nbsp;севера на&nbsp;юг: от&nbsp;<span class="nobr">п-ва</span> Халкидики до&nbsp;островов на&nbsp;юге, недалеко от&nbsp;Афин. Нет ничего лучше, чем открывать и&nbsp;познавать страну вместе с&nbsp;её&nbsp;жителями, когда ты&nbsp;наблюдаешь достопримечательности и&nbsp;живешь&nbsp;в&nbsp;культуре!</p> 
<p>Для меня 2&nbsp;месяца моей греческой жизни стали временем познания новой культуры и&nbsp;самой&nbsp;себя.</p>
<img class="left" src="http://www.aiesec.spb.ru/assets/images/trainees/t6_pic1.jpg" alt="pic2" />
<img class="left" src="http://www.aiesec.spb.ru/assets/images/trainees/t6_pic2.jpg" alt="pic1" />
<img class="left" src="http://www.aiesec.spb.ru/assets/images/trainees/t6_pic3.jpg" alt="pic3" />
<p style="clear:both"><a href="http://www.aiesec.spb.ru/beta/maps/">&larr; Назад</a></p>
</div>
	
	
	</div>
	<div id="footer"></div>
	<div id="copyright">&copy;2005 - 2009 AIESEC SPUEF</div>
  </body>
</html>
