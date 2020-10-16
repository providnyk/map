<h3>{{ trans( 'common/messages.email.confirm.title', ['app_name' => trans('app.name')] ) }}</h3>

<p>{{ trans('common/messages.email.confirm.open') }} {{ $email }} {{ trans( 'common/messages.email.confirm.close', ['app_name' => trans('app.name')] ) }}</p>
<p><a href="{!! route('signup_confirm', $token) !!}">{{ trans('common/messages.email.confirm.link') }}</a></p>
<p>{{ trans( 'common/messages.email.confirm.thanks', ['app_name' => trans('app.name')] ) }}</p>

<h3>{{ trans('common/messages.email.disclaimer.title') }}</h3>
<p>{{ trans('common/messages.email.disclaimer.text') }}</p>
