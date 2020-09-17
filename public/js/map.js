a_locations						= [];
var a_directions_routes		= [];
var i_directions_routes		= 0;
var request						= {};

// https://developers.google.com/maps/documentation/javascript/reference/directions#DirectionsRendererOptions.directions
var directionsRenderer		= new google.maps.DirectionsRenderer({
										draggable: true,
										hideRouteList: true
									});

$('#build_directions').on('click', function (e) {
	e.preventDefault();
//console.log(e, $(this));

	var $this = $(this);
	$this.addClass('disabled').prop("disabled",true);
	submitForm();

//	$('body').toggleClass('sidebar-xs').removeClass('sidebar-mobile-main');
//	revertBottomMenus();

	$this.removeClass('disabled').prop("disabled",false);
});

function showSelectedRoute( i_number )
{
	$('#div_routes_variants_wrap').removeClass('d-none');
	$('.div_routes_variants').removeClass('active');
	$('#div_routes_variants_' + i_number).addClass('active');
	$('.div_directions_panel_wrap').removeClass('d-none');
//	$('#main_map').addClass('with_directions');
	directionsRenderer.setPanel($('#div_directions_panel')[0]);
	directionsRenderer.setRouteIndex(i_number);
}

function resetRoutes( directionsRenderer )
{
//console.log(i_directions_routes);
	if (i_directions_routes > 0)
	{
		/**
		 *	in case when re-drawing is needed after manually changing start/end point with drag'n'drop enabled
		 *
		 *	https://stackoverflow.com/questions/41999828/google-maps-api-v3-directions-with-draggable-alternate-routes
		 */
		for (var j = 0; j < i_directions_routes; j++) {
//			a_directions_routes[j].setMap(null);
//			directionsRenderer.setMap(null);
//			directionsRenderer({directions: null});
//			directionsRenderer.setDirections({routes: null});
		}
//		$('#div_routes_variants').remove('.div_routes_variants');
	}
	$('.div_directions_panel_wrap').addClass('d-none');
	$('#main_map').removeClass('with_directions');
	directionsRenderer.setMap(null);
	$('.div_routes_variants').remove();
	$('#div_routes_variants_wrap').addClass('d-none');
}

function initClusterer( map )
{
	var a_params = {
		maxZoom:					16,
		minimumClusterSize:	5,
		styles: [{
			width:				55,
			height:				56,
			textColor:			"#F15C2D",
			textSize:			16,
			url:					"/" + s_theme + "/img/map_clusters/m1.svg",
		}],
	};
	var markerCluster = new MarkerClusterer(map, a_locations, a_params);
}

function initMap( el )
{
	var markers = []; //el.find('.marker');

	// TODO: refactor and make a common component
	var mapArgs = {
		zoom:		el.data('zoom') || 11,
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
			length: i_places_qty,
			filters: { published: 1 },
		},
		success: (data, status, xhr) => {
			if (xhr.readyState == 4 && xhr.status == 200)
				try {
					// Do JSON handling here
					tmp = JSON.parse(xhr.responseText);
//console.log(tmp.data.length);
					for (var i = 0; i < tmp.data.length; i++)
					{
//console.log(i, typeof tmp.data[i].rating_info, tmp.data[i].rating_info);
						initMarkerFromJSON(tmp.data[i], map);
					}
				} catch(e) {
					//JSON parse error, this is not json (or JSON isn't in the browser)
					notify(s_servererror_info, 'danger', 3000);
				}
			else
				notify(s_servererror_info, 'danger', 3000);
			initClusterer(map);
			$('.map_preloader_wrap').hide();
		},
		'error': (xhr) => {
			notify(s_servererror_info, 'danger', 3000);
		}
	});

	centerMap( map, el.data('lat'), el.data('lng') );

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

function getColor( i_percent )
{
	s_color = 'black';
	if (i_percent > 70)
	{
		s_color = 'green';
	}
	else if (i_percent > 35)
	{
		s_color = 'chocolate';
	}
	else if (i_percent > -1)
	{
		s_color = 'red';
	}
	return s_color;
}

