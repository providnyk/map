@extends('layouts.public')

@section('meta')
    <title>{!! mb_strtoupper(' reset password | ' . config('app.name')) !!}</title>
@endsection

@section('script')
    <script>

        $(document).ready(() => {

            $('#password-reset-form').on('submit', (e) => {

                e.preventDefault();

                let form = $(e.currentTarget);

                $.ajax({
                    'url': form.attr('action'),
                    'type': 'post',
                    'data': form.serialize(),
                    'always': () => {
                        form.find('error').remove();
                    },
                    'success': (data) => {

                        swal({
                            title: 'Success',
                            text: data.message,
                            type: 'success',
                            confirmButtonText: 'Ok',
                            confirmButtonClass: 'btn btn-primary',
                        });

                    },
                    'error': (xhr, status) => {

                        let response = xhr.responseJSON;

                        $.each(response.errors, (field, message) => {
                            form.find(`[data-field=${field}] .field-body`).append($('<div class="error pt-2">').html(message));
                        });

                        console.log(response);
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
                    <h1 class="w-100">
                    	{!! trans('user/auth.text.reset') !!}
                    </h1>
                </div>

                <div class="tab-content section-tab" id="pressTabContent">
                    <div class="tab-pane fade show active" id="sign-text-tab" role="tabpanel" aria-labelledby="sign-tab">
                        <div class="single-content form-page-wrap">
                            <div class="inner">
                                <form action="{!! route('password.reset') !!}" method="POST" class="form-page" id="password-reset-form">
                                    @csrf
                                    <div class="form-group row field" data-field="email">
                                        <div class="col-md-3 col-sm-4 col-12 label-wrap">
                                            <label for="sign_email">
                                            	{!! trans('user/auth.field.email') !!}
                                        	</label>
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-12 control-wrap field-body">
                                            <input type="text" class="form-control" id="sign_email" placeholder="" name="email">
                                        </div>
                                    </div>

                                    <div class="btn-wrap row form-group">
                                        <div class="btn-inner offset-md-3 col-md-9 offset-sm-4 col-sm-8 col-12 control-wrap">
                                            <button type="submit" class="btn btn-primary">
                                                {!! trans('user/auth.button.reset') !!}
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
