                    <div class="tab-pane fade{{ request()->segment(1) == 'signin' ? ' show active' : '' }}" id="sign-text-tab" role="tabpanel" aria-labelledby="sign-tab">
                        <div class="single-content form-page-wrap">
                            <div class="inner">
                                <form action="/login" method="POST" class="form-page" id="sign-in-form">
                                    @csrf
                                    <div class="form-group row field" data-field="email">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="sign_email">{!! trans('user/form.field.email') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="text" class="form-control" id="sign_email"
                                                   placeholder="" name="email" value="{{ $email }}">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="password">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="sign_pass">{!! trans('user/form.field.password') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="password" class="form-control" id="sign_pass"
                                                   placeholder="" name="password">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="email">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="sign_email">{!! trans('user/form.field.safety_options') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                        	@for ($i = 0; $i < 3; $i++)
											<div class="check-inner offset-md-0 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap" style="margin-left: 10px;">
												<input type="radio" class="form-check-input" name="login_safety" value=" {!! $i !!}"  {!! $i == $safety ? 'checked="checked"' : '' !!}>
												<label class="form-check-label">{{ trans('user/form.button.remember-' . $i) }}</label>
											</div>
											@endfor
                                        </div>
                                    </div>

                                    <input type="hidden" id="recap_response_signin" placeholder="" name="g-recaptcha-response">

                                    <div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha.key') }}"></div>

                                    <div class="btn-wrap row form-group" style="margin-top: 26px;">
                                        <div class="btn-inner offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <button type="submit" class="btn btn-primary">
                                                {!! trans('user/form.button.signin') !!}
                                            </button>
                                        </div>
                                    </div>
                                </form>


                                        <div class="offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <a href="{!! route('password.reset-form') !!}">{!! trans('user/form.button.forgot') !!}</a>
                                        </div>

                            </div>
                        </div>
                    </div>

