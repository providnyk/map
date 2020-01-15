@extends($theme . '::layouts.master')

@section('css')
	<link rel="stylesheet" href="{{ asset($theme . '/css/guest_media.css?v=' . $version->css) }}">
@append
