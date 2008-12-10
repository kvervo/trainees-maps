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

//
// Defining Variables
//
var map = null; // The Map Object
var mManager = null; // Markers Manager Object
var geocoder = null; // The Geocoder Object
var batch = [];
//var gMarkers = []; 

//
// Creation of a base icon
//
var baseIcon = new GIcon(G_DEFAULT_ICON);
baseIcon.image = "images/user_01.png";
baseIcon.shadow = "";
baseIcon.iconSize = new GSize(13, 23);
//baseIcon.shadowSize = new GSize(37, 34);
baseIcon.iconAnchor = new GPoint(7, 23);
baseIcon.infoWindowAnchor = new GPoint(7, 12);
//var markerOptions = {draggable: true};


// Creates the map when the page finishes loading
function load() {
    if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
		map.setCenter(new GLatLng(25, 10), 2);
		map.addControl(new GSmallMapControl());
		map.setMapType(G_NORMAL_MAP);
        window.setTimeout(setupMarkers, 0);
	}
}
	
// Setups the Markers on the map, using the XML data retrieved from map.php
function setupMarkers(){
	mManager = new MarkerManager(map);
	
	GDownloadUrl("map.php?q=markers", function(data) {
			var xml = GXml.parse(data);
			var markers = xml.documentElement.getElementsByTagName("marker");
			for (var i = 0; i < markers.length; i++) {
				var name = markers[i].getAttribute("name");
				var id = markers[i].getAttribute("id");
				var address = markers[i].getAttribute("address");
				var type = markers[i].getAttribute("type");
				var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
									parseFloat(markers[i].getAttribute("lng")));
				var marker = createMarker(point, name, address, type, id);
				batch.push(marker);//map.addOverlay(marker);
			}
			//GEvent.addListener(map, 'extinfowindowclose', function(){ map.panTo(new GLatLng(25, 10)); });
			mManager.addMarkers(batch,0,17);
			mManager.refresh();
        });
}
	
// Creation of a single Marker on the map
function createMarker(point, name, address, type, id) {
    markerOptions = { icon:baseIcon };
	var marker = new GMarker(point, markerOptions);
    var html = "<b>" + name + "</b> <br/>" + address;
    GEvent.addListener(marker, 'click', function() {
		marker.openExtInfoWindow(
		   map,
		   "estetic_window",
		   "<div id=\"info\"></div>",
		   /*"<img src=\"images/ajax-loader.gif\" alt=\"Loading\" />",*/
		   {
			ajaxUrl: "map.php?q="+id,
			beakOffset: 3
			}
		);
    });
	
    return marker;
}