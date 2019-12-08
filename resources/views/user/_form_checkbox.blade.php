@php
$s_type = 'checkbox';
@endphp
<div class="form-group row field" data-name="{!! $name !!}">
    <div class="col-lg-3">
        <label class="d-block float-left py-2 m-0">{!! trans('user/crud.hint.'.$s_type) !!} {!! trans('user/crud.field.'.$name.'.label') !!}</label>
    </div>
    <div class="col-lg-9 field-body">
        <input name="{!! $name !!}" value="1" type="{!! $s_type !!}" class="switcher" data-on-text="{!! trans('user/crud.hint.enabled') !!}" data-off-text="{!! trans('user/crud.hint.disabled') !!}" data-on-color="success" data-off-color="default" {!! $o_item->published ? 'checked=checked' : '' !!}>
    </div>
</div>
