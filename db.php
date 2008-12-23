<?
/*
	eXchange World Map
	URL: http://www.aiesec.spb.ru
	Author: Mijail Cisneros
	e-mail: mijail.cisneros@aiesec.net
	Browsers: Firefox, Opera, Safari, Seamonkey
	License: GPL v3
*/

// Get setting for connecting to DB
include "config.php";

// Opens a connection to a MySQL server
$connection = mysql_connect ($host, $username, $password);
if (!$connection)
  die('Not connected : ' . mysql_error());

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected)
  die ('Can\'t use db : ' . mysql_error());

// Convert the connection collation to UTF-8
mysql_query("SET NAMES utf8");

?>