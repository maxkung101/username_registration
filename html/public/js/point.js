function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(30, 0),
		zoom:2,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		backgroundColor: '#ffffff',
		mapTypeControl: false,
		scaleControl: false,
		zoomControl: false,
		keyboardShortcuts: false,
		disableDoubleClickZoom: false,
		draggable: false,
		scrollwheel: false,
		streetViewControl: false,
		noClear: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.TOP,
			mapTypeIds: [
				google.maps.MapTypeId.ROADMAP,
				google.maps.MapTypeId.SATELLITE
			]
		},
		disableDefaultUI: false,
		navigationControl: false,
		navigationControlOptions: {
			style: google.maps.NavigationControlStyle.ZOOM_PAN,
			position: google.maps.ControlPosition.TOP_RIGHT
		}
	};
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	var pos = new google.maps.LatLng(40.6641154, -74.5183064);
	var infowindow = new google.maps.InfoWindow({
		map: map,
		position: pos,
		content: '<a href="area.html">New Jersey</a>'
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