function initMarkerFromJSON( data, map )
{
	var lat			= data.lat;
	var lng			= data.lng;
	var a_lat_lng	= {
		lat: parseFloat( lat ),
		lng: parseFloat( lng )
	};

	var s_rating	= '';
	var i_overall	= -1;
	var s_overall	= '';
	var s_latest	= '';
	var s_details	= '';
	if (typeof data.rating_info != "string")
		return 0;

//console.log(data.rating_info);

	try {
		// Do JSON handling here
		o_rating = JSON.parse(data.rating_info);
	} catch(e) {
//console.log('err parsing id=' + data.id);
		//JSON parse error, this is not json (or JSON isn't in the browser)
	}
//console.log(typeof o_rating);
	i_overall		= data.rating_all;

	if (typeof o_rating == 'object')
	{
		if (typeof o_rating.overall.description == "string")
			s_overall	= o_rating.overall.description;
		if (typeof o_rating.overall.details == "string")
			s_details	= o_rating.overall.details;
		if (typeof o_rating.overall.latest_opinion == "string")
			s_latest	= o_rating.overall.latest_opinion;

		for(i = 0; i < o_rating.element.length; i++)
		{
			i_percent	= o_rating['element'][i]['percent'];
			s_color		= getColor(i_percent);
			s_rating		= s_rating
							+ '<p style="color: ' + s_color + ';">'
							+ o_rating['element'][i]['description']
							+ '</p>'
						;
		}
	}

	var s_color		= getColor(i_overall);

	var s_marker_icon = '/' + s_theme + '/img/map_markers/map_marker_bank_' + s_color + '.png';

	var marker		= new google.maps.Marker({
		position: a_lat_lng,
		map: map,
		icon: s_marker_icon,
		title: data.title,
	});

	a_locations.push(marker);

	marker.addListener('click', function() {

			a_params = {
				reverseButtons:		true,
				showCloseButton:	true,
				html: 				''
						+ '<p class="place_title">' + data.title + '</p>'
						+ '<p class="place_latest_opinion">' + s_latest + '</p>'
						+ '<hr>'
						+ '<p class="place_address">' + data.address + '</p>'
						+ '<p class="place_description">' + data.description + '</p>'
						+ '<p class="rating_overall" style="color: ' + s_color + ';">' + s_overall + '</p>'
						+ '<p class="rating_details" style="color: ' + s_color + ';">' + s_details + '</p>'
						,
				footer:				s_rating,
			};
			a_routes = {};

			if (s_text_secondary != '')
			{
				a_params.cancelButtonText	= s_text_secondary;
				a_params.showCancelButton	= true;
				s_route_secondary = s_route_secondary.replace(':type', 'place').replace(':id', data.id);
			}

			if (s_text_extra != '')
			{
				if (typeof data.url !== 'undefined')
					s_route_extra = data.url;
				a_params.footer = '<a href="' + s_route_extra + '">' + s_text_extra + '</a>';
			}
			if (s_text_primary != '')
			{
				a_params.confirmButtonText = s_text_primary;
				s_route_primary = s_route_primary.replace(':type', 'place').replace(':id', data.id);
			}

			// we need colourful footer here so have to use another type of sweetalert2
			Swal.fire(
				a_params
			).then((result) => {
				if (result.value) {
					if (s_route_primary != '')
						window.location.href = s_route_primary;
					else
						resetForm(form);
				} else if (result.dismiss === Swal.DismissReason.cancel) {
					if (s_route_secondary != '')
						window.location.href = s_route_secondary;
					else
						resetForm(form);
				}
			})
			;

	});
	map.markers.push( marker );
}

function centerMap( map, f_lat, f_lng )
{
	var o_lat_lng = new google.maps.LatLng(f_lat, f_lng);
	map.setCenter(o_lat_lng);
}

function showDirectionsForm()
{
	$('.i_switch_directions').on('click', function (e) {
		e.preventDefault();
	//console.log(e, $(this));

		var $this = $(this);
		$('.i_switch_directions').toggle();
		$('#mib_content .filters').toggle();
	});
}

function findMe( map )
{
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
		alert('Error: Your browser doesn’t support geolocation.');
	}
}

