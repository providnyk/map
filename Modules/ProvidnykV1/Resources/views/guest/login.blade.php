@extends($theme . '::' . $_env->s_utype . '.master')

@section('title')
{{ mb_strtoupper(trans('user/form.text.' . request()->segment(1))) }}
@endsection

@include('public.partials._profile', ['s_id' => '#register-form, #sign-in-form'])

@section('content')
<div class="content sign-in-page">
    <div class="container-fluid">
        <div class="single-form-block-wrap">
            <div class="single-form-block">
                <div class="title-box">
                    <h1 class="title-block">
                    	{!! trans('general.my-area') !!}
                    </h1>
                    <ul class="nav nav-tabs" id="pressTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link{{ request()->segment(1) == 'signin' ? ' active' : '' }}" id="sign-tab" data-toggle="tab" href="#sign-text-tab"
                               role="tab"
                               aria-controls="sign-text-tab" aria-selected="true">{!! trans('user/form.text.signin') !!}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ request()->segment(1) == 'signup' ? ' active' : '' }}" id="register-tab" data-toggle="tab" href="#register-text-tab" role="tab"
                               aria-controls="register-text-tab" aria-selected="false">{!! trans('user/form.text.signup') !!}</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content section-tab" id="pressTabContent">
                    <div class="result-text-title">
                        {{ trans('user/form.text.hint') }}
                    </div>

@include($theme . '::' . $_env->s_utype . '.signin')
@include($theme . '::' . $_env->s_utype . '.signup')


                </div>
            </div>
        </div>
    </div>
</div>
@append