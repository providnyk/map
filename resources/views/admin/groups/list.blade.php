@extends('layouts.admin')

@php
include(getcwd().'/../resources/views/user/crud.php');
@endphp

@section('title-icon')<i class="{!! trans('user/' . $s_category . '.names.ico') !!} mr-2"></i>@endsection

@section('title'){!! $s_title !!}@endsection

@section('breadcrumbs')
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
				@include('admin.common._breadcrumb_home')
                <span class="breadcrumb-item active">{!! $s_title !!}</span>
            </div>
            <a href="{!! route('admin.'.$s_category) !!}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ mix('/admin/css/list/list.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/admin/js/plugins/sliders/ion_rangeslider.min.js') }}"></script>
    <script src="{{ asset('/admin/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/admin/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>
    <script src="{{ asset('/admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('/admin/js/plugins/ui/moment/moment_locales.min.js') }}"></script>
    <script src="{{ asset('/admin/js/plugins/pickers/daterangepicker.js') }}"></script>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            let s_route_del = '{!! route('api.'.$s_category.'.delete') !!}';
            let s_route_add = '{!! route('admin.'.$s_category.'.form') !!}';
            moment.locale('{!! $app->getLocale() !!}');

            @include('admin.common.filters.js')
            @include('admin.common.list_js')

            let dt = $('.table').DataTable({
                dom: 'tip',
                autoWidth: false,
                processing: true,
                serverSide: true,
                searching: false,
                pageLength: 20,
                select: {
                    style: 'os',
                    selector: 'td:not(:last-child)'
                },
                columns: [
                    {
                        data: 'id',
                        className: 'text-center'
                    },
                    {
                        data: 'published',
                        render: function (data, type, row) {
                            let status = Number(data) ? '{!! trans('user/crud.table.enabled') !!}' : '{!! trans('user/crud.table.disabled') !!}',
                                className = Number(data) ? 'success' : 'secondary';
                            return `<span class="badge badge-${className}">${status}</span>`;
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'created_at',
                        render: function(data){
                            return moment(data).format('LLL');
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function(data){
                            return moment(data).format('LLL');
                        }
                    },
					@include('user._list_actions')
                ],
                ajax: {
                    url: '{!! route('api.'.$s_category.'.index') !!}',
                    data: function(data){
                        data.filters = filters;
                    }
                }
            });

        });
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="container-fluid">
                <div class="row filters px-4 pt-3">

					@include('user._filter_text', ['name' => 'title'])

                    @include('admin.common.filters.created_at')
                    @include('admin.common.filters.updated_at')

                </div>
                <div class="row my-3 px-3">
					@include('user._filter_perpage')
					@include('user._filter_buttons')
                </div>
            </div>
            <table class="table table-bordered table-striped table-styled">
                <thead>
                <tr>
                    <th width="1px">{!! trans('user/crud.field.id.label') !!}</th>
                    <th width="10%">{!! trans('user/crud.table.published') !!}</th>
                    <th width="10%">{!! trans('user/crud.field.title.label') !!}</th>
                    <th width="20%">{!! trans('user/crud.table.created_at') !!}</th>
                    <th width="20%">{!! trans('user/crud.table.updated_at') !!}</th>
                    <th width="1px">{!! trans('user/crud.table.actions') !!}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection