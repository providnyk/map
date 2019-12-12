@extends('layouts.admin')

@section('title-icon')<i class="icon-users2 mr-2"></i>@endsection

@section('title'){!! $user->id ? trans('app/users.form.title.edit') : trans('app/users.form.title.create') !!}@endsection

@section('breadcrumbs')
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
				@include('admin.common._breadcrumb_home')
                <a href="{!! route('admin.users') !!}" class="breadcrumb-item">{!! trans('app/users.list.title') !!}</a>
                <span class="breadcrumb-item active">{!! $user->id ? trans('app/users.form.title.edit') : trans('app/users.form.title.create') !!}</span>
            </div>
            <a href="{!! $user->id ? route('admin.users.form', $user->id) : route('admin.users.form') !!}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ mix('/admin/css/form/form.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('/admin/js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            //console.log(notify);

            let select = $('.select2');

            select.select2({
                minimumResultsForSearch: Infinity,
                placeholder: select.data('placeholder'),
            });

            $('form').on('submit', function(e){
                e.preventDefault();

                let data = {},
                    form = $(this);

                $.each(form.serializeArray(), function() {
                    data[this.name] = this.value;
                });

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: data
                }).done((data, status, xhr) => {

                    swal({
                        title: data.message,
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'View list',
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonText: 'Continue...',
                        cancelButtonClass: 'btn btn-light',
                    }).then((confirm) => {
                        if(confirm.value){
                            window.location.href = '{!! route('admin.users') !!}';
                        }else{
                            form.find('fieldset').attr('disabled', false);
                        }
                    });

                    form.find('fieldset').attr('disabled', true);
                }).fail((xhr) => {
                    let data = xhr.responseJSON;

                    notify(data.message, 'danger', 3000);
                }).always((xhr, type, status) => {

                    let response = xhr.responseJSON || status.responseJSON,
                        errors = response.errors || [];

                    form.find('.field').each((i, el) => {
                        let field = $(el),
                            container = field.find(`.field-body`),
                            elem = $('<label class="message">');

                        container.find('label.message').remove();

                        if(errors[field.data('name')]){
                            errors[field.data('name')].forEach((msg) => {
                                elem.clone().addClass('validation-invalid-label').html(msg).appendTo(container);
                            });
                        }else{
                            //elem.clone().addClass('validation-valid-label').html('Success').appendTo(container);
                        }

                    });
                })
            });
        });
    </script>
@endsection

