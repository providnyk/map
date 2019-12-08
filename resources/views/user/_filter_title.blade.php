@php
$s_type = 'title';
@endphp
<div class="filter col-md-12 col-lg-6 col-xl-4 py-2" data-name="{!! $s_type !!}" data-filter-type="text" data-default-value="">
    <label>{!! trans('user/crud.filter.label') !!} {!! trans('user/crud.filter.'.$s_type) !!}</label>
    <input type="text" class="form-control input-sm" placeholder="{!! trans('user/crud.hint.input') !!} {!! trans('user/crud.filter.'.$s_type) !!}">
</div>

