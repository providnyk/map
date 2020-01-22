@extends($theme . '::' . $_env->s_utype . '.master')

@section('title')
{{ mb_strtoupper(trans('user/form.text.' . request()->segment(1))) }}
@endsection

@include('public.partials._profile', ['s_id' => '#profile-form, #create-place-form'])

@section('content')

	  <div class="container">
		<div id="profile_wrap">
			<div class="profile">
				<ul class="tabs">
					<li data-tab="tab-profile" {!! request()->segment(2) == 'profile' ? ' class="active"' : '' !!}>{!! trans('personal::guest.text.profile') !!}</li>
					<li data-tab="tab-places" {!! request()->segment(2) == 'places' ? ' class="active"' : '' !!}>{!! trans('personal::guest.text.places') !!}</li>
					<div class="divider"></div>
				</ul>
				<div class="content">

@include($_env->s_view . '._profile')
@include($_env->s_view . '._places')


				</div>
			</div>
			<div class="infoblocks"></div>

		</div>
	  </div>

@append