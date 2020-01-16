@extends($theme . '::' . $_env->s_utype . '.master')

@section('title')
{{ mb_strtoupper(trans('user/form.text.' . request()->segment(2))) }}
@endsection

@include('public.partials._profile', ['s_id' => '#password-reset-form'])

@section('content')

	  <div class="container">
		<div id="profile_wrap">
			<div class="profile">
				<ul class="tabs">
					<li data-tab="tab-reset" {!! request()->segment(2) == 'reset' ? ' class="active"' : '' !!}>{!! trans('user/form.text.reset') !!}</li>
					<li data-tab="tab-signup" {!! request()->segment(2) == 'signup' ? ' class="active"' : '' !!}>{!! trans('user/form.text.signup') !!}</li>
					<div class="divider"></div>
				</ul>
				<div class="content">

@include($theme . '::' . $_env->s_utype . '._reset')
@include($theme . '::' . $_env->s_utype . '._signup')

				</div>
			</div>
			<div class="infoblocks"></div>

		</div>
	  </div>

@append