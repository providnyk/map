@extends($theme . '::' . $_env->s_utype . '.master')

@php
include(base_path().'/resources/views/guest/crud.php');
@endphp

@section('title')
{{ mb_strtoupper(trans('user/form.text.' . request()->segment(1))) }}
@endsection

@include('public.partials._profile', ['s_id' => '#addplace-form'])

@section('script')
<script type="text/javascript">
@include('admin.common.data2js')
</script>
@append

@section('content')

        <div id="main_map" style="display:none;" data-zoom="16">
            <div class="marker" data-lat="50.405388" data-lng="30.3341461" data-icon="/{!! $theme !!}/img/map_markers/map_marker_bank.png"></div>
            <div class="marker" data-lat="50.4066782" data-lng="30.3410947" data-icon="/{!! $theme !!}/img/map_markers/map_marker_bank.png"></div>
            <div class="marker" data-lat="50.4063072" data-lng="30.3283194" data-icon="/{!! $theme !!}/img/map_markers/map_marker_wc.png"></div>
            <div class="marker" data-lat="50.4040143" data-lng="30.3339627" data-icon="/{!! $theme !!}/img/map_markers/map_marker_atm.png"></div>
        </div>


        <div class="map_info_block">
            <div id="map_search" style="display:none;">
                <input type="text" placeholder="Поиск" name="s" />
                <button type="button" class="gotosearch"></button>
                <button type="button" class="findme" id="findme_btn"></button>
            </div>
            <div id="mib_content" class="visible_anytime">
                <div class="new_place_wrap">

{{--
						<form action="{!! route('guest.place_save') !!}" method="POST" class="form-page item-form" id="create-place-form">
--}}
							@php
								$code				= NULL;
								$s_category			= 'place';
								$o_item				= $$s_category;

								$a_fields_regular					= [];
								$a_fields_regular['building_id']	= 'select';
								$a_fields_regular['lat']			= 'input';
								$a_fields_regular['lng']			= 'input';

								$a_fields_trans						= [];
								$a_fields_trans['title']			= 'input';
								$a_fields_trans['address']			= 'input';
								$a_fields_trans['description']		= 'input';
							@endphp

						<form action="{!! route('api.'.$s_category.'.store') !!}" method="POST" class="form-page item-form" id="create-place-form">
							@csrf


							@include('user._fields_loop', ['a_fields' => $a_fields_regular,])
{{--
							@include('layouts._form_control', ['control' => 'select', 'name'=>'building_id'])

							@include($theme . '::' . $_env->s_utype . '._form_select', ['name'=>'building_id'])

							@include('layouts._form_control', ['control' => 'input', 'name'=>'lat'])
							@include('layouts._form_control', ['control' => 'input', 'name'=>'lng'])
--}}
							@foreach($localizations as $code => $localization)
								@include('user._fields_loop', ['a_fields' => $a_fields_trans,])
							@endforeach
							@php ($code = NULL) @endphp
{{--
							@foreach($localizations as $code => $localization)
								@include('layouts._form_control', ['control' => 'input', 'name'=>'title'])
								@include('layouts._form_control', ['control' => 'input', 'name'=>'annotation'])
								@include('layouts._form_control', ['control' => 'input', 'name'=>'description'])
								@include('layouts._form_control', ['control' => 'input', 'name'=>'address'])
							@endforeach
							@php ($code = NULL) @endphp

                   <div class="field_row">
                       <label for="">местоположение</label>
                       <input type="text" class="address_field" placeholder="местоположение" value="Киев, улица Симона Петлюры, 1" />
                   </div>
                   <div class="field_row">
                       <label for="">название</label>
                       <input type="text" placeholder="название" value="Станция метро Университет" />
                   </div>
                   <div class="field_row">
                       <label for="">тип</label>
                       <select name="" id="">
                           <option value="Пандус">Пандус</option>
                           <option value="Пандус2">Пандус2</option>
                           <option value="Пандус3">Пандус3</option>
                       </select>
                   </div>

                   <div class="field_row">
                       <label for="">КАЧЕСТВО ИЗГОТОВЛЕНИЯ</label>
                       <input type="text" placeholder="КАЧЕСТВО ИЗГОТОВЛЕНИЯ" value="" />
                   </div>
                   <div class="field_row">
                       <label for="">МАТЕРИАЛ ИЗГОТОВЛЕНИЯ</label>
                       <input type="text" placeholder="МАТЕРИАЛ ИЗГОТОВЛЕНИЯ" value="Металл" />
                   </div>
                   <div class="field_row">
                       <label for="">состояние</label>
                       <input type="text" placeholder="состояние" value="Частично доступно для кресел-каталок" />
                   </div>
--}}




                    <div class="buttons">

{{--
@include('layouts._form_control', ['control' => 'image', 'name' => 'image_ids'])
--}}

{{--
                        <div id="image-preview"></div>
                        <div class="attach">
                            <label for="image-upload" id="image-label">Прикрепить фото</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
--}}
							<div class="buttons">
								<button type="submit" class="confirm">{!! trans('personal::guest.button.add_new_place') !!}</button>
							</div>

                        <div class="divider"></div>
                    </div>




						</form>


                </div>

            </div>
        </div>
{{--

							<div class="user_fields">

								<div class="item">
									<span class="label">
										{!! trans('user/form.field.email') !!}
									</span>
									<span class="value">
										<input type="email" class="form-control"  placeholder="" name="email">
									</span>
								</div>

@include($theme . '::' . $_env->s_utype . '._recaptcha', ['id' => 'create-place'])

							</div>

							<div class="buttons">
								<button type="submit" class="confirm">{!! trans('personal::guest.button.add_new_place') !!}</button>
							</div>
						</form>
--}}
@append

@section('css')
	@yield('css-checkbox')
	@yield('css-image')
	@yield('css-input')
	@yield('css-select')
@endsection

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jQueryFormStyler/2.0.2/jquery.formstyler.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpiBWpweBNNC0OULC4g-aAvVdS38Ccdu8"></script>
@append

@section('js')
	@yield('js-checkbox')
	@yield('js-image')
	@yield('js-input')
	@yield('js-select')
	<script src="{{ asset('/admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script src="{{ asset('/admin/js/plugins/ui/moment/moment_locales.min.js') }}"></script>
	<script src="{!! asset('/admin/js/forms.js?v=' . $version->js) !!}"></script>
@append

@section('script')
	@yield('script-checkbox')
	@yield('script-image')
	@yield('script-input')
	@yield('script-select')

  <script type="text/javascript">
          function initMap( $el ) {
              var $markers = $el.find('.marker');
              var mapArgs = {
                  zoom        : $el.data('zoom') || 16,
                  mapTypeId   : google.maps.MapTypeId.ROADMAP
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