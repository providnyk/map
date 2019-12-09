@extends('layouts.admin')

@section('css')
    @php /*<link rel="stylesheet" href="{{ mix('/admin/css/core/filters.css') }}">
    <link rel="stylesheet" href="{{ mix('/admin/css/core/tables.css') }}">*/@endphp
@endsection

@section('content')

@php
include(getcwd().'/../resources/views/user/menu.php');
@endphp
@include('admin.common._card_group')

@endsection
