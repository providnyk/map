                    <div class="tab-pane fade{{ request()->segment(1) == 'signup' ? ' show active' : '' }}" id="register-text-tab" role="tabpanel" aria-labelledby="register-tab">
                        <div class="single-content form-page-wrap">
                            <div class="inner">
                                <form action="{!! route('register') !!}" method="POST" class="form-page" id="register-form">
                                    @csrf
{{--
                                    <div class="form-group row field" data-field="first_name">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="register_first_name">{!! trans('user/form.field.name') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="text" class="form-control" id="register_first_name" placeholder="" name="first_name">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="last_name">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="register_last_name">{!! trans('user/form.field.last') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="text" class="form-control" id="register_last_name" placeholder="" name="last_name">
                                        </div>
                                    </div>
--}}
                                    <div class="form-group row field" data-field="email">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="email">{!! trans('user/form.field.email') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="email" class="form-control"  placeholder="" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="password">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="password">{!! trans('user/form.field.password') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="password" class="form-control" id="password" placeholder="" name="password">
                                        </div>
                                    </div>

                                    <div class="form-group row field" data-field="password_confirmation">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="password_confirmation">{!! trans('user/form.field.password_confirmation') !!}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation">
                                        </div>
                                    </div>
{{--
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
--}}
                                    <input type="hidden" id="recap_response_signup" placeholder="" name="g-recaptcha-response">

                                    <div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha.key') }}"></div>

                                    <div class="btn-wrap row form-group">
                                        <div class="btn-inner offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <button type="submit" class="btn btn-primary">
                                                {!! trans('user/form.button.signup') !!}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
