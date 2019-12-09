@php
$s_type = 'checkbox';
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
<div class="form-group row field" data-name="{!! $name !!}">
    <div class="col-lg-3">
        <label class="d-block float-left py-2 m-0">{!! trans('user/crud.hint.'.$s_type) !!} {!! trans('user/crud.field.'.$name.'.label') !!}</label>
    </div>
    <div class="col-lg-9 field-body">
        <input name="{!! $name !!}" value="1" type="{!! $s_type !!}" class="switcher" data-on-text="{!! trans('user/crud.hint.enabled') !!}" data-off-text="{!! trans('user/crud.hint.disabled') !!}" data-on-color="success" data-off-color="default" {!! $o_item->published ? 'checked=checked' : '' !!}>
    </div>
</div>
