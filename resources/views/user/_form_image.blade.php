@php
$s_type = 'image';
$s_label = '';
$s_rules = '';
$s_label = '';
$s_typein = '';
$s_route = '';

if (stristr($name, '_id'))
{
	$id = $name;
	if (stristr($name, '_ids'))
		$many = (stristr($name, '_ids'));
	$name = str_replace(['_ids','_id',], '', $name);
}

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

@section('script')
<script>
b_{!! $s_type !!}_single = {!! $b_many ? 0 : 1 !!};
</script>
@append

@section('js')
    <script src="{!! asset('/admin/js/plugins/templates/jquery.tmpl.js') !!}"></script>
@append

<div class="form-group row field image_id" data-name="{!! $s_dataname !!}">
	<div class="col-lg-3">
		<label class="d-block float-left py-2 m-0">
			{!! $s_label !!}
			{!! $b_required ? '<span class="text-danger">*</span>' : '' !!}
		</label>
		<span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! $s_rules !!}"><i class="icon-info3"></i></span>
	</div>
	<div class="col-lg-9 field-body">
		<div class="file-preview-thumbnails previews" id="previews">
		@if($o_item->images && $o_item->images->count())
			@foreach($o_item->images as $image)
				@include('user._form_image_item', ['image' => $image])
			@endforeach
		{{--
@dump($o_item->image, $o_item->images->count())
		@elseif($o_item->image)
			@include('user._form_image_item', ['image' => $o_item->image])
		--}}
		@endif

		</div>
		<div class="uniform-uploader image-uploader" data-type="image">
			<input type="file" class="form-control-uniform"{!! $b_many ? ' multiple' : '' !!}>
			<span class="filename" style="user-select: none;">{!! trans('user/crud.hint.'.$s_type) !!} {!! $s_typein !!}</span>
			<span class="action btn btn-primary legitRipple" style="user-select: none;">{!! trans('user/crud.hint.'.$s_type) !!} {!! $s_typein !!}</span>
		</div>
	</div>

</div>

@include('user._form_image_tpl_preview')
