					<div id="tab-signup" class="tab{{ request()->segment(1) == 'signup' ? ' opened' : '' }}">
						<div class="user_details">
							<div class="img" style="width: 10px;"></div>
							<div class="name">{!! trans('general.my-area') !!} <span>{{ trans('user/form.text.hint_up') }}</span></div>
							<div class="divider"></div>
						</div>
						<div class="user_fields">
							<form action="{!! route('register') !!}" method="POST" class="form-page" id="register-form">
								@csrf
								<div class="item">
									<span class="label">
										{!! trans('user/form.field.email') !!}
									</span>
									<span class="value">
										<input type="email" class="form-control"  placeholder="" name="email">
									</span>
								</div>
								<div class="item">
									<span class="label">
										{!! trans('user/form.field.password') !!}
									</span>
									<span class="value">
										<input type="password" class="form-control"  placeholder="" name="password">
									</span>
								</div>
								<div class="item">
									<span class="label">
										{!! trans('user/form.field.password_confirmation') !!}
									</span>
									<span class="value">
										<input type="password" class="form-control"  placeholder="" name="password_confirmation">
									</span>
								</div>
							</form>
						</div>
						<div class="buttons">
							<button type="submit" class="confirm">{!! trans('user/form.button.signup') !!}</button>
						</div>
					</div>
