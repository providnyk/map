<div class="tab-pane px-2 {!! $app->getLocale() === $code ? 'active' : ''!!}" id="{!! $code !!}">
	<fieldset class="mb-3">
		<div class="form-group row field" data-name="{!! $code !!}.{!! $name !!}">
			<div class="col-lg-3">
				<label class="d-block float-left py-2 m-0">{!! trans('user/crud.field.'.$name.'.label') !!}<span class="text-danger">*</span></label>
				<span class="badge badge-primary tooltip-helper d-block float-right my-2 px-1" data-toggle="tooltip" title="{!! trans('user/crud.field.'.$name.'.rules') !!}"><i class="icon-info3"></i></span>
			</div>
			<div class="col-lg-9 field-body">
				<input type="text" name="{!! $code !!}[{!! $name !!}]" class="form-control" placeholder="{!! trans('user/crud.hint.input') !!} {!! trans('user/crud.field.'.$name.'.label') !!}" autocomplete="off" value="{{ $o_item->id ? $o_item->translate($code)->$name : '' }}">
			</div>
		</div>
	</fieldset>
</div>
