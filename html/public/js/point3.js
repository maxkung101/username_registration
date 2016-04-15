function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(40.7451635, -74.7302227),
		zoom:15,
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
}
google.maps.event.addDomListener(window, 'load', initialize);
