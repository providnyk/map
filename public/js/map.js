a_locations = [];
function initClusterer( map ) {
	var a_params = {
		maxZoom: 				16,
		minimumClusterSize: 	5,
		styles: [{
			width: 				55,
			height: 			56,
			textColor: 			"#F15C2D",
			textSize: 			16,
			url: 				"/providnykV1/img/map_clusters/m1.svg",
		}],
	};
	var markerCluster = new MarkerClusterer(map, a_locations, a_params);
}
function initMap( el ) {
	var markers = []; //el.find('.marker');
//console.log(el.find('.marker'));
	// TODO: refactor and make a common component

	var mapArgs = {
		zoom:		el.data('zoom') || 11,
//		zoom:		11,
		mapTypeId:	google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map( el[0], mapArgs );
	map.markers = [];

	// get list of markers for map
	// async'ly so that
	// visitors don't have to wait loooooog while page loads
	// with all the data pre-inserted to the page
	// also notify about errors
	$.ajax({
		'type': 'get',
		'url': s_route_list,
		data: {
			length: 10000,
			filters: { published: 1 },
		},
		success: (data, status, xhr) => {
			if (xhr.readyState == 4 && xhr.status == 200)
				try {
					// Do JSON handling here
					tmp = JSON.parse(xhr.responseText);
					for (var i = 0; i < tmp.data.length; i++)
					{
						initMarkerFromJSON(tmp.data[i], map);
					}
				} catch(e) {
					//JSON parse error, this is not json (or JSON isn't in the browser)
					notify(s_servererror_info, 'danger', 3000);
				}
			else
				notify(s_servererror_info, 'danger', 3000);
			initClusterer(map);
		},
		'error': (xhr) => {
			notify(s_servererror_info, 'danger', 3000);
		}
	});

//	markers.each(function(){
//		initMarker( $(this), map );
//	});

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

function initMarkerFromJSON( data, map ) {
	var lat			= data.lat;
	var lng			= data.lng;
	var a_lat_lng	= {
		lat: parseFloat( lat ),
		lng: parseFloat( lng )
	};

	var rating		= '';
	var overall		= -1;

	if (typeof data.rating == 'object'
		&& typeof data.rating.element == 'object'
		&& typeof data.rating.overall == 'object'
		&& typeof data.rating.overall.percent == 'number'
		)
	{
		var tmp			= data.rating;

		rating			= rating + '\n\n' + tmp.overall.description;
		overall			= tmp.overall.percent;

		for(i = 0; i < tmp.element.length; i++)
			rating	= rating + '\n\n' + tmp['element'][i];
	}

	var icon = '/providnykV1/img/map_markers/map_marker_bank_bw.png';
	if (overall > 70)
	{
		icon = '/providnykV1/img/map_markers/map_marker_bank_green.png';
	}
	else if (overall > 35)
	{
		icon = '/providnykV1/img/map_markers/map_marker_bank_yellow.png';
	}
	else if (overall > 0)
	{
		icon = '/providnykV1/img/map_markers/map_marker_bank_red.png';
	}

	var marker		= new google.maps.Marker({
		position: a_lat_lng,
		map: map,
		icon: icon,
		title: data.title,
	});


	a_locations.push(marker);

	marker.addListener('click', function() {

			var a_buttons = {};
			data['url'] = '';

			if (s_text_secondary != '')
			{
				a_buttons['secondary'] = {
					text: s_text_secondary,
					className: "btn-light",
				};
			}

			if (s_text_extra != '')
				a_buttons['extra'] = {
					text: s_text_extra,
					className: "btn-light",
				};

			if (s_text_primary != '')
			{
				a_buttons['primary'] = {
					text: s_text_primary,
					className: "btn-primary",
				};
				s_route_primary = s_route_primary.replace(':type', 'place').replace(':id', data.id);
			}

//swal("Gotcha!", "Pikachu was caught!", "success");

			swal({
				icon: "info",
				title: data.title,
				text: data.address + '\n\n' + data.description + rating,
				buttons: a_buttons,
			}).then((reaction) => {

				switch (reaction) {

					case 'extra':
						if (s_route_extra != '')
							window.location.href = s_route_extra;
						else
							resetForm(form);
					break;
					case 'secondary':
						if (typeof data.url === 'undefined')
							window.location.href = s_route_secondary;
						else
							window.location = data.url;
					break;
					case 'primary':
						if (s_route_primary != '')
							window.location.href = s_route_primary;
						else
							resetForm(form);
					break;

					default:
//						if (s_close_route != '')
//							window.location.href = s_route_list;
//						else
//							resetForm(form);
				}

			});

//		infowindow.open(map, marker);
	});
	map.markers.push( marker );
}
/*
function initMarkerFromHTML( $marker, map ) {
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
*/
function centerMap( map ) {
	map.setCenter( new google.maps.LatLng(50.45466, 30.5238) );
return 0;
/*
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
*/
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