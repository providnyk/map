@php
include(base_path().'/resources/views/layouts/_form_variables.php');
@endphp


					<div class="field_row" data-name="{!! $s_dataname !!}">
					@include('layouts._form_select_label')
@php
include(base_path().'/resources/views/layouts/_form_select_current.php');
@endphp
					@include('layouts._form_select_control')
					</div>
