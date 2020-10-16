@php
$s_category = 'place';
#include(base_path().'/resources/views/guest/crud.php');

$s_tmp								= request()->route()->getAction()['as'];
$a_tmp								= explode('.', $s_tmp);
#$s_category					= mb_strtolower($a_tmp[1]);

$s_form_route					= mb_strtolower($a_tmp[1]).'.'.mb_strtolower($a_tmp[2]);
$s_utype							= $a_tmp[0];

$s_create_route				= route($s_utype.'.'.$s_form_route);
$s_cancel_route				= route($s_utype . '.personal.activity');
$s_list_route					= route($s_utype . '.personal.activity');
$s_opinion_route			= route($s_utype . '.opinion.form', [':type', ':id']);

$s_btn_primary				= '';
$s_route_primary			= '';
$s_btn_secondary			= trans('common/form.actions.evaluate');
$s_route_secondary		= $s_opinion_route;
$s_btn_extra					= '';
$s_route_extra				= '';

$f_map_center_lat			= 50.45466;
$f_map_center_lng			= 30.5238;
$i_map_zoom						= 11;
$i_places_qty					= 10000;

if (config('app.env') == 'local')
{
	$f_map_center_lat		= 50.458295;
	$f_map_center_lng		= 30.599699;
	$i_map_zoom					= 13;
	$i_places_qty				= 50;
}

@endphp
@section('script')
	<script type="text/javascript">
	let google_map_key				= '{!! config('services.google.map.key') !!}'
		,s_route_list						= '{!! route('api.'.$s_category.'.index') !!}'
//		,s_track_add						= '{!! route('api.track.store') !!}'
		,s_servererror_info			= '{!! trans('user/session.text.server_err_info') !!}'
		,s_theme								= '{!! $theme !!}'

		,s_text_extra						= '{!! $s_btn_extra !!}'
		,s_route_extra					= '{!! $s_route_extra !!}'
		,s_text_primary					= '{!! $s_btn_primary !!}'
		,s_route_primary				= '{!! $s_route_primary !!}'
		,s_text_secondary				= '{!! $s_btn_secondary !!}'
		,s_route_secondary			= '{!! $s_route_secondary !!}'
		,s_close_route					= '{!! $s_cancel_route !!}'

		,i_places_qty						= '{!! $i_places_qty !!}'
		;
	</script>
@append
@section('js')
	<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key={!! config('services.google.map.key') !!}&language={{ config('app.locale') }}&libraries=places" type="text/javascript"></script>
	<script src="/js/map.js?v={!! $version->js !!}" type="text/javascript"></script>
	<script src="{{ asset('/admin/js/plugins/ui/moment/moment_locales.min.js') }}"></script>
	<script src="{!! asset('/admin/js/forms.js?v=' . $version->js) !!}"></script>
@append



