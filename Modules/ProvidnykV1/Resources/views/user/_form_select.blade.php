@php
include(base_path().'/resources/views/layouts/_form_variables.php');
@endphp

<div class="form-group row field" data-name="{!! $s_dataname !!}">
	<div class="col-lg-3">

		<label class="d-block float-left py-2 m-0">
@include('layouts._form_select_label')
		</label>

		<span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! $s_rules !!}"><i class="icon-info3"></i></span>
	</div>

@php
include(base_path().'/resources/views/layouts/_form_select_current.php');
@endphp

	<div class="col-lg-9 field-body">
@include('layouts._form_select_control')
	</div>
</div>
