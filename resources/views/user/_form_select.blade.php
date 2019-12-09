@php
$s_label = '';
$s_rules = '';
if (!isset($id)) # direct/simple value
	$s_id = $name;
else # expected to be a foreign key *_id
{
	$s_id = $id;
	$s_label = trans('user/'.$name.'.names.sgl');
}

if (trans('user/'.$s_category.'.field.'.$s_id.'.label') != 'user/'.$s_category.'.field.'.$s_id.'.label')
	$s_label = trans('user/'.$s_category.'.field.'.$s_id.'.label');
elseif (trans('user/crud.field.'.$name.'.label') != 'user/crud.field.'.$name.'.label')
	$s_label = trans('user/crud.field.'.$name.'.label');

if (trans('user/'.$s_category.'.field.'.$s_id.'.rules') != 'user/'.$s_category.'.field.'.$s_id.'.rules')
	$s_rules = trans('user/'.$s_category.'.field.'.$s_id.'.rules');
elseif (trans('user/crud.field.'.$name.'.rules') != 'user/crud.field.'.$name.'.rules')
	$s_rules = trans('user/crud.field.'.$name.'.rules');

$b_required = (stripos($s_rules, 'required') !== FALSE);
@endphp
<div class="form-group row field" data-name="{!! $s_id !!}">
	<div class="col-lg-3">
		<label class="d-block float-left py-2 m-0">
			{!! $s_label !!}
			{!! $b_required ? '<span class="text-danger">*</span>' : '' !!}
		</label>
		<span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! $s_rules !!}"><i class="icon-info3"></i></span>
	</div>
	@php
	$o_collection = $$name->keyBy('id');
	$s_selected_title = $o_collection[$o_item->$s_id]->translate($app->getLocale())->title;
	@endphp
	<div class="col-lg-9 field-body">
		<select name="{!! $s_id !!}" class="form-control select2-dropdown" id="{!! $s_id !!}" data-placeholder="{!! trans('user/crud.hint.select') !!} {!! $s_label !!}" data-url="{!! route('api.'.$name.'.index') !!}">
			@if($o_item->$s_id)
				<option value="{!! $o_item->$s_id !!}">{!! $s_selected_title !!}</option>
			@else
				<option value="">{!! $s_label !!}</option>
			@endif
		</select>
	</div>
</div>
