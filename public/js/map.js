function initMap( $el ) {
	var $markers = $el.find('.marker');
	var mapArgs = {
		zoom				: $el.data('zoom') || 16,
		mapTypeId	 : google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map( $el[0], mapArgs );
	map.markers = [];
	$markers.each(function(){
		initMarker( $(this), map );
	});
	centerMap( map );
	$('#findme_btn').bind('click', function() {
		findMe(map);
	});
	var styles = [
		{
			"featureType": "administrative",
			"elementType": "geometry",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "poi",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "road",
			"elementType": "labels.icon",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "transit",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		}
	];
	map.setOptions({styles: styles});
	return map;
}

function initMarker( $marker, map ) {
	var lat = $marker.data('lat');
	var lng = $marker.data('lng');
	var latLng = {
		lat: parseFloat( lat ),
		lng: parseFloat( lng )
	};
	var marker = new google.maps.Marker({
		position : latLng,
		map: map,
		icon: $marker.data('icon')
	});
	map.markers.push( marker );
	google.maps.event.addListener(marker, 'click', function() {
		alert("Вы кликнули на маркер "+lat+" "+lng+" В консоли вывел параметры маркера. Цепляйте на него нужные события)");
		console.log(marker);
	});
}

function centerMap( map ) {
	var bounds = new google.maps.LatLngBounds();
	map.markers.forEach(function( marker ){
		bounds.extend({
			lat: marker.position.lat(),
			lng: marker.position.lng()
		});
	});
	if( map.markers.length == 1 ){
		map.setCenter( bounds.getCenter() );
	} else{
		map.fitBounds( bounds );
	}
}

function findMe( map ) {
	findMeMarker = new google.maps.InfoWindow;
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			findMeMarker.setPosition(pos);
			findMeMarker.setContent('<div class="myplacemarker"><span class="ov1"></span><span class="ov2"></span><span class="ov3"></span><span class="ov4"></span></div>');
			findMeMarker.open(map);
			map.setCenter(pos);
		}, function() {
			alert('Error: The Geolocation service failed.');
		});
	} else {
		alert('Error: Your browser doesn\'t support geolocation.');
	}
}

$(document).ready(function(){
	 var map = initMap( $('#main_map') );
});