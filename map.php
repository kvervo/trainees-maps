<?php 
/*
	eXchange World Map
	URL: http://www.aiesec.spb.ru
	Version: 0.1
	Date: November, 2008
	Author: Mijail Cisneros
	e-mail: mijail.cisneros@aiesec.net
	Browsers: Firefox, Opera, Safari, Seamonkey
	License: GPL v3
*/

include "db.php" ; // Database required file

define("MAPS_HOST", "maps.google.com");
define("KEY", "ABQIAAAA1N0uhIE0lOvk1x-Z98NQ0xS0FirJRzjh69tGiLStguJoPwojcBSvlTazxJaX4WX9-V6yF50Uf5XRCg"); // Google Maps Key API

if(isset($_GET['q'])&&$_GET['q']=='markers')
{	
	XML(); // Retrieve and create an XML data, used for creating the markers on the map
}
elseif(isset($_GET['q']))
{
	info($_GET['q']);
}
elseif(isset($_GET['q'])&&$_GET['q']=='geo')
{
	geocode();
}
else
echo 'done';

function XML(){

	// Select all the rows in the markers table
	$query = "SELECT * FROM aiesec_trainees WHERE 1";
	$result = mysql_query($query);
	if (!$result) {
	  die('Invalid query: ' . mysql_error());
	}

	header("Content-type: text/xml");

	// Start XML file, echo parent node
	echo '<markers>';

	// Iterate through the rows, printing XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
	  // ADD TO XML DOCUMENT NODE
	  echo '<marker ';
	  echo 'id="' . parseToXML($row['id']) . '" ';
	  echo 'name="' . parseToXML($row['name']) . '" ';
	  echo 'address="' . parseToXML($row['address']) . '" ';
	  echo 'lat="' . $row['lat'] . '" ';
	  echo 'lng="' . $row['lng'] . '" ';
	  echo 'type="' . $row['type'] . '" ';
	  echo '/>';
	}

	// End XML file
	echo '</markers>';
}

function parseToXML($htmlStr) 
{ 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
} 

function info($id){

	$query = "SELECT * FROM aiesec_trainees WHERE id=$id";
	$result = mysql_query($query);
	if (!$result) {
	  die('Invalid query: ' . mysql_error());
	}
	$row = @mysql_fetch_assoc($result);
	echo '<div class="estetic_window_info">'.
		'<a href="http://www.aiesec.spb.ru/students/trainees/tr1" title="'.$row[name].'">'.$row['name'].'</a><br/>'.
		'<img src="map2.php?id='.$id.'" style="float:right; margin: 2px 3px 5px 3px; border: 1px solid #d6d6d6; padding: 2px;" width="100px" height="133px" />'.
		'<span style="font-size: 1.1em"><strong>'.$row[address].'</strong><br/>'.
		$row[period].'<br/>'.
		$row[company].'</span>'.
		'<p>'.$row['info'].'</p>'.
		'</div>';
	
}

function photo($foto){
	header( "Content-type: image/png");
    echo $foto;
}


function geocode(){
	// Select all the rows in the markers table
	$query = "SELECT * FROM aiesec_trainees WHERE 1";
	$result = mysql_query($query);
	if (!$result) {
	  die("Invalid query: " . mysql_error());
	}

	// Initialize delay in geocode speed
	$delay = 0;
	$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv&key=" . KEY;

	// Iterate through the rows, geocoding each address
	while ($row = @mysql_fetch_assoc($result)) {
	  $geocode_pending = true;

	  while ($geocode_pending) {
	    $address = $row["address"];
	    $id = $row["id"];
	    $request_url = $base_url . "&q=" . urlencode($address);
	    $csv = file_get_contents($request_url) or die("url not loading");

	    $csvSplit = split(",", $csv);
	    $status = $csvSplit[0];
	    $lat = $csvSplit[2];
	    $lng = $csvSplit[3];
	    if (strcmp($status, "200") == 0) {
	      // successful geocode
	      $geocode_pending = false;
	      $lat = $csvSplit[2];
	      $lng = $csvSplit[3];

	      $query = sprintf("UPDATE aiesec_trainees " .
	             " SET lat = '%s', lng = '%s' " .
	             " WHERE id = %s LIMIT 1;",
	             mysql_real_escape_string($lat),
	             mysql_real_escape_string($lng),
	             mysql_real_escape_string($id));
	      $update_result = mysql_query($query);
	      if (!$update_result) {
	        die("Invalid query: " . mysql_error());
	      }
	    } else if (strcmp($status, "620") == 0) {
	      // sent geocodes too fast
	      $delay += 100000;
	    } else {
	      // failure to geocode
	      $geocode_pending = false;
	      echo "Address " . $address . " failed to geocoded. ";
	      echo "Received status " . $status . "
	\n";
	    }
	    usleep($delay);
	  }
	}
}
?>