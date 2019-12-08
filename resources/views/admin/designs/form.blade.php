@extends('layouts.admin')

@php
include(getcwd().'/../resources/views/user/crud.php');
@endphp

@section('title-icon')<i class="{!! trans('user/' . $s_category . '.names.ico') !!} mr-2"></i>@endsection

@section('title'){!! $s_page_action !!}@endsection

@section('breadcrumbs')
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				@include('admin.common._breadcrumb_home')
				<a href="{!! $s_list_route !!}" class="breadcrumb-item">{!! $s_list_name !!}</a>
				<span class="breadcrumb-item active">{!! $s_page_action !!}</span>
			</div>
			<a href="{!! $s_page_route !!}" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ mix('/admin/css/form/form.css') }}">
@endsection

@section('js')
	<script src="{{ asset('/admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script src="{{ asset('/admin/js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection

@section('script')
	<script>
		s_page_route	= '{!! $s_page_route !!}';
		s_res_submit	= '{!! trans( 'user/messages.'.($o_item->id ? 'updated' : 'created') ) . ' ' . $s_cat_sgl_u1 !!}';
		s_text_list		= '{!! $s_btn_primary !!}';
		s_text_continue	= '{!! $s_btn_secondary !!}';
		s_list_route	= '{!! $s_list_route !!}';

		$(document).ready(function(){

			let select = $('.select2');

			select.select2({
				minimumResultsForSearch: Infinity,
				placeholder: select.data('placeholder'),
			});

			$('form').on('submit', function(e){
				e.preventDefault();

				let data = {},
					form = $(this);

				$.ajax({
					url: form.attr('action'),
					type: 'post',
					data: form.serialize()
				}).done((data, status, xhr) => {
					swal({
						title: s_res_submit,
						type: 'success',
						showCancelButton: true,
						confirmButtonText: s_text_list,
						confirmButtonClass: 'btn btn-primary',
						cancelButtonText: s_text_continue,
						cancelButtonClass: 'btn btn-light',
					}).then((confirm) => {
						if(confirm.value){
							window.location.href = s_list_route;
						}else{
							form.find('fieldset').attr('disabled', false);
						}
					});

					form.find('fieldset').attr('disabled', true);
				}).fail((xhr) => {
					let data = xhr.responseJSON;

					notify(data.message, 'danger', 3000);
				}).always((xhr, type, status) => {

					let response = xhr.responseJSON || status.responseJSON,
						errors = response.errors || [];

					form.find('.field').each((i, el) => {
						let field = $(el),
							container = field.find(`.field-body`),
							elem = $('<label class="message">');

						container.find('label.message').remove();

						if(errors[field.data('name')]){
							errors[field.data('name')].forEach((msg) => {
								elem.clone().addClass('validation-invalid-label').html(msg).appendTo(container);
							});
						}else{
							//elem.clone().addClass('validation-valid-label').html('Success').appendTo(container);
						}

					});
				})
			});
		});
	</script>
@endsection

@section('content')
	<div class="card form">
		<div class="card-body p-0">
			<div class="card-body">
				<form class="form-validate-jquery" action="{!! $s_form_route !!}" method="post">
					<ul class="nav nav-tabs nav-tabs-highlight">
						<li class="nav-item">
							<a href="#data" class="nav-link active" data-toggle="tab">{!! trans('user/crud.tab.data.name') !!}</a>
						</li>
						<li class="nav-item">
							<a href="#manage" class="nav-link" data-toggle="tab">{!! trans('user/crud.tab.manage.name') !!}</a>
						</li>
					</ul>
					<div class="tab-content">
						@include('user._form_submit')
						<div class="tab-pane px-2 active" id="data">
							<legend class="text-uppercase font-size-sm font-weight-bold">{!! trans('user/crud.tab.data.info') !!}</legend>
							<ul class="nav nav-tabs nav-tabs-highlight">
								@foreach($localizations as $code => $localization)
									<li class="nav-item">
										<a href="#{!! $code !!}" class="nav-link {!! $app->getLocale() === $code ? 'active' : ''!!}" data-toggle="tab">
											<img src="{!! asset('images/flags/' . $code . '.png') !!}" width="30rem" class="mr-1">
											{!! $localization !!}
										</a>
									</li>
								@endforeach
							</ul>
							<div class="tab-content">
								@foreach($localizations as $code => $localization)
									<div class="tab-pane px-2 {!! $app->getLocale() === $code ? 'active' : ''!!}" id="{!! $code !!}">
									@include('user._form_input', ['name'=>'title',])
									</div>
								@endforeach
							</div>
						</div>
						<div class="tab-pane px-2" id="manage">
							<legend class="text-uppercase font-size-sm font-weight-bold">{!! trans('user/crud.tab.manage.info') !!}</legend>
							@include('user._form_checkbox', ['name'=>'published',])
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection