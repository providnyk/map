@extends($theme . '::' . $_env->s_utype . '.master')

@section('title')
{{ mb_strtoupper('Про нас') }}
@endsection

@include('public.partials._profile', ['s_id' => '#signin-form, #signup-form'])

@section('content')

@include($theme . '::' . $_env->s_utype . '._' . $page_slug)

@append

