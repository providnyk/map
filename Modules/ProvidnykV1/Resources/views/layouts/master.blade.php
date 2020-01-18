@php /*
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Module ProvidnykV1</title>

		 { {-- Laravel Mix - CSS File --} }
		 { {-- <link rel="stylesheet" href="{{ mix('css/providnykV1.css') }}"> --} }

	</head>
	<body>
		@yield('content')

		{ {-- Laravel Mix - JS File --} }
		{ {-- <script src="{{ mix('js/providnykV1.js') }}"></script> --} }
	</body>
</html>
*/@endphp


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') &#60; {!! mb_strtoupper(trans('app.name')) !!}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="version-app" content="{{ $version->app }}">

	@yield('meta')

	<!-- Global stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.formstyler.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.formstyler.theme.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">

	<link rel="stylesheet" href="{{ asset('css/sweet_alert.css?v=' . $version->css) }}">
	<link rel="stylesheet" href="{{ asset('icons/icomoon/styles.css') }}">
	<!-- /global stylesheets -->

	<link rel="stylesheet" href="{{ asset($theme . '/css/' . $_env->s_utype . '_app.css?v=' . $version->css) }}">
	<link rel="stylesheet" href="{{ asset($theme . '/css/tabs.css?v=' . $version->css) }}">

	@yield('css')

	<!-- Global site tag (gtag.js) - Google Analytics -->
	{{--
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146132445-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-146132445-1');
	</script>
	--}}

	<link rel="shortcut icon" href="{!! $theme !!}/img/logo.png" type="image/png">

	@section('script')
	<script type="text/javascript">
	@include('common.var2js')
	</script>
	@append

</head>
<body>
@include($theme . '::' . $_env->s_utype . '.header')

<section
	id="{{ request()->segment(1) == '' ? 'map_screen' : 'custom_page'}}"
	class="{{ request()->segment(1) == '' ? 'general' : request()->segment(1) }}_page"
>
@yield('content')
</section>

@include($theme . '::' . $_env->s_utype . '.footer')

{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{!! asset('/admin/js/main/jquery.min.js') !!}"></script>
--}}

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQueryFormStyler/2.0.2/jquery.formstyler.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="{!! asset('/js/common.js?v=' . $version->js) !!}"></script>

<!-- Optional JavaScript -->
<!-- http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm -->
@if (Cookie::get( config('cookie-consent.cookie_name') ) !== null)
@endif
{{--
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/jquery.formstyler.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('/admin/js/plugins/notifications/sweetalert1.min.js') }}"></script>
--}}
{{-- https://sweetalert.js.org/guides/ --}}
<script src="{{ asset('/admin/js/plugins/notifications/sweetalert2.min.js') }}"></script>
{{--
<script src="{{ asset('/js/app_public.js?v=' . $version->js) }}"></script>
--}}

@yield('js')
@yield('script')

<script src="{{ asset($theme . '/js/' . $_env->s_utype . '_app.js?v=' . $version->js) }}"></script>


</body>
</html>
