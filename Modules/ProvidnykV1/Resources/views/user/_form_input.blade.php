@php
/*
#$s_type = 'input';
$s_label = '';
$s_rules = '';
$s_label = '';
$s_typein = '';












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
*/
@endphp
<div class="form-group row field div_wrap_{!! $s_id !!}" data-name="{!! $s_dataname !!}" id="div_wrap_{!! $s_dataname !!}">
	<div class="col-lg-3">
		<label class="d-block float-left py-2 m-0">
@include('layouts._form_label')
		</label>
		<span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! $s_rules !!}">
			<i class="icon-info3"></i>
		</span>
	</div>
	<div class="div_control div_input_control col-lg-9 field-body">
@include('layouts._form_input_control', ['s_field_type' => 'text'])
	</div>
</div>
