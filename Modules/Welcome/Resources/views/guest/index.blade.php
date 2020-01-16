@extends($theme . '::' . $_env->s_utype . '.master')

@section('content')
	<div id="main_map" data-zoom="16">
		<div class="marker" data-lat="50.405388" data-lng="30.3341461" data-icon="{!! $theme !!}/img/map_markers/map_marker_bank.png"></div>
		<div class="marker" data-lat="50.4066782" data-lng="30.3410947" data-icon="{!! $theme !!}/img/map_markers/map_marker_bank.png"></div>
		<div class="marker" data-lat="50.4063072" data-lng="30.3283194" data-icon="{!! $theme !!}/img/map_markers/map_marker_wc.png"></div>
		<div class="marker" data-lat="50.4040143" data-lng="30.3339627" data-icon="{!! $theme !!}/img/map_markers/map_marker_atm.png"></div>
	</div>

	<div class="map_info_block">
		<div id="map_search">
			<input type="text" placeholder="Поиск" name="s" />
			<button type="button" class="gotosearch"></button>
			<button type="button" class="findme" id="findme_btn"></button>
		</div>
		<div id="mib_content">
			<div class="filters">
				<ul>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_1" />
						<label for="sdsdf_1">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_shipping.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_shipping_white.png"> <span>Shopping</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_2" checked />
						<label for="sdsdf_2">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_food.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_food_white.png"> <span>Food & Drinks</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_3" />
						<label for="sdsdf_3">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_health.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_health_white.png"> <span>Health</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_4" />
						<label for="sdsdf_4">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_transport.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_transport_white.png"> <span>Transport</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_5" />
						<label for="sdsdf_5">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_leisure.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_leisure_white.png"> <span>Leisure</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_6" />
						<label for="sdsdf_6">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_hotels.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_hotels_white.png"> <span>Hotels</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_7" />
						<label for="sdsdf_7">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_tourism.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_tourism_white.png"> <span>Tourism</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_8" />
						<label for="sdsdf_8">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_education.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_education_white.png"> <span>Education</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_9" />
						<label for="sdsdf_9">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_autorities.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_autorities_white.png"> <span>Authorities</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_10" />
						<label for="sdsdf_10">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_money.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_money_white.png"> <span>Money</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_11" />
						<label for="sdsdf_11">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_sport.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_sport_white.png"> <span>Sport</span>
						</label>
					</li>
					<li>
						<input type="radio" name="filters" value="sdsdf" id="sdsdf_12" />
						<label for="sdsdf_12">
							<img class="img_blue" src="{!! $theme !!}/img/markers/marker_toilets.png" /><img class="img_white" src="{!! $theme !!}/img/markers/marker_toilets_white.png"> <span>Toilets</span>
						</label>
					</li>
				</ul>
			</div>


			<div class="subfilters">
				<div class="scroll_wrap">
					<ul>
						<li>
							<div class="item">
								<input type="radio" name="subfilters_row_1" value="sbfr_1_v_1" id="sbfr_1_v_1"	checked />
								<label for="sbfr_1_v_1">
									<span class="marker green"><img src="{!! $theme !!}/img/markers/marker_invalid.png" /></span> <span class="text"><b>Доступно</b> для кресел-каталок</span>
								</label>
							</div>
							<div class="item">
								<input type="radio" name="subfilters_row_1" value="sbfr_1_v_2" id="sbfr_1_v_2" />
								<label for="sbfr_1_v_2">
									<span class="marker orange"><img src="{!! $theme !!}/img/markers/marker_invalid.png" /></span> <span class="text"><b>Частично доступно</b> для кресел-каталок</span>
								</label>
							</div>
							<div class="item">
								<input type="radio" name="subfilters_row_1" value="sbfr_1_v_3" id="sbfr_1_v_3" />
								<label for="sbfr_1_v_3">
									<span class="marker red"><img src="{!! $theme !!}/img/markers/marker_invalid.png" /></span> <span class="text"><b>Не доступно</b> для кресел-каталок</span>
								</label>
							</div>
						</li>
						<li>
							<div class="item">
								<input type="radio" name="subfilters_row_2" value="sbfr_2_v_1" id="sbfr_2_v_1" checked />
								<label for="sbfr_2_v_1">
									<span class="marker green"><img src="{!! $theme !!}/img/markers/marker_babycar.png" /></span> <span class="text"><b>Доступно</b> для колясок</span>
								</label>
							</div>
							<div class="item">
								<input type="radio" name="subfilters_row_2" value="sbfr_2_v_2" id="sbfr_2_v_2" />
								<label for="sbfr_2_v_2">
									<span class="marker orange"><img src="{!! $theme !!}/img/markers/marker_babycar.png" /></span> <span class="text"><b>Частично доступно</b> для колясок</span>
								</label>
							</div>
							<div class="item">
								<input type="radio" name="subfilters_row_2" value="sbfr_2_v_3" id="sbfr_2_v_3" />
								<label for="sbfr_2_v_3">
									<span class="marker red"><img src="{!! $theme !!}/img/markers/marker_babycar.png" /></span> <span class="text"><b>Не доступно</b> для колясок</span>
								</label>
							</div>
						</li>
						<li>
							<div class="item">
								<input type="radio" name="subfilters_row_3" value="sbfr_3_v_1" id="sbfr_3_v_1" checked />
								<label for="sbfr_3_v_1">
									<span class="marker green"><img src="{!! $theme !!}/img/markers/marker_transport_white.png" /></span> <span class="text"><b>Доступно</b> для парковок</span>
								</label>
							</div>
							<div class="item">
								<input type="radio" name="subfilters_row_3" value="sbfr_3_v_2" id="sbfr_3_v_2" />
								<label for="sbfr_3_v_2">
									<span class="marker orange"><img src="{!! $theme !!}/img/markers/marker_transport_white.png" /></span> <span class="text"><b>Частично доступно</b> для парковок</span>
								</label>
							</div>
							<div class="item">
								<input type="radio" name="subfilters_row_3" value="sbfr_3_v_3" id="sbfr_3_v_3" />
								<label for="sbfr_3_v_3">
									<span class="marker red"><img src="{!! $theme !!}/img/markers/marker_transport_white.png" /></span> <span class="text"><b>Не доступно</b> для парковок</span>
								</label>
							</div>
						</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
@endsection

@section('js')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpiBWpweBNNC0OULC4g-aAvVdS38Ccdu8"></script>
@append

@section('script')
	<script type="text/javascript">

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
	</script>
@append