					<div id="tab-reset" class="tab{{ request()->segment(2) == 'reset' ? ' opened' : '' }}">
						<div class="user_details">
							<div class="img" style="width: 10px;"></div>
							<div class="name">{!! trans('general.my-area') !!} <span>{{ trans('user/form.text.hint_reset') }}</span></div>
							<div class="divider"></div>
						</div>
						<form action="{!! route('password.reset') !!}" method="POST" class="form-page" id="password-reset-form">
							@csrf

							<div class="user_fields">
								<div class="item">
									<span class="label">
										{!! trans('user/form.field.email') !!}
									</span>
									<span class="value">
										<input type="email" class="form-control" placeholder="" name="email" value="">
									</span>
								</div>

								<input type="hidden" id="recap_response_reset" placeholder="" name="g-recaptcha-response">
								<div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha.key') }}"></div>

							</div>
							<div class="buttons">
								<button type="submit" class="confirm">{!! trans('user/form.button.reset') !!}</button>
							</div>

						</form>
					</div>
