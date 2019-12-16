@php

$s_label = '';
$s_rules = '';
$b_many = (isset($many) ? $many : FALSE);
if (!isset($id)) # direct/simple value
	$s_id = $name;
else # expected to be a foreign key *_id
{
	$s_id = $id;
	$s_label = trans('user/'.$name.'.names.sgl');
	$s_typein = trans('user/'.$name.'.names.typein');
}

$s_dataname = ($code ? $code .'.' : '') . $s_id;
$s_fieldname = ($code ? $code .'[' : '') . $s_id . ($code ? ']' : '');
$s_value = $o_item->id
				? ($code ? $o_item->translate($code)->$name : $o_item->$name)
				: ''
			;

if (trans('user/'.$s_category.'.field.'.$s_id.'.label') != 'user/'.$s_category.'.field.'.$s_id.'.label')
{
	$s_label = trans('user/'.$s_category.'.field.'.$s_id.'.label');
	$s_typein = trans('user/'.$s_category.'.field.'.$s_id.'.typein');

}
elseif (trans('user/crud.field.'.$name.'.label') != 'user/crud.field.'.$name.'.label')
{
	$s_label = trans('user/crud.field.'.$name.'.label');
	$s_typein = trans('user/crud.field.'.$name.'.typein');
}

if (trans('user/'.$s_category.'.field.'.$s_id.'.rules') != 'user/'.$s_category.'.field.'.$s_id.'.rules')
	$s_rules = trans('user/'.$s_category.'.field.'.$s_id.'.rules');
elseif (trans('user/crud.field.'.$name.'.rules') != 'user/crud.field.'.$name.'.rules')
	$s_rules = trans('user/crud.field.'.$name.'.rules');

$b_required = (stripos($s_rules, 'required') !== FALSE);
@endphp
<div class="form-group row field" data-name="{!! $s_dataname !!}">
	<div class="col-lg-3">
		<label class="d-block float-left py-2 m-0">
			{!! $s_label !!}
			{!! $b_required ? '<span class="text-danger">*</span>' : '' !!}
		</label>
		<span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! $s_rules !!}"><i class="icon-info3"></i></span>
	</div>
	@php
	$s_selected_title = '';
	$s_selected_id = NULL;
	if($o_item->$s_id)
	{
		$o_collection = $$name->keyBy('id');
		$s_selected_id = $o_item->$s_id;
		$s_selected_title = $o_collection[$o_item->$s_id]->translate($app->getLocale())->title;
	}
	@endphp

	<div class="col-lg-9 field-body">
		<select name="{!! $s_id !!}{!! $b_many ? 's[]' : '' !!}" class="form-control select2-dropdown {!! $b_many ? 'multi-select' : '' !!}" id="{!! $s_id !!}" data-placeholder="{!! trans('user/crud.hint.select') !!} {!! $s_typein !!}" data-url="{!! route('api.'.$name.'.index') !!}" {!! $b_many ? 'multiple' : '' !!}>
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
	</div>
</div>
