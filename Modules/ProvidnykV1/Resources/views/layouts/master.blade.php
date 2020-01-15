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
	<link rel="stylesheet" href="{{ asset('icons/icomoon/styles.css') }}">
	<!-- /global stylesheets -->

	<link rel="stylesheet" href="{{ asset($theme . '/css/' . $_env->s_utype . '_app.css?v=' . $version->css) }}">

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

@yield('content')

@include($theme . '::' . $_env->s_utype . '.footer')

@yield('js')
@yield('script')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jQueryFormStyler/2.0.2/jquery.formstyler.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	<script src="{{ asset($theme . '/js/' . $_env->s_utype . '_app.js?v=' . $version->js) }}"></script>


</body>
</html>