@section('content')
    <div class="card form">
        <div class="card-body p-0">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#main" class="nav-link active" data-toggle="tab">{!! trans('app/users.form.tabs.main') !!}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane px-2 active" id="main">
                        <legend class="text-uppercase font-size-sm font-weight-bold">{!! trans('app/users.form.legends.main') !!}</legend>
                        <form class="form-validate-jquery" action="{!! $user->id ? route('api.users.update', $user->id) : route('api.users.store') !!}" method="post">
                            <fieldset class="mb-3">
                                <div class="form-group row field" data-name="first_name">
                                    <div class="col-lg-3">
                                        <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.first_name.label') !!} <span class="text-danger">*</span></label>
                                        <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.first_name.rules') !!}"><i class="icon-info3"></i></span>
                                    </div>
                                    <div class="col-lg-9 field-body">
                                        <input type="text" name="first_name" class="form-control" placeholder="{!! trans('app/users.form.fields.first_name.label') !!}" autocomplete="off" value="{!! $user->first_name !!}">
                                    </div>
                                </div>
                                <div class="form-group row field" data-name="last_name">
                                    <div class="col-lg-3">
                                        <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.last_name.label') !!} <span class="text-danger">*</span></label>
                                        <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.last_name.rules') !!}"><i class="icon-info3"></i></span>
                                    </div>
                                    <div class="col-lg-9 field-body">
                                        <input type="text" name="last_name" class="form-control" placeholder="{!! trans('app/users.form.fields.last_name.label') !!}" autocomplete="off" value="{!! $user->last_name !!}">
                                    </div>
                                </div>

                                <div class="form-group row field" data-name="email">
                                    <div class="col-lg-3">
                                        <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.email.label') !!} <span class="text-danger">*</span></label>
                                        <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.email.rules') !!}"><i class="icon-info3"></i></span>
                                    </div>
                                    <div class="col-lg-9 field-body">
                                        <input type="text" name="email" class="form-control" placeholder="{!! trans('app/users.form.fields.email.label') !!}" autocomplete="off" value="{!! $user->email !!}">
                                    </div>
                                </div>
                                @if($roles)
                                    <div class="form-group row field" data-name="role">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.role_id.label') !!}</label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.role_id.rules') !!}"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <select name="role" class="form-control multi-select" data-placeholder="{!! trans('app/users.form.fields.role_id.label') !!}">
                                                @foreach($roles as $role)
                                                    <option value="{!! $role->name !!}" {!! $user->hasRole($role->name) ? 'selected="selected"' : '' !!}>{!! $role->name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if($countries)
                                    <div class="form-group row field" data-name="country_id">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('common/form.fields.country_id.label') !!}</label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('common/form.fields.country_id.rules') !!}"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <select name="country_id" class="form-control multi-select" data-placeholder="{!! trans('app/places.form.fields.country_id.label') !!}">
                                                @foreach($countries as $country)
                                                    <option value="{!! $country->id !!}" {!! $user->country && $user->country->id === $country->id ? 'selected="selected"' : '' !!}>{!! $country->name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if( ! $user->id)
                                    <div class="form-group row field" data-name="password">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.password.label') !!} <span class="text-danger">*</span></label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="required | min-length: 3 | max-length: 255"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <input type="password" name="password" class="form-control" placeholder="{!! trans('app/users.form.fields.password.label') !!}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row field" data-name="password_confirmation">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.password_confirmation.label') !!} <span class="text-danger">*</span></label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.password_confirmation.rules') !!}"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="{!! trans('app/users.form.fields.password_confirmation.label') !!}" autocomplete="off">
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row field" data-name="active">
                                    <div class="col-lg-3">
                                        <label class="d-block float-left py-2 m-0">{!! trans('common/form.fields.active.label') !!}</label>
                                    </div>
                                    <div class="field-body form-check-switch form-check-switch-left">
                                        <input name="active" value="1" type="checkbox" class="switcher" data-on-text="On" data-off-text="Off" data-on-color="success" data-off-color="default" {!! $user->active ? 'checked=checked' : '' !!}>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="submit" class="btn btn-styled ml-2">{!! trans('app/users.form.submit') !!} <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </fieldset>
                        </form>
                        @if($user->id)
                            <legend class="text-uppercase font-size-sm font-weight-bold">{!! trans('app/users.form.fields.old_password.label') !!}</legend>
                            <form class="form-validate-jquery" action="{!! route('api.users.password-change', $user->id) !!}" method="post" autocomplete="off">
                                <fieldset class="mb-3">
                                    <div class="form-group row field" data-name="old_password">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.old_password.label') !!} <span class="text-danger">*</span></label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.old_password.rules') !!}"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <input type="password" name="old_password" class="form-control" placeholder="{!! trans('app/users.form.fields.password.label') !!}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row field" data-name="new_password">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.new_password.label') !!} <span class="text-danger">*</span></label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.new_password.rules') !!}"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <input type="password" name="new_password" class="form-control" placeholder="{!! trans('app/users.form.fields.new_password.label') !!}" autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group row field" data-name="new_password_confirmation">
                                        <div class="col-lg-3">
                                            <label class="d-block float-left py-2 m-0">{!! trans('app/users.form.fields.new_password_confirmation.label') !!} <span class="text-danger">*</span></label>
                                            <span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('app/users.form.fields.new_password_confirmation.rules') !!}"><i class="icon-info3"></i></span>
                                        </div>
                                        <div class="col-lg-9 field-body">
                                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="{!! trans('app/users.form.fields.new_password_confirmation.label') !!}" autocomplete="off">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="submit" class="btn btn-styled ml-2">{!! trans('app/users.form.submit') !!} <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
