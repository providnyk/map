					<div id="tab-signin" class="tab{{ request()->segment(1) == 'signin' ? ' opened' : '' }}">
						<div class="user_details">
							<div class="img" style="width: 10px;"></div>
							<div class="name">{!! trans('general.my-area') !!} <span>{{ trans('user/form.text.hint_in') }}</span></div>
							<div class="divider"></div>
						</div>
						<form action="{!! route('login') !!}" method="POST" class="form-page" id="register-form">
							@csrf

							<div class="user_fields">
								<div class="item">
									<span class="label">
										{!! trans('user/form.field.email') !!}
									</span>
									<span class="value">
										<input type="email" class="form-control" placeholder="" name="email" value="{{ $email }}">
									</span>
								</div>
								<div class="item">
									<span class="label">
										{!! trans('user/form.field.password') !!}
									</span>
									<span class="value">
										<input type="password" class="form-control" placeholder="" name="password">
									</span>
								</div>

								<div class="item">
									<span class="label">
										{!! trans('user/form.field.safety_options') !!}
									</span>
									<span class="value">
										@for ($i = 0; $i < 3; $i++)
										<div style="margin-left: 21px;">
											<input type="radio" class="form-check-input" name="login_safety" value=" {!! $i !!}"  {!! $i == $safety ? 'checked="checked"' : '' !!}>
											<label>{{ trans('user/form.button.remember-' . $i) }}</label>
										</div>
										@endfor
									</span>
								</div>

								<input type="hidden" id="recap_response_signin" placeholder="" name="g-recaptcha-response">
								<div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha.key') }}"></div>

							</div>
							<div class="buttons">
								<button type="submit" class="confirm">{!! trans('user/form.button.signin') !!}</button>
							</div>

	                        <div style="padding-left: 223px;">
	                            <a href="{!! route('password.reset-form') !!}">{!! trans('user/form.button.forgot') !!}</a>
	                        </div>
						</form>

					</div>
