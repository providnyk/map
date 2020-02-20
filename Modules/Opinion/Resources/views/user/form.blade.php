@extends('user.form')

@php
$name = 'mark';
@endphp

@section('script')
<script type="text/javascript">
let s_route = '{!! route('api.opinion.place', ':place_id') !!}'
	,s_route_unvoted_places = '{!! route('api.opinion.unvoted', ':opinion_id') !!}'
	,i_item_id = {!! request()->id ? request()->id : 0 !!}
	,i_previous = null;

function checkRestoreInitialValue(a_results)
{
	// reset dependent dropdown on "parent" change
	// or keep the selection if on of dependent elements
	// has the value that was pre-selected or re-selected
	var i_selected_value = null;
	a_results.forEach((item) => {
		if (item.id == i_previous)
			i_selected_value = item.id;
	});
	$("#element_id").val(i_selected_value).trigger('change');
}

function resetDependentDropdown(s_parent_id, s_child_id)
{
	$("#"+s_child_id).select2({
		placeholder: {
			id: '-1', // the value of the option
			title: $("#"+s_parent_id).data('placeholder')
//			text: $("#"+s_parent_id).data('placeholder')
		},
		data: {},
	});
}

function clearMarks(s_parent_id, s_child_id)
{
	$('#'+s_parent_id).find("."+s_child_id).remove();
}

function addMarks(s_parent_id, s_child_id, i_place_id, a_results, option_title, option_value)
{
	let opinion = $.tmpl($("#"+s_child_id).html(), {
		element_id:		a_results.id,
		id:				Math.random().toString(36).substring(2),
		place_id:		i_place_id,
//		title:			a_results.text,
		title:			a_results.title,
		option_title:	option_title,
		option_value:	option_value,
	}).appendTo("#"+s_parent_id);

	opinion.find('.opinions').addClass('select2-dropdown').select2(settings({
		url: '{!! route('api.mark.index') !!}',
		filter: 'title'
	}));
}


$(document).ready(function () {

	// reset dependent dropdown on page initialization
//	resetDependentDropdown("place_id", "element_id");

//    var $example = $("#place_id").select2();

    // re-define dropdown for places at this page
	$("#place_id").select2(settings({
		url: s_route_unvoted_places.replace(':opinion_id', i_item_id),
		filter: 'title'
	}));

//    $example.select2("destroy");

    $(document).on('click', '#place_id', function (e) {
        console.log('ok');
	});


	$('#place_id').change( function() {
		$(this).find(":selected").each(function () {
			var i_place_id = $(this).val();

			if ($("#element_id").val() != null)
				i_previous = $("#element_id").val();

			// TODO
			// this is a very specific case for opinion
			// it's not related to dependent dropdowns and should be called separately somehow
			clearMarks("div_select_place_id div.field-body", "div_mark_wrapper");

			// check dependent dropdown new values
			// if there is dependent selected value already
			// then keep it selected otherwise clear dependent selection
			// also notify about errors
			$.ajax({
				'type': 'get',
				'data': {},
				'url': s_route.replace(':place_id', i_place_id),
				success: (data, status, xhr) => {
					if (xhr.readyState == 4 && xhr.status == 200)
						try {
							// Do JSON handling here
							tmp = JSON.parse(xhr.responseText);
//							checkRestoreInitialValue(tmp.results);

							// TODO
							// this is a very specific case for opinion
							// it's not related to dependent dropdowns and should be called separately somehow
//console.log(tmp.results);
							for (i = 0; i < tmp.results.length; i++)
							{
								addMarks(
										"div_select_place_id .div_control",
										"div_tmpl_opinion",
										i_place_id,
										tmp.results[i],
										'{!! trans('user/crud.hint.select') !!} {!! trans('user/'.$name.'.names.sgl') !!}',
										0,
										);
							}

						} catch(e) {
							//JSON parse error, this is not json (or JSON isn't in the browser)
							notify(s_servererror_info, 'danger', 3000);
						}
					else
						notify(s_servererror_info, 'danger', 3000);
				},
				'error': (xhr) => {
					// this is the case when no dependent information is set via admin panel
					// so the route will return 404 error
					if (!(xhr.readyState == 4 && xhr.status == 404))
						notify(s_servererror_info, 'danger', 3000);
//					resetDependentDropdown("place_id", "element_id");
				}
			});
/*
			$("#element_id").select2({
				ajax: {
					url: s_route.replace(':place_id', i_place_id),
					dataType: 'json',
					data: function (params) {
						var query = {
						search: params.term,
//						point: i_place_id,
						}
						// Query parameters will be ?search=[term]&point=[id]
						return query;
					},
				},
			});
*/
		});
	});

});

</script>
@append

@section('script')
@foreach($opinion->vote AS $k => $v)
<script type="text/javascript">
$(document).ready(function () {
	addMarks(
				"div_select_place_id .div_control",
				"div_tmpl_opinion",
				{!! $v->place_id !!},
//				{id: '{!! $v->element_id !!}', text: '{!! $element[$v->element_id] !!}'},
				{id: '{!! $v->element_id !!}', title: '{!! $element[$v->element_id] !!}'},
				'{!! $mark[$v->mark_id] !!}',
				{!! $v->mark_id !!},
			);
});
</script>
@endforeach
@append

@php
$control = 'input';
$s_model_name = 'opinion';
$s_model_nameid = 'vote[${id}]';

$s_visible_input = 'mark_id';
$s_tmp = str_replace('${id}', '.*.', $s_model_nameid.'['.$s_visible_input.']');
$s_tmp = str_replace(array('[',']'), '', $s_tmp);
$b_required = (isset($_env->a_rule[$s_tmp]) && stripos($_env->a_rule[$s_tmp], 'required') !== FALSE);
@endphp
@section('tmpl')
<div id="div_tmpl_{!! $s_model_name !!}">
	<div class="fest p-3 mt-2 div_mark_wrapper" style="border: 1px solid silver">
		<div class="form-group row field search-box-container" data-name="opinions.${id}.id">
			<div class="col-lg-4">
				<label class="d-block float-left py-2 m-0">
					${title}
					{!! $b_required ? '<span class="text-danger">*</span>' : '' !!}
				</label>
			</div>
			<div class="col-lg-8 field-body">
				@include('layouts._form_' . $control . '_tmpl', ['s_fname' => 'element_id'])
				<!--input type="hidden" name="{!! $s_model_nameid !!}[element_id]" class="{!! $s_model_name !!}_element_id" value="${element_id}"-->
				<select name="{!! $s_model_nameid !!}[mark_id]" class="opinions" data-placeholder="{!! trans('user/crud.hint.select') !!} {!! trans('user/'.$name.'.names.sgl') !!}">
					<option value="${option_value}">${option_title}</option>
				</select>
				@include('layouts._form_' . $control . '_tmpl', ['s_fname' => 'place_id'])
				<!--input type="hidden" name="{!! $s_model_nameid !!}[place_id]" class="{!! $s_model_name !!}_place_id" value="${place_id}"-->
			</div>
		</div>
	</div>
</div>
@append

@section('js')
<script src="{{ asset('/admin/js/plugins/templates/jquery.tmpl.js') }}"></script>
@append