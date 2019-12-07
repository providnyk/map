@extends('layouts.public')

@section('meta')
    <title>{!! mb_strtoupper(trans('general.my-festival') . ' | ' . config('app.name')) !!}</title>
@endsection

@section('script')
<!-- http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm -->
@if (Cookie::get( config('cookie-consent.cookie_name') ) !== null)
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google.recaptcha.key') }}"></script>
@endif
<script>
    reCAPTCHA_site_key = '{{ config('services.google.recaptcha.key') }}';
    $(document).ready(() => {

        function reCAPTCHA_execute () {
          grecaptcha.execute(reCAPTCHA_site_key, {action: 'login'}).then(function(token) {
             $('[name="g-recaptcha-response"]').val(token);
            }, function (reason) {
              console.log(reason);
          });
        }

        if (typeof grecaptcha !== 'undefined' && typeof reCAPTCHA_site_key !== 'undefined') {
            grecaptcha.ready(reCAPTCHA_execute);
            setInterval(reCAPTCHA_execute, 1000 * 60 * 2); // seconds 1 * 60 = minutes 1 * 2
        }

        $('#register-form').on('submit', (e) => {
            e.preventDefault();

            let form = $(e.currentTarget);

            $.ajax({
                'type': 'post',
                'data': form.serialize(),
                'url': form.attr('action'),
                'success': (data) => {
                    swal({
                        title: 'Success',
                        text: data.message,
                        type: 'success',
                        confirmButtonText: 'Ok',
                        confirmButtonClass: 'btn btn-primary',
                    });
                },
                'error': (xhr) => {
                    let response = xhr.responseJSON;

                    form.find('.error').remove();

                    $.each(response.errors, (field, message) => {
                        form.find(`[data-field="${field}"] .field-body`).append($('<div class="error pt-2">').html(message));
                    });
                }
            });
        });
    });
</script>
@endsection

@section('content')
<div class="content sign-in-page">
    <div class="container-fluid">
        <div class="single-form-block-wrap">
            <div class="single-form-block">
                <div class="title-box">
                    <h1 class="title-block">{{ trans('general.my-festival') }}</h1>
                    <ul class="nav nav-tabs" id="pressTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sign-tab" data-toggle="tab" href="#sign-text-tab"
                               role="tab"
                               aria-controls="sign-text-tab" aria-selected="true">{{ trans('general.sign-in') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register-text-tab" role="tab"
                               aria-controls="register-text-tab" aria-selected="false">{{ trans('general.register') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content section-tab" id="pressTabContent">
                    <div class="result-text-title">
                        Sign in or create a new account to keep track of all CULTURESCAPES events you are interested in. You can also get all our news and updates.
                    </div>
                    <div class="tab-pane fade show active" id="sign-text-tab" role="tabpanel"
                         aria-labelledby="sign-tab">
                        <div class="single-content form-page-wrap">
                            <div class="inner">
                                <form action="/login" method="POST" class="form-page" id="sign-in-form">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="sign_email">{{ trans('general.email') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap">
                                            <input type="text" class="form-control" id="sign_email"
                                                   placeholder="" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="sign_pass">{{ trans('general.password') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap">
                                            <input type="password" class="form-control" id="sign_pass"
                                                   placeholder="" name="password">
                                        </div>
                                    </div>

                                    <div class="btn-wrap row form-group">
                                        <div class="btn-inner offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <button type="submit" class="btn btn-primary">
                                                {{ trans('general.sign-in') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="sub-text-wrap row">
                                        <div class="offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <a href="{!! route('password.reset-form') !!}">{{ trans('general.password-forgot') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="register-text-tab" role="tabpanel" aria-labelledby="register-tab">
                        <div class="single-content form-page-wrap">
                            <div class="inner">
                                <form action="{!! route('register') !!}" method="POST" class="form-page" id="register-form">
                                    @csrf
                                    <div class="form-group row field" data-field="first_name">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="register_first_name">{{ trans('general.first-name') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="text" class="form-control" id="register_first_name" placeholder="" name="first_name">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="last_name">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="register_last_name">{{ trans('general.last-name') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="text" class="form-control" id="register_last_name" placeholder="" name="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group row field" data-field="email">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="email">{{ trans('general.email') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="email" class="form-control"  placeholder="" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="password">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="password">{{ trans('general.password') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="password" class="form-control" id="password" placeholder="" name="password">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="password_confirmation">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="password_confirmation">{{ trans('general.password-confirmation') }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="register_country">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="register_country">{{ trans('general.country') }}</label>
                                        </div>

                                        <div class="col-md-9 col-sm-8 col-12 control-wrap">
                                            <div class="jq-selectbox jqselect full-width" id="register_country-styler" style="z-index: 10;">
                                                <select name="profile_country" id="register_country" class="full-width">
                                                    @foreach($countries as $country)
                                                        <option value="{!! $country->id !!}">{!! $country->name !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="g_recaptcha_response" placeholder="" name="g-recaptcha-response">

                                    <div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha.key') }}"></div>

                                    <div class="btn-wrap row form-group">
                                        <div class="btn-inner offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <button type="submit" class="btn btn-primary">
                                                {{ trans('general.create-account') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