$(document).ready(function()
{
	map = initMap( $('#main_map') );
	$('form.google_maps_direction').on('submit', fnAutocompleteAddress);
//	console.log(map);
	showDirectionsForm();
});

//       google.maps.event.addDomListener(window, 'load', initAutocomplete);
google.maps.event.addDomListener(window, 'load', initializeAutocompleteAddress);

fnAutocompleteAddress = function(e){
	e.preventDefault();

	let form	= $(e.currentTarget),
		url	=  form.attr('action'),
		type	= form.attr('method'),
		data	= form.serialize();

	var latitude = form.find('input[name="latitude"]').val();
	var longitude = form.find('input[name="longitude"]').val();

	var a_lat_lng	= {
		lat: parseFloat( latitude ),
		lng: parseFloat( longitude )
	};

	var marker		= new google.maps.Marker({
		position: a_lat_lng,
		map: map,
//		icon: s_marker_icon,
//		title: data.title,
	});

	marker.setVisible(true);

	centerMap( map, latitude, longitude );
	map.setZoom(17);

//		console.log(form, url, type, data, latitude, longitude, map);

//const proxyurl = "https://cors-anywhere.herokuapp.com/";
// /const pointurl = 'https://maps.googleapis.com/maps/api/directions/jsonp?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyDgGLLNSEPwyhZk5RvbSwOx85wtd4ASDuc';

/*
get_ajax_data(pointurl);
	let headers = new Headers();

//    headers.append('Content-Type', 'application/json');
	headers.append('Accept', 'application/json');
	headers.append('Authorization', 'Basic ' + base64.encode(username + ":" +  password));
	headers.append('Origin','http://pr.max');

	fetch(pointurl, {
		mode: 'no-cors',
//        mode: 'cors',
//        credentials: 'include',
		method: 'GET',
		headers: headers
	})
	.then(response => response.json())
	.then(json => console.log(json))
	.catch(error => console.log('Authorization failed : ' + error.message));


/*
const url = "https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyDgGLLNSEPwyhZk5RvbSwOx85wtd4ASDuc"; // site that doesn’t send Access-Control-*
fetch(url)
.then(response => response.text())
.then(contents => console.log(contents))
.catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))

	$.ajax({
		'type': 'get',
		'url': proxyurl + pointurl,
		success: (data, status, xhr) => {
			console.log(data, status, xhr);
		},
		'error': (xhr) => {
			console.log(xhr);
			notify(xhr, 'danger', 3000);
		}
	});
*/


}


   async function get_ajax_data(pointurl){
	   var _reprojected_lat_lng = await $.ajax({
//   function get_ajax_data(){
//       var _reprojected_lat_lng = $.ajax({
	mode: 'no-cors',
								type: 'GET',
								dataType: 'jsonp',
								data: {},
								url: pointurl,
								success: function (data) {
									console.log(data);

									// note: data is already json type, you
									//       just specify dataType: jsonp
									return data;
								},
								error: function (jqXHR, textStatus, errorThrown) {
									console.log(jqXHR)
								},
							});


 } // function

function initializeAutocompleteAddress() {
	//Restrict Country in Google Autocomplete Address
	var options = {
		componentRestrictions: {country: "UA"}
	};

//var input = document.getElementById('autocomplete');
//   var input = $('#autocomplete')[0];
		submitForm();

		$("input[name='travel_mode']").change(function(){
			submitForm();
		});

		$('.google_maps_autocomplete').each(function(i, elem){

			let
				$elem				= $(elem),
				autocomplete	= new google.maps.places.Autocomplete(elem, options),
				lat				= $elem.parent().find('.lat'),
				lng				= $elem.parent().find('.lng')
			;

//$('#'+s_parent_id).find("."+s_child_id).remove();

//			console.log($elem.parent(), elem, lat.val(), lng.val());

			/**
			 *	clean coordinates if place selection is emptied
			 */
			$elem.change(function() {
				if ($elem.val() == '')
				{
					$(lat).val('');
					$(lng).val('');
				}
				checkRequiredFields();
			});


			autocomplete.addListener('place_changed', function() {
				var place		= autocomplete.getPlace();
//console.log(place.geometry);
				$(lat).val(place.geometry['location'].lat());
				$(lng).val(place.geometry['location'].lng());

				// --------- show lat and long ---------------
//				$("#lat_area").removeClass("d-none");
//				$("#long_area").removeClass("d-none");
				checkRequiredFields();
			});

		});

//   var input = $('.google_maps_autocomplete')[0];
}

