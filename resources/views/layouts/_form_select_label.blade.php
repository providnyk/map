			@if ($s_route_list)
			<a href="{!! route($s_route_list) !!}" target="_blank">
			@endif
			{!! $s_label !!}
			@if ($s_route_list)
			</a>
			@endif
			{!! $b_required ? '<span class="text-danger">*</span>' : '' !!}
