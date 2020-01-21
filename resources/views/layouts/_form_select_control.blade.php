		<select name="{!! $s_id !!}{!! $b_many ? '[]' : '' !!}" class="form-control select2-dropdown {!! $b_many ? 'multi-select' : '' !!}" id="{!! $s_id !!}" data-placeholder="{!! trans('user/crud.hint.select') !!} {!! $s_typein !!}" data-url="{!! route($s_route_api) !!}" {!! $b_many ? 'multiple' : '' !!}>
			@if($s_selected_id)
				<option value="{!! $o_item->$s_id !!}">
					{!! $s_selected_title !!}
				</option>
			@elseif ($b_many && $$name)
				 @foreach($$name as $o_tmp)
				 @php $b_selected = (in_array($o_tmp->id, $o_item->$name->pluck('id')->toArray())); @endphp
				<option value="{!! $o_tmp->id !!}" {!! $b_selected ? 'selected="selected"' : '' !!}>
					{!! $o_tmp->translate($app->getLocale())->title !!}
				</option>
				@endforeach
			@endif
		</select>
