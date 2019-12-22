@extends('layouts.admin')

@section('css')
    @php /*<link rel="stylesheet" href="{{ mix('/admin/css/core/filters.css') }}">
    <link rel="stylesheet" href="{{ mix('/admin/css/core/tables.css') }}">*/@endphp
@endsection

@section('content')

@php
include(base_path().'/resources/views/user/menu.php');
@endphp
@include('admin.common._card_group')

<div style="display:block; clear:both;">
@foreach ($cnt AS $s_name => $s_val)
<br />{!! $s_val !!}: {!! $s_name !!}
@endforeach
</div>

@endsection