//       function initAutocomplete(data) {
//       	console.log(data)
//       }

	function submitForm() {
		resetRoutes( directionsRenderer );
		res		= checkRequiredFields();
		if (Object.keys(res).length > 0)
		{
			var directionsService		= new google.maps.DirectionsService();

		//	directionsRenderer.setPanel(document.getElementById('directionsPanel'));

		//	var onChangeHandler = function() {
				calculateAndDisplayRoute(directionsService);
		//	};


		/*
			document.getElementById('start').addEventListener('change', onChangeHandler);
			document.getElementById('end').addEventListener('change', onChangeHandler);
			document.getElementById('mode').addEventListener('change', onChangeHandler);
		*/

//			$('#build_directions').trigger('click');
		}
	}


	function checkRequiredFields() {

		request = {
			origin: {query: $('#lat_from').val() + ',' + $('#lng_from').val()},
			destination: {query: $('#lat_to').val() + ',' + $('#lng_to').val()},
			//travelMode: google.maps.TravelMode[$('#mode').val()],
			travelMode: $('input[name=travel_mode]:checked').val(),
//			travelMode: $('#mode').val(),
			provideRouteAlternatives: true,
		};
//console.log(request.origin.query, request.destination.query, request.travelMode, (request.origin.query != ',' && request.destination.query != ',' && request.travelMode != ''));
		if (request.origin.query != ',' && request.destination.query != ',' && typeof request.travelMode != 'undefined')
		{
			$('#build_directions').removeClass('disabled').prop("disabled",false);
		}
		else
		{
			$('#build_directions').addClass('disabled').prop("disabled",true);
			request = {};
		}
		return request;
	}



	function calculateAndDisplayRoute(directionsService) {
//console.log('calculateAndDisplayRoute');
//console.log(request);

		directionsService.route(
			request,
			function(response, status) {
//console.log(response);
				switch(status) {
					case 'OK':

					directionsRenderer.setMap(map);

					i_directions_routes = response.routes.length;
					for (var i = 0, len = response.routes.length; i < len; i++) {
						$('#div_routes_variants')
							.append('<a href="" data-number="' + i + '" class="div_routes_variants" id="div_routes_variants_' + i + '">' + (i+1) + '</a>')
						;
/*
						var directionsDisplay = new google.maps.DirectionsRenderer({
							map: map,
							directions: response,
							routeIndex: i
						});
						notify(response.routes[i].legs[0].distance.text + ' ' + response.routes[i].legs[0].duration.text, 'success', 7000);
						if(typeof response.routes[i].warnings === "object")
						{
							response.routes[i].warnings.forEach((msg) => {
								notify(msg, 'warning', 12000);
							});
						}
*/
//						a_directions_routes.push(directionsDisplay);
					}

						var fnListRouteSwitch = function(e) {
							e.preventDefault();
							var $this					= $(this);
							var i_selected_route		= $this.data('number');
							showSelectedRoute(i_selected_route);
						};
						$('.div_routes_variants').click('change', fnListRouteSwitch);

// directions route number in the set of results
//var tmp = 0;
//directionsRenderer.setRouteIndex(0);

/*
						var directionsDisplay = new google.maps.DirectionsRenderer({
							map: map,
							directions: response,
							draggable: true
						});
*/
//console.log(response);
						directionsRenderer.setDirections(response);
						showSelectedRoute(0);
//						$('#div_routes_variants_0').trigger('click');
						//directionsRenderer.setDirections({directions: response,draggable: true});
					break;
					case 'ZERO_RESULTS':
						notify('No directions ' + status, 'info', 3000);
					break;
					default:
						notify('Directions request failed due to ' + status, 'danger', 3000);
				}
			});
	  }