{{-- https://loading.io/spinner/earth/-earth-globe-map-rotate --}}
<div class="map_preloader_wrap">
	<div class="map_preloader_spinner">
		<img src="/images/spinner_earth.svg" width="120" height="120" />
	</div>
</div>

<div id="main_map" data-zoom="{!! $i_map_zoom !!}" data-lat="{!! $f_map_center_lat !!}" data-lng="{!! $f_map_center_lng !!}"></div>

<div class="map_info_block">

	<div class="div_directions_switch">
		<i class="i_switch_directions icon-shrink"></i>
		<i class="i_switch_directions icon-enlarge"></i>
	</div>

	<div id="mib_content">
		<div class="filters directions">
		<form class="google_maps_direction" action="{!! route('api.track.store') !!}" method="POST">
			<ul>
				<li>
					<input type="radio" name="travel_mode" value="TRANSIT" id="directions_bus" />
					<label for="directions_bus">
						<i class="icon-bus"></i>
						<span>{!! trans('personal::guest.button.mode_transit') !!}</span>
					</label>
				</li>
				<li>
					<input type="radio" name="travel_mode" value="WALKING" id="directions_footprint" />
					<label for="directions_footprint">
						<i class="icon-footprint"></i>
						<span>{!! trans('personal::guest.button.mode_walking') !!}</span>
					</label>
				</li>
				<li>
					<input type="radio" name="travel_mode" value="BICYCLING" id="directions_bike" />
					<label for="directions_bike">
						<i class="icon-bike"></i>
						<span>{!! trans('personal::guest.button.mode_bicycling') !!}</span>
					</label>
				</li>
			</ul>

			<div class="map_search">
				<input type="text" class="google_maps_autocomplete" placeholder="Відсюди" id="{!! $app->getLocale() !!}_from_address" name="{!! $app->getLocale() !!}[from_address]" value="{{ (config('app.env') == 'local') ? 'Позняки, Київ, Україна' : ''}}" />
				<input type="hidden" id="from_lat" name="from_lat" class="lat" value="{{ (config('app.env') == 'local') ? '50.4086678' : ''}}" />
				<input type="hidden" id="from_lng" name="from_lng" class="lng" value="{{ (config('app.env') == 'local') ? '30.62840660000001' : ''}}" />
				<button type="button" class="gotosearch"></button>
		{{--
				<button type="button" class="findme" id="findme_btn"></button>
		--}}
			</div>
			<div class="map_search">
				<input type="text" class="google_maps_autocomplete" placeholder="Досюди" id="{!! $app->getLocale() !!}_to_address" name="{!! $app->getLocale() !!}[to_address]" value="{{ (config('app.env') == 'local') ? 'вулиця Єлизавети Чавдар, 7, Київ, Україна' : ''}}" />
				<input type="hidden" id="to_lat" name="to_lat" class="lat" value="{{ (config('app.env') == 'local') ? '50.3936141' : ''}}" />
				<input type="hidden" id="to_lng" name="to_lng" class="lng" value="{{ (config('app.env') == 'local') ? '30.6226939' : ''}}" />
				<button type="button" class="gotosearch"></button>
			</div>

			<div>
				<input type="hidden" id="request_raw" name="request_raw" value="" />
				<input type="hidden" id="response_raw" name="response_raw" value="" />
				<input type="hidden" id="response_status" name="response_status" value="" />
				<input type="hidden" id="route_qty" name="route_qty" value="" />
				<input type="hidden" id="route_selected" name="route_selected" value="" />
				<input type="hidden" id="length" name="length" value="" />
				<input type="hidden" id="time" name="time" value="" />
				<input type="hidden" id="{!! $app->getLocale() !!}_title" name="{!! $app->getLocale() !!}[title]" value="" />
			</div>

			<div class="buttons">
				<button type="submit" class="confirm" id="build_directions">
					{!! trans('personal::guest.button.build_directions') !!}
				</button>
				<div id="div_routes_variants_wrap" class="d-none">
					<div id="div_routes_variants"></div>
				</div>
			</div>
		</form>
		<div class="div_directions_panel_wrap d-none">
			<div id="div_directions_panel"></div>
		</div>
		</div>
	</div>

{{--
<form class="google_map_autocomplete" action="/" method="POST">
	<div class="container mt-5">
		<div class="row">
			<div class="col-xl-12 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
				<div class="card shadow">
					<div class="card-header bg-primary">
						<h5 class="card-title text-white"> Google Autocomplete Address</h5>
					</div>

					<div class="card-body">
						<div class="form-group">
							<label for="autocomplete"> Location/City/Address </label>
							<input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Select Location">
						</div>

						<div class="form-group d-none" id="lat_area">
							<label for="latitude"> Latitude </label>
							<input type="text" name="latitude" id="latitude" class="form-control">
						</div>

						<div class="form-group d-none" id="long_area">
							<label for="latitude"> Longitude </label>
							<input type="text" name="longitude" id="longitude" class="form-control">
						</div>
					</div>

					<div class="card-footer">
					<button type="submit" class="btn btn-success"> Submit </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>



    <div id="floating-panel">
    <b>Start: </b>
    <select id="start">
      <option value="50.4501,30.5234">Kyiv</option>
      <option value="st louis, mo">St Louis</option>
      <option value="joplin, mo">Joplin, MO</option>
      <option value="oklahoma city, ok">Oklahoma City</option>
      <option value="amarillo, tx">Amarillo</option>
      <option value="gallup, nm">Gallup, NM</option>
      <option value="flagstaff, az">Flagstaff, AZ</option>
      <option value="winona, az">Winona</option>
      <option value="kingman, az">Kingman</option>
      <option value="barstow, ca">Barstow</option>
      <option value="san bernardino, ca">San Bernardino</option>
      <option value="los angeles, ca">Los Angeles</option>
    </select>
    <b>End: </b>
    <select id="end">
      <option value="chicago, il">Chicago</option>
      <option value="50.4153964,30.69359919999999">Darnitsa</option>
      <option value="joplin, mo">Joplin, MO</option>
      <option value="oklahoma city, ok">Oklahoma City</option>
      <option value="amarillo, tx">Amarillo</option>
      <option value="gallup, nm">Gallup, NM</option>
      <option value="flagstaff, az">Flagstaff, AZ</option>
      <option value="winona, az">Winona</option>
      <option value="kingman, az">Kingman</option>
      <option value="barstow, ca">Barstow</option>
      <option value="san bernardino, ca">San Bernardino</option>
      <option value="los angeles, ca">Los Angeles</option>
    </select>
		<strong>Mode of Travel: </strong>
		<select id="mode">
		  <option value="DRIVING">Driving</option>
		  <option value="WALKING">Walking</option>
		  <option value="BICYCLING">Bicycling</option>
		  <option value="TRANSIT">Transit</option>
		</select>
		</div>
--}}

{{--
	<div id="map_search" style="display:none;" >
		<input type="text" placeholder="Поиск" name="s" />
		<button type="button" class="gotosearch"></button>
		<button type="button" class="findme" id="findme_btn"></button>
	</div>
	<div id="mib_content" style="display:none;" >
		<div class="filters">
			<ul>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_1" />
					<label for="sdsdf_1">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_shipping.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_shipping_white.png"> <span>Shopping</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_2" checked />
					<label for="sdsdf_2">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_food.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_food_white.png"> <span>Food & Drinks</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_3" />
					<label for="sdsdf_3">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_health.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_health_white.png"> <span>Health</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_4" />
					<label for="sdsdf_4">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_transport.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_transport_white.png"> <span>Transport</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_5" />
					<label for="sdsdf_5">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_leisure.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_leisure_white.png"> <span>Leisure</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_6" />
					<label for="sdsdf_6">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_hotels.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_hotels_white.png"> <span>Hotels</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_7" />
					<label for="sdsdf_7">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_tourism.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_tourism_white.png"> <span>Tourism</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_8" />
					<label for="sdsdf_8">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_education.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_education_white.png"> <span>Education</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_9" />
					<label for="sdsdf_9">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_autorities.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_autorities_white.png"> <span>Authorities</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_10" />
					<label for="sdsdf_10">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_money.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_money_white.png"> <span>Money</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_11" />
					<label for="sdsdf_11">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_sport.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_sport_white.png"> <span>Sport</span>
					</label>
				</li>
				<li>
					<input type="radio" name="filters" value="sdsdf" id="sdsdf_12" />
					<label for="sdsdf_12">
						<img class="img_blue" src="/{!! $theme !!}/img/markers/marker_toilets.png" /><img class="img_white" src="/{!! $theme !!}/img/markers/marker_toilets_white.png"> <span>Toilets</span>
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
								<span class="marker green"><img src="/{!! $theme !!}/img/markers/marker_invalid.png" /></span> <span class="text"><b>Доступно</b> для кресел-каталок</span>
							</label>
						</div>
						<div class="item">
							<input type="radio" name="subfilters_row_1" value="sbfr_1_v_2" id="sbfr_1_v_2" />
							<label for="sbfr_1_v_2">
								<span class="marker orange"><img src="/{!! $theme !!}/img/markers/marker_invalid.png" /></span> <span class="text"><b>Частично доступно</b> для кресел-каталок</span>
							</label>
						</div>
						<div class="item">
							<input type="radio" name="subfilters_row_1" value="sbfr_1_v_3" id="sbfr_1_v_3" />
							<label for="sbfr_1_v_3">
								<span class="marker red"><img src="/{!! $theme !!}/img/markers/marker_invalid.png" /></span> <span class="text"><b>Не доступно</b> для кресел-каталок</span>
							</label>
						</div>
					</li>
					<li>
						<div class="item">
							<input type="radio" name="subfilters_row_2" value="sbfr_2_v_1" id="sbfr_2_v_1" checked />
							<label for="sbfr_2_v_1">
								<span class="marker green"><img src="/{!! $theme !!}/img/markers/marker_babycar.png" /></span> <span class="text"><b>Доступно</b> для колясок</span>
							</label>
						</div>
						<div class="item">
							<input type="radio" name="subfilters_row_2" value="sbfr_2_v_2" id="sbfr_2_v_2" />
							<label for="sbfr_2_v_2">
								<span class="marker orange"><img src="/{!! $theme !!}/img/markers/marker_babycar.png" /></span> <span class="text"><b>Частично доступно</b> для колясок</span>
							</label>
						</div>
						<div class="item">
							<input type="radio" name="subfilters_row_2" value="sbfr_2_v_3" id="sbfr_2_v_3" />
							<label for="sbfr_2_v_3">
								<span class="marker red"><img src="/{!! $theme !!}/img/markers/marker_babycar.png" /></span> <span class="text"><b>Не доступно</b> для колясок</span>
							</label>
						</div>
					</li>
					<li>
						<div class="item">
							<input type="radio" name="subfilters_row_3" value="sbfr_3_v_1" id="sbfr_3_v_1" checked />
							<label for="sbfr_3_v_1">
								<span class="marker green"><img src="/{!! $theme !!}/img/markers/marker_transport_white.png" /></span> <span class="text"><b>Доступно</b> для парковок</span>
							</label>
						</div>
						<div class="item">
							<input type="radio" name="subfilters_row_3" value="sbfr_3_v_2" id="sbfr_3_v_2" />
							<label for="sbfr_3_v_2">
								<span class="marker orange"><img src="/{!! $theme !!}/img/markers/marker_transport_white.png" /></span> <span class="text"><b>Частично доступно</b> для парковок</span>
							</label>
						</div>
						<div class="item">
							<input type="radio" name="subfilters_row_3" value="sbfr_3_v_3" id="sbfr_3_v_3" />
							<label for="sbfr_3_v_3">
								<span class="marker red"><img src="/{!! $theme !!}/img/markers/marker_transport_white.png" /></span> <span class="text"><b>Не доступно</b> для парковок</span>
							</label>
						</div>
					</li>
				</ul>
			</div>
		</div>

	</div>
--}}
</div>

